@extends('layouts.master')

@section('content')
@include('layouts.partials.modal')

@isset($sliders)
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
@endisset

@if($services->count() > 0)
<section>
    <div class="container">
        <div class="heading-text heading-section text-center">
            <h2>What we do</h2>
            <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="icon-box effect medium border center">
                    <div class="icon">
                        <a href="#"><i class="fa fa-plug"></i></a>
                    </div>
                    <h3>Powerful template</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="icon-box effect medium border center">
                    <div class="icon">
                        <a href="#"><i class="fa fa-desktop"></i></a>
                    </div>
                    <h3>Flexible Layouts</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="icon-box effect medium border center">
                    <div class="icon">
                        <a href="#"><i class="fa fa-cloud"></i></a>
                    </div>
                    <h3>Retina Ready</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="icon-box effect medium border center">
                    <div class="icon">
                        <a href="#"><i class="far fa-lightbulb"></i></a>
                    </div>
                    <h3>Fast processing</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="icon-box effect medium border center">
                    <div class="icon">
                        <a href="#"><i class="fa fa-trophy"></i></a>
                    </div>
                    <h3>Unlimited Colors</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="icon-box effect medium border center">
                    <div class="icon">
                        <a href="#"><i class="fa fa-thumbs-up"></i></a>
                    </div>
                    <h3>Premium Sliders</h3>
                    <p>Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Shop products CAROUSEL -->
@if($products->count() > 0)
<section>
<div class="container">
    <div class="heading-text heading-line text-center">
        <h4>New Arrival </h4>
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
@endif
<!--END: Shop products CAROUSEL -->

@isset($webcategory)
<!-- SHOP CATEGORIES -->
<section class="p-t-0">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="heading-text heading-line text-center">
                <h4>{{ $webcategory->title }}</h4>
            </div>

        </div>
    </div>

    <!-- <div class="shop-category">
        <div class="row">
            @foreach($categories->take(4) as $category)
            <div class="col-lg-3">
                <div class="shop-category-box">
                    <a href="{{ route('shop.index', $category->slug) }}"><img alt="" src="{{ asset('polo-5/images/shop/shop-category/1.jpg') }}">
                        <div class="shop-category-box-title text-center">
                            <h6>{{ ucwords($category->title) }}</h6><small>{{ $category->products->count() }} products</small>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div> -->
    
    <div class="carousel" data-items="3">
        @foreach($subcategories as $subcategory)
        @if($subcategory->categoryModel)
        <div class="product">
            <div class="product-image">
                <a href="{{ route('shop.index', $subcategory->categoryModel->slug) }}"><img alt="Shop product image!" src="{{ $subcategory->image_url }}"></a>
            </div>
            <div class="product-description">
                <div class="product-category">{{ $subcategory->products ? $subcategory->products->count() : 0 }} products</div>
                <div class="product-title">
                    <h3><a href="{{ route('shop.index', $subcategory->categoryModel->slug) }}">{{ ucwords($subcategory->title) }}</a></h3>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
</section>
@endisset
<!-- end: SHOP CATEGORIES -->

<!-- BOXES -->
@isset($promotion)
<section class="p-t-0">
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="shop-promo-box text-right" style="background-image: url({{ $promotion->media['url'][0] }});">
                <h2>{{ $promotion->title1 }}</h2>
                <p>{!! $promotion->description1 !!}</p>
                <a class="btn btn-dark" href="{{ $promotion->links[0] }}" target="{{ $promotion->target1 }}">{{ $promotion->button1 }}</a>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="shop-promo-box text-left" style="background-image: url({{ $promotion->media['url'][1] }});">
                <h2>{{ $promotion->title2 }}</h2>
                <p>{!! $promotion->description2 !!}</p>
                <a class="btn btn-dark" href="{{ $promotion->links[1] }}" target="{{ $promotion->target2 }}">{{ $promotion->button2 }}</a>
            </div>
        </div>
    </div>

</div>
</section>
@endisset
<!-- end: BOXES -->

