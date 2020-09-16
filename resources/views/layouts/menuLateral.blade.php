<div id="vistaReportes" style="display: none;">
    @if(Auth::user()->tipo_usuario == 'Admin' )
        <div class="offset-area">
            <div class="offset-close"><i class="ti-close"></i></div>
            <ul class="nav offset-menu-tab">
                <li><a class="active show" data-toggle="tab" href="#activity">Reportes</a></li>
                <li><a data-toggle="tab" href="#settings" class="">Ventas</a></li>
            </ul>
            <div class="offset-content tab-content">
                <div id="activity" class="tab-pane fade in active show">
                    <center>
                        <div class="form-group">
                            <select name="tipo_usuario" class="form-control select2" required="">
                                <option selected disabled>Tipo de Usuario</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="usuario" class="form-control select2" required="">
                                <option selected disabled>Usuario</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="semana[]" multiple class="form-control select2" required="">
                                <option selected disabled>Semanas</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Generar</button>
                    </center>
                </div>
                <div id="settings" class="tab-pane fade">
                    <center>
                        <div class="form-group">
                            <select name="semana[]" multiple class="form-control select2" required="">
                                <option selected disabled>Semanas</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Generar</button>
                    </center>
                </div>
            </div>
        </div>
    @elseif(Auth::user()->tipo_usuario == 'Empleado' )
        <div class="offset-area">
            <div class="offset-close"><i class="ti-close"></i></div>
            <ul class="nav offset-menu-tab">
                <li><a class="active show" data-toggle="tab" href="#activity">Reportes</a></li>
            </ul>
            <div class="offset-content tab-content">
                <div id="settings" class="tab-pane fade in active show">
                    <center>
                        <div class="form-group">
                            <select name="semana[]" multiple class="form-control select2" required="">
                                <option selected disabled>Semanas</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Generar</button>
                    </center>
                </div>
            </div>
        </div>
    @else
    @endif
</div>

