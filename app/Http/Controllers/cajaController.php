<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;
use DB;

class cajaController extends Controller
{
    //
    public function index(Request $request)
    {
     
    }

    public function apertura(Request $request)
    {
       $id= auth()->user()->identificacion;
       
       $empleadologueado = DB::table('empleado')
       ->join('persona','empleado.codunicoid','=','persona.codunicoid')
       ->select('empleado.id_empleado',DB::raw("concat(persona.primer_nombre,' ',persona.primer_apellido) as nombre"))
       ->where('empleado.codunicoid','=',$id)
       ->get();

       $sucursalemp= DB::table('empleado as e')
       ->join('sucursal_empleado as se','se.id_persona','=','e.id_empleado')
       ->select('se.id_sucursal')
       ->where('e.codunicoid','=',$id)
       ->get();

       $estado=DB::table('caja')
       ->select('caja.estado')
       ->where('caja.id_sucursal','=',$sucursalemp[0]->id_sucursal)
       ->where('caja.estado','=','1')
       ->get();

       if(count($estado)>0)
       {
        $estado='1';
       }
       else{
        $estado='0';
       }

       

        return view('caja.apertura',compact('empleadologueado','estado'));
    }

    public function cierre(Request $request)
    {
        return view('caja.cierre');
    }

    public function store(Request $request)
    {
        if($request->ajax())
        {
          //  dd("pero lo dudo");
          $caja = new Caja;
          $caja->id_sucursal ='1';
          $caja->fechaapertura =$request->input('fecha');
          $caja->montoinicial =$request->input('monto');
          $caja->id_empleado =$request->input('idempleado');

          $caja->save();
  
        }

    }

}
