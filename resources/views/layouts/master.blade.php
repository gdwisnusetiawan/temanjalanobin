<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="WEBIDUS">
	<meta name="description" content="@hasSection('meta-description') @yield('meta-description') @else new e-commerce, webidus digital marketing and technology @endif">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="@isset($config) {{ asset($config->favicon_url) }} @endisset">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Document title -->
    <title>@hasSection('title') @yield('title') @else {{ $config->description ?? "Today's Modern e-Commerce" }} @endif | {{ $config->title ?? config('app.name', 'Tutoya') }}</title>
    <!-- Bootstrap datetimepicker css -->
    <link href="{{ asset('polo-5/plugins/bootstrap-datetimepicker/tempusdominus-bootstrap-4.css') }}" rel="stylesheet">
    <!-- Stylesheets & Fonts -->
    <link href="{{ asset('polo-5/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('polo-5/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('polo-5/css/custom.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <!--Pageloader plugin files-->
    <link href="{{ asset('polo-5/plugins/pageloader/pageloader.css') }}" rel="stylesheet">
    <!-- SLIDER REVOLUTION 5.x STYLES  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('polo-5/plugins/slider-revolution/css/settings.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('polo-5/plugins/slider-revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('polo-5/plugins/slider-revolution/css/navigation.css') }}">
    <style>
        .cart-product-quantity .qty {
            max-width: 60px;
        }
    </style>
    @stack('styles')
</head>

