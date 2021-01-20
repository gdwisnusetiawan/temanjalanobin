@extends('layouts.master')

@section('content')
<!-- Page title -->
<section class="no-padding">
    <!-- Google Map -->
    <div class="map" data-latitude="-37.817240" data-longitude="144.955826" data-style="light" data-info="Hello from &lt;br&gt; Inspiro Themes" data-height-lg="500" data-height-xs="200" data-height-sm="300"></div>
    <!-- end: Google Map -->
</section>
<!-- end: Page title -->
<!-- CONTENT -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-uppercase">Distributor</h3>
                <!-- Accordion -->
                <!-- <h4>Distributor</h4> -->
                <div class="accordion">
                    <div class="ac-item">
                        <h5 class="ac-title">Surabaya</h5>
                        <div class="ac-content">
                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet
                                mornings of spring which I enjoy with my whole heart.</p>
                            <p>I am alone, and feel the charm of existence in this spot, which was created for
                                the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the
                                exquisite sense of mere tranquil existence, that I neglect my talents. I should
                                be incapable of drawing a single stroke at the present moment; and yet I feel
                                that I never was a greater artist than now. </p>
                        </div>
                    </div>
                    <div class="ac-item">
                        <h5 class="ac-title">Denpasar</h5>
                        <div class="ac-content">
                            <p>When, while the lovely valley teems with vapour around me, and the meridian sun
                                strikes the upper surface of the impenetrable foliage of my trees, and but a few
                                stray gleams steal into the inner sanctuary.</p>
                            <p>I throw myself down among the tall grass by the trickling stream; and, as I lie
                                close to the earth, a thousand unknown plants are noticed by me</p>
                        </div>
                    </div>
                    <div class="ac-item">
                        <h5 class="ac-title">Jakarta</h5>
                        <div class="ac-content">
                            <p>As it floats around us in an eternity of bliss; and then, my friend, when
                                darkness overspreads my eyes, and heaven and earth seem to dwell in my soul and
                                absorb its power, like the form of a beloved mistress</p>
                            <p>I often think with longing, Oh, would I could describe these conceptions, could
                                impress upon paper all that is living so full and warm within me, that it might
                                be the mirror of my soul, as my soul is the mirror of the infinite God! O my
                                friend — but it is too much for my strength — I sink under the weight of the
                                splendour of these visions!”</p>
                        </div>
                    </div>
                </div>
                <!-- end: Accordion -->
            </div>
        </div>
    </div>
</section> <!-- end: Content -->
@endsection
@push('scripts')
<!--Google Maps files-->
<script type='text/javascript' src='//maps.googleapis.com/maps/api/js?key=AIzaSyAZIus-_huNW25Jl7RPmHgoGZjD5udgBMI'></script>
<script type="text/javascript" src="{{ asset('polo-5/plugins/gmap3/gmap3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('polo-5/plugins/gmap3/map-styles.js') }}"></script>
@endpush