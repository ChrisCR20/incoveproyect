@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
   
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Caja</a></li>
          <li class="breadcrumb-item active">Apertura</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

  {!! Form::open(array('route' => 'empleado.store','method'=>'POST')) !!}

    <div class="card">
      <div class="card-header" style="background-color:  #5F9EA0 ">
        <h3 style="color:white">Apertura de caja</h3>
        <span class="float-right">
          <a class="btn btn-light btn-sm" href="/"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
        </span>
      </div>
      <!-- /.card-header -->
      
      <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                  <label>Usuario que apertura</label>
                  {!! Form::text('codunicoid',null, array('placeholder' => 'Usuario','class' => 'form-control','required','disabled')) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Fecha</label>
                  {!! Form::text('codunicoid',date('Y-m-d'), array('placeholder' => 'Fecha','class' => 'form-control','required','disabled')) !!}
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Monto de apertura</label>
                  {!! Form::text('codunicoid', null, array('placeholder' => 'Monto','class' => 'form-control','required')) !!}
                </div>
              </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-success float-right">Guardar</button>
      </div>
    </div>
    <!-- /.card -->
  {!! Form::close() !!}
@endsection
@section('js')

<script>

  </script>
  @endsection