<body data-icon="{{ $loader }}">
    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Topbar -->
        @include('layouts.partials.topbar')
        <!-- end: Topbar -->

        <!-- Header -->
        @if(request()->is('dashboard*'))
            @include('layouts.partials.header')
        @else
            @include('layouts.partials.header')
        @endif
        <!-- end: Header -->
        
        <!-- Header -->
        @yield('content')
        <!-- end: Header -->

        <!-- Footer -->
        @include('layouts.partials.footer')
        <!-- end: Footer -->

    </div>
    <!-- Whatsapp float -->
    <a id="whatsappFloat" href="https://wa.me/62{{ session('user_referer')->nohp ?? (isset($footer) ? $footer->whatsapp : '') }}?text=Mohon info lebih lanjut" class="btn-link wa-float" target="_BLANK">
        <i class="fab fa-whatsapp"></i><i class="fab fa-whatsapp"></i>
    </a>
    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <!--Plugins-->
    <script src="{{ asset('polo-5/js/jquery.js') }}"></script>
    <script src="{{ asset('polo-5/js/plugins.js') }}"></script>
    <!--Bootstrap Datetimepicker component-->
    <script src="{{ asset('polo-5/plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('polo-5/plugins/bootstrap-datetimepicker/tempusdominus-bootstrap-4.js') }}"></script>
    <!--Template functions-->
    <script src="{{ asset('polo-5/js/functions.js') }}"></script>
    <!-- jQuery Validate plugin files-->
    <script src="{{ asset('polo-5/plugins/validate/validate.min.js') }}"></script>
    <script src="{{ asset('polo-5/plugins/validate/valildate-rules.js') }}"></script>
    <!--Pageloader plugin files-->
    <script src="{{ asset('polo-5/plugins/pageloader/pageloader.js') }}"></script>
    <script src="{{ asset('polo-5/plugins/pageloader/pageloader.init.js') }}"></script>

    <!-- SLIDER REVOLUTION 5.x SCRIPTS  -->
    <script type="text/javascript" src="{{ asset('polo-5/plugins/slider-revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('polo-5/plugins/slider-revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('polo-5/plugins/slider-revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('polo-5/plugins/slider-revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('polo-5/plugins/slider-revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('polo-5/plugins/slider-revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('polo-5/plugins/slider-revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('polo-5/plugins/slider-revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('polo-5/plugins/slider-revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('polo-5/plugins/slider-revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('polo-5/plugins/slider-revolution/js/extensions/revolution.extension.video.min.js') }}"></script>

    @stack('scripts')

    <script type="text/javascript">
        function formatCurrency(nominal, currency = 'Rp') {
            return currency+nominal.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".")+',00';
        }

        function onSubmit() {
            $('#button-spinner').show();
            $('#button-submit .btn-text').html('Loading...');
            $('#button-submit').prop('disabled', true);
            // $('#button-cancel').prop('disabled', true);
        }

        function onSubmitButton(button) {
            $(button+' .button-spinner').show();
            $(button+' .btn-text').html('Loading...');
            $(button).prop('disabled', true);
        }

        function printPage(title) {
            var printContents = document.getElementById('print-page').innerHTML;
            var originalContents = document.body.innerHTML;
            var originalTitle = document.title;
            document.title = title;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
            document.title = originalTitle;
        }

        function loading() {
            $(".body-inner").fadeOut("slow");

            setTimeout(function () {
                var loader = `<div class="animsition-loading">
                    <div class="loader">
                        <div class="loader-inner ball-grid-pulse">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>`;
                // $("body").append('<div class="animsition-loading"><div class="loader"><div class="spinner"><div class="right-side"><div class="bar"></div></div><div class="left-side"><div class="bar"></div></div></div></div></div>');
                $("body").append(loader);

            }, 1000);
            setTimeout(function () {
                $(".body-inner").fadeIn("slow");
                $("body").find(".animsition-loading").fadeOut("slow");

            }, 3000);
        }

        // Bootstrap Notify Generator
        function notify(message, title, icon, options = null) {
            var content = {};
            if(options == null) {
                var options = {
                    url: false,
                    spacing: 10,
                    offsetX: 30,
                    offsetY: 30,
                    mouseOver: true,
                    type: 'success',
                    dismiss: true,
                    timer: 1000,
                    newsetOnTop: true,
                    progressBar: false,
                    delay: 1000,
                    zindex: 10000,
                    animateEnter: 'fadeInDown',
                    animateExit: 'fadeOutDown',
                    position: 'top-right'
                }
            }
            var elemURL = options.url,
                elemSpacing = options.spacing,
                elemOffsetX = options.offsetX,
                elemOffsetY = options.offsetY,
                elemMouseOver = options.mouseOver,
                elemType = options.type,
                elemAllowDismiss = options.dismiss,
                elemTimer = options.timer,
                elemNewestOnTop = options.newsetOnTop,
                elemPorgressBar = options.progressBar,
                elemDelay = options.delay,
                elemZindex = options.zindex,
                elemAnimateEnter = options.animateEnter,
                elemAnimateExit = options.animateExit,
                elemPosition = options.position;
            content.message = message ?? 'Message';
            content.title = title ?? 'Notification';
            if(title.toLowerCase() == 'success') {
                icon = 'fas fa-check-circle';
                elemType = 'success';
            }
            else if(title.toLowerCase() == 'danger' || title.toLowerCase() == 'error') {
                icon = 'fas fa-times-circle';
                elemType = 'danger';
            }
            else if(title.toLowerCase() == 'warning') {
                icon = 'fas fa-exclamation-circle';
                elemType = 'warning';
            }
            else if(title.toLowerCase() == 'info') {
                icon = 'fas fa-info-circle';
                elemType = 'info';
            }
            content.icon = icon ?? '';
            if (elemURL) {
                content.url = "{{ url('/') }}";
            }
            var notify = $.notify(content, {
                spacing: elemSpacing,
                mouse_over: elemMouseOver,
                type: elemType,
                allow_dismiss: elemAllowDismiss,
                timer: elemTimer,
                newest_on_top: elemNewestOnTop,
                showProgressbar: elemPorgressBar,
                placement: {
                    from: elemPosition.split("-")[0],
                    align: elemPosition.split("-")[1]
                },
                template: '<div data-notify="container" class="bootstrap-notify col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                    '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                    '<span data-notify="icon"></span> ' +
                    '<span data-notify="title">{1}</span> ' +
                    '<span data-notify="message">{2}</span>' +
                    '<div class="progress" data-notify="progressbar">' +
                    '<div class="p-progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>',
                offset: {
                    x: elemOffsetX,
                    y: elemOffsetY
                },
                delay: elemDelay,
                z_index: elemZindex,
                animate: {
                    enter: 'animated ' + elemAnimateEnter,
                    exit: 'animated ' + elemAnimateExit
                }
            });
            if ($('#notify_progress_bar').prop('checked')) {
                notify.update('title', '<strong>Saving</strong>');
                notify.update('message', 'Creating user.');
                notify.update('progress', 0);
                setTimeout(function () {
                    notify.update('message', 'Adding data.');
                    notify.update('type', 'success');
                    notify.update('progress', 25);
                }, 1000);
                setTimeout(function () {
                    notify.update('message', 'Updating profile.');
                    notify.update('type', 'success');
                    notify.update('progress', 50);
                }, 2000);
                setTimeout(function () {
                    notify.update('message', 'Creating account.');
                    notify.update('type', 'success');
                    notify.update('progress', 75);
                }, 3000);
                setTimeout(function () {
                    notify.update('message', '<strong>Checking</strong> for errors.');
                    notify.update('type', 'success');
                    notify.update('progress', 85);
                }, 4000);
                setTimeout(function () {
                    notify.update('message', '<strong>Completed</strong>.');
                    notify.update('type', 'success');
                    notify.update('progress', 100);
                }, 4000);
            }
        }
        var tpj = jQuery;

        var revapi33;
        tpj(document).ready(function () {
            @if(session('notify'))
                notify("{{ session('notify')['message'] }}", "{{ session('notify')['type'] }}");
            @endif
            // notify("testing", "Success");
            // notify("Testing", "Danger");
            // notify("Testing", "Warning");
            // notify("Testing", "Info");
            // loading();
            if (tpj("#rev_slider_33_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_33_1");
            } else {
                revapi33 = tpj("#rev_slider_33_1").show().revolution({
                    sliderType: "standard",
                    jsFileLocation: "plugins/slider-revolution/js/",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        onHoverStop: "on",
                        touch: {
                            touchenabled: "on",
                            swipe_threshold: 75,
                            swipe_min_touches: 50,
                            swipe_direction: "horizontal",
                            drag_block_vertical: false
                        },
                        arrows: {
                            style: "ares",
                            enable: true,
                            hide_onmobile: true,
                            hide_under: 600,
                            hide_onleave: true,
                            hide_delay: 200,
                            hide_delay_mobile: 1200,
                            // tmp: '<div class="tp-title-wrap"><span class="tp-arr-titleholder"></span></div>',
                            left: {
                                h_align: "left",
                                v_align: "center",
                                h_offset: 0,
                                v_offset: 0
                            },
                            right: {
                                h_align: "right",
                                v_align: "center",
                                h_offset: 0,
                                v_offset: 0
                            }
                        }
                    },
                    responsiveLevels: [1240, 1024, 778, 480],
                    visibilityLevels: [1240, 1024, 778, 480],
                    gridwidth: [1170, 1024, 778, 480],
                    gridheight: [700, 600, 700, 400],
                    lazyType: "smart",
                    shadow: 0,
                    spinner: "off",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }
        }); /*ready*/
    </script>

</body>

</html>