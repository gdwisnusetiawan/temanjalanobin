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
@if($order->orderstatus == 1)
<!-- SHOP CHECKOUT -->
<section id="shop-checkout">
    <div class="container">
        <div class="shop-cart">
            <form method="post" class="sep-top-md">
                <div class="row">
                    <div class="col-lg-6 no-padding">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="upper">Billing & Shipping Address</h4>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="sr-only">Country</label>
                                <select disabled>
                                    <option value="ID">Indonesia</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="sr-only">First Name</label>
                                <input type="text" class="form-control" placeholder="First Name" value="{{ $user->firstname }}" readonly>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="sr-only">Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name" value="{{ $user->lastname }}" readonly>
                            </div>
                            <!-- <div class="col-lg-12 form-group">
                                <label class="sr-only">Company Name</label>
                                <input type="text" class="form-control" placeholder="Company Name" value="{{ $user->firstname }}" readonly>
                            </div> -->
                            <div class="col-lg-6 form-group">
                                <label class="sr-only">Town / City</label>
                                <input type="text" class="form-control" placeholder="Town / City" value="{{ $user->city }}" readonly>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="sr-only">State / County</label>
                                <input type="text" class="form-control" placeholder="State / County" value="{{ $user->province }}" readonly>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="sr-only">Address</label>
                                <input type="text" class="form-control" placeholder="Address" value="{{ $user->address }}" readonly>
                            </div>
                            <!-- <div class="col-lg-6 form-group">
                                <label class="sr-only">Apartment, suite, unit etc.</label>
                                <input type="text" class="form-control" placeholder="Apartment, suite, unit etc." value="{{ $user->firstname }}" readonly>
                            </div> -->
                            <div class="col-lg-6 form-group">
                                <label class="sr-only">Postcode / Zip</label>
                                <input type="text" class="form-control" placeholder="Postcode / Zip" value="{{ $user->postcode }}" readonly>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="sr-only">Email</label>
                                <input type="text" class="form-control" placeholder="Email" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="sr-only">Phone</label>
                                <input type="text" class="form-control" placeholder="Phone" value="{{ $user->nohp }}" readonly>
                            </div>
                            <!-- <div class="col-lg-12 form-group">
                                <div class="panel panel-naked">
                                    <div class="panel-heading"><a href="#collapseThree" class="btn btn-outline btn-sm" data-toggle="collapse" class="collapsed" aria-expanded="false">Create an account?</a>
                                    </div>
                                    <div class="panel-collapse collapse" id="collapseThree" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
                                            <p>Create an account by entering the information below. If you are a
                                                returning customer please login at the top of the page.</p>
                                            <div class="form-group sep-top-xs">
                                                <label class="sr-only">Password</label>
                                                <input type="password" class="form-control" placeholder="Password" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="upper"><a href="#collapseFour" data-toggle="collapse" class="collapsed" aria-expanded="false"> Ship to a different address <i class="icon-arrow-down-circle"></i></a></h4>
                            </div>
                            <div class="col-lg-12">
                                <div style="height: 0px;" aria-expanded="false" id="collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>If you have shopped with us before, please enter your details in the
                                            boxes below. If you are a new customer please proceed to the Billing
                                            &amp; Shipping section.</p>
                                        <div class="sep-top-xs">
                                            <div class="row">
                                                <div class="col-lg-12 form-group">
                                                    <label class="sr-only">Country</label>
                                                    <select>
                                                        <option value="ID">Indonesia</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <label class="sr-only">First Name</label>
                                                    <input type="text" class="form-control" placeholder="First Name" value="">
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <label class="sr-only">Last Name</label>
                                                    <input type="text" class="form-control" placeholder="Last Name" value="">
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <label class="sr-only">Company Name</label>
                                                    <input type="text" class="form-control" placeholder="Company Name" value="">
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <label class="sr-only">Address</label>
                                                    <input type="text" class="form-control" placeholder="Address" value="">
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <label class="sr-only">Apartment, suite, unit etc.</label>
                                                    <input type="text" class="form-control" placeholder="Apartment, suite, unit etc." value="">
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <label class="sr-only">Town / City</label>
                                                    <input type="text" class="form-control" placeholder="Town / City" value="">
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <label class="sr-only">State / County</label>
                                                    <input type="text" class="form-control" placeholder="State / County" value="">
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <label class="sr-only">Postcode / Zip</label>
                                                    <input type="text" class="form-control" placeholder="Postcode / Zip" value="">
                                                </div>
                                                <div class="col-lg-12">
                                                    <textarea class="form-control" placeholder="Notes about your order, e.g. special notes for delivery" rows="7"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </form>
            <div class="seperator"><i class="fa fa-credit-card"></i>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="upper">Your Order</h4>
                    <div class="table table-sm table-striped table-responsive table table-bordered table-responsive">
                        <table class="table m-b-0">
                            <thead>
                                <tr>
                                    <th class="cart-product-thumbnail">Product</th>
                                    <th class="cart-product-name">Description</th>
                                    <th class="cart-product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->suborders as $suborder)
                                <tr>
                                    <td class="cart-product-thumbnail">
                                        <div class="cart-product-thumbnail-name">{{ $suborder->product->title }}</div>
                                    </td>
                                    <td class="cart-product-description">
                                        <p>{!! $suborder->product->description !!}</p>
                                    </td>
                                    <td class="cart-product-subtotal">
                                        <span class="amount">{{ $suborder->price_format }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
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
                                                <span class="amount">{{ $order->subtotal_format }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart-product-name">
                                                <strong>Shipping</strong>
                                            </td>
                                            <td class="cart-product-name text-right">
                                                <span class="amount">{{ $order->shipping_cost_format }}</span>
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td class="cart-product-name">
                                                <strong>Coupon</strong>
                                            </td>
                                            <td class="cart-product-name text-right">
                                                <span class="amount">-{{ $order->coupon }}%</span>
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <td class="cart-product-name">
                                                <strong>Total</strong>
                                            </td>
                                            <td class="cart-product-name text-right">
                                                <span class="amount color lead"><strong>{{ $order->total_format }}</strong></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h4 class="upper">Payment Method</h4>
                            <div class="list-group">
                                <input type="radio" name="RadioInputName" value="Value1" id="Radio1" />
                                <label class="list-group-item" for="Radio1">Direct Bank Transfer</label>
                                <input type="radio" name="RadioInputName" value="Value2" id="Radio2" />
                                <label class="list-group-item" for="Radio2">Cheque Payment</label>
                                <input type="radio" name="RadioInputName" value="Value3" id="Radio3" />
                                <label class="list-group-item" for="Radio3"><img width="90" alt="paypal" src="{{ asset('polo-5/images/shop/paypal-logo.png') }}"></label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <a href="{{ route('checkout.update', $order) }}" class="btn icon-left float-right mt-3"><span>Proceed to PayPal</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: SHOP CHECKOUT -->
@elseif($order->orderstatus == 2)
<!-- SHOP CHECKOUT COMPLETED -->
<section id="shop-checkout-completed">
    <div class="container">
        <div class="p-t-10 m-b-20 text-center">
            <div class="text-center">
                <h3>Congratulations! Your order is completed!</h3>
                <p>Your order is number #123456. You can
                    <a href="{{ route('dashboard.order') }}" class="text-underline">
                        <mark>view your order</mark>
                    </a> on your account page, when you are logged in.</p>
            </div>
            @if(!auth()->check())
            <a href="{{ route('login') }}" class="btn icon-left m-r-10"><span>Go to login page</span></a>
            @endif
            <a class="btn icon-left" href="{{ url('/') }}"><span>Return To Shop</span></a>
        </div>
    </div>
</section>
<!-- end: SHOP CHECKOUT COMPLETED -->
@endif

<!-- DELIVERY INFO -->
<!-- @include('shop.delivery') -->
<!-- end: DELIVERY INFO -->
@endsection