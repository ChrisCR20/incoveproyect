<?php

namespace App\Http\Controllers;

use App\Models\detalle_facturaC;
use App\Models\encabezado_facturaC;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\TipoPago;
use Illuminate\Http\Request;
use Illuminate\View\ViewServiceProvider;
use Carbon\Carbon;

use DB;

class compraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        
        $producto=DB::table('Producto')->select('id_producto','nombreproducto')
        ->orderby('id_producto','desc')
        ->get();

        $tipopago=DB::table('Tipo_pago')->select('id_tipopago','nombretipo')
        ->orderby('id_tipopago','desc')
        ->get();

        $proveedor=DB::table('Proveedor')->select('id_proveedor','nombreproveedor')
        ->orderby('id_proveedor','desc')
        ->get();

        if($request->ajax())
        {


            $data = DB::table('encabezado_facturaC as ef')
            ->join('Proveedor as pr','ef.id_proveedor','=','pr.id_proveedor')
            ->select('ef.id_encabezadofacturac',DB::raw("CONCAT(ef.serie,'-',ef.numerodoctoc) as Factura"),'ef.fecha','pr.nombreproveedor','ef.totalcompra')
            ->get();
            
         //   $datos = json_decode($data,true);
            //dd($data);
            //dd(Arr::get($data,'idsedecentral'));
            if(count($data) ==0){
                $etapas=[];
            }else{
            foreach($data as $data => $valor){
                $etapas[] = (array)$valor;
            }}
           //dd($etapas[0]['idsedecentral']);

             return datatables()->of($etapas)->addColumn('action',function ($row){
                 $btn = '<button type="button" onClick="editar('.$row['id_encabezadofacturac'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';

               // $btn = '<button type="button" onClick="editar('.$row['id_sede'].');" class="edit btn btn-warning btn-sm"><div><i class="fa fa-edit"></i></div></button>';
                return $btn;
             
             })->rawColumns(['action'])->make(true);
        }
        
        return View('compra.index',['proveedor'=>$proveedor,'tipopago'=>$tipopago,'producto'=>$producto]);


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
        //
   

        $miArrayPA = $request->nmtitulo;
        // dd($miArrayPA);
        $facturaC = new encabezado_facturaC;
        $facturaC->fecha =Carbon::createFromFormat('d/m/Y',$request->input('fechafactc')); 
        $facturaC->id_proveedor = $request->input('id_proveedor');
        $facturaC->id_tipopago = $request->input('id_tipopago');
        $facturaC->serie = $request->input('serie');
        $facturaC->numerodoctoc = $request->input('numerodoctoc');
        $facturaC->save();

        $cont =0;
        if ($miArrayPA > 0)
        {
            while($cont < count($request->nmtitulo))
            {
        $detallefacturaC = new detalle_facturaC;
        $detallefacturaC->id_encabezadofacturaC =$facturaC->id_encabezadofacturaC;
        $detallefacturaC->id_producto = $request->tpgrado[$cont];;
        $detallefacturaC->subtotal =$request->nmtitulo[$cont];
        $detallefacturaC->cantidad =$request->nminstituto[$cont];
        $detallefacturaC->save();
        $cont=$cont + 1;
            }}

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
     */
    public function edit($id)
    {
        //
    }

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
