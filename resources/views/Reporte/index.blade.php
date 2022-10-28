@extends('adminlte::page')
@section('plugins.Datatables', true)

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Reportes</a></li>
            <li class="breadcrumb-item active">opciones</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
            <div class="card-header" style="background-color: #4682B4">
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3></br></h3>
        
                        <p>Reporte de productos</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                      <a href="{{route('reporte.producto')}}" class="small-box-footer">
                        Ver <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <!-- small card -->
                    <div class="small-box" style="background-color: #4682B4">
                      <div class="inner">
                        <h3></br></h3>
        
                        <p>Reporte de Ventas</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                      </div>
                      <a href="{{route('reporte.ventas')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h3></br></h3>
        
                        <p>Reporte de Compras</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-credit-card"></i>
                      </div>
                      <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>

        </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
@endsection