<div class="VistaLateralEmpleados EliminarEmpleados shadow" id="EliminarEmpleados" style="display: none;">
  <div class="card card-danger border border-danger">
    <div class="card-body">
        <form action="{{ route('empleados.eliminar') }}" name="eliminar_empleados" method="POST">
          @csrf
          <h3>¿Está realmente seguro de querer eliminar a este Repartidor?</h3> 
          <p>Se eliminarán todos sus datos y su código QR<p>
          <br><br>
          <div class="form-group">                      
            <label for="contraseña">Ingrese contraseña de Administrador</label>
            	<div class="input-group">
							<div class="input-group-prepend">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <div class="ti-lock"></div>
                  </div>
                </div>
              </div>
              <input type="password" name="password" class="form-control" placeholder="Ingrese su contraseña actual" aria-label="" autocomplete="off" required="required">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
				        </div>
          </div>
          <div class="float-right">
            <input type="hidden" name="id" id="id_delete">
            <input type="hidden" name="id_usuario" id="id_usuarioDelete">
            <input type="hidden" name="id_qr" id="id_qr_delete">
            <button type="submit" class="btn btn-danger">Eliminar</button>
          </div>
        </form>
    </div>
  </div>
</div>