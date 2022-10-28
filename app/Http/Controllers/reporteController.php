<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use PDF;

class reporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *

     */
    public function index(Request $request)
    {

        
        return View('Reporte.index');

    }
    public function indexproducto(Request $request)
    {

            $productos = DB::table('producto')
            ->join('marca','marca.id_marca','=','producto.id_marca')
            ->join('categoría','categoría.id_categoria','=','producto.id_categoria')
            ->join('medida','medida.id_medida','=','producto.id_medida')
            ->select('producto.codigoproducto','producto.nombreproducto','producto.cantidad','marca.nombremarca','categoría.nombrecategoria','medida.nombremedida')
            ->orderby('producto.cantidad','asc')
            ->get();
            

          //  dd($productos);

                $pdf = PDF::loadView('Reporte.inventario.productos',compact('productos'));
                return $pdf->download('pdfview.pdf');
        
    
            return view('Reporte.inventario.productos',compact('productos'));

    }

    public function indexventas(Request $request)
    {

            $ventas = DB::table('encabezado_factura')
            ->join('detalle_factura','detalle_factura.id_encabezadof','=','encabezado_factura.id_encabezadof')
            ->join('cliente','cliente.id_cliente','=','encabezado_factura.id_cliente')
            ->join('producto','detalle_factura.id_producto','=','producto.id_producto')
            ->select('encabezado_factura.id_encabezadof','cliente.nombrecliente','encabezado_factura.montototal','producto.nombreproducto',DB::raw('producto.precio_costo * detalle_factura.cantidad as costo'),
            'detalle_factura.cantidad','detalle_factura.subtotal',DB::raw('detalle_factura.subtotal-(producto.precio_costo *detalle_factura.cantidad) as ganancia'),)
            ->orderby('encabezado_factura.id_encabezadof','asc')
            ->get();

            $totales = DB::table('encabezado_factura')
            ->join('detalle_factura','detalle_factura.id_encabezadof','=','encabezado_factura.id_encabezadof')
            ->join('cliente','cliente.id_cliente','=','encabezado_factura.id_cliente')
            ->join('producto','detalle_factura.id_producto','=','producto.id_producto')
            ->select(DB::raw('sum(producto.precio_costo * detalle_factura.cantidad) as tcosto'),
            DB::raw('sum(detalle_factura.cantidad) as tcantidad'),DB::raw('sum(detalle_factura.subtotal) as tsubtotal'),DB::raw('sum(detalle_factura.subtotal-(producto.precio_costo *detalle_factura.cantidad)) as tganancia'),)
            ->orderby('encabezado_factura.id_encabezadof','asc')
            ->get();


          // dd($totales);

                $pdf = PDF::loadView('Reporte.inventario.ventas',compact('ventas','totales'));
                return $pdf->download('ventas.pdf');
        
    
            return view('Reporte.inventario.ventas',compact('ventas'));

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
              
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
