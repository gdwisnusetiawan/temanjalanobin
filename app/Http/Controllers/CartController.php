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
    protected function summary($cart, $shipping = 0, $coupon = 0)
    {
        $total = collect($cart['list'])->sum('total');
        $total_quantity = collect($cart['list'])->sum('quantity');
        $grand_total = $total - round($total * $coupon / 100, 2) + $shipping;
        return [
            'subtotal' => $total,
            'coupon' => $coupon,
            'shipping' => $shipping,
            'total' => $grand_total,
            'total_quantity' => $total_quantity
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
        $city_json = asset('data/city.json');
        $cities = json_decode(file_get_contents($city_json), true)['rajaongkir']['results'];
        // dd($cities);
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
            'total' => $price * $quantity
        ];

        foreach($product->variants as $variant) {
            $cart['list'][$product->id]['variants'][$variant->input_name] = $request->get($variant->input_name);
        }

        $cart['summary'] = $this->summary($cart);
        session()->put('cart', $cart);
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
            $price = Product::find($id)->getUserPrice($request->quantity);
            $cart['list'][$id]['price'] = $price;
            $cart['list'][$id]['quantity'] = $request->quantity;
            $cart['list'][$id]['total'] = $price * $request->quantity;
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
        // dd($request->all());
        $response = Http::withHeaders([
            'content-type' => 'application/x-www-form-urlencoded',
            'key' => 'a668420368d4731d3ca94321058bcea2'
            ])->asForm()->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $request->origin,
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => 'pos',
                'courier' => 'jne',
            ]);
        $result = json_decode($response->body())->rajaongkir->results;
        $shipping = $result[0]->costs[0]->cost[0]->value ?? 0;
        // dd(($shipping));
        $cart = session()->get('cart');

        $cart['summary'] = $this->summary($cart, $shipping);
        session()->put('cart', $cart);

        $cart['message'] = 'Cart updated successfully';
        $cart['type'] = 'success';
        return response()->json(['result' => $result, 'cart' => $cart]);
    }

    public function changeShipping(Request $request)
    {
        $cart = session()->get('cart');

        $cart['summary'] = $this->summary($cart, $request->shipping);
        session()->put('cart', $cart);

        $cart['message'] = 'Cart updated successfully';
        $cart['type'] = 'success';
        return response()->json($cart);
    }
}
