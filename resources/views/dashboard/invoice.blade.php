@extends('layouts.master')

@section('content')
<!-- Page title -->
<!-- <section id="page-title" class="page-title-center text-light" style="background-image:url({{ asset('polo-5/images/parallax/2.jpg') }});">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="page-title">
            <span class="post-meta-category"><a href="">Tutoya</a></span>
            <h1>Welcome {{ auth()->user()->name }}</h1>
            <div class="small m-b-20">{{ date('d F Y') }} | <a href="#">{{ date('H:i:s') }}</a></div>
        </div>
    </div>
</section> -->
<!-- end: Page title -->
<!-- Page Content -->
<section id="page-content" class="">
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('dashboard.order') }}" class="btn btn-secondary"><i class="icon-chevron-left"></i> Back</a>
            <span>
                @if($order->balance > 0)
                    <a href="{{ route('checkout.index', $order) }}" class="btn btn-primary"><i class="icon-send"></i> Pay</a>
                @endif
                <button class="btn btn-outline" onclick="printPage('Invoice #{{ $order->invoiceno }}')"><i class="icon-printer"></i> Print</button>
            </span>
        </div>
        @if($order->orderstatus != null)
        <div class="card" id="print-page">
            <div class="card-header">
                <div class="d-flex justify-content-between mb-3">
                    <img src="{{ asset($config->logo) }}" alt="" height="120px"> <br>
                    <h3 class="align-self-center">Invoice #{{ $order->invoiceno }}</h3>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <!-- Office 149, 450 South Brand Brooklyn <br>
                        San Diego County, CA 91905, USA <br>
                        +1 (123) 456 7891, +44 (876) 543 2198 -->
                        Status: <span class="badge badge-warning">Belum Lunas</span>
                    </div>
                    <div>
                        Date Issued: {{ $order->orderdate_format }} <br>
                        Due Date: {{ $order->duedate_format }}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5">
                    <div>
                        <h5 class="card-title">Invoice To:</h5>
                        <strong>{{ $user->fullname }}</strong> <br>
                        <!-- Shelby Company Limited <br> -->
                        {{ $user->city }}, {{ $user->province }} {{ $user->postcode }} <br>
                        {{ $user->email }} <br>
                        {{ $user->nohp }} <br>
                    </div>
                    <div>
                        <h5 class="card-title">Payment Details:</h5>
                        <!-- Total Due: <strong>Rp1.000.000</strong> -->
                        <strong>{{ $distributor->name }}</strong> <br>
                        {{ $distributor->address }} <br>
                        {{ $distributor->email }} <br>
                        {{ $distributor->telp }} <br>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->suborders as $suborder)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $suborder->product->title }}</td>
                                <td>{{ $suborder->price_format }}</td>
                                <td>{{ $suborder->qty }}</td>
                                <td>{{ $suborder->total_format }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mb-5">
                    <div>
                        Subtotal: <span class="align-selft-end">{{ $order->subtotal_format }}</span> <br>
                        Discount: <span class="align-selft-end">{{ $order->coupon }}%</span> <br>
                        <hr>
                        <strong>Grand Total:</strong> <span class="align-selft-end">{{ $order->total_format }}</span> <br>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Transaction Date</th>
                                <th scope="col">Gateway</th>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->payments as $payment)
                            <tr>
                                <td>{{ $payment->date_format }}</td>
                                <td>{{ $payment->merchant->name }}</td>
                                <td>{{ $payment->transactionpaymentref }}</td>
                                <td>{{ $payment->total_format }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mb-5">
                    <div>
                        <strong>Balance:</strong> <span class="align-selft-end">{{ $order->balance_format }}</span> <br>
                    </div>
                </div>
                <!-- <p class="card-text">With supporting text below as a natural lead-in to
                    additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a> -->
            </div>
            <div class="card-footer text-muted">
                <strong>Note:</strong> It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!
            </div>
        </div>
        @else
        <div role="alert" class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
            <strong><i class="fa fa-info-circle"></i> Info!</strong> Please proceed to payment.
        </div>
        <div class="p-t-10 m-b-20 text-center">
            <div class="text-center">
                <h3>Congratulations! Your order is completed!</h3>
                <p>Your order is number #123456. You can
                    <a href="{{ route('dashboard.order') }}" class="text-underline">
                        <mark>view your order</mark>
                    </a> on your account page, when you are logged in.</p>
            </div>
            <a href="{{ route('checkout.index', $order) }}" class="btn icon-left m-r-10"><span>Proceed to Payment</span></a>
            <a class="btn icon-left" href="{{ route('dashboard.order') }}"><span>Go To Order History</span></a>
        </div>
        @endif
    </div>
</section>
<!-- end: Page Content -->
@endsection