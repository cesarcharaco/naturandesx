<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<link rel="stylesheet" href="{{ asset('login/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('login/css/font-awesome.min.css') }}">
	@include('layouts.css')
    @include('layouts.css2')
    @toastr_css
    @yield('css')
    <style type="text/css">
    	.login-box {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-top: 50px;
}

.login-box form {
    margin: auto;
    width: 450px;
    max-width: 100%;
    background: #fff;
    border-radius: 3px;
}

.login-box-register form {
    margin: auto;
    width: 100%;
    max-width: 100%;
    background: #fff;
    border-radius: 3px;
}

.login-form-head {
    text-align: center;
    background: #010573;
    padding: 50px;
}

.login-form-head h4 {
    letter-spacing: 0;
    text-transform: uppercase;
    font-weight: 600;
    margin-bottom: 7px;
    color: #fff;
}

.login-form-head p {
    color: #fff;
    font-size: 14px;
    line-height: 22px;
}

.login-form-body {
    padding: 50px;
    opacity: 0.7;
}
.top-bar ul.social-custom a {
    text-decoration: none !important;
    font-size: 0.7rem;
    width: 26px;
    height: 26px;
    line-height: 26px;
    color: #999;
    text-align: center;
    margin: 0;
}
    </style>
</head>
<body>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="background: #010573;">
    <div class="container">
      <a href="../../index3.html" class="navbar-brand">
        <img src="{{ asset('img/favicon.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="height: 70px !important;">
      </a>
      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto social-custom list-inline">
        <!-- Messages Dropdown Menu -->
            <li class="list-inline-item"><a href="#" style="font-size: 22px; color: white;"><i class="fa fa-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#" style="font-size: 22px; color: white;"><i class="fa fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="#" style="font-size: 22px; color: white;"><i class="fa fa-youtube"></i></a></li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: url('{{ asset('login/images/banner.jpg') }}') center/cover no-repeat !important; position: relative;">
  	<div class="content">
      	<div class="container">
	        <div class="row">
	  			@yield('content')
	  		</div>
  		</div>
  	</div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer" style="background: #010573; border-bottom: 10px solid #fef200 !important; color: white;">
    <!-- To the right -->
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
  </footer>
</div>
<!-- ./wrapper -->

</body>
    <!-- login area end -->
    @include('layouts.scripts')
</body>
@yield('scripts')
@jquery
@toastr_js
@toastr_render
</html>
