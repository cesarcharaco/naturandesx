@extends('layouts.app')

@section('css')
  <title>Dashboard</title>
@endsection

@section('page-title-area')
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
        @include('layouts.perfil')
    </div>
</div>
<!-- page title area end -->
@endsection

@section('content')
<div class="sales-report-area mt-5 mb-5">
  <!-- Top Statistics -->

  <div class="row">
    <div class="col-xl-8 col-sm-6">
      <div class="card mb-4 border" style="border-color: #8914fc !important;">
        <div class="card-body">
          <table class="table table-curved">
            <thead>
              <tr align="center">
                <th colspan="2">Repartidor</th>
                <th>Promociones vendida</th>
              </tr>
            </thead>
            <tbody>
              @foreach($empleados_ventas as $key)
              <tr align="center">
                <th colspan="2">{{$key->empleado->nombres}}</th>
                <th>{{$key->venta->cantidad}}</th>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-sm-6">
      <div class="card mb-4 border" style="border-color: #8914fc !important;">
        <div class="card-body">
          <table class="table table-curved">
            <thead>
              <tr align="center">
                <th>Promociones activas</th>
              </tr>
            </thead>
            <tbody>
              @foreach($promociones as $key)
              <tr align="center">
                <th>{{$key->promocion}} - {{$key->monto}} $</th>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12 col-sm-12">
      <div class="card mb-4 border" style="border-color: #8914fc !important;">
        <div class="card-body">
          <h3>Ventas del día <?php echo date('d/m/Y'); ?></h3>
          <table class="table table-curved" >
            <thead>
              <tr align="center">
                <th colspan="2">Cliente</th>
                <th>Cantidad de Promoción</th>
              </tr>
            </thead>
            <tbody>
              @foreach($ventas as $key)
              <tr align="center">
                <th colspan="2">{{$key->cliente->nombres}} {{$key->cliente->apellidos}}</th>
                <th>{{$key->cantidad}}</th>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
