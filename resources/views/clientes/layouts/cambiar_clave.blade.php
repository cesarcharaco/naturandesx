<div class="collapse multi-collapse" id="collapseExample5" style="position: absolute; margin-left: -8px; width: 100% !important; background-color: white !important;">
    <div class="card-header">
      <a href="#" data-toggle="collapse" data-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample5" class="btn btn-warning btn-sm boton-tabla text-white" style="border-radius: 5px; float: right;" onclick="cerrar(4)">
        <strong>Cerrar</strong>
      </a>
    </div>
    <div class="card card-body" style="border-top: 3px solid yellow;">
        <form action="{{ route('clientes.cambiar_clave') }}" name="cambiar_clave_cliente" method="POST" data-parsley-validate>
          @csrf
          <h3>Cambiar clave del cliente</h3> 
          <p class="text-dark">Modificar la contraseña del cliente para accesar al sistema<p>
          <div class="card-body border border-default shadow" style="border-radius: 20px;">
          	<div class="form-row">
          		<div class="col-md-6">
			        <div class="form-group">                      
			            <label for="password_new">Ingrese nueva contraseña del cliente</label>
			            <div class="input-group">
			              <div class="input-group-prepend">
			                <div class="input-group-prepend">
			                  <div class="input-group-text">
			                    <div class="fa fa-lock"></div>
			                  </div>
			                </div>
			              </div>
			              <input type="password" name="password_new" id="password_new" class="form-control" placeholder="Nueva Contraseña" aria-label="" autocomplete="off" required="required" data-parsley-minlength="8">
			              @error('password_new')
			                <span class="invalid-feedback" role="alert">
			                  <strong>{{ $message }}</strong>
			                </span>
			              @enderror
			            </div>
			        </div>          			
          		</div>
          		<div class="col-md-6">
			        <div class="form-group">                      
			            <label for="password_confir">Confirmar nueva contraseña</label>
			            <div class="input-group">
			              <div class="input-group-prepend">
			                <div class="input-group-prepend">
			                  <div class="input-group-text">
			                    <div class="fa fa-lock"></div>
			                  </div>
			                </div>
			              </div>
			              <input type="password" name="password_confir" id="password_confir" class="form-control" placeholder="Confirmar Contraseña" aria-label="" autocomplete="off" required="required" data-parsley-equalto="#password_new" data-parsley-minlength="8">
			              @error('password_confir')
			                <span class="invalid-feedback" role="alert">
			                  <strong>{{ $message }}</strong>
			                </span>
			              @enderror
			            </div>
			        </div>          			
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
            <input type="hidden" name="id_usuario_cc" id="id_usuario_cc">
            <button type="submit" class="btn btn-warning float-right text-white">Actualizar</button>
          </div>
        </form>
    </div>
</div>
