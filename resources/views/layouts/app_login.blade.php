<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.css')
    @toastr_css
    <style type="text/css">
	  body{
	    background-image: url("{{ asset('img/banner-covid-19.jpg') }}") !important;
	    background-position: center center !important;
	    background-repeat: no-repeat !important;
	    background-size: 100% !important;
	    background-attachment: fixed !important;
	    background-color: 
	  }
	  h2{
	    color: white !important;
	  }
	  .card-black{
	    /*background-color: black !important;*/
	    border-radius: 0px !important;
	    padding: 20px;
	    background: rgba(0, 0, 0, 0.6) !important;
	    color: black;
	    font: 18px Arial, sans-serif;
	  }
	  .input,p, a{
	    color:orange !important;
	    border-radius: 10px !important;
	    text-align: center;
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
	</style>
</head>
<body class="hold-transition login-page">
    <!-- preloader area end -->
    @yield('content')
    @include('layouts.scripts')
</body>
@jquery
@toastr_js
@toastr_render
</html>
