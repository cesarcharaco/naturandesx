<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ventas;
use App\Promociones;
use App\EmpleadosVentas;
use Carbon\Carbon;
date_default_timezone_set('America/Caracas');
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

        $chartjs1 = app()->chartjs
        ->name('lineChartTest1')
        ->type('scatter')
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

        return view('home', compact('ventas','promociones','empleados_ventas','chartjs'));
    }
}
