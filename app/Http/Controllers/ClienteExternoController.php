<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
use App\Preguntas;
class ClienteExternoController extends Controller
{
    public function register()
    {
    	$preguntas=Preguntas::all();
    	return view('auth.register',compact('preguntas'));
    }


    public function buscar_preguntas($id_pregunta)
    {
    	return $preguntas=Preguntas::where('id','<>',$id_pregunta)->get();
    }


}
