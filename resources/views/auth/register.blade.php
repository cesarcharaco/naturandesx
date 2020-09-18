@extends('layouts.app_login')

@section('content')
  <div class="login-box card-black" style="">
    <div class="card-body">
      <h2 align="center" class="mb-4">INICIAR SESIÓN</h2>
      <form action="{{ route('registerCliente') }}" method="POST">
          @csrf
          <div class="mt-4">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="nombres">Nombres <b style="color: red;">*</b></label>
                    <input type="text" class="form-control input" placeholder="Ingrese nombres" id="nombres" required="required" name="nombres" value="{{ old('nombres') }}">
                    @if ($errors->has('nombres'))
                        <small class="form-text text-danger">
                            {{ $errors->first('usuario') }}
                        </small>
                    @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="apellidos">Apellidos <b style="color: red;">*</b></label>
                    <input type="text" class="form-control input" placeholder="Ingrese apellidos" id="apellidos" required="required" name="apellidos" value="{{ old('apellidos') }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="usuario">Usuario <b style="color: red;">*</b></label>
                    <input type="text" class="form-control input" placeholder="Ingrese usuario" name="usuario" required id="usuario" value="{{ old('usuario') }}" maxlength="15">
                    @if ($errors->has('usuario'))
                        <small class="form-text text-danger">
                            {{ $errors->first('usuario') }}
                        </small>
                    @endif
                </div>
              </div>
              <div class="col-md-6">
                <label for="email">Email <b style="color: red;">*</b></label>
                <input type="email" class="form-control input" placeholder="Ingrese email" name="email" id="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <small class="form-text text-danger">
                        {{ $errors->first('email') }}
                    </small>
                @endif
                </div>
            </div>
            <div class="form-group">
              <label for="telefono">Teléfono <b style="color: red;">*</b></label>
              <input type="text" class="form-control input" placeholder="Ingrese teléfono" name="telefono" required id="telefono" maxlength="11" required value="{{ old('telefono') }}">
              @if ($errors->has('usuario'))
                  <small class="form-text text-danger">
                      {{ $errors->first('usuario') }}
                  </small>
              @endif
            </div>
            <div class="form-group">                          
                <label for="rut">RUT <b style="color: red;">*</b></label>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="rut" placeholder="Rut del residente" minlength="7" maxlength="8" id="rut" class="form-control input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="number" name="verificador" min="1" id="verificador" minlength="1" maxlength="1" max="9" value="0" class="form-control input" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" class="form-control input @error('password') is-invalid @enderror" name="password" required placeholder="*******************" autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>
                <input id="password-confirm" type="password" class="form-control input" name="password_confirmation" required autocomplete="new-password" placeholder="*******************" autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="pregunta">1era Pregunta de seguridad<b style="color: red;">*</b></label>
                <select class="form-control input" name="pregunta1" required id="pregunta1">
                  <option value="0">Seleccione una pregunta</option>
                  
                  @foreach($preguntas as $key)
                    <option value="{{$key->id}}">{{$key->pregunta}}</option>
                  @endforeach()
                </select>
              </div>
          <div class="form-group">
            <label for="respuesta">Respuesta<b style="color: red;">*</b></label>
            <input type="password" name="respuesta1" class="form-control input" required id="Inputrespuesta">
          </div>
          <div id="segunda_pregunta" style="display: none;" >
            <div class="form-group">
              <label for="pregunta">2da Pregunta de seguridad<b style="color: red;">*</b></label>
              <select class="form-control input" name="pregunta2" id="pregunta2" required>
                
              </select>
            </div>
            <div class="form-group">
              <label for="respuesta">Respuesta<b style="color: red;">*</b></label>
              <input type="password" name="respuesta2" class="form-control input" required id="Inputrespuesta">
            </div>
          </div>
          
            <div class="submit-btn-area">
                <button id="form_submit" type="submit" class="btn btn-block text-white" style="background-color: #ffa600;border-radius: 10px;"><strong>Registrarse </strong></button>
            </div>
            <div class="form-footer text-center mt-5">
                <p class="text-white">¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a></p>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
@section('scripts')
<script type="text/javascript">
  $('#pregunta1').on('change',function(event){
    var id_pregunta=event.target.value;
    $('#segunda_pregunta').css('display','block');
    $.get('buscar_preguntas/'+id_pregunta+'/seguridad',function(data){

      if (data.length>0) {
        $('#pregunta2').empty();

        for (var i = 0; i < data.length; i++) {
        $('#pregunta2').append('<option value='+data[i].id+'>'+data[i].pregunta+'</option>');  
        }
      }
    });

  });
</script>
@endsection