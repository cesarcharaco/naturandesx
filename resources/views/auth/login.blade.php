@extends('layouts.app_login')

@section('content')
    <div class="login-box card-black">
      <div class="card-body">
      <h2 align="center" class="mb-4">INICIAR SESIÓN</h2>
      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="mt-4">
          
          <input id="login" type="text" class="border border-warning form-control mb-4 input @if ($errors->has('usuario') || $errors->has('email')) is-invalid @endif" name="login" value="{{ old('usuario') ?: old('email') }}" required placeholder="Email o Usuario" autocomplete="login" autofocus="">
          @if ($errors->has('usuario') || $errors->has('email'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('usuario') ?: $errors->first('email') }}</strong>
            </span>
          @endif
          <input id="password" type="password" class="border border-warning form-control mb-4 input @error('password') is-invalid @enderror" name="password" required placeholder="Contraseña">
          <div class="row">
            <div class="col-6">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  <span style="color: orange;">Recuérdame</span>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-6">
              <button type="submit" class="btn btn-block text-white" style="background-color: #ffa600;border-radius: 10px;"><strong>Iniciar sesión</strong></button>
            </div>
            <!-- /.col -->
          </div>
        </div>
      </form>

      @if (Route::has('password.request'))
        <p class="mt-3">
          <a style="float: left !important;" href="{{ route('recuperacion') }}">
              {{ __('Forgot Your Password?') }}
          </a>
        </p>
      @endif
      <p class="mt-2">
        <a href="{{ route('registerc') }}" class="text-center" style="float: left !important;">Registro de nuevo clientes</a>
      </p>
        
      </div>
    </div>
    <!-- <div class="col-md-6"></div> -->
<!-- /.login-box -->
@endsection
