<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

use DB;
class empresaController extends Controller
{
    //
    public function create()
    {
       

        return view('empresa.create');
    }

    public function index(Request $request)
    {
       // $data = Empresa::orderBy('id_empresa', 'desc');
        $data = DB::table('empresa')
        ->select('id_empresa','nombre_empresa','descripcion')
        ->get();
   
        if(count($data) ==0){
            $etapas=[];
        }else{
        foreach($data as $data => $valor){
            $etapas[] = (array)$valor;
        }}
          //  dd($etapas);
        return view('empresa.index',['etapas'=>$etapas]);
      
    }

    public function store(Request $request)
    {
    
        $empresa = new Empresa;
        $empresa->nombre_empresa = $request->input('nombre_empresa');
        $empresa->descripcion = $request->input('descripcion');
        $empresa->save();

        return redirect()->route('empresa.index')
            ->with('success', 'Empresa creada satisfactoriamente.');
    }

    public function show()
    {
   
    }
}
