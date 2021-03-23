<?php

namespace App\Http\Controllers;

use App\Config;
use App\Order;
use App\Suborder;
use App\Payment;
use App\Transaction;
use App\Merchant;
use App\Mail\Ordered;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Payment $payment)
    {
        $user = $payment->user;
        $merchants = Merchant::all();
        if($payment->paymentProofs->count() > 0) {
            return redirect()->route('dashboard.payment', $payment);
        }
        // $shippings = $this->shipping(444, $payment->city, $payment->weight);
        $shippings = [];
        // dd($payment);
        return view('shop.checkout', compact('payment', 'user', 'merchants', 'shippings'));
    }

    public function store()
    {
        $cart = session()->get('cart');
        $key = sha1(time());
        $invoiceno = time();

        $summary = $cart['summary'];

        $last_payment = Payment::orderBy('insertid', 'desc')->first();

        $payment = new Payment();
        $payment->user()->associate(auth()->user());
        // $payment->merchant()->associate($request->payment_merchant);
        $payment->transactionno = $invoiceno;
        $payment->transactionmount = $summary['subtotal'];
        $payment->transactiondate = Carbon::now();
        $payment->transactionexpire = Carbon::now()->addDays(7);
        // $payment->shipping_cost = $summary['shipping']['cost'];
        $payment->discount = $summary['total_discount'];
        $payment->weight = $summary['total_weight'];
        // status: pending
        $payment->status = 1;
        $payment->insertid = $last_payment ? $last_payment->insertid + 1 : 1;
        $payment->currency = 'IDR';
        $payment->address = auth()->user()->address;
        $payment->province = auth()->user()->province;
        $payment->city = auth()->user()->city;
        $payment->postcode = auth()->user()->postcode;
        $payment->save();

        foreach($cart['list'] as $cart)
        {
            $product = $cart['product'];
            $transaction = new Transaction();
            $transaction->payment()->associate($payment);
            $transaction->transactionno = $payment->transactionno;
            $transaction->product()->associate($product->id);
            $transaction->itemname = $product->title;
            $transaction->quantity = $cart['quantity'];
            $transaction->price = $product->price;
            $transaction->save();
        }
        
        session()->forget('cart');
        return redirect()->route('checkout.index', $payment);
    }

    public function update(Request $request, Payment $payment)
    {
        $payment->merchant()->associate($request->payment_merchant);
        $payment->save();
        Mail::to($payment->user)->send(new Ordered($payment));

        return redirect()->route('dashboard.payment', $payment);
    }

    public function shipping(Request $request, Payment $payment)
    {
        $config = Config::first();
        if($request->origin == null || $request->destination == null) {
            return false;
        }
        $couriers = [];
        if($config->pos) {
            $couriers[] = 'pos';
        }
        if($config->jne) {
            $couriers[] = 'jne';
        }
        if($config->tiki) {
            $couriers[] = 'tiki';
        }
        // default couriers jne
        if(!$config->pos && !$config->jne && !$config->tiki) {
            $couriers[] = 'jne';
        }
        foreach($couriers as $courier) {
            $response = Http::withHeaders([
                'content-type' => 'application/x-www-form-urlencoded',
                'key' => env('RAJAONGKIR_API_KEY')
                ])->asForm()->post('https://api.rajaongkir.com/starter/cost', [
                    'origin' => $request->origin,
                    'destination' => $request->destination,
                    'weight' => $request->weight > 0 ? $request->weight : 1,
                    'courier' => $courier,
                ]);
            // return response()->json(json_decode($response->body()));
            $results[] = json_decode($response->body())->rajaongkir->results;
        }
        $result = $results[0];
        $origin_details = json_decode($response->body())->rajaongkir->origin_details;
        $destination_details = json_decode($response->body())->rajaongkir->destination_details;
        $courier_code = $result[0]->code ?? '';
        $courier_name = $result[0]->name ?? '';
        $service = $result[0]->costs[0]->service ?? '';
        $description = $result[0]->costs[0]->description ?? '';
        $cost = $result[0]->costs[0]->cost[0]->value ?? 0;
        $etd = $result[0]->costs[0]->cost[0]->etd ?? 0;

        $payment->shipping_cost = $cost;
        $payment->save();

        $shipping = [
            'origin_details' => $origin_details,
            'destination_details' => $destination_details,
            'courier_code' => $courier_code,
            'courier_name' => $courier_name,
            'service' => $service,
            'description' => $description,
            'cost' => $cost,
            'etd' => $etd,
            'total' => $payment->grand_total,
            'insurance' => $payment->insurance
        ];
        
        // dd($results);
        // $cart = session()->get('cart');
        // $cart['summary'] = $this->summary($cart, $cost);
        // $cart['summary']['shipping'] = [
        //     'origin_details' => $origin_details,
        //     'destination_details' => $destination_details,
        //     'courier_code' => $courier_code,
        //     'courier_name' => $courier_name,
        //     'service' => $service,
        //     'description' => $description,
        //     'cost' => $cost,
        //     'etd' => $etd,
        // ];
        // session()->put('cart', $cart);

        // $cart['message'] = 'Cart updated successfully';
        // $cart['type'] = 'success';
        return response()->json(['results' => $results, 'shipping' => $shipping]);
        // return response()->json(['results' => $results, 'cart' => $cart]);
        // return $results;
    }

    public function changeShipping(Request $request, Payment $payment)
    {
        // $cart = session()->get('cart');
        // return response()->json([$cart, $request->all()]);
        // $origin_details = $cart['summary']['shipping']['origin_details'];
        // $destination_details = $cart['summary']['shipping']['destination_details'];
        // $cart['summary'] = $this->summary($cart, $request->cost);
        $payment->shipping_cost = $request->cost;
        $payment->save();

        $shipping = [
            // 'origin_details' => $origin_details,
            // 'destination_details' => $destination_details,
            'courier_code' => $request->code,
            'courier_name' => $request->name,
            'service' => $request->service,
            'description' => $request->description,
            'cost' => $request->cost,
            'etd' => $request->etd,
            'total' => $payment->grand_total,
            'insurance' => $payment->insurance
        ];
        // session()->put('cart', $cart);

        $notify['message'] = 'Cart updated successfully';
        $notify['type'] = 'success';
        return response()->json(['shipping' => $shipping, 'notify' => $notify]);
    }
}
