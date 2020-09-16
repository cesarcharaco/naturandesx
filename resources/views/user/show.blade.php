@extends('layouts.app')
@section('css')
<title>Mi perfil</title>
@endsection

@section('content')
<div class="main-conten-inner">
  	<div class="row">
  		<div class="col-xl-3 col-ml-6 col-mdl-4 col-sm-6 mt-5">
            <div class="card">
                <div class="pricing-list">
                    <div class="prc-head">
                        <h4>Mi Perfil</h4>
                    </div>
                    <div class="prc-list">
                        <ul>
                            <li><a href="#">Term financing</a></li>
                            <li><a href="#">Access up to $10,000</a></li>
                            <li><a href="#">Get: USD</a></li>
                            <li><a href="#">3-24 Month Terms</a></li>
                            <li class="bold"><a href="#">1 SALT/year</a></li>
                        </ul>
                        <a href="#">Buy Package</a>
                    </div>
                </div>
            </div>
        </div>
  	</div>
  <div class="bg-white border rounded">
    <div class="row no-gutters">
      <div class="col-lg-4 col-xl-3">
        <div class="profile-content-left pt-5 pb-3 px-3 px-xl-5">
          <div class="card text-center widget-profile px-0 border-0">
            <div class="card-img mx-auto rounded-circle">
              <img src="{{ asset('img/user/user.png') }}" style="width: 100px; height: 100px; border-radius: 50px;" alt="user image">
            </div>
            <div class="card-body">
              <h4 class="py-2 text-dark">{{ Auth::user()->usuario }}</h4>
              <p>{{ Auth::user()->email }}</p>
              <!-- <a class="btn btn-primary btn-pill btn-lg my-4" href="#">Follow</a> -->
            </div>
          </div>
          <div class="contact-info pt-4" align="center">
            <!-- <h5 class="text-dark mb-1">Información de Contacto</h5> -->
            <p class="text-dark font-weight-medium pt-4 mb-2">Código QR
            <br>
            <img src="{{ asset('img/qr.png') }}" alt="user image">
            </p>            
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-xl-9">
        <div class="card">
          <div class="card-body">
            <div class="profile-content-right py-5">
              <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="perfil_datos-tab" data-toggle="tab" href="#perfil_datos" role="tab" aria-controls="perfil_datos" aria-selected="false">Datos personales</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="perfil_seguridad-tab" data-toggle="tab" href="#perfil_seguridad" role="tab" aria-controls="perfil_seguridad" aria-selected="false">Seguridad</a>
                </li>
              </ul>
              <form action="#" method="POST">
                @csrf
                <div class="tab-content px-3 px-xl-5" id="myTabContent" style="height: auto;">
                  <div class="tab-pane fade show active" id="perfil_datos" role="tabpanel" aria-labelledby="perfil_datos-tab">
                    <div class="mt-5">
                      <div class="mb-5">
                        <h2 style="color: grey;" align="center">{{$users->tipo_usuario}}</h2>
                      </div>
                      <div class="row mb-2">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="firstName">Nombre</label>
                            <input type="text" class="form-control" id="firstName" value="{{$users->usuario}}">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $users->email }}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade show" id="perfil_seguridad" role="tabpanel" aria-labelledby="perfil_seguridad-tab">
                    <div class="row mb-4 mt-5">
                      <div class="col-lg-6">
                          <div class="card">
                              <h3>Cambiar contraseña</h3>
                              <div class="form-group mb-4">
                                <label for="oldPassword">Actual contraseña</label>
                                <input type="password" class="form-control" id="oldPassword">
                              </div>

                              <div class="form-group mb-4">
                                <label for="newPassword">Nueva contraseña</label>
                                <input type="password" class="form-control" id="newPassword">
                              </div>

                              <div class="form-group mb-4">
                                <label for="conPassword">Repita contraseña</label>
                                <input type="password" class="form-control" id="conPassword">
                              </div>

                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="card">
                            <h3></h3>
                            <div class="form-group mt-4">
                              <label for="pregunta">Pregunta de seguridad</label>
                              <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <div class="ti-lock"></div>
                                  </div>
                                </div>
                                <select class="form-control" name="pregunta" required>
                                  @foreach($preguntas as $key)
                                    <option value="{{$key->id}}">{{$key->pregunta}}</option>
                                  @endforeach()
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="respuesta">Respuesta</label>
                              <div class="input-group mb-2 mr-sm-2">
                                <input type="password" name="respuesta" class="form-control" required id="Inputrespuesta">
                                <div class="input-group-prepend" onclick="VerR(1)">
                                  <div class="input-group-text" style="color: green;">
                                    <div class="ti-eye"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <center>
                  <button type="submit" class="btn btn-primary mb-2 btn-pill" disabled="">Actualizar datos</button>
                </center>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
