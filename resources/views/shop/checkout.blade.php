@extends('layouts.master')

@section('content')
<!-- Page title -->
<section id="page-title">
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
</section>
<!-- end: Page title -->
@if($payment->status == 1)
<!-- SHOP CHECKOUT -->
<section id="shop-checkout">
    <div class="container">
        <div class="shop-cart">
            <!-- <form method="post" class="sep-top-md"> -->
                <div class="row">
                    <div class="col-lg-8 no-padding">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="upper">Billing & Shipping Address</h4>
                            </div>
                            <div class="col-lg-12">
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $user->fullname }}</h5>
                                        <h6 class="m-0">{{ $user->nohp }}</h6>
                                        <p class="card-text">{{ $payment->address_line }}</p>
                                        <button class="btn btn-light" data-target="#modal-address" data-toggle="modal">Different Address</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="upper">Your Order</h4>
                        <div class="table table-sm table-striped table-responsive table table-bordered table-responsive">
                            <table class="table m-b-0">
                                <thead>
                                    <tr>
                                        <th class="cart-product-thumbnail">Product</th>
                                        <!-- <th class="cart-product-name">Product</th> -->
                                        <th class="cart-product-name">Description</th>
                                        <th class="cart-product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payment->transactions as $transaction)
                                    <tr>
                                        <td class="cart-product-thumbnail">
                                            <div class="cart-product-thumbnail-name">{{ $transaction->itemname }}</div>
                                        </td>
                                        <!-- <td class="cart-product-name">
                                            <p>{{ $transaction->product->title }}</p>
                                        </td> -->
                                        <td class="cart-product-description">
                                            <p>{!! $transaction->product->description !!}</p>
                                        </td>
                                        <td class="cart-product-subtotal">
                                            <span class="amount">{{ $transaction->price_format }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <h4>Order Total</h4>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="cart-product-name">
                                                    <strong>Order Subtotal</strong>
                                                </td>
                                                <td class="cart-product-name text-right">
                                                    <span class="amount">{{ $payment->subtotal_format }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cart-product-name">
                                                    <strong>Shipping</strong>
                                                </td>
                                                <td class="cart-product-name text-right">
                                                    <span class="amount">{{ $payment->shipping_cost_format }}</span>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td class="cart-product-name">
                                                    <strong>Coupon</strong>
                                                </td>
                                                <td class="cart-product-name text-right">
                                                    <span class="amount">-{{ $payment->coupon }}%</span>
                                                </td>
                                            </tr> -->
                                            <tr>
                                                <td class="cart-product-name">
                                                    <strong>Discount</strong>
                                                </td>
                                                <td class="cart-product-name text-right">
                                                    <span class="amount">-{{ $payment->discount > 0 ? $payment->discount_format : '' }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="cart-product-name">
                                                    <strong>Total</strong>
                                                </td>
                                                <td class="cart-product-name text-right">
                                                    <span class="amount color lead"><strong>{{ $payment->total_format }}</strong></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            <!-- </form> -->
            <div class="seperator"><i class="fa fa-credit-card"></i></div>
            <h4 class="upper">Payment Method</h4>
            <div class="row">
                @foreach($merchants->split(2) as $chunks)
                <div class="col-lg-6">
                    <div class="list-group">
                        @foreach($chunks as $merchant)
                        <input type="radio" name="payment_merchant" value="{{ $merchant->merchantid }}" id="merchant-{{ $merchant->merchantid }}" onchange="changePayment('{{ $merchant->merchantid }}')" form="form-checkout"/>
                        <label class="list-group-item d-flex justify-content-between" for="merchant-{{ $merchant->merchantid }}">
                            <span id="merchant-name-{{ $merchant->merchantid }}">{{ $merchant->name }}</span>
                            @if($merchant->logo_url)
                            <img height="24" alt="merchant logo" src="{{ $merchant->logo_url }}">
                            @endif
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('checkout.update', $payment) }}" id="form-checkout">
                        @csrf
                        @method('PUT')
                        <!-- <a href="{{ route('checkout.update', $payment) }}" class="btn icon-left float-right mt-3"><span>Proceed to PayPal</span></a> -->
                        <button type="submit" class="btn icon-left mt-3" id="button-checkout" disabled><span>Choose Payment Method</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: SHOP CHECKOUT -->
@elseif($payment->status == 2)
<!-- SHOP CHECKOUT COMPLETED -->
<section id="shop-checkout-completed">
    <div class="container">
        <div class="p-t-10 m-b-20 text-center">
            <div class="text-center">
                <h1 class="icon text-success"> <i class="fa fa-check-circle"></i> </h1>
                <h3>Congratulations! Your order is completed!</h3>
                <p>Your order is number #{{ $payment->transactionno }}. You can
                    <a href="{{ route('dashboard.order') }}" class="text-underline">
                        <mark>view your order</mark>
                    </a> on your account page, when you are logged in.</p>
            </div>
            @if(!auth()->check())
            <a href="{{ route('login') }}" class="btn icon-left m-r-10"><span>Go to login page</span></a>
            @endif
            <a class="btn icon-left" href="{{ route('dashboard.order') }}"><span>View your orders</span></a>
            <a class="btn icon-left" href="{{ url('/') }}"><span>Return To Shop</span></a>
        </div>
    </div>
</section>
<!-- end: SHOP CHECKOUT COMPLETED -->
@endif

<!--Modal -->
<div class="modal fade" id="modal-address" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-label">Different Address</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex">
                            <h2 class="mr-3"><i class="fa fa-info-circle text-primary"></i></h2>
                            <h5>I want to use another address</h5>
                        </div>
                        <form method="POST" action="{{ route('dashboard.changeAddress', $payment) }}" id="form-change-address" onsubmit="onSubmitButton('#button-change-address')">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="province">Province</label>
                                    <div class="input-group">
                                        <select name="province" class="form-control" required onchange="cities(this)">
                                            <option selected disabled>Select province</option>
                                            <!-- <option value="jawa timur" {{ $user->province == 'jawa timur' ? 'selected' : '' }}>Jawa Timur</option> -->
                                        </select>
                                        <div class="spinner-loader-inside" id="spinner-province" style="display: none">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="city">City</label>
                                    <div class="input-group">
                                        <select name="city" class="form-control" required>
                                            <option selected disabled>Select city</option>
                                            <!-- <option value="surabaya" {{ $user->city == 'surabaya' ? 'selected' : '' }}>Surabaya</option> -->
                                        </select>
                                        <div class="spinner-loader-inside" id="spinner-city" style="display: none">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ $payment->address }}" placeholder="Enter your Street Address" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Post Code:</label>
                                    <input type="number" class="form-control" name="postcode" value="{{ $payment->postcode }}" placeholder="Enter Post Code" required>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-b btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-b" id="button-change-address" form="form-change-address">
                    <span class="spinner-border spinner-border-sm button-spinner" role="status" aria-hidden="true" style="display: none;"></span>
                    <span class="btn-text">Change Address</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- end: Modal -->

