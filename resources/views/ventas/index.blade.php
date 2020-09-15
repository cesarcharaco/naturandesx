@extends('layouts.app')
@section('css')
  <title>Ventas</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/flatly/bootstrap.min.css" rel="stylesheet">
@endsection

@section('page-title-area')
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6 barraTitulo">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Realizar Venta</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('empleados.index') }}">Ventas</a></li>
                    <li><span>Inicio</span></li>
                </ul>
            </div>
        </div>
        @include('layouts.perfil')
    </div>
</div>
<!-- page title area end -->
@endsection
@section('content')
  <div class="main-content-inner">

      <div class="row mt-5 mb-5">
          <!-- Live Crypto Price area sta Qrt -->
          <div class="col-lg-4">
              <div class="card border" style="border-radius: 10px !important;">
                  <div class="card-body">
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
                            @foreach($ventas as $key)
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
                              @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Live Crypto Price area end -->
          <!-- trading history area start -->
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
                          <label for="">Ingrese o Scanne el Código QR</label>
                          <div class="container" id="QR-Code">
                            <div class="col-md-6">
                              <div class="well" style="position: relative;display: inline-block;">
                                  <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
                                  <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                                  <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                                  <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                                  <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                              </div>
                              <div class="well" style="width: 100%;">
                                  <label id="zoom-value" width="100">Zoom: 2</label>
                                  <input id="zoom" onchange="Page.changeZoom();" type="range" min="10" max="30" value="20">
                                  <label id="brightness-value" width="100">Brillo: 0</label>
                                  <input id="brightness" onchange="Page.changeBrightness();" type="range" min="0" max="128" value="0">
                                  <label id="contrast-value" width="100">Contraste: 0</label>
                                  <input id="contrast" onchange="Page.changeContrast();" type="range" min="-128" max="128" value="0">
                                  <label id="threshold-value" width="100">Límite: 0</label>
                                  <input id="threshold" onchange="Page.changeThreshold();" type="range" min="0" max="512" value="0">
                                  <label id="sharpness-value" width="100">Nitidez: off</label>
                                  <input id="sharpness" onchange="Page.changeSharpness();" type="checkbox">
                                  <label id="grayscale-value" width="100">Escala de Grises: off</label>
                                  <input id="grayscale" onchange="Page.changeGrayscale();" type="checkbox">
                                  <br>
                                  <label id="flipVertical-value" width="100">Girar Vertical: off</label>
                                  <input id="flipVertical" onchange="Page.changeVertical();" type="checkbox">
                                  <label id="flipHorizontal-value" width="100">Girar Horizontal: off</label>
                                  <input id="flipHorizontal" onchange="Page.changeHorizontal();" type="checkbox">
                              </div>
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
                              <div class="form-group">
                                 
                                  <button title="Decode Image" class="btn btn-default btn-sm" id="decode-img" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-upload"></span></button>
                                  <button title="Image shoot" class="btn btn-info btn-sm disabled" id="grab-img" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-picture"></span></button>
                                  <button title="Play" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-play"></span></button>
                                  <button title="Pause" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-pause"></span></button>
                                  <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-stop"></span></button>
                               </div>

                              <div class="thumbnail" id="result">
                                  <div class="well">
                                      <img width="320" height="240" id="scanned-img" src="">
                                  </div>
                                  <div class="caption">
                                      <h3>Escaneando resultados</h3>
                                      <p id="scanned-QR"></p>
                                  </div>
                              </div>
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
@endsection
@section('scripts')
<script type="text/javascript" src=" {{ URL::asset('/webcodecamjs/js/filereader.js') }}"></script>
<script type="text/javascript" src=" {{ URL::asset('/webcodecamjs/js/qrcodelib.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/webcodecamjs/js/webcodecamjs.js ') }}"></script>

<script>

function codigoEscaneado(codigo) {
  $('#scannerQR').fadeOut('slow',
    function() { 
      $(this).hide();
      $('#vistaCliente').fadeIn(300);
  });
  // alert(codigo);
  $.get("clientes/"+codigo+"/buscar",function (data) {
  })
  .done(function(data) {
    if (data.length>0) {
      $('#nombre_c').html(data[0].nombres+' '+data[0].apellidos);
      $('#rut_c').html(data[0].rut);
      $('#email_c').html(data[0].email);
      $('#id_cliente2').val(data[0].id);
    }else{
      alert('Sin resultados');
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
                sharpnessValue[txt] = sharpnessValue[txt].split(":")[0] + ": on";
                decoder.options.sharpness = [0, -1, 0, -1, 5, -1, 0, -1, 0];
            } else {
                sharpnessValue[txt] = sharpnessValue[txt].split(":")[0] + ": off";
                decoder.options.sharpness = [];
            }
        }
    };
    Page.changeVertical = function() {
        if (decoder.isInitialized()) {
            var value = flipVertical.checked;
            if (value) {
                flipVerticalValue[txt] = flipVerticalValue[txt].split(":")[0] + ": on";
                decoder.options.flipVertical = value;
            } else {
                flipVerticalValue[txt] = flipVerticalValue[txt].split(":")[0] + ": off";
                decoder.options.flipVertical = value;
            }
        }
    };
    Page.changeHorizontal = function() {
        if (decoder.isInitialized()) {
            var value = flipHorizontal.checked;
            if (value) {
                flipHorizontalValue[txt] = flipHorizontalValue[txt].split(":")[0] + ": on";
                decoder.options.flipHorizontal = value;
            } else {
                flipHorizontalValue[txt] = flipHorizontalValue[txt].split(":")[0] + ": off";
                decoder.options.flipHorizontal = value;
            }
        }
    };
    Page.changeGrayscale = function() {
        if (decoder.isInitialized()) {
            var value = grayscale.checked;
            if (value) {
                grayscaleValue[txt] = grayscaleValue[txt].split(":")[0] + ": on";
                decoder.options.grayScale = true;
            } else {
                grayscaleValue[txt] = grayscaleValue[txt].split(":")[0] + ": off";
                decoder.options.grayScale = false;
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

