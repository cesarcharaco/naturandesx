@extends('layouts.app_login')

@section('content')
<div class="login-box card-black">
    <div class="card-body">
        {{--<h2 align="center" class="">{{ __('Reset Password') }}</h2>--}}
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('seleccion') }}">
            @csrf
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-12 col-form-label">Elija una opción para recuperar su contraseña</label>
                        <select class="form-control select2" name="opcion" onchange="vistas(this.value)">
                            <option disabled selected>Seleccione</option>
                            <option value="1">Enviar código de recuperación</option>
                            <option value="2">Pregunta de seguridad</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="vistaRut" style="display: none;">
                <center>
                    <label for="rut">RUT</label>
                </center>
                <div class="form-group row">
                    <div class="col-md-12">
                        <input type="text" name="rut" placeholder="Rut del residente" minlength="7" maxlength="8" id="rut" class="form-control input" required style="width: 80% !important; float: left;">
                        <input type="number" name="verificador" min="0" id="verificador" minlength="1" maxlength="1" max="9" value="0" class="form-control input" style="width: 20% !important; float: right;">
                    </div>
                </div>
                <center>
                    <button type="submit" class="btn btn-success">Aceptar</button>
                </center>
            </div>
            <div id="vistaEmail" style="display: none;">
                <div class="form-group">
                    <label for="email" class="col-md-12 col-form-label">Correo</label>
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Ingrese correo de recuperación">
                </div>
                <center>
                    <button type="submit" class="btn btn-success">Aceptar</button>
                </center>
            </div>

            <center>
                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        {{--<button type="submit" class="btn btn-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>--}}
                    </div>
                </div>
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

<script type="text/javascript">
    function vistas(opcion) {
        if(opcion == 1){
            $('#vistaRut').fadeOut('slow',
                function() { 
                    $(this).hide();
                    $('#vistaEmail').fadeIn(300);
                }
            );
            $('#rut').removeAttr('required');
            $('#verificador').removeAttr('required');
            $('#email').attr('required',true);
        }else{
            $('#vistaEmail').fadeOut('slow',
                function() { 
                    $(this).hide();
                    $('#vistaRut').fadeIn(300);
                }
            );
            $('#email').removeAttr('required');
            $('#rut').attr('required',true);
            $('#verificador').attr('required',true);
        }
    }
</script>
