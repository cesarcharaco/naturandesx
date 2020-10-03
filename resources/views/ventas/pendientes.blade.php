@extends('layouts.app')
@section('css')
@endsection




@section('content-header')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Ventas por Pagar</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Ventas por Pagar</a></li>
          <li class="breadcrumb-item active">Tablero</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection


@section('content')
<div class="container-fluid">
  <div class="row mt-2 mb-2">
    <div class="col-md-12">             
      <div class="card bg-white shadow" style="border-radius: 30px !important;">
        <div class="card-body">
          <center>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Desde</label>
                  <input id="inputDesde" max="<?php echo date('Y-m-d');?>" type="date" class="form-control shadow" name="desde" style="border-radius: 30px;" onchange="busqueda();">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Hasta</label>
                  <input id="inputHasta" max="<?php echo date('Y-m-d');?>" type="date" class="form-control shadow" name="hasta" style="border-radius: 30px;" onchange="busqueda();">
                </div>
              </div>
            </div>
          </center>
          <div class="shadow border border-default" style="border-radius: 20px;">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12" style="position: relative !important;">
                    <table id="example1" class="table table-bordered table-hover table-striped dataTable dtr-inline collapsed" style="width: 100% !important;">
                      <thead class="text-capitalize bg-primary">
                          <tr>
                            <th>Nombre</th>
                            <th>RUT</th>
                            <th>Total</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($repartidores as $key)
                          @if($key->usuario->tipo_usuario != 'Admin')
                            @php
                              $cuenta=count($key->ventas);
                              $cuenta2=1;
                              $monto=0;
                            @endphp
                            <tr class="bg-info" class="text-white" id="empleado{{$key->id}}">
                              <td>
                                <button id="boton{{$key->id}}" class="btn btn-success border" onclick="MostrarInfo(1,'{{$key->id}}')" style="border-radius: 30px;"><strong>+</strong>
                                </button>
                                {{$key->nombres}} {{$key->apellidos}}</td>
                              <td>{{$key->rut}}</td>
                              <td>
                                @if(total_ventas_no_pagadas($key->id) > 0)
                                  <button class="btn btn-warning text-white" style="border-radius: 30px;"><strong>Pagar {{ total_ventas_no_pagadas($key->id) }}</strong></button></td>
                                @endif
                            </tr>
                            @foreach($key->ventas as $key2)
                              <tr style="background-color: white; display: none !important;" class="fila{{$key->id}}">
                                <td>{{$key2->cliente->nombres}} {{$key2->cliente->apellidos}}<br>{{$key2->cliente->rut}}</td>
                                <td>{{$key2->created_at}}</td>
                                <td><strong>{{$key2->promociones->promocion}}</strong><br>
                                  Cant: <strong>{{$key2->cantidad}}</strong><br>
                                  <strong>{{$key2->monto_total}}.00$</strong>
                                </td>
                                  {{--@foreach($key->empleados_has_ventas as $key3)
                                    @if($key2->id == $key3->id_venta)
                                      @if($key3->status == 'No Cancelado')
                                        <td><strong style="color: red;">No Pagado</strong></td>
                                        @php $monto = $monto+$key2->monto_total @endphp
                                      @else
                                        <td><strong style="color: green;">Pagado</strong></td>
                                      @endif
                                    @endif
                                  @endforeach--}}
                              </tr>
                              {{--@if($cuenta == $cuenta2)
                                <tr style="background-color: white; display: none;" class="fila{{$key->id}}">
                                  <td colspan="2" align="right"><h3> Cantidad de promociones: <strong>{{ total_ventas_no_pagadas($key->id) }}</strong></h3></td> 
                                  <td colspan="2" align="right"><h3>Total a pagar: <strong>{{$monto}}.00$</strong></h3></td>
                                </tr>
                                @php $id=0 @endphp
                              @endif--}}
                              @php $cuenta2++ @endphp
                            @endforeach
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

  <script type="text/javascript">
    function MostrarInfo(opcion,id){
      if (opcion == 1) {
        // $('#empleado'+id).removeClass('bg-info').addClass('bg-success');
        $('#boton'+id)
          .removeClass('btn-success')
          .addClass('btn-danger')
          .html('<strong>-</strong>')
          .removeAttr('onclick',false)
          .attr('onclick','MostrarInfo(2,'+id+')');
        $('.fila'+id).fadeIn(300);
      }else{
        // $('#empleado'+id).removeClass('bg-success').addClass('bg-info');
        $('#boton'+id)
          .removeClass('btn-danger')
          .addClass('btn-success')
          .html('<strong>+</strong>')
          .removeAttr('onclick',false)
          .attr('onclick','MostrarInfo(1,'+id+')');
        $('.fila'+id).fadeOut('fast');
      }
    }
  </script>
@section('scripts')
@endsection
