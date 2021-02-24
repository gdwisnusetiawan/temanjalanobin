@extends('layouts.master')

@section('content')
@include('layouts.partials.modal')
<!-- Inspiro Slider -->
<div id="slider" class="inspiro-slider slider-fullscreen dots-creative" data-height-xs="360">
    <!-- Slide -->
    @foreach($sliders as $slider)
    <div class="slide kenburns" style="background-image:url({{ $slider->image }});">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="slide-captions text-light {{ $slider->textpos }}">
                <!-- Captions -->
                <!-- <span class="strong">{{ config('app.name') }}</span> -->
                <h2 class="text-dark">{{ $slider->slidertxt }}</h2>
                @if($slider->button1 != null)
                <a class="btn" href="{{ $slider->link($slider->sliderlink1) }}" target="{{ $slider->target1 }}">{{ $slider->button1 }}</a>
                @endif
                @if($slider->button2 != null)
                <a class="btn btn-light" href="{{ $slider->link($slider->sliderlink2) }}" target="{{ $slider->target2 }}">{{ $slider->button2 }}</a>
                @endif
                <!-- end: Captions -->
            </div>
        </div>
    </div>
    @endforeach
    <!-- end: Slide -->
</div>
<!--end: Inspiro Slider -->

<!-- BOXES -->
<!-- <section>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="shop-promo-box text-right" style="background-image: url({{ asset('polo-5/homepages/shop-v2/images/collection-left.jpg') }});">
                <h2>BURNOUT</h2>
                <p>
                    We offer a range of services for
                    <br /> both businesses and individuals companies,
                    <br /> Beautiful nature, and rare feathers!. Morbi sagittis,
                    <br /> sem quis lacinia faucibus, orci ipsum
                    <br /> gravida tortor.</p>
                <a class="btn btn-dark" href="#">View Collection</a>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="shop-promo-box text-left" style="background-image: url({{ asset('polo-5/homepages/shop-v2/images/collection-right.jpg') }});">
                <h2>OVER</h2>
                <p>
                    We offer a range of services for
                    <br /> both businesses and individuals companies,
                    <br /> Beautiful nature, and rare feathers!. Morbi sagittis,
                    <br /> sem quis lacinia faucibus, orci ipsum
                    <br /> gravida tortor.</p>
                <a class="btn btn-dark" href="#">View Collection</a>
            </div>
        </div>
    </div>

</div>
</section> -->
<!-- end: BOXES -->

<!-- DELIVERY INFO -->
<!-- <section class="background-grey p-t-40 p-b-0">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="icon-box effect small clean">
                <div class="icon">
                    <a href="#"><i class="fa fa-gift"></i></a>
                </div>
                <h3>Free shipping on orders $60+</h3>
                <p>Order more than 60$ and you will get free shippining Worldwide. More info.</p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="icon-box effect small clean">
                <div class="icon">
                    <a href="#"><i class="fa fa-plane"></i></a>
                </div>
                <h3>Worldwide delivery</h3>
                <p>We deliver to the following countries: USA, Canada, Europe, Australia</p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="icon-box effect small clean">
                <div class="icon">
                    <a href="#"><i class="fa fa-history"></i></a>
                </div>
                <h3>60 days money back guranty!</h3>
                <p>Not happy with our product, feel free to return it, we will refund 100% your money!</p>
            </div>
        </div>
    </div>
</div>
</section> -->
<!-- end: DELIVERY INFO -->

<!-- Shop products CAROUSEL -->
<section>
<div class="container">
    <div class="heading-text heading-line text-center">
        <h4>Featured Products </h4>
    </div>
    <div class="carousel shop-products" data-margin="20" data-dots="false">
        @foreach($products as $product)
        <div class="product">
            <div class="product-image">
                <a href="{{ route('shop.single', [$product->category_model->slug, $product->slug]) }}" class="link-fit"><img alt="Shop product image!" src="{{ $product->media['url'][0] }}" class="img-fit"></a>
                <a href="{{ route('shop.single', [$product->category_model->slug, $product->slug]) }}" class="img-fit"><img alt="Shop product image!" src="{{ $product->media['url'][1] ?? $product->media['url'][0] }}" class="link-fit"></a>
                <!-- <span class="product-new">NEW</span> -->
                <span class="product-wishlist">
                    <a href="#"><i class="fa fa-heart"></i></a>
                </span>
                <!-- <div class="product-overlay">
                    <a href="shop-product-ajax-page.html" data-lightbox="ajax">Quick View</a>
                </div> -->
            </div>

            <div class="product-description">
                <!-- <div class="product-category">Women</div> -->
                <div class="product-title">
                    <h3><a href="{{ route('shop.single', [$product->category_model->slug, $product->slug]) }}">{{ $product->title }}</a></h3>
                </div>
                <div class="product-title">
                    @if(auth()->check() && auth()->user()->pricing($product->id)->isNotEmpty() || $product->discount > 0)
                        <del>{{ $product->real_price }}</del>
                    @endif
                    <ins>{{ $product->getPriceFormat() }}</ins>
                </div>
                <!-- <div class="product-price"><ins>{{ $product->price_format }}</ins></div> -->
                <!-- <div class="product-rate">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </div>
                <div class="product-reviews"><a href="#">6 customer reviews</a></div> -->
            </div>
        </div>
        @endforeach
    </div>
</div>

</section>
<!--END: Shop products CAROUSEL -->

