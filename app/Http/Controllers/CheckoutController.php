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
    public function index(Payment $payment)
    {
        $user = $payment->user;
        $merchants = Merchant::all();
        if($payment->paymentProofs->count() > 0) {
            return redirect()->route('dashboard.payment', $payment);
        }
        // dd($payment);
        return view('shop.checkout', compact('payment', 'user', 'merchants'));
    }

    public function store()
    {
        $cart = session()->get('cart');
        $key = sha1(time());
        $invoiceno = time();

        $summary = $cart['summary'];

        $last_payment = Payment::orderBy('insertid', 'desc')->first() ?? 0;

        $payment = new Payment();
        $payment->user()->associate(auth()->user());
        // $payment->merchant()->associate($request->payment_merchant);
        $payment->transactionno = $invoiceno;
        $payment->transactionmount = 0;
        $payment->transactiondate = Carbon::now();
        $payment->transactionexpire = Carbon::now()->addDays(7);
        $payment->subtotal = $summary['subtotal'];
        $payment->shipping_cost = $summary['shipping']['cost'];
        $payment->discount = $summary['total_discount'];
        // status: pending
        $payment->status = 1;
        $payment->insertid = $last_payment->insertid + 1;
        $payment->currency = 'IDR';
        $payment->save();

        foreach($cart['list'] as $cart)
        {
            $product = $cart['product'];
            $transaction = new Transaction();
            $transaction->payment()->associate($payment);
            $transaction->transactionno = $payment->transactionno;
            $transaction->product()->associate($product->id);
            $transaction->itemname = $product->title;
            $transaction->quantity = $product->qty;
            $transaction->price = $product->price;
            $transaction->save();
        }
        session()->forget('cart');
        return redirect()->route('checkout.index', $payment);
    }

    public function update(Request $request, Payment $payment)
    {
        // $payment->user()->associate(auth()->user());
        $payment->merchant()->associate($request->payment_merchant);
        // $payment->transactionno = $invoiceno;
        // $payment->transactionmount = $payment->transactionmount;
        // $payment->transactiondate = Carbon::now();
        // $payment->transactionexpire = Carbon::now()->addDays(7);
        // $payment->shipping_cost = 0;
        // // status: pending
        // $payment->status = 1;
        // $payment->insertid = $last_payment->insertid + 1;
        // $payment->currency = 'IDR';
        $payment->save();

        // foreach($order->suborders as $suborder) {
        //     $transaction = new Transaction();
        //     $transaction->payment()->associate($payment);
        //     $transaction->order()->associate($order);
        //     $transaction->product()->associate($suborder->product);
        //     $transaction->itemname = $suborder->product->title;
        //     $transaction->quantity = $suborder->product->qty;
        //     $transaction->price = $suborder->product->price;
        //     $transaction->save();
        // }

        return redirect()->route('dashboard.payment', $payment);
    }
}
