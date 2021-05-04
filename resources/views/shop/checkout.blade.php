@extends('layouts.master')

@inject('functions', 'App\Helpers\Functions')

@section('content')
<!-- Page title -->
<section id="page-title" data-bg-parallax="{{ asset('img/image-9.jpg') }}">
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
                                        <td class="cart-product-description">
                                            <p><p>{{ $transaction->variants }}</p></p>
                                        </td>
                                        <td class="cart-product-subtotal">
                                            <span class="amount">{{ $transaction->price_format }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if(!$config->shipmentDisabled())
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="m-0">Choose Shipping</h4>
                            <div class="spinner-border spinner-border-sm ml-1" id="shipping-spinner" role="status" aria-hidden="true" style="display: none"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <p id="shipping-message">Choose your destination province and city first</p>
                                <ul class="list-group" id="shipping-list">
                                    @php $count = 0; @endphp
                                    @foreach($shippings as $shipping)
                                        @foreach($shipping as $result)
                                            @foreach($result->costs as $costs)
                                                @foreach($costs->cost as $cost)
                                                <li class="list-group-item list-group-item-action" id="{{ $result->code.$count }}" 
                                                    onclick="changeShipping('{{ $result->code.$count }}', '{{ $result->code }}', '{{ $result->name }}', '{{ $costs->service }}', '{{ $costs->description }}', '{{ $cost->value }}', '{{ $cost->etd }}')">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h5 class="mb-1">{{ strtoupper($result->code) }}</h5>
                                                            <p class="mb-1">{{ $result->name }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h5 class="mb-1">{{ $costs->service }}</h5>
                                                            <p class="mb-1">{{ $costs->description }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h5 class="mb-1">{{ $functions->formatCurrency($cost->value) }}</h5>
                                                            <p class="mb-1">{{ $cost->etd }} days</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        <!-- <form method="POST" action="{{ route('cart.shipping') }}" class="row" id="form-shipping">
                            @csrf
                            <div class="col-lg-6 m-b-20">
                                <div class="input-group">
                                    <select name="origin_province" class="mb-2" onchange="cities(this, 'origin')">
                                        <option selected disabled>Province</option>
                                    </select>
                                    <div class="spinner-loader-inside" id="spinner-origin-province" style="display: none">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <select name="origin">
                                        <option value="" selected disabled>From</option>
                                    </select>
                                    <div class="spinner-loader-inside" id="spinner-origin" style="display: none">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 m-b-20">
                                <div class="input-group">
                                    <select name="destination_province" class="mb-2" onchange="cities(this, 'destination')">
                                        <option selected disabled>Province</option>
                                    </select>
                                    <div class="spinner-loader-inside" id="spinner-destination-province" style="display: none">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <select name="destination">
                                        <option value="" selected disabled>To</option>
                                    </select>
                                    <div class="spinner-loader-inside" id="spinner-destination" style="display: none">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 form-group">
                                <div class="input-group">
                                    <input type="number" name="weight" placeholder="Weight" class="form-control" value="{{ $payment->weight > 0 ? $payment->weight : 1 }}" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">gram</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6  form-group">
                                <label for=""></label>
                                <button type="button" class="btn" id="button-shipping" onclick="shippingCost(this.form)">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="button-spinner" style="display: none;"></span>
                                    <span class="btn-text">Calculate</span>
                                </button>
                            </div>
                        </form> -->
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
                                            @if(!$config->shipmentDisabled())
                                            <tr>
                                                <td class="cart-product-name">
                                                    <strong>Shipping</strong>
                                                </td>
                                                <td class="cart-product-name text-right">
                                                    <span class="amount" id="shipping">{{ $payment->shipping_cost > 0 ? $payment->shipping_cost_format : '-' }}</span>
                                                </td>
                                            </tr>
                                            @endif
                                            @if($config->insurance > 0)
                                            <tr>
                                                <td class="cart-product-name">
                                                    <strong>Shipping Insurance ({{ $config->insurance }}%)</strong>
                                                </td>
                                                <td class="cart-product-name text-right">
                                                    <span class="amount" id="insurance">{{ $payment->insurance > 0 ? $payment->insurance_format : '-' }}</span>
                                                </td>
                                            </tr>
                                            @endif
                                            @if($config->tax > 0)
                                            <tr>
                                                <td class="cart-product-name">
                                                    <strong>Tax ({{ $config->tax }}%)</strong>
                                                </td>
                                                <td class="cart-product-name text-right">
                                                    <span class="amount">{{ $payment->tax > 0 ? $payment->tax_format : '-' }}</span>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr id="admin_fee_row" style="{{ $payment->is_credit ? 'display: block' : 'display: none' }}">
                                                <td class="cart-product-name">
                                                    <strong>Admin Fees ({{ $payment->admin_fee_percent }}%)</strong>
                                                </td>
                                                <td class="cart-product-name text-right">
                                                    <span class="amount" id="admin_fee">{{ $payment->admin_fee > 0 ? $payment->admin_fee_format : '-' }}</span>
                                                </td>
                                            </tr>
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
                                                    <span class="amount color lead" id="total"><strong>{{ $payment->total_format }}</strong></span>
                                                </td>
                                            </tr>
                                            <tr style="display: none">
                                                <td class="cart-product-name">
                                                    <strong>Grand Total</strong>
                                                    <input type="hidden" id="grand-total" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <h4 class="upper">Payment Method</h4>
                        <div class="row">
                            @foreach($merchants->split(2) as $chunks)
                            <div class="col-lg-12">
                                <div class="list-group">
                                    @foreach($chunks as $merchant)
                                    <input type="radio" name="payment_merchant" value="{{ $merchant->id }}" id="merchant-{{ $merchant->merchantid }}" onchange="changePayment('{{ $merchant->merchantid }}')" form="form-checkout"/>
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
                                    <p class="text-muted" style="display: none">Choose your shipment and payment method before checkout.</p>
                                    <button type="submit" class="btn btn-block icon-left" id="button-checkout" disabled><span>Choose Payment Method</span></button>
                                </form>
                                <div id="btnPayment"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            <!-- </form> -->
            <!-- <div class="seperator"><i class="fa fa-credit-card"></i></div> -->
            
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
                            @if($config->poslnr)
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="region" id="national" value="national" type="radio" onclick="changeRegion(this)" {{ $payment->national() ? 'checked' : '' }}>
                                        <label class="form-check-label" for="national">
                                            National
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="region" id="international" value="international" type="radio" onclick="changeRegion(this)" {{ !$payment->national() ? 'checked' : '' }}>
                                        <label class="form-check-label" for="international">
                                            International
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="form-row form-international" style="{{ $payment->national() ? 'display: none' : '' }}">
                                <div class="form-group col-md-6">
                                    <label for="country">Country</label>
                                    <div class="input-group">
                                        <select name="country" class="form-control select2" required>
                                            <option selected disabled>Select country</option>
                                        </select>
                                        <div class="spinner-loader-inside" id="spinner-country" style="display: none">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row form-national" style="{{ !$payment->national() ? 'display: none' : '' }}">
                                <div class="form-group col-md-6">
                                    <label for="province">Province</label>
                                    <div class="input-group">
                                        <select name="province" class="form-control select2" required onchange="cities(this)">
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
                                        <select name="city" class="form-control select2" required onchange="postalCode(this); subdistricts(this)">
                                            <option selected disabled>Select city</option>
                                            <!-- <option value="surabaya" {{ $user->city == 'surabaya' ? 'selected' : '' }}>Surabaya</option> -->
                                        </select>
                                        <div class="spinner-loader-inside" id="spinner-city" style="display: none">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row form-national" style="{{ !$payment->national() ? 'display: none' : '' }}">
                                <!-- <div class="form-group col-md-6">
                                    <label for="subdistrict">Subdistrict</label>
                                    <div class="input-group">
                                        <select name="subdistrict" class="form-control select2" required>
                                            <option selected disabled>Select subdistrict</option>
                                        </select>
                                        <div class="spinner-loader-inside" id="spinner-subdistrict" style="display: none">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group col-md-6">
                                    <label>Post Code:</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="postcode" value="{{ $payment->postcode }}" placeholder="Enter Post Code" disabled required>
                                        <div class="spinner-loader-inside" id="spinner-postcode" style="display: none">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ $payment->address }}" placeholder="Enter your Street Address" required>
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
<script src="{{ env('PAYPAL_CLIENT', '') }}"></script>
<script>
    jQuery(document).ready(function () {
        countries();
        provinces();
        @if(($payment->national() && $payment->city != null) || (!$payment->national() && $payment->country != null))
            $('#shipping-message').hide();
            shippingCost();
        @endif
    });
    function changePayment(id) {
        var buttonPayment = $('#button-checkout');
        if($('#shipping').html() !== '-') {
            buttonPayment.prop('disabled', false);
        }
        if($('#merchant-name-'+id).html() == 'Paypal'){
            $('#button-checkout').css('display','none')
            paypal.Buttons({
                    style : {
                        color: 'blue',
                        shape: 'rect',
                    },
                    createOrder: function (data, actions) {
                        return actions.order.create({
                            purchase_units : [{
                                amount: {
                                    value: $('#grand-total').val()
                                }
                            }]
                        });
                    },
                    onApprove: function (data, actions) {
                                console.log("data", data)
                                console.log("action", actions)
                            actions.order.capture().then(function (details) {
                                console.log("detail", details)
                                var formData = new FormData();
                                formData.append('status', 3);
                                formData.append('sender_account', details.payer.name.given_name)
                                formData.append('transfer_amount', details.purchase_units[0].amount.value)
                                formData.append('payment_merchant', $('[name="payment_merchant"]').val())
                                var act = "{{ route('dashboard.changePaymentStatus', $payment->transactionno) }}"
                                $.ajax({
                                    type: 'POST',
                                    url: act,
                                    contentType: false,
                                    processData: false,
                                    data: formData,
                                    success: function(data) {
                                        if(data.notify.type == 'success'){
                                            window.location.href = "{{ route('dashboard.payment', $payment->transactionno) }}"
                                            // location.reload();
                                        }
                                    },
                                    error: function(error) {
                                        console.log(error);
                                    }
                                });
                            })
                    },
                    onCancel: function (data) {
                        // window.location.replace("http://localhost:63342/tutorial/paypal/Oncancel.php")
                        console.log("Gagal")
                    }
            }).render('#btnPayment');

        } else {
            $('#btnPayment').html('')
            $('#button-checkout').css('display','block')
            buttonPayment.find('span').html('Proceed to ' + $('#merchant-name-'+id).html());
            var merchantName = $('#merchant-name-'+id).html().toLowerCase();
            var adminFee = @json($payment->admin_fee);
            var grandTotal = @json($payment->grand_total);
            if(merchantName.includes('credit') || merchantName.includes('kredit')) {
                // $('#admin_fee').html(formatCurrency(admin_fee));
                $('#admin_fee_row').show();
                finalTotal = parseFloat((grandTotal + adminFee).toFixed(2));
                // console.log(grandTotal, adminFee, finalTotal);
                $('#total').html('<strong>'+formatCurrency(finalTotal)+'</strong>');
            }
            else {
                $('#admin_fee_row').hide();
                $('#total').html('<strong>'+formatCurrency(grandTotal)+'</strong>');
            }
            // console.log(id, buttonPayment, buttonPayment.find('span').html(), $('#merchant-name-'+id).html());
        }
    }

    function changeRegion(regionEl) {
        var region = $(regionEl).val();
        if(region == 'national') {
            $('.form-national').show();
            $('.form-international').hide();
            $('select[name="country"').prop('required', false);
            $('select[name="province"').prop('required', true);
            $('select[name="city"').prop('required', true);
            $('[name="postcode"').prop('required', true);
        }
        else {
            $('.form-national').hide();
            $('.form-international').show();
            $('select[name="country"').prop('required', true);
            $('select[name="province"').prop('required', false);
            $('select[name="city"').prop('required', false);
            $('[name="postcode"').prop('required', false);
        }
    }

    function countries() {
        $('#spinner-country').show();
        $.getJSON(@json(route('shipment.rajaongkir.country')), function(result){
            $.each(result, function(i, field){
                $('select[name="country"').append(`<option value="${field.country_id}">${field.country_name}</option>`);
            });
            $('#spinner-country').hide();
            
            var country = @json($payment->country);
            // console.log(country);
            if(country != null) {
                $('select[name="country"]').val(country).change();
                // cities('select[name="country"]');
            }
        });
    }

    function provinces() {
        $('#spinner-province').show();
        $.getJSON(@json(route('shipment.rajaongkir.province')), function(result){
            $.each(result, function(i, field){
                $('select[name="province"').append(`<option value="${field.province_id}">${field.province}</option>`);
            });
            $('#spinner-province').hide();
            
            var province = @json($payment->province);
            // console.log(province);
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
        // console.log(province);
        $.getJSON(@json(url('shipment/rajaongkir/city'))+'/'+province, function(result){
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

    function subdistricts(cityElement) {
        city = $(cityElement).find(':selected').val();
        $('#spinner-subdistrict').show();
        $('select[name="subdistrict"').html(`<option selected disabled>Select subdistrict</option>`);
        // console.log(city);
        $.getJSON(@json(url('shipment/rajaongkir/subdistrict'))+'/'+city, function(result){
            $.each(result, function(i, field){
                $('select[name="subdistrict"').append(`<option value="${field.subdistrict_id}">${field.subdistrict_name}</option>`);
            });
            $('#spinner-subdistrict').hide();

            // var subdistrict = @json($payment->city);
            // if(subdistrict != null) {
            //     $('select[name="subdistrict"]').val(subdistrict).change();
            // }
        });
    }

    function postalCode(cityEl) {
        var cityId = $(cityEl).val();
        $('#spinner-postcode').show();
        $.getJSON(@json(url('shipment/rajaongkir/city'))+'/'+province+'/'+cityId, function(result){
            // console.log(result)
            $('input[name="postcode"]').val(result.postal_code);
            $('#spinner-postcode').hide();
        });
    }

    function shippingCost() {
        var national = @json($payment->national());
        // var formData = $(form).serializeArray();
        var formData = new FormData();
        formData.append('origin', @json($config->city));
        formData.append('destination', @json($payment->destination));
        formData.append('weight', @json($payment->weight));
        $('#shipping-spinner').show();
        // $('#button-shipping .btn-text').html('Loading...');
        // $('#button-shipping').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: '{{ route("checkout.shipping", $payment) }}',
            // dataType: 'json',
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {
                // console.log(data);
                $('#shipping').html((data.shipping.cost));
                $('#insurance').html(formatCurrency(data.shipping.insurance));
                $('#total').html('<strong>'+(data.shipping.total)+'</strong>');
                $('#grand-total').val(data.shipping.grand_total);
                var html = '';
                var count = 0;
                if(national) {
                    data.results.forEach(function (results, i) {
                        results.forEach(function (result, i) {
                            result.costs.forEach(function (costs, j) {
                                costs.cost.forEach(function (cost, k) {
                                    html += `<li class="list-group-item list-group-item-action ${count == 0 ? 'active text-white' : ''}" id="${result.code+count}" 
                                        onclick="changeShipping('${result.code+count}', '${result.code}', '${result.name}', '${costs.service}', '${costs.description}', '${cost.value}', '${cost.etd}')">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h5 class="mb-1">${result.code.toUpperCase()}</h5>
                                                        <p class="mb-1">${result.name}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="mb-1">${costs.service}</h5>
                                                        <p class="mb-1">${costs.description}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="mb-1">${formatCurrency(cost.value)}</h5>
                                                        <p class="mb-1">${cost.etd} days</p>
                                                    </div>
                                                </div>
                                            </li>`;
                                    count++;
                                });
                            });
                        })
                    });
                }
                else {
                    data.results.forEach(function (results, i) {
                        results.forEach(function (result, i) {
                            result.costs.forEach(function (costs, j) {
                                    html += `<li class="list-group-item list-group-item-action ${count == 0 ? 'active text-white' : ''}" id="${result.code+count}" 
                                        onclick="changeShipping('${result.code+count}', '${result.code}', '${result.name}', '${costs.service}', '${costs.currency}', '${costs.cost}', '${costs.etd}')">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h5 class="mb-1">${result.code.toUpperCase()}</h5>
                                                        <p class="mb-1">${result.name}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="mb-1">${costs.service}</h5>
                                                        <p class="mb-1">${costs.currency}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="mb-1">${formatCurrency(costs.cost)}</h5>
                                                        <p class="mb-1">${costs.etd} days</p>
                                                    </div>
                                                </div>
                                            </li>`;
                                    count++;
                            });
                        })
                    });
                }
                $('#shipping-list').html(html);
                $('#shipping-spinner').hide();
                // $('#button-shipping .btn-text').html('Calculate');
                // $('#button-shipping').prop('disabled', false);
                $('#form-checkout p').hide();
                if($('[name="payment_name"]').is(':checked')) {
                    $('#form-checkout button').prop('disabled', false);
                }
                // notify(data.message, data.type);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function changeShipping(id, code, name, service, description, cost, etd) {
        // var formData = $(form).serializeArray();
        $('#shipping-spinner').show();
        // $('#button-shipping .btn-text').html('Loading...');
        // $('#button-shipping').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: '{{ route("checkout.changeShipping", $payment) }}',
            dataType: 'json',
            data: { 
                _token: @json(csrf_token()), 
                _method: 'PUT', 
                code: code,
                name: name,
                service: service,
                description: description,
                cost: cost,
                etd: etd
            },
            success: function(data) {
                // console.log(data);
                $('#shipping').html((data.shipping.cost));
                $('#insurance').html(formatCurrency(data.shipping.insurance));
                $('#total').html('<strong>'+(data.shipping.total)+'</strong>');
                $('#grand-total').val(data.shipping.grand_total);
                $('.list-group-item.list-group-item-action').each(function () {
                    $(this).removeClass('active text-white');
                });
                $('#'+id).addClass('active text-white');
                // $('#shipping-list').html(html);
                $('#shipping-spinner').hide();
                // $('#button-shipping .btn-text').html('Calculate');
                // $('#button-shipping').prop('disabled', false);
                // notify(data.message, data.type);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    // function provinces() {
    //     $('#spinner-origin-province').show();
    //     $('#spinner-destination-province').show();
    //     $.getJSON(@json(route('shipment.rajaongkir.province')), function(result){
    //         $.each(result, function(i, field){
    //             $("select[name='origin_province'").append(`<option value="${field.province_id}">${field.province}</option>`);
    //             $("select[name='destination_province'").append(`<option value="${field.province_id}">${field.province}</option>`);
    //         });
    //         $('#spinner-origin-province').hide();
    //         $('#spinner-destination-province').hide();

    //         @if(session('cart'))
    //         var shipping = @json(array_key_exists('shipping', session('cart')['summary']) ? session('cart')['summary']['shipping'] : null);
    //         if(shipping != null) {
    //             $('select[name="origin_province"]').val(shipping.origin_details.province_id).change();
    //             $('select[name="destination_province"]').val(shipping.destination_details.province_id).change();
    //             cities('select[name="origin_province"]', 'origin');
    //             cities('select[name="destination_province"]', 'destination');
    //         }
    //         @endif
    //     });
    // }

    // function cities(provinceElement, name) {
    //     province = $(provinceElement).find(':selected').val();
    //     $('#spinner-'+name).show();
    //     $.getJSON(@json(url('shipment/rajaongkir/city'))+'/'+province, function(result){
    //         $.each(result, function(i, field){
    //             $("select[name='"+name+"'").append(`<option value="${field.city_id}">${field.city_name}</option>`);
    //         });
    //         $('#spinner-'+name).hide();

    //         @if(session('cart'))
    //         var shipping = @json(array_key_exists('shipping', session('cart')['summary']) ? session('cart')['summary']['shipping'] : null);
    //         if(shipping != null) {
    //             $('select[name="origin"]').val(shipping.origin_details.city_id);
    //             $('select[name="destination"]').val(shipping.destination_details.city_id);
    //         }
    //         @endif
    //     });
    // }
</script>
@endpush
