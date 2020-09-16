<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
use App\Preguntas;
class ClienteExternoController extends Controller
{
    public function register()
    {
    	$pregutas=Preguntas::all();
    	return view('auth.register',compact('preguntas'));
    }


}
