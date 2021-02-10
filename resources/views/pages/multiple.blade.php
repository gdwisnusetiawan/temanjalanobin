@extends('layouts.master')

@section('meta-description', strip_tags(htmlspecialchars_decode($page->description)))
@section('title', $page->title)

@section('content')
<!-- Content -->
<section id="page-content">
    <div class="container">
        <!-- post content -->
        <!-- Page title -->
        <div class="page-title">
            <h1>{{ $page->title }}</h1>
            <div class="breadcrumb float-left">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">{{ $page->title }}</a></li>
                </ul>
            </div>
        </div>
        <!-- end: Page title -->
        <!-- Blog -->
        <div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
            <!-- Post item-->
            @foreach($multisubpages as $multisubpage)
            <div class="post-item border">
                <div class="post-item-wrap">
                    @if($multisubpage->media['type'] == 'audio')
                    <div class="post-audio">
                        <a href="#">
                            <img alt="" src="{{ asset('polo-5/images/blog/audio-bg.jpg') }}">
                        </a>
                        <!-- <span class="post-meta-category"><a href="">Audio</a></span> -->
                        <audio class="video-js vjs-default-skin" controls preload="false" data-setup="{}">
                            <source type="audio/mp3" src="{{ $multisubpage->media['url'] }}"/>
                        </audio>
                    </div>
                    @elseif($multisubpage->media['type'] == 'video')
                    <div class="post-video">
                        <iframe width="560" height="376" src="{{ $multisubpage->media['url'] }}" frameborder="0" allowfullscreen></iframe>
                        <!-- <span class="post-meta-category"><a href="">Video</a></span> -->
                    </div>
                    @else
                        @if(count($multisubpage->media['url']) > 1)
                        <div class="post-slider">
                            <div class="carousel dots-inside arrows-visible arrows-only" data-items="1" data-loop="true" data-autoplay="true" data-lightbox="gallery">
                                @foreach($multisubpage->media['url'] as $media)
                                <a href="{{ $media }}" data-lightbox="gallery-image">
                                    <img alt="" src="{{ $media }}">
                                </a>
                                @endforeach
                            </div>
                            <!-- <span class="post-meta-category"><a href="">Slider</a></span> -->
                        </div>
                        @else
                        <div class="post-image">
                            <a href="#">
                                <img alt="" src="{{ $multisubpage->media['url'][0] }}">
                            </a>
                            <!-- <span class="post-meta-category"><a href="">Image</a></span> -->
                        </div>
                        @endif
                    @endif
                    <div class="post-item-description">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i>{{ $multisubpage->datetime_format }}</span>
                        <!-- <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span> -->
                        <h2><a href="{{ route('page.show', [$page->slug, $multisubpage->slug]) }}">{{ $multisubpage->title }}
                            </a></h2>
                        <p>{{ $multisubpage->content_preview }}</p>
                        <a href="{{ route('page.show', [$page->slug, $multisubpage->slug]) }}" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- end: Post item-->
        </div>
        <!-- end: Blog -->
        <!-- Pagination -->
        <ul class="pagination">
            <li class="page-item {{ $multisubpages->currentPage() == 1 ? 'disabled' : '' }}"><a class="page-link" href="{{ $multisubpages->url($multisubpages->currentPage() - 1) }}"><i class="fa fa-angle-left"></i></a></li>
            @for($i = 1; $i <= $multisubpages->lastPage(); $i++)
            <li class="page-item {{ $multisubpages->currentPage() == $i ? 'active' : '' }}"><a class="page-link" href="{{ $multisubpages->url($i) }}">{{ $i }}</a></li>
            @endfor
            <li class="page-item {{ $multisubpages->currentPage() == $multisubpages->lastPage() ? 'disabled' : '' }}"><a class="page-link" href="{{ $multisubpages->url($multisubpages->currentPage() + 1) }}"><i class="fa fa-angle-right"></i></a></li>
        </ul>
        <!-- end: Pagination -->
    </div>
    <!-- end: post content -->
</section> <!-- end: Content -->
@endsection