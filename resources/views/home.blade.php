@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="header">Dashboard</h1>
        <div class="col s6"><a href="#">Registrar punto</a></div>
        <div class="col s6"><a href="{{route('report')}}">Reportes</a></div>
    </div>
</div>
@endsection
