@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col s10 m8 offset-s1 offset-m2">
    <div class="card" style="margin-top: 50px">
      <div class="card-content">
        <h5>Número de incidencias por departamento</h5>
        <canvas id="report1" width="400"></canvas>
      </div>
    </div>
  </div>
</div>

@endsection

@section('extra-js')
  <script src="{{ 'js/Chart.min.js'}}"></script>
  <script>
    $(document).ready(function () {
      var data = {!! json_encode($data) !!}
      var ctx = document.getElementById('report1');
      var ctxConfig = {
        type: 'bar',
        data: {
          labels: data.map(function(d) { return d.name; }),
          datasets: [{
            label: '# de Incidencias',
            data: data.map(function(d) { return d.count; }),
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
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

      ctx.addEventListener('click', function (evt) {
        var activeElement = myChart.getElementAtEvent(evt);
        var label = ctxConfig.data.labels[activeElement[0]._index];
        var item = data.filter(function (d) {
          return d.name === label;
        })[0];

        window.location = '/departamento/' + item.city_id;
      }, false);
    });
  </script>
@endsection
