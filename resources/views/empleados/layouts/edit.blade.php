<div class="collapse multi-collapse" id="collapseExample3" style="position: absolute; margin-left: -8px; width: 100% !important; background-color: white !important;">
    <div class="card-header">
      <a href="#" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3" class="btn btn-warning btn-sm boton-tabla text-white" style="border-radius: 5px; float: right;" onclick="cerrar(3)">
        <strong>Cerrar</strong>
      </a>
    </div>
    <div class="card card-body" style="border-top: 3px solid #ffc107;">
      <h4 class="header-title mb-2">Editar datos de repartidor <br> <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h4>
      <form action="{{ route('empleados.editar') }}" name="registro_empleados" method="POST">
           @csrf
           <div class="row">
            <div class="col-md-4">
            	<div class="form-group">
            		<label>Nombres</label>
            		<input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" name="nombres" class="form-control" required value="{{ old('nombres') }}" id="nombres_edit">
              @error('nombres')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            	</div>
            </div>
            <div class="col-md-4">
            	<div class="form-group">
            		<label>Apellidos</label>
            		<input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" name="apellidos" class="form-control" required value="{{ old('apellidos') }}" id="apellidos_edit">
              @error('apellidos')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            	</div>
            </div>
            <div class="col-md-4">
            	<div class="form-group">
                <label for="rut_edit" style="color: black;">Rut</label>
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" name="rut" placeholder="Rut del Repartidor" minlength="7" maxlength="8" id="rut_edit" class="form-control" required placeholder="Rut del repartidor">
                      @if($errors->has('rut'))
                        <small class="form-text text-danger">
                          {{ $errors->first('rut') }}
                        </small>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="number" name="verificador" min="0" id="verificador_edit" minlength="1" maxlength="1" max="9" value="0" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="usuario">Usuario <b style="color: red;">*</b></label>
                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" placeholder="Ingrese usuario" name="usuario" required id="usuario_edit">
                @if ($errors->has('usuario'))
                    <small class="form-text text-danger">
                        {{ $errors->first('usuario') }}
                     </small>
                @endif
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="email">Email</label>
      						<div class="input-group mb-2 mr-sm-2">
      							<div class="input-group-prepend">
      								<div class="input-group-text">@</div>
      							</div>
      							<input type="email" placeholder="CORREO" name="email" class="form-control" id="email_edit" value="{{ old('email') }}">
      						</div>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-md-4">
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
      					     <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" name="telefono" class="form-control" autocomplete="off" data-mask="(999) 999-9999" placeholder="Teléfono del Repartidor" aria-label="" maxlength="11" value="{{ old('telefono') }}" id="telefono_edit" >
                      @if ($errors->has('telefono'))
                        <small class="form-text text-danger">
                            {{ $errors->first('telefono') }}
                         </small>
                      @endif
      				    </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="direccion">Dirección</label>
              	  <textarea style="max-height: 40px !important; text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" name="direccion" class="form-control" value="{{ old('direccion') }}" id="direccion_edit"></textarea>
                @error('direccion')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status_editar" class="form-control">
                  
                </select>
              </div>
            </div>
          </div>
        	<input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="hidden" name="id" id="id_edit">
          <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="hidden" name="id_usuario" id="id_usuario">
          <button type="submit" style="float: right;" class="btn btn-warning text-white">Actualizar</button>
      </form>
    </div>
</div>