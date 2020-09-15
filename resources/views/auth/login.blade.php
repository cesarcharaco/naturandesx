@extends('layouts.app_login')

@section('content')
<div class="login-area login-bg">
  <div class="container">
      <div class="login-box ptb--100">
          <form action="{{ route('login') }}" method="POST">
              @csrf
              <div class="login-form-head">
                  <h4>Inicio de sesión</h4>
              </div>
              <div class="login-form-body">
                <div class="form-group">
                    <label for="login">Email o usuario</label>
                    <input id="login" type="text" class="form-control @if ($errors->has('usuario') || $errors->has('email')) is-invalid @endif" name="login" value="{{ old('usuario') ?: old('email') }}" required placeholder="Ingrese email o usuario..." autocomplete="login" autofocus="">
                    @if ($errors->has('usuario') || $errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('usuario') ?: $errors->first('email') }}</strong>
                      </span>
                    @endif
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <small id="emailHelp" class="form-text text-muted">Ingrese un correo valido.</small>
                </div>
                    
                    <label for="password">Contraseña</label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="*******************">
                      
                      @error('password')
                      </div>
                      <div class="container  mt-1" style="border-radius: 30px; color: green; font-family: serif; font-size: 12px;">
                      
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  <small id="emailHelp" class="form-text text-muted">En caso de no poder recuperar su contraseña contacte con el admin.</small>
                <div class="row mb-4 rmber-area">
                    <div class="col-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                            <label class="custom-control-label" for="customControlAutosizing">Recuerdame</label>
                        </div>
                    </div>
                    @if (Route::has('password.request'))
                    <div class="col-6 text-right">
                        <a href="#">¿Olvidó su contraseña?</a>
                    </div>
                    @endif
                </div>
                <div class="submit-btn-area">
                    <button id="form_submit" type="submit">Iniciar sesión <i class="ti-arrow-right"></i></button>
                </div>
                <div class="form-footer text-center mt-5">
                    <p class="text-muted">¿No tienes cuenta? <a href="{{ route('register') }}">Registrarse</a></p>
                </div>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection
