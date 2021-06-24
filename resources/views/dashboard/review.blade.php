@extends('layouts.master')

@section('content')
<!-- Page title -->
<!-- <section id="page-title" class="page-title-center text-light" style="background-image:url({{ asset('polo-5/images/parallax/2.jpg') }});">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="page-title">
            <span class="post-meta-category"><a href="">Tutoya</a></span>
            <h1>Welcome {{ auth()->user()->name }}</h1>
            <div class="small m-b-20">{{ date('d F Y') }} | <a href="#">{{ date('H:i:s') }}</a></div>
        </div>
    </div>
</section> -->
<!-- end: Page title -->
<!-- Page Content -->
<section id="page-content" class="">
    <div class="container">
        <!-- Page title -->
        <div class="page-title">
            <h1>Pembelian Pribadi</h1>
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Riwayat Transaksi</a></li>
                    <li class="breadcrumb-item active"><a href="#">Pembelian Pribadi</a></li>
                </ul>
            </div>
        </div>
        <!-- end: Page title -->
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                        <h1 class="mb-0 mr-3"><i class="fa fa-check-circle text-success"></i></h1>
                        <h5>Thank you for your purchase, please give some reviews</h5>
                    </div>
                    <h3 class="align-self-center">Invoice #{{ $payment->transactionno }}</h3>
                </div>
                <!-- <div class="d-flex justify-content-between">
                    <div>
                        Status: <span class="badge badge-pill badge-{{ $payment->status_desc['color'] }}">{{ strtoupper($payment->status_desc['text']) }}</span>
                    </div>
                    <div>
                        Date Issued: {{ $payment->invoice_date_format }} <br>
                        Due Date: {{ $payment->invoice_duedate_format }}
                    </div>
                </div> -->
            </div>
            <div class="card-body">
                @foreach($transactions as $transaction)
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('review.store') }}" id="form-review" onsubmit="onSubmitButton('#button-review')">
                                    @csrf

                                    <input type="hidden" name="productid" value="{{ $transaction->product->id }}">
                                    <input type="hidden" name="customerid" value="{{ $user->id }}">
                                    <input type="hidden" name="transactionno" value="{{ $payment->transactionno }}">
                                    <input type="hidden" name="rating">
                                    <div class="form-group">
                                        <label for="review">Product</label>
                                        <div class="productname">{{ $transaction->itemname }}</div>
                                    </div>
                                    <div class="form-group" id="product">
                                        <label for="review">Rating</label>
                                        <div class="rateit" data-rateit-mode="font" data-productid="0" data-rateit-value="{{ $transaction->product->userReview($user, $payment)->rating ?? 0 }}" data-rateit-ispreset="{{ ($transaction->product->userReview($user, $payment)->approve ?? false) ? true : false }}" data-rateit-readonly="{{ ($transaction->product->userReview($user, $payment)->approve ?? false) ? true : false }}"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="review">Review</label>
                                        <textarea class="form-control" id="review" rows="3" name="content" {{ ($transaction->product->userReview($user, $payment)->approve ?? false) ? 'readonly' : '' }}>{!! $transaction->product->userReview($user, $payment)->content ?? '' !!}</textarea>
                                    </div>
                                    @if(!($transaction->product->userReview($user, $payment)->approve ?? false))
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
    </div>
</section>
<!-- end: Page Content -->
@endsection

@push('scripts')
<script>
    // RATING
    if(INSPIRO.core.rtlStatus()) {
        $('.rateit').wrap('<div style="direction:rtl"></div>');
    }
    $('#product .rateit').bind('rated reset', function (e) {
        var ri = $(this);
        //if the use pressed reset, it will get value: 0 (to be compatible with the HTML range control), we could check if e.type == 'reset', and then set the value to  null .
        var value = ri.rateit('value');
        var productID = ri.data('productid'); // if the product id was in some hidden field: ri.closest('li').find('input[name="productid"]').val()
        //maybe we want to disable voting?
        // ri.rateit('readonly', true);
        $('[name="rating"]').val(value);
        // $.ajax({
        //     // url: 'rateit.php', //your server side script
        //     data: {
        //         id: productID,
        //         value: value
        //     },
        //     // type: 'POST',
        //     complete: function (data) {
        //         INSPIRO.elements.notification("You have rated Product " + productID + " with " + value + " stars. Thank you!", "success")
        //     },
        //     // error: function (jxhr, msg, err) {
        //     //     INSPIRO.elements.notification(msg, "warning");
        //     // }
        // });
    });

    $('#modal-review').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var productid = button.data('productid')
        var productname = button.data('productname')
        // $('.rateit').rateit();

        var modal = $(this)
        modal.find('.rateit').data('productid', productid);
        modal.find('.modal-body .productname').html(`<h5>${productname}</h5>`)
    });
</script>
@endpush