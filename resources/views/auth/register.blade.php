@extends('layouts.app_login')

@section('content')
<div class="login-area login-bg">
  <div class="container">
      <div class="login-box ptb--100">
          <form action="{{ route('registerCliente') }}" method="POST">
              @csrf
              <div class="login-form-head">
                  <h4>Registro de cliente</h4>
              </div>
              <div class="login-form-body">
                <div class="form-group">
                    <label for="nombres">Nombres <b style="color: red;">*</b></label>
                    <input type="text" class="form-control" placeholder="Ingrese nombres" id="nombres" required="required" name="nombres" value="{{ old('nombres') }}">
                    @if ($errors->has('nombres'))
                        <small class="form-text text-danger">
                            {{ $errors->first('usuario') }}
                        </small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos <b style="color: red;">*</b></label>
                    <input type="text" class="form-control" placeholder="Ingrese apellidos" id="apellidos" required="required" name="apellidos" value="{{ old('apellidos') }}">
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario <b style="color: red;">*</b></label>
                    <input type="text" class="form-control" placeholder="Ingrese usuario" name="usuario" required id="usuario" value="{{ old('usuario') }}" maxlength="15">
                    @if ($errors->has('usuario'))
                        <small class="form-text text-danger">
                            {{ $errors->first('usuario') }}
                        </small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" placeholder="Ingrese email" name="email" id="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <small class="form-text text-danger">
                            {{ $errors->first('email') }}
                        </small>
                    @endif
                </div>
                <div class="form-group">                          
                    <label for="rut">RUT <b style="color: red;">*</b></label>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" name="rut" placeholder="Rut del residente" minlength="7" maxlength="8" id="rut" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="number" name="verificador" min="1" id="verificador" minlength="1" maxlength="1" max="9" value="0" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="*******************" autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="*******************" autocomplete="new-password">
                </div>
                <div class="form-group">
                    <label for="pregunta">1era Pregunta de seguridad<b style="color: red;">*</b></label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <div class="ti-lock"></div>
                        </div>
                      </div>
                      <select class="form-control" name="pregunta1" required id="pregunta1">
                        <option value="0">Seleccione una pregunta</option>
                        
                        @foreach($preguntas as $key)
                          <option value="{{$key->id}}">{{$key->pregunta}}</option>
                        @endforeach()
                      </select>
                    </div>
                  </div>
              <div class="form-group">
                <label for="respuesta">Respuesta<b style="color: red;">*</b></label>
                <div class="input-group mb-2 mr-sm-2">
                  <input type="password" name="respuesta1" class="form-control" required id="Inputrespuesta">
                  <div class="input-group-prepend" onclick="VerR(1)">
                    <div class="input-group-text" style="color: green;">
                      <div class="ti-eye"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="segunda_pregunta" style="display: none;" >
                <div class="form-group">
                    <label for="pregunta">2da Pregunta de seguridad<b style="color: red;">*</b></label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <div class="ti-lock"></div>
                        </div>
                      </div>
                      <select class="form-control" name="pregunta2" id="pregunta2" required>
                        
                      </select>
                    </div>
                  </div>
              <div class="form-group">
                <label for="respuesta">Respuesta<b style="color: red;">*</b></label>
                <div class="input-group mb-2 mr-sm-2">
                  <input type="password" name="respuesta2" class="form-control" required id="Inputrespuesta">
                  <div class="input-group-prepend" onclick="VerR(1)">
                    <div class="input-group-text" style="color: green;">
                      <div class="ti-eye"></div>
                    </div>
                  </div>
                </div>
              </div>
              
              </div>
              
                <div class="submit-btn-area">
                    <button id="form_submit" type="submit">Registrarse <i class="ti-arrow-right"></i></button>
                </div>
                <div class="form-footer text-center mt-5">
                    <p class="text-muted">¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a></p>
                </div>
              </div>
          </form>
      </div>
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