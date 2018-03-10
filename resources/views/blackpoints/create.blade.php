
@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col s10 m8 offset-s1 offset-m2">
    <div class="card" style="margin-top: 50px">
      <div class="card-content">
        <form method="POST" action="{{route('blackpoint.store')}}">
          <input id="lat-lng" name="lat-lng" class="controls" type="hidden">
          <div class="input-field">
            <select class="controls" name="city" id="city" onchange="searchByCity()">
              <option value="" disabled selected>Selecciona tu ciudad</option>
              @foreach ($cities as $city)
                <option value="{{$city->id}}">{{$city->name}}</option>
              @endforeach
            </select>
            <label>Ciudad</label>
          </div>
          <div class="input-field">
            <input id="latLngData" name="latLngData" type="text" style="display: none">
            {{--  <label>Ubicación</label>  --}}
          </div>
          <div class="input-field">
            <textarea id="detail" class="materialize-textarea" name="detail"></textarea>
            <label>Descripcion</label>
          </div>
          <div class="input-field">
            <input type="submit" class="btn btn-primary" name="submit" value="Guardar">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col s10 m8 offset-s1 offset-m2">
    <div id="map" style="height: 500px"></div>
  </div>
</div>
@endsection

@section('extra-js')
  <script>
    $(document).ready(function() {
      $('select').material_select();
    });

  var marker;
  var inputLocation = document.getElementById('lat-lng');
  var city = document.getElementById('city');

  function initAutocomplete() {
      var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -12.1221345, lng: -77.0211822},
        zoom: 13,
        draggable: true,
        disableDefaultUI: true,
        zoomControl: true,
      });

      // Create the search box and link it to the UI element.
      inputLocation = document.getElementById('lat-lng');
      var input = document.getElementById('latLngData');
      var searchBox = new google.maps.places.SearchBox(input);
      map.controls[google.maps.ControlPosition.TOP_LEFT].addListener('insert_at', function() {
        console.log('Hola papu');
      });
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
      input.style['display'] = 'block';


      // Bias the SearchBox results towards current map's viewport.
      map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
      });

      var markers = [];

      // Listen for the event fired when the user selects a prediction and retrieve
      // more details for that place.
      searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
          return;
        }

        // Clear out the old markers.
        markers.forEach(function(marker) {
          marker.setMap(null);
        });

        markers = [];

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();

        places.forEach(function(place) {

          if (!place.geometry) {
            console.log("Error: Returned place contains no geometry");
            return;
          }

          // Create a marker for each place.
          marker = new google.maps.Marker({
            map: map,
            title: place.name,
            position: place.geometry.location,
            draggable: true,
            title: "Arrastra el marcador al punto más cercano!",
            animation: google.maps.Animation.DROP
          });

          marker.addListener('dragend', locateMarker);
          markers.push(marker);

          inputLocation.value = JSON.stringify(marker.getPosition());

          if (place.geometry.viewport) {
            // Only geocodes have viewport.
            bounds.union(place.geometry.viewport);
          } else {
            bounds.extend(place.geometry.location);
          }
        });
        map.fitBounds(bounds);
      });

  }

  function locateMarker(e) {
      inputLocation.value = JSON.stringify(e.latLng);
  }

  function searchByCity() {
    text = city.options[city.selectedIndex].innerText;
    document.getElementById('latLngData').value = text;
  }

  </script>

  <script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCAsXtg84E5bv3_1AGw7ys1akgLeO-3qs&libraries=places&callback=initAutocomplete"></script>
@endsection
