<?php

namespace App\Http\Controllers;

use App\Product;
use App\Suborder;
use App\Order;
use App\Helpers\Functions;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected function summary($cart)
    {
        $total = collect($cart['list'])->sum('total');
        $total_quantity = collect($cart['list'])->sum('quantity');
        return [
            'subtotal' => $total,
            'coupon' => 20,
            'total' => $total - round($total * 20 / 100, 2),
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
        
        $cart['list'][$product->id] = [
            'product' => $product,
            'price' => $price,
            'quantity' => $request->quantity,
            'total' => $price * $request->quantity
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

        $cart['id'] = $id;
        $cart['message'] = 'Product removed successfully';
        $cart['type'] = 'success';
        return response()->json($cart);
    }
}
