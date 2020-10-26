@extends('layouts.app_login')
@section('css')
<title>Nueva Contraseña</title>
<link rel="stylesheet" href="{{ asset('plugins/parsleyjs/parsley.css') }}">
@endsection
@section('content')
<div class="col-md-4 mx-auto">
    <div class="login-area">
      <div class="container">
        <div class="login-box ptb--100">
          <form method="POST" action="{{ route('nueva_clave') }}" data-parsley-validate>
            @csrf
            <div class="login-form-head">
                <h4>Recuperación de contraseña | Ingrese su nueva contraseña</h4>
            </div>
            <input type="hidden" name="id_usuario" value="{{$id_usuario}}">
            <div class="login-form-body">
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
                <div class="submit-btn-area">
                    <button id="form_submit" type="submit" class="btn btn-success btn-block" style="background: #010573; color: white;">Aceptar <i class="ti-arrow-right"></i></button>
                </div>
                <div class="form-footer text-center mt-5">
                    <p class="text-muted">Volver <a href="{{ url('/') }}" class="text-center" style="color: #010573;">Iniciar sesión</a></p>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('plugins/parsleyjs/i18n/es.js') }}"></script>
@endsection