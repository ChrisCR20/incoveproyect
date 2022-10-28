<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\Sucursal;
use App\Models\SucursalEmpleado;
use Illuminate\Http\Request;

use DB;

class empleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  
        $data = DB::table('Persona')
        ->select('id_persona',DB::raw("CONCAT(primer_nombre,' ',primer_apellido) as nombre"),'codunicoid')
        ->get();
    
        if(count($data) ==0){
            $etapas=[];
        }else{
        foreach($data as $data => $valor){
            $etapas[] = (array)$valor;
        }}
            //  dd($etapas);
        return view('empleado.index',['etapas'=>$etapas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sucursal=Sucursal::pluck('nombresucursal','id_sucursal');

        
        return view('empleado.create',compact('sucursal'));
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
        $Persona = new Persona;
        $Persona->codunicoid = $request->input('codunicoid');
        $Persona->primer_nombre = $request->input('primer_nombre');
        $Persona->segundo_nombre = $request->input('segundo_nombre');
        $Persona->tercer_nombre = $request->input('tercer_nombre');
        $Persona->primer_apellido = $request->input('primer_apellido');
        $Persona->segundo_apellido = $request->input('segundo_apellido');
        $Persona->save();

        $Empleado = new Empleado;
        $Empleado->codunicoid =$request->input('codunicoid');
        $Empleado->tel_corporativo =$request->input('tel_corporativo');
        $Empleado->status ='1';
        $Empleado->save();

        $EmpleadoSucursal = new SucursalEmpleado;
        $EmpleadoSucursal->id_persona =$Empleado->id_empleado;
        $EmpleadoSucursal->id_sucursal =$request->input('id_sucursal');
        $EmpleadoSucursal->save();


        return redirect()->route('empleado.index')
            ->with('success', 'Empleado creado satisfactoriamente.');
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
