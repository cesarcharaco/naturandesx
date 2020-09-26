@extends('layouts.app')
@section('css')
<style type="text/css">

  .custom-control-input{
    display: none !important;
  }
  .container{
/*      width:95%;
      max-width:900px;
      padding:32px 64px;
      margin:auto;*/
    }

    .botonesLaterales{
      /*las imágenes usadas tienen width de 48px*/
      width:48px;
      position:fixed;
      top:50px;
      right:0;
    }

    /* Extra centrado vertical*/

    .botonesLaterales{
      /*border:1px solid #000;*/
      top:50%;
      height:205px;
      /*para poner height 192 deberíamos haber indicado en el reset de estilos font-size:0;*/
      margin-top:-100px;
      /*position: relative;*/
    }
</style>
  <title>Ventas</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/flatly/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content-header')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Ventas</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Ventas</a></li>
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
          <!-- Live Crypto Price area sta Qrt -->
          <div class="col-lg-12">
              <div id="mensaje" class="btn btn-danger text-white mt-3 mb-3" style="display: none;">¡No se puede realizar la venta al cliente debido a que su estatus es <strong>SIN APROBAR</strong>!</div>
              <div id="mensaje2" class="btn btn-danger text-white mt-3 mb-3" style="display: none;">¡No se puede realizar la venta al cliente debido a que su estatus es <strong>INACTIVO</strong>!</div>
              <br>
              <div class="card border" style="border-radius: 10px !important; display: none;" id="tabla">
                  <div class="card-body">
                    <center>
                    </center>
                      <h4 class="header-title">Ventas Realizadas</h4>
                      <div class="" style="width: 100% !important;box-shadow: 0 0 3px black;">
                        <table id="" class="text-center table-striped table-hover" width="100%">
                          <thead class="text-capitalize">
                            <tr class="bg-success text-white">
                              <th><center>Cliente</center></th>
                              <th><center>Cant.</center></th>
                              <th>Total($)</th>
                              <th><center>Fecha</center></th>
                            </tr>
                            
                          </thead>
                          <tbody>
                            <?php $i=0; ?>
                            @foreach($ventas as $key)
                              @if($i<10)
                                <tr class="mb-5">
                                  <td>
                                    <!-- <div class="icon d">
                                      <i class="ti-money"></i>
                                    </div> -->
                                        <i class="ti-check" style="background-color: green; color: white; border-radius: 30px;"></i>
                                    {{ $key->cliente->nombres }}
                                  </td>
                                  <td>
                                    {{ $key->cantidad }}
                                  </td>
                                  <td>
                                    <span>${{$key->monto_total}} 
                                    </span>
                                  </td>
                                  <td>
                                    @if($key->created_at->month == 1)
                                      @php $mes= 'Enero' @endphp
                                    @elseif($key->created_at->month == 2)
                                      @php $mes= 'Febrero' @endphp
                                    @elseif($key->created_at->month == 3)
                                      @php $mes= 'Marzo' @endphp
                                    @elseif($key->created_at->month == 4)
                                      @php $mes= 'Abril' @endphp
                                    @elseif($key->created_at->month == 5)
                                      @php $mes= 'Mayo' @endphp
                                    @elseif($key->created_at->month == 6)
                                      @php $mes= 'Junio' @endphp
                                    @elseif($key->created_at->month == 7)
                                      @php $mes= 'Julio' @endphp
                                    @elseif($key->created_at->month == 8)
                                      @php $mes= 'Agosto' @endphp
                                    @elseif($key->created_at->month == 9)
                                      @php $mes= 'Septiembre' @endphp
                                    @elseif($key->created_at->month == 10)
                                      @php $mes= 'Octubre' @endphp
                                    @elseif($key->created_at->month == 11)
                                      @php $mes= 'Noviembre' @endphp
                                    @else
                                      @php $mes= 'Diciembre' @endphp
                                    @endif
                                    <strong>{{$key->created_at->day}}</strong> de
                                    <strong>{{$mes}}</strong> del
                                    <strong>{{$key->created_at->year}}</strong>
                                    <br>
                                    {{--A las <strong>{{$key->created_at->hour}}:{{$key->created_at->minute}}:00</strong>--}}

                                  </td>
                                </tr>
                                <?php $i++; ?>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
              </div>

          </div>
          <!-- Live Crypto Price area end -->
          <!-- trading history area start -->
          <div class="col-lg-4">
              <div id="configuracion" class="configuracion card border" style="border-radius: 10px !important; display: none;">
                <div class="card-body">
                  <div class="mb-5" style="width: 100%;">
                    <div class="form-group">
                      <label id="zoom-value" width="100" class="text-danger">Zoom: 2</label>
                      <input id="zoom" onchange="Page.changeZoom();" type="range" min="10" max="30" value="20" class="custom-range custom-range-danger">
                    </div>
                    <div class="form-group">
                      <label id="brightness-value" width="100" class="text-success">Brillo: 0</label>
                      <input id="brightness" onchange="Page.changeBrightness();" type="range" min="0" max="128" value="0" class="custom-range custom-range-success">
                    </div>
                    <div class="form-group">
                      <label id="contrast-value" width="100" class="text-warning">Contraste: 0</label>
                      <input id="contrast" onchange="Page.changeContrast();" type="range" min="-128" max="128" value="0" class="custom-range custom-range-warning">
                    </div>
                    <div class="form-group">
                      <label id="threshold-value" width="100" class="text-primary">Límite: 0</label>
                      <input id="threshold" onchange="Page.changeThreshold();" type="range" min="0" max="512" value="0" class="custom-range custom-range-primary">
                    </div>
                    <div class="mt-5 md-5"><br></div>
                      <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" onchange="Page.changeSharpness();" class="custom-control-input" id="sharpness">
                          <label class="custom-control-label" id="sharpness-value" for="sharpness">Nitidez</label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" onchange="Page.changeGrayscale();" class="custom-control-input" id="grayscale">
                          <label class="custom-control-label" id="grayscale-value" for="grayscale">Escala de Grises</label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" onchange="Page.changeVertical();" class="custom-control-input" id="flipVertical">
                          <label class="custom-control-label" id="flipVertical-value" for="flipVertical">Girar Vertical</label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" onchange="Page.changeHorizontal();" class="custom-control-input" id="flipHorizontal">
                          <label class="custom-control-label" id="flipHorizontal-value" for="flipHorizontal">Girar Horizontal</label>
                        </div>
                      </div>
                        <!-- <div class="form-group">
                          <label id="sharpness-value" width="100">Nitidez: off</label>
                          <input id="sharpness" onchange="Page.changeSharpness();" type="checkbox" class="custom-control-input">
                        </div> -->
                        <!-- <div class="form-group">
                          <label id="grayscale-value" width="100">Escala de Grises</label>
                          <input id="grayscale" onchange="Page.changeGrayscale();" type="checkbox">
                        </div>
                        <div class="form-group">
                        <label id="flipVertical-value" width="100">Girar Vertical</label>
                          <input id="flipVertical" onchange="Page.changeVertical();" type="checkbox">
                        </div>
                        <div class="form-group">
                          <label id="flipHorizontal-value" width="100">Girar Horizontal</label>
                          <input id="flipHorizontal" onchange="Page.changeHorizontal();" type="checkbox">
                        </div> -->
                  </div>
                </div>
              </div>

              <div id="selectCamara" class="selectCamara card border" style="border-radius: 10px !important;display: none;">
                <div class="card-body">
                  <div class="card mb-4">
                      <div class="card-body">
                           <select class="select2 border" id="camera-select" style="
                              width: 100% !important;
                              border-color: #8914fc !important;
                              border-radius: 5px;
                              height: 35px;">
                              
                          </select>
                      </div>
                  </div>
                </div>
              </div>

              <div id="botones" class="botones card border" style="display: none; border-radius: 10px !important;">
                <div class="card-body">
                  <center>
                    
                  <div class="form-group">
                     
                      <button title="Decode Image" class="btn btn-default btn-sm" id="decode-img" type="button" data-toggle="tooltip"data-placement="bottom"><span class="glyphicon glyphicon-upload"></span></button>

                      <button title="Image shoot" class="btn btn-default btn-sm disabled" id="grab-img" type="button" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-picture"></span></button>

                      <button title="Play" class="btn btn-default btn-sm" id="play" type="button" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-play"></span></button>

                      <button title="Pause" class="btn btn-default btn-sm" id="pause" type="button" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-pause"></span></button>

                      <button title="Stop streams" class="btn btn-default btn-sm" id="stop" type="button" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-stop"></span></button>

                  </div>
                  </center>
                </div>
              </div>

              <div id="resultadoScanner" class="resultadoScanner card border" style="display: none;border-radius: 10px !important;">
                <div class="card-body">
                    <div class="thumbnail" id="result">
                      <div class="well">
                          <img id="scanned-img" src="" style="width: 100%; height: 100%;">
                      </div>
                      <div class="caption">
                          <h3>Escaneando resultados</h3>
                          <p id="scanned-QR"></p>
                      </div>
                    </div>
                </div>
              </div>
          </div>
          <div class="col-lg-8 mt-sm-30 mt-xs-30">
            <form action="{{ route('ventas.store') }}" method="POST" name="ventas">
              @csrf
              <div class="card shadow">
                  <div class="card-body">
                    <div class="border border-success mb-3 shadow rounded">
                      <div class="card-body">
                        
                        {{-- <label>Seleccione cliente</label>
                        <div class="input-group mb-3 shadow ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Clientes</span>
                            </div>
                            <select name="id_cliente" class="form-control select2" required>
                              @foreach($clientes as $key)
                                <option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}}.- {{$key->rut}}</option>
                              @endforeach()
                            </select>
                        </div> --}}
                        <div id="scannerQR">
                          <center><label for="" >Ingrese o Scanne el Código QR</label></center>
                          <div id="QR-Code">
                            <div class="botonesLaterales">

                              <a href="#tabla" id="boton6" onclick="mostrarO(6)" class="btn btn-danger btn-sm mt-1 text-white" style="border-radius: 30px !important;" style="background-color: purple !important;">
                                <i class="fa fa-fw fa-align-center"></i></a>
                              <a href="#configuracion" id="boton1" onclick="mostrarO(1)" class="btn btn-warning btn-sm mt-1 text-white" style="border-radius: 30px !important;"><i class="fa fa-cog"></i></a>
                              <a href="#selectCamara" id="boton2" onclick="mostrarO(2)" class="btn btn-info btn-sm mt-1 text-white" style="border-radius: 30px !important;"><i class="fa fa-camera"></i></a>
                              <a href="#botones" id="boton3" onclick="mostrarO(3)" class="btn btn-default btn-sm mt-1 text-dark" style="border-radius: 30px !important;"><i class="fa fa-play"></i></a>
                              <a href="#resultadoScanner" id="boton4" onclick="mostrarO(4)" class="btn btn-primary btn-sm mt-1 text-white" style="border-radius: 30px !important;"><i class="fa fa-image"></i></a>
                              <a  id="boton5" onclick="mostrarO(5)" class="btn btn-success btn-sm mt-1 text-white" style="border-radius: 30px !important;"><i class="fa fa-arrow-left"></i></a>
                            </div>
                              <div class="col-md-12 text-center">
                                <center>
                                  <div align="center" class="card" style="position: relative;display: inline-block; justify-content: center !important; text-align: center !important;">
                                      <canvas style="width: 100%; height: 100%;" id="webcodecam-canvas"></canvas>
                                      <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                                      <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                                      <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                                      <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                                  </div>
                                </center>
                              </div>
                          </div>
                        </div>
                        <div id="vistaCliente" style="display: none;">
                          <div class="card rounded" style="box-shadow:10px black;">
                            <div class="card-body">
                              <div class="form-group">
                                <span id="nombre_c" style="font-size: 30px; color: grey;"></span>
                              </div>
                              <div class="form-group">
                                <span id="rut_c" style="font-size: 30px; color: grey;"></span>
                              </div>
                              <div class="form-group">
                                <span id="email_c" style="font-size: 30px; color: grey;"></span>
                              </div>
                            </div>
                          </div>
                          <input type="hidden" name="id_cliente" id="id_cliente2">
                          <div class="card mb-3 shadow rounded">
                            <div class="card-body">
                              <label>Seleccione Promoción</label>
                              <div class="input-group mb-3 shadow ">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon3">Promociones</span>
                                  </div>
                                  <select class="form-control select2 border" id="selectPromo" name="id_promocion" style="
                                    width: 100% !important;
                                    border-color: #8914fc !important;
                                    border-radius: 5px;
                                    height: 40px;">
                                    <option value="0" selected>Seleccione</option>
                                    @foreach($promociones as $key)
                                      <option value="{{$key->id}}" id="selectOptionPromo{{$key->id}}">{{$key->promocion}} - {{$key->monto}}$</option>
                                    @endforeach()
                                  </select>
                              </div>

                              <div class="form-group">
                                <input type="number" class="form-control border border-dark" onkeyup="selectPromocion(this.value)" min="0" maxlength="7" name="cantidad" id="cantidadPromo" placeholder="Cantidad de Promociones" style="
                                    width: 100% !important;
                                    border-color: #8914fc !important;
                                    border-radius: 5px;
                                    height: 35px;">
                              </div>
                            </div>
                          </div>
                          <div class="row justify-content-center">
                          <div class="col-md-6">
                              <div class="card">
                                  <div class="card-body">
                                      <!-- <h4 class="header-title">Thead Primary</h4> -->
                                      <div class="single-table">
                                              <table class="table text-center">
                                                  <tbody id="promocionSeleccionada">
                                                  </tbody>
                                              </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                            <div class="col-md-6">
                              <div class="card shadow" style="width: 100% !important; height: 200px;">
                                  <div class="card-body">
                                    <center>
                                      <span style="font-size: 70px; color: grey;" id="TotalPagar">0</span><span style="font-size: 40px; color: grey;">$</span>
                                    </center>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <center>
                            <div id="promocionSeleccionada2">
                              
                            </div>
                            <input type="hidden" name="cantidad1" id="cantidad1">
                            <input type="hidden" name="id_promocion1" id="id_promocion1">
                            <input type="hidden" name="monto_total" id="monto_total">
                            <button type="submit" class="btn btn-success" id="botonAceptar" disabled>Aceptar</button>
                          </center>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </form>
          <!-- trading history area end -->
          </div>
    </div>
  </div>
