<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
use App\Promociones;
use App\Ventas;
use App\EmpleadosVentas;
use App\Empleados;
use PDF;
date_default_timezone_set('America/Santiago');
setlocale(LC_ALL, 'es_ES');

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    public function enviar_reportes(Request $request)
    {
        $rep_ventas=EmpleadosVentas::all();
        $pdf = PDF::loadView('pdf/reportes', array('rep_ventas'=>$rep_ventas));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('reportes.pdf');
    }

    public function buscar_reporte()
    {
        //$repartidores=Empleados::join('users','users.id','=','empleados.id_usuario')->where([['empleados.status','Activo'],['users.tipo_usuario','Empleado']])->get();
        $repartidores = Empleados::where('status','Activo')->get();
        $clientes=Clientes::where('status','Activo')->get();
        $ventas = Ventas::all();
        $rep_ventas=EmpleadosVentas::all();

        $cancelado = EmpleadosVentas::where('status','Cancelado')->count();
        $no_cancelado = EmpleadosVentas::where('status','No Cancelado')->count();

        $graf_barra_rep = app()->chartjs
        ->name('graf_barra_rep')
        ->type('bar')
        ->size(['width' => 400, 'height' => 120])
        ->labels(['Gráficas por status de ventas'])
        ->datasets([
            [
                "label" => "Pagado",
                'backgroundColor' => ['rgba(54, 162, 235, 0.3)'],
                'data' => [$cancelado]
            ],
            [
                "label" => "No Pagado",
                'backgroundColor' => ['rgba(255, 99, 132, 0.2)'],
                'data' => [$no_cancelado]
            ]
        ])
        ->options([]);

        $graf_torta_rep = app()->chartjs
        ->name('graf_torta_rep')
        ->type('pie')
        ->size(['width' => 400, 'height' => 120])
        ->labels(['Pagado', 'No Pagado'])
        ->datasets([
            [
                'backgroundColor' => ['#36A2EB','#FF6384'],
                'hoverBackgroundColor' => ['#36A2EB','#FF6384'],
                'data' => [$cancelado, $no_cancelado]
            ]
        ])
        ->options([]);

        $can_cli = Ventas::groupby('id_cliente')->count();
        $can_pro = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'))->get();
        foreach ($can_pro as $key) {
            $can_pro = $key->cantidad;
        }
        //dd($can_cli);
        //$canti = $can_cli->cantidad;

        
        $graf_barra_cli = app()->chartjs
        ->name('graf_barra_cli')
        ->type('bar')
        ->size(['width' => 400, 'height' => 120])
        ->labels(['Gráficas por status de ventas'])
        ->datasets([
            [
                "label" => "Cantidad de promociones vendidas",
                'backgroundColor' => ['rgba(54, 162, 235, 0.3)'],
                'data' => [$can_pro]
            ],
            [
                "label" => "Clientes",
                'backgroundColor' => ['rgba(255, 99, 132, 0.2)'],
                'data' => [$can_cli]
            ]
        ])
        ->options([]);

        $graf_torta_cli = app()->chartjs
        ->name('graf_torta_cli')
        ->type('pie')
        ->size(['width' => 400, 'height' => 120])
        ->labels(['Cantidad de promociones vendidas', 'Clientes'])
        ->datasets([
            [
                'backgroundColor' => ['#36A2EB','#FF6384'],
                'hoverBackgroundColor' => ['#36A2EB','#FF6384'],
                'data' => [$can_pro, $can_cli]
            ]
        ])
        ->options([]);
        $active = 0;
        return view('reportes.index',compact('repartidores','clientes','ventas','graf_barra_rep','graf_torta_rep','rep_ventas','graf_barra_cli','graf_torta_cli','active'));
    }

    public function mostrar_reporte(Request $request)
    {
        if ($request->desde > $request->hasta) {
            toastr()->error('Error!!', ' Fecha desde no puede ser mayor a fecha hasta');
            return redirect()->back();
        } else {
            if ($request->form_empleados==1) {
                //dd(is_null($request->no_cancelado));
                $repartidores=$request->id_repartidor;
                //dd($repartidores);

                if(is_null($request->cancelado) and $request->no_cancelado==1){
                    //$ventas=EmpleadosVentas::whereBetween(\DB::raw('DATE(created_at)'), array($request->desde, $request->hasta))->where('status','No Cancelado')->get();
                    //dd($request->all());

                    $rep_ventas = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                    ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                    ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                    ->where('empleados_has_ventas.status','No Cancelado')
                    ->whereIn('empleados.id', $request->id_repartidor)->get();

                    //dd($rep_ventas);
                    $no_cancelado = count($rep_ventas);
                    //dd($count_rep_ventas);
                    
                    $graf_barra_rep = app()->chartjs
                    ->name('barChartTest')
                    ->type('bar')
                    ->size(['width' => 400, 'height' => 120])
                    ->labels(['Gráficas por status de ventas'])
                    ->datasets([
                        [
                            "label" => "No Pagado",
                            'backgroundColor' => ['rgba(255, 99, 132, 0.2)'],
                            'data' => [$no_cancelado]
                        ]
                    ])
                    ->options([]);

                    $graf_torta_rep = app()->chartjs
                    ->name('pieChartTest')
                    ->type('pie')
                    ->size(['width' => 400, 'height' => 120])
                    ->labels(['No Pagado'])
                    ->datasets([
                        [
                            'backgroundColor' => ['#FF6384'],
                            'hoverBackgroundColor' => ['#FF6384'],
                            'data' => [$no_cancelado]
                        ]
                    ])
                    ->options([]);

                    $ventas = Ventas::all();
                    $repartidores = Empleados::where('status','Activo')->get();
                    $clientes=Clientes::where('status','Activo')->get();
                    //DATOS GENERAL EN REPORTES CLIENTES
                    $can_cli = Ventas::groupby('id_cliente')->count();
                    $can_pro = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'))->get();
                    foreach ($can_pro as $key) {
                        $can_pro = $key->cantidad;
                    }
                    //dd($can_cli);
                    //$canti = $can_cli->cantidad;

                    
                    $graf_barra_cli = app()->chartjs
                    ->name('graf_barra_cli')
                    ->type('bar')
                    ->size(['width' => 400, 'height' => 120])
                    ->labels(['Gráficas por status de ventas'])
                    ->datasets([
                        [
                            "label" => "Cantidad de promociones vendidas",
                            'backgroundColor' => ['rgba(54, 162, 235, 0.3)'],
                            'data' => [$can_pro]
                        ],
                        [
                            "label" => "Clientes",
                            'backgroundColor' => ['rgba(255, 99, 132, 0.2)'],
                            'data' => [$can_cli]
                        ]
                    ])
                    ->options([]);

                    $graf_torta_cli = app()->chartjs
                    ->name('graf_torta_cli')
                    ->type('pie')
                    ->size(['width' => 400, 'height' => 120])
                    ->labels(['Cantidad de promociones vendidas', 'Clientes'])
                    ->datasets([
                        [
                            'backgroundColor' => ['#36A2EB','#FF6384'],
                            'hoverBackgroundColor' => ['#36A2EB','#FF6384'],
                            'data' => [$can_pro, $can_cli]
                        ]
                    ])
                    ->options([]);
                    $active = 0;

                    return view('reportes.index',compact('rep_ventas','graf_barra_rep','graf_torta_rep','repartidores','clientes','graf_barra_cli','graf_torta_cli','active','ventas'));

                }elseif(is_null($request->no_cancelado) and $request->cancelado==1){
                   
                    $rep_ventas = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                    ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                    ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                    ->where('empleados_has_ventas.status','Cancelado')
                    ->whereIn('empleados.id', $request->id_repartidor)->get();

                    //dd($rep_ventas);
                    $cancelado = count($rep_ventas);
                    //dd($count_rep_ventas);
                    
                    $graf_barra_rep = app()->chartjs
                    ->name('barChartTest')
                    ->type('bar')
                    ->size(['width' => 400, 'height' => 120])
                    ->labels(['Gráficas por status de ventas'])
                    ->datasets([
                        [
                            "label" => "Pagado",
                            'backgroundColor' => ['rgba(54, 162, 235, 0.3)'],
                            'data' => [$cancelado]
                        ]
                    ])
                    ->options([]);

                    $graf_torta_rep = app()->chartjs
                    ->name('pieChartTest')
                    ->type('pie')
                    ->size(['width' => 400, 'height' => 120])
                    ->labels(['Pagado'])
                    ->datasets([
                        [
                            'backgroundColor' => ['#36A2EB'],
                            'hoverBackgroundColor' => ['#36A2EB'],
                            'data' => [$cancelado]
                        ]
                    ])
                    ->options([]);

                    $ventas = Ventas::all();
                    $repartidores = Empleados::where('status','Activo')->get();
                    $clientes=Clientes::where('status','Activo')->get();

                    //DATOS GENERAL EN REPORTES CLIENTES
                    $can_cli = Ventas::groupby('id_cliente')->count();
                    $can_pro = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'))->get();
                    foreach ($can_pro as $key) {
                        $can_pro = $key->cantidad;
                    }
                    //dd($can_cli);
                    //$canti = $can_cli->cantidad;

                    
                    $graf_barra_cli = app()->chartjs
                    ->name('graf_barra_cli')
                    ->type('bar')
                    ->size(['width' => 400, 'height' => 120])
                    ->labels(['Gráficas por status de ventas'])
                    ->datasets([
                        [
                            "label" => "Cantidad de promociones vendidas",
                            'backgroundColor' => ['rgba(54, 162, 235, 0.3)'],
                            'data' => [$can_pro]
                        ],
                        [
                            "label" => "Clientes",
                            'backgroundColor' => ['rgba(255, 99, 132, 0.2)'],
                            'data' => [$can_cli]
                        ]
                    ])
                    ->options([]);

                    $graf_torta_cli = app()->chartjs
                    ->name('graf_torta_cli')
                    ->type('pie')
                    ->size(['width' => 400, 'height' => 120])
                    ->labels(['Cantidad de promociones vendidas', 'Clientes'])
                    ->datasets([
                        [
                            'backgroundColor' => ['#36A2EB','#FF6384'],
                            'hoverBackgroundColor' => ['#36A2EB','#FF6384'],
                            'data' => [$can_pro, $can_cli]
                        ]
                    ])
                    ->options([]);
                    $active = 0;

                    return view('reportes.index',compact('rep_ventas','count_rep_ventas','graf_barra_rep','graf_torta_rep','repartidores','clientes','graf_barra_cli','graf_torta_cli','active','ventas'));
                    //$ventas=EmpleadosVentas::whereBetween(\DB::raw('DATE(created_at)'), array($request->desde, $request->hasta))->where('status','Cancelado')->get();
                }else{
                    $ventas=EmpleadosVentas::whereBetween(\DB::raw('DATE(created_at)'), array($request->desde, $request->hasta))->get();
                    $rep_ventas = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                        ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                        ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                        ->whereIn('empleados.id', $request->id_repartidor)->get();

                    $cancelado = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                        ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                        ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                        ->where('empleados_has_ventas.status','Cancelado')
                        ->whereIn('empleados.id', $request->id_repartidor)->count();

                    $no_cancelado = EmpleadosVentas::select('ventas.*','empleados.*','empleados_has_ventas.*')->join('ventas', 'ventas.id', '=', 'empleados_has_ventas.id_venta')
                        ->join('empleados', 'empleados.id', '=', 'empleados_has_ventas.id_empleado')
                        ->whereBetween('empleados_has_ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                        ->where('empleados_has_ventas.status','No Cancelado')
                        ->whereIn('empleados.id', $request->id_repartidor)->count();

                    $graf_barra_rep = app()->chartjs
                    ->name('barChartTest')
                    ->type('bar')
                    ->size(['width' => 400, 'height' => 120])
                    ->labels(['Gráficas por status de ventas'])
                    ->datasets([
                        [
                            "label" => "Pagado",
                            'backgroundColor' => ['rgba(54, 162, 235, 0.3)'],
                            'data' => [$cancelado]
                        ],
                        [
                            "label" => "No Pagado",
                            'backgroundColor' => ['rgba(255, 99, 132, 0.2)'],
                            'data' => [$no_cancelado]
                        ]
                    ])
                    ->options([]);
                    
                    $graf_torta_rep = app()->chartjs
                    ->name('pieChartTest')
                    ->type('pie')
                    ->size(['width' => 400, 'height' => 120])
                    ->labels(['Pagado', 'No Pagado'])
                    ->datasets([
                        [
                            'backgroundColor' => ['#36A2EB','#FF6384'],
                            'hoverBackgroundColor' => ['#36A2EB','#FF6384'],
                            'data' => [$cancelado, $no_cancelado]
                        ]
                    ])
                    ->options([]);

                    $ventas = Ventas::all();
                    $repartidores = Empleados::where('status','Activo')->get();
                    $clientes=Clientes::where('status','Activo')->get();

                    //DATOS GENERAL EN REPORTES CLIENTES
                    $can_cli = Ventas::groupby('id_cliente')->count();
                    $can_pro = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'))->get();
                    foreach ($can_pro as $key) {
                        $can_pro = $key->cantidad;
                    }
                    //dd($can_cli);
                    //$canti = $can_cli->cantidad;

                    
                    $graf_barra_cli = app()->chartjs
                    ->name('graf_barra_cli')
                    ->type('bar')
                    ->size(['width' => 400, 'height' => 120])
                    ->labels(['Gráficas por status de ventas'])
                    ->datasets([
                        [
                            "label" => "Cantidad de promociones vendidas",
                            'backgroundColor' => ['rgba(54, 162, 235, 0.3)'],
                            'data' => [$can_pro]
                        ],
                        [
                            "label" => "Clientes",
                            'backgroundColor' => ['rgba(255, 99, 132, 0.2)'],
                            'data' => [$can_cli]
                        ]
                    ])
                    ->options([]);

                    $graf_torta_cli = app()->chartjs
                    ->name('graf_torta_cli')
                    ->type('pie')
                    ->size(['width' => 400, 'height' => 120])
                    ->labels(['Cantidad de promociones vendidas', 'Clientes'])
                    ->datasets([
                        [
                            'backgroundColor' => ['#36A2EB','#FF6384'],
                            'hoverBackgroundColor' => ['#36A2EB','#FF6384'],
                            'data' => [$can_pro, $can_cli]
                        ]
                    ])
                    ->options([]);
                    $active = 0;
                    return view('reportes.index',compact('rep_ventas','count_rep_ventas','graf_barra_rep','graf_torta_rep','repartidores','clientes','graf_barra_cli','graf_torta_cli','active','ventas'));
                }
            } else if ($request->form_clientes==1){
                $ventas = ventas::select('ventas.*','clientes.*')
                ->join('clientes', 'clientes.id', '=', 'ventas.id_cliente')
                ->join('promociones', 'promociones.id', '=', 'ventas.id_promocion')
                ->whereBetween('ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                ->whereIn('clientes.id', $request->id_clientes)->get();
                
                $can_cli = Ventas::whereIn('id_cliente', $request->id_clientes)->groupby('id_cliente')->count();
                $can_pro = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'))
                ->whereBetween('ventas.created_at', array($request->desde." 00:00:00", $request->hasta." 23:59:59"))
                ->whereIn('id_cliente', $request->id_clientes)->get();
                foreach ($can_pro as $key) {
                    $can_pro = $key->cantidad;
                }
                //dd($can_pro);

                $graf_barra_cli = app()->chartjs
                ->name('graf_barra_cli')
                ->type('bar')
                ->size(['width' => 400, 'height' => 120])
                ->labels(['Gráficas por status de ventas'])
                ->datasets([
                    [
                        "label" => "Cantidad de promociones vendidas",
                        'backgroundColor' => ['rgba(54, 162, 235, 0.3)'],
                        'data' => [$can_pro]
                    ],
                    [
                        "label" => "Clientes",
                        'backgroundColor' => ['rgba(255, 99, 132, 0.2)'],
                        'data' => [$can_cli]
                    ]
                ])
                ->options([]);

                $graf_torta_cli = app()->chartjs
                ->name('graf_torta_cli')
                ->type('pie')
                ->size(['width' => 400, 'height' => 120])
                ->labels(['Cantidad de promociones vendidas', 'Clientes'])
                ->datasets([
                    [
                        'backgroundColor' => ['#36A2EB','#FF6384'],
                        'hoverBackgroundColor' => ['#36A2EB','#FF6384'],
                        'data' => [$can_pro, $can_cli]
                    ]
                ])
                ->options([]);

                $repartidores = Empleados::where('status','Activo')->get();
                $clientes=Clientes::where('status','Activo')->get();

                $rep_ventas=EmpleadosVentas::all();

                $cancelado = EmpleadosVentas::where('status','Cancelado')->count();
                $no_cancelado = EmpleadosVentas::where('status','No Cancelado')->count();

                $graf_barra_rep = app()->chartjs
                ->name('graf_barra_rep')
                ->type('bar')
                ->size(['width' => 400, 'height' => 120])
                ->labels(['Gráficas por status de ventas'])
                ->datasets([
                    [
                        "label" => "Pagado",
                        'backgroundColor' => ['rgba(54, 162, 235, 0.3)'],
                        'data' => [$cancelado]
                    ],
                    [
                        "label" => "No cancelado",
                        'backgroundColor' => ['rgba(255, 99, 132, 0.2)'],
                        'data' => [$no_cancelado]
                    ]
                ])
                ->options([]);

                $graf_torta_rep = app()->chartjs
                ->name('graf_torta_rep')
                ->type('pie')
                ->size(['width' => 400, 'height' => 120])
                ->labels(['Pagado', 'No Pagado'])
                ->datasets([
                    [
                        'backgroundColor' => ['#36A2EB','#FF6384'],
                        'hoverBackgroundColor' => ['#36A2EB','#FF6384'],
                        'data' => [$cancelado, $no_cancelado]
                    ]
                ])
                ->options([]);
                $active = 1;
                return view('reportes.index',compact('ventas','repartidores','clientes','graf_barra_cli','graf_torta_cli','graf_barra_rep','graf_torta_rep','rep_ventas','active'));
            }
            
        }
        
    }
}
