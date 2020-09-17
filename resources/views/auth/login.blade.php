@extends('layouts.app_login')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Natur</b>Andes</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inciar sesión</p>

      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input id="login" type="text" class="form-control @if ($errors->has('usuario') || $errors->has('email')) is-invalid @endif" name="login" value="{{ old('usuario') ?: old('email') }}" required placeholder="Ingrese email o usuario..." autocomplete="login" autofocus="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @if ($errors->has('usuario') || $errors->has('email'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('usuario') ?: $errors->first('email') }}</strong>
            </span>
          @endif
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="*******************">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión </button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
      @if (Route::has('password.request'))
      <p class="mb-1">
        <a href="#">¿Olvidó su contraseña?</a>
      </p>
      @endif
      <p class="mb-0">
        <a href="{{ route('registerc') }}" class="text-center">Registro de nuevo clientes</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
@endsection