<!-- SUMMER SALE -->
@isset($flashsale)
<section class="section-pattern p-t-60 p-b-30" style="background: url({{ asset('polo-5/images/pattern/pattern19.png') }})">
<div class="container">
    <div class="text-center mb-5">
        <h1>{{ $flashsale->title }}</h1>
        <div class="countdown medium" data-countdown="{{ $flashsale->countdown }}" data-animate="fadeInUp"></div>
    </div>
    <div class="carousel shop-products" data-margin="20" data-dots="false">
        @foreach($flashsaleproducts as $product)
        <div class="product">
            <div class="product-image">
                <a href="{{ $product->link }}" class="link-fit"><img alt="Shop product image!" src="{{ $product->image_url }}" class="img-fit"></a>
                <a href="{{ $product->link }}" class="img-fit"><img alt="Shop product image!" src="{{ $product->image_url }}" class="link-fit"></a>
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
                    <h3><a href="{{ $product->link }}" target="{{ $product->target == 'newtab' ? '_blank' : '_self' }}">{{ $product->title }}</a></h3>
                </div>
                <div class="product-title">
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
@endisset
<!-- end: SUMMER SALE -->

<!-- Shop products CAROUSEL -->
<!-- <section>
<div class="container">
    <div class="heading-text heading-line text-center">
        <h4>New Arrival </h4>
    </div>
    
</div>
</section> -->
<!--END: Shop products CAROUSEL -->

<!-- SECTION DEFAULT (LIGHT) -->
@isset($singleblock)
<section class="p-b-0">
<div class="container">
    <div class="row align-items-center">
        @if($singleblock->posistion == 'left')
        <div class="col-lg-6"> 
            <div class="carousel" data-items="1" data-dots="false"> 
                @foreach($singleblock->media['url'] as $media)
                    <img src="{{ $media }}" alt="image" />
                @endforeach
                @if($singleblock->video)
                    <!-- <video id="video-js" class="video-js" controls loop preload="false" poster="{{ asset('polo-5/video/for-benny/for-benny.jpg') }}">
                        <source src="{{ asset('polo-5/video/for-benny/for-benny.mp4') }}" type="video/mp4" />
                        <source src="{{ asset('polo-5/video/for-benny/for-benny.webm') }}" type="video/webm" />
                    </video> -->
                    <iframe width="1280" height="720" src="https://www.youtube.com/embed/P7k2MkVYLDE?rel=0&amp;showinfo=0" allowfullscreen></iframe>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="heading-text heading-section">
                <h4>{{ $singleblock->title }}</h4>
                <p>{!! $singleblock->description !!}</p>
                @if($singleblock->button != null)
                <a class="btn" href="{{ $singleblock->links }}" target="{{ $singleblock->target }}">{{ $singleblock->button }}</a>
                @endif
            </div>
        </div>
        @else
        <div class="col-lg-6">
            <div class="heading-text heading-section">
                <h4>{{ $singleblock->title }}</h4>
                <p>{!! $singleblock->description !!}</p>
                @if($singleblock->button != null)
                <a class="btn" href="{{ $singleblock->links }}" target="{{ $singleblock->target }}">{{ $singleblock->button }}</a>
                @endif
            </div>
        </div>
        <div class="col-lg-6"> 
            <div class="carousel" data-items="1" data-dots="false"> 
                @foreach($singleblock->media['url'] as $media)
                    <img src="{{ $media }}" alt="image" />
                @endforeach
                @if($singleblock->video)
                    <!-- <video id="video-js" class="video-js" controls loop preload="false" poster="{{ asset('polo-5/video/for-benny/for-benny.jpg') }}">
                        <source src="{{ asset('polo-5/video/for-benny/for-benny.mp4') }}" type="video/mp4" />
                        <source src="{{ asset('polo-5/video/for-benny/for-benny.webm') }}" type="video/webm" />
                    </video> -->
                    <iframe width="1280" height="720" src="https://www.youtube.com/embed/P7k2MkVYLDE?rel=0&amp;showinfo=0" allowfullscreen></iframe>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
