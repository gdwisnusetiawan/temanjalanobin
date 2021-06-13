@extends('layouts.master')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
<style>
    #map {
        height: 360px;
    }
</style>
@endpush

@section('content')
<!-- Page title -->
<section class="no-padding">
    <!-- Google Map -->
    <!-- <div class="map" data-latitude="-37.817240" data-longitude="144.955826" data-style="light" data-info="Hello from &lt;br&gt; Inspiro Themes" data-height-lg="500" data-height-xs="200" data-height-sm="300"></div> -->
    <!-- end: Google Map -->
    
    <!-- OSM -->
    <div id="map"></div>
    <!-- end: OSM -->
</section>
<!-- end: Page title -->
<!-- CONTENT -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="text-uppercase">Get In Touch</h3>
                <!-- <p>The most happiest time of the day!. Suspendisse condimentum porttitor cursus. Duis nec nulla turpis. Nulla lacinia laoreet odio, non lacinia nisl malesuada vel. Aenean malesuada fermentum bibendum.</p>
                <p>The most happiest time of the day!. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. A true story, that never been told!. Fusce id mi diam, non ornare orci. Pellentesque ipsum erat, facilisis ut venenatis eu, sodales vel dolor.</p> -->
                <div class="row m-t-40">
                    <div class="col-lg-6">
                        <address>
                            <h6>Address</h6>
                            <p>{{ $config->address }}<br>
                            {{ $config->city }}, {{ $config->province }}</p>
                            <h6>Email</h6>
                            <p>{{ $config->email }}</p>
                            <h6>Phone</h6>
                            <p>Phone: {{ $config->telp }}</p>
                        </address>
                    </div>
                    <!-- <div class="col-lg-6">
                        <address>
                            <strong>Polo Office</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</h4> (123) 456-7890
                        </address>
                    </div> -->
                </div>
                <div class="social-icons m-t-30 social-icons-colored">
                    <ul>
                        @isset($config->facebook)
                        <li class="social-facebook"><a href="{{ $config->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                        @endisset
                        @isset($config->instagram)
                        <li class="social-instagram"><a href="{{ $config->instagram }}"><i class="fab fa-instagram"></i></a></li>
                        @endisset
                        @isset($config->twitter)
                        <li class="social-twitter"><a href="{{ $config->twitter }}"><i class="fab fa-twitter"></i></a></li>
                        @endisset
                        @isset($config->youtube)
                        <li class="social-youtube"><a href="{{ $config->youtube }}"><i class="fab fa-youtube"></i></a></li>
                        @endisset
                        @isset($config->tiktok)
                        <li class="social-tiktok"><a href="{{ $config->tiktok }}"><i class="fab fa-tiktok"></i></a></li>
                        @endisset
                        <!-- <li class="social-google"><a href="#"><i class="fab fa-google-plus-g"></i></a></li> -->
                        <!-- <li class="social-pinterest"><a href="#"><i class="fab fa-pinterest"></i></a></li> -->
                        <!-- <li class="social-vimeo"><a href="#"><i class="fab fa-vimeo"></i></a></li> -->
                        <!-- <li class="social-linkedin"><a href="#"><i class="fab fa-linkedin"></i></a></li> -->
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <form novalidate action="{{ route('sendMessage') }}" role="form" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" aria-required="true" required name="name" class="form-control required name @error('name') is-invalid @enderror" placeholder="Enter your Name">
                            @error('name')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" aria-required="true" required name="email" class="form-control required email @error('email') is-invalid @enderror" placeholder="Enter your Email">
                            @error('email')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="subject">Your Subject</label>
                            <input type="text" name="subject" required class="form-control required @error('subject') is-invalid @enderror" placeholder="Subject...">
                            @error('subject')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea type="text" name="message" required rows="5" class="form-control required @error('message') is-invalid @enderror" placeholder="Enter your Message"></textarea>
                        @error('message')
                            <small class="text-danger">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div id="g-recaptcha"></div>
                        @error('g-recaptcha-response')
                            <small class="text-danger">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                        <!-- <script src='https://www.google.com/recaptcha/api.js'></script>
                        <div class="g-recaptcha" data-sitekey="6LddCxAUAAAAAKOg0-U6IprqOZ7vTfiMNSyQT2-M"></div> -->
                    </div>
                    <button class="btn" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;Send message</button>
                </form>
            </div>
        </div>
    </div>
</section> <!-- end: Content -->
@endsection

@push('scripts')
<!--Google Maps files-->
<!-- <script type='text/javascript' src='//maps.googleapis.com/maps/api/js?key=AIzaSyAZIus-_huNW25Jl7RPmHgoGZjD5udgBMI'></script> -->
<!-- <script type="text/javascript" src="{{ asset('polo-5/plugins/gmap3/gmap3.min.js') }}"></script> -->
<!-- <script type="text/javascript" src="{{ asset('polo-5/plugins/gmap3/map-styles.js') }}"></script> -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>

<script type="text/javascript">
    var messageCaptcha;
    var onloadCallback = function() {
        messageCaptcha = grecaptcha.render('g-recaptcha', {
            'sitekey' : '{{ env("reCAPTCHA_SITE_KEY") }}'
        });
    };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
            async defer>
</script>
<script>
    var latitude = @json($config->lat ?? -7.300079733094435);
    var longitude = @json($config->lon ?? 112.76628679834859);
    var map = L.map('map').setView([latitude, longitude], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([latitude, longitude]).addTo(map);

    var popup = L.popup();

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("Surabaya")
            .openOn(map);
    }

    map.on('click', onMapClick);
</script>
@endpush