@extends('layouts.app')

@section('css')
  <title>Repartidores</title>
@endsection

@section('page-title-area')
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Repartidores</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('empleados.index') }}">Repartidores</a></li>
                    <li><span>Inicio</span></li>
                </ul>
            </div>
        </div>
        @include('layouts.perfil')
    </div>
</div>
<!-- page title area end -->
@endsection

@section('content')
  <div class="sales-report-area mt-5 mb-5">
    <div class="card bg-white">
      <div class="card-body">
        <h4 class="header-title mb-0">Repartidores</h4>
        <div class="row mb-3">
          <div class="col-md-12">
            <a href="#RegistrarEmpleados" onclick="RegistrarEmpleado()" class="btn btn-outline-primary btn-sm text-uppercase float-right">
              <i class="mdi mdi-link mr-1"></i>  Registrar 
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8" style="position: relative !important;">
            <div class="data-tables datatable-primary" style="width: 100% !important;">
              <table id="dataTable3" class="text-center" style="width: 100% !important; font:">
                  <thead class="text-capitalize">
                      <tr>
                          <th>Nombres</th>
                          <th>Rut</th>
                          <th>Teléfono</th>
                          <th>Email</th>
                          <th>Usuario</th>
                          <th>Status</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($empleados as $key)
                          <tr>
                              <td>{!! $key->nombres !!} {!! $key->apellidos !!}</td>
                              <td>{!! $key->rut !!}</td>
                              <td>{!! $key->telefono !!}</td>
                              <td>
                                @if($key->usuario->email=="")
                                  No posee
                                @else  
                                  {!! $key->usuario->email !!}
                                @endif
                              </td>
                              <td>{!! $key->usuario->usuario !!}</td>
                              @if( $key->status == 'Activo')
                                <td class="text-success">{!! $key->status !!}</td>
                              @else
                                <td class="text-danger">{!! $key->status !!}</td>
                              @endif
                              <td>
                                
                                <a href="#" class="btn btn-success btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px;" onclick="verEmpleado('{{$key->id}}','{{$key->qr->codigo}}','{{$key->nombres}}','{{$key->apellidos}}','{{$key->usuario->usuario}}','{{$key->usuario->email}}','{{$key->rut}}')">
                                    <div class="ti-eye"></div>
                                  </a>
                                  <a href="#" class="btn btn-warning btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px;" onclick="editarEmpleado('{{$key->id}}','{{$key->usuario->id}}','{{$key->nombres}}','{{$key->apellidos}}','{{$key->usuario->usuario}}','{{$key->usuario->email}}','{{$key->rut}}','{{$key->telefono}}','{{$key->status}}','{{$key->direccion}}')">
                                    <div class="ti-pencil-alt text-white"></div>
                                  </a>
                                  <a href="#" class="btn btn-danger btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px;" onclick="eliminarEmpleado('{{$key->id}}','{{$key->usuario->id}}','{{$key->qr->id}}')">
                                      <div class="ti-trash"></div>
                                  </a>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-4" style="position: relative !important;">
            <div class="VistaLateralEmpleados RegistrarEmpleados shadow" id="RegistrarEmpleados">
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
                        <input type="text" name="telefono" class="form-control" data-mask="(999) 999-9999" placeholder="Teléfono del Repartidor" aria-label="" autocomplete="off" maxlength="11" value="{{ old('telefono') }}">
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
                </div>
              </div>
            </div>
            <div class="VistaLateralEmpleados VerEmpleados" id="VerEmpleados" style="display: none;">
              <div class="card border shadow" style="
              background-image: url('{{ asset('img/blue-white.jpg') }}');
              background-position: center;
              background-repeat: no-repeat;
              background-size: cover;
              border-radius: 30px !important;">
                <div class="card-body">
                  <center>
                  	<div class="bg-primary" style="border-radius: 30px;">
                    	<img src="{{ asset('img/favicon.png') }}" style="width: 250px;">
                  	</div>
                    <div class="form-group" style="">
                      <div id="img_qr"></div>
                    </div>
                    <div class="card rounded">
                      <div class="form-group">
                        <h3 style="color: black !important;"><span id="nombres_carnet"></span> <span id="apellidos_carnet"></span></h3>
                      </div>
                      <div class="form-group">
                        <h5 style="color: black !important;"><span id="email_carnet"></span></h5>
                      </div>
                      <div class="form-group">
                        <h5 style="color: black !important;"><span id="rut_carnet"></span></h5>
                      </div>
                    </div>
                  </center>
                </div>
              </div>
            </div>
            <div class="VistaLateralEmpleados EditarEmpleados shadow" id="EditarEmpleados" style="display: none;">
              <div class="card card-warning border border-warning">
                <div class="card-body">
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
            </div>
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
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

  <script type="text/javascript">
    function RegistrarEmpleado() {
      $('.VistaLateralEmpleados').fadeOut('slow',
        function() { 
          $(this).hide();
          $('#RegistrarEmpleados').fadeIn(300);
      });
    }

    function verEmpleado(id,codigo_qr,nombres,apellidos,email,rut) {
      $('#id').val(id);
      $('#codigo_qr').val(codigo_qr);
      $('#nombres_carnet').text(nombres);
      $('#apellidos_carnet').text(apellidos);
      $('#email_carnet').text(email);
      $('#rut_carnet').text(rut);
      $("#img_qr").empty();
      $("#img_qr").append('<img src="{!! asset("'+ codigo_qr +'") !!}" style="width: 200px; height: 200px; border-radius: 30px !important;">');

      $('.VistaLateralEmpleados').fadeOut('slow',
        function() { 
          $(this).hide();
          $('#VerEmpleados').fadeIn(300);
      });
    }

    function editarEmpleado(id,id_usuario,nombres,apellidos,usuario,email,rut,telefono,status,direccion) {
      $('#id_edit').val(id);
      $('#id_usuario').val(id_usuario);
      $('#nombres_edit').val(nombres);
      $('#apellidos_edit').val(apellidos);
      $('#usuario_edit').val(usuario);
      $('#email_edit').val(email);
      $('#rut_edit').val(rut.substr(0,(rut.length-2)));
      $('#verificador_edit').val(rut.substr(-1,(rut.length)));
      $('#telefono_edit').val(telefono);
      if(status=="Activo") {
        $("#status_editar").empty();
        $("#status_editar").append('<option selected value="Activo">Activo</option>');
        $("#status_editar").append('<option value="Inactivo">Inactivo</option>');
      } else {
        $("#status_editar").empty();
        $("#status_editar").append('<option value="Activo">Activo</option>');
        $("#status_editar").append('<option selected value="Inactivo">Inactivo</option>');
      }
      $('#direccion_edit').val(direccion);

      $('.VistaLateralEmpleados').fadeOut('slow',
        function() { 
          $(this).hide();
      });
      $('#EditarEmpleados').fadeIn(300);
    }

    function eliminarEmpleado(id,id_usuario,id_qr){
      $('#id_EmpleadoE').val(id);
      $('#id_delete').val(id);
      $('#id_qr_delete').val(id_qr);
      $('#id_usuarioDelete').val(id_usuario);

      $('.VistaLateralEmpleados').fadeOut('slow',
        function() { 
          $(this).hide();
      });
      $('#EliminarEmpleados').fadeIn(300);
    }
  </script>
@section('scripts')
@endsection
