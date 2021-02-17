<?php

namespace App\Http\Controllers;

use App\Order;
use App\Suborder;
use App\Payment;
use App\Transaction;
use App\Merchant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Order $order)
    {
        $user = $order->user;
        $merchants = Merchant::all();
        // dd($merchants->split(2));
        return view('shop.checkout', compact('order', 'user', 'merchants'));
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
        $order->shipping_cost = $summary['shipping'];
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

    public function update(Request $request, Order $order)
    {
        $order->orderstatus = 2;
        $order->save();

        // $merchant = Merchant::first();
        $last_payment = Payment::orderBy('insertid', 'desc')->first();

        $payment = new Payment();
        $payment->user()->associate($order->user);
        $payment->merchant()->associate($request->payment_merchant);
        $payment->order()->associate($order);
        $payment->transactionmount = $order->price - $order->discount;
        $payment->transactiondate = Carbon::now();
        $payment->transactionexpire = Carbon::now()->addDays(7);
        // status: pending
        $payment->status = 1;
        $payment->insertid = $last_payment->insertid + 1;
        $payment->currency = 'rupiah';
        $payment->save();

        foreach($order->suborders as $suborder) {
            $transaction = new Transaction();
            $transaction->payment()->associate($payment);
            $transaction->order()->associate($order);
            $transaction->product()->associate($suborder->product);
            $transaction->itemname = $suborder->product->title;
            $transaction->quantity = $suborder->product->qty;
            $transaction->price = $suborder->product->price;
            $transaction->save();
        }

        return redirect()->route('dashboard.payment', $payment);
    }
}
