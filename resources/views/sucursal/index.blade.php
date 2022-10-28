@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('content')
<div class="container">
  <div class="justify-content-center">
      @if (\Session::has('success'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ \Session::get('success') }}</p>
          </div>
      @endif
      <div class="row mb-2">
        <div class="col-sm-6">
          
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Sucursal</a></li>
            <li class="breadcrumb-item active">Inicio</li>
          </ol>
        </div>
      </div>
      <div class="card">
          <div class="card-header">
              <span class="float-left">
                  <a class="btn btn-primary" href="{{ route('sucursal.create') }}">Registrar sucursal</a>
              </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="tablasucursal">
                  <thead class="thead-light">
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th width="280px">Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($etapas as $key => $sucursal)
                    <tr>
                        <td>{{ $sucursal['id_sucursal'] }}</td>
                        <td>{{ $sucursal['nombresucursal'] }}</td>
                        <td>{{ $sucursal['direccionsucursal'] }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('sucursal.show',$sucursal['id_sucursal']) }}"><div><i class="fa fa-eye "></i></div></a>
                            @can('user-edit')
                                <a class="btn btn-primary" href="{{ route('sucursal.edit',$sucursal['id_sucursal']) }}"><div><i class="fa fa-edit "></i></div></a>
                            @endcan
                            @can('user-delete')
                            <a  onClick="eliminar({{$sucursal['id_sucursal']}});" class="edit btn btn-danger ">
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
            </div>
              {{-- {{ $etapas->render() }} --}}
          </div>
      </div>
  </div>
</div>
@endsection
@section('js')
<script>
    $(function () {

   var t=   $("#tablasucursal").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "paging": true, "pageLength": 5,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "language": {
       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
          }
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

    function eliminar($id)
    {
      
    }
  </script>
  @endsection