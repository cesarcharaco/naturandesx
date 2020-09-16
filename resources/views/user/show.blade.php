@extends('layouts.app')
@section('css')
<title>Mi perfil</title>
@endsection

@section('content')
<div class="content">
  <div class="bg-white border rounded">
    <div class="row no-gutters">
      <div class="col-lg-4 col-xl-3">
        <div class="profile-content-left pt-5 pb-3 px-3 px-xl-5">
          <div class="card text-center widget-profile px-0 border-0">
            <div class="card-img mx-auto rounded-circle">
              <img src="{{ asset('img/user/user.png') }}" alt="user image">
            </div>
            <div class="card-body">
              <h4 class="py-2 text-dark">{{ Auth::user()->name }}</h4>
              <p>{{ Auth::user()->email }}</p>
              <!-- <a class="btn btn-primary btn-pill btn-lg my-4" href="#">Follow</a> -->
            </div>
          </div>
          <hr class="w-100">
          <div class="contact-info pt-4">
            <h5 class="text-dark mb-1">Información de Contacto</h5>
            <p class="text-dark font-weight-medium pt-4 mb-2">Código QR
            <br>
            <img src="{{ asset('img/qr.png') }}" alt="user image">
            </p>
            
            <p class="text-dark font-weight-medium pt-4 mb-2">Redes sociales</p>
            <p class="pb-3 social-button">
              <a href="#" class="mb-1 btn btn-outline btn-twitter rounded-circle">
                <i class="mdi mdi-twitter"></i>
              </a>
              <a href="#" class="mb-1 btn btn-outline btn-linkedin rounded-circle">
                <i class="mdi mdi-linkedin"></i>
              </a>
              <a href="#" class="mb-1 btn btn-outline btn-facebook rounded-circle">
                <i class="mdi mdi-facebook"></i>
              </a>
              <a href="#" class="mb-1 btn btn-outline btn-skype rounded-circle">
                <i class="mdi mdi-skype"></i>
              </a>
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-xl-9">
        <div class="profile-content-right py-5">
          <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="perfil_datos-tab" data-toggle="tab" href="#perfil_datos" role="tab" aria-controls="perfil_datos" aria-selected="false">Datos personales</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="perfil_seguridad-tab" data-toggle="tab" href="#perfil_seguridad" role="tab" aria-controls="perfil_seguridad" aria-selected="false">Seguridad</a>
            </li>
          </ul>
          <div class="tab-content px-3 px-xl-5" id="myTabContent">
            <div class="tab-pane fade show active" id="perfil_datos" role="tabpanel" aria-labelledby="perfil_datos-tab">
              <div class="mt-5">
                <form>
                  <div class="form-group row mb-6">
                    <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Cambiar imagen</label>
                    <div class="col-sm-8 col-lg-10">
                      <div class="custom-file mb-1">
                        <input type="file" class="custom-file-input" id="coverImage" required>
                        <label class="custom-file-label" for="coverImage">Buscar img...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="firstName">Nombre</label>
                        <input type="text" class="form-control" id="firstName" value="{{$users->name}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ $users->email }}">
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label for="tipo_usuario">Tipo de usuarios</label>
                        <input type="text" class="form-control" name="tipo_usuario" id="tipo_usuario" value="{{$users->tipo_usuario}}" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-end mt-5">
                    <button type="submit" class="btn btn-primary mb-2 btn-pill">Actualizar perfil</button>
                  </div>

                </form>
              </div>
            </div>
            <div class="tab-pane fade show" id="perfil_seguridad" role="tabpanel" aria-labelledby="perfil_seguridad-tab">
              <div class="mt-5">
                <form action="#">
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

                  <div class="d-flex justify-content-end mt-5">
                    <button type="submit" class="btn btn-primary mb-2 btn-pill" disabled="">Actualizar contraseña</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
