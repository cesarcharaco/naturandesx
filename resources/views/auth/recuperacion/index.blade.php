@extends('layouts.app_login')

@section('content')
<div class="col-md-4 mx-auto">
    <div class="login-area">
      <div class="container">
        <div class="login-box-register">
          <form method="POST" action="{{ route('seleccion') }}">
            @csrf
            <div class="login-form-head">
                <h4>Recuperación de contraseña</h4>
            </div>
            <div class="login-form-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-12 col-form-label">Elija una opción para recuperar su contraseña</label>
                            <select class="form-control" name="opcion" onchange="vistas(this.value)">
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
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit" class="btn btn-success btn-block" style="background: #010573; color: white;">Aceptar <i class="ti-arrow-right"></i></button>
                    </div>
                </div>
                <div id="vistaEmail" style="display: none;">
                    <div class="form-group">
                        <label for="email" class="col-md-12 col-form-label">Correo</label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Ingrese correo de recuperación">
                    </div>
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit" class="btn btn-success btn-block" style="background: #010573; color: white;">Aceptar <i class="ti-arrow-right"></i></button>
                    </div>
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
