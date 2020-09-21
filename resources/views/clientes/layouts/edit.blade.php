<div class="collapse multi-collapse" id="collapseExample3" style="position: absolute; margin-left: -8px; width: 100% !important; background-color: white !important;">
    <div class="card-header">
      <a href="#" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3" class="btn btn-success btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px; float: right;" onclick="cerrar(3)">
        Cerrar</i>
      </a>
    </div>
    <div class="card card-body">
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
            {{--<div class="form-group">
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
            </div>--}}
            <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" id="status_editar" name="status">
              </select>
            </div>
            <div class="form-footer pt-5 border-top">
              <input type="hidden" id="id_edit" name="id">
              <input type="hidden" id="id_usuario_edit" name="id_usuario">
              <button type="submit" style="float: right;" class="btn btn-success btn-default">Actualizar</button>
            </div>
          </form>
        </center>
    </div>
</div>

<div class="VistaLateralEmpleados EditarEmpleados shadow" id="EditarEmpleados" style="display: none;">
  <div class="card card-warning border border-warning">
    <div class="card-body">
    </div>
  </div>
</div>