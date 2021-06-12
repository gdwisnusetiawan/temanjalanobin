@extends('layouts.master')

@section('content')
<!-- Page title -->
<section id="page-title" data-bg-parallax="{{ asset('img/image-9.jpg') }}">
    <div class="container">
        <div class="page-title">
            <h1>User Register</h1>
            <span>User register page</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <!-- <li><a href="#">Pages</a></li> -->
                <li class="active"><a href="#">User Register</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- Section -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 center no-padding">
                <form method="POST" action="{{ route('register') }}" class="form-transparent-grey form-validate" onsubmit="onSubmit()">
                    @csrf
                    <input type="hidden" name="referal" value="{{ $referal }}">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>{{ __('Register') }}</h3>
                            <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="sr-only">{{ __('Name') }}</label>
                            <input type="text" placeholder="{{ __('Name') }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="sr-only">{{ __('Phone Number') }}</label>
                            <input type="text" placeholder="{{ __('Phone Number') }}" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-12 form-group">
                            <label class="sr-only">{{ __('E-Mail Address') }}</label>
                            <input type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="sr-only">{{ __('Password') }}</label>
                            <input type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="sr-only">{{ __('Confirm Password') }}</label>
                            <input type="password" placeholder="{{ __('Confirm Password') }}" class="form-control" id="password-confirm" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="col-lg-12 form-group">
                            <div id="g-recaptcha"></div>
                            @error('g-recaptcha-response')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn" id="button-submit">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="button-spinner" style="display: none;"></span>
                                <span class="btn-text">{{ __('Register') }}</span>
                            </button>
                            <button type="button" class="btn btn-danger m-l-10" id="button-cancel">Cancel</button>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <p>or register with</p>
                        <a href="{{ route('login.provider', 'google') }}" class="btn btn-danger">
                            <i class="fab fa-google m-r-5"></i> Google
                        </a>
                        <a class="btn btn-facebook">
                            <i class="fab fa-facebook-f m-r-5"></i> Facebook
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- end: Section -->
@endsection

@push('scripts')
<script type="text/javascript">
    var messageCaptcha;
    var onloadCallback = function() {
        messageCaptcha = grecaptcha.render('g-recaptcha', {
            'sitekey' : '{{ env("reCAPTCHA_SITE_KEY") }}'
        });
    };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
            async defer>
</script>
<script type="text/javascript">
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    // function submitForm(e, spinner, captchaId) {
    //     // $(e).preventDefault();
    //     $.ajax({
    //         type: $(e).attr("method"),
    //         url: $(e).attr("action"),
    //         data: $(e).serialize(),
    //         dataType: 'json',
    //         beforeSend: function() {
    //             $(spinner).toggle('display');
    //         },
    //         success: function (data) {
    //             $(spinner).toggle('display');
    //             $(e)[0].reset();
    //             if(data.success) {
    //                 toastr.success(data.success, 'Success').css('width','480px');
    //                 $('.success-message').html(data.success);
    //             }
    //             else {
    //                 toastr.error(data.error, 'Failed').css('width','480px');
    //                 $('.failed-message').html(data.error);
    //             }
    //             grecaptcha.reset(captchaId);
    //             // console.log(data);
    //         },
    //         error: function (data) {
    //             // console.log(data);
    //         }
    //     });
    // }
</script>
@endpush