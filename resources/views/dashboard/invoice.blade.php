@extends('layouts.master')

@push('styles')
<style>
    #print-page {
        position: relative;
    }

    .watermark {
        background-image: url("{{ asset($config->logo) }}");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 50%;
        opacity: 0.05;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        display: none;
    }

    @media print {
        .watermark {
            display: block;
        }
    }
</style>
@endpush

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
                <button class="btn btn-danger" data-target="#modal-cancel" data-toggle="modal">Cancel Order</button>
                @if($payment->balance > 0 || $payment->status != 3)
                    <a href="{{ route('checkout.index', $payment) }}" class="btn btn-primary"><i class="icon-send"></i> Pay</a>
                @endif
                <button class="btn btn-outline" onclick="printPage('Invoice #{{ $payment->invoiceno }}')"><i class="icon-printer"></i> Print</button>
            </span>
        </div>
        @if($payment->status != null)
        <!-- <div class="watermark">
            <img src="{{ asset($config->logo) }}" alt="watermark logo">
        </div> -->
        <div class="card" id="print-page">
            <div class="watermark"></div>
            <div class="card-header">
                <div class="d-flex justify-content-between mb-3">
                    <img src="{{ asset($config->logo) }}" alt="" height="120px"> <br>
                    <h3 class="align-self-center">Invoice #{{ $payment->transactionno }}</h3>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <!-- Office 149, 450 South Brand Brooklyn <br>
                        San Diego County, CA 91905, USA <br>
                        +1 (123) 456 7891, +44 (876) 543 2198 -->
                        Status: <span class="badge badge-pill badge-{{ $payment->status_desc['color'] }}">{{ strtoupper($payment->status_desc['text']) }}</span>
                    </div>
                    <div>
                        Date Issued: {{ $payment->invoice_date_format }} <br>
                        Due Date: {{ $payment->invoice_duedate_format }}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5">
                    <div>
                        <h5 class="card-title">Invoice To:</h5>
                        <strong>{{ $user->fullname }}</strong> <br>
                        <!-- Shelby Company Limited <br> -->
                        {{ $user->address_line }} <br>
                        {{ $user->email }} <br>
                        {{ $user->nohp }} <br>
                    </div>
                    <div>
                        <h5 class="card-title">Payment Details:</h5>
                        <!-- Total Due: <strong>Rp1.000.000</strong> -->
                        <strong>{{ $config->title }}</strong> <br>
                        {{ $config->address }} <br>
                        {{ $config->email }} <br>
                        {{ $config->telp }} <br>
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
                            @foreach($payment->transactions as $transaction)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $transaction->itemname }}</td>
                                <td>{{ $transaction->price_format }}</td>
                                <td>{{ $transaction->quantity }}</td>
                                <td>{{ $transaction->total_format }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mb-5">
                    <div>
                        <div class="d-flex justify-content-between">
                            <span class="mr-1">Subtotal:</span>
                            <span class="">{{ $payment->subtotal_format }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="mr-1">Shipping:</span>
                            <span class="">{{ $payment->shipping_cost_format }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="mr-1">Discount:</span>
                            <span class="">-{{ $payment->discount > 0 ? $payment->discount_format : '' }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="mr-1">Grand Total:</strong>
                            <span class="">{{ $payment->total_format }}</span>
                        </div>
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
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payment->paymentProofs as $proof)
                            <tr>
                                <td>{{ $proof->date_format }}</td>
                                <td>{{ $payment->merchant->name }}</td>
                                <td>{{ $payment->transactionpaymentref }}</td>
                                <td>{{ $proof->total_format }}</td>
                                <td><span class="badge badge-pill badge-{{ $proof->status_desc['color'] }}">{{ $proof->status_desc['text'] }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No related transaction found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mb-5">
                    <div class="d-flex justify-content-between">
                        <strong class="mr-1">Balance:</strong>
                        <span class="">{{ $payment->balance_format }}</span> <br>
                    </div>
                </div>
                <!-- <p class="card-text">With supporting text below as a natural lead-in to
                    additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a> -->
            </div>
            <div class="card-footer text-muted">
                <strong>Note:</strong> It was a pleasure working with you. We hope you will keep us in mind. Thank You!
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
            <a href="{{ route('checkout.index', $payment) }}" class="btn icon-left m-r-10"><span>Proceed to Payment</span></a>
            <a class="btn icon-left" href="{{ route('dashboard.order') }}"><span>Go To Order History</span></a>
        </div>
        @endif
    </div>
</section>
<!-- end: Page Content -->

<!--Modal -->
<div class="modal fade" id="modal-cancel" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h4 class="modal-title" id="modal-label">Cancel Order</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <h2 class="mr-3"><i class="fa fa-exclamation-triangle text-danger"></i></h2>
                        <h5>Are you sure want to cancel this order?</h5>
                        <form method="POST" action="{{ route('dashboard.cancelOrder', $payment) }}" id="form-cancel-order" class="d-none" onsubmit="onSubmitButton('#button-cancel')">
                            @csrf
                            @method('PUT')
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-b btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-b btn-danger" id="button-cancel" form="form-cancel-order">
                    <span class="spinner-border spinner-border-sm button-spinner" role="status" aria-hidden="true" style="display: none;"></span>
                    <span class="btn-text">Cancel Order</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- end: Modal -->
@endsection