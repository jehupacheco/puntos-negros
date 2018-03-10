@extends('layouts.app')

@section('content')
  <div class="row">
      <div class="col s3" style="padding: 0px;">
        <div class="card" style="margin: 0px;">
          <div class="card-image">
            <img src="img/addPhoto.png" alt="">
          </div>
          <div class="card-content">
            <p>
              Selecciona un punto en el mapa para mostrar detalles sobre el mismo.
            </p>
          </div>
          <div class="card-action">
            <a href="#">Do something</a>
          </div>
        </div>
      </div>
      <div class="col s9" style="padding: 0px;">
        <div id="map" style="height: 90vh; width: 100%"></div>
      </div>
  </div>
@endsection

@section('extra-js')
    <script>
        function initMap() {

            var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: {lat: -12.046374, lng: -77.042793}
            });

            // Create an array of alphabetical characters used to label the markers.
            var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // Add some markers to the map.
            // Note: The code uses the JavaScript Array.prototype.map() method to
            // create an array of markers based on a given "locations" array.
            // The map() method here has nothing to do with the Google Maps API.
            var markers = locations.map(function(location, i) {
            return new google.maps.Marker({
                position: location,
                label: labels[i % labels.length]
            });
            });

            // Add a marker clusterer to manage the markers.
            var markerCluster = new MarkerClusterer(map, markers,
                {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      }
      var locations = {!!$blackPoints!!}
    </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCAsXtg84E5bv3_1AGw7ys1akgLeO-3qs&callback=initMap"></script>
@endsection