@if(false)
<!-- SHOP WIDGET PRODUTCS -->
<section class="pt-0">
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="mb-3">
                <h4>Top Rated</h4>
            </div>

            <div class="widget-shop">
                @foreach($top_rateds as $product)
                <div class="product">
                    <div class="product-image">
                        <a href="{{ route('shop.single', [$product->category_model->slug, $product->slug]) }}"><img alt="Shop product image!" src="{{ $product->media['url'][0] }}"></a>
                    </div>
                    <div class="product-description">
                        <!-- <div class="product-category">Women</div> -->
                        <div class="product-title">
                            <h3><a href="{{ route('shop.single', [$product->category_model->slug, $product->slug]) }}">{{ $product->title }}</a></h3>
                        </div>
                        <div class="product-price">
                            @if(auth()->check() && auth()->user()->pricing($product->id)->isNotEmpty() || $product->discount > 0)
                                <del>{{ $product->real_price }}</del>
                            @endif
                            <ins>{{ $product->getPriceFormat() }}</ins>
                        </div>
                        <!-- <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div> -->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-3">
            <div class="mb-3">
                <h4>On Sale</h4>
            </div>

            <div class="widget-shop">
                @foreach($on_sales as $product)
                <div class="product">
                    <div class="product-image">
                        <a href="{{ route('shop.single', [$product->category_model->slug, $product->slug]) }}"><img alt="Shop product image!" src="{{ $product->media['url'][0] }}"></a>
                    </div>
                    <div class="product-description">
                        <!-- <div class="product-category">Women</div> -->
                        <div class="product-title">
                            <h3><a href="{{ route('shop.single', [$product->category_model->slug, $product->slug]) }}">{{ $product->title }}</a></h3>
                        </div>
                        <div class="product-price">
                            @if(auth()->check() && auth()->user()->pricing($product->id)->isNotEmpty() || $product->discount > 0)
                                <del>{{ $product->real_price }}</del>
                            @endif
                            <ins>{{ $product->getPriceFormat() }}</ins>
                        </div>
                        <!-- <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div> -->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-3">
            <div class="mb-3">
                <h4>Recommended</h4>
            </div>

            <div class="widget-shop">
                @foreach($recommendeds as $product)
                <div class="product">
                    <div class="product-image">
                        <a href="{{ route('shop.single', [$product->category_model->slug, $product->slug]) }}"><img alt="Shop product image!" src="{{ $product->media['url'][0] }}"></a>
                    </div>
                    <div class="product-description">
                        <!-- <div class="product-category">Women</div> -->
                        <div class="product-title">
                            <h3><a href="{{ route('shop.single', [$product->category_model->slug, $product->slug]) }}">{{ $product->title }}</a></h3>
                        </div>
                        <div class="product-price">
                            @if(auth()->check() && auth()->user()->pricing($product->id)->isNotEmpty() || $product->discount > 0)
                                <del>{{ $product->real_price }}</del>
                            @endif
                            <ins>{{ $product->getPriceFormat() }}</ins>
                        </div>
                        <!-- <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div> -->
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        <div class="col-lg-3">
            <div class="mb-3">
                <h4>Popular</h4>
            </div>

            <div class="widget-shop">
                @foreach($populars as $product)
                <div class="product">
                    <div class="product-image">
                        <a href="{{ route('shop.single', [$product->category_model->slug, $product->slug]) }}"><img alt="Shop product image!" src="{{ $product->media['url'][0] }}"></a>
                    </div>
                    <div class="product-description">
                        <!-- <div class="product-category">Women</div> -->
                        <div class="product-title">
                            <h3><a href="{{ route('shop.single', [$product->category_model->slug, $product->slug]) }}">{{ $product->title }}</a></h3>
                        </div>
                        <div class="product-price">
                            @if(auth()->check() && auth()->user()->pricing($product->id)->isNotEmpty() || $product->discount > 0)
                                <del>{{ $product->real_price }}</del>
                            @endif
                            <ins>{{ $product->getPriceFormat() }}</ins>
                        </div>
                        <!-- <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div> -->
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
</section>
@endif
<!-- end: SHOP WIDGET PRODUTCS -->



<!-- SUMMER SALE -->
<!-- <section class="section-pattern p-t-60 p-b-30 text-center" style="background: url({{ asset('polo-5/images/pattern/pattern19.png') }})">
<div class="container">
    <h1><strong>Summer Sale</strong> Countdown</h1>
    <div class="countdown medium" data-countdown="2020/09/19 11:34:51" data-animate="fadeInUp"></div>
</div>
</section> -->
<!-- end: SUMMER SALE -->


<!-- end: SHOP CATEGORIES -->
<!-- <section>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="heading-text heading-line text-center">
                <h4>Browser our categories </h4>
            </div>

        </div>
    </div>

    <div class="shop-category">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop-category-box">
                    <a href="#"><img alt="" src="{{ asset('polo-5/images/shop/shop-category/1.jpg') }}">
                        <div class="shop-category-box-title text-center">
                            <h6>Women</h6><small>64 products</small>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="shop-category-box">
                    <a href="#"><img alt="" src="{{ asset('polo-5/images/shop/shop-category/2.jpg') }}">
                        <div class="shop-category-box-title text-center">
                            <h6>Wallet's</h6><small>36 products</small>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="shop-category-box">
                    <a href="#"><img alt="" src="{{ asset('polo-5/images/shop/shop-category/3.jpg') }}">
                        <div class="shop-category-box-title text-center">
                            <h6>Man</h6><small>25 products</small>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="shop-category-box">
                    <a href="#"><img alt="" src="{{ asset('polo-5/images/shop/shop-category/4.jpg') }}">
                        <div class="shop-category-box-title text-center">
                            <h6>Socks</h6><small>80 products</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</section> -->
<!-- end: SHOP CATEGORIES -->
@endsection