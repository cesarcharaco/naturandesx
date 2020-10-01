@extends('layouts.app')
@section('css')
  <title>Historial</title>
  <link rel="stylesheet" href="{{ asset('plugins/parsleyjs/parsley.css') }}">
@endsection

@section('content-header')
<input type="hidden" id="nameRegistrar" value="1">
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Historial</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Historial</a></li>
          <li class="breadcrumb-item active" style="color:black;">Registros</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-body">
        <div class="card border border-warning" style="border-radius: 10px;">
        <div class="card-body">
          <center>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Desde</label>
                  <input id="inputDesde" max="<?php echo date('Y-m-d');?>" type="date" class="form-control" name="desde" style="border-radius: 30px;" onchange="busqueda();">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Hasta</label>
                  <input id="inputHasta" max="<?php echo date('Y-m-d');?>" type="date" class="form-control" name="hasta" style="border-radius: 30px;" onchange="busqueda();">
                </div>
              </div>
            </div>
          </center>
          <div id="cargando" style="display: none;">
            <center>
              <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </center>
          </div>
          <div class="row mb-2 mt-2">
            <div class="col-md-12">
              <div id="tableHistory">
                <!-- <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
                  <table id="example1" class="table table-bordered table-hover table-striped dataTable dtr-inline collapsed border border-orange" style="width: 100% !important;">
                    <thead class="text-capitalize bg-primary">
                      <tr class="border-orange">
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Repartidor</th>
                        <th>Orden de Pedido</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody id="busquedaHistory">
                      <td>asd</td>
                      <td>asd</td>
                      <td>asd</td>
                      <td>asd</td>
                      <td>asd</td>
                      <td>asd</td>
                      <td>asd</td>
                    </tbody>
                  </table>
                </div> -->
              </div>
              <center>
                <h2 id="sin_resultados" style="display: none;"><strong>Sin Resultados</strong></h2>
              </center>
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
      $('#tableHistory').empty();
      $('#inputDesde').attr('disabled',true);
      $('#inputHasta').attr('disabled',true);
      $('#cargando').fadeIn(300);



      $.get("historial/"+desde+"/"+hasta+"/"+1+"/buscar",function (data) {
      })
      .done(function(data) {
        if (data.length>0) {
	      $('#tableHistory').append(
	        '<div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">'+
	          '<table id="example1" class="table table-bordered table-hover table-striped dataTable dtr-inline collapsed border border-orange" style="width: 100% !important;">'+
	            '<thead class="text-capitalize bg-primary">'+
	              '<tr class="border-orange">'+
	                '<th>Fecha</th>'+
	                '<th>Repartidor</th>'+
	                '<th>Cantidad de Promociones</th>'+
	                '<th>Promoción</th>'+
	                '<th>Estado</th>'+
	                // '<th>Acciones</th>'+
	              '</tr>'+
	            '</thead>'+
	            '<tbody id="busquedaHistory">'+
	             
	            '</tbody>'+
	          '</table>'+
	        '</div>'
	      );


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

  function busqueda2(id_venta, fecha,nombres, apellidos, promocion, cantidad, monto_total, n1, n2) {
    $.get("repartidor/"+id_venta+"/buscar",function (data) {
    })
    .done(function(data) {
      $('#busquedaHistory').append(
        '<tr id="tr+'+id_venta+'">'+
          '<td>'+fecha+'</td>'+
          '<td>'+data[0].nombres+' '+data[0].apellidos+'</td>'+
          '<td>'+cantidad+' / '+monto_total+'.00 $</td>'+
          '<td>'+promocion+'</td>'+
          '<td>'+data[0].status+'</td>'+
          // '<td>Acciones</td>'+
        +'</tr>'
      );
      if (n1 == n2) {
      	 setTimeout(function() {
	        $("#example1").DataTable({
	          "responsive": true,
	          "autoWidth": false,
	        });
	        setTimeout(function() {
	        	$("#example1").css('display', 'none');
	        	$("#example1").fadeIn(300);
	        }, 500);
		}, 500);
        $('#inputDesde').removeAttr('disabled',false).val(0);
        $('#inputHasta').removeAttr('disabled',false).val(0);
        $('#cargando').fadeOut('slow');
      }
    });
  }
  </script>
@section('scripts')
<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('plugins/parsleyjs/i18n/es.js') }}"></script>
@endsection
