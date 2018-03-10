
@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col m-11">
        <h2>Lista de Puntos Negros</h2>
          <ul>
            <li style="min-width: 250px;"><a href="{{ route('blackpoint.index') }}" class="waves-effect waves-light btn">Ver como mapa</a></li>
          </ul>
        <table class="striped responsive" id="tDatos">
          <thead>
            <tr>
              <th width="40%">Detalle</th>
              <th class="center-align" width="12%">Ciudad</th>
              <th class="center-align" width="24%">Latitud / Longitud</th>
              <th class="center-align" width="12%">Status</th>
              <th class="center-align" width="12%">Acción</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($blackPoints as $blackPoint)
              <tr>
                <td>{{$blackPoint->detail}}</td>
                <td class="center-align">{{$blackPoint->city->name}}</td>
                <td class="center-align">{{$blackPoint->latitude}} / {{$blackPoint->longitude}}</td>
                <td class="center-align">{{$blackPoint->status->name}}</td>
                <td class="center-align"><a href="{{route('blackpoint.edit',['blackPoint' => $blackPoint])}}" class="btn btn-primary">Editar</a></td>
              </tr>
            @endforeach
          </tbody>
      
        </table>
      </div>
    </div>
  </div>
@endsection

@section('extra-js')
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js "></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $('#tDatos').DataTable({
            dom: 'Bfrtip',
            buttons: [ {
                extend: 'excelHtml5',
                customize: function( xlsx ) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
     
                    $('row c[r^="C"]', sheet).attr( 's', '2' );
                }
            } ],
            language: {
                "url":"//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });
    });
  </script>
@endsection
