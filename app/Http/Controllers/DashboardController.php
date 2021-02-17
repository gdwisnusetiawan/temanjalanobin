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
        $payments = auth()->user()->payments;
        return view('dashboard.order', compact('payments'));
    }

    public function invoice(Payment $payment)
    {
        $user = $payment->user;
        $payments = Payment::where('transactionno', $payment->transactionno)->where('status', 3)->get();
        return view('dashboard.invoice', compact('payment', 'payments', 'user'));
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
        $payment_proof = new PaymentProof();
        $payment_proof->payment()->associate($payment);
        $payment_proof->payment_date = Carbon::parse($request->payment_date)->format('Y-m-d H:i:s');
        $payment_proof->transfer_amount = $request->transfer_amount;
        $payment_proof->sender_account = $request->sender_account;
        $payment_proof->status = 1;
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

            // status: wait for confirmation
            $payment->status = 2; 
            $payment->save();
        }
        else
        {
            return response()->json(['error' => 'Please upload a file']);
        }
        return response()->json(['notify' => 'Confirmation has been sent']);
    }

    public function cancelPayment(Payment $payment)
    {
        // status: cancel
        $payment->status = 4;
        $payment->save();
        request()->session()->flash('notify', ['message' => 'You canceled the payment', 'type' => 'success']);
        return redirect()->route('dashboard.payment', $payment);
    }

    public function cancelOrder(Order $order)
    {
        // status: cancel
        $order->orderstatus = 4;
        $order->save();
        request()->session()->flash('notify', ['message' => 'You canceled the order', 'type' => 'success']);
        return redirect()->route('dashboard.invoice', $order);
    }
}
