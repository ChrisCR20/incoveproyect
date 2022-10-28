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
          <h1>Productos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Producto</a></li>
            <li class="breadcrumb-item active">Inicio</li>
          </ol>
        </div>
      </div>
      <div class="card">
          <div class="card-header">
              <span class="float-left">
                  <a class="btn btn-primary" href="{{ route('producto.create') }}"><div><i class="fa fa-plus-circle "></i></div></a>
              </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="tablaproducto">
                  <thead class="thead-light">
                    <tr>
                      <th>Codigo interno</th>
                      <th>Nombre de producto</th>
                      <th>Cantidad</th>
                      <th>Categoria</th>
                      <th>Marca </th>
                      <th>Medida</th>
                      <th width="280px">Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                   @foreach ($etapas as $key => $producto)
                    <tr>
                        <td>{{ $producto['codigoproducto'] }}</td>
                        <td>{{ $producto['nombreproducto'] }}</td>
                        <td>{{ $producto['cantidad'] }}</td>
                        <td>{{ $producto['nombrecategoria'] }}</td>
                        <td>{{ $producto['nombremarca'] }}</td>
                        <td>{{ $producto['nombremedida'] }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('producto.show',$producto['codigoproducto'] ) }}"><div><i class="fa fa-eye "></i></div></a>
                            @can('user-edit')
                                <a class="btn btn-primary" href="{{ route('producto.edit',$producto['codigoproducto'] ) }}"><div><i class="fa fa-edit "></i></div></a>
                            @endcan
                        
                            <a class="btn btn-info" href="{{ route('producto.show',$producto['codigoproducto'] ) }}"><div><i class="fa fa-list-alt "></i></div></a>
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
    $.ajaxSetup({
    headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
});
    $(function () {

   var t=   $("#tablaproducto").DataTable({
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