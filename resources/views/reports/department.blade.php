@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col s10 m8 offset-s1 offset-m2">
    <div class="card" style="margin-top: 50px">
      <div class="card-content">
        <h5>Número de incidencias en los últimos 12 meses</h5>
        <canvas id="report1" width="400"></canvas>
      </div>
    </div>
  </div>
</div>
@endsection

@section('extra-js')
  <script src="{{ asset('/js/moment.min.js') }}"></script>
  <script src="{{ asset('js/Chart.min.js') }}"></script>
  <script>
    moment.locale('es');
    var monthNames = moment.months().map(function (month) {
      return month.charAt(0).toUpperCase() + month.slice(1);
    });
    var currentMonth = moment().month() + 1;
    var currentYear = moment().year();
    var data = {!! $data !!};

    $(document).ready(function () {
      var ctx = document.getElementById('report1');

      var ctxConfig = {
        type: 'line',
        data: {
          labels: data.map(function(d) {
            return monthNames[d.month - 1] + '-' + (d.month >= currentMonth ? currentYear - 1 : currentYear);
          }),
          datasets: [{
            label: '# de Incidencias',
            data: data.map(function(d) { return d.count; }),
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            fill: false,
            borderWidth: 3,
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
              }
            }]
          },
          animation: {
            duration: 2000,
          },
        }
      };

      var myChart = new Chart(ctx, ctxConfig);
    });
  </script>
@endsection
