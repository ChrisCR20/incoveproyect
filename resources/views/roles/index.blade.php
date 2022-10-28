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
                <li class="breadcrumb-item"><a href="#">Roles</a></li>
                <li class="breadcrumb-item active">Inicio</li>
              </ol>
            </div>
          </div>
        <div class="card">
            <div class="card-header">
                @can('role-create')
                    <span class="float-left">
                        <a class="btn btn-primary" href="{{ route('roles.create') }}">Nuevo Rol</a>
                    </span>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover" id="tablaroles">
                    <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th width="280px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('roles.show',$role->id) }}"><div><i class="fa fa-eye "></i></div></a>
                                    @can('role-edit')
                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}"><div><i class="fa fa-edit "></i></div></a>
                                    @endcan
                                    @can('role-delete')
                                    <a  onClick="eliminar({{$role->id}});" class="edit btn btn-danger ">
                                        <div>
                                            <i class="fa fa-trash ">
                                            </i>
                                        </div>
                                    </a>

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
</div>
@endsection
@section('js')
<script>
    $(function () {

   var t=   $("#tablaroles").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "language": {
       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
          }
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

    function eliminar($id)
    {
        window.location.href='roles/delete/'+$id;
    }
  </script>
  @endsection