@extends('layouts.app')
@section('css')
  <title>Pendientes</title>
  <!-- Include Choices CSS -->
  <link rel="stylesheet" href="{{ asset('plugins/choices.js/choices.min.css') }}" />
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
          <form action="{{ route('pendientes.buscar') }}" name="ventas_pendientes" method="POST">
            @csrf
            <center>
              <div class="row mb-4">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Repartidor <b style="color: red;">*</b></label>
                    <select class="form-control select2 choices form-select multiple-remove shadow" name="id_repartidor" required="required" style="border-radius: 30px;">
                      <option value="">Seleccione Repartidor</option>
                      @foreach($repartidores as $key)
                        @if($key->usuario->tipo_usuario=="Empleado")
                          <option value="{{$key->id}}" style="color: black !important;">{{$key->nombres}} {{$key->apellidos}}.- {{$key->rut}}</option>
                        @endif
                      @endforeach()
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Desde <b style="color: red;">*</b></label>
                    <input id="inputDesde" max="<?php echo date('Y-m-d');?>" type="date" class="form-control shadow" name="desde" style="border-radius: 30px;" required="required">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Hasta <b style="color: red;">*</b></label>
                    <input id="inputHasta" max="<?php echo date('Y-m-d');?>" type="date" class="form-control shadow" name="hasta" style="border-radius: 30px;" required="required">
                  </div>
                </div>
                <div class="col-md-3">
                    <label for="">status</label>
                    <div class="row justify-content-center">
                        <div class="custom-control custom-checkbox">
                            <input name="cancelado" type="checkbox" class="custom-control-input" id="customCheck1" value="1">
                            <label class="custom-control-label" for="customCheck1">Pagado</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input name="no_cancelado" type="checkbox" class="custom-control-input" id="customCheck2" value="1">
                          <label class="custom-control-label" for="customCheck2">No Pagado</label>
                        </div>                  
                    </div>
                </div>
              </div>
              <div class="mt-4 mb-4">
                <button class="btn btn-success">Buscar</button>
              </div>
            </center>
          </form>
          @if($mostrar_tabla == 1)
            @include('ventas.layouts.pagar')
            <div class="shadow border border-default mb-4" style="border-radius: 20px;">
              <div class="card-body">
                <h5>Repartidor: <strong>{{$key->nombres}} {{$key->apellidos}} - {{$key->rut}}</strong></h5>
                @if($no_cancelado>=0 && $pagar==0)
                <h5>Total de Bidones a Pagar: <span style="color: red;">{{ $no_cancelado }}</span></h5>
                <h5>Leyenda: 
                  <img src="{{ asset('img/checked.png') }}" style="width: 30px; height: 30px; border-radius: 30px;"> Pagado |
                  <img src="{{ asset('img/error.png') }}" style="width: 30px; height: 30px; border-radius: 30px;"> No Pagado
                </h5>
                <div class="col-md-12" style="position: relative !important;">
                  @if(!is_null($rep_ventas) && $no_cancelado>0)
                    <button class="btn btn-success text-white" style="border-radius: 10px; float: right;" data-toggle="modal" data-target="#pagar_bi" onclick="pagar('{{count($rep_ventas)}}')"><strong>Pagar</strong></button>
                  @endif
                </div>
                @elseif($cancelado>=0 && $pagar==1)
                  <h5>Total de Bidones a Pagados: <span style="color: red;">{{ $cancelado }}</span></h5>
                  <h5>Leyenda: 
                    <img src="{{ asset('img/checked.png') }}" style="width: 30px; height: 30px; border-radius: 30px;"> Pagado |
                    <img src="{{ asset('img/error.png') }}" style="width: 30px; height: 30px; border-radius: 30px;"> No Pagado
                  </h5>
                  <div class="col-md-12" style="position: relative !important;">
                    @if(!is_null($rep_ventas) && $cancelado>0)
                      <button class="btn btn-warning text-white" style="border-radius: 10px; float: right;" data-toggle="modal" data-target="#no_pagar_bi" onclick="pagar('{{count($rep_ventas)}}')"><strong>No Pagado</strong></button>
                    @endif
                  </div>
                @else
                  <h5>Total de Bidones a Pagar: <span style="color: red;">{{ $no_cancelado }}</span></h5>
                  <h5>Total de Bidones a Pagados: <span style="color: red;">{{ $cancelado }}</span></h5>
                  <h5>Leyenda: 
                    <img src="{{ asset('img/checked.png') }}" style="width: 30px; height: 30px; border-radius: 30px;"> Pagado |
                    <img src="{{ asset('img/error.png') }}" style="width: 30px; height: 30px; border-radius: 30px;"> No Pagado
                  </h5>
                  <div class="col-md-12" style="position: relative !important;">
                      <button class="btn btn-success text-white" style="border-radius: 10px; float: right;" data-toggle="modal" data-target="#pagar_bi" onclick="pagar('{{count($rep_ventas)}}')"><strong>Pagar</strong></button>
                      <button class="btn btn-warning text-white" style="border-radius: 10px; float: right;" data-toggle="modal" data-target="#no_pagar_bi" onclick="pagar('{{count($rep_ventas)}}')"><strong>No Pagado</strong></button>
                  </div>
                @endif
              </div>
            </div>
            <div class="shadow border border-default" style="border-radius: 20px;">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" style="position: relative !important;">
                    <div id="cargando" class="mt-2 mb-2" style="display: none;">
                      <center>
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                      </center>
                    </div>
                    
                    <div id="tablePendientes" class="mt-5">
                      <form action="{{ route('pagar_pendientes') }}" name="cambiar_status" method="POST">
                        @csrf
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                          <table id="example1" class="table table-bordered table-hover table-striped dataTable dtr-inline collapsed border border-orange" style="width: 100% !important;">
                            <thead class="text-capitalize bg-primary">
                              <tr>
                                <th></th>
                                <th>Cliente</th>
                                <th>Cantidad</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                              </tr>
                          </thead>
                          <tbody id="bodyPendiente">
                            @foreach($rep_ventas as $key)
                              @foreach($clientes as $key2)
                                @if($key2->id == $key->id_cliente)
                                  @if($key->status == 'Cancelado')
                                    <tr style="" class="fila{{$key->id}}">
                                      <td>
                                        <div class="custom-control custom-checkbox">
                                          <input name="id_venta[]" type="checkbox" class="custom-control-input" id="{{$key->id}}" value="{{$key->id}}">
                                          <label class="custom-control-label" for="{{$key->id}}"></label>
                                        </div>
                                      </td>
                                      <td><img src="{{ asset('img/checked.png') }}" style="width: 30px; height: 30px; border-radius: 30px;">{{$key2->nombres}} {{$key2->apellidos}}<br>{{$key2->rut}}</td>
                                      <td>
                                        <strong>{{$key->cantidad}}</strong>
                                      </td>
                                      <td><strong>{{$key->monto_total}}.00$</strong></td>
                                      <td>{{$key->created_at}}</td>
                                    </tr>
                                  @else
                                    <tr style="background-color: #E6B0AA;" class="fila{{$key->id}}">
                                      <td>
                                        <div class="custom-control custom-checkbox">
                                            <input name="id_venta[]" type="checkbox" class="custom-control-input" id="{{$key->id}}" value="{{$key->id}}">
                                            <label class="custom-control-label" for="{{$key->id}}"></label>
                                        </div>
                                      </td>
                                      <td><img src="{{ asset('img/error.png') }}" style="width: 30px; height: 30px; border-radius: 30px;">{{$key2->nombres}} {{$key2->apellidos}}<br>{{$key2->rut}}</td>
                                      <td>
                                        <strong>{{$key->cantidad}}</strong>
                                      </td>
                                      <td><strong>{{$key->monto_total}}.00$</strong></td>
                                      <td>{{$key->created_at}}</td>
                                    </tr>
                                  @endif
                                @endif
                              @endforeach()
                            @endforeach()
                          </tbody>
                        </table>
                      </div>
                      <!--INICIO DE MODAL -->
                      <div class="modal fade" id="pagar_bi" role="dialog" >
                        <div class="modal-dialog modal-default">
                          <div class="modal-content border border-warning" style="border-radius: 20px !important;">
                            <div class="modal-header shadow">
                                <h4>Cambiar status de ventas</h4>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body ">
                                <div id="mostrarPagar">
                                    <h5>¿Está realmente seguro de querer pagar las cantidad de ventas seleccionadas al repartidor <strong>{{$key->nombres}} {{$key->apellidos}} - {{$key->rut}}</strong>?</h5>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div style="float: left !important; justify-content: left !important;">
                                    <button type="button" class="btn btn-default shadow" data-dismiss="modal" style="float: left !important;"><strong>Cancelar</strong></button>
                                </div>
                                <input type="hidden" name="id_repartidor" id="id_repartidorPagar" value="{{$id_repartidor}}">
                                <input type="hidden" name="opcion" value="1">
                                <button type="submit" class="btn btn-success text-white shadow" style="float: right;"><strong>Pagar</strong></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--FIN DE MODAL -->
                      <!--INICIO DE MODAL -->
                      <div class="modal fade" id="no_pagar_bi" role="dialog" >
                        <div class="modal-dialog modal-default">
                          <div class="modal-content border border-warning" style="border-radius: 20px !important;">
                            <div class="modal-header shadow">
                                <h4>Cambiar status de ventas</h4>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body ">
                                <div id="mostrarPagar">
                                    <h5>¿Está realmente seguro de cambiar a No Pagada las cantidad de ventas seleccionadas al repartidor <strong>{{$key->nombres}} {{$key->apellidos}} - {{$key->rut}}</strong>?</h5>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div style="float: left !important; justify-content: left !important;">
                                    <button type="button" class="btn btn-default shadow" data-dismiss="modal" style="float: left !important;"><strong>Cancelar</strong></button>
                                </div>
                                <input type="hidden" name="id_repartidor" id="id_repartidorPagar" value="{{$id_repartidor}}">
                                <input type="hidden" name="opcion" value="2">
                                <button type="submit" class="btn btn-warning text-white shadow" style="float: right;"><strong>Pagar</strong></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--FIN DE MODAL -->
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

  <script type="text/javascript">

    function pagar(count) {
      // $('#pagar').modal('show');
      $('#id_repartidorPagar').val();
      $('#desdePagar').val();
      $('#hastaPagar').val();
      tiempo = 500;
      $('#mostrarPagar').hide();
      $('#cargando2').show();
      setTimeout(function() {
        $('#mostrarPagar').fadeIn(300);
        $('#cargando2').hide();
        for (var i = 0; i < count; i++) {
          if ($('#filaP'+i) != null) {
            // setTimeout(function() {
              $('#filaP'+i).fadeIn(300);
              // alert(tiempo);
              tiempo=+tiempo + 500;
            // }, tiempo);
          }
        }
      }, 1500);
    }

    function busqueda() {
      var desde = $('#inputDesde').val();
      var hasta = $('#inputHasta').val();

      if (desde && hasta) {
        $('#tablePendientes').empty();
        $('#inputDesde').attr('disabled',true);
        $('#inputHasta').attr('disabled',true);
        $('#cargando').fadeIn(300);



        $.get("historial/"+desde+"/"+hasta+"/"+1+"/buscar",function (data) {
        })
        .done(function(data) {
          if (data.length>0) {


            n1 = data.length-1;
            for (var i = 0; i < data.length; i++) {
              busqueda2(data[i].id_venta,data[i].fecha,data[i].nombres,data[i].apellidos,data[i].promocion,data[i].cantidad,data[i].monto_total,n1,i);
              
            }
            // $('#example1_wrapper').fadeIn(300);
          }else{
            $('#cargando').hide();
            $('#inputDesde').removeAttr('disabled',false).val(0);
            $('#inputHasta').removeAttr('disabled',false).val(0);
            $('#sin_resultados').fadeIn(300);
            setTimeout(function() {
              $('#sin_resultados').fadeOut('slow');
            }, 500);
          }
        });
      }

    }


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
