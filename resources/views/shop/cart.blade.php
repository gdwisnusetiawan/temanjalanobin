@extends('layouts.master')

@inject('functions', 'App\Helpers\Functions')

@section('content')
<!-- Page title -->
<section id="page-title">
    <div class="container">
        <div class="page-title">
            <h1>Shopping Cart</h1>
            <span>Shopping details</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li class="active"><a href="#">Shopping Cart</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
@if(session('cart'))
<!-- SHOP CART -->
<section id="shop-cart" class="cart-exists">
    <div class="container">
        <!-- <h1 class="text-center mb-5">Shopping Cart</h1> -->
        <div class="shop-cart">
            <div class="table table-sm table-striped table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="cart-product-remove"></th>
                            <th class="cart-product-thumbnail">Product</th>
                            <th class="cart-product-name">Description</th>
                            <th class="cart-product-name">Variant</th>
                            <th class="cart-product-price">Unit Price</th>
                            <th class="cart-product-quantity">Quantity</th>
                            <th class="cart-product-subtotal">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart')['list'] as $cart)
                        @php 
                            $product = $cart['product'];
                            $quantity = $cart['quantity'];
                            $variants = $cart['variants'] ?? null;
                            $total = $cart['total'];
                        @endphp
                        <tr id="product-{{ $product->id }}">
                            <td class="cart-product-remove">
                            <form method="POST" action="{{ route('cart.destroy', $product->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-rounded btn-xs" onclick="deleteCart(this.form)"><i class="fa fa-times"></i></button>
                            </form>
                            </td>
                            <td class="cart-product-thumbnail">
                                <a href="#">
                                    <img src="{{ $product->media['url'][0] }}" alt="Product Image">
                                </a>
                                <div class="cart-product-thumbnail-name">{{ $product->title }}</div>
                            </td>
                            <td class="cart-product-description">
                                <p>{!! htmlspecialchars_decode($product->description) !!}</p>
                            </td>
                            <td class="cart-product-description">
                            @if($product->variants->isNotEmpty())
                                <p>
                                    @foreach($variants as $variant)
                                        {{ ucfirst($variant) }} @if(!$loop->last) {{ ',' }} @endif
                                    @endforeach
                                </p>
                            @endif
                            </td>
                            <td class="cart-product-price">
                                <span class="amount">{{ $product->getPriceFormat($quantity) }}</span>
                            </td>
                            <td class="cart-product-quantity">
                                <div class="quantity">
                                    <form method="POST" action="{{ route('cart.update', $product->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="button" class="minus" value="-" onclick="updateCart(this.form, -1, '{{ $product->id }}')">
                                        <input type="text" class="qty" name="quantity" value="{{ $quantity }}">
                                        <input type="button" class="plus" value="+" onclick="updateCart(this.form, 1, '{{ $product->id }}')">
                                    </form>
                                </div>
                            </td>
                            <td class="cart-product-subtotal">
                                <span class="amount total">{{ $functions->formatCurrency($total) }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <!-- <div class="col-lg-4">
                    <form class="form-inline">
                        <div class="input-group">
                            <input type="text" placeholder="Coupon Code" id="CouponCode" class="form-control">
                            <div class="input-group-append">
                                <button type="submit" id="widget-coupun-submit-button" class="btn">Apply</button>
                            </div>
                        </div>
                        <p class="small">Enter any valid coupon or promo code here to redeem your discount.</p>
                    </form>
                </div> -->
                <div class="col-lg-8 text-right">
                    <!-- <button type="button" class="btn">Update Card</button> -->
                </div>
            </div>
            <div class="row">
                <hr class="space">
                <div class="col-lg-6">
                    <h4>Calculate Shipping</h4>
                    <form method="POST" action="{{ route('cart.shipping') }}" class="row" id="form-shipping">
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
                            <!-- <label for="">Weight</label> -->
                            <div class="input-group">
                                <input type="number" name="weight" placeholder="Weight" class="form-control" value="{{ session('cart')['summary']['total_weight'] }}" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text">gram</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6  form-group">
                            <label for=""></label>
                            <!-- <input type="text" class="form-control" placeholder="Post Code / Zip"> -->
                            <button type="button" class="btn" id="button-shipping" onclick="shippingCost(this.form)">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="button-spinner" style="display: none;"></span>
                                <span class="btn-text">Calculate</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 p-r-10 ">
                    <div class="table-responsive">
                        <h4>Cart Subtotal</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="cart-product-name">
                                        <strong>Cart Subtotal</strong>
                                    </td>
                                    <td class="cart-product-name text-right">
                                        <span class="amount" id="subtotal">{{ $functions->formatCurrency(session('cart')['summary']['subtotal']) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart-product-name">
                                        <strong>Shipping</strong>
                                    </td>
                                    <td class="cart-product-name text-right">
                                        <span class="amount" id="shipping">{{ array_key_exists('shipping', session('cart')['summary']) ? $functions->formatCurrency(session('cart')['summary']['shipping']['cost']) : '-' }}</span>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td class="cart-product-name">
                                        <strong>Coupon</strong>
                                    </td>
                                    <td class="cart-product-name text-right">
                                        <span class="amount" id="coupon">-{{ session('cart')['summary']['coupon'] }}%</span>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td class="cart-product-name">
                                        <strong>Discount</strong>
                                    </td>
                                    <td class="cart-product-name text-right">
                                        <span class="amount" id="discount">-{{ $functions->formatCurrency(session('cart')['summary']['total_discount']) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart-product-name">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="cart-product-name text-right">
                                        <span class="amount color lead" id="total"><strong>{{ $functions->formatCurrency(session('cart')['summary']['total']) }}</strong></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="list-group" id="shipping-list">
                        <!-- <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between">
                            <div class="">
                                <h5 class="mb-1">code</h5>
                                <p class="mb-1">name</p>
                            </div>
                            <div class="">
                                <h5 class="mb-1">cost.service</h5>
                                <p class="mb-1">cost.description</p>
                            </div>
                            <div class="">
                                <h5 class="mb-1">cost[0].value</h5>
                                <p class="mb-1">cost[0].etd</p>
                            </div>
                        </a> -->
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('checkout.store') }}" id="form-checkout" class="text-right">
                @csrf
                <p class="text-muted" style="{{ array_key_exists('shipping', session('cart')['summary']) ? 'display: none' : '' }}">Choose your shipment before checkout.</p>
                <button type="submit" class="btn icon-left" {{ !array_key_exists('shipping', session('cart')['summary']) ? 'disabled' : '' }}><span>Proceed to Checkout</span></button>
            </form>
        </div>
    </div>
</section>
<!-- end: SHOP CART -->
@else
<!-- SHOP CART EMPTY -->
<section id="shop-cart" class="cart-empty">
    <div class="container">
        <!-- <h1 class="text-center mb-5">Shopping Cart</h1> -->
        <div class="p-t-10 m-b-20 text-center">
            <div class="heading-text heading-line text-center">
                <h4>Your cart is currently empty.</h4>
            </div>
            <a class="btn icon-left" href="{{ url('/') }}"><span>Return To Shop</span></a>
        </div>
    </div>
</section>
<!-- end: SHOP CART EMPTY -->
@endif
<section id="shop-cart" class="cart-empty" style="display: none">
    <div class="container">
        <div class="p-t-10 m-b-20 text-center">
            <div class="heading-text heading-line text-center">
                <h4>Your cart is currently empty.</h4>
            </div>
            <a class="btn icon-left" href="{{ url('/') }}"><span>Return To Shop</span></a>
        </div>
    </div>
</section>

<!-- DELIVERY INFO -->
<!-- @include('shop.delivery') -->
<!-- end: DELIVERY INFO -->
@endsection

@push('scripts')
<script>
$(document).ready(function(){
    @php $totalstock = 0 @endphp
    @if($totalstock <= 0)
        $('#add-cart').prop('disabled', true);
    @endif

    provinces();
});

function updateQuantity(id, qty) {
    // Get the field name
    var elemQuantity = $('#product-'+id).find('.qty');
    // Increment Decrement
    var quantity = parseInt(elemQuantity.val()) + qty;
    if(quantity < 1) {
        quantity = 1;
    }
    elemQuantity.val(quantity);
}

function updateCart(form, qty, id) {
    updateQuantity(id, qty);
    var formData = $(form).serializeArray();
    $.ajax({
        type: $(form).attr('method'),
        url: $(form).attr('action'),
        dataType: 'json',
        data: formData,
        success: function(data) {
            // console.log(data);
            $('#subtotal').html(formatCurrency(data.summary.subtotal));
            // $('#shipping').html(formatCurrency(data.summary.shipping.cost));
            // $('#coupon').html('-'+data.summary.coupon+'%');
            $('#discount').html('-'+formatCurrency(data.summary.total_discount));
            $('#total').html('<strong>'+formatCurrency(data.summary.total)+'</strong>');
            Object.values(data.list).forEach(function (item, index) {
                $('#product-'+item.product.id).find('.qty').val(item.quantity);
                $('#product-'+item.product.id).find('.cart-product-price .amount').html(formatCurrency(item.price));
                $('#product-'+item.product.id).find('.total').html(formatCurrency(item.total));
            });
            let cartIcon = $('#cart-icon-quantity');
            var cartQuantity = parseInt(cartIcon.html()) + qty;
            cartIcon.html(cartQuantity);

            // update shipping
            $('input[name="weight"]').val(data.summary.total_weight);
            if($('select[name="origin"] option:selected').val() != '' && $('select[name="destination"] option:selected').val() != '') {
                shippingCost('#form-shipping');
            }
            // notify(data.message, data.type);
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function deleteCart(form) {
    var formData = $(form).serializeArray();
    $.ajax({
        type: $(form).attr('method'),
        url: $(form).attr('action'),
        dataType: 'json',
        data: formData,
        success: function(data) {
            // console.log(data);
            $('#product-'+data.id).remove();
            $('#subtotal').html(formatCurrency(data.summary.subtotal));
            $('#shipping').html(formatCurrency(data.summary.shipping.cost));
            // $('#coupon').html('-'+data.summary.coupon+'%');
            $('#discount').html('-'+formatCurrency(data.summary.total_discount));
            $('#total').html('<strong>'+formatCurrency(data.summary.total)+'</strong>');

            let cartIcon = $('#cart-icon-quantity');
            var cartQuantity = data.total_quantity;
            cartIcon.html(cartQuantity);
            if(cartQuantity <= 0) {
                cartIcon.hide();
                $('.cart-exists').hide();
                $('.cart-empty').show();
            }
            notify(data.message, data.type);
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function shippingCost(form) {
    var formData = $(form).serializeArray();
    $('#button-spinner').show();
    $('#button-shipping .btn-text').html('Loading...');
    $('#button-shipping').prop('disabled', true);
    $.ajax({
        type: $(form).attr('method'),
        url: $(form).attr('action'),
        dataType: 'json',
        data: formData,
        success: function(data) {
            console.log(data);
            $('#shipping').html(formatCurrency(data.cart.summary.shipping.cost));
            $('#total').html(formatCurrency(data.cart.summary.total));
            var html = '';
            var count = 0;
            data.result.forEach(function (result, i) {
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
            });
            $('#shipping-list').html(html);
            $('#button-spinner').hide();
            $('#button-shipping .btn-text').html('Calculate');
            $('#button-shipping').prop('disabled', false);
            $('#form-checkout p').hide();
            $('#form-checkout button').prop('disabled', false);
            // notify(data.message, data.type);
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function changeShipping(id, code, name, service, description, cost, etd) {
    // var formData = $(form).serializeArray();
    // $('#button-spinner').show();
    // $('#button-shipping .btn-text').html('Loading...');
    // $('#button-shipping').prop('disabled', true);
    $.ajax({
        type: 'POST',
        url: @json(route('cart.changeShipping')),
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
            $('#shipping').html(formatCurrency(data.summary.shipping.cost));
            $('#total').html(formatCurrency(data.summary.total));
            $('.list-group-item.list-group-item-action').each(function () {
                $(this).removeClass('active text-white');
            });
            $('#'+id).addClass('active text-white');
            // $('#shipping-list').html(html);
            // $('#button-spinner').hide();
            // $('#button-shipping .btn-text').html('Calculate');
            // $('#button-shipping').prop('disabled', false);
            // notify(data.message, data.type);
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function provinces() {
    $('#spinner-origin-province').show();
    $('#spinner-destination-province').show();
    $.getJSON(@json(route('rajaongkir.province')), function(result){
        $.each(result, function(i, field){
            $("select[name='origin_province'").append(`<option value="${field.province_id}">${field.province}</option>`);
            $("select[name='destination_province'").append(`<option value="${field.province_id}">${field.province}</option>`);
        });
        $('#spinner-origin-province').hide();
        $('#spinner-destination-province').hide();

        @if(session('cart'))
        var shipping = @json(array_key_exists('shipping', session('cart')['summary']) ? session('cart')['summary']['shipping'] : null);
        if(shipping != null) {
            $('select[name="origin_province"]').val(shipping.origin_details.province_id).change();
            $('select[name="destination_province"]').val(shipping.destination_details.province_id).change();
            cities('select[name="origin_province"]', 'origin');
            cities('select[name="destination_province"]', 'destination');
        }
        @endif
    });
}

function cities(provinceElement, name) {
    province = $(provinceElement).find(':selected').val();
    $('#spinner-'+name).show();
    $.getJSON(@json(url('rajaongkir/city'))+'/'+province, function(result){
        $.each(result, function(i, field){
            $("select[name='"+name+"'").append(`<option value="${field.city_id}">${field.city_name}</option>`);
        });
        $('#spinner-'+name).hide();

        @if(session('cart'))
        var shipping = @json(array_key_exists('shipping', session('cart')['summary']) ? session('cart')['summary']['shipping'] : null);
        if(shipping != null) {
            $('select[name="origin"]').val(shipping.origin_details.city_id);
            $('select[name="destination"]').val(shipping.destination_details.city_id);
        }
        @endif
    });
}

function calculateDiscount() {
    var cost = document.getElementById('cost').value;
    var discount = document.getElementById('discount').value;

    //do the math
    var net = cost-discount;

    //update
    document.getElementById('discount2').innerHTML = discount/cost;
    document.getElementById('net').value = net;
}
</script>
@endpush