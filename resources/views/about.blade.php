@extends('layouts.master')

@section('content')
<!-- Page title -->
<section id="page-title" class="page-title-center text-light" style="background-image:url({{ asset('polo-5/images/parallax/2.jpg') }});">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="page-title">
            <span class="post-meta-category"><a href="">Tutoya</a></span>
            <h1>About Us</h1>
            <div class="small m-b-20">May 16, 2017 | <a href="#">by admin</a></div>
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
                    <div class="post-item-description">
                        <p>Curabitur pulvinar euismod ante, ac sagittis ante posuere ac. Vivamus luctus commodo dolor porta feugiat. Fusce at velit id ligula pharetra laoreet. Ut nec metus a mi ullamcorper hendrerit. Nulla facilisi. Pellentesque sed nibh a quam accumsan dignissim quis quis urna. The most happiest time of the day!. Praesent id dolor dui, dapibus gravida elit. Donec consequat laoreet sagittis. Suspendisse ultricies ultrices viverra. Morbi rhoncus laoreet tincidunt. Mauris interdum convallis metus.M</p>
                        <div class="blockquote">
                            <p>The world is a dangerous place to live; not because of the people who are evil, but because of the people who don't do anything about it.</p>
                            <small>by <cite>Albert Einstein</cite></small>
                        </div>
                        <p> The most happiest time of the day!. Praesent id dolor dui, dapibus gravida elit. Donec consequat laoreet sagittis. Suspendisse ultricies ultrices viverra. Morbi rhoncus laoreet tincidunt. Mauris interdum convallis metus. Suspendisse vel lacus est, sit amet tincidunt erat. Etiam purus sem, euismod eu vulputate eget, porta quis sapien. Donec tellus est, rhoncus vel scelerisque id, iaculis eu nibh.</p>
                        <p>Donec posuere bibendum metus. Quisque gravida luctus volutpat. Mauris interdum, lectus in dapibus molestie, quam felis sollicitudin mauris, sit amet tempus velit lectus nec lorem. Nullam vel mollis neque. The most happiest time of the day!. Nullam vel enim dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed tincidunt accumsan massa id viverra. Sed sagittis, nisl sit amet imperdiet convallis, nunc tortor consequat tellus, vel molestie neque nulla non ligula. Proin tincidunt tellus ac porta volutpat. Cras mattis congue lacus id bibendum. Mauris ut sodales libero. Maecenas feugiat sit amet enim in accumsan.</p>
                        <p>Duis vestibulum quis quam vel accumsan. Nunc a vulputate lectus. Vestibulum eleifend nisl sed massa sagittis vestibulum. Vestibulum pretium blandit tellus, sodales volutpat sapien varius vel. Phasellus tristique cursus erat, a placerat tellus laoreet eget. Fusce vitae dui sit amet lacus rutrum convallis. Vivamus sit amet lectus venenatis est rhoncus interdum a vitae velit.</p>
                    </div>
                </div>
            </div>
            <!-- end: Post single item-->
        </div>
    </div>
</section>
<!-- end: Page Content -->
@endsection