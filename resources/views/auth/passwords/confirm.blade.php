@extends('layouts.app')

@section('content')
<!-- Page title -->
<section id="page-title" data-bg-parallax="images/parallax/5.jpg">
    <div class="container">
        <div class="page-title">
            <h1>Password Recover</h1>
            <span>Before continuing, confirm your password below.</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="#">Home</a></li>
                <li class="active"><a href="#">Password Confirmation</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- Section -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-3">
                <h2 class="text-center">{{ __('Confirm Password') }}</h2>
                <p class="center">{{ __('Please confirm your password before continuing.') }}</p>
                <form method="POST" action="{{ route('password.confirm') }}" class="form-validate">
                    @csrf
                    <div class="form-group">
                        <input type="password" class="form-control form-white placeholder @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" id="password" name="password" value="{{ $password ?? old('password') }}" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn">{{ __('Confirm Password') }}</button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- end: Section -->
@endsection
