<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Sucursal;
use Illuminate\Http\Request;

use DB;

class sucursalController extends Controller
{
    //
    public function create()
    {
        $empresa=Empresa::pluck('nombre_empresa','id_empresa');

  //  return view('auth.register',compact('roles') );
       

        return view('sucursal.create',compact('empresa'));
    }

    public function index(Request $request)
    {
       // $data = Empresa::orderBy('id_empresa', 'desc');
        $data = DB::table('sucursal')
        ->select('id_sucursal','nombresucursal','direccionsucursal')
        ->get();
   
        if(count($data) ==0){
            $etapas=[];
        }else{
        foreach($data as $data => $valor){
            $etapas[] = (array)$valor;
        }}
          //  dd($etapas);
        return view('sucursal.index',['etapas'=>$etapas]);
      
    }

    public function store(Request $request)
    {
    
        $sucursal = new Sucursal;
        $sucursal->nombresucursal = $request->input('nombresucursal');
        $sucursal->direccionsucursal = $request->input('direccionsucursal');
        $sucursal->id_empresa = $request->input('id_empresa');
        $sucursal->save();

        return redirect()->route('sucursal.index')
            ->with('success', 'Sucursal creada satisfactoriamente.');
    }

    public function show()
    {
   
    }
}
