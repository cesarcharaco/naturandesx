@extends('layouts.app_login')

@section('content')
<div class="col-md-12 mx-auto">
  <div class="login-area login-bg">
    <div class="container">
      <div class="login-box-register ptb--100">
        <form method="POST" action="{{ route('seleccion') }}">
          @csrf
          <div class="login-form-head">
              <h4>REGISTRO CLIENTE EXITOSO</h4>
          </div>
          <div class="login-form-body">
            <p style="font-size: 26px; text-align: center;">Su registro ha sido completado, en estos momentos se esta verificando la información suministrada <br>
              para su validación y activación de cuenta.Para ellos nuestros operadores se comunicarán con usted en la breveda posible.
            </p>
              <div class="form-footer text-center mt-5">
                  <p class="text-muted">Continuar <a href="{{ url('/') }}" class="text-center" style="color: #010573;">Iniciar sesión</a></p>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')

@endsection