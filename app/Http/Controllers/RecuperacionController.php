<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecuperacionController extends Controller
{
    public function index()
    {
    	return view('auth.recuperacion.index');
    }
}
