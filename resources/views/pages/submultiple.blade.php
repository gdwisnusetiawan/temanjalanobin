@extends('layouts.master')

@section('meta-description', strip_tags(htmlspecialchars_decode($page->description)))
@section('title', $page->title)

@section('content')
<!-- Page Content -->
<section id="page-content" class="sidebar-right">
    <div class="container">
        <div class="row">
            <!-- content -->
            <div class="content col-lg-9">
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
                                    <span class="post-meta-category"><a href=""><i class="fa fa-tag"></i>News</a></span>
                                    <span class="post-meta-category"><a href=""><i class="fa fa-eye"></i>{{ $page->views ?? 0 }} Views</a></span>
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
                            <div class="post-navigation">
                                @if($prev_page && $prev_page->multipage)
                                <a href="{{ route('page.show', [$prev_page->multipage->slug, $prev_page->slug]) }}" class="post-prev">
                                    <div class="post-prev-title"><span>Previous Post</span>{{ $prev_page->title }}</div>
                                </a>
                                @endif
                                <a href="{{ route('page.index', $page->multipage->slug) }}" class="post-all">
                                    <i class="icon-grid"> </i>
                                </a>
                                @if($next_page && $next_page->multipage)
                                <a href="{{ route('page.show', [$next_page->multipage->slug, $next_page->slug]) }}" class="post-next">
                                    <div class="post-next-title"><span>Next Post</span>{{ $next_page->title }}</div>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- end: Post single item-->
                </div>
            </div>
            <!-- end: content -->
            <!-- Sidebar-->
            <div class="sidebar sticky-sidebar col-lg-3">
                <!--widget newsletter-->
                <div class="widget  widget-newsletter">
                    <form id="widget-search-form-sidebar" action="search-results-page.html" method="get">
                <div class="input-group">
                    <input type="text" aria-required="true" name="q" class="form-control widget-search-form" placeholder="Search for pages...">
                    <div class="input-group-append">
                    <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form></div>
                <!--end: widget newsletter-->
                <!--Tabs with Posts-->
                <div class="widget">
                    <div class="tabs">
                        <ul class="nav nav-tabs" id="tabs-posts" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#popular" role="tab" aria-controls="popular" aria-selected="true">Popular</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#recent" role="tab" aria-controls="recent" aria-selected="false">Recent</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tabs-posts-content">
                            <div class="tab-pane fade show active" id="popular" role="tabpanel" aria-labelledby="popular-tab">
                                <div class="post-thumbnail-list">
                                    @foreach($populars as $popular)
                                    <div class="post-thumbnail-entry">
                                        <img alt="" src="{{ $popular->media['url'][0] }}">
                                        <div class="post-thumbnail-content">
                                            <a href="#">{{ $popular->title }}</a>
                                            <span class="post-date"><i class="icon-clock"></i> {{ $popular->datetime_diff }}</span>
                                            <span class="post-category"><i class="fa fa-eye"></i> {{ $popular->views }} views</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="recent" role="tabpanel" aria-labelledby="recent-tab">
                                <div class="post-thumbnail-list">
                                    @foreach($recents as $recent)
                                    <div class="post-thumbnail-entry">
                                        <img alt="" src="{{ $recent->media['url'][0] }}">
                                        <div class="post-thumbnail-content">
                                            <a href="#">{{ $recent->title }}</a>
                                            <span class="post-date"><i class="icon-clock"></i> {{ $recent->datetime_diff }}</span>
                                            <!-- <span class="post-category"><i class="fa fa-tag"></i> Tag</span> -->
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End: Tabs with Posts-->
            </div>
            <!-- end: Sidebar-->
        </div>
    </div>
</section>
<!-- end: Page Content -->
@endsection