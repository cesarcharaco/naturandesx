<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('login/images/icon/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('login/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('login/css/font-awesome.min.css') }}">
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('login/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('login/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('login/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('login/css/estilo.css') }}">
    <link rel="stylesheet" href="{{ asset('login/css/responsive.css') }}">
    @include('layouts.css2')
    @toastr_css
    @yield('css')
</head>
<body>
	<header>
		<div class="top-bar" style="margin-bottom: 5px;">
		  <div class="container">
		    <div class="row d-flex align-items-center">
		      <div class="col-md-6 d-md-block">
		        <img src="{{ asset('img/favicon.png') }}" width="300">
		      </div>
		      <div class="col-md-6">
		        <div class="d-flex justify-content-md-end justify-content-between">
		          <ul class="social-custom list-inline">
		            <li class="list-inline-item"><a href="#" style="font-size: 22px; color: white;"><i class="fa fa-facebook"></i></a></li>
		            <li class="list-inline-item"><a href="#" style="font-size: 22px; color: white;"><i class="fa fa-instagram"></i></a></li>
		            <li class="list-inline-item"><a href="#" style="font-size: 22px; color: white;"><i class="fa fa-youtube"></i></a></li>
		          </ul>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
	</header>
    <!-- login area start -->
    @yield('content')
    <footer class="page-section-no-padding  footer2-container">
        <div class="container">
            <div class="row">
                <!-- Copyright -->
                <div class="text-center col-md-4">
                    <p style="color: white !important;">Quienes somos <br> Productos</p>
                </div>

                <!-- Social Links -->
                <div class="text-center col-md-4">
                    <p style="color: white !important;">Atención al cliente <br> Casa matriz</p>
                </div>
                <div class="text-center col-md-4">
                	<p style="color: white !important;">Termino y condiciones <br> Horarios de atención</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- login area end -->
    @include('layouts.scripts')
</body>
@yield('scripts')
@jquery
@toastr_js
@toastr_render
</html>
