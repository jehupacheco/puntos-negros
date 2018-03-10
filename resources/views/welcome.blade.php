@extends('layouts.app')

@section('extra-css')
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="row map-container">
      <div class="col hide-on-med-and-down m3 detail-sidebar">
        <div class="card detail-sidebar__card">
          <div class="card-image" style="background-color: #CCC;">
            <img src="img/addPhoto.png" alt="" id="content-image">
          </div>
          <div id="content-sidebar" class="card-content">
            <p>
              Selecciona un punto en el mapa para mostrar detalles sobre el mismo.
            </p>
          </div>
        </div>
        @auth
          <ul style="text-align: center; margin-top: 30vh;">
            <li style="margin-bottom:20px;"><div class="divider"></div></li>
            <li style="min-width: 250px;"><a href="{{ route('blackpoint.list') }}" class="waves-effect waves-light btn">Ver como lista</a></li>
          </ul>
          @endauth
      </div>
      <a href="#" id="arrow-button" class="hide-on-large-only btn-floating btn-large waves-effect waves-light red button-floating button-collapse" data-activates="mobile-demo-2">
        <i class="material-icons">arrow_forward</i>
      </a>
      <div class="col s12 m12 l9 detail-map">
        <div id="map"></div>
      </div>


  </div>

  <div class="row side-nav" style="" id="mobile-demo-2">
    <div class="col s12 show-on-small detail-sidebar">
      <div class="card detail-sidebar__card">
        <div class="card-image">
          <img src="img/addPhoto.png" alt="" id="content-image-2">
        </div>
        <div id="content-sidebar-2" class="card-content">
          <p>
            Selecciona un punto en el mapa para mostrar detalles sobre el mismo.
          </p>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('extra-js')
    <script>
        function initMap() {

            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 5,
              center: {lat: -12.046374, lng: -77.042793},
              fullscreenControl : false
            });

            // Create an array of alphabetical characters used to label the markers.
            var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';


            // Create the search box and link it to the UI element.
            var input = document.getElementById('nav-input-search');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].addListener('insert_at', function() {
              console.log('Hola papu 2');
            });
            // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            input.style['display'] = 'block';

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
              searchBox.setBounds(map.getBounds());
            });

            searchBox.addListener('places_changed', function() {
              var places = searchBox.getPlaces();

              if (places.length == 0) {
                return;
              }

              var bounds = new google.maps.LatLngBounds();

              places.forEach(function(place) {
                if (!place.geometry) {
                  console.log("Error: Returned place contains no geometry");
                  return;
                }

                if (place.geometry.viewport) {
                  // Only geocodes have viewport.
                  bounds.union(place.geometry.viewport);
                } else {
                  bounds.extend(place.geometry.location);
                }
              });

              map.fitBounds(bounds);

            });


            // Add some markers to the map.
            // Note: The code uses the JavaScript Array.prototype.map() method to
            // create an array of markers based on a given "locations" array.
            // The map() method here has nothing to do with the Google Maps API.
            var markers = [];

            Object.keys(locations).forEach(function(key) {
              markers = markers.concat(locations[key].map(function(location, i) {
                return new google.maps.Marker({
                  position: location,
                  label: String(locations[key].length),
                });
              }));
            });

            markers.forEach(marker => {
              marker.addListener('click', function(e){
                let lat = e.latLng.lat();
                let lng = e.latLng.lng();

                //ajax request
                $.ajax({
                  url: '{{route("blackpoint.show")}}',
                  method: 'POST',
                  data: {
                    lat : lat,
                    lng : lng
                  }
                }).done(function(res){
                    $('#content-image, #content-image-2').attr('src', 'https://maps.googleapis.com/maps/api/streetview?size=600x300&location=' + res.latitude + ',' + res.longitude + '&key=AIzaSyCVZd8XiGUXj6RdybBK61VfTQL4dQ53X8U&fov=120');
                    $('#content-sidebar, #content-sidebar-2').empty();
                    $('#content-sidebar, #content-sidebar-2').append(`
                        <p>Ciudad : ${res.city}</p>
                        <p>Creado en : ${res.created_at}</p>
                        <p>Creado por : ${res.user}</p>
                        <p>Estado actual : ${res.status}</p>
                        <p>Detalle : ${res.detail}</p>
                    `);

                    if ($(window).width() < 992) {
                      $('#arrow-button').sideNav('show');
                    }
                  }).fail(function(err){
                    console.log(err);
                  })
              })
            })

            // Add a marker clusterer to manage the markers.
            var markerCluster = new MarkerClusterer(map, markers, {
              imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
              maxZoom: 15,
            });
      }
      var locations = {!!$blackPoints!!}
    </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCAsXtg84E5bv3_1AGw7ys1akgLeO-3qs&libraries=places&callback=initMap"></script>
@endsection
