<?php

namespace App\Http\Controllers;

use App\Config;
use App\Order;
use App\Suborder;
use App\Payment;
use App\Transaction;
use App\Merchant;
use App\Currency;
use App\Mail\Ordered;
use Carbon\Carbon;
use App\Helpers\Functions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Payment $payment)
    {
        $user = $payment->user;
        $merchants = Merchant::all();
        if($payment->paymentProofs->count() > 0 || $payment->merchant != null) {
            return redirect()->route('dashboard.payment', $payment);
        }
        
        foreach($merchants as $item){
            if($item->name == "Paypal"){
                $path = base_path('.env');
                $value="https://www.paypal.com/sdk/js?client-id=".$item->merchantid."&disable-funding=credit,card";
                if(env("PAYPAL_CLIENT")===null){
                    $old = 'null';
                }
                else{
                    $old = env("PAYPAL_CLIENT");
                }
                if (file_exists($path)) {
                    file_put_contents($path, str_replace(
                        "PAYPAL_CLIENT=".$old, "PAYPAL_CLIENT=".$value, file_get_contents($path)
                    ));
                }
                break;
            }
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
        $config = Config::first();
        $summary = $cart['summary'];

        $last_payment = Payment::orderBy('insertid', 'desc')->first();
        $payment = new Payment();
        $payment->user()->associate(auth()->user());
        // $payment->merchant()->associate($request->payment_merchant);
        $payment->transactionno = $invoiceno;
        $payment->transactionmount = $summary['subtotal'];
        $payment->transactiondate = Carbon::now();
        $payment->transactionexpire = Carbon::now()->addHours($config->payment_expiration ?? 1);
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
        $payment->country = auth()->user()->country;
        $payment->save();

        foreach($cart['list'] as $cart)
        {
            $product = $cart['product'];
            $variants = $cart['variants'] ?? [];
            $transaction = new Transaction();
            $transaction->payment()->associate($payment);
            $transaction->transactionno = $payment->transactionno;
            $transaction->product()->associate($product->id);
            $transaction->itemname = $product->title;
            $transaction->quantity = $cart['quantity'];
            $transaction->price = $product->price;
            $variant_string = '';
            foreach($variants as $group => $variant) {
                $variant_string .= $group .' : '. ucfirst($variant). ',';
            }
            $variant_string = rtrim($variant_string, ',');
            $transaction->variants = $variant_string;
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
        $config = Config::first();
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
        if(!$payment->national()) {
            $couriers = ['pos', 'slis', 'expedito'];
        }
        foreach($couriers as $courier) {
            if($payment->national()) {
                $url = env('RAJAONGKIR_API_URL').'/cost';
                $data = [
                    'origin' => $request->origin,
                    'originType' => 'city',
                    'destination' => $request->destination,
                    'destinationType' => 'city',
                    'weight' => $request->weight > 0 ? $request->weight : 1,
                    'courier' => $courier,
                ];
            }
            else {
                $url = env('RAJAONGKIR_API_URL_V2').'/internationalCost';
                $data = [
                    'origin' => $request->origin,
                    'destination' => $request->destination,
                    'weight' => $request->weight > 0 ? $request->weight : 1,
                    'courier' => $courier,
                ];
            }
            $response = Http::withHeaders([
                'content-type' => 'application/x-www-form-urlencoded',
                'key' => env('RAJAONGKIR_API_KEY')
                ])->asForm()->post($url, $data);
                // return response()->json(['results' => json_decode($response->body())->rajaongkir]);
            $results[] = json_decode($response->body())->rajaongkir->results;
        }
        $result = $results[0];
        $origin_details = json_decode($response->body())->rajaongkir->origin_details;
        $destination_details = json_decode($response->body())->rajaongkir->destination_details;
        $courier_code = $result[0]->code ?? '';
        $courier_name = $result[0]->name ?? '';
        if($payment->national()) {
            $service = $result[0]->costs[0]->service ?? '';
            $description = $result[0]->costs[0]->description ?? '';
            $cost = $result[0]->costs[0]->cost[0]->value ?? 0;
            $etd = $result[0]->costs[0]->cost[0]->etd ?? 0;
        }
        else {
            $service = $result[0]->costs[0]->service ?? '';
            $description = '';
            $cost = $result[0]->costs[0]->cost ?? 0;
            $etd = $result[0]->costs[0]->etd ?? 0;
        }

        $payment->shipping_cost = round($cost/Currency::whereRaw("LOWER(symbol) like '%rp%'")->first()->rate);
        // $payment->shipping_vendor = $courier_code;
        // $payment->shipping_service = $service;
        $payment->save();

        $shipping = [
            'origin_details' => $origin_details,
            'destination_details' => $destination_details,
            'courier_code' => $courier_code,
            'courier_name' => $courier_name,
            'service' => $service,
            'description' => $description,
            'cost' => Functions::currencyConvert($cost, 'Rp'),
            'etd' => $etd,
            'total' => $payment->total_format,
            'grand_total' => $payment->grand_total,
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
        $payment->shipping_cost = round($request->cost/Currency::whereRaw("LOWER(symbol) like '%rp%'")->first()->rate);
        // $payment->shipping_vendor = $request->code;
        // $payment->shipping_service = $request->service;
        $payment->save();

        $shipping = [
            // 'origin_details' => $origin_details,
            // 'destination_details' => $destination_details,
            'courier_code' => $request->code,
            'courier_name' => $request->name,
            'service' => $request->service,
            'description' => $request->description,
            'cost' => Functions::currencyConvert($request->cost, 'Rp'),
            'etd' => $request->etd,
            'total' => $payment->total_format,
            'grand_total' => $payment->grand_total,
            'insurance' => $payment->insurance
        ];
        // session()->put('cart', $cart);

        $notify['message'] = 'Cart updated successfully';
        $notify['type'] = 'success';
        return response()->json(['shipping' => $shipping, 'notify' => $notify]);
    }
}
