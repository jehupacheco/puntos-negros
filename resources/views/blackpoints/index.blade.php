
@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col m-11">
        <h2>Lista de Puntos Negros</h2>
          <ul>
            <li style="min-width: 250px;"><a href="{{ route('blackpoint.index') }}" class="waves-effect waves-light btn">Ver como mapa</a></li>
          </ul>
        <table class="striped responsive">
          <thead>
            <tr>
              <th>Detalle</th>
              <th>Ciudad</th>
              <th>Latitud / Longitud</th>
              <th>Status</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($blackPoints as $blackPoint)
              <tr>
                <td>{{$blackPoint->detail}}</td>
                <td>{{$blackPoint->city->name}}</td>
                <td>{{$blackPoint->latitude}} / {{$blackPoint->longitude}}</td>
                <td>{{$blackPoint->status->name}}</td>
                <td><a href="{{route('blackpoint.edit',['blackPoint' => $blackPoint])}}" class="btn btn-primary">Editar</a></td>
              </tr>
            @endforeach
          </tbody>
      
        </table>
      </div>
    </div>
  </div>
@endsection

@section('extra-js')

@endsection
