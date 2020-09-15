<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ventas;
use App\Promociones;
use App\EmpleadosVentas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ventas = Ventas::all();
        $promociones = Promociones::all();
        $empleados_ventas = EmpleadosVentas::all();
        return view('home', compact('ventas','promociones','empleados_ventas'));
    }
}
