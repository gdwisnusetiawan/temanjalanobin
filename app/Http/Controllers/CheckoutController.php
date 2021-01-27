<?php

namespace App\Http\Controllers;

use App\Order;
use App\Suborder;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Order $order)
    {
        return view('shop.checkout', compact('order'));
    }

    public function store()
    {
        $cart = session()->get('cart');
        $key = sha1(time());
        $invoiceno = time();

        $summary = $cart['summary'];
        $order = new Order();
        $order->orderdate = Carbon::now();
        $order->duedate = Carbon::now()->addDays(7);
        $order->invoiceno = $invoiceno;
        $order->price = $summary['subtotal'];
        $order->orderstatus = 1;
        $order->coupon = $summary['coupon'];
        $order->discount = $summary['subtotal'] * $summary['coupon'] / 100;
        $order->key = $key;
        $order->uid = auth()->user()->id;
        $order->save();

        foreach($cart['list'] as $cart)
        {
            $product = $cart['product'];
            $suborder = new Suborder();
            $suborder->invoiceno = $invoiceno;
            $suborder->pcode = $product->id;
            $suborder->price = $product->price;
            $suborder->qty = $cart['quantity'];
            $suborder->key = $key;
            $suborder->save();
        }
        session()->forget('cart');
        return redirect()->route('checkout.index', $order);
    }
}
