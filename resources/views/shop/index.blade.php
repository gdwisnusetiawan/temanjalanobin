@extends('layouts.master')

@section('content')
<!-- Page title -->
<section id="page-title">
    <div class="container">
        <div class="page-title">
            <h1>Shop</h1>
            <span>{{ $category->title }}</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li class="active"><a href="#">{{ ucwords($category->title) }}</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- Shop products -->
<section id="page-content" class="sidebar-left">
    <div class="container">
        <div class="row">
            <!-- Content-->
            <div class="content col-lg-12">
                <div class="row m-b-20">
                    <div class="col-lg-6 p-t-10 m-b-20">
                        <h3 class="m-b-20">{{ ucwords($category->title) }}</h3>
                        <!-- <p>Lorem ipsum dolor sit amet. Accusamus, sit, exercitationem, consequuntur, assumenda iusto eos commodi alias.</p> -->
                    </div>
                    <!-- <div class="col-lg-3">
                        <div class="order-select">
                            <h6>Sort by</h6>
                            <p>Showing 1&ndash;12 of 25 results</p>
                            <form method="get">
                                <select class="form-control">
                                    <option selected="selected" value="order">Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="order-select">
                            <h6>Sort by Price</h6>
                            <p>From 0 - 190$</p>
                            <form method="get">
                                <select class="form-control">
                                    <option selected="selected" value="">0$ - 50$</option>
                                    <option value="">51$ - 90$</option>
                                    <option value="">91$ - 120$</option>
                                    <option value="">121$ - 200$</option>
                                </select>
                            </form>
                        </div>
                    </div> -->
                </div>
                <!--Product list-->
                <div class="shop">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-lg-3 col-md-6">
                            <div class="product">
                                <div class="product-image">
                                    <a href="{{ route('shop.single', [$category, $product]) }}" class="link-fit"><img src="{{ $product->media['url'][0] }}" alt="Shop product image!" class="img-fit"></a>
                                    <a href="{{ route('shop.single', [$category, $product]) }}" class="link-fit"><img src="{{ $product->media['url'][1] ?? $product->media['url'][0] }}" alt="Shop product image!" class="img-fit"></a>
                                    <!-- <span class="product-new">NEW</span> -->
                                    <!-- <span class="product-hot">HOT</span> -->
                                    <span class="product-wishlist">
                                        <a href="#"><i class="fa fa-heart"></i></a>
                                    </span>
                                    <div class="product-overlay">
                                        <!-- <a href="{{ route('shop.single-ajax') }}" data-lightbox="ajax">Quick View</a> -->
                                    </div>
                                </div>
                                <div class="product-description">
                                    <div class="product-category">{{ $product->category_model->title }}</div>
                                    <div class="product-title">
                                        <h3><a href="{{ route('shop.single', [$category, $product]) }}">{{ $product->title }}</a></h3>
                                    </div>
                                    <div class="product-title">
                                        @if(auth()->check() && auth()->user()->pricing($product->id)->isNotEmpty() || $product->discount > 0)
                                            <del><small>{{ $product->real_price }}</small></del>
                                        @endif
                                        {{ $product->getpriceFormat(1) }}
                                    </div>
                                    <!-- <div class="product-price" style="float: none; display: block">{{ $product->getpriceFormat(1) }}</div> -->
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
                        </div>
                        @endforeach
                    </div>
                    <hr>
                    <!-- Pagination -->
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item active"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                    <!-- end: Pagination -->
                </div>
                <!--End: Product list-->
            </div>
            <!-- end: Content-->
            
            <!-- Sidebar-->
            
            <!-- end: Sidebar-->
        </div>
    </div>
</section>
<!-- end: Shop products -->

<!-- DELIVERY INFO -->
<!-- @include('shop.delivery') -->
<!-- end: DELIVERY INFO -->
@endsection