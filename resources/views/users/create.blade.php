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
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                    <li class="breadcrumb-item active">Nuevo</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
        <div class="container-fluid">

              <!-- left column -->
              <div class="col-md-12">
                {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
                    <div class="card">
                        <div class="card-header" style="background-color:  #5F9EA0 ">
                            <h3 style="color:white">Nuevo usuario</h3>
                            <span class="float-right">
                                <a class="btn btn-light btn-sm" href="{{ route('users.index') }}"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
                            </span>
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
                            <div class="float-right">
                                <button type="submit" class="btn btn-success right">Guardar</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
              </div>
            </div>
        </div>

@endsection