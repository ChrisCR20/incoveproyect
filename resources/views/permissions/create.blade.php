@extends('adminlte::page')
@section('content')
<div class="container">
    <div class="justify-content-center">
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
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Crear Permiso</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Permiso</a></li>
                  <li class="breadcrumb-item active">Crear permiso</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        
        <div class="card card-info">
            <div class="card-header">
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'permissions.store','method'=>'POST')) !!}
                    <div class="form-group">
                        <label>Nombre del permiso</label>
                        {!! Form::text('name', null, array('placeholder' => 'Nombre del permiso','class' => 'form-control')) !!}
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection