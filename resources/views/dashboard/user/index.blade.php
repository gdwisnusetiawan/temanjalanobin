@extends('layouts.master')

@push('styles')
    <link href="{{ asset('polo-5/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
    <!-- Bootstrap datetimepicker css -->
    <!-- <link href="{{ asset('polo-5/plugins/bootstrap-datetimepicker/tempusdominus-bootstrap-4.css') }}" rel="stylesheet"> -->
    <!-- <style>
        .datepicker.dropdown-menu {
            z-index: 9999 !important;
        }
    </style> -->
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
                <h5 class="card-title">Account Settings</h5>
                <h6 class="card-subtitle text-muted">Change your account information</h6>
            </div>
            <div class="card-body">
                <div class="tabs tabs-vertical">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="nav flex-column nav-tabs" id="myTab" role="tablist" aria-orientation="vertical">
                                <li class="nav-item">
                                    <a class="nav-link {{ $tab == null || $tab == 'profile' ? 'active' : '' }}" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $tab == 'password' ? 'active' : '' }}" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Change Password</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $tab == 'billing' ? 'active' : '' }}" id="billing-tab" data-toggle="tab" href="#billing" role="tab" aria-controls="billing" aria-selected="false">Billing Information</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade {{ $tab == null || $tab == 'profile' ? 'show active' : '' }}" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"></div>
                                <div class="tab-pane fade {{ $tab == 'password' ? 'show active' : '' }}" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab"></div>
                                <div class="tab-pane fade {{ $tab == 'billing' ? 'show active' : '' }}" id="v-pills-billing" role="tabpanel" aria-labelledby="v-pills-billing-tab"></div>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade {{ $tab == null || $tab == 'profile' ? 'show active' : '' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div>
                                        <img src="{{ $user->avatar }}" class="avatar avatar-lg">
                                        <!--File upload 3-->
                                        <div class="form-group mt-3">
                                            <!-- <label for="avatar">Upload Avatar</label> -->
                                            <a class="dropzone-attach-files btn btn-sm mb-0">Upload Avatar</a>
                                            <div class="d-none" id="fileUpload3" action="/file-upload" class="dropzone">
                                                <div class="fallback">
                                                    <input name="avatar" type="file"/>
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
                                    <!-- <div class="line"></div> -->
                                    <hr>
                                    <form method="POST" action="{{ route('dashboard.user.update', $user) }}" id="form-profile" class="form-validate">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="firstname">First Name</label>
                                                <input type="text" class="form-control" name="firstname" placeholder="Enter First Name" value="{{ $user->firstname }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="lastname">Last Name</label>
                                                <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name" value="{{ $user->lastname }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="fullname">Full Name</label>
                                                <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name" value="{{ $user->fullname }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">Email address</label>
                                                <input type="email" class="form-control" name="email" placeholder="Enter your email" value="{{ $user->email }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="gender">Gender</label>
                                                <select class="form-control" name="gender" required>
                                                    <option value="" selected disabled>Select your gender</option>
                                                    <option value="1" {{ $user->sex == 1 ? 'selected' : '' }}>Male</option>
                                                    <option value="2" {{ $user->sex == 2 ? 'selected' : '' }}>Female</option>
                                                    <!-- <option value="3">Rather not say</option> -->
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="gender">Date of Birth</label>
                                                <!-- <input class="form-control" type="date" name="dateofbirth" {{ $user->dateofbirth }} required> -->
                                                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" data-toggle="datetimepicker" placeholder="Select date & time" name="dateofbirth" autocomplete="off"/>
                                                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="icon-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="telephone">Telephone</label>
                                                <input class="form-control" type="tel" name="telephone" placeholder="Enter your Telephone number" value="{{ $user->nohp }}" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn mt-3">Submit</button>
                                    </form>
                                </div>
                                <div class="tab-pane fade {{ $tab == 'password' ? 'show active' : '' }}" id="password" role="tabpanel" aria-labelledby="password-tab">
                                    <form method="POST" action="{{ route('dashboard.user.changePassword', $user) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Old password</label>
                                                    <!-- <input class="form-control" type="password"> -->
                                                    <div class="input-group show-hide-password">
                                                        <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="Enter old password" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>
                                                        </div>
                                                        @error('old_password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">New password</label>
                                                    <!-- <input class="form-control" type="password"> -->
                                                    <div class="input-group show-hide-password">
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter new password" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>
                                                        </div>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Confirm password</label>
                                                    <!-- <input class="form-control" type="password"> -->
                                                    <div class="input-group show-hide-password">
                                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn">Change password</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade {{ $tab == 'billing' ? 'show active' : '' }}" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                                    <form method="POST" action="{{ route('dashboard.user.billing', $user) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="h5 mb-4">Mailing Address</div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="province">Province</label>
                                                <div class="input-group">
                                                    <select name="province" class="form-control" required onchange="cities(this)">
                                                        <option selected disabled>Select province</option>
                                                        <!-- <option value="jawa timur" {{ $user->province == 'jawa timur' ? 'selected' : '' }}>Jawa Timur</option> -->
                                                    </select>
                                                    <div class="spinner-loader-inside" id="spinner-province" style="display: none">
                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="city">City</label>
                                                <div class="input-group">
                                                    <select name="city" class="form-control" required>
                                                        <option selected disabled>Select city</option>
                                                        <!-- <option value="surabaya" {{ $user->city == 'surabaya' ? 'selected' : '' }}>Surabaya</option> -->
                                                    </select>
                                                    <div class="spinner-loader-inside" id="spinner-city" style="display: none">
                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" name="address" value="{{ $user->address }}" placeholder="Enter your Street Address" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Post Code:</label>
                                                <input type="number" class="form-control" name="postcode" value="{{ $user->postcode }}" placeholder="Enter Post Code" required>
                                            </div>
                                        </div>
                                        <!-- <div class="row my-4">
                                            <div class="col-6 col-md-8">
                                                <span class="h5">Add new card</span>
                                                <p class="text-muted">Safe money transfer using your bank account. We support
                                                    Mastercard, Visa, Paypal, American Express, Visa Electron and Maestro</p>
                                            </div>
                                            <div class="col-7 col-md-4 text-right">
                                                <img alt="Image placeholder" src="{{ asset('polo-5/images/card-images.png') }}" width="100%">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label" for="bank_name">Bank Name</label>
                                                <select name="bank_name" class="form-control" required>
                                                    <option selected disabled>Select bank</option>
                                                    <option value="bca" {{ $user->bankname == 'bca' ? 'selected' : '' }}>BCA</option>
                                                    <option value="mandiri" {{ $user->bankname == 'mandiri' ? 'selected' : '' }}>Mandiri</option>
                                                    <option value="bni" {{ $user->bankname == 'bni' ? 'selected' : '' }}>BNI</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-control-label" for="bank_owner">Bank Owner</label>
                                                <input type="text" class="form-control" name="bank_owner" value="{{ $user->bankowner }}" placeholder="Enter your bank name">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="form-control-label" for="bank_number">Bank Number</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="bank_number" value="{{ $user->banknumber }}" data-mask="0000 0000 0000 0000" placeholder="ex: 1234 5678 9101 1123">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="far fa-credit-card"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="mt-4">
                                            <button type="submit" class="btn">Update Mailing</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: Tabs -->
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
        $('#datetimepicker1').datetimepicker({
            format: 'DD MMMM YYYY',
            defaultDate: '{{ $user->dateofbirth }}'
        });

        provinces();
    });
    Dropzone.autoDiscover = false;

    //Form 3
    var form3 = $('#fileUpload3');
    form3.dropzone({
        method: "POST",
        url: "{{ route('dashboard.user.changeAvatar', $user) }}",
        maxFilesize: 5,
        acceptedFiles: "image/*",
        // previewsContainer: "#formFiles3",
        // previewTemplate: $("#formTemplate3").html(),
        clickable: ".dropzone-attach-files",
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time +'-user{{ $user->id }}';
        },
        removedfile: function(file) 
        {
            var name = file.upload.filename;
            // $.ajax({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            //     },
            //     type: "POST",
            //     url: "#",
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
        sending: function(file, xhr, formData) {
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'PUT');
        },
        success: function(file, response) {
            notify(response.notify, "Success");

            var name = file.upload.filename;
            var fileRef;
            return (fileRef = file.previewElement) != null ? 
            fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        thumbnail: function(file, dataUrl) {
            $('.avatar').attr('src', dataUrl);
        },
        error: function(response) {
            console.log('Error: ', response)
            return false;
        }
    });

    function provinces() {
        $('#spinner-province').show();
        $.getJSON(@json(route('shipment.rajaongkir.province')), function(result){
            $.each(result, function(i, field){
                $('select[name="province"').append(`<option value="${field.province_id}">${field.province}</option>`);
            });
            $('#spinner-province').hide();
            
            var province = @json($user->province);
            // console.log(province);
            if(province != null) {
                $('select[name="province"]').val(province).change();
                // cities('select[name="province"]');
            }
        });
    }

    function cities(provinceElement) {
        province = $(provinceElement).find(':selected').val();
        $('#spinner-city').show();
        $('select[name="city"').html(`<option selected disabled>Select city</option>`);
        // console.log(province);
        $.getJSON(@json(url('shipment/rajaongkir/city'))+'/'+province, function(result){
            $.each(result, function(i, field){
                $('select[name="city"').append(`<option value="${field.city_id}">${field.city_name}</option>`);
            });
            $('#spinner-city').hide();

            var city = @json($user->city);
            if(city != null) {
                $('select[name="city"]').val(city).change();
            }
        });
    }
</script>
@endpush