<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cajaController extends Controller
{
    //
    public function index(Request $request)
    {
     
    }

    public function apertura(Request $request)
    {
        return view('caja.apertura');
    }

    public function cierre(Request $request)
    {
        return view('caja.cierre');
    }

}
