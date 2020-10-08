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
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="rut" class="col-md-12 col-form-label">RUT</label>
                            <input id="rut" type="text" class="form-control @error('rut') is-invalid @enderror" name="rut" value="{{ old('rut') }}" maxlength="12" autocomplete="rut" autofocus placeholder="Ingrese RUT">
                            <p>Ejm: 1234567-<strong>8</strong></p>
                        </div>
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
        }
    }
</script>
