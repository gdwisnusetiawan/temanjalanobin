@extends('layouts.master')

@section('meta-description', strip_tags(htmlspecialchars_decode($page->description)))
@section('title', $page->title)

@section('content')
<!-- Page Content -->
<section id="page-content" class="sidebar-right">
    <div class="container">
        <div class="row">
            <!-- content -->
            <div class="content col-lg-12">
                <!-- Blog -->
                <div id="blog" class="single-post">
                    <!-- Post single item-->
                    <div class="post-item">
                        <div class="post-item-wrap">
                            @if($page->media['type'] == 'audio')
                            <div class="post-audio">
                                <a href="#">
                                    <img alt="" src="{{ asset('polo-5/images/blog/audio-bg.jpg') }}">
                                </a>
                                <audio class="video-js vjs-default-skin" controls preload="false" data-setup="{}">
                                    <source src="{{ $page->media['url'] }}" type="audio/mp3" />
                                </audio>
                            </div>
                            @elseif($page->media['type'] == 'video')
                            <div class="post-video">
                                <iframe width="560" height="315" src="{{ $page->media['url'] }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                            @else
                                @if(count($page->media['url']) > 1)
                                <div class="carousel dots-inside arrows-visible" data-items="1" data-lightbox="gallery">
                                    @foreach($page->media['url'] as $media)
                                    <a href="{{ $media }}" data-lightbox="gallery-image">
                                        <img alt="image" src="{{ $media }}">
                                    </a>
                                    @endforeach
                                </div>
                                @else
                                <div class="post-image">
                                    <a href="#">
                                        <img alt="" src="{{ $page->media['url'][0] }}">
                                    </a>
                                </div>
                                @endif
                            @endif
                            <div class="post-item-description">
                                <h2>{{ $page->title }}</h2>
                                <div class="post-meta">
                                    <span class="post-meta-date"><i class="fa fa-calendar-o"></i>{{ $page->datetime_format }}</span>
                                    <!-- <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span> -->
                                    <!-- <span class="post-meta-category"><a href=""><i class="fa fa-tag"></i>News</a></span> -->
                                    <!-- <span class="post-meta-category"><a href=""><i class="fa fa-eye"></i>{{ $page->views ?? 0 }} Views</a></span> -->
                                    <div class="post-meta-share">
                                        <a href="{{ $share_links['facebook'] }}" target="_BLANK" class="btn btn-xs btn-slide btn-facebook" data-width="105">
                                            <i class="fab fa-facebook-f"></i>
                                            <span>Facebook</span>
                                        </a>
                                        <a href="{{ $share_links['twitter'] }}" target="_BLANK"  class="btn btn-xs btn-slide btn-twitter" data-width="90">
                                            <i class="fab fa-twitter"></i>
                                            <span>Twitter</span>
                                        </a>
                                        <a href="{{ $share_links['whatsapp'] }}" target="_BLANK" class="btn btn-xs btn-slide btn-whatsapp" data-width="105">
                                            <i class="fab fa-whatsapp"></i>
                                            <span>Whatsapp</span>
                                        </a>
                                        <a href="{{ $share_links['linkedin'] }}" target="_BLANK" class="btn btn-xs btn-slide btn-linkedin" data-width="95">
                                            <i class="fab fa-linkedin"></i>
                                            <span>LinkedIn</span>
                                        </a>
                                        <!-- <a class="btn btn-xs btn-slide btn-instagram" href="#" data-width="110">
                                            <i class="fab fa-instagram"></i>
                                            <span>Instagram</span>
                                        </a> -->
                                    </div>
                                </div>
                                <p>{!! htmlspecialchars_decode($page->content) !!}</p>
                            </div>
                            <!-- <div class="post-tags">
                                <a href="#">Life</a>
                                <a href="#">Sport</a>
                                <a href="#">Tech</a>
                                <a href="#">Travel</a>
                            </div> -->
                        </div>
                    </div>
                    <!-- end: Post single item-->
                </div>
            </div>
            <!-- end: content -->
        </div>
    </div>
</section>
<!-- end: Page Content -->
@endsection