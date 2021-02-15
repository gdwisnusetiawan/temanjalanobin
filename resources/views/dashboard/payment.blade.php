@extends('layouts.master')

@push('styles')
<link href="{{ asset('polo-5/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Page title -->
<!-- <section id="page-title">
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
</section> -->
<!-- end: Page title -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="p-t-10 m-b-20 text-center">
                    <h4>Complete payment in</h4>
                    <div class="countdown small" data-countdown="{{ $payment->transactionexpire }}"></div>
                    <p class="m-0">Due Date</p>
                    <h5>{{ $payment->expire_format }}</h5>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>{{ $merchant->name }} (Bank Transfer)</span>
                        @if($merchant->logo_url)
                        <img height="24" alt="merchant logo" src="{{ $merchant->logo_url }}">
                        @endif
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item flex-column align-items-start">
                                <p class="mb-1">Bank Owner</p>
                                <h5 class="mb-1">{{ $merchant->customeraccount }}</h5>
                            </li>
                            <li class="list-group-item">
                                <p class="mb-1">Bank Number</p>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-1" id="bank-number">{{ $merchant->customeraccount }}</h5>
                                    <a data-clipboard-target="#bank-number" class="btn btn-xs btn-outline">Copy</a>
                                </div>
                            </li>
                            <li class="list-group-item flex-column align-items-start">
                                <p class="mb-1">Total Payment</p>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-1">{{ $payment->total_format }}</h5>
                                    <h5 class="mb-1 d-none" id="total-payment">{{ $payment->transactionmount }}</h5>
                                    <span>
                                        <!-- <a class="btn btn-xs btn-outline">View Details</a> -->
                                        <a data-clipboard-target="#total-payment" class="btn btn-xs btn-outline">Copy</a>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="card-footer text-muted">
                        2 days ago
                    </div> -->
                </div>
                <!-- Accordion -->
                <h4>Payment Guide</h4>
                <div class="accordion">
                    <div class="ac-item">
                        <h5 class="ac-title">ATM</h5>
                        <div class="ac-content">
                            <ol class="mx-4">
                                <li>Lorem ipsum dolor sit amet.</li>
                                <li>Lorem ipsum dolor sit amet consectetur.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit, amet consectetur adipisicing.</li>
                                <li>Lorem ipsum dolor sit amet.</li>
                            </ol>
                        </div>
                    </div>
                    <div class="ac-item">
                        <h5 class="ac-title">Mobile Banking</h5>
                        <div class="ac-content">
                            <ol class="mx-4">
                                <li>Lorem ipsum dolor sit amet.</li>
                                <li>Lorem ipsum dolor sit amet consectetur.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit, amet consectetur adipisicing.</li>
                                <li>Lorem ipsum dolor sit amet.</li>
                            </ol>
                        </div>
                    </div>
                    <div class="ac-item">
                        <h5 class="ac-title">Internet Banking</h5>
                        <div class="ac-content">
                            <ol class="mx-4">
                                <li>Lorem ipsum dolor sit amet.</li>
                                <li>Lorem ipsum dolor sit amet consectetur.</li>
                                <li>Lorem ipsum dolor sit.</li>
                                <li>Lorem ipsum dolor sit, amet consectetur adipisicing.</li>
                                <li>Lorem ipsum dolor sit amet.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end: Accordion -->
            </div>
            <div class="col-lg-6">
                <div class="p-t-10 m-b-20">
                    <h4 class="text-center">Payment Confirmation</h4>
                    <p>Please make sure your proof of payment displays:</p>
                    <div class="d-flex justify-content-between">
                        <ul class="list-icon list-icon-check list-icon-colored">
                            <li>Date and Time of Payment</li>
                            <li>Details of Receiver's Account</li>
                        </ul>
                        <ul class="list-icon list-icon-check list-icon-colored">
                            <li>Successful Status</li>
                            <li>Transfer Amount</li>
                        </ul>
                    </div>
                    <!-- <div class="countdown small" data-countdown="{{ $payment->transactionexpire }}"></div> -->
                    <!-- <p class="m-0">Due Date</p> -->
                    <!-- <h5>{{ $payment->expire_format }}</h5> -->
                </div>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('dashboard.confirmPayment', $payment) }}" id="form-payment-proof" class="form-validate" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="gender">Date and Time of Payment</label>
                                    <!-- <input class="form-control" type="date" name="dateofbirth" required> -->
                                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="payment_date" data-target="#datetimepicker1" data-toggle="datetimepicker" placeholder="Select date & time" autocomplete="off" required/>
                                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="icon-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="transfer_amount">Transfer Amount</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" name="transfer_amount" min="1" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="sender_account">Sender's Account Name</label>
                                    <input type="text" class="form-control" name="sender_account" placeholder="Enter your account name" required>
                                </div>
                            </div>
                            <!--File upload 1-->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <!-- From -->
                                    <div id="fileUpload1" class="dropzone">
                                        <div class="fallback">
                                            <input name="file" type="file" required/>
                                        </div>
                                    </div>
                                    <!-- end: From -->
                                </div>
                                <small id="dropzoneHelp" class="form-text text-muted">Max file size is 2MB and max number of files is 10.</small>
                            </div>
                            <!--end: File upload 1-->
                        </form>
                        <div class="d-flex justify-content-end mt-3">
                            <!-- <button type="submit" class="btn btn-danger" id="button-submit">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="button-spinner" style="display: none;"></span>
                                <span class="btn-text">Cancel Payment</span>
                            </button> -->
                            <button type="submit" class="btn" id="button-submit" form="form-payment-proof">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="button-spinner" style="display: none;"></span>
                                <span class="btn-text">Confirm Payment</span>
                            </button>
                        </div>
                        <!-- <button type="submit" class="btn mb-3 float-right">Confirm Payment</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DELIVERY INFO -->
