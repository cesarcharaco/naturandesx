<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
use App\Promociones;
use App\Ventas;
use App\EmpleadosVentas;
use App\Empleados;
date_default_timezone_set('America/Santiago');
setlocale(LC_ALL, 'es_ES');
class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promociones=Promociones::all();
        $clientes=Clientes::all();
        $ventas=Ventas::all();
        
        return view('ventas.index', compact('clientes','promociones','ventas'));
    }
    public function ventas($rut)
    {
        $ventas=Ventas::all();
        $promociones=Promociones::all();
        $clientes=Clientes::where('rut',$rut)->first();
        $id=$clientes->id;
        $nombres=$clientes->nombres;
        $apellidos=$clientes->apellidos;
        $rut=$clientes->rut;
        //dd($clientes->id);
        
        return view('ventas.ventas', compact('clientes','promociones','id','nombres','apellidos','rut','ventas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //dd(count($request->id_promocion));
        for ($i=0; $i < count($request->id_promocion); $i++) { 
            
            $ventas = new Ventas();
            $ventas->id_cliente=$request->id_cliente;
            $ventas->id_promocion=$request->id_promocion[$i];
            $ventas->cantidad=$request->cantidad[$i];
            $ventas->monto_total=$request->monto_total;
            $ventas->save();
            // dd($ventas->id);
            $empleado=Empleados::where('id_usuario',\Auth::User()->id)->first();
            
            $registro = new EmpleadosVentas();
            $registro->id_empleado=$empleado->id;
            $registro->id_venta=$ventas->id;
            $registro->save();
        }


        toastr()->success('Éxito!!', ' Venta registrada satisfactoriamente');
        return redirect()->to('ventas');
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


    public function historial($desde, $hasta, $opcion)
    {

        if ($opcion == 1) {            
            $cliente=Clientes::where('id_usuario',\Auth::User()->id)->first();
            return \DB::table('ventas')
            ->select('clientes.*','ventas.*','ventas.created_at as fecha','ventas.id as id_venta','users.*','promociones.*')
            ->join('clientes','clientes.id','=','ventas.id_cliente')
            ->join('users','users.id','=','clientes.id_usuario')
            ->join('promociones','promociones.id','=','ventas.id_promocion')
            ->whereBetween('ventas.created_at', array($desde." 00:00:00", $hasta." 23:59:59"))
            ->where('clientes.id',$cliente->id)
            ->get();

        }else if($opcion == 2){
            $empleado=Empleados::where('id_usuario',\Auth::User()->id)->first();
        }else{

        }

    }

    public function history()
    {
        return view('historial.index');
    }
    public function historial2($id){

        return \DB::table('empleados_has_ventas')
        ->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
        ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
        ->join('users','users.id','=','empleados.id_usuario')
        ->where('ventas.id',$id)
        ->select('users.*','empleados.*','empleados_has_ventas.status as status')
        ->get();
    }

    public function ventas_pedientes()
    {
        $repartidores=Empleados::all();
        $num=1;
        //dd($repartidores);
        return view('ventas.pendientes',compact('repartidores','num'));
    }

}
