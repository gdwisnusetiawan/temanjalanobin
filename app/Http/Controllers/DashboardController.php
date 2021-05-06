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

    public function changePaymentStatus(Request $request, Payment $payment)
    {
        $payment->merchant()->associate($request->payment_merchant);
        $payment->status = $request->status;
        $payment->save();
        $message = 'Success';
        $type = 'success';
        if($request->status == 2) {
            $message = 'Your confirmation has been sent';
        }
        if($request->status == 3) {
            $payment_proof = new PaymentProof();
            $payment_proof->payment()->associate($payment);
            $payment_proof->payment_date = Carbon::now()->format('Y-m-d H:i:s');
            $payment_proof->transfer_amount = $request->transfer_amount;
            $payment_proof->sender_account = $request->sender_account;
            $payment_proof->status = $request->status;
            $payment_proof->save();
            $message = 'Your payment has been sent';
        }
        if($request->status == 4) {
            $message = 'Your payment has been canceled';
        }
        // request()->session()->flash('notify', ['message' => $message, 'type' => $type]);
        // return redirect()->route('dashboard.payment', $payment);
        return response()->json(['notify' => ['message' => $message, 'type' => $type]]);
    }

    public function changeAddress(Request $request, Payment $payment)
    {
        $payment->address = $request->address;
        $payment->province = $request->province;
        $payment->city = $request->city;
        $payment->postcode = $request->postcode;
        $payment->country = $request->country;
        if($request->region == 'national') {
            $payment->country = null;
        }
        if($request->region == 'international') {
            $payment->province = null;
            $payment->city = null;
            $payment->postcode = null;
        }
        $payment->save();
        request()->session()->flash('notify', ['message' => 'You changed the address', 'type' => 'success']);
        return redirect()->route('checkout.index', $payment);
    }
}
