<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\PaymentProof;
use Carbon\Carbon;
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

    public function confirmPayment(Request $request, Payment $payment)
    {
        // dd($request->all());
        $payment_proof = new PaymentProof();
        $payment_proof->payment()->associate($payment);
        $payment_proof->payment_date = Carbon::parse($request->payment_date)->format('Y-m-d H:i:s');
        $payment_proof->transfer_amount = $request->transfer_amount;
        $payment_proof->sender_account = $request->sender_account;
        // upload file if exists
        if($request->has('file'))
        {
            // delete old file
            // unlink(asset($user->ktpfile));
            // save new file
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file_location = $file->move('img/payment/', $file_name);
            $payment_proof->proof = $file_location;
            $payment_proof->save();
        }
        else
        {
            return response()->json(['error' => 'Please upload a file']);
        }
        return response()->json(['notify' => 'Confirmation has been sent']);
    }

    public function uploadPaymentProof(Request $request, Payment $payment)
    {
        // upload file if exists
        if($request->has('file'))
        {
            // delete old file
            // unlink(asset($user->ktpfile));
            // save new file
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            // $file_location = $file->move('img/payment/', $file_name);
            // $user->ktpfile = $file_location;
            // dd($file);
        }
        else {
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            // $file_name = 'empty';
        }
        return response()->json($request->payment_date);
    }

    public function deletePaymentProof(Request $request, Payment $payment)
    {
        if($request->has('payment_file') && $request->file('payment_file') != null)
        {
            $file = $request->file('payment_file');
            $file_name = $file->getClientOriginalName();
            unlink(asset('img/payment/'.$file_name));
        }
    }
}
