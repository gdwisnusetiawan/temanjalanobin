<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="INSPIRO">
	<meta name="description" content="Themeforest Template Polo, html template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{ asset('polo-5/images/favicon.png') }}">   
    <!-- Document title -->
    <title>Tutoya | Today's Modern e-Commerce</title>
    <!-- Stylesheets & Fonts -->
    <link href="{{ asset('polo-5/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('polo-5/css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <!--Pageloader plugin files-->
    <link href="{{ asset('polo-5/plugins/pageloader/pageloader.css') }}" rel="stylesheet">
    <!-- SLIDER REVOLUTION 5.x STYLES  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('polo-5/plugins/slider-revolution/css/settings.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('polo-5/plugins/slider-revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('polo-5/plugins/slider-revolution/css/navigation.css') }}">

    @stack('styles')
</head>

<body data-icon="2">
    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Topbar -->
        @include('layouts.partials.topbar')
        <!-- end: Topbar -->

        <!-- Header -->
        @include('layouts.partials.header')
        <!-- end: Header -->
        
        <!-- Header -->
        @yield('content')
        <!-- end: Header -->

        <!-- Footer -->
        @include('layouts.partials.footer')
        <!-- end: Footer -->

    </div>
    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <!--Plugins-->
    <script src="{{ asset('polo-5/js/jquery.js') }}"></script>
    <script src="{{ asset('polo-5/js/plugins.js') }}"></script>
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
        var tpj = jQuery;
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

        var revapi33;
        tpj(document).ready(function () {
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
                            tmp: '<div class="tp-title-wrap"><span class="tp-arr-titleholder">Test</span></div>',
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