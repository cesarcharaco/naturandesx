<div class="collapse multi-collapse" id="collapseExample3" style="position: absolute; margin-left: -8px; width: 100% !important; background-color: white !important;">
    <div class="card-header">
      <a href="#" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3" class="btn btn-success btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px; float: right;" onclick="cerrar(3)">
        Cerrar</i>
      </a>
    </div>
    <div class="card card-body">
      <h4 class="header-title mb-2">Editar datos de repartidor <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
      <form action="{{ route('empleados.editar') }}" name="registro_empleados" method="POST">
           @csrf
        	<div class="form-group">
        		<label>Nombres</label>
        		<input type="text" name="nombres" class="form-control" required value="{{ old('nombres') }}" id="nombres_edit">
          @error('nombres')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        	</div>
        	<div class="form-group">
        		<label>Apellidos</label>
        		<input type="text" name="apellidos" class="form-control" required value="{{ old('apellidos') }}" id="apellidos_edit">
          @error('apellidos')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        	</div>
        	<div class="form-group">
          <label for="rut_edit" style="color: black;">Rut</label>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" name="rut" placeholder="Rut del Repartidor" minlength="7" maxlength="8" id="rut_edit" class="form-control" required placeholder="Rut del repartidor">
                @if($errors->has('rut'))
                  <small class="form-text text-danger">
                    {{ $errors->first('rut') }}
                  </small>
                @endif
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
          <label for="usuario">Usuario <b style="color: red;">*</b></label>
          <input type="text" class="form-control" placeholder="Ingrese usuario" name="usuario" required id="usuario_edit">
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
							<input type="email" placeholder="Correo" name="email" class="form-control" id="email_edit" value="{{ old('email') }}">
						</div>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
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
					         <input type="text" name="telefono" class="form-control" autocomplete="off" data-mask="(999) 999-9999" placeholder="Teléfono del Repartidor" aria-label="" maxlength="11" value="{{ old('telefono') }}" id="telefono_edit" >
            @if ($errors->has('telefono'))
              <small class="form-text text-danger">
                  {{ $errors->first('telefono') }}
               </small>
            @endif
				        </div>
        </div>
        <div class="form-group">
          <label for="status">Status</label>
          <select name="status" id="status_editar" class="form-control">
            
          </select>
        </div>
        <div class="form-group">
          <label for="direccion">Dirección</label>
        	  <textarea name="direccion" class="form-control" value="{{ old('direccion') }}" id="direccion_edit"></textarea>
          @error('direccion')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-footer pt-5 border-top">
        	<input type="hidden" name="id" id="id_edit">
          <input type="hidden" name="id_usuario" id="id_usuario">
          <button type="submit" style="float: right;" class="btn btn-success btn-default">Registrar</button>
        </div>
      </form>
    </div>
</div>

<div class="VistaLateralEmpleados EditarEmpleados shadow" id="EditarEmpleados" style="display: none;">
  <div class="card card-warning border border-warning">
    <div class="card-body">
    </div>
  </div>
</div>