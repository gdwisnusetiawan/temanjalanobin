@extends('layouts.master')

@section('meta-description', strip_tags(htmlspecialchars_decode($page->description)))
@section('title', $page->title)

@section('content')
<!-- Page title -->
@if($page->media['type'] == 'video')
<section id="page-title" class="page-title-center text-light" data-bg-video="{{ $page->media['url'] }}">
@else
<section id="page-title" class="page-title-center text-light" style="background-image:url({{ $page->media['url'][0] }});">
@endif
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="page-title">
            <span class="post-meta-category"><a href="">Tutoya</a></span>
            <h1>{{ $page->title }}</h1>
            <div class="small m-b-20">{{ $page->datetime_format }} | <a href="#">by admin</a></div>
            <div class="align-center">
                <a class="btn btn-xs btn-slide btn-facebook" href="#">
                    <i class="fab fa-facebook-f"></i>
                    <span>Facebook</span>
                </a>
                <a class="btn btn-xs btn-slide btn-twitter" href="#">
                    <i class="fab fa-twitter"></i>
                    <span>Twitter</span>
                </a>
                <a class="btn btn-xs btn-slide btn-instagram" href="#" data-width="118">
                    <i class="fab fa-instagram"></i>
                    <span>Instagram</span>
                </a>
                <a class="btn btn-xs btn-slide btn-googleplus" href="mailto:#" data-width="80">
                    <i class="icon-mail"></i>
                    <span>Mail</span>
                </a>
            </div>
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
                        <p>{!! htmlspecialchars_decode($page->content) !!}</p>
                    </div>
                </div>
            </div>
            <!-- end: Post single item-->
        </div>
    </div>
</section>
<!-- end: Page Content -->
@endsection