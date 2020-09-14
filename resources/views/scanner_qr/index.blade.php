@extends('layouts.app')
@section('css')
  <title>Scanner QR</title>
  <link href=" {{ URL::asset('/webcodecamjs/css/style.css') }}" rel="stylesheet">
{{-- <link href="{{ asset('scanner/css/bootstrap.min.css') }}" rel="stylesheet"> --}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/flatly/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    
    <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            body {
            /*padding-top: 70px;*/
        }
        </style>
@endsection

@section('page-title-area')
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Scanner QR</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('empleados.index') }}">Scanner QR</a></li>
                    <li><span>Cargar</span></li>
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
       <!--  <div class="row mt-5 mb-5">
            <div class="col-md-6">
                
            </div>
        </div> -->

        <div class="row mt-5 mb-5">
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
            </div>
            <div class="col-md-6">
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
    </div>
        
@endsection
@section('scripts')
<script type="text/javascript" src=" {{ URL::asset('/webcodecamjs/js/filereader.js') }}"></script>
<script type="text/javascript" src=" {{ URL::asset('/webcodecamjs/js/qrcodelib.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/webcodecamjs/js/webcodecamjs.js ') }}"></script>

<script>
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
                   return confirm('There is no user with this qr code'); 
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
                    window.open("https://www.naturandes.eichechile.com");
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

@endsection