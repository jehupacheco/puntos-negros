
@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col s10 m8 offset-s1 offset-m2">
    <div class="card" style="margin-top: 50px">
      <div class="card-content">
        <form method="POST" action="{{route('blackpoint.update', ['blackPoint' => $blackPoint])}}">
          {{csrf_field()}}
          <input id="lat-lng" name="lat-lng" class="controls" type="hidden" value="{{$location}}">
          <div class="input-field">
            <select class="controls" name="status" id="status">
              @foreach ($statuses as $status)
                <option value="{{$status->id}}" {{$blackPoint->status_id == $status->id?'selected':''}}>{{$status->name}}</option>
              @endforeach
            </select>
            <label>Status</label>
          </div>
          <div class="input-field">
            <select class="controls" name="city" id="city" onchange="searchByCity()">
              <option value="" disabled selected>Selecciona tu ciudad</option>
              @foreach ($cities as $city)
                <option value="{{$city->id}}" {{$blackPoint->city_id == $city->id?'selected':''}}>{{$city->name}}</option>
              @endforeach
            </select>
            <label>Ciudad</label>
          </div>
          <div class="input-field">
            <textarea id="detail" class="materialize-textarea" name="detail">{{$blackPoint->detail}}</textarea>
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

      var myLatLng = {lat: {!!$blackPoint->latitude!!}, lng: {!!$blackPoint->longitude!!}};

      var map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 6,
        draggable: true,
        disableDefaultUI: true,
        zoomControl: true,
      });

      var markerInit = new google.maps.Marker({
          position: myLatLng,
          map: map,
          draggable: true,
          title: '{{$blackPoint->detail}}'
      });

      markerInit.addListener('dragend', locateMarker);

      // Create the search box and link it to the UI element.
      inputLocation = document.getElementById('lat-lng');
      var input = document.createElement('input');
      var container = document.createElement('div');
      var searchBox = new google.maps.places.SearchBox(input);
      input.classList.add('help-me-please');
      input.setAttribute('placeholder', 'Ingresa una dirección');
      input.setAttribute('id', 'latLngData');
      $(input).on('keydown', function (event) {
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
      });

      container.classList.add('help-me-please-container');
      container.appendChild(input);
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(container);
      // Create the search box and link it to the UI element.
      inputLocation = document.getElementById('lat-lng');
      map.controls[google.maps.ControlPosition.TOP_LEFT].addListener('insert_at', function() {

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

          markerInit.setMap(null);

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
    document.getElementById('latLngData').focus();
  }    

  </script>

  <script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCAsXtg84E5bv3_1AGw7ys1akgLeO-3qs&libraries=places&callback=initAutocomplete"></script>
@endsection
