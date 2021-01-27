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
<section id="shop-cart">
    <div class="container">
        <div class="shop-cart">
            <div class="table table-sm table-striped table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="cart-product-remove"></th>
                            <th class="cart-product-thumbnail">Product</th>
                            <th class="cart-product-name">Description</th>
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
                            <td class="cart-product-price">
                                <span class="amount">{{ $product->price_format }}</span>
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
                <div class="col-lg-4">
                    <form class="form-inline">
                        <div class="input-group">
                            <input type="text" placeholder="Coupon Code" id="CouponCode" class="form-control">
                            <div class="input-group-append">
                                <button type="submit" id="widget-coupun-submit-button" class="btn">Apply</button>
                            </div>
                        </div>
                        <p class="small">Enter any valid coupon or promo code here to redeem your discount.</p>
                    </form>
                </div>
                <div class="col-lg-8 text-right">
                    <!-- <button type="button" class="btn">Update Card</button> -->
                </div>
            </div>
            <div class="row">
                <hr class="space">
                <div class="col-lg-6">
                    <h4>Calculate Shipping</h4>
                    <form class="row">
                        <div class="col-lg-12 m-b-20">
                            <select>
                                <option value="ID">Indonesia</option>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <input type="text" placeholder="State / County" class="form-control">
                        </div>
                        <div class="col-lg-6  form-group">
                            <input type="text" class="form-control" placeholder="Post Code / Zip">
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
                                        <span class="amount" id="shipping">Free Shipping</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart-product-name">
                                        <strong>Coupon</strong>
                                    </td>
                                    <td class="cart-product-name text-right">
                                        <span class="amount" id="coupon">-{{ session('cart')['summary']['coupon'] }}%</span>
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
                    <!-- <a href="{{ route('checkout.checkout') }}" class="btn icon-left float-right"><span>Proceed to Checkout</span></a> -->
                    <form method="POST" action="{{ route('checkout.store') }}">
                        @csrf
                        <button type="submit" class="btn icon-left float-right"><span>Proceed to Checkout</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: SHOP CART -->
@else
<!-- SHOP CART EMPTY -->
<section id="shop-cart">
    <div class="container">
        <div class="p-t-10 m-b-20 text-center">
            <div class="heading-text heading-line text-center">
                <h4>Your cart is currently empty.</h4>
            </div>
            <a class="btn icon-left" href="{{ url('/') }}"><span>Return To Shop</span></a>
        </div>
    </div>
</section>
@endif
<!-- end: SHOP CART EMPTY -->

<!-- DELIVERY INFO -->
@include('shop.delivery')
<!-- end: DELIVERY INFO -->
@endsection

@push('scripts')
<script>
$(document).ready(function(){
    @php $totalstock = 0 @endphp
    @if($totalstock <= 0)
        $('#add-cart').prop('disabled', true);
    @endif
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
            $('#subtotal').html(formatCurrency('Rp', data.summary.subtotal));
            $('#shipping').html(data.summary.shipping);
            $('#coupon').html('-'+data.summary.coupon+'%');
            $('#total').html(formatCurrency('Rp', data.summary.total));
            Object.values(data.list).forEach(function (item, index) {
                $('#product-'+item.product.id).find('.qty').val(item.quantity);
                $('#product-'+item.product.id).find('.total').html(formatCurrency('Rp', item.total));
            });
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
            $('#subtotal').html(formatCurrency('Rp', data.summary.subtotal));
            $('#shipping').html(data.summary.shipping);
            $('#coupon').html('-'+data.summary.coupon+'%');
            $('#total').html(formatCurrency('Rp', data.summary.total));
            notify(data.message, data.type);
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function formatCurrency(currency, nominal) {
    return currency+nominal.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".")+',00';
}

function calculatePrice(quantity) {
    $.ajax({
        type: 'POST',
        url: '../script/getPricing.php',
        dataType: 'json',
        data: { 
            actorid: 0,
            productid: 0,
            quantity: quantity 
        },
        success: function(data) {
            let totalPrice = 0;
            if(data !== null) {
                totalPrice = data.price * quantity;
            }
            else {
                let price = 0;
                totalPrice = price * quantity;
            }
            let priceFormatted = 'Rp'+totalPrice.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
            $('.product-price').html('<ins>'+priceFormatted+'</ins>');
            // console.log(data);
        }
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