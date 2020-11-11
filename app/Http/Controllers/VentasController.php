<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
use App\Promociones;
use App\Ventas;
use App\EmpleadosVentas;
use App\Empleados;
use Carbon\Carbon;
use Mail;
use PDF;
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
        $hoy = Carbon::now()->format('Y-m-d');
        //dd($hoy);
        $ventas=Ventas::whereDate('created_at',$hoy)->orderBy('id','ASC')->get();
        
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
        $mis_ventas=array();
        //dd(count($request->id_promocion));
        for ($i=0; $i < count($request->id_promocion); $i++) { 
            
            $ventas = new Ventas();
            $ventas->id_cliente=$request->id_cliente;
            $ventas->id_promocion=$request->id_promocion[$i];
            $ventas->cantidad=$request->cantidad[$i];
            $ventas->monto_total=$request->monto_total;
            $ventas->save();
            $mis_ventas[$i]=$ventas->id;
            // dd($ventas->id);
            $empleado=Empleados::where('id_usuario',\Auth::User()->id)->first();
            
            $registro = new EmpleadosVentas();
            $registro->id_empleado=$empleado->id;
            $registro->id_venta=$ventas->id;
            $registro->save();
        }
        $empleado=Empleados::where('id_usuario',\Auth::User()->id)->first();
        $consultar_ventas = EmpleadosVentas::join('ventas','ventas.id','=','empleados_has_ventas.id_venta')
        ->whereIn('ventas.id',$mis_ventas)->get();
        
        $nombres= $empleado->nombres.' '.$empleado->apellidos;
        $email= $empleado->usuario->email;
        $asunto="Naturandes! | Ventas Realizadas";
        $destinatario=$empleado->usuario->email;
        $mensaje="Ha realizado una nueva ventas | Naturandes";

        $send_repartidor=Mail::send('email.ventas_repartidor',
            ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$email,$mensaje,$consultar_ventas) {

            $pdf = PDF::loadView(('pdf/ventas_repartidor'),array('nombres'=>$nombres,'email'=>$email,'consultar_ventas'=>$consultar_ventas));
            $m->from('promociones@naturandeschile.com', 'Naturandes!');
            $m->to($destinatario)->subject($asunto);
            $m->attachData($pdf->output(), "ventas_repartidor.pdf");
        });

        $send_admin=Mail::send('email.ventas_admin',
            ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$email,$mensaje,$consultar_ventas) {

            $pdf = PDF::loadView(('pdf/ventas_repartidor'),array('nombres'=>$nombres,'email'=>$email,'consultar_ventas'=>$consultar_ventas));
            $m->from('promociones@naturandeschile.com', 'Naturandes!');
            $m->to('promociones@naturandeschile.com')->subject('Han realizado ventas nuevas');
            $m->attachData($pdf->output(), "ventas_repartidor.pdf");
        });


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
    //dd($request->all());
    if (is_null($request->id_venta)) {
        toastr()->warning('Alerta!!', 'No ha seleccionado ninguna venta');
        return redirect()->to(route('pendientes'));
    } else {
        if ($request->opcion==1) {
            //dd($request->id_venta);
            // $repartidor=App\Empleados::find($request->id_repartidor);
            $rep_ventas = EmpleadosVentas::select('ventas.id')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                ->where('empleados_has_ventas.status','No Cancelado')
                ->where('empleados.id', $request->id_repartidor)
                ->whereIn('ventas.id', $request->id_venta)->get();
            //dd($rep_ventas);
            foreach ($rep_ventas as $key) {
                $venta=EmpleadosVentas::find($key->id);
                $venta->status="Cancelado";
                $venta->save();
            }
            /*foreach ($repartidor->ventas as $key) {
                if($key->pivot->status=="No Cancelado"){
                    $key->pivot->status="Cancelado";
                    $key->pivot->save();
                }
            }*/

            toastr()->success('Éxito!!', 'Bidones pagados a repartidor');
            return redirect()->to(route('pendientes'));
        } else if($request->opcion==2) {
            // $repartidor=App\Empleados::find($request->id_repartidor);
            $rep_ventas = EmpleadosVentas::select('ventas.id')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                ->where('empleados_has_ventas.status','Cancelado')
                ->where('empleados.id', $request->id_repartidor)
                ->whereIn('ventas.id', $request->id_venta)->get();
            //dd($rep_ventas);
            foreach ($rep_ventas as $key) {
                $venta=EmpleadosVentas::find($key->id);
                $venta->status="No Cancelado";
                $venta->save();
            }
            /*foreach ($repartidor->ventas as $key) {
                if($key->pivot->status=="No Cancelado"){
                    $key->pivot->status="Cancelado";
                    $key->pivot->save();
                }
            }*/

            toastr()->success('Éxito!!', 'Bidones cambiados a No Pagados');
            return redirect()->to(route('pendientes'));
        }   
    }
}

    

    public function buscar_ventas_pendientes(Request $request)
    {
        //dd($request->all());
        $no_cancelado=-1;
        $mostrar_tabla=1;
        $id_repartidor=$request->id_repartidor;
        $desde=$request->desde;
        $hasta=$request->hasta;
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

                if (count($rep_ventas)>0) {
                    $no_cancelado=0;
                    foreach ($rep_ventas as $key) {
                        $no_cancelado+=$key->cantidad;
                    }
                } else {
                    $no_cancelado=0;
                }
                //dd($no_cancelado);
                //$no_cancelado = count($rep_ventas);


                $ventas = Ventas::all();
                $repartidores = Empleados::where('status','Activo')->get();
                $clientes=Clientes::where('status','Activo')->get();
                //DATOS GENERAL EN REPORTES CLIENTES
                $can_cli = Ventas::groupby('id_cliente')->count();
                $can_pro = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'))->get();
                //dd(count($can_pro));
                foreach ($can_pro as $key) {
                    $can_pro = $key->cantidad;
                }
                $pagar = 0;
                return view('ventas.pendientes',compact('mostrar_tabla','rep_ventas','cancelado','repartidores','clientes','no_cancelado','id_repartidor','desde','hasta','pagar'));


            }elseif(is_null($request->no_cancelado) and $request->cancelado==1){
               
                $rep_ventas = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*','empleados_has_ventas.status')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                ->where('empleados_has_ventas.status','Cancelado')
                ->where('empleados.id', $request->id_repartidor)->get();

                //dd($rep_ventas);
                if (count($rep_ventas)>0) {
                    $cancelado=0;
                    foreach ($rep_ventas as $key) {
                        $cancelado+=$key->cantidad;
                    }
                } else {
                    $cancelado=0;
                }
                //dd($cancelado);
                
                //$cancelado = count($rep_ventas);
                $ventas = Ventas::all();
                $repartidores = Empleados::where('status','Activo')->get();
                $clientes=Clientes::where('status','Activo')->get();

                //DATOS GENERAL EN REPORTES CLIENTES
                $can_cli = Ventas::groupby('id_cliente')->count();
                $can_pro = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'))->get();
                foreach ($can_pro as $key) {
                    $can_pro = $key->cantidad;
                }
                $pagar = 1;
                return view('ventas.pendientes',compact('mostrar_tabla','rep_ventas','cancelado','repartidores','clientes','no_cancelado','id_repartidor','desde','hasta','pagar'));
            }else{
                $ventas=EmpleadosVentas::whereBetween(\DB::raw('DATE(created_at)'), array($request->desde, $request->hasta))->get();
                $rep_ventas = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*','empleados_has_ventas.status')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                    ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                    ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                    ->where('empleados.id', $request->id_repartidor)->get();

                $cancelado_search = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                    ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                    ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                    ->where('empleados_has_ventas.status','Cancelado')
                    ->where('empleados.id', $request->id_repartidor)->get();
                    if(count($cancelado_search)>0){
                        $cancelado=0;
                        foreach ($cancelado_search as $key) {
                            $cancelado+=$key->cantidad;
                        }
                    } else {
                        $cancelado = 0;
                    }
                    //dd($cancelado);
                $no_cancelado_search = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                    ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                    ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                    ->where('empleados_has_ventas.status','No Cancelado')
                    ->where('empleados.id', $request->id_repartidor)->get();
                    if(count($no_cancelado_search)>0){
                        $no_cancelado=0;
                        foreach ($no_cancelado_search as $key) {
                            $no_cancelado+=$key->cantidad;
                        }
                    } else {
                        $no_cancelado=0;
                    }
                    //dd($no_cancelado_search);
                $ventas = Ventas::all();
                $repartidores = Empleados::where('status','Activo')->get();
                $clientes=Clientes::where('status','Activo')->get();

                //DATOS GENERAL EN REPORTES CLIENTES
                $can_cli = Ventas::groupby('id_cliente')->count();
                $can_pro = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'))->get();
                foreach ($can_pro as $key) {
                    $can_pro = $key->cantidad;
                }
                $pagar = 2;
                return view('ventas.pendientes',compact('mostrar_tabla','rep_ventas','cancelado','repartidores','clientes','cancelado','no_cancelado','id_repartidor','desde','hasta','pagar'));
            }
        
        }
    }

}