<!-- @include('shop.delivery') -->
<!-- end: DELIVERY INFO -->
@endsection

@push('scripts')
<!--Clipboard plugin files-->
<script src="{{ asset('polo-5/plugins/clipboard/clipboard.min.js') }}"></script>
<!-- Dropzone plugin files-->
<script src="{{ asset('polo-5/plugins/dropzone/dropzone.js') }}"></script>
<script>
    $('#datetimepicker1').datetimepicker();

    Dropzone.autoDiscover = false;
    //Form 1
    var paymentDropzone = new Dropzone('#fileUpload1', {
        url: "{{ route('dashboard.confirmPayment', $payment) }}",
        maxFiles: 1,
        maxFilesize: 10,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        autoProcessQueue: false,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time +'-{{ $payment->transactionno }}';
        },
        removedfile: function(file) 
        {
            var name = file.upload.filename;
            // $.ajax({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            //     },
            //     type: "POST",
            //     url: "{{ route('dashboard.deletePaymentProof', $payment) }}",
            //     data: { _method: 'DELETE', payment_file: name },
            //     success: function (data) {
            //         console.log('File has been successfully removed!!');
            //     },
            //     error: function(e) {
            //         console.log(e);
            //     }
            // });
            $('.dz-default.dz-message > span').text('Drop files here to upload').removeClass('text-danger');
            var fileRef;
            return (fileRef = file.previewElement) != null ? 
            fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        // accept: function(file, done) {
        //     if (file.size == 0) {
        //         console.log(file.size)
        //         done("Empty files will not be uploaded.");
        //     }
        //     else { done(); }
        // },
        sending: function(file, xhr, formData) {
            $('#form-payment-proof').serializeArray().forEach(function (item, index) {
                formData.append(item.name, item.value);
            });
        },
        success: function(file, response) {
            notify(response.notify, "Success");
            $('#form-payment-proof')[0].reset();
            $('#form-payment-proof').find('.is-valid').removeClass('is-valid');
            var name = file.upload.filename;
            var fileRef;
            return (fileRef = file.previewElement) != null ? 
            fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        error: function(response) {
            console.log('Error: ', response)
            return false;
        }
    });

    $('#form-payment-proof').submit(function (e) {
        e.preventDefault();
        console.log(paymentDropzone.getQueuedFiles().length)
        if(paymentDropzone.getQueuedFiles().length > 0) {
            paymentDropzone.processQueue();
            $('.dz-default.dz-message > span').text('Drop files here to upload').removeClass('text-danger');
        }
        else {
            $('.dz-default.dz-message > span').text('Please upload a file').addClass('text-danger');
        }
    });
</script>
@endpush