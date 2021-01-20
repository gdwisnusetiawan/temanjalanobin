@extends('layouts.master')

@section('content')
<!-- Page title -->
<section id="page-title" data-bg-parallax="{{ asset('polo-5/images/parallax/5.jpg') }}">
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
                <form method="POST" action="{{ route('register') }}" class="form-transparent-grey form-validate">
                    @csrf
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
                            <label class="sr-only">{{ __('E-Mail Address') }}</label>
                            <input type="text" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                            <button type="submit" class="btn">{{ __('Register') }} </button>
                            <button type="button" class="btn btn-danger m-l-10">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- end: Section -->
@endsection