</section>
@endisset
<!-- end: SECTION DEFAULT (LIGHT) -->

<!-- Clients CAROUSEL -->
@isset($partner)
<section>
<div class="container">
    <!-- <h4>Carousel</h4> -->
    <div class="heading-text heading-line text-center">
        <h4>{{ $partner->title }}</h4>
    </div>
    <div class="carousel client-logos dots-grey" data-items="5" data-arrows="false">
        @foreach($subpartners as $subpartner)
        <div>
            <a href="{{ $subpartner->link }}"><img alt="{{ $subpartner->title }}" src="{{ $subpartner->image_url }}"></a>
        </div>
        @endforeach
    </div>
</div>
</section>
@endisset

<!-- Testimonial Carousel -->
@isset($testimonial)
<section class="background-grey">
<div class="container-fluid">
    <div class="heading-text heading-line text-center">
        <h4>{{ $testimonial->title }}</h4>
    </div>
    <!-- Testimonials -->
    <div class="carousel equalize testimonial testimonial-box" data-margin="20" data-arrows="false" data-items="4" data-items-sm="2" data-items-xxs="1" data-equalize-item=".testimonial-item">
        @foreach($subtestimonials as $subtestimonial)
        <!-- Testimonials item -->
        <a href="{{ route('page.testimonial', $subtestimonial) }}">
        <div class="testimonial-item">
            <img src="{{ $subtestimonial->image_url }}" alt="">
            <p>{!! $subtestimonial->content !!}</p>
            <span>{{ $subtestimonial->name }}</span>
            <span>{!! $subtestimonial->shortdescr !!}</span>
        </div>
        </a>
        <!-- end: Testimonials item-->
        @endforeach
    </div>
    <!-- end: Testimonials -->
</div>
</section>
@endisset
<!-- end: Testimonial Carousel -->

<!--Image Carousel -->
@if($videos->count() > 0)
<section>
<div class="container">
    <!-- <h4 class="mb-4">Images</h4> -->
    <div class="heading-text heading-line text-center">
        <h4>Promotion Video</h4>
    </div>
    @foreach($videos as $video)
        <!-- <video controls>
        <source src="{{ $video->video_url }}" type="video/mp4">
        </video> -->
        @endforeach
    <div class="carousel" data-items="3" data-dots="false">
        @foreach($videos as $video)
        <div data-lightbox="gallery">
            <div class="grid-item">
                <div class="grid-item-wrap">
                    <div class="grid-image"> <img alt="Image Lightbox" src="{{ $video->thumbnail }}" /> </div>
                    <div class="grid-description">
                        @if($video->video != null)
                        <!-- <a href="video-ajax.blade.php" data-lightbox="ajax"><i class="icon-play"></i></a> -->
                        <a href="#" data-target="#modal-video-{{ $video->id }}" data-toggle="modal"><i class="icon-play"></i></a>
                        @else
                        <a href="{{ $video->video_url }}" data-lightbox="iframe"><i class="icon-play"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- <iframe width="1280" height="720" src="{{ $video->video_url }}" allowfullscreen></iframe> -->
        @endforeach
    </div>
</div>
</section>
@foreach($videos as $video)
    @if($video->video != null)
    <div class="modal fade" id="modal-video-{{ $video->id }}" tabindex="-1" role="modal" aria-labelledby="modal-label-3" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <h4 id="modal-label-3" class="modal-title">Large Modal</h4>
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                </div> -->
                <div class="modal-body">
                    <div class="portfolio-ajax-page" id="video-ajax">
                        <video width="1280" height="720" controls>
                            <source src="{{ $video->video_url }}">
                        </video>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-b" type="button">Close</button>
                    <button class="btn btn-b" type="button">Save Changes</button>
                </div> -->
            </div>
        </div>
    </div>
    @endif
@endforeach
@endif
<!--end: Image Carousel -->

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

@endsection