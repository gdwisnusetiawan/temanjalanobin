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
            <div class="col-lg-12">
                <h3 class="text-uppercase">Distributor</h3>
                <!-- Accordion -->
                <!-- <h4>Distributor</h4> -->
                <div class="accordion">
                    @foreach($locations as $location)
                    <div class="ac-item">
                        <h5 class="ac-title" onclick="onLocationClick(this)">{{ strtoupper($location->city) }}</h5>
                        <div class="ac-content">
                            <ul class="list-group list-group-flush list-icon list-icon-arrow list-icon-colored">
                                @foreach($location->distributors as $distributor)
                                <li class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $distributor->name }}</h5>
                                        <h5>Referal ID: <span class="badge badge-primary align-self-start">{{ $distributor->referalid }}</span></h5>
                                    </div>
                                    <p class="mb-1">{{ $distributor->address }}</p>
                                    <small>{{ $distributor->telp }} / {{ $distributor->email }} <strong>({{ $distributor->contactperson }})</strong></small>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- end: Accordion -->
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
<script>
    var locations = @json($locations);
    var latitude = @json($locations->first()->distributors->first()->lat);
    var longitude = @json($locations->first()->distributors->first()->lon);
    if(latitude == null || longitude == null) {
        latitude = -7.330806854743562;
        longitude = 112.77575814271239;
    }
    var map = L.map('map').setView([latitude, longitude], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var latlngArray = [];
    locations.forEach(function (location) {
        location.distributors.forEach(function (distributor) {
            latlngArray.push([distributor.lat, distributor.lon]);
            let marker = L.marker([distributor.lat, distributor.lon]).addTo(map);
            let popup = L.popup().setContent(`<h4>${distributor.name}</h4><span>${distributor.address}</span>`);
            marker.bindPopup(popup);
            marker.on('click', onMarkerClick);
        });
    });

    var bounds = new L.LatLngBounds(latlngArray);
    map.fitBounds(bounds);

    function onMarkerClick(e) {
        let popup = e.target.getPopup();
    }

    function onLocationClick(element) {
        var location = locations.filter(function (item, index) {
            return item.city.toLowerCase() === $(element).html().toLowerCase();
        });
        // console.log(location[0].distributors);
        var centerLat = location[0].distributors[0].lat;
        var centerLon = location[0].distributors[0].lon;
        map.setView([centerLat, centerLon], 13);
    }    
</script>
@endpush