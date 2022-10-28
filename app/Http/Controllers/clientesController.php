<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class clientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('Cliente')
        ->select('id_cliente','nitcliente','nombrecliente','telefonocliente','direccioncliente')
        ->get();
    
        if(count($data) ==0){
            $etapas=[];
        }else{
        foreach($data as $data => $valor){
            $etapas[] = (array)$valor;
        }}
            //  dd($etapas);
        return view('cliente.index',['etapas'=>$etapas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
              
        return view('cliente.create');
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
        $Cliente = new Cliente;
        $Cliente->nombrecliente =$request->input('nombrecliente');
        $Cliente->telefonocliente =$request->input('telefonocliente');
        $Cliente->emailcliente =$request->input('emailcliente');
        $Cliente->nitcliente =$request->input('nitcliente');
        $Cliente->direccioncliente =$request->input('direccioncliente');
        $Cliente->save();


        return redirect()->route('clientes.index')
            ->with('success', 'Cliente creado satisfactoriamente.');
    }

    public function storecl(Request $request)
    {
        //
      //dd($request->input('nombrecliente'));

//       $mytime = Carbon::now();
// dd(Carbon::parse($mytime)->setTimezone('America/Guatemala')->format('Y-m-d'));

        $cliente = new Cliente;
        $cliente->nombrecliente =$request->input('nombrecliente');
        $cliente->nitcliente    =$request->input('identificacion');

        $cliente->save();
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
