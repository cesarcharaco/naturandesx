@extends('layouts.app_login')
@section('css')
<title>Nueva Contraseña</title>
<link rel="stylesheet" href="{{ asset('plugins/parsleyjs/parsley.css') }}">
@endsection
@section('content')
<div class="login-box card-black">
    <div class="card-body">
        {{--<h2 align="center" class="">{{ __('Reset Password') }}</h2>--}}
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('nueva_clave') }}" data-parsley-validate>
        	<input type="hidden" name="id_usuario" value="{{$id_usuario}}">
            @csrf
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="password" class="col-md-12 col-form-label">Ingrese su nueva contraseña</label>
                        <input id="password" type="password" class="form-control" name="password" autocomplete="off" autofocus placeholder="Ingrese Contraseña" data-parsley-minlength="8">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="confirmar_password" class="col-md-12 col-form-label">Repita su nueva contraseña</label>
                <input type="password" class="form-control" name="confirmar_password" id="confirmar_password" placeholder="Repita contraseña..." data-parsley-equalto="#password" data-parsley-minlength="8">
            </div>
            <center>
                <button type="submit" class="btn btn-success">Aceptar</button>
            </center>
        </form>
        <div class="form-footer text-center mt-5">
            <p class="text-white">Volver
                <a href="{{ route('login') }}">Iniciar sesión</a>
            </p>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('plugins/parsleyjs/i18n/es.js') }}"></script>
@endsection