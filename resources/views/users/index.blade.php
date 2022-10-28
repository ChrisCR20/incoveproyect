@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <div class="row mb-2">
            <div class="col-sm-6">
              
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
                <li class="breadcrumb-item active">Inicio</li>
              </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <span class="float-left">
                    <a class="btn btn-primary" href="{{ route('users.create') }}">Nuevo Usuario</a>
                </span>
            </div>
            <div class="card-body">
                <table class="table" id="tablausuarios">
                    <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Roles</th>
                            <th width="280px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $val)
                                            <label class="badge badge-dark">{{ $val }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('users.show',$user->id) }}"><div><i class="fa fa-eye "></i></div></a>
                                    @can('user-edit')
                                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}"><div><i class="fa fa-edit "></i></div></a>
                                    @endcan
                                    @can('user-delete')
                                    <a  onClick="eliminar({{$user->id}});" class="edit btn btn-danger ">
                                        <div>
                                            <i class="fa fa-trash ">
                                            </i>
                                        </div>
                                    </a>
                                        {{-- {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!} --}}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $data->render() }} --}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(function () {

   var t=   $("#tablausuarios").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "language": {
       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
          }
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

    function eliminar($id)
    {
        window.location.href='users/delete/'+$id;
    }
  </script>
  @endsection