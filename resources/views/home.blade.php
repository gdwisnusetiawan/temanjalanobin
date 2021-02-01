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
                <span class="strong">TUTOYA</span>
                <h2 class="text-dark">{{ $slider->slidertxt }}</h2>
                @if($slider->button1 != null)
                <a class="btn" href="{{ $slider->sliderlink1 }}" target="{{ $slider->target1 }}">{{ $slider->button1 }}</a>
                @endif
                @if($slider->button2 != null)
                <a class="btn btn-light" href="{{ $slider->sliderlink2 }}" target="{{ $slider->target2 }}">{{ $slider->button2 }}</a>
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
<section>
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
</section>
<!-- end: BOXES -->

<!-- DELIVERY INFO -->
<section class="background-grey p-t-40 p-b-0">
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
</section>
<!-- end: DELIVERY INFO -->

<!-- Shop products CAROUSEL -->
<section>
<div class="container">
    <div class="heading-text heading-line text-center">
        <h4>Shop products Carousel </h4>
    </div>
    <div class="carousel shop-products" data-margin="20" data-dots="false">
        <div class="product">
            <div class="product-image">
                <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/1.jpg') }}">
                </a>
                <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/10.jpg') }}">
                </a>
                <span class="product-new">NEW</span>
                <span class="product-wishlist">
                    <a href="#"><i class="fa fa-heart"></i></a>
                </span>
                <div class="product-overlay">
                    <a href="shop-product-ajax-page.html" data-lightbox="ajax">Quick View</a>
                </div>
            </div>

            <div class="product-description">
                <div class="product-category">Women</div>
                <div class="product-title">
                    <h3><a href="#">Bolt Sweatshirt</a></h3>
                </div>
                <div class="product-price"><ins>$15.00</ins>
                </div>
                <div class="product-rate">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </div>
                <div class="product-reviews"><a href="#">6 customer reviews</a>
                </div>
            </div>
        </div>
        <div class="product">
            <div class="product-image">
                <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/2.jpg') }}">
                </a>
                <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/6.jpg') }}">
                </a>
                <span class="product-wishlist">
                    <a href="#"><i class="fa fa-heart"></i></a>
                </span>
                <div class="product-overlay">
                    <a href="shop-product-ajax-page.html" data-lightbox="ajax">Quick View</a>
                </div>
            </div>

            <div class="product-description">
                <div class="product-category">Women</div>
                <div class="product-title">
                    <h3><a href="#">Consume Tshirt</a></h3>
                </div>
                <div class="product-price"><ins>$39.00</ins>
                </div>
                <div class="product-rate">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </div>
                <div class="product-reviews"><a href="#">3 customer reviews</a>
                </div>
            </div>

        </div>
        <div class="product">
            <div class="product-image">
                <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/3.jpg') }}">
                </a>
                <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/7.jpg') }}">
                </a>
                <span class="product-hot">HOT</span>
                <span class="product-wishlist">
                    <a href="#"><i class="fa fa-heart"></i></a>
                </span>
                <div class="product-overlay">
                    <a href="shop-product-ajax-page.html" data-lightbox="ajax">Quick View</a>
                </div>
            </div>

            <div class="product-description">
                <div class="product-category">Man</div>
                <div class="product-title">
                    <h3><a href="#">Logo Tshirt</a></h3>
                </div>
                <div class="product-price"><ins>$39.00</ins>
                </div>
                <div class="product-rate">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </div>
                <div class="product-reviews"><a href="#">3 customer reviews</a>
                </div>
            </div>

        </div>
        <div class="product">
            <div class="product-image">
                <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/4.jpg') }}">
                </a>
                <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/9.jpg') }}">
                </a>
                <span class="product-wishlist">
                    <a href="#"><i class="fa fa-heart"></i></a>
                </span>
                <div class="product-overlay">
                    <a href="shop-product-ajax-page.html" data-lightbox="ajax">Quick View</a>
                </div>
            </div>

            <div class="product-description">
                <div class="product-category">Women</div>
                <div class="product-title">
                    <h3><a href="#">Cotton Tshirt</a></h3>
                </div>
                <div class="product-price"><ins>$22.00</ins>
                </div>
                <div class="product-rate">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </div>
                <div class="product-reviews"><a href="#">5 customer reviews</a>
                </div>
            </div>

        </div>
        <div class="product">
            <div class="product-image">
                <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/5.jpg') }}">
                </a>
                <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/11.jpg') }}">
                </a>
                <span class="product-wishlist">
                    <a href="#"><i class="fa fa-heart"></i></a>
                </span>
                <div class="product-overlay">
                    <a href="shop-product-ajax-page.html" data-lightbox="ajax">Quick View</a>
                </div>
            </div>

            <div class="product-description">
                <div class="product-category">Man</div>
                <div class="product-title">
                    <h3><a href="#">Grey Sweatshirt</a></h3>
                </div>
                <div class="product-price"><ins>$39.00</ins>
                </div>
                <div class="product-rate">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <div class="product-reviews"><a href="#">5 customer reviews</a>
                </div>
            </div>

        </div>
        <div class="product">
            <div class="product-image">
                <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/6.jpg') }}">
                </a>
                <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/2.jpg') }}">
                </a>
                <span class="product-wishlist">
                    <a href="#"><i class="fa fa-heart"></i></a>
                </span>
                <div class="product-overlay">
                    <a href="shop-product-ajax-page.html" data-lightbox="ajax">Quick View</a>
                </div>
            </div>

            <div class="product-description">
                <div class="product-category">Women</div>
                <div class="product-title">
                    <h3><a href="#">Pocket Tshirt</a></h3>
                </div>
                <div class="product-price">
                    <del>$19.00</del><ins>$15.00</ins>
                </div>
                <div class="product-rate">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <div class="product-reviews"><a href="#">5 customer reviews</a>
                </div>
            </div>

        </div>
    </div>
