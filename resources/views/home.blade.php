@extends('layouts.app')

@section('css')
  <title>Dashboard</title>
@endsection

@section('content-header')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Home</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" style="color: black;">Tablero</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection

@section('content')
<div class="container-fluid">
  <!-- Top Statistics -->
  @if(Auth::user()->tipo_usuario == 'Admin' )
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
  @elseif(Auth::user()->tipo_usuario == 'Repartidor')
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
  @else
    <div class="row">
      <div class="col-xl-12 col-sm-12">
        <div class="card mb-4 border" style="border-color: #8914fc !important;">
          <div class="card-body">
            <h3>Compras del día <?php echo date('d/m/Y'); ?></h3>
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
  @endif
</div>
@endsection
