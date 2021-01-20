<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop.index');
    }

    public function single()
    {
        return view('shop.single');
    }

    public function singleAjax()
    {
        return view('shop.single-ajax');
    }

    public function cart(Request $request)
    {
        $cart = $request->cart ?? $request->keys()[0] ?? false;
        return view('shop.cart', compact('cart'));
    }

    public function checkout(Request $request)
    {
        $checkout = $request->checkout ?? $request->keys()[0] ?? false;
        return view('shop.checkout', compact('checkout'));
    }
}
