@if($popup)
@switch($popup->type)
    @case(1)
        <!-- Modal Text -->
        <div id="modal-auto-open" class="modal modal-auto-open text-center cookie-notify" data-delay="{{ $popup->duration }}" data-cookie-enabled="true" data-cookie-name="cookieModal{{ $popup->id }}" data-cookie-expire="1">
            <h2 class="modal-title">{{ $popup->title }}</h2>
            <p>{!! $popup->description !!}</p>
            <a class="btn btn-light modal-close" href="#">Dismiss</a>
        </div>
        <!--end: Modal -->
        @break
    @case(2)
        <!-- Modal Shop -->
        <div id="modalShop" class="modal modal-auto-open no-padding" data-delay="{{ $popup->duration }}" style="max-width: 700px;">
            <div class="row">
                <div class="col-md-6 d-none d-sm-block no-padding" style="background: transparent url({{ $popup->image_url }}) no-repeat scroll center top / cover; height:470px;"></div>
                <div class="col-md-6">
                    <div class="p-40 p-xs-20">
                        <!-- <h2>BIG SALE <small>Up to</small></h2>
                        <h2 class="text-xl text-theme lh80 m-b-30">70%</h2> -->
                        <h2>{{ $popup->title }}</h2>
                        <p class="m-b-20">{!! $popup->description !!}</p>
                        <a class="btn btn-shadow btn-rounded btn-block m-t-10">{{ $popup->button }}</a><small class="t300">
                            <p class="text-center"><em>* Limited time Offer</em></p>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <!--end: Modal -->
        @break
    @case(3)
        <!-- Modal Subscription -->
        <div id="modalSubscriptionForm" class="modal modal-auto-open" data-delay="{{ $popup->duration }}" style="background: url({{ $popup->image_url }}) no-repeat; background-size: cover; background-position: center top;  max-width: 700px; min-height:380px">
            <div style="max-width:350px;" class="text-light p-t-30">
                <h2 class="m-b-0">{{ $popup->title }}</h2>
                <h5>{!! $popup->description !!}</h5>
                <div class="widget widget-newsletter m-b-10">
                    <form class="widget-subscribe-form" novalidate action="include/subscribe-form.php" role="form" method="post">
                        <div class="input-group">
                            <input aria-required="true" name="widget-subscribe-form-email" class="form-control required email m-b-10" placeholder="Enter your Email" type="email"><button type="submit" id="widget-subscribe-submit-button" class="btn btn-primary m-b-10">{{ $popup->button }}</button>
                        </div>
                    </form>
                </div>
                <small><em><a href="#" class="modal-close">No thank's, i want to close this window.</a></em></small>
            </div>
        </div>
        <!--end: Modal -->
        @break
    @case(4)
        <!-- Modal Login -->
        <div id="modalLogin" class="modal modal-auto-open no-padding" data-delay="{{ $popup->duration }}" style="max-width: 780px;">
            <div class="row">
                <div class="col-md-6 no-padding" style="background: transparent url({{ asset('polo-5/images/login-bg.jpg') }}) no-repeat scroll center top / cover; height:470px;">
                </div>
                <div class="col-md-6">
                    <div class="p-40 p-t-60 p-xs-20">
                        <h3>Sign up or Login</h3>
                        <form class="form-grey-fields">
                            <div class="form-group">
                                <label class="sr-only">Username or Email</label>
                                <input placeholder="Username or Email" class="form-control" type="text">
                            </div>
                            <div class="form-group m-b-5">
                                <label class="sr-only">Password</label>
                                <input placeholder="Password" class="form-control" type="password">
                            </div>
                            <div class="form-group form-inline text-left m-b-10 ">
                                <a class="right" href="#">
                                    <p><small>Lost your Password?</small></p>
                                </a>
                            </div>
                            <div class="text-left form-group">
                                <button class="btn" type="button">Login</button>
                            </div>
                        </form>
                        <p class="text-left">Don't have an account yet? <a href="#">Register New
                                Account</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--end: Modal -->
        @break
    @case(5)
        <!-- Modal Youtube -->
        <div id="modalYoutube" class="modal modal-auto-open" data-delay="{{ $popup->duration }}" style="max-width: 700px; min-height:380px">
            <div class="p-t-30 text-center">
                <h2 class="m-b-0">{{ $popup->title }}</h2>
                <h5>{!! $popup->description !!}</h5>
                <div class="iframe-wrap m-b-20">
                    <iframe id="youtube" width="560" height="315" src="https://www.youtube.com/embed/dA8Smj5tZOQ" frameborder="0" allowfullscreen></iframe>
                </div>
                <a href="#" class="btn btn-outline btn-xs btn-rounded">{{ $popup->button }} <i class="icon-chevron-right"></i></a>
            </div>
        </div>
        <!--end: Modal -->
        @break
    @case(6)
        <!-- Modal Video -->
        <div id="modalVideo" class="modal modal-auto-open" data-delay="{{ $popup->duration }}" style="max-width: 700px; min-height:380px">
            <div class="p-t-30 text-center">
                <h2 class="m-b-0">{{ $popup->title }}</h2>
                <h5>{!! $popup->description !!}</h5>
                <div class="video-wrap m-b-20">
                    <video id="video-js" class="video-js" controls loop preload="false" poster="{{ asset('polo-5/video/for-benny/for-benny.jpg') }}">
                        <source src="{{ asset('polo-5/video/for-benny/for-benny.mp4') }}" type="video/mp4" />
                        <source src="{{ asset('polo-5/video/for-benny/for-benny.webm') }}" type="video/webm" />
                    </video>
                </div>
                <a href="#" class="btn btn-outline btn-xs btn-rounded">{{ $popup->button }} <i class="icon-chevron-right"></i></a>
            </div>
        </div>
        <!--end: Modal -->
        @break
    @case(7)
        <!-- Modal Audio -->
        <div id="modalAudio" class="modal modal-auto-open" data-delay="{{ $popup->duration }}" style="background: url('{{ asset('polo-5/images/audio-bg.jpg') }}') no-repeat; background-size: cover; background-position: center top;  max-width: 700px; min-height:380px">
            <div style="max-width:300px;" class="p-t-30">
                <h2 class="m-b-0">{{ $popup->title }}</h2>
                <h5>{!! $popup->description !!}</h5>
                <div class="audio-wrap m-b-20" style="max-width:400px;">
                    <audio class="video-js vjs-default-skin" controls loop preload="false" data-setup="{}">
                        <source src="{{ asset('polo-5/audio/beautiful-optimist.mp3') }}" type="audio/mp3" />
                    </audio>
                </div>
                <a href="#" class="item-link text-dark">{{ $popup->button }} <i class="icon-chevron-right"></i></a>
            </div>
        </div>
        <!--end: Modal -->
        @break
    @default
        <!-- Modal Text -->
        <div id="modal-auto-open" class="modal modal-auto-open text-center cookie-notify" data-delay="{{ $popup->duration }}" data-cookie-enabled="false" data-cookie-name="cookieModal{{ $popup->id }}" data-cookie-expire="1">
            <h2 class="modal-title">{{ $popup->title }}</h2>
            <p>{!! $popup->description !!}</p>
            <a class="btn btn-light modal-close" href="#">Dismiss</a>
        </div>
        <!--end: Modal -->
        @break
@endswitch
@endif