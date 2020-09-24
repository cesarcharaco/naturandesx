<div class="collapse multi-collapse" id="collapseExample4" style="position: absolute; margin-left: -8px; width: 100% !important; background-color: white !important;">
    <div class="card-header">
      <a href="#" data-toggle="collapse" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample4" class="btn btn-success btn-sm boton-tabla text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
        <strong>Cerrar</strong>
      </a>
    </div>
    <div class="card card-body" style="border-top: 3px solid red;">
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