</div>

</section>
<!--END: Shop products CAROUSEL -->

<!-- SHOP WIDGET PRODUTCS -->
<section>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="heading-text heading-line">
                <h4>Top Rated</h4>
            </div>

            <div class="widget-shop">
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/10.jpg') }}">
                        </a>
                    </div>
                    <div class="product-description">
                        <div class="product-category">Women</div>
                        <div class="product-title">
                            <h3><a href="#">Bolt Sweatshirt</a></h3>
                        </div>
                        <div class="product-price"><del>$30.00</del><ins>$15.00</ins>
                        </div>
                        <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                    </div>
                </div>
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/6.jpg') }}">
                        </a>
                    </div>

                    <div class="product-description">
                        <div class="product-category">Women</div>
                        <div class="product-title">
                            <h3><a href="#">Consume Tshirt</a></h3>
                        </div>
                        <div class="product-price"><ins>$39.00</ins>
                        </div>
                        <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                    </div>

                </div>
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/7.jpg') }}">
                        </a>
                    </div>

                    <div class="product-description">
                        <div class="product-category">Man</div>
                        <div class="product-title">
                            <h3><a href="#">Logo Tshirt</a></h3>
                        </div>
                        <div class="product-price"><ins>$39.00</ins>
                        </div>
                        <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="heading-text heading-line">
                <h4>On Sale</h4>
            </div>

            <div class="widget-shop">
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/11.jpg') }}">
                        </a>
                    </div>

                    <div class="product-description">
                        <div class="product-category">Man</div>
                        <div class="product-title">
                            <h3><a href="#">Logo Tshirt</a></h3>
                        </div>
                        <div class="product-price"><ins>$39.00</ins>
                        </div>
                        <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                    </div>
                </div>
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/9.jpg') }}">
                        </a>
                    </div>

                    <div class="product-description">
                        <div class="product-category">Women</div>
                        <div class="product-title">
                            <h3><a href="#">Consume Tshirt</a></h3>
                        </div>
                        <div class="product-price"><ins>$39.00</ins>
                        </div>
                        <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                    </div>

                </div>
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/3.jpg') }}">
                        </a>
                    </div>

                    <div class="product-description">
                        <div class="product-category">Man</div>
                        <div class="product-title">
                            <h3><a href="#">Logo Tshirt</a></h3>
                        </div>
                        <div class="product-price"><ins>$39.00</ins>
                        </div>
                        <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="heading-text heading-line">
                <h4>Recommended</h4>
            </div>

            <div class="widget-shop">
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/1.jpg') }}">
                        </a>
                    </div>
                    <div class="product-description">
                        <div class="product-category">Women</div>
                        <div class="product-title">
                            <h3><a href="#">Bolt Sweatshirt</a></h3>
                        </div>
                        <div class="product-price"><del>$30.00</del><ins>$15.00</ins>
                        </div>
                        <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                    </div>
                </div>
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/2.jpg') }}">
                        </a>
                    </div>

                    <div class="product-description">
                        <div class="product-category">Women</div>
                        <div class="product-title">
                            <h3><a href="#">Consume Tshirt</a></h3>
                        </div>
                        <div class="product-price"><ins>$39.00</ins>
                        </div>
                        <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                    </div>

                </div>
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/5.jpg') }}">
                        </a>
                    </div>

                    <div class="product-description">
                        <div class="product-category">Man</div>
                        <div class="product-title">
                            <h3><a href="#">Logo Tshirt</a></h3>
                        </div>
                        <div class="product-price"><ins>$39.00</ins>
                        </div>
                        <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <div class="col-lg-3">
            <div class="heading-text heading-line">
                <h4>Popular</h4>
            </div>

            <div class="widget-shop">
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/4.jpg') }}">
                        </a>
                    </div>
                    <div class="product-description">
                        <div class="product-category">Women</div>
                        <div class="product-title">
                            <h3><a href="#">Bolt Sweatshirt</a></h3>
                        </div>
                        <div class="product-price"><del>$30.00</del><ins>$15.00</ins>
                        </div>
                        <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                    </div>
                </div>
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/13.jpg') }}">
                        </a>
                    </div>

                    <div class="product-description">
                        <div class="product-category">Women</div>
                        <div class="product-title">
                            <h3><a href="#">Consume Tshirt</a></h3>
                        </div>
                        <div class="product-price"><ins>$39.00</ins>
                        </div>
                        <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                    </div>

                </div>
                <div class="product">
                    <div class="product-image">
                        <a href="#"><img alt="Shop product image!" src="{{ asset('polo-5/images/shop/products/8.jpg') }}">
                        </a>
                    </div>

                    <div class="product-description">
                        <div class="product-category">Women</div>
                        <div class="product-title">
                            <h3><a href="#">Logo Tshirt</a></h3>
                        </div>
                        <div class="product-price"><ins>$39.00</ins>
                        </div>
                        <div class="product-rate">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
</section>
<!-- end: SHOP WIDGET PRODUTCS -->



<!-- SUMMER SALE -->
<section class="section-pattern p-t-60 p-b-30 text-center" style="background: url({{ asset('polo-5/images/pattern/pattern19.png') }})">
<div class="container">
    <h1><strong>Summer Sale</strong> Countdown</h1>
    <div class="countdown medium" data-countdown="2020/09/19 11:34:51" data-animate="fadeInUp"></div>
</div>
</section>
<!-- end: SUMMER SALE -->


<!-- end: SHOP CATEGORIES -->
<section>
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
</section>
<!-- end: SHOP CATEGORIES -->
@endsection