@extends('layouts.master')

@section('content')
<!-- SHOP PRODUCT PAGE -->
<section id="product-page" class="product-page p-b-0">
    <div class="container">
        <div class="product">
            <div class="row m-b-40">
                <div class="col-lg-5">
                    <div class="product-image">
                        <!-- Carousel slider -->
                        <div class="carousel dots-inside dots-dark arrows-visible" data-items="1" data-loop="true" data-autoplay="true" data-animate-in="fadeIn" data-animate-out="fadeOut" data-autoplay="2500" data-lightbox="gallery">
                            @foreach($product->media['url'] as $media)
                            <a href="{{ $media }}" data-lightbox="image" title="Shop product image!"><img alt="Shop product image!" src="{{ $media }}"></a>
                            @endforeach
                        </div>
                        <!-- Carousel slider -->
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="product-description">
                        <div class="product-category">{{ $product->category_model->name }}</div>
                        <div class="product-title">
                            <h3><a href="#">{{ $product->title }}</a></h3>
                        </div>
                        <div class="product-price" id="product-price">
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
                        </div>
                        <div class="product-reviews"><a href="#">3 customer reviews</a></div> -->
                        @isset($product->subinventory)
                        <div class="product-rate">
                            @if($product->subinventory->totalstock <= 0)
                            <span class="badge badge-danger">Stok Habis</span>
                            @elseif($product->subinventory->totalstock > $product->min)
                            <span class="badge badge-success">Stok Tersedia</span>
                            @else
                            <span class="badge badge-warning">Stok Sisa {{ $product->subinventory->totalstock }}</span>
                            @endif
                        </div>
                        @endisset
                        <div class="seperator m-b-10"></div>
                        <p>{!! htmlspecialchars_decode($product->description) !!}</p>
                        <div class="product-meta">
                            <p>Tags: <a href="#" rel="tag">Clothing</a>, <a rel="tag" href="#">T-shirts</a></p>
                        </div>
                        <div class="seperator m-t-20 m-b-10"></div>
                    </div>
                    <div class="row mb-3">
                        <!-- <div class="col-lg-6">
                            <h6>Select the size</h6>
                            <ul class="product-size">
                                <li>
                                    <label>
                                        <input type="radio" checked="checked" value="option1" name="product-size"><span>xs</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="radio" checked="checked" value="option1" name="product-size"><span>s</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="radio" checked="checked" value="option1" name="product-size"><span>m</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="radio" checked="checked" value="option1" name="product-size"><span>l</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="radio" checked="checked" value="option1" name="product-size"><span>xl</span>
                                    </label>
                                </li>
                            </ul>
                        </div> -->
                        @foreach($variants as $variant)
                        <div class="col-lg-6">
                            <h6>Select the {{ $variant->title }}</h6>
                            <label class="sr-only">{{ $variant->title }}</label>
                            <select style="padding:10px" name="{{ $variant->input_name }}" required form="form-cart">
                                <option value="" disabled>Select {{ $variant->title }}...</option>
                                @foreach($variant->options_list as $option)
                                    <option value="{{ $option }}">{{ ucfirst($option) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <h6>Select quantity</h6>
                            <div class="cart-product-quantity">
                                <div class="quantity m-l-5">
                                    <form method="GET" action="{{ route('shop.pricing', $product->id) }}" id="form-quantity">
                                        @csrf
                                        <input type="button" class="minus" value="-" onclick="updateQuantity(this.form, -1)">
                                        <input type="text" class="qty" id="quantity" name="quantity" value="1" form="form-cart">
                                        <input type="button" class="plus" value="+" onclick="updateQuantity(this.form, 1)">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h6>Add to Cart</h6>
                            <!-- <a class="btn" href="{{ route('cart.index') }}"><i class="icon-shopping-cart"></i> Add to cart</a> -->
                            <form method="POST" action="{{ route('cart.store') }}" id="form-cart">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn"><i class="icon-shopping-cart"></i> Add to cart</button>
                            </form>
                        </div>
                        @if($product->shopee_link || $product->tokopedia_link)
                        <div class="col-lg-12">
                            <h6>Shop from</h6>
                            @if($product->shopee_link)
                            <a class="btn btn-light" href="{{ $product->shopee_link }}" target="_BLANK" data-toggle="tooltip" data-placement="top" title="Shopee"> 
                                <img src="{{ asset('img/logo/shopee-logo.png') }}" alt="shopee logo" style="max-height: 24px;">
                            </a>
                            @endif
                            @if($product->tokopedia_link)
                            <a class="btn btn-light" href="{{ $product->tokopedia_link }}" target="_BLANK" data-toggle="tooltip" data-placement="top" title="Tokopedia">
                                <img src="{{ asset('img/logo/tokopedia-mascot.png') }}" alt="tokopedia logo" style="max-height: 24px">
                            </a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Product additional tabs -->
            <div class="tabs tabs-folder">
                <ul class="nav nav-tabs" id="myTab3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="false"><i class="fa fa-align-justify"></i>Description</a></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="true"><i class="fa fa-info"></i>Additional
                            Info</a></a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-star"></i>Reviews</a></a>
                    </li> -->
                </ul>
                <div class="tab-content" id="myTabContent3">
                    <div class="tab-pane fade active show" id="home3" role="tabpanel" aria-labelledby="home-tab">
                        <p>{!! htmlspecialchars_decode($product->content) !!}</p>
                    </div>
                    <div class="tab-pane fade " id="profile3" role="tabpanel" aria-labelledby="profile-tab">
                        {!! htmlspecialchars_decode($product->detailinfo) !!}
                        <!-- <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td>Size</td>
                                    <td>Small, Medium &amp; Large</td>
                                </tr>
                                <tr>
                                    <td>Color</td>
                                    <td>Pink &amp; White</td>
                                </tr>
                                <tr>
                                    <td>Waist</td>
                                    <td>26 cm</td>
                                </tr>
                                <tr>
                                    <td>Length</td>
                                    <td>40 cm</td>
                                </tr>
                                <tr>
                                    <td>Chest</td>
                                    <td>33 inches</td>
                                </tr>
                                <tr>
                                    <td>Fabric</td>
                                    <td>Cotton, Silk &amp; Synthetic</td>
                                </tr>
                                <tr>
                                    <td>Warranty</td>
                                    <td>3 Months</td>
                                </tr>
                            </tbody>
                        </table> -->
                    </div>
                    <div class="tab-pane fade d-none" id="contact3" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="comments" id="comments">
                            <div class="comment_number">
                                Reviews <span>(3)</span>
                            </div>
                            <div class="comment-list">
                                <!-- Comment -->
                                <div class="comment" id="comment-1">
                                    <div class="image"><img alt="" src="{{ asset('polo-5/images/blog/author.jpg') }}" class="avatar">
                                    </div>
                                    <div class="text">
                                        <div class="product-rate">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </div>
                                        <h5 class="name">John Doe</h5>
                                        <span class="comment_date">Posted at 15:32h, 06 December</span>
                                        <a class="comment-reply-link" href="#">Reply</a>
                                        <div class="text_holder">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry. Lorem Ipsum has been the industry's standard dummy
                                                text ever since the 1500s.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end: Comment -->
                                <!-- Comment -->
                                <div class="comment" id="comment-1-1">
                                    <div class="image"><img alt="" src="{{ asset('polo-5/images/blog/author2.jpg') }}" class="avatar">
                                    </div>
                                    <div class="text">
                                        <div class="product-rate">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </div>
                                        <h5 class="name">John Doe</h5>
                                        <span class="comment_date">Posted at 15:32h, 06 December</span>
                                        <a class="comment-reply-link" href="#">Reply</a>
                                        <div class="text_holder">
                                            <p>It is a long established fact that a reader will be distracted by
                                                the readable content.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end: Comment -->
                                <!-- Comment -->
                                <div class="comment" id="comment-1-2">
                                    <div class="image"><img alt="" src="{{ asset('polo-5/images/blog/author3.jpg') }}" class="avatar">
                                    </div>
                                    <div class="text">
                                        <div class="product-rate">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </div>
                                        <h5 class="name">John Doe</h5>
                                        <span class="comment_date">Posted at 15:32h, 06 December</span>
                                        <a class="comment-reply-link" href="#">Reply</a>
                                        <div class="text_holder">
                                            <p>There are many variations of passages of Lorem Ipsum available,
                                                but the majority have suffered alteration in some form, by
                                                injected humour.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end: Comment -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: Product additional tabs -->
        </div>
    </div>
</section>
<!-- end: SHOP PRODUCT PAGE -->
<!-- SHOP WIDGET PRODUTCS -->
<section class="p-t-0">
    <div class="container">
        <div class="heading-text heading-line text-center">
            <h4>Related Products you may be interested!</h4>
        </div>
        <!--Shop products Carousel -->
        <h4 class="mb-4">Shop products Carousel </h4>
        <div class="carousel" data-items="3">
            @foreach($relateds as $related)
            <div class="product">
                <div class="product-image">
                    <a href="{{ route('shop.single', [$related->category_model->slug, $related->slug]) }}" class="img-fit"><img alt="Shop product image!" src="{{ $related->media['url'][0] }}" class="img-fit"></a>
                    <a href="{{ route('shop.single', [$related->category_model->slug, $related->slug]) }}" class="img-fit"><img alt="Shop product image!" src="{{ $related->media['url'][1] ?? $related->media['url'][0] }}" class="img-fit"></a>
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
                        <h3><a href="{{ route('shop.single', [$related->category_model->slug, $related->slug]) }}">{{ $related->title }}</a></h3>
                    </div>
                    <div class="product-title">
                        @if(auth()->check() && auth()->user()->pricing($related->id)->isNotEmpty())
                            <del>{{ $related->real_price }}</del>
                        @endif
                        <ins>{{ $related->getpriceFormat(1) }}</ins>
                    </div>
                    <!-- <div class="product-rate">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div> -->
                    <!-- <div class="product-reviews"><a href="#">6 customer reviews</a></div> -->
                </div>
            </div>
            @endforeach
        </div>
        <!--end: Shop products Carousel -->
    </div>
</section>
<!-- end: SHOP WIDGET PRODUTCS -->

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
    
    $('#quantity').change(function () {
        if($(this).val() < 1) {
            $(this).val(1);
        }
        calculatePrice($('#form-quantity'), parseInt($(this).val()));
    });
});

function updateQuantity(form, qty) {
    // Get the field name
    var elemQuantity = $('#quantity');
    // Increment Decrement
    var quantity = parseInt(elemQuantity.val()) + qty;
    if(quantity < 1) {
        quantity = 1;
        cartIcon.hide();
    }
    elemQuantity.val(quantity);
    calculatePrice(form, quantity);
}

function calculatePrice(form, qty) {
    // let quantity = updateQuantity(qty);
    let quantity = qty;
    var formData = $(form).serializeArray();
    formData.push({name: "quantity", value: quantity});
    $.ajax({
        type: $(form).attr('method'),
        url: $(form).attr('action'),
        dataType: 'json',
        data: formData,
        success: function(data) {
            let totalPrice = data * quantity;
            let priceFormatted = formatCurrency(totalPrice);
            $('#product-price').html('<ins>'+priceFormatted+'</ins>');
        },
        error: function(error) {
            console.log(error);
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