@extends('layouts.app')
@section('css')

<style type="text/css">
  .btn{
    color:white !important;
  }
  .breadcrumb-item{
    color: black;
  }
</style>
<title>Mi perfil</title>
<link rel="stylesheet" href="{{ asset('plugins/parsleyjs/parsley.css') }}">
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
          <li class="breadcrumb-item" style="color:black;"><a href="#" style="color:black;">Mi cuenta</a></li>
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
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/naturandes.jpg') }}" alt="User profile picture" style="width: 70%;">
            </div>
            <h3 class="profile-username text-center" style="text-transform: uppercase;">{{$users->clientes->nombres}} {{$users->clientes->apellidos}}</h3>
            <p class="text-muted text-center">{{$users->tipo_usuario}}</p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <?php $favicon = $users->clientes->qr->codigo; ?>
                <img class="card-img-top img-fluid" src="{{ asset($favicon) }}" alt="image-QR">
              </li>
            </ul>
            <div class="text-center">
              <a href="#" class="btn btn-primary"><b>Descargar QR en PDF</b></a>
              <a href="#" class="btn btn-primary"><b>Enviar al email QR</b></a>              
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card card-primary card-outline">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item" style="color: black !important;"><a class="nav-link active" href="#activity" data-toggle="tab" style="color: black !important;">Datos personales</a></li>
              <li class="nav-item" style="color: black !important;"><a class="nav-link" href="#timeline" data-toggle="tab" style="color: black !important;">Seguridad</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <p class="text-center mb-3">Todos los campos (<b style="color: red;">*</b>) son requeridos.</p>
              <div class="active tab-pane" id="activity">
                <form action="{{ route('editar_perfil') }}" name="editar_perfil" method="POST" data-parsley-validate>
                  @csrf
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="usuario">Usuario <b style="color: red;">*</b></label>
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese usuario..." value="{{$users->usuario}}" required="">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="nombres">Nombres <b style="color: red;">*</b></label>
                        <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ingrese nombres..." value="{{$users->clientes->nombres}}" required="">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="apellidos">Apellidos <b style="color: red;">*</b></label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos..." value="{{$users->clientes->apellidos}}" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="rut">RUT <b style="color: red;">*</b></label>
                    <input type="text" class="form-control" name="rut" id="rut" aria-describedby="rut" placeholder="Ingrese RUT..." disabled="" value="{{$users->clientes->rut}}">
                    <small id="rut" class="form-text text-muted">Solo lo puede actualizar el administrador.</small>
                  </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Ingrese un email..." value="{{$users->email}}">
                      <small id="email" class="form-text text-muted">Ingrese un email valido.</small>
                    </div>
                    <input type="hidden" value="1" id="datos_per" name="datos_per">
                    <input type="hidden" value="{{$users->clientes->id}}" id="id_cliente" name="id_cliente">
                    <input type="hidden" value="{{$users->id}}" id="id_usuario" name="id_usuario">
                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Actualizar perfil</button>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <form action="{{ route('editar_perfil') }}" name="editar_perfil" method="POST" data-parsley-validate>
                  @csrf
                  <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input checkbox" type="checkbox" value="1" id="cambiar_password" name="cambiar_password">
                        <label class="form-check-label" for="cambiar_password">
                            Seleccione si desea cambiar su contraseña
                        </label>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña..." disabled="disabled">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirmar_password">Repita contraseña</label>
                        <input type="password" class="form-control" name="confirmar_password" id="confirmar_password" placeholder="Repita contraseña..." disabled="disabled">
                    </div>
                  </div>
                  <hr>

                  <div class="form-group">                    
                    <label for="preguntas_seguridad">Preguntas y respuestas de seguridada</label>
                    <div class="form-row">
                    @if(count($users->preguntas)>0)
                    @php $i=1; @endphp
                      @foreach($users->preguntas as $key)
                      <div class="col-md-3">
                        <label for="pregunta1">Pregunta {{ $i }}:</label>
                       {{ $key->pregunta }}
                      </div>
                      <div class="col-md-3">
                        <label for="respuesta1">Respuesta: </label>
                       {{ $key->pivot->respuesta }}
                      </div>
                      @php $i++; @endphp
                      @endforeach
                      @else
                      <div class="col-md-12">
                        <label for="respuesta2">No tiene preguntas de seguridad registradas</label>
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input checkbox" type="checkbox" value="1" id="cambiar_preguntas" name="cambiar_preguntas">
                        <label class="form-check-label" for="cambiar_preguntas">
                            Seleccione si desea cambiar sus preguntas de seguridad
                        </label>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="pregunta1">1era Pregunta de seguridad <b style="color: red;">*</b></label>
                        <select class="form-control" name="pregunta1" required id="pregunta1" disabled="">
                          <option value="0">Seleccione una pregunta</option>
                          @foreach($preguntas as $key)
                            <option value="{{$key->id}}">{{$key->pregunta}}</option>
                          @endforeach()
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="respuesta1">Respuesta <b style="color: red;">*</b></label>
                        <input type="password" class="form-control" name="respuesta1" id="respuesta1" placeholder="Ingrese respuesta..." required="" disabled="disabled">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="pregunta2">2da Pregunta de seguridad <b style="color: red;">*</b></label>
                        <select class="form-control" name="pregunta2" required id="pregunta2" disabled="">
                          
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="respuesta2">Respuesta <b style="color: red;">*</b></label>
                        <input type="password" class="form-control" name="respuesta2" id="respuesta2" placeholder="Ingrese respuesta..." required="" disabled="disabled">
                    </div>
                  </div>
                  <input type="hidden" value="1" id="datos_seg" name="datos_seg">
                  <input type="hidden" value="{{$users->id}}" id="id_usuario" name="id_usuario">
                  <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" id="boton_enviar" disabled="disabled">Actualizar perfil</button>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Información de Naturandes</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-3">
                <div class="callout callout-info">
                  <h5><i class="fas fa-book mr-1"></i> Contacto</h5>
                  <p>promociones@naturandeschile.com</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="callout callout-info">
                  <h5><i class="fas fa-map-marker-alt mr-1"></i> Dirección</h5>
                  <p>Ignacio Carrera Pinto 651, Copiapó, III Región. </p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="callout callout-info">
                  <h5><i class="fas fa-phone-alt mr-1"></i> Número telefónico</h5>
                  <p>+52 222 1297. </p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="callout callout-info">
                  <h5><i class="far fa-clock mr-1"></i> Horario</h5>
                  <p>Lu-VI: 8:30-18:00 | Sa: 8:30-14:00 | Do: cerrado. </p>
                </div>
              </div>              
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  @endif
  @if(\Auth::User()->tipo_usuario=="Empleado")
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/naturandes.jpg') }}" alt="User profile picture" style="width: 70%;">
            </div>
            <h3 class="profile-username text-center" style="text-transform: uppercase;">{{$users->empleado->nombres}} {{$users->empleado->apellidos}}</h3>
            <p class="text-muted text-center">{{$users->tipo_usuario}}</p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <?php $favicon = $users->empleado->qr->codigo; ?>
                <img class="card-img-top img-fluid" src="{{ asset($favicon) }}" alt="image-QR">
              </li>
            </ul>
            <div class="text-center">
              <a href="#" class="btn btn-primary"><b>Descargar QR en PDF</b></a>
              <a href="#" class="btn btn-primary"><b>Enviar al email QR</b></a>              
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card card-primary card-outline">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Datos personales</a></li>
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Seguridad</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <p class="text-center mb-3">Todos los campos (<b style="color: red;">*</b>) son requeridos.</p>
              <div class="active tab-pane" id="activity">
                <form action="{{ route('editar_perfil') }}" name="editar_perfil" id="demo-form" method="POST" data-parsley-validate>
                  @csrf
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="usuario">Usuario <b style="color: red;">*</b></label>
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese usuario..." value="{{$users->usuario}}" required="">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="nombres">Nombres <b style="color: red;">*</b></label>
                        <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ingrese nombres..." value="{{$users->empleado->nombres}}" required="">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="apellidos">Apellidos <b style="color: red;">*</b></label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos..." value="{{$users->empleado->apellidos}}" required="">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="rut">RUT <b style="color: red;">*</b></label>
                      <input type="text" class="form-control" name="rut" id="rut" aria-describedby="rut" placeholder="Ingrese RUT..." disabled="" value="{{$users->empleado->rut}}">
                      <small id="rut" class="form-text text-muted">Solo lo puede actualizar el administrador.</small>                      
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="email">Email <b style="color: red;">*</b></label>
                      <input type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Ingrese un email..." value="{{$users->email}}" required>
                      <small id="email" class="form-text text-muted">Ingrese un email valido.</small>                      
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="telefono">Teléfono <b style="color: red;">*</b></label>
                      <input type="text" class="form-control" name="telefono" id="telefono" aria-describedby="telefono" placeholder="Ingrese telefono..." value="{{$users->empleado->telefono}}" data-parsley-type="number" required>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="direccion">Dirección</label>
                      <textarea name="direccion" id="direccion" class="form-control" style="resize: none;" placeholder="Dirección">{{$users->empleado->direccion}}</textarea>
                    </div>
                  </div>
                    <input type="hidden" value="1" id="datos_per" name="datos_per">
                    <input type="hidden" value="{{$users->empleado->id}}" id="id_empleado" name="id_empleado">
                    <input type="hidden" value="{{$users->id}}" id="id_usuario" name="id_usuario">
                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Actualizar perfil</button>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <form action="{{ route('editar_perfil') }}" name="editar_perfil" method="POST" data-parsley-validate>
                  @csrf
                  <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input checkbox" type="checkbox" value="1" id="cambiar_password" name="cambiar_password">
                        <label class="form-check-label" for="cambiar_password">
                            Seleccione si desea cambiar su contraseña
                        </label>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña..." disabled="disabled" data-parsley-minlength="8">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirmar_password">Repita contraseña</label>
                        <input type="password" class="form-control" name="confirmar_password" id="confirmar_password" placeholder="Repita contraseña..." disabled="disabled" data-parsley-equalto="#password" data-parsley-minlength="8">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">                    
                    <label for="preguntas_seguridad">Preguntas y respuestas de seguridad</label>
                    <div class="form-row">
                    @if(count($users->preguntas)>0)
                    @php $i=1; @endphp
                      @foreach($users->preguntas as $key)
                      <div class="col-md-3">
                        <label for="pregunta1">Pregunta {{ $i }}:</label>
                       {{ $key->pregunta }}
                      </div>
                      <div class="col-md-3">
                        <label for="respuesta1">Respuesta: </label>
                       {{ $key->pivot->respuesta }}
                      </div>
                      @php $i++; @endphp
                      @endforeach
                      @else
                      <div class="col-md-12">
                        <label for="respuesta2">No tiene preguntas de seguridad registradas</label>
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input checkbox" type="checkbox" value="1" id="cambiar_preguntas" name="cambiar_preguntas">
                        <label class="form-check-label" for="cambiar_preguntas">
                            Seleccione si desea cambiar sus preguntas de seguridad
                        </label>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="pregunta1">1era Pregunta de seguridad <b style="color: red;">*</b></label>
                        <select class="form-control" name="pregunta1" required id="pregunta1" disabled="">
                          <option value="0">Seleccione una pregunta</option>
                          @foreach($preguntas as $key)
                            <option value="{{$key->id}}">{{$key->pregunta}}</option>
                          @endforeach()
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="respuesta1">Respuesta <b style="color: red;">*</b></label>
                        <input type="password" class="form-control" name="respuesta1" id="respuesta1" placeholder="Ingrese respuesta..." required="" disabled="disabled">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="pregunta2">2da Pregunta de seguridad <b style="color: red;">*</b></label>
                        <select class="form-control" name="pregunta2" required id="pregunta2" disabled="">
                          
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="respuesta2">Respuesta <b style="color: red;">*</b></label>
                        <input type="password" class="form-control" name="respuesta2" id="respuesta2" placeholder="Ingrese respuesta..." required="" disabled="disabled">
                    </div>
                  </div>
                  <input type="hidden" value="1" id="datos_seg" name="datos_seg">
                  <input type="hidden" value="{{$users->id}}" id="id_usuario" name="id_usuario">
                  <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" id="boton_enviar" disabled="disabled">Actualizar perfil</button>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Información de Naturandes</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-3">
                <div class="callout callout-info">
                  <h5><i class="fas fa-book mr-1"></i> Contacto</h5>
                  <p>promociones@naturandeschile.com</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="callout callout-info">
                  <h5><i class="fas fa-map-marker-alt mr-1"></i> Dirección</h5>
                  <p>Ignacio Carrera Pinto 651, Copiapó, III Región. </p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="callout callout-info">
                  <h5><i class="fas fa-phone-alt mr-1"></i> Número telefónico</h5>
                  <p>+52 222 1297. </p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="callout callout-info">
                  <h5><i class="far fa-clock mr-1"></i> Horario</h5>
                  <p>Lu-VI: 8:30-18:00 | Sa: 8:30-14:00 | Do: cerrado. </p>
                </div>
              </div>              
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  @endif
  @if(\Auth::User()->tipo_usuario=="Admin")
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/naturandes.jpg') }}" alt="User profile picture" style="width: 70%;">
            </div>
            <h3 class="profile-username text-center" style="text-transform: uppercase;">{{$users->empleado->nombres}} {{$users->empleado->apellidos}}</h3>
            <p class="text-muted text-center">{{$users->tipo_usuario}}</p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <?php $favicon = $users->empleado->qr->codigo; ?>
                @if($favicon!="")
                  <img class="card-img-top img-fluid" src="{{ asset($favicon) }}" alt="image-QR">
                @else
                  <div class="text-center">
                    <a href="{{ route('generar_qr', $users->empleado->id) }}" class="btn btn-primary"><b>Generar QR</b></a>
                  </div>
                @endif
              </li>
            </ul>
            <div class="text-center">
              @if($favicon!="")
                <a href="{{ route('descargar_qr_pdf', $users->empleado->id) }}" class="btn btn-primary" target="_blank"><b>Descargar QR en PDF</b></a>
                <a href="{{ route('enviar_qr', $users->empleado->id) }}" class="btn btn-primary"><b>Enviar al email QR</b></a>
              @endif
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card card-primary card-outline">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Datos personales</a></li>
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Seguridad</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <p class="text-center mb-3">Todos los campos (<b style="color: red;">*</b>) son requeridos.</p>
              <div class="active tab-pane" id="activity">
                <form action="{{ route('editar_perfil') }}" name="editar_perfil" id="demo-form" method="POST" data-parsley-validate>
                  @csrf
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="usuario">Usuario <b style="color: red;">*</b></label>
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese usuario..." value="{{$users->usuario}}" required="">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="nombres">Nombres <b style="color: red;">*</b></label>
                        <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ingrese nombres..." value="{{$users->empleado->nombres}}" required="">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="apellidos">Apellidos <b style="color: red;">*</b></label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos..." value="{{$users->empleado->apellidos}}" required="">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="rut">RUT <b style="color: red;">*</b></label>
                      <input type="text" class="form-control" name="rut" id="rut" aria-describedby="rut" placeholder="Ingrese RUT..." disabled="" value="{{$users->empleado->rut}}">
                      <small id="rut" class="form-text text-muted">Solo lo puede actualizar el administrador.</small>                      
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="email">Email <b style="color: red;">*</b></label>
                      <input type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Ingrese un email..." value="{{$users->email}}" required>
                      <small id="email" class="form-text text-muted">Ingrese un email valido.</small>                      
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="telefono">Teléfono <b style="color: red;">*</b></label>
                      <input type="text" class="form-control" name="telefono" id="telefono" aria-describedby="telefono" placeholder="Ingrese telefono..." required value="{{$users->empleado->telefono}}" data-parsley-type="number">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="direccion">Dirección</label>
                      <textarea name="direccion" id="direccion" class="form-control" style="resize: none;" placeholder="Dirección">{{$users->empleado->direccion}}</textarea>
                    </div>
                  </div>
                    <input type="hidden" value="1" id="datos_per" name="datos_per">
                    <input type="hidden" value="{{$users->empleado->id}}" id="id_empleado" name="id_empleado">
                    <input type="hidden" value="{{$users->id}}" id="id_usuario" name="id_usuario">
                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Actualizar perfil</button>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <form action="{{ route('editar_perfil') }}" name="editar_perfil" method="POST" data-parsley-validate>
                  @csrf
                  <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input checkbox" type="checkbox" value="1" id="cambiar_password" name="cambiar_password">
                        <label class="form-check-label" for="cambiar_password">
                            Seleccione si desea cambiar su contraseña
                        </label>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña..." disabled="disabled" data-parsley-minlength="8">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirmar_password">Repita contraseña</label>
                        <input type="password" class="form-control" name="confirmar_password" id="confirmar_password" placeholder="Repita contraseña..." disabled="disabled" data-parsley-equalto="#password" data-parsley-minlength="8">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">                    
                    <label for="preguntas_seguridad">Preguntas y respuestas de seguridad</label>
                    <div class="form-row">
                    @if(count($users->preguntas)>0)
                    @php $i=1; @endphp
                      @foreach($users->preguntas as $key)
                      <div class="col-md-3">
                        <label for="pregunta1">Pregunta {{ $i }}:</label>
                        {{ $key->pregunta }}
                      </div>
                      <div class="col-md-3">
                        <label for="respuesta1">Respuesta: </label>
                       {{ $key->pivot->respuesta }}
                      </div>
                      @php $i++; @endphp
                      @endforeach
                      @else
                      <div class="col-md-12">
                        <label for="respuesta2">No tiene preguntas de seguridad registradas</label>
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input checkbox" type="checkbox" value="1" id="cambiar_preguntas" name="cambiar_preguntas">
                        <label class="form-check-label" for="cambiar_preguntas">
                            Seleccione si desea cambiar sus preguntas de seguridad
                        </label>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="pregunta1">1era Pregunta de seguridad <b style="color: red;">*</b></label>
                        <select class="form-control" name="pregunta1" id="pregunta1" disabled="disabled">
                          <option value="">Seleccione una pregunta</option>
                          @foreach($preguntas as $key)
                            <option value="{{$key->id}}">{{$key->pregunta}}</option>
                          @endforeach()
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="respuesta1">Respuesta <b style="color: red;">*</b></label>
                        <input type="password" class="form-control" name="respuesta1" id="respuesta1" placeholder="Ingrese respuesta..." disabled="disabled">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="pregunta2">2da Pregunta de seguridad <b style="color: red;">*</b></label>
                        <select class="form-control" name="pregunta2" id="pregunta2" disabled="disabled">
                          <option value="">Seleccione una pregunta</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="respuesta2">Respuesta <b style="color: red;">*</b></label>
                        <input type="password" class="form-control" name="respuesta2" id="respuesta2" placeholder="Ingrese respuesta..." disabled="disabled">
                    </div>
                  </div>
                  <input type="hidden" value="1" id="datos_seg" name="datos_seg">
                  <input type="hidden" value="{{$users->id}}" id="id_usuario" name="id_usuario">
                  <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" disabled="disabled" id="boton_enviar" name="boton_enviar">Actualizar perfil</button>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Información de Naturandes</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-3">
                <div class="callout callout-info">
                  <h5><i class="fas fa-book mr-1"></i> Contacto</h5>
                  <p>promociones@naturandeschile.com</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="callout callout-info">
                  <h5><i class="fas fa-map-marker-alt mr-1"></i> Dirección</h5>
                  <p>Ignacio Carrera Pinto 651, Copiapó, III Región. </p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="callout callout-info">
                  <h5><i class="fas fa-phone-alt mr-1"></i> Número telefónico</h5>
                  <p>+52 222 1297. </p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="callout callout-info">
                  <h5><i class="far fa-clock mr-1"></i> Horario</h5>
                  <p>Lu-VI: 8:30-18:00 | Sa: 8:30-14:00 | Do: cerrado. </p>
                </div>
              </div>              
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
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
  $(function() {
    $(".checkbox").click(function() {
      $('#boton_enviar').prop('disabled',$('input.checkbox:checked').length == 0);
    });
  });
</script>
<script type="text/javascript">
  $('#pregunta1').on('change',function(event){
    var id_pregunta=event.target.value;
    console.log(id_pregunta);
    $.get('/buscar_preguntas_p/'+id_pregunta+'/seguridad_p',function(data){
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

<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('plugins/parsleyjs/i18n/es.js') }}"></script>
@endsection