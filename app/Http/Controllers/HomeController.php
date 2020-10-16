<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ventas;
use App\Promociones;
use App\EmpleadosVentas;
use Carbon\Carbon;
use App\Empleados;
use App\Clientes;
date_default_timezone_set('America/Caracas');
setlocale(LC_ALL, 'es_ES');
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
        $ventas_admin=Ventas::select(\DB::raw('cantidad'),\DB::raw('monto_total'))->whereDate('created_at', [Carbon::now()->format('Y-m-d')])->get();

        if(\Auth::user()->tipo_usuario=="Empleado"){
            $empleado=Empleados::where('id_usuario',\Auth::user()->id)->first();
        }elseif(\Auth::user()->tipo_usuario=="Cliente"){
            $cliente=Clientes::where('id_usuario',\Auth::user()->id)->first();
        }
        $promociones = Promociones::all();
        $empleados_ventas = EmpleadosVentas::orderBy('id','ASC')->get();

        $f1 = Carbon::now()->format('d-m-Y');
        $f2 = Carbon::now()->subDays(1)->format('d-m-Y');
        $f3 = Carbon::now()->subDays(2)->format('d-m-Y');
        $f4 = Carbon::now()->subDays(3)->format('d-m-Y');
        $f5 = Carbon::now()->subDays(4)->format('d-m-Y');
        $f6 = Carbon::now()->subDays(5)->format('d-m-Y');
        $f7 = Carbon::now()->subDays(6)->format('d-m-Y');


        $cv1 = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'),\DB::raw('SUM(monto_total) as monto_total'))->whereDate('created_at', [Carbon::now()->format('Y-m-d')])->get();
        foreach ($cv1 as $key) {
            $can1 = $key->cantidad;
            $mon1 = $key->monto_total;
        }
        $cv2 = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'),\DB::raw('SUM(monto_total) as monto_total'))->whereDate('created_at', [Carbon::now()->subDays(1)->format('Y-m-d')])->get();
        foreach ($cv2 as $key) {
            $can2 = $key->cantidad;
            $mon2 = $key->monto_total;
        }
        $cv3 = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'),\DB::raw('SUM(monto_total) as monto_total'))->whereDate('created_at', [Carbon::now()->subDays(2)->format('Y-m-d')])->get();
        foreach ($cv3 as $key) {
            $can3 = $key->cantidad;
            $mon3 = $key->monto_total;
        }
        $cv4 = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'),\DB::raw('SUM(monto_total) as monto_total'))->whereDate('created_at', [Carbon::now()->subDays(3)->format('Y-m-d')])->get();
        foreach ($cv4 as $key) {
            $can4 = $key->cantidad;
            $mon4 = $key->monto_total;
        }
        $cv5 = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'),\DB::raw('SUM(monto_total) as monto_total'))->whereDate('created_at', [Carbon::now()->subDays(4)->format('Y-m-d')])->get();
        foreach ($cv5 as $key) {
            $can5 = $key->cantidad;
            $mon5 = $key->monto_total;
        }
        $cv6 = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'),\DB::raw('SUM(monto_total) as monto_total'))->whereDate('created_at', [Carbon::now()->subDays(5)->format('Y-m-d')])->get();
        foreach ($cv6 as $key) {
            $can6 = $key->cantidad;
            $mon6 = $key->monto_total;
        }
        $cv7 = Ventas::select(\DB::raw('SUM(cantidad) as cantidad'),\DB::raw('SUM(monto_total) as monto_total'))->whereDate('created_at', [Carbon::now()->subDays(6)->format('Y-m-d')])->get();
        foreach ($cv7 as $key) {
            $can7 = $key->cantidad;
            $mon7 = $key->monto_total;
        }
        //dd($can1);
        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels([$f7, $f6, $f5, $f4, $f3, $f2, $f1])
        ->datasets([
            [
                "label" => "Cantidad de venta",
                'backgroundColor' => "rgba(54, 162, 235, 0.3)",
                'borderColor' => "#36A2EB",
                "pointBorderColor" => "#36A2EB",
                "pointBackgroundColor" => "#36A2EB",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$can7, $can6, $can5, $can4, $can3, $can2, $can1],
            ],
            [
                "label" => "Cantidad total de dinero",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$mon7, $mon6, $mon5, $mon4, $mon3, $mon2, $mon1],
            ]
        ])
        ->options([]);

        $gm1 = Carbon::parse()->formatLocalized('%B');
        $gm2 = Carbon::now()->subMonth(1)->formatLocalized('%B');
        $gm3 = Carbon::now()->subMonth(2)->formatLocalized('%B');
        $gm4 = Carbon::now()->subMonth(3)->formatLocalized('%B');
        $gm5 = Carbon::now()->subMonth(4)->formatLocalized('%B');
        $gm6 = Carbon::now()->subMonth(5)->formatLocalized('%B');
        $gm7 = Carbon::now()->subMonth(6)->formatLocalized('%B');

        $canc1 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->format('m'))
        ->where('status','Cancelado')->count();
        $no_can1 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->format('m'))
        ->where('status','No Cancelado')->count();
        
        $canc2 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->subMonth(1)->format('m'))
        ->where('status','Cancelado')->count();
        $no_can2 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->subMonth(1)->format('m'))
        ->where('status','No Cancelado')->count();

        $canc3 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->subMonth(2)->format('m'))
        ->where('status','Cancelado')->count();
        $no_can3 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->subMonth(2)->format('m'))
        ->where('status','No Cancelado')->count();

        $canc4 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->subMonth(3)->format('m'))
        ->where('status','Cancelado')->count();
        $no_can4 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->subMonth(3)->format('m'))
        ->where('status','No Cancelado')->count();

        $canc5 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->subMonth(4)->format('m'))
        ->where('status','Cancelado')->count();
        $no_can5 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->subMonth(4)->format('m'))
        ->where('status','No Cancelado')->count();

        $canc6 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->subMonth(5)->format('m'))
        ->where('status','Cancelado')->count();
        $no_can6 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->subMonth(5)->format('m'))
        ->where('status','No Cancelado')->count();

        $canc7 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->subMonth(6)->format('m'))
        ->where('status','Cancelado')->count();
        $no_can7 = EmpleadosVentas::whereMonth('created_at',Carbon::now()->subMonth(6)->format('m'))
        ->where('status','No Cancelado')->count();
        //dd($canc2);

        $chartjs1 = app()->chartjs
        ->name('lineChartTest1')
        ->type('radar')
        ->size(['width' => 400, 'height' => 200])
        ->labels([$gm1, $gm2, $gm3, $gm4, $gm5, $gm6, $gm7])
        ->datasets([
            [
                "label" => "Cancelado",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$canc1, $canc2, $canc3, $canc4, $canc5, $canc6, $canc7],
            ],
            [
                "label" => "No Cancelado",
                'backgroundColor' => "rgba(255, 99, 132, 0.2)",
                'borderColor' => "#FF6384",
                "pointBorderColor" => "#FF6384",
                "pointBackgroundColor" => "#FF6384",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$no_can1, $no_can2, $no_can3, $no_can4, $no_can5, $no_can6, $no_can7],
            ]
        ])
        ->options([]);

        return view('home', compact('ventas','promociones','empleados_ventas','chartjs','chartjs1','empleado','cliente','ventas_admin'));
    }
}
