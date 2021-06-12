@extends('layouts.master')

@section('content')
<!-- Page title -->
<section id="page-title" data-bg-parallax="{{ asset('img/image-9.jpg') }}">
    <div class="container">
        <div class="page-title">
            <h1>Email Verification</h1>
            <span>Email verification page</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <!-- <li><a href="#">Pages</a></li> -->
                <li class="active"><a href="#">Email Verification</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- Section -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <h3>{{ __('Verify Your Email Address') }}</h3>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p>{{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},</p>
                        <form method="POST" action="{{ route('verification.resend') }}" class="form-validate" onsubmit="onSubmit()">
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="btn btn-block" id="button-submit">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="button-spinner" style="display: none;"></span>
                                    <span class="btn-text">{{ __('click here to request another') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: Section -->
@endsection
