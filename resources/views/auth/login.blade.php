@extends('layouts.app_login')
<style type="text/css">
  body{
    background-image: url("{{ asset('img/banner-covid-19.jpg') }}") !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    background-size: cover !important;
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
  .input{
    color:orange !important;
    border-radius: 10px !important;
    text-align: center;
  }
</style>
@section('content')

      <div class="login-box card-black">
        <div class="card-body">
        <h2 align="center" class="mb-4">INICIAR SESIÓN</h2>
        <form action="{{ route('login') }}" method="post">
          @csrf
          <div class="mt-4">
            
            <input id="login" type="text" class="border border-warning form-control mb-4 input @if ($errors->has('usuario') || $errors->has('email')) is-invalid @endif" name="login" value="Usuario" required placeholder="Ingrese email o usuario..." autocomplete="login" autofocus="">
            @if ($errors->has('usuario') || $errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('usuario') ?: $errors->first('email') }}</strong>
              </span>
            @endif
            <input id="password" value="Contraseña" type="password" class="border border-warning form-control mb-4 input @error('password') is-invalid @enderror" name="password" required placeholder="*******************">
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
          
        </div>
      </div>
    <!-- <div class="col-md-6"></div> -->
<!-- /.login-box -->
@endsection