@endsection
@section('scripts')
<script type="text/javascript" src=" {{ URL::asset('/webcodecamjs/js/filereader.js') }}"></script>
<script type="text/javascript" src=" {{ URL::asset('/webcodecamjs/js/qrcodelib.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/webcodecamjs/js/webcodecamjs.js ') }}"></script>

<script>

  function mostrarO(opcion) {
    if(opcion == 1){
      $('#configuracion').fadeIn(300);
      $('#boton1').removeClass('btn-warning').addClass('btn-success');
      $('#boton1').removeAttr('onclick',false).attr('onclick','Cerrar(1);');
    }else if(opcion == 2){
      $('#selectCamara').fadeIn(300);
      $('#boton2').removeClass('btn-info').addClass('btn-success');
      $('#boton2').removeAttr('onclick',false).attr('onclick','Cerrar(2);');
    }else if(opcion == 3){
      $('#botones').fadeIn(300);
      $('#boton3').removeClass('text-dark').addClass('text-white');
      $('#boton3').removeClass('btn-default').addClass('btn-success');
      $('#boton3').removeAttr('onclick',false).attr('onclick','Cerrar(3);');
    }else if(opcion == 4){
      $('#resultadoScanner').fadeIn(300);
      $('#boton4').removeClass('btn-primary').addClass('btn-success');
      $('#boton4').removeAttr('onclick',false).attr('onclick','Cerrar(4);');
    }else if(opcion == 6){
      $('#tabla').fadeIn(300);
      $('#boton6').removeClass('btn-danger').addClass('btn-success');
      $('#boton6').removeAttr('onclick',false).attr('onclick','Cerrar(6);');
    }else{
      $('#boton1').removeClass('btn-success').addClass('btn-warning');
      $('#boton2').removeClass('btn-success').addClass('btn-info');
      $('#boton3').removeClass('text-white').addClass('text-dark');
      $('#boton3').removeClass('btn-success').addClass('btn-default');
      $('#boton4').removeClass('btn-success').addClass('btn-primary');


      $('#configuracion').fadeOut('slow');
      $('#selectCamara').fadeOut('slow');
      $('#botones').fadeOut('slow');
      $('#resultadoScanner').fadeOut('slow');
      $('#tabla').fadeOut('slow');
    }
  }

  function Cerrar(opcion) {
    if(opcion == 1){
      $('#configuracion').fadeOut('slow');
      $('#boton1').removeClass('btn-success').addClass('btn-warning');
      $('#boton1').removeAttr('onclick',false).attr('onclick','mostrarO(1);');
    }else if(opcion == 2){
      $('#selectCamara').fadeOut('slow');
      $('#boton2').removeClass('btn-success').addClass('btn-info');
      $('#boton2').removeAttr('onclick',false).attr('onclick','mostrarO(2);');
    }else if(opcion == 3){
      $('#botones').fadeOut('slow');
      $('#boton3').removeClass('text-white').addClass('text-dark');
      $('#boton3').removeClass('btn-success').addClass('btn-default');
      $('#boton3').removeAttr('onclick',false).attr('onclick','mostrarO(3);');
    }else if(opcion == 6){
      $('#tabla').fadeOut('slow');
      $('#boton6').removeClass('btn-success').addClass('btn-danger');
      $('#boton6').removeAttr('onclick',false).attr('onclick','mostrarO(6);');
    }else{
      $('#resultadoScanner').fadeOut('slow');
      $('#boton4').removeClass('btn-success').addClass('btn-primary');
      $('#boton4').removeAttr('onclick',false).attr('onclick','mostrarO(4);');
    }
  }


