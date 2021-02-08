@extends('layouts.master')

@push('styles')
    <link href="{{ asset('polo-5/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
    <!-- Bootstrap datetimepicker css -->
    <link href="{{ asset('polo-5/plugins/bootstrap-datetimepicker/tempusdominus-bootstrap-4.css') }}" rel="stylesheet">
@endpush

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
<section id="page-content" class="mb-5">
    <div class="container" class="mb-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Business Partner Registration</h5>
                <h6 class="card-subtitle text-muted">Register your account to be a business partner</h6>
            </div>
            <div class="card-body">
                @if(isset($user->status))
                    @if($user->status)
                    <div role="alert" class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                        <strong><i class="fa fa-check-circle"></i> Info!</strong> Your registration has been verified.
                    </div>
                    @else
                    <div role="alert" class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                        <strong><i class="fa fa-info-circle"></i> Info!</strong> Your registration is being verified.
                    </div>
                    @endif
                    <h5>Status: <span class="badge {{ $user->status ? 'badge-success' : 'badge-warning' }}">{{ $user->status ? 'Approved' : 'Process' }}</span></h5>
                @endif
                <form method="POST" action="{{ route('dashboard.user.registerBusiness', $user) }}" class="needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="refbp">Business Partner Referer ID</label>
                            <input type="text" class="form-control" name="refbp" value="{{ $user->refbp ?? 'You don\'t have business partner (referer)' }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="referal_id">Referal ID</label>
                            <input type="text" class="form-control" name="referal_id" value="{{ $user->referalid }}" placeholder="Enter your referal id">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" name="nik" value="{{ $user->nik }}" placeholder="Enter your NIK">
                        </div>
                    </div>
                    <button type="submit" class="btn my-3">Submit</button>
                    <div class="form-row">
                        <!--File upload 3-->
                        <div class="form-group">
                            <label for="telephone">Upload KTP File</label>
                            <img src="{{ asset('polo-5/images/other/550x240.png') }}" class="img-fluid rounded d-block mb-3" alt="">
                            <a class="dropzone-attach-files2 btn btn-sm mb-0">Attach files</a>
                            <div class="d-none" id="fileUpload2" action="/file-upload" class="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </div>
                            <!-- Preview -->
                            <div class="mt-3" id="formFiles2"></div>
                            <!-- File preview template -->
                            <div class="d-none" id="formTemplate2">
                                <div class="card mb-3">
                                    <div class="p-2">
                                        <div class="row align-items-start">
                                            <div class="col-auto">
                                                <img data-dz-thumbnail src="#" class="avatar border rounded">
                                            </div>
                                            <div class="col pl-0">
                                                <a href="#" class="text-muted font-weight-bold" data-dz-name></a>
                                                <p class="mb-0"><small data-dz-size></small> <small class="d-block text-danger" data-dz-errormessage></small></p>
                                            </div>
                                            <div class="col-auto pt-2">
                                                <a class="btn-lg text-danger" href="#" data-dz-remove><i class="icon-trash-2"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end: File preview template -->
                            <small id="dropzoneHelp" class="form-text text-muted">Max file size is 2MB.</small>
                        </div>
                        <!--end: File upload 3-->
                    </div>
                    <div class="form-row">
                        <!--File upload 3-->
                        <div class="form-group">
                            <label for="telephone">Upload NPWP File</label>
                            <img src="{{ asset('polo-5/images/other/550x240.png') }}" class="img-fluid rounded d-block mb-3" alt="">
                            <a class="dropzone-attach-files3 btn btn-sm mb-0">Attach files</a>
                            <div class="d-none" id="fileUpload3" action="/file-upload" class="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </div>
                            <!-- Preview -->
                            <div class="mt-3" id="formFiles3"></div>
                            <!-- File preview template -->
                            <div class="d-none" id="formTemplate3">
                                <div class="card mb-3">
                                    <div class="p-2">
                                        <div class="row align-items-start">
                                            <div class="col-auto">
                                                <img data-dz-thumbnail src="#" class="avatar border rounded">
                                            </div>
                                            <div class="col pl-0">
                                                <a href="#" class="text-muted font-weight-bold" data-dz-name></a>
                                                <p class="mb-0"><small data-dz-size></small> <small class="d-block text-danger" data-dz-errormessage></small></p>
                                            </div>
                                            <div class="col-auto pt-2">
                                                <a class="btn-lg text-danger" href="#" data-dz-remove><i class="icon-trash-2"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end: File preview template -->
                            <small id="dropzoneHelp" class="form-text text-muted">Max file size is 2MB.</small>
                        </div>
                        <!--end: File upload 3-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- end: Page Content -->
@endsection
@push('scripts')
<!-- Dropzone plugin files-->
<script src="{{ asset('polo-5/plugins/dropzone/dropzone.js') }}"></script>
<script>
    jQuery(document).ready(function () {
        $('#datetimepicker1').datetimepicker();
        $('#datetimepicker5').datetimepicker();
    });
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    Dropzone.autoDiscover = false;
    // //Form 1
    // var form2 = $('#fileUpload1');
    // form2.dropzone({
    //     url: "http://polo/files/post",
    //     addRemoveLinks: true,
    //     maxFiles: 1,
    //     maxFilesize: 10,
    //     acceptedFiles: "image/*",
    // });
    // //Form 2
    // var form2 = $('#fileUpload2');
    // form2.dropzone({
    //     url: "http://polo/files/post",
    //     maxFilesize: 5,
    //     acceptedFiles: "image/*",
    //     previewsContainer: "#formFiles2",
    //     previewTemplate: $("#formTemplate2").html(),
    // });

    var form2 = $('#fileUpload2');
    form2.dropzone({
        url: "{{ route('dashboard.user.upload', $user) }}",
        method: "PUT",
        headers: { 'x-csrf-token': csrfToken },
        maxFilesize: 5,
        acceptedFiles: "image/*",
        previewsContainer: "#formFiles2",
        previewTemplate: $("#formTemplate2").html(),
        clickable: ".dropzone-attach-files2"
    });
    // Form 3
    var form3 = $('#fileUpload3');
    form3.dropzone({
        url: "{{ route('dashboard.user.upload', $user) }}",
        method: "PUT",
        headers: { 'x-csrf-token': csrfToken },
        maxFilesize: 5,
        acceptedFiles: "image/*",
        previewsContainer: "#formFiles3",
        previewTemplate: $("#formTemplate3").html(),
        clickable: ".dropzone-attach-files3"
    });
</script>
@endpush