<div id="vistaPerfil">
    <div class="offset-area">
        <div class="offset-close"><i class="ti-close"></i></div>
        <ul class="nav offset-menu-tab">
            <li style="width: 100% !important;">
                <a class="active show" data-toggle="tab" href="#perfil">Editar Perfil</a>
                <div class="editPerfil" style="display: none;">
                    <button class="btn btn-success rounded" onclick="editarPerfil(1);">
                        <div class="ti-eye text-white" > Ver</div>
                    </button>
                </div>
                <div class="verDatosPerfil">
                    <button class="btn btn-warning rounded" onclick="editarPerfil(2);">
                        <div class="ti-pencil text-white" > Editar</div>
                    </button>
                </div>
            </li>
        </ul>
        <div class="offset-content tab-content">
            <div id="perfil" class="tab-pane fade in active show">
                @if(Auth::user()->tipo_usuario == 'Admin' )
                    <form>
                        <center>
                            <div class="form-group">
                                <label>Usuario</label>
                                <div class="editPerfil" style="display: none;">
                                    <input type="text" name="usuario" class="form-control" required placeholder="Usuario" value="{{Auth::user()->usuario}}">
                                </div>
                                <div class="verDatosPerfil">
                                    <h5 style="color: grey;">{{Auth::user()->usuario}}</h5>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div class="editPerfil" style="display: none;">
                                    <input type="email" name="email" class="form-control" required placeholder="Email del repartidor" value="{{Auth::user()->email}}">
                                </div>
                                <div class="verDatosPerfil">
                                    <h5 style="color: grey;">{{Auth::user()->email}}</h5>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pregunta">Pregunta de seguridad</label>
                                <div class="editPerfil" style="display: none;">
                                    <div class="input-group mb-2 mr-sm-2">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <div class="ti-lock"></div>
                                        </div>
                                      </div>
                                      <select class="form-control" name="pregunta" required id="selectPreguntas">
                                      </select>
                                    </div>
                                </div>
                                <div class="verDatosPerfil">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="respuesta">Respuesta</label>
                                <div class="editPerfil" style="display: none;">
                                    <div class="input-group mb-2 mr-sm-2">
                                      <input type="password" name="respuesta" class="form-control" required id="Inputrespuesta">
                                      <div class="input-group-prepend" onclick="VerR(1)">
                                        <div class="input-group-text" style="color: green;">
                                          <div class="ti-eye"></div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="verDatosPerfil">

                                </div>
                            </div>
                            <div class="editPerfil" style="display: none;">
                                <button type="submit" class="btn btn-success rounded text-white" >
                                    Guardar
                                </button>
                            </div>
                        </center>
                    </form>
                @elseif(Auth::user()->tipo_usuario == 'Repartidor' )
                    <form action="{{ route('empleados.store') }}" name="registro_empleados" method="POST">
                    @csrf
                        <div class="form-group">
                            <label>Nombres</label>
                            <input type="text" name="nombres" class="form-control" required value="{{ old('nombres') }}" placeholder="Nombres del repartidor">
                      @if($errors->has('nombres'))
                        <small class="form-text text-danger">
                          {{ $errors->first('nombres') }}
                        </small>
                      @endif
                        </div>
                        <div class="form-group">
                            <label>Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" required value="{{ old('apellidos') }}" placeholder="Apellidos del repartidor">
                      @if($errors->has('apellidos'))
                        <small class="form-text text-danger">
                          {{ $errors->first('apellidos') }}
                        </small>
                      @endif
                        </div>
                    <div class="form-group">
                      <label for="rut" style="color: black;">Rut</label>
                        <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                            <input type="text" name="rut" placeholder="Rut del Repartidor" minlength="7" maxlength="8" id="rut_e" class="form-control" required placeholder="Rut del repartidor">
                                    @if($errors->has('rut'))
                              <small class="form-text text-danger">
                                {{ $errors->first('rut') }}
                              </small>
                            @endif
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
                      <label for="usuario">Usuario <b style="color: red;">*</b></label>
                      <input type="text" class="form-control" placeholder="Ingrese usuario" name="usuario" required id="usuario" value="{{ old('usuario') }}">
                      @if ($errors->has('usuario'))
                          <small class="form-text text-danger">
                              {{ $errors->first('usuario') }}
                           </small>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">@</div>
                                    </div>
                                    <input type="email" placeholder="Correo" name="email" class="form-control" id="email" value="{{ old('email') }}">
                                </div>
                      @if($errors->has('email'))
                        <small class="form-text text-danger">
                          {{ $errors->first('email') }}
                        </small>
                      @endif
                    </div>
                    <div class="form-group">                      
                      <label for="telefono">Teléfono</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <div class="ti-mobile"></div>
                                    </div>
                                </div>
                            </div>
                        <input type="text" name="telefono" class="form-control" data-mask="(999) 999-9999" placeholder="Teléfono del Repartidor" aria-label="" maxlength="12" autocomplete="off" maxlength="11" value="{{ old('telefono') }}">
                        @if($errors->has('telefono'))
                          <small class="form-text text-danger">
                            {{ $errors->first('email') }}
                          </small>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="direccion">Dirección</label>
                          <textarea name="direccion" class="form-control" value="{{ old('direccion') }}" placeholder="Dirección del repartidor"></textarea>
                      @if($errors->has('direccion'))
                        <small class="form-text text-danger">
                          {{ $errors->first('direccion') }}
                        </small>
                      @endif
                        </div>
                    <div class="form-footer pt-5 border-top">
                      <button type="submit" style="float: right;" class="btn btn-success btn-default">Registrar</button>
                    </div>
                    </form>
                @else
                  <h4 class="header-title mb-2">Editar datos de cliente <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
                  <center>
                    <form action="{{ route('clientes.editar') }}" name="registro_clientes" method="POST">
                      @csrf
                      <div class="form-group">
                        <label for="nombres_edit">Nombres</label>
                        <input type="text" class="form-control" placeholder="Ingrese nombres" id="nombres_edit" required="required" name="nombres">
                      </div>
                      <div class="form-group">
                        <label for="apellidos_edit">Apellidos</label>
                        <input type="text" class="form-control" placeholder="Ingrese apellidos" id="apellidos_edit" required="required" name="apellidos">
                      </div>
                      <div class="form-group">
                        <label for="usuario">Usuario <b style="color: red;">*</b></label>
                        <input type="text" class="form-control" placeholder="Ingrese usuario" name="usuario" required id="usuario_edit" >
                        @if ($errors->has('usuario'))
                            <small class="form-text text-danger">
                                {{ $errors->first('usuario') }}
                             </small>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="email_edit">Email</label>
                        <input type="email" class="form-control" placeholder="Ingrese email" name="email" id="email_edit">
                      </div>
                      <div class="form-group">                          
                        <label for="rut_edit">RUT <b style="color: red;">*</b></label>
                        <div class="row">
                          <div class="col-md-8">
                            <div class="form-group">
                              <input type="text" name="rut" placeholder="Rut del residente" minlength="7" maxlength="8" id="rut_edit" class="form-control" required>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <input type="number" name="verificador" min="1" id="verificador_edit" minlength="1" maxlength="1" max="9" value="0" class="form-control" required>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="pregunta">Pregunta de seguridad</label>
                        <div class="input-group mb-2 mr-sm-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <div class="ti-lock"></div>
                            </div>
                          </div>
                          <select class="form-control" name="pregunta" required>
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
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status_editar" name="status">
                        </select>
                      </div>
                      <div class="form-footer pt-5 border-top">
                        <input type="hidden" id="id_edit" name="id" value="">
                        <input type="hidden" id="id_usuario_edit" name="id_usuario" value="{{Auth::user()->id}}">
                        <button type="submit" style="float: right;" class="btn btn-success btn-default">Actualizar</button>
                      </div>
                    </form>
                  </center>
                @endif
            </div>
        </div>
    </div>
</div>