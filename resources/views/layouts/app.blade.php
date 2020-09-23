<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    
    @include('layouts.css')
    @include('layouts.css2')
    @yield('css')
    @toastr_css
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.header')
        @include('layouts.sidebar')
        <div class="content-wrapper">
            @yield('content-header')
            <section class="content">
                @yield('content')
            </section>
        </div>
        @include('layouts.footer')
    </div>
    @include('layouts.scripts')
</body>
@jquery
@toastr_js
@toastr_render
</html>