<!-- DELIVERY INFO -->
<!-- @include('shop.delivery') -->
<!-- end: DELIVERY INFO -->
@endsection

@push('scripts')
<script>
    jQuery(document).ready(function () {
        provinces();
    });
    function changePayment(id) {
        var buttonPayment = $('#button-checkout');
        buttonPayment.prop('disabled', false);
        buttonPayment.find('span').html('Proceed to ' + $('#merchant-name-'+id).html());
        // console.log(id, buttonPayment, buttonPayment.find('span').html(), $('#merchant-name-'+id).html());
    }

    function provinces() {
        $('#spinner-province').show();
        $.getJSON(@json(route('rajaongkir.province')), function(result){
            $.each(result, function(i, field){
                $('select[name="province"').append(`<option value="${field.province_id}">${field.province}</option>`);
            });
            $('#spinner-province').hide();
            
            var province = @json($payment->province);
            console.log(province);
            if(province != null) {
                $('select[name="province"]').val(province).change();
                // cities('select[name="province"]');
            }
        });
    }

    function cities(provinceElement) {
        province = $(provinceElement).find(':selected').val();
        $('#spinner-city').show();
        $('select[name="city"').html(`<option selected disabled>Select city</option>`);
        console.log(province);
        $.getJSON(@json(url('rajaongkir/city'))+'/'+province, function(result){
            $.each(result, function(i, field){
                $('select[name="city"').append(`<option value="${field.city_id}">${field.city_name}</option>`);
            });
            $('#spinner-city').hide();

            var city = @json($payment->city);
            if(city != null) {
                $('select[name="city"]').val(city).change();
            }
        });
    }
</script>
@endpush