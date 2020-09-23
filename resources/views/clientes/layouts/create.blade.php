<div class="collapse multi-collapse" id="RegistrarCliente" style="position: absolute; margin-left: -8px; width: 100% !important; background-color: white !important;">
	<div class="card-header">
      <a data-toggle="collapse" data-target="#RegistrarCliente" aria-expanded="false" aria-controls="RegistrarCliente" class="btn btn-primary btn-sm text-uppercase float-right" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
        <strong>Cerrar</strong>
      </a>
    </div>
  	<div class="card border border-success card-body">
    	<h4 class="header-title mb-2">Registro de cliente <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
      	<form action="{{ route('clientes.store') }}" name="registro_clientes" method="POST">
	        @csrf
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
	              <input type="text" class="form-control" placeholder="Ingrese usuario" name="usuario" required id="usuario" value="{{ old('usuario') }}">
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
	              <label for="status">Status</label>
	              <select class="form-control" id="exampleFormControlSelect12" name="status">
	                <option value="Activo">Activo</option>
	                <option value="Inactivo">Inactivo</option>
	              </select>
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
	              <div class="card border border-success">
	                <div class="card-header bg-success" align="center"><h4 align="center" style="color:white;">AVISO</h4></div>
	                <div class="card-body">
	                  <div>
	                    <strong>-</strong> La contraseña será el Rut+<strong>Verificador</strong>.<br>
	                    Ejm: 1234567<strong>8</strong>.
	                  </div>
	                </div>
	              </div>
	              
	        <div class="form-footer pt-5 border-top">
	          <button type="submit" style="float: right;" class="btn btn-success btn-default">Registrar</button>
	        </div>
      	</form>
  	</div>
</div>