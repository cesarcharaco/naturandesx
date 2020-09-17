<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.css')
    @toastr_css
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
