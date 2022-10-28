@extends('adminlte::page')
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
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Nuevo usuario</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                  <li class="breadcrumb-item active">Crear usuario</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        
        <div class="container-fluid">

              <!-- left column -->
              <div class="col-md-12">
                {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
                    <div class="card card-info">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Nombre</strong>
                                    {!! Form::text('name', null, array('placeholder' => 'Nombre','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Correo</strong>
                                    {!! Form::text('email', null, array('placeholder' => 'Correo','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Contraseña</strong>
                                    {!! Form::password('password', array('placeholder' => 'Contraseña','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Confirmar contraseña</strong>
                                    {!! Form::password('password_confirmation', array('placeholder' => 'Confirmar contraseña','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Elija el Rol</strong>
                                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                                </div>
                            </div>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
              </div>
            </div>
        </div>

@endsection