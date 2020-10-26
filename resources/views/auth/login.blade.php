@extends('layouts.app_login')

@section('content')
<div class="login-area login-bg mx-auto">
  <div class="container">
    <div class="login-box">
      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="login-form-head">
            <h4>Inicio de Sesión</h4>
        </div>
        <div class="login-form-body">
          <div class="form-group">
              <input id="login" type="text" class="border border-warning form-control mb-4 input @if ($errors->has('usuario') || $errors->has('email')) is-invalid @endif" name="login" value="{{ old('usuario') ?: old('email') }}" required placeholder="Email o Usuario" autocomplete="login" autofocus="">
              @if ($errors->has('usuario') || $errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('usuario') ?: $errors->first('email') }}</strong>
              </span>
              @endif
          </div>
          <div class="form-group">
              <input id="password" type="password" class="border border-warning form-control mb-4 input @error('password') is-invalid @enderror" name="password" required placeholder="Contraseña">
          </div>
          <div class="row mb-4 rmber-area">
            <div class="col-md-6">
              <div class="custom-control custom-checkbox mr-sm-2">
                  <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                  <label class="custom-control-label" for="customControlAutosizing" style="color: #010573;">Recuerdame</label>
              </div>
            </div>
            <div class="col-md-6 text-right">
              @if (Route::has('password.request'))
                <a style="float: left !important; color: #010573;" href="{{ route('recuperacion') }}">
                  {{ __('Forgot Your Password?') }}
                </a>
              @endif
            </div>
          </div>
          <div class="submit-btn-area">
              <button id="form_submit" type="submit" class="btn btn-success btn-block" style="background: #010573 !important ; color: white !important;">Iniciar Sesión <i class="ti-arrow-right"></i></button>
          </div>
          <div class="form-footer text-center mt-5">
              <p class="text-muted"><a href="{{ route('registerc') }}" class="text-center" style="color: #010573;">Registro de nuevo clientes</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
