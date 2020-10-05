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
                  <label>Desde</label>
                  <input id="inputDesde" max="<?php echo date('Y-m-d');?>" type="date" class="form-control shadow" name="desde" style="border-radius: 30px;">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Hasta</label>
                  <input id="inputHasta" max="<?php echo date('Y-m-d');?>" type="date" class="form-control shadow" name="hasta" style="border-radius: 30px;">
                </div>
              </div>
              <div class="col-md-3">
                  <label for="">status</label>
                  <div class="row justify-content-center">
                    <div class="col-lg-6">
                      <div class="custom-control custom-checkbox">
                          <input name="cancelado" type="checkbox" class="custom-control-input" id="customCheck1" value="1">
                          <label class="custom-control-label" for="customCheck1">Pagado</label>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="custom-control custom-checkbox">
                        <input name="no_cancelado" type="checkbox" class="custom-control-input" id="customCheck2" value="1">
                        <label class="custom-control-label" for="customCheck2">No Pagado</label>
                      </div>                  
                    </div>
                  </div>
              </div>
            </div>
            <div class="mt-4 mb-4">
              <button class="btn btn-success">Generar</button>
            </div>
          </center>
          <div class="shadow border border-default" style="border-radius: 20px;">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12" style="position: relative !important;">
                  <div id="cargando" class="mt-2 mb-2" style="display: none;">
                    <center>
                      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </center>
                  </div>
                  <div id="tablePendientes">
                    <table id="example1" class="table table-bordered table-hover table-striped dataTable dtr-inline collapsed" style="width: 100% !important;">
                      <thead class="text-capitalize bg-primary">
                          <tr>
                            <th>Nombre</th>
                            <th>RUT</th>
                            <th>Total</th>
                          </tr>
                      </thead>
                      <tbody id="bodyPendiente">
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
</div>
@endsection

  <script type="text/javascript">

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
