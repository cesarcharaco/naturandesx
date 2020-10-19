@extends('layouts.app_login')

@section('content')
  <div class="login-box card-black" style="width: 70%;">
    <div class="card-body">
      <h2 align="center" class="mb-4">REGISTRO DE CLIENTES EXITOSO</h2>
      <p style="font-size: 26px; text-align: center;">Su registro ha sido completado, en estos momentos se esta verificando la información suministrada <br>
      para su validación y activación de cuenta.Para ellos nuestros operadores se comunicarán con usted en la breveda posible.</p>
    </div>
    <div class="form-footer text-center mt-5">
      <p class="text-white">Continuar... <a href="{{ route('login') }}">Iniciar sesión</a></p>
    </div>
  </div>
@endsection
@section('scripts')

@endsection