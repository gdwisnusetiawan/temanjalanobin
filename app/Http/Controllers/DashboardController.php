<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function welcome()
    {
        return view('dashboard.welcome');
    }

    public function order()
    {
        $orders = auth()->user()->orders;
        return view('dashboard.order', compact('orders'));
    }

    public function invoice(Order $order)
    {
        $user = $order->user;
        $distributor = $order->suborders->first()->product->distributor;
        return view('dashboard.invoice', compact('order', 'user', 'distributor'));
    }

    public function payment(Payment $payment)
    {
        $user = $payment->user;
        $merchant = $payment->merchant;
        // $distributor = $order->suborders->first()->product->distributor;
        return view('dashboard.payment', compact('payment', 'user', 'merchant'));
    }
}
