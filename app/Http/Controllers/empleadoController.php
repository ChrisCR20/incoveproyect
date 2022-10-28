<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\Sucursal;
use App\Models\SucursalEmpleado;
use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Auth;

class empleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  
        $data = DB::table('Persona')
        ->join('Empleado','Empleado.codunicoid','=','Persona.codunicoid')
        ->join('sucursal_empleado','sucursal_empleado.id_persona','=','Empleado.id_empleado')
        ->join('sucursal','sucursal.id_sucursal','=','sucursal_empleado.id_sucursal')
        ->select('Persona.id_persona',DB::raw("CONCAT(Persona.primer_nombre,' ',Persona.primer_apellido) as nombre"),'Persona.codunicoid','sucursal.nombresucursal')
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
        $data = DB::table('persona')
        ->join('empleado','persona.codunicoid','=','empleado.codunicoid')
        ->where('persona.id_persona','=',$id)
        ->get();

        return view('empleado.profile',compact('data'));
    }

    public function perfil(){

        $id  = Auth::user()->identificacion;

        $data = DB::table('persona')
        ->join('empleado','persona.codunicoid','=','empleado.codunicoid')
        ->where('persona.codunicoid','=',$id)
        ->get();
        
        return view('empleado.profile',compact('data'));
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
        $dpi =DB::table('persona')
        ->where('id_persona','=',$id)
        ->pluck('codunicoid');
    
        $empleado =DB::table('empleado')
        ->where('codunicoid','=',$dpi)
        ->pluck('tel_corporativo');

        $data = DB::table('persona')
        ->join('empleado','persona.codunicoid','=','empleado.codunicoid')
        ->where('persona.id_persona','=',$id)
        ->get();
        
        //dd($data);
        $persona = Persona::find($id);
        $sucursal = Sucursal::pluck('nombresucursal', 'id_sucursal')->all();

    
        return view('empleado.edit', compact('data', 'sucursal'));
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
        $idemp =DB::table('persona')
        ->join("empleado","empleado.codunicoid","=","persona.codunicoid")
        ->where('id_persona','=',$id)
        ->pluck('empleado.id_empleado');
        //dd("ver");
       //dd($idemp[0]);
        $input = $request->all();

        $Empleado =Empleado::findOrFail($idemp[0]);
        $Empleado->tel_corporativo =$request->input('tel_corporativo');
        $Empleado->status ='1';
        $Empleado->save();
        
        $EmpleadoSucursal = SucursalEmpleado::findOrFail($idemp[0]);
        $EmpleadoSucursal->id_sucursal = $request->input('id_sucursal');
        $EmpleadoSucursal->save();
            
        $persona = Persona::find($id);
        $persona->update($input);
        


       

        return redirect()->route('empleado.index')->with('success', 'Empleado actualizado exitosamente.');

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
