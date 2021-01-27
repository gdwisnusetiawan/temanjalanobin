@extends('layouts.master')

@section('content')
<!-- Content -->
<section id="page-content">
    <div class="container">
        <!-- post content -->
        <!-- Page title -->
        <div class="page-title">
            <h1>News - Blog Post</h1>
            <div class="breadcrumb float-left">
                <ul>
                    <li><a href="#">Home</a>
                    </li>
                    <li><a href="#">News</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end: Page title -->
        <!-- Blog -->
        <div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
            <!-- Post item-->
            <div class="post-item border shadow">
                <div class="post-item-wrap">
                    <div class="post-image">
                        <a href="#">
                            <img alt="" src="{{ asset('polo-5/images/blog/12.jpg') }}">
                        </a>
                        <span class="post-meta-category"><a href="">Lifestyle</a></span>
                    </div>
                    <div class="post-item-description">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i>Jan 21, 2017</span>
                        <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span>
                        <h2><a href="{{ route('news.single') }}">Standard post with a single image
                            </a></h2>
                        <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet.</p>
                        <a href="{{ route('news.single') }}" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end: Post item-->
            <!-- Post item-->
            <div class="post-item border shadow">
                <div class="post-item-wrap">
                    <div class="post-slider">
                        <div class="carousel dots-inside arrows-visible arrows-only" data-items="1" data-loop="true" data-autoplay="true" data-lightbox="gallery">
                            <a href="{{ asset('polo-5/images/blog/11.jpg') }}" data-lightbox="gallery-image">
                                <img alt="" src="{{ asset('polo-5/images/blog/16.jpg') }}">
                            </a>
                            <a href="{{ asset('polo-5/images/blog/16.jpg') }}" data-lightbox="gallery-image">
                                <img alt="" src="{{ asset('polo-5/images/blog/11.jpg') }}">
                            </a>
                        </div>
                        <span class="post-meta-category"><a href="">Technology</a></span>
                    </div>
                    <div class="post-item-description">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i>Jan 21, 2017</span>
                        <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span>
                        <h2><a href="#">Simplicity, a post with slider gallery</a></h2>
                        <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet.</p>
                        <a href="#" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end: Post item-->
            <!-- Post item-->
            <div class="post-item border shadow">
                <div class="post-item-wrap">
                    <div class="post-image">
                        <a href="#">
                            <img alt="" src="{{ asset('polo-5/images/blog/17.jpg') }}">
                        </a>
                        <span class="post-meta-category"><a href="">Science</a></span>
                    </div>
                    <div class="post-item-description">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i>Jan 21, 2017</span>
                        <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span>
                        <h2><a href="#">Standard post with a single image
                            </a></h2>
                        <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet.</p>
                        <a href="#" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end: Post item-->
            <!-- Post item HTML5 Audio-->
            <div class="post-item border shadow">
                <div class="post-item-wrap">
                    <div class="post-audio">
                        <a href="#">
                            <img alt="" src="{{ asset('polo-5/images/blog/audio-bg.jpg') }}">
                        </a>
                        <span class="post-meta-category"><a href="">Audio</a></span>
                        <audio class="video-js vjs-default-skin" controls preload="false" data-setup="{}">
                            <source src="audio/beautiful-optimist.mp3" type="audio/mp3" />
                        </audio>
                    </div>
                    <div class="post-item-description">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i>Jan 21, 2017</span>
                        <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span>
                        <h2><a href="#">Self Hosted HTML5 Audio (mp3) with image cover</a></h2>
                        <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet.</p>
                        <a href="#" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end: Post item-->
            <!-- Post item Vimeo-->
            <div class="post-item border shadow">
                <div class="post-item-wrap">
                    <div class="post-video">
                        <iframe src="https://player.vimeo.com/video/198559065?title=0&byline=0&portrait=0" width="560" height="376" frameborder shadow="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        <span class="post-meta-category"><a href="">Video</a></span>
                    </div>
                    <div class="post-item-description">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i>Jan 21, 2017</span>
                        <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span>
                        <h2><a href="#">This is a example post with Vimeo video</a></h2>
                        <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet.</p>
                        <a href="#" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end: Post item Vimeo-->
            <!-- Post item-->
            <div class="post-item border shadow">
                <div class="post-item-wrap">
                    <div class="post-image">
                        <a href="#">
                            <img alt="" src="{{ asset('polo-5/images/blog/18.jpg') }}">
                        </a>
                        <span class="post-meta-category"><a href="">Science</a></span>
                    </div>
                    <div class="post-item-description">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i>Jan 21, 2017</span>
                        <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span>
                        <h2><a href="#">Standard post with a single image
                            </a></h2>
                        <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet.</p>
                        <a href="#" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end: Post item-->
            <!-- Post item YouTube-->
            <div class="post-item border shadow">
                <div class="post-item-wrap">
                    <div class="post-video">
                        <iframe width="560" height="376" src="https://www.youtube.com/embed/dA8Smj5tZOQ" frameborder="0" allowfullscreen></iframe>
                        <span class="post-meta-category"><a href="">Video</a></span>
                    </div>
                    <div class="post-item-description">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i>Jan 21, 2017</span>
                        <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span>
                        <h2><a href="#">This is a example post with YouTube</a></h2>
                        <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet.</p>
                        <a href="#" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end: Post item YouTube-->
            <!-- Post item-->
            <div class="post-item border shadow">
                <div class="post-item-wrap">
                    <div class="post-slider">
                        <div class="carousel dots-inside arrows-visible arrows-only" data-autoplay="2600" data-animate-in="fadeIn" data-animate-out="fadeOut" data-items="1" data-loop="true" data-autoplay="true" data-lightbox="gallery">
                            <a href="{{ asset('polo-5/images/blog/19.jpg') }}" data-lightbox="gallery-image">
                                <img alt="" src="{{ asset('polo-5/images/blog/19.jpg') }}">
                            </a>
                            <a href="{{ asset('polo-5/images/blog/20.jpg') }}" data-lightbox="gallery-image">
                                <img alt="" src="{{ asset('polo-5/images/blog/20.jpg') }}">
                            </a>
                        </div>
                        <span class="post-meta-category"><a href="">Technology</a></span>
                    </div>
                    <div class="post-item-description">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i>Jan 21, 2017</span>
                        <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span>
                        <h2><a href="#">Simplicity, a post with slider gallery</a></h2>
                        <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet.</p>
                        <a href="#" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end: Post item-->
            <!-- Post item-->
            <div class="post-item border shadow">
                <div class="post-item-wrap">
                    <div class="post-image">
                        <a href="#">
                            <img alt="" src="{{ asset('polo-5/images/blog/14.jpg') }}">
                        </a>
                        <span class="post-meta-category"><a href="">Lifestyle</a></span>
                    </div>
                    <div class="post-item-description">
                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i>Jan 21, 2017</span>
                        <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span>
                        <h2><a href="#">Standard post with a single image
                            </a></h2>
                        <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet.</p>
                        <a href="#" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end: Post item-->
        </div>
        <!-- end: Blog -->
        <!-- Pagination -->
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item active"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
        </ul>
        <!-- end: Pagination -->
    </div>
    <!-- end: post content -->
</section> <!-- end: Content -->
@endsection