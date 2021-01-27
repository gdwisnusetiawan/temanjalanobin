@extends('layouts.master')

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
<section id="page-content" class="">
    <div class="container">
        <!--Heading text-->
        <div class="heading-text">
            <h5 class="text-uppercase">{{ config('app.name', 'Tutoya') }}</h5>
            <h2><span>Welcome {{ auth()->user()->name }}</span></h2>
            <p>Enjoy shopping and have a nice day.</p>
            <a href="{{ url('/') }}" class="btn btn-outline btn-rounded">Return to Shop</a>
        </div>
        <!--end: Heading text-->
    </div>
</section>
<!-- end: Page Content -->
@endsection