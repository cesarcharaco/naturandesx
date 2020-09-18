<div class="VistaLateralEmpleados RegistrarEmpleados shadow" id="RegistrarEmpleados" style="display: none;">
  <div class="card card-default border border-success shadow">
    <div class="card-body">
      <h4 class="header-title mb-2">Registro de repartidores <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
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
          <label for="email">Email <b style="color: red;">*</b></label>
						<div class="input-group mb-2 mr-sm-2">
							<div class="input-group-prepend">
								<div class="input-group-text">@</div>
							</div>
							<input type="email" placeholder="Correo" name="email" class="form-control" id="email" value="{{ old('email') }}" required="required">
						</div>
          @if($errors->has('email'))
            <small class="form-text text-danger">
              {{ $errors->first('email') }}
            </small>
          @endif
        </div>
        <div class="form-group">                      
          <label for="telefono">Teléfono <b style="color: red;">*</b></label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <div class="ti-mobile"></div>
                </div>
              </div>
            </div>
            <input type="text" name="telefono" class="form-control" data-mask="(999) 999-9999" placeholder="Teléfono del Repartidor" aria-label="" autocomplete="off" maxlength="11" value="{{ old('telefono') }}" required="required">
            @if($errors->has('telefono'))
              <small class="form-text text-danger">
                {{ $errors->first('email') }}
              </small>
            @endif
          </div>
          @if($errors->has('telefono'))
            <small class="form-text text-danger">
              {{ $errors->first('telefono') }}
            </small>
          @endif
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
</div>