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
	    background-size: 100% !important;
	    background-attachment: fixed !important;
	    background-color: ;
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
	            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
	            <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
	            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
	            <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
	          </ul>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
    <!-- preloader area end -->
    <div id="banner">    	
    	@yield('content')
    </div>
    @include('layouts.scripts')
</body>
@yield('scripts')
@jquery
@toastr_js
@toastr_render
</html>
