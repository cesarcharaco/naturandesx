<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
use App\Promociones;
use App\Ventas;
use App\EmpleadosVentas;
use App\Empleados;
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

    public function buscar_reporte()
    {
        $repartidores=Empleados::join('users','users.id','=','empleados.id_usuario')->where([['empleados.status','Activo'],['users.tipo_usuario','Empleado']])->get();
        $clientes=Clientes::where('status','Activo')->get();
        $ventas = Ventas::all();
        $e_ventas=EmpleadosVentas::all();

        $cancelado = EmpleadosVentas::where('status','Cancelado')->count();
        $no_cancelado = EmpleadosVentas::where('status','No Cancelado')->count();

        $chartjs = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 400, 'height' => 120])
         ->labels(['Cancelado'])
         ->datasets([
             [
                 "label" => "Cancelado",
                 'backgroundColor' => ['rgba(255, 99, 132, 0.2)'],
                 'data' => [69]
             ],
             [
                 "label" => "No cancelado",
                 'backgroundColor' => ['rgba(54, 162, 235, 0.3)'],
                 'data' => [65]
             ]
         ])
         ->options([]);

         $chartjs1 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 120])
            ->labels(['Label x', 'Label y'])
            ->datasets([
                [
                    'backgroundColor' => ['#FF6384', '#36A2EB'],
                    'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                    'data' => [69, 59]
                ]
            ])
            ->options([]);


        return view('reportes.index',compact('repartidores','clientes','ventas','chartjs','chartjs1','e_ventas'));
    }

    public function mostrar_reporte(Request $request)
    {
        if ($request->desde > $request->hasta) {
            toastr()->error('Error!!', ' Fecha desde no puede ser mayor a fecha hasta');
            return redirect()->back();
        } else {
            //dd(is_null($request->cancelado));
            $repartidores=$request->id_repartidor;
            //dd($repartidores);

            if(is_null($request->cancelado) and $request->no_cancelado==1){
                $ventas=EmpleadosVentas::whereBetween(\DB::raw('DATE(created_at)'), array($request->desde, $request->hasta))->where('status','No Pagada')->get();

            }elseif(is_null($request->no_cancelado) and $request->cancelado==1){
                $ventas=EmpleadosVentas::whereBetween(\DB::raw('DATE(created_at)'), array($request->desde, $request->hasta))->where('status','Pagada')->get();
            }else{
                $ventas=EmpleadosVentas::whereBetween(\DB::raw('DATE(created_at)'), array($request->desde, $request->hasta))->get();
                
            }
        }
        
        return view('reportes.show',compact('ventas','repartidores'));
        
    }
}
