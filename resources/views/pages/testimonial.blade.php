@extends('layouts.master')

@section('meta-description', strip_tags(htmlspecialchars_decode($testimonial->shortdescr)))
@section('title', $testimonial->title)

@section('content')
<!-- Page title -->
<section id="page-title" class="page-title-center text-light" style="background-image:url({{ $testimonial->image_url }});">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="page-title">
            <!-- <span class="post-meta-category"><a href="">Tutoya</a></span> -->
            <h1>{{ $testimonial->name }}</h1>
            <div class="small m-b-20">{!! $testimonial->shortdescr !!}</div>
        </div>
    </div>
</section>
<!-- end: Page title -->
<!-- Page Content -->
<section id="page-content" class="sidebar-right">
    <div class="container">
        <div id="blog" class="single-post col-lg-10 center">
            <!-- Post single item-->
            <div class="post-item">
                <div class="post-item-wrap">
                    <div class="post-item-description text-justify">
                        <p>{!! htmlspecialchars_decode($testimonial->content) !!}</p>
                    </div>
                </div>
            </div>
            <!-- end: Post single item-->
        </div>
    </div>
</section>
<!-- end: Page Content -->
@endsection