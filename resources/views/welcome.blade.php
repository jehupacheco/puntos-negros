@extends('layouts.app')

@section('extra-css')
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="row map-container">
      <div class="col s3 detail-sidebar">
        <div class="card detail-sidebar__card">
          <div class="card-image">
            <img src="img/addPhoto.png" alt="" id="content-image">
          </div>
          <div id="content-sidebar" class="card-content">
            <p>
              Selecciona un punto en el mapa para mostrar detalles sobre el mismo.
            </p>
          </div>
          <div class="card-action">
            <a href="#">Do something</a>
          </div>
        </div>
      </div>
      <div class="col s9 detail-map">
        <div id="map"></div>
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
              console.log(location);

              return new google.maps.Marker({
                position: location,
                label: labels[i % labels.length]
              });
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
                    console.log(res);
                    $('#content-image').attr('src', 'https://maps.googleapis.com/maps/api/streetview?size=600x300&location=' + res.latitude + ',' + res.longitude + '&key=AIzaSyCVZd8XiGUXj6RdybBK61VfTQL4dQ53X8U&fov=120');
                    $('#content-sidebar').empty();
                    $('#content-sidebar').append(`
                        <p>Ciudad : ${res.city}</p>
                        <p>Creado en : ${res.created_at}</p>
                        <p>Detalle : ${res.detail}</p>
                    `);
                  }).fail(function(err){
                    console.log(err);
                  })
              })
            })

            // Add a marker clusterer to manage the markers.
            var markerCluster = new MarkerClusterer(map, markers,
                {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      }
      var locations = {!!$blackPoints!!}
    </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCAsXtg84E5bv3_1AGw7ys1akgLeO-3qs&callback=initMap"></script>
@endsection
