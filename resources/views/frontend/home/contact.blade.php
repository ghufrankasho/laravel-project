@extends('layouts.master')

@section('content')
<div class="breadcrumb-area breadcrumb-bg-3 pt-50 pb-70 mb-100" style="margin-left: 0px;margin-right: 0px;">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <h1 class="breadcrumb-title"> {{ __('messages.CONTACT US') }}</h1>

                <!--=======  breadcrumb list  =======-->

                <ul class="breadcrumb-list">
                    <li class="breadcrumb-list__item">
                        <a href="{{ url(app()->getLocale()) }}" rel="alternate" hreflang="{{ app()->getLocale() }}">
                            {{ __('messages.HOME') }}
                        </a>
                    </li>
                    <li class="breadcrumb-list__item breadcrumb-list__item--active">
                        {{ __('messages.CONTACT US') }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@if (session()->has('successSend'))
    <div class="alert alert-success">
        {{ session()->get('successSend') }}
    </div>
@endif


<div class="section-title-container mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--=======  section title  =======-->

                <div class="section-title section-title--one text-center">
                    {{-- <p class="subtitle subtitle--deep">
                        {{ __('messages.COME HAVE A LOOK') }}
                    </p> --}}
                    <h1>
                        {{ __('messages.CONTACT DETAILS') }}
                    </h1>
                </div>

                <!--=======  End of section title  =======-->
            </div>
        </div>
    </div>
</div>

<!--=====  End of section title container ======-->


<!--=============================================
 =            icon box area         =
 =============================================-->

<div class="icon-box-area mb-100 mb-md-30 mb-sm-30">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-md-70 mb-sm-70">
                <!--=======  single icon box  =======-->

                <div class="single-icon-box">
                    <div class="icon-box-icon" style="margin-top: 30px;">
                        <i class="ion-location"></i>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="title"> {{ __('messages.ADDRESS ') }}</h3>
                        <p class="content">
                            {{-- {{ __('messages.UAE') }} : --}}
                        
                    {{ isset($settings['uae-address']) ? unserialize($settings['uae-address']) : '' }}
                
                        </p>
                    </div>
                </div>
                
                <div class="single-icon-box" style="margin-top: 8px;">
                    <div class="icon-box-icon" >
                        <i class="ion-location"></i>
                    </div>
                    <div class="icon-box-content" style="">
                     
                        <p class="content" >
                            {{-- {{ __('messages.TR') }} : --}}
                             
                    {{ isset($settings['tr-address']) ? unserialize($settings['tr-address']) : '' }}
                   
                        </p>
                    </div>
                </div>

                <!--=======  End of single icon box  =======-->
            </div>
            <div class="col-md-4 mb-md-70 mb-sm-70">
                <!--=======  single icon box  =======-->

                <div class="single-icon-box mb-10">
                    <div class="icon-box-icon" style="margin-top: 30px;">
                        <i class="ion-ios-telephone"></i>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="title">{{ __('messages.PHONE') }}</h3>
                        <p class="content">
                            {{ __('messages.UAE') }} :
                            <label style="direction:ltr !important">{{ isset($settings['uae-phone']) ? unserialize($settings['uae-phone']) : '' }}</label>
                        </p>
                    </div>
                </div>
                <div class="single-icon-box mb-10">
                    <div class="icon-box-icon" style="">
                        <i class="ion-ios-telephone"></i>
                    </div>
                    <div class="icon-box-content">
                    
                        <p class="content">
                            {{ __('messages.TR') }} :
                            <label style="direction:ltr !important">{{ isset($settings['tr-phone']) ? unserialize($settings['tr-phone']) : '' }}</label>
                        </p>
                    </div>
                </div>

                <div class="single-icon-box">
                    <div class="icon-box-icon">
                        <i class="ion-ios-email"></i>
                    </div>
                    <div class="icon-box-content">
                        <p class="content">
                            {{ __('messages.EMAIL') }}
                            {{ isset($settings['email']) ? unserialize($settings['email']) : '' }}
                        </p>
                    </div>
                </div>

                <!--=======  End of single icon box  =======-->
            </div>
            <div class="col-md-4 mb-md-70 mb-sm-70">
                <!--=======  single icon box  =======-->

                <div class="single-icon-box">
                    <div class="icon-box-icon"style="margin-bottom: 90px;">
                        <i class="ion-ios-clock-outline"></i>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="title">
                            {{ __('messages.HOUR OF OPERATION') }}
                        </h3>
                        <p class="content">
                            <p class="whitecolor footer-12">
                                {{ __('messages.Our support available to help you 24 hours a day, seven days week') }} </p>
                            <ul class="hours_links whitecolor">
                                <li>
                                    {{-- <span>{{ __('messages.Saturday to Thursday:') }}</span> --}}
                                    @if(app()->getLocale() == 'ar')
                        <li><span>{{ isset($settings['ar-work-hours']) ? unserialize($settings['ar-work-hours']) : '' }}</span></li>
                    @else
                    <li><span>{{ isset($settings['en-work-hours']) ? unserialize($settings['en-work-hours']) : '' }}</span></li>
                    @endif
                                </li>
                                {{-- <p class="whitecolor">{{ __('messages.Friday weekend') }}</p> --}}
                        </p>
                    </div>
                </div>

                <!--=======  End of single icon box  =======-->
            </div>
        </div>
    </div>
</div>

<!--=====  End of icon box area  ======-->

<!--=============================================
 =            box layout map         =
 =============================================-->

<!--<div class="box-layout-map-area mb-100">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-lg-12">-->
                <!--=======  box layout map container  =======-->

<!--                <div class="box-layout-map-container">-->
<!--                    <div class="google-map" id="google-map-one"></div>-->
<!--                </div>-->

                <!--=======  End of box layout map container  =======-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--=====  End of box layout map  ======-->

<!--=============================================
 =            section title  container      =
 =============================================-->

<div class="section-title-container mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--=======  section title  =======-->

                <div class="section-title section-title--one text-center">
                    <h1>
                        {{ __('messages.GET IN TOUCH') }}
                    </h1>
                </div>

                <!--=======  End of section title  =======-->
            </div>
        </div>
    </div>
</div>

<!--=====  End of section title container ======-->


<!--=============================================
 =            contact form area         =
 =============================================-->

<div class="contact-form-area mb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="lezada-form contact-form">
                    <form id="contact-form" action="{{ route('contact', app()->getLocale()) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-40">
                                <input type="text" placeholder="{{ __('messages.YOUR NAME*') }}" name="customerName"
                                    id="customername" required>
                            </div>
                            <div class="col-md-6 mb-40">
                                <input type="email" placeholder="{{ __('messages.EMAIL ADDRESS*') }}"
                                    name="customerEmail" id="customerEmail" required>
                            </div>
                            <div class="col-lg-12 mb-40">
                                <input type="text" placeholder="{{ __('messages.SUBJECT*') }}" name="contactSubject"
                                    id="contactSubject">
                            </div>
                            <div class="col-lg-12 mb-40">
                                <textarea cols="30" rows="10" placeholder="{{ __('messages.YOUR MESSAGE*') }}" name="contactMessage"
                                    id="contactMessage"></textarea>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" value="submit" id="submit"
                                    class="lezada-button lezada-button--medium star">{{ __('messages.SEND') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <p class="form-messege pt-10 pb-10 mt-10 mb-10"></p>
            </div>
        </div>
    </div>
</div>
<h3 class="stay" style="margin-bottom: 30px;text-align: center;">
    {{ __('messages.STAY CONNECTED WITH US') }}</h3>
<div class="shop-product__buttons les mb-43" style="text-align: center;">

    <a href="{{ isset($settings['whatsup']) ? unserialize($settings['whatsup']) : '' }}"
    rel="alternate" hreflang="{{ app()->getLocale() }}"
        class="  "
        style=" padding: 10px 0px;font-size: 18px;">{{ __('messages.For any inquiries click here') }}
        <i class="fa fa-whatsapp"></i>
    </a>
</div>
<!--=====  End of contact form area  ======-->

<!-- Google Map -->
<script
    src="https://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.22&key=AIzaSyChs2QWiAhnzz0a4OEhzqCXwx_qA9ST_lE">
</script>

<script>
    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 12,

            scrollwheel: false,

            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(24.154497146606445, 55.82213592529297), // New York

            // How you would like to style the map. 
            // This is where you would paste any style found on

            styles: [{
                    "featureType": "landscape.man_made",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#f7f1df"
                    }]
                },
                {
                    "featureType": "landscape.natural",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#d0e3b4"
                    }]
                },
                {
                    "featureType": "landscape.natural.terrain",
                    "elementType": "geometry",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "poi.business",
                    "elementType": "all",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "poi.medical",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#fbd3da"
                    }]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#bde6ab"
                    }]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "road",
                    "elementType": "labels",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#ffe15f"
                    }]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#efd151"
                    }]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#ffffff"
                    }]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "black"
                    }]
                },
                {
                    "featureType": "transit.station.airport",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#cfb2db"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#a2daf2"
                    }]
                }
            ]
        };

        // Get the HTML DOM element that will contain your map 
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('google-map-one');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(24.154497146606445, 55.82213592529297),
            map: map,
            title: 'Our Location',
            icon: "{{ asset('frontend/images/map-marker.png') }}",
            animation: google.maps.Animation.BOUNCE
        });
    }
</script>
@endsection
