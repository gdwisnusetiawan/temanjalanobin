@extends('layouts.email')

@section('content')
<section>
  <div class="container container-fullscreen">
    <div class="text-middle text-center">
      <img src="{{ $config->logo_url }}" alt="logo" class="logo-default" style="max-height: 240px;">
    </div>
    <div class="card">
      <div class="card-body">
          <h5 class="card-title">Hi, {{ $user->fullname }}!</h5>
          <h6 class="card-subtitle mb-2">Thanks for signing up! <span>&#x1F44B;</span></h6>
          <p class="card-text">Let'go shopping now.</p>
          <a href="{{ url('/') }}" class="btn">Go to Shop</a>
          <a href="{{ route('dashboard.welcome') }}" class="btn">Login</a>

          <p class="card-text mt-5">If you did not sign up to {{ $config->name }}, please ignore this email or contact us at <a href="mailto:{{ $config->email }}">{{ $config->email }}</a></p>
          <hr>
          <p class="card-text">Not sure why you received this email? Please <a href="mailto:{{ $config->email }}">let us know</a>.</p>

          <p class="card-text">
            Thanks, <br>
            {{ $config->name }}
          </p>
      </div>
  </div>
  </div>
</section>
@endsection