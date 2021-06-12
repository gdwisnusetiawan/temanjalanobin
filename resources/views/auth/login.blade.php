@extends('layouts.master')

@section('content')
<!-- Page title -->
<section id="page-title" data-bg-parallax="{{ asset('img/image-9.jpg') }}">
    <div class="container">
        <div class="page-title">
            <h1>User login</h1>
            <span>User login page</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <!-- <li><a href="#">Pages</a></li> -->
                <li class="active"><a href="#">User login</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- Section -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-4">
                <div class="card">
                    <div class="card-body">
                        <h3>{{ __('Login') }}</h3>
                        <form method="POST" action="{{ route('login') }}" class="form-validate" onsubmit="onSubmit()">
                            @csrf
                            <div class="form-group">
                                <label class="sr-only">{{ __('E-Mail Address') }}</label>
                                <input type="text" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group m-b-5">
                                <label class="sr-only">{{ __('Password') }}</label>
                                <input type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group form-inline m-b-10 ">
                                <div class="form-check">
                                    <label>
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <small class="m-l-10"> {{ __('Remember Me') }}</small>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn" id="button-submit">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="button-spinner" style="display: none;"></span>
                                    <span class="btn-text">{{ __('Login') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (Route::has('password.request'))
                <p class="small">
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </p>
                @endif
                <p class="small">Don't have an account yet? 
                    <a href="{{ route('register') }}">Register New Account</a>
                </p>
                <hr>
                <div class="text-center">
                    <p>or login with</p>
                    <a href="{{ route('login.provider', 'google') }}" class="btn btn-danger">
                        <i class="fab fa-google m-r-5"></i> Google
                    </a>
                    <a href="{{ route('login.provider', 'facebook') }}" class="btn btn-facebook">
                        <i class="fab fa-facebook-f m-r-5"></i> Facebook
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: Section -->
@endsection