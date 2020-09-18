@extends('layouts.app')
@section('css')
<title>Mi perfil</title>
@endsection

@section('content-header')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Mi Cuenta</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Mi cuenta</a></li>
          <li class="breadcrumb-item active">Perfil</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<div class="container-fluid">
  @if(\Auth::User()->tipo_usuario=="Cliente")
    <div class="row">
      <div class="col-lg-4 col-md-6 mt-5">
        <div class="card card-bordered">
          <div class="prc-head">
              <h4 align="center">Mi Perfil - {{$users->tipo_usuario}}</h4>
          </div>
            <img class="card-img-top img-fluid" src="{!! URL::asset('img/qr.png') !!}" alt="image">
            <div class="card-body">
                <a href="#" class="btn btn-primary">Descargar....</a>
                <a href="#" class="btn btn-primary pull-right">Enviar al email....</a>
            </div>
        </div>
      </div>
      <div class="col-lg-8 mt-5">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="datos_personales-tab" data-toggle="tab" href="#datos_personales" role="tab" aria-controls="datos_personales" aria-selected="true">Datos personales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="seguridad-tab" data-toggle="tab" href="#seguridad" role="tab" aria-controls="seguridad" aria-selected="false">Seguridad</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                  <div class="tab-pane fade show active" id="datos_personales" role="tabpanel" aria-labelledby="datos_personales-tab">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="header-title">Datos personales</h4>
                        <form>
                          <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombres" placeholder="Ingrese nombres..." value="{{$users->clientes->nombres}}" required="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" placeholder="Apellidos..." value="{{$users->clientes->apellidos}}" required="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="rut">RUT</label>
                            <input type="text" class="form-control" id="rut" aria-describedby="rut" placeholder="Ingrese RUT..." disabled="" value="{{$users->clientes->rut}}">
                            <small id="rut" class="form-text text-muted">Solo lo puede actualizar el administrador.</small>
                          </div>
                            <div class="form-group">
                              <label for="email">Email address</label>
                              <input type="email" class="form-control" id="email" aria-describedby="email" placeholder="Ingrese un email..." value="{{$users->email}}">
                              <small id="email" class="form-text text-muted">Ingrese un email valido.</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Actualizar perfil</button>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="seguridad" role="tabpanel" aria-labelledby="seguridad-tab">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="header-title">Datos de seguridad</h4>
                        <form>
                          <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="cambiar_password" id="cambiar_password">
                                <label class="form-check-label" for="cambiar_password">
                                    Seleccione si desea cambiar su contraseña
                                </label>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" placeholder="Contraseña..." required="" disabled="disabled">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirmar_password">Repita contraseña</label>
                                <input type="password" class="form-control" id="confirmar_password" placeholder="Repita contraseña..." required="" disabled="disabled">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="cambiar_preguntas" id="cambiar_preguntas">
                                <label class="form-check-label" for="cambiar_preguntas">
                                    Seleccione si desea cambiar sus preguntas de seguridad
                                </label>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="pregunta1">1era Pregunta de seguridad</label>
                                <select class="form-control" name="pregunta1" required id="pregunta1" disabled="">
                                  <option value="0">Seleccione una pregunta</option>
                                  @foreach($preguntas as $key)
                                    <option value="{{$key->id}}">{{$key->pregunta}}</option>
                                  @endforeach()
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="respuesta1">Respuesta</label>
                                <input type="password" class="form-control" name="respuesta1" id="respuesta1" placeholder="Ingrese respuesta..." required="" disabled="disabled">
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="pregunta2">2da Pregunta de seguridad</label>
                                <select class="form-control" name="pregunta2" required id="pregunta2" disabled="">
                                  
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="respuesta2">Respuesta</label>
                                <input type="password" class="form-control" name="respuesta2" id="respuesta2" placeholder="Ingrese respuesta..." required="" disabled="disabled">
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Actualizar perfil</button>
                        </form>
                      </div>
                    </div> 
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$('#cambiar_password').on('change',function () {
    if ($('#cambiar_password').prop('checked')) {
      $('#password').attr('disabled',false);
      $("#password").prop('required', true);
      $('#confirmar_password').attr('disabled',false);
      $("#confirmar_password").prop('required', true);
    }else{
      $('#password').attr('disabled',true);
      $("#password").removeAttr('required');
      $('#confirmar_password').attr('disabled',true);
      $("#confirmar_password").removeAttr('required');
      password.value="";
      confirmar_password.value="";
    }
  });

$('#cambiar_preguntas').on('change',function () {
    if ($('#cambiar_preguntas').prop('checked')) {
      $('#pregunta1').attr('disabled',false);
      $("#pregunta1").prop('required', true);
      $('#pregunta2').attr('disabled',false);
      $("#pregunta2").prop('required', true);
      $('#respuesta1').attr('disabled',false);
      $("#respuesta1").prop('required', true);
      $('#respuesta2').attr('disabled',false);
      $("#respuesta2").prop('required', true);
    }else{
      $('#pregunta1').attr('disabled',true);
      $("#pregunta1").removeAttr('required');
      $('#pregunta2').attr('disabled',true);
      $("#pregunta2").removeAttr('required');

      $('#respuesta1').attr('disabled',true);
      $("#respuesta1").removeAttr('required');
      $('#respuesta2').attr('disabled',true);
      $("#respuesta2").removeAttr('required');
      pregunta1.value="";
      pregunta1.value="";
      pregunta2.value="";
      pregunta2.value="";
      respuesta1.value="";
      respuesta1.value="";
      respuesta2.value="";
      respuesta2.value="";
    }
  });
</script>
<script type="text/javascript">
  $('#pregunta1').on('change',function(event){
    var id_pregunta=event.target.value;
    console.log('hola');
    $.get('buscar_preguntas_p/'+id_pregunta+'/seguridad_p',function(data){
      console.log('hola_buscar');
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