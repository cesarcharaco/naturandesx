<div class="collapse multi-collapse" id="collapseExample5" style="position: absolute; margin-left: -8px; width: 100% !important; background-color: white !important;">
    <div class="card-header">
      <a href="#" data-toggle="collapse" data-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample5" class="btn btn-warning btn-sm boton-tabla text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
        <strong>Cerrar</strong>
      </a>
    </div>
    <div class="card card-body" style="border-top: 3px solid yellow;">
        <form action="" name="cambiar_clave_cliente" method="POST">
          @csrf
          <h3>Cambiar clave del cliente</h3> 
          <p class="text-dark">Modificar la contraseña del cliente para accesar al sistema<p>
          <div class="card-body border border-default shadow" style="border-radius: 20px;">
	        <div class="form-group">                      
	            <label for="contraseña">Ingrese nueva contraseña del cliente</label>
	            <div class="input-group">
	              <div class="input-group-prepend">
	                <div class="input-group-prepend">
	                  <div class="input-group-text">
	                    <div class="fa fa-lock"></div>
	                  </div>
	                </div>
	              </div>
	              <input type="password" name="password_new" class="form-control" placeholder="Nueva Contraseña" aria-label="" autocomplete="off" required="required">
	              @error('password_new')
	                <span class="invalid-feedback" role="alert">
	                  <strong>{{ $message }}</strong>
	                </span>
	              @enderror
	            </div>
	        </div>

	        <div class="form-group">                      
	            <label for="contraseña">Confirmar nueva contraseña</label>
	            <div class="input-group">
	              <div class="input-group-prepend">
	                <div class="input-group-prepend">
	                  <div class="input-group-text">
	                    <div class="fa fa-lock"></div>
	                  </div>
	                </div>
	              </div>
	              <input type="password" name="password_confir" class="form-control" placeholder="Confirmar Contraseña" aria-label="" autocomplete="off" required="required">
	              @error('password_confir')
	                <span class="invalid-feedback" role="alert">
	                  <strong>{{ $message }}</strong>
	                </span>
	              @enderror
	            </div>
	        </div>
          	
          </div>

          <div class="card-body border border-danger shadow mt-3 mb-3" style="border-radius: 20px;">
	          <div class="form-group ">                      
	            <label for="contraseña">Ingrese contraseña de Administrador</label>
	            <div class="input-group">
	              <div class="input-group-prepend">
	                <div class="input-group-prepend">
	                  <div class="input-group-text">
	                    <div class="fa fa-lock"></div>
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
          </div>
          <div class="float-right">
            <input type="hidden" name="id" id="id_cliente_pass">
            <button type="submit" class="btn btn-warning float-right text-white">Actualizar</button>
          </div>
        </form>
    </div>
</div>
