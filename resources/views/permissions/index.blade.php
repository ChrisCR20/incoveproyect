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
                <li class="breadcrumb-item"><a href="#">Permisos</a></li>
                <li class="breadcrumb-item active">Inicio</li>
              </ol>
            </div>
          </div>
        <div class="card">
            <div class="card-header">
                @can('role-create')
                    <span class="float-left">
                        <a class="btn btn-primary" href="{{ route('permissions.create') }}">Nuevo permiso</a>
                    </span>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover" id="tablapermisos">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('permissions.show',$permission->id) }}">Show</a>
                                    @can('role-edit')
                                        <a class="btn btn-primary" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
                                    @endcan
                                    @can('role-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
        {{-- {{ $data->render() }} --}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(function () {

   var t=   $("#tablapermisos").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "language": {
       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
          }
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

    function eliminar($id)
    {
        window.location.href='permisos/delete/'+$id;
    }
  </script>
  @endsection