function codigoEscaneado(codigo) {
  $('#mensaje').css('display','none');
  $('#scannerQR').fadeOut('slow',
    function() { 
      $(this).hide();
      $('#configuracion').fadeOut('slow');
      $('#selectCamara').fadeOut('slow');
      $('#botones').fadeOut('slow');
      $('#resultadoScanner').fadeOut('slow');

      $('#vistaCliente').fadeIn(300);
  });
  // alert(codigo);
  $.get("clientes/"+codigo+"/buscar",function (data) {
  })
  .done(function(data) {
    if (data.length>0) {
      if(data[0].status == 'Activo'){

        $('#nombre_c').html(data[0].nombres+' '+data[0].apellidos);
        $('#rut_c').html(data[0].rut);
        $('#email_c').html(data[0].email);
        $('#id_cliente2').val(data[0].id);
      }else if(data[0].status == 'Sin Aprobar'){

        $('#mensaje').css('display','block');
        setTimeout(function() {
          $('#mensaje').fadeOut('slow');
          location.reload();
        }, 3000);
        $('#scannerQR').show();
        $('#vistaCliente').hide(300);

      }else{

        $('#mensaje2').css('display','block');
        setTimeout(function() {
          $('#mensaje2').fadeOut('slow');
          location.reload();
        }, 3000);
        $('#scannerQR').show();
        $('#vistaCliente').hide(300);

      }
    }else{
      alert('Sin resultados');
      $('#scannerQR').show();

      $('#vistaCliente').hide(300);
    }
  });
}

 function CallAjaxLoginQr(code) {
      $.ajax({
            type: "POST",
            cache: false,
            url : "{{action('QrLoginController@checkUser')}}",
            data: {data:code},
                success: function(data) {
                  console.log(data);
                  if (data==1) {
                    //location.reload()
                    $(location).attr('href', '{{url('/')}}');
                  }else{
                   return confirm('No hay usuario con éste código QR'); 
                  }
                  // 
                }
            })
 }

(function(undefined) {
    "use strict";

    function Q(el) {
        if (typeof el === "string") {
            var els = document.querySelectorAll(el);
            return typeof els === "undefined" ? undefined : els.length > 1 ? els : els[0];
        }
        return el;
    }
    var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
    var scannerLaser = Q(".scanner-laser"),
        imageUrl = new Q("#image-url"),
        play = Q("#play"),
        scannedImg = Q("#scanned-img"),
        scannedQR = Q("#scanned-QR"),
        grabImg = Q("#grab-img"),
        decodeLocal = Q("#decode-img"),
        pause = Q("#pause"),
        stop = Q("#stop"),
        contrast = Q("#contrast"),
        contrastValue = Q("#contrast-value"),
        zoom = Q("#zoom"),
        zoomValue = Q("#zoom-value"),
        brightness = Q("#brightness"),
        brightnessValue = Q("#brightness-value"),
        threshold = Q("#threshold"),
        thresholdValue = Q("#threshold-value"),
        sharpness = Q("#sharpness"),
        sharpnessValue = Q("#sharpness-value"),
        grayscale = Q("#grayscale"),
        grayscaleValue = Q("#grayscale-value"),
        flipVertical = Q("#flipVertical"),
        flipVerticalValue = Q("#flipVertical-value"),
        flipHorizontal = Q("#flipHorizontal"),
        flipHorizontalValue = Q("#flipHorizontal-value");
    var args = {
        autoBrightnessValue: 100,
        resultFunction: function(res) {
            codigoEscaneado(res.code);
            [].forEach.call(scannerLaser, function(el) {
                fadeOut(el, 0.5);
                setTimeout(function() {
                    fadeIn(el, 0.5);
                }, 300);
            });
            scannedImg.src = res.imgData;
            CallAjaxLoginQr(res.code);
            scannedQR[txt] = res.format + ": " + res.code;
        },
        getDevicesError: function(error) {
            var p, message = "Error detected with the following parameters:\n";
            for (p in error) {
                message += p + ": " + error[p] + "\n";
            }
            alert(message);
        },
        getUserMediaError: function(error) {
            var p, message = "Error detected with the following parameters:\n";
            for (p in error) {
                message += p + ": " + error[p] + "\n";
            }
            alert(message);
        },
        cameraError: function(error) {
            var p, message = "Error detectado con los siguientes parámetros:\n";
            if (error.name == "NotSupportedError") {
                var ans = confirm("Tu Navegador no soporta getUserMedia via HTTP!\n(see: https:goo.gl/Y0ZkNV)");
                if (ans) {
                    window.open("https://www.naturandes.eiche.cl");
                }
            } else {
                for (p in error) {
                    message += p + ": " + error[p] + "\n";
                }
                alert(message);
            }
        },
        cameraSuccess: function() {
            grabImg.classList.remove("disabled");
        }
    };

    var decoder = new WebCodeCamJS("#webcodecam-canvas").buildSelectMenu("#camera-select", "environment|back").init(args);
    decodeLocal.addEventListener("click", function() {
        Page.decodeLocalImage();
    }, false);
    play.addEventListener("click", function() {
        if (!decoder.isInitialized()) {
            scannedQR[txt] = "Escaneando ...";
        } else {
            scannedQR[txt] = "Escaneando ...";
            decoder.play();
        }
    }, false);
    grabImg.addEventListener("click", function() {
        if (!decoder.isInitialized()) {
            return;
        }
        var src = decoder.getLastImageSrc();
        scannedImg.setAttribute("src", src);
    }, false);
    pause.addEventListener("click", function(event) {
        scannedQR[txt] = "Paused";
        decoder.pause();
    }, false);
    stop.addEventListener("click", function(event) {
        grabImg.classList.add("disabled");
        scannedQR[txt] = "Stopped";
        decoder.stop();
    }, false);
    Page.changeZoom = function(a) {
        if (decoder.isInitialized()) {
            var value = typeof a !== "undefined" ? parseFloat(a.toPrecision(2)) : zoom.value / 10;
            zoomValue[txt] = zoomValue[txt].split(":")[0] + ": " + value.toString();
            decoder.options.zoom = value;
            if (typeof a != "undefined") {
                zoom.value = a * 10;
            }
        }
    };
    Page.changeContrast = function() {
        if (decoder.isInitialized()) {
            var value = contrast.value;
            contrastValue[txt] = contrastValue[txt].split(":")[0] + ": " + value.toString();
            decoder.options.contrast = parseFloat(value);
        }
    };
    Page.changeBrightness = function() {
        if (decoder.isInitialized()) {
            var value = brightness.value;
            brightnessValue[txt] = brightnessValue[txt].split(":")[0] + ": " + value.toString();
            decoder.options.brightness = parseFloat(value);
        }
    };
    Page.changeThreshold = function() {
        if (decoder.isInitialized()) {
            var value = threshold.value;
            thresholdValue[txt] = thresholdValue[txt].split(":")[0] + ": " + value.toString();
            decoder.options.threshold = parseFloat(value);
        }
    };
    Page.changeSharpness = function() {
        if (decoder.isInitialized()) {
            var value = sharpness.checked;
            if (value) {
                sharpnessValue[txt] = sharpnessValue[txt].split(":")[0] + "";
                $('#sharpness-value').addClass('text-success');
                decoder.options.sharpness = [0, -1, 0, -1, 5, -1, 0, -1, 0];
            } else {
                sharpnessValue[txt] = sharpnessValue[txt].split(":")[0] + "";
                decoder.options.sharpness = [];
                $('#sharpness-value').removeClass('text-success');
            }
        }
    };
    Page.changeVertical = function() {
        if (decoder.isInitialized()) {
            var value = flipVertical.checked;
            if (value) {
                flipVerticalValue[txt] = flipVerticalValue[txt].split(":")[0] + "";
                $('#flipVertical-value').addClass('text-success');
                decoder.options.flipVertical = value;
            } else {
                flipVerticalValue[txt] = flipVerticalValue[txt].split(":")[0] + "";
                decoder.options.flipVertical = value;
                $('#flipVertical-value').removeClass('text-success');
            }
        }
    };
    Page.changeHorizontal = function() {
        if (decoder.isInitialized()) {
            var value = flipHorizontal.checked;
            if (value) {
                flipHorizontalValue[txt] = flipHorizontalValue[txt].split(":")[0] + "";
                $('#flipHorizontal-value').addClass('text-success');
                decoder.options.flipHorizontal = value;
            } else {
                flipHorizontalValue[txt] = flipHorizontalValue[txt].split(":")[0] + "";
                decoder.options.flipHorizontal = value;
                $('#flipHorizontal-value').removeClass('text-success');
            }
        }
    };
    Page.changeGrayscale = function() {
        if (decoder.isInitialized()) {
            var value = grayscale.checked;
            if (value) {
                grayscaleValue[txt] = grayscaleValue[txt].split(":")[0] + "";
                $('#grayscale-value').addClass('text-success');
                decoder.options.grayScale = true;
            } else {
                grayscaleValue[txt] = grayscaleValue[txt].split(":")[0] + "";
                decoder.options.grayScale = false;
                $('#grayscale-value').removeClass('text-success').addClass('text-danger');
            }
        }
    };
    Page.decodeLocalImage = function() {
        if (decoder.isInitialized()) {
            decoder.decodeLocalImage(imageUrl.value);
        }
        imageUrl.value = null;
    };
    var getZomm = setInterval(function() {
        var a;
        try {
            a = decoder.getOptimalZoom();
        } catch (e) {
            a = 0;
        }
        if (!!a && a !== 0) {
            Page.changeZoom(a);
            clearInterval(getZomm);
        }
    }, 500);

    function fadeOut(el, v) {
        el.style.opacity = 1;
        (function fade() {
            if ((el.style.opacity -= 0.1) < v) {
                el.style.display = "none";
                el.classList.add("is-hidden");
            } else {
                requestAnimationFrame(fade);
            }
        })();
    }

    function fadeIn(el, v, display) {
        if (el.classList.contains("is-hidden")) {
            el.classList.remove("is-hidden");
        }
        el.style.opacity = 0;
        el.style.display = display || "block";
        (function fade() {
            var val = parseFloat(el.style.opacity);
            if (!((val += 0.1) > v)) {
                el.style.opacity = val;
                requestAnimationFrame(fade);
            }
        })();
    }
    document.querySelector("#camera-select").addEventListener("change", function() {
        if (decoder.isInitialized()) {
            decoder.stop().play();
        }
    });
}).call(window.Page = window.Page || {});

//Trigger Click 
$("document").ready(function() {
    setTimeout(function() {
        $("#play").trigger('click');
    },10);
});

</script>
<script type="text/javascript">
  function selectPromocion(id2) {
    var id= $('#selectPromo').val();
    var spromo2=$('#promocionSeleccionada2-'+id).val();
    $.get("promociones/"+id+"/buscar_promocion",function (data) {
    })
    .done(function(data) {
      setTimeout(function(){ 
      var cantidad=$('#cantidadPromo').val();
      var existe = 0;

      if ($('#promocionSeleccionada2-'+id).length) {
        var existe = 1;
      }

        if (data.length>0 && spromo2!=0 && cantidad > 0 && existe == 0) {
          for (var i = 0; i < data.length; i++) {
              $('#promocionSeleccionada2').append('<input id="promocionSeleccionada2-'+id+'" type="hidden" name="id_promocion[]" value="'+id+'">');
              $('#promocionSeleccionada2').append('<input id="cantidadSeleccionada2-'+id+'" type="hidden" name="cantidad[]" value="'+cantidad+'">');
              $('#selectOptionPromo'+id).attr('disabled',true);
              $("#promocionSeleccionada").append(
                '<tr id="filaPromo'+id+'">'+
                  '<td>'+ data[i].promocion +'</td>'+
                  '<td>'+ cantidad +'</td>'+
                  '<td>'+ data[i].monto +'$</td>'+
                  '<td><buttom class="btn btn-danger btn-sm" style="border-radius: 30px;" onclick="EliminarFila('+id+','+data[i].monto+')">X</buttom></td>'+
                '</tr>'
              );

             montoTotal(id, 1,data[i].monto);
          }
        }else{
            
        }
      }, 1000);
    });
  }


  function EliminarFila(id,monto) {
    $('#promocionSeleccionada2-'+id).remove();
    $('#cantidadSeleccionada2-'+id).remove();
    $('#selectOptionPromo'+id).removeAttr('disabled',false);
    $('#filaPromo'+id).remove();
    montoTotal(id, 2,monto);
  }

  function montoTotal(id, tipo, monto){
    var existe = $('#promocionSeleccionada2-'+id).val();
    var cantidad=$('#cantidadPromo').val();
    $('#TotalPagar').html(0);
    // alert(cantidad);
    var total=0;
        var cuentaFilas = $('#promocionSeleccionada tr').length;
        if (cuentaFilas == 0) {
            $('#TotalPagar').html(parseInt(0));
            $('#botonAceptar').attr('disabled',true);
        } else {
          $('#botonAceptar').removeAttr('disabled',false);
            if (tipo == 2) {
                $('#TotalPagar').html(parseInt($('#TotalPagar').html())-monto*cantidad);
                $("#total").val($("#TotalPagar").html());
                $('#monto_total').val(monto*cantidad);
                $('#cantidad1').val(cantidad);
                $('#id_promocion1').val(id);
            } else if(tipo == 1) {
                $('#TotalPagar').html(parseInt($('#TotalPagar').html())+monto*cantidad);
                $("#total").val($("#TotalPagar").html());
                $('#monto_total').val(monto*cantidad);
                $('#cantidad1').val(cantidad);
                $('#id_promocion1').val(id);
            }
        }
      $('#cantidadPromo').val(0);
      $('#selectPromo').val(0);
      
  }

</script>
@endsection

