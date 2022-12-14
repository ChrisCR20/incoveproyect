@extends('adminlte::page')
<!-- implementa la vista de adminlte -->

@section('title', 'Home')
<!--agregamos un titulo -->

@section('content_header')
   <!-- <h1>Colocacion</h1> -->
@stop
<!--Agregamos un header a nuestra pagina -->
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../vendor/plugins/jqvmap/jqvmap.min.css">
@section('content')
   <!-- <p>Informe de colocacion por etapa</p>-->



   <div class="row">
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>10</h3>

          <p>Ventas</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>25</h3>

          <p>Pedidos</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>44</h3>

          <p>Devoluciones</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>65</h3>

          <p>Ventas canceladas</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <div class="row">
    <div class="col-lg-12 col-12">
  <canvas id="myChart" width="400" height="150"></canvas>
    </div>
  </div>

@stop

<!--Contenido de nuestra pagina-->

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

<!--agregamos css-->

@section('js')
    <script> console.log('Hi!'); </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../vendor/jszip/jszip.min.js"></script>
<script src="../../vendor/pdfmake/pdfmake.min.js"></script>
<script src="../../vendor/pdfmake/vfs_fonts.js"></script>
<script src="../../vendor/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../vendor/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../vendor/datatables-buttons/js/buttons.colVis.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
</script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Número de ventas',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
@stop

<!--agregamos Java Script -->
