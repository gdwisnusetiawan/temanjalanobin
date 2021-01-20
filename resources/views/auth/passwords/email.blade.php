@extends('layouts.master')

@section('content')
<!-- Page title -->
<section id="page-title" data-bg-parallax="images/parallax/5.jpg">
    <div class="container">
        <div class="page-title">
            <h1>Password Recover</h1>
            <span>To receive a new password, enter your email address below.</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="#">Home</a></li>
                <li class="active"><a href="#">Password Recover</a></li>
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
                <h2 class="text-center">{{ __('Reset Password') }}</h2>
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}" class="form-validation">
                    @csrf
                    <p class="center">To receive a new password, enter your email address below.</p>
                    <div class="form-group">
                        <input type="email" class="form-control form-white placeholder @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn"> {{ __('Send Password Reset Link') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- end: Section -->
@endsection
