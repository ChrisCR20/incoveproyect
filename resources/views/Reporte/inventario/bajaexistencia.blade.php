<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="center">
<h4 class="text-center"> Reporte de productos con baja existencia </h4>
<p class="text-center">{{date('d-m-Y H:i:s') }}</p>
</div>
<div class="">
<table class="table table-striped table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th >Codigo de producto</th>
            <th>Nombre del producto</th>
            <th>Cantidad en existencia</th>
            <th>Marca</th>
            <th>Categoria</th>
            <th>Medida</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $key => $prod)
            <tr>
                <td>{{ $prod->codigoproducto }}</td>
                <td>{{ $prod->nombreproducto }}</td>
                <td>{{ $prod->cantidad }}</td>
                <td>{{ $prod->nombremarca }}</td>
                <td>{{ $prod->nombrecategoria }}</td>
                <td>{{ $prod->nombremedida }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<footer>
    <div class="footer" style="position: absolute; bottom: 0;">
        <table width="100%">
            <tr>
                <td align="left" style="width: 50%;">
                    &copy; 2023 - All rights reserved - 
                </td>
                <td align="right" style="width: 50%;">
                    RiseSys
                </td>
            </tr>
        </table>
    </div>
</footer>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>