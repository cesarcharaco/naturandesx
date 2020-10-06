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
        $ventas=Ventas::orderBy('id','ASC')->get();
        
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
        $mostrar_tabla=0;

        //dd($repartidores);
        return view('ventas.pendientes',compact('repartidores','num','mostrar_tabla'));
    }

    public function pagar_venta(Request $request)
    {
        $repartidor=App\Empleados::find($request->id_repartidor);

        foreach ($repartidor->ventas as $key) {
            if($key->pivot->status=="No Cancelado"){
                $key->pivot->status="Cancelado";
                $key->pivot->save();
            }
        }

        toastr()->success('Éxito!!', 'Bidones pagados a repartidor');
        return redirect()->to('pendientes');
    }

    public function buscar_ventas_pendientes(Request $request)
    {
        //dd($request->all());
        $mostrar_tabla=1;
        if ($request->desde > $request->hasta) {
            toastr()->error('Error!!', ' Fecha desde no puede ser mayor a fecha hasta');
            return redirect()->back();
        } else {
        
            //dd(is_null($request->no_cancelado));
            $repartidores=$request->id_repartidor;
            //dd($repartidores);

            if(is_null($request->cancelado) and $request->no_cancelado==1){
            
                $rep_ventas = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*','empleados_has_ventas.status')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                ->where('empleados_has_ventas.status','No Cancelado')
                ->where('empleados.id', $request->id_repartidor)->get();

                //dd($rep_ventas);
                $no_cancelado = count($rep_ventas);

                $ventas = Ventas::all();
                $repartidores = Empleados::where('status','Activo')->get();
                $clientes=Clientes::where('status','Activo')->get();
                //DATOS GENERAL EN REPORTES CLIENTES
                $can_cli = Ventas::groupby('id_cliente')->count();
                $can_pro = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'))->get();
                foreach ($can_pro as $key) {
                    $can_pro = $key->cantidad;
                }

                return view('ventas.pendientes',compact('mostrar_tabla','rep_ventas','cancelado','repartidores','clientes'));


            }elseif(is_null($request->no_cancelado) and $request->cancelado==1){
               
                $rep_ventas = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*','empleados_has_ventas.status')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                ->where('empleados_has_ventas.status','Cancelado')
                ->where('empleados.id', $request->id_repartidor)->get();

                //dd($rep_ventas);
                $cancelado = count($rep_ventas);
                $ventas = Ventas::all();
                $repartidores = Empleados::where('status','Activo')->get();
                $clientes=Clientes::where('status','Activo')->get();

                //DATOS GENERAL EN REPORTES CLIENTES
                $can_cli = Ventas::groupby('id_cliente')->count();
                $can_pro = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'))->get();
                foreach ($can_pro as $key) {
                    $can_pro = $key->cantidad;
                }
                return view('ventas.pendientes',compact('mostrar_tabla','rep_ventas','cancelado','repartidores','clientes'));
            }else{
                $ventas=EmpleadosVentas::whereBetween(\DB::raw('DATE(created_at)'), array($request->desde, $request->hasta))->get();
                $rep_ventas = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*','empleados_has_ventas.status')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                    ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                    ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                    ->where('empleados.id', $request->id_repartidor)->get();

                $cancelado = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                    ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                    ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                    ->where('empleados_has_ventas.status','Cancelado')
                    ->where('empleados.id', $request->id_repartidor)->count();

                $no_cancelado = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                    ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                    ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                    ->where('empleados_has_ventas.status','No Cancelado')
                    ->where('empleados.id', $request->id_repartidor)->count();

                $ventas = Ventas::all();
                $repartidores = Empleados::where('status','Activo')->get();
                $clientes=Clientes::where('status','Activo')->get();

                //DATOS GENERAL EN REPORTES CLIENTES
                $can_cli = Ventas::groupby('id_cliente')->count();
                $can_pro = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'))->get();
                foreach ($can_pro as $key) {
                    $can_pro = $key->cantidad;
                }

                return view('ventas.pendientes',compact('mostrar_tabla','rep_ventas','cancelado','repartidores','clientes'));
            }
        
        }
    }

}
