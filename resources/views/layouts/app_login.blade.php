<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
	<!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://d19m59y37dris4.cloudfront.net/universal/2-0-1/vendor/font-awesome/css/font-awesome.min.css">
    @include('layouts.css2')
    @toastr_css
    @yield('css')
    <style type="text/css">
	  #banner{
	    background-image: url("{{ asset('img/banner.jpg') }}") !important;
	    background-position: center center !important;
	    background-repeat: no-repeat !important;
	    background-attachment:  !important;
	    background-size: 100% 100%;
	    max-width: 400%;
	    height: 400px !important;
	    padding: 30px;
	  }
	  img {
	  	object-fit: cover;
	  }
	  h2{
	    color: white !important;
	  }
	  
	  label{
	  	color: #ffa600;
	  	text-align: center !important;
	  }

	  @media only screen and (max-width: 2000px)  {
	  	#login2{
	  		width: 90%;
	  	}
	  }

	  /*HEADER - HEADER - HEADER*/

.top-bar {
    background: #010573;
    color: #faff;
    font-size: 0.9rem;
    padding: 10px 0;
}

.top-bar .contact-info {
    margin-right: 20px;
}

.top-bar ul {
    margin-bottom: 0;
}

.top-bar .contact-info a {
    font-size: 0.8rem;
}

.top-bar ul.social-custom {
    margin-left: 20px;
}
.top-bar ul {
    margin-bottom: 0;
}

.top-bar a.login-btn i, .top-bar a.signup-btn i {
    margin-right: 10px;
}

.top-bar ul.social-custom a:hover {
    background: #4fbfa8;
    color: #fff;
}
.top-bar ul.social-custom a {
    text-decoration: none !important;
    font-size: 0.7rem;
    width: 26px;
    height: 26px;
    line-height: 26px;
    color: #999;
    text-align: center;
    border-radius: 50%;
    margin: 0;
}
a:focus, a:hover {
    color: #348e7b;
    text-decoration: underline;
}
.top-bar a.login-btn, .top-bar a.signup-btn {
    color: #eee;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    text-decoration: none !important;
    font-size: 0.75rem;
    font-weight: 700;
    margin-right: 10px;
}
.footer2-container {
	background:#010573;
	color: white !important;
	width:100%;
	background-position:center top;
	background-size:100% auto;
	padding:20px 0;
	margin:0;
	border-bottom: 10px solid #fef200 ;
}
	</style>
</head>
<body class="hold-transition login-page">
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
    <!-- preloader area end -->
    <div id="banner">
    	<div class="row">
    		@yield('content')
    	</div>
    </div>
    <footer class="page-section-no-padding  footer2-container">
        <div class="container">
            <div class="row">
                <!-- Copyright -->
                <div class="text-center col-md-4">
                    <p>Quienes somos <br> Productos</p>
                </div>

                <!-- Social Links -->
                <div class="text-center col-md-4">
                    <p>Atención al cliente <br> Casa matriz</p>
                </div>
                <div class="text-center col-md-4">
                	<p>Termino y condiciones <br> Horarios de atención</p>
                </div>
            </div>
        </div>
    </footer>
    @include('layouts.scripts')
</body>
@yield('scripts')
@jquery
@toastr_js
@toastr_render
</html>
