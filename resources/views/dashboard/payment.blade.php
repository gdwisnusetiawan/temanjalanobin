@extends('layouts.master')

@section('content')
<!-- Page title -->
<!-- <section id="page-title">
    <div class="container">
        <div class="page-title">
            <h1>Checkout</h1>
            <span>Checkout details</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="{{ route('dashboard.order') }}">Transaction</a></li>
                <li class="active"><a href="#">Checkout</a></li>
            </ul>
        </div>
    </div>
</section> -->
<!-- end: Page title -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="p-t-10 m-b-20 text-center">
                    <h5>Complete payment in</h5>
                    <div class="countdown small" data-countdown="{{ $payment->transactionexpire }}"></div>
                    <p class="m-0">Due Date</p>
                    <h5>{{ $payment->expire_format }}</h5>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>{{ $merchant->name }} (Bank Transfer)</span>
                        @if($merchant->logo_url)
                        <img height="24" alt="merchant logo" src="{{ $merchant->logo_url }}">
                        @endif
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item flex-column align-items-start">
                                <p class="mb-1">Bank Owner</p>
                                <h5 class="mb-1">{{ $merchant->customeraccount }}</h5>
                            </li>
                            <li class="list-group-item">
                                <p class="mb-1">Bank Number</p>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-1" id="bank-number">{{ $merchant->customeraccount }}</h5>
                                    <a data-clipboard-target="#bank-number" class="btn btn-xs btn-outline">Copy</a>
                                </div>
                            </li>
                            <li class="list-group-item flex-column align-items-start">
                                <p class="mb-1">Total Payment</p>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-1">{{ $payment->total_format }}</h5>
                                    <h5 class="mb-1 d-none" id="total-payment">{{ $payment->transactionmount }}</h5>
                                    <span>
                                        <!-- <a class="btn btn-xs btn-outline">View Details</a> -->
                                        <a data-clipboard-target="#total-payment" class="btn btn-xs btn-outline">Copy</a>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="card-footer text-muted">
                        2 days ago
                    </div> -->
                </div>
                <div class="d-flex justify-content-end">
                    <!-- <a class="btn icon-left" href="{{ url('/') }}"><span>Check Payment Status</span></a> -->
                    <a class="btn btn-danger icon-left" href="{{ url('/') }}"><span>Cancel Payment</span></a>
                    <a class="btn icon-left" href="{{ url('/') }}"><span>Confirm Payment</span></a>
                </div>
                <!-- Accordion -->
                <h4>Payment Guide</h4>
                <div class="accordion">
                    <div class="ac-item">
                        <h5 class="ac-title">ATM</h5>
                        <div class="ac-content">
                            <ol class="mx-4">
                                <li>Lorem ipsum dolor sit amet.</li>
                                <li>Lorem ipsum dolor sit amet consectetur.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit, amet consectetur adipisicing.</li>
                                <li>Lorem ipsum dolor sit amet.</li>
                            </ol>
                        </div>
                    </div>
                    <div class="ac-item">
                        <h5 class="ac-title">Mobile Banking</h5>
                        <div class="ac-content">
                            <ol class="mx-4">
                                <li>Lorem ipsum dolor sit amet.</li>
                                <li>Lorem ipsum dolor sit amet consectetur.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit, amet consectetur adipisicing.</li>
                                <li>Lorem ipsum dolor sit amet.</li>
                            </ol>
                        </div>
                    </div>
                    <div class="ac-item">
                        <h5 class="ac-title">Internet Banking</h5>
                        <div class="ac-content">
                            <ol class="mx-4">
                                <li>Lorem ipsum dolor sit amet.</li>
                                <li>Lorem ipsum dolor sit amet consectetur.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit, amet consectetur adipisicing.</li>
                                <li>Lorem ipsum dolor sit amet.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end: Accordion -->
            </div>
        </div>
    </div>
</section>

<!-- DELIVERY INFO -->
<!-- @include('shop.delivery') -->
<!-- end: DELIVERY INFO -->
@endsection

@push('scripts')
<!--Clipboard plugin files-->
<script src="{{ asset('polo-5/plugins/clipboard/clipboard.min.js') }}"></script>
@endpush