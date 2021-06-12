<?php

namespace App\Http\Controllers;

use App\Product;
use App\Suborder;
use App\Order;
use App\Helpers\Functions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected function summary($cart, $shipping_cost = 0, $coupon = 0)
    {
        $total = collect($cart['list'])->sum('total');
        $total_quantity = collect($cart['list'])->sum('quantity');
        $total_discount = collect($cart['list'])->sum('discount');
        $total_weight = collect($cart['list'])->sum('weight');
        $grand_total = $total - $total_discount + $shipping_cost;
        return [
            'subtotal' => $total,
            'coupon' => $coupon,
            'total' => $grand_total,
            'total_quantity' => $total_quantity,
            'total_discount' => $total_discount,
            'total_weight' => $total_weight,
            // 'subtotal_format' => Functions::currencyConvert($total),
            // 'total_format' => Functions::currencyConvert($grand_total),
            // 'shipping' => array_key_exists('summary', $cart) ? $cart['summary']['shipping'] : null
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // session()->forget('cart');
        // dd(session()->get('cart'));
        // $city_json = asset('data/city.json');
        // $cities = json_decode(file_get_contents($city_json), true)['rajaongkir']['results'];
        $cities = [];

        return view('shop.cart', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        $price = $product->getUserPrice($request->quantity);
        // set price back to real price without discount
        if($product->discount > 0) {
            $price = $price + $product->discount;
        }
        $cart = session()->get('cart');
        
        if(!isset($cart['list'][$product->id])) {
            $quantity = $request->quantity;
        }
        else {
            $quantity = $cart['list'][$product->id]['quantity'] + $request->quantity;
        }
        $cart['list'][$product->id] = [
            'product' => $product,
            'price' => $price,
            'quantity' => $quantity,
            'total' => $price * $quantity,
            'discount' => $product->discount * $quantity,
            'weight' => $product->gram * $quantity,
            'shipping' => null,
        ];

        foreach($product->variants as $variant) {
            $cart['list'][$product->id]['variants'][$variant->input_name] = $request->get($variant->input_name);
        }

        // $discount = 0;
        // if($product->discount_value != null) {
        //     $discount = $product->discount_value;
        // }
        // elseif($product->discount_percent != null) {
        //     $discount = $product->discount_percent;
        // }
        $cart['summary'] = $this->summary($cart);
        session()->put('cart', $cart);
        if($request->has('book_now')) {
            $payment = Functions::storeCheckout();
            return redirect()->route('checkout.index', $payment);
        }
        return redirect()->back()->with('notify', ['message' => 'Product added to cart successfully', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
 
        $cart = session()->get('cart');
        if(isset($cart['list'][$id])) {
            $product = Product::find($id);
            $price = $product->getUserPrice($request->quantity);
            if($product->discount > 0) {
                $price = $price + $product->discount;
            }
            $cart['list'][$id]['price'] = $price;
            $cart['list'][$id]['quantity'] = $request->quantity;
            $cart['list'][$id]['total'] = $price * $request->quantity;
            $cart['list'][$id]['discount'] = $product->discount * $request->quantity;
            $cart['list'][$id]['weight'] = $product->gram * $request->quantity;
        }

        $cart['summary'] = $this->summary($cart);
        session()->put('cart', $cart);

        $cart['message'] = 'Cart updated successfully';
        $cart['type'] = 'success';
        return response()->json($cart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = session()->get('cart');
        if(isset($cart['list'][$id])) {
            unset($cart['list'][$id]);

            $cart['summary'] = $this->summary($cart);
            session()->put('cart', $cart);
        }
        $total_quantity = 0;
        foreach($cart['list'] as $product) {
            $total_quantity += $product['quantity'];
        }
        if(count($cart['list']) <= 0) {
            session()->forget('cart');
        }
        
        $cart['total_quantity'] = $total_quantity;
        $cart['id'] = $id;
        $cart['message'] = 'Product removed successfully';
        $cart['type'] = 'success';
        return response()->json($cart);
    }

    public function shipping(Request $request)
    {
        // return response()->json($request->all());
        if($request->origin == null && $request->destination == null) {
            return false;
        }
        $couriers = ['pos','jne','tiki'];
        foreach($couriers as $courier) {
            $response = Http::withHeaders([
                'content-type' => 'application/x-www-form-urlencoded',
                'key' => 'a668420368d4731d3ca94321058bcea2'
                ])->asForm()->post('https://api.rajaongkir.com/starter/cost', [
                    'origin' => $request->origin,
                    'destination' => $request->destination,
                    'weight' => $request->weight,
                    'courier' => $courier,
                ]);
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
        $cart = session()->get('cart');

        $cart['summary'] = $this->summary($cart, $cost);
        $cart['summary']['shipping'] = [
            'origin_details' => $origin_details,
            'destination_details' => $destination_details,
            'courier_code' => $courier_code,
            'courier_name' => $courier_name,
            'service' => $service,
            'description' => $description,
            'cost' => $cost,
            'etd' => $etd,
        ];
        session()->put('cart', $cart);

        $cart['message'] = 'Cart updated successfully';
        $cart['type'] = 'success';
        return response()->json(['results' => $results, 'cart' => $cart]);
    }

    public function changeShipping(Request $request)
    {
        $cart = session()->get('cart');
        // return response()->json([$cart, $request->all()]);
        $origin_details = $cart['summary']['shipping']['origin_details'];
        $destination_details = $cart['summary']['shipping']['destination_details'];
        $cart['summary'] = $this->summary($cart, $request->cost);
        $cart['summary']['shipping'] = [
            'origin_details' => $origin_details,
            'destination_details' => $destination_details,
            'courier_code' => $request->code,
            'courier_name' => $request->name,
            'service' => $request->service,
            'description' => $request->description,
            'cost' => $request->cost,
            'etd' => $request->etd,
        ];
        session()->put('cart', $cart);

        $cart['message'] = 'Cart updated successfully';
        $cart['type'] = 'success';
        return response()->json($cart);
    }
}
