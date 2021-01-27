<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->session()->get('cart'));
        // session()->forget('cart');
        return view('shop.cart');
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
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if(!$cart) {
            $cart['list'] = [
                    $product->id => [
                        "product" => $product,
                        "quantity" => $request->quantity,
                        "total" => $product->price * $request->quantity
                    ]
            ];
            $total = collect($cart['list'])->sum('total');
            $cart['summary'] = [
                "subtotal" => $total,
                "coupon" => 20,
                "total" => $total - round($total * 20 / 100, 2)
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('notify', ['message' => 'Product added to cart successfully', 'type' => 'success']);
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('notify', ['message' => 'Product added to cart successfully', 'type' => 'success']);
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart['list'][$product->id] = [
            "product" => $product,
            "quantity" => $request->quantity,
            "total" => $product->price * $request->quantity
        ];
        $total = collect($cart['list'])->sum('total');
        $cart['summary'] = [
            "subtotal" => $total,
            "coupon" => 20,
            "total" => $total - round($total * 20 / 100, 2)
        ];
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
            $cart['list'][$id]['quantity'] = $request->quantity;
            $cart['list'][$id]['total'] = $cart['list'][$id]['product']->price * $request->quantity;
            session()->put('cart', $cart);
        }
        $total = collect($cart['list'])->sum('total');
        $cart['summary'] = [
            "subtotal" => $total,
            "coupun" => 20,
            "total" => $total - round($total * 20 / 100, 2)
        ];
        session()->flash('success', 'Cart updated successfully');
        return response()->json($data);
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
            session()->put('cart', $cart);
        }
        session()->flash('success', 'Product removed successfully');
    }
}
