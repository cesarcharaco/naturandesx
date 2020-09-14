@extends('layouts.app')
@section('css')
  <title>Clientes</title>
@endsection

@section('page-title-area')
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Clientes</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('empleados.index') }}">Clientes</a></li>
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
    <div class="card bg-white shadow" style="border-radius: 30px !important;">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-12">
            <a href="#RegistrarEmpleados" onclick="RegistrarCliente()" class="btn btn-outline-primary btn-sm text-uppercase float-right">
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
                    <th>RUT</th>
                    <th>Email</th>
                    <th>status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($clientes as $key)
                    <tr>
                      <td>{!! $key->nombres !!} {!! $key->apellidos !!}</td>
                      <td>{!! $key->rut !!}</td>
                      <td>{!! $key->email !!}</td>
                      <td>{!! $key->status !!}</td>
                      <td>
                         <a href="#" class="btn btn-success btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px;" onclick="verCliente('{{$key->id}}','{{$key->qr->codigo}}','{{$key->nombres}}','{{$key->apellidos}}','{{$key->email}}','{{$key->rut}}')">
                                      <div class="ti-eye"></div>
                                    </a>

                          <a href="#" class="btn btn-warning btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px;" onclick="editarCliente('{{$key->id}}','{{$key->nombres}}','{{$key->apellidos}}','{{$key->email}}','{{$key->rut}}','{{$key->status}}')">
                            <div class="ti-pencil-alt text-white"></div>
                          </a>
                          <a href="#" class="btn btn-danger btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px;" onclick="eliminarCliente('{{$key->id}}','{{$key->qr->id}}')">
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
            <div class="VistaLateralClientes RegistrarClientes shadow" id="RegistrarClientes">
              <div class="card card-default border border-success shadow">
                <div class="card-body">
                  <form action="{{ route('clientes.store') }}" name="registro_clientes" method="POST">
                    @csrf
                        <div class="form-group">
                          <label for="nombres">Nombres</label>
                          <input type="text" class="form-control" placeholder="Ingrese nombres" id="nombres" required="required" name="nombres" value="{{ old('nombres') }}">
                          @error('nombres')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="apellidos">Apellidos</label>
                          <input type="text" class="form-control" placeholder="Ingrese apellidos" id="apellidos" required="required" name="apellidos" value="{{ old('apellidos') }}">
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" placeholder="Ingrese email" name="email" required id="email" value="{{ old('email') }}">
                          @error('email')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                          @if ($errors->has('email'))
                              <small class="form-text text-danger">
                                  {{ $errors->first('email') }}
                               </small>
                          @endif
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="rut" placeholder="Rut del residente" minlength="7" maxlength="8" id="rut_e" class="form-control" required>
                            @error('rut')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="verificador" min="1" id="verificador_e" minlength="1" maxlength="1" max="9" value="0" class="form-control" required>
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
                    <div class="form-footer pt-5 border-top">
                      <button type="submit" style="float: right;" class="btn btn-success btn-default">Registrar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="VistaLateralClientes VerClientes" id="VerClientes" style="display: none;">
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
            <div class="VistaLateralClientes EditarClientes shadow" id="EditarClientes" style="display: none;">
              <div class="card card-warning border border-warning">
                <div class="card-body">
                  <center>
                    <h3>Editar Cliente</h3>
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
                        <label for="email_edit">Email</label>
                        <input type="email" class="form-control" placeholder="Ingrese email" name="email" required id="email_edit">
                      </div>
                      <div class="form-group">
                        <label for="rut_edit">RUT</label>
                        <input type="text" class="form-control" placeholder="Ingrese RUT" name="rut" id="rut_edit" required>
                      </div>
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status_editar" name="status">
                        </select>
                      </div>
                      <div class="form-footer pt-5 border-top">
                        <input type="hidden" id="id_edit" name="id">
                        <button type="submit" style="float: right;" class="btn btn-success btn-default">Registrar</button>
                      </div>
                    </form>
                  </center>
                </div>
              </div>
            </div>
            <div class="VistaLateralClientes EliminarClientes shadow" id="EliminarClientes" style="display: none;">
              <div class="card card-danger border border-danger">
                <div class="card-body">
                    <form action="{{ route('clientes.eliminar') }}" name="eliminar_clientes" method="POST">
                      @csrf
                      <h3>¿Está realmente seguro de querer eliminar a este cliente?</h3> 
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
                        <input type="hidden" name="id_qr" id="id_qr_delete">
                        <button type="submit" class="btn btn-danger float-right">Eliminar</button>
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

    function Refrescar() {
       location.reload();
    }

    function RegistrarCliente() {
      $('.VistaLateralClientes').fadeOut('slow',
        function() { 
          $(this).hide();
          $('#RegistrarClientes').fadeIn(300);
      });
    }

    function verCliente(id,codigo_qr,nombres,apellidos,email,rut) {
      $('#id').val(id);
      $('#codigo_qr').val(codigo_qr);
      $('#nombres_carnet').text(nombres);
      $('#apellidos_carnet').text(apellidos);
      $('#email_carnet').text(email);
      $('#rut_carnet').text(rut);
      $("#img_qr").empty();
      $("#img_qr").append('<a href="{!! URL::asset("'+codigo_qr+'") !!}" download="'+codigo_qr+'"><img src="{!! URL::asset("'+ codigo_qr +'") !!}" style="width: 200px; height: 200px; border-radius: 30px !important;" download="s" onclick="Refrescar()"></a>');

      $('.VistaLateralClientes').fadeOut('slow',
        function() { 
          $(this).hide();
      });
      $('#VerClientes').fadeIn(300);
    }

    function editarCliente(id, nombres, apellidos, email, rut,status) {
      $('#id_edit').val(id);
      $('#nombres_edit').val(nombres);
      $('#apellidos_edit').val(apellidos);
      $('#email_edit').val(email);
      $('#rut_edit').val(rut);
      if(status=="Activo") {
        $("#status_editar").empty();
        $("#status_editar").append('<option selected value="Activo">Activo</option>');
        $("#status_editar").append('<option value="Inactivo">Inactivo</option>');
      } else {
        $("#status_editar").empty();
        $("#status_editar").append('<option value="Activo">Activo</option>');
        $("#status_editar").append('<option selected value="Inactivo">Inactivo</option>');
      }

      $('.VistaLateralClientes').fadeOut('slow',
        function() { 
          $(this).hide();
      });
      $('#EditarClientes').fadeIn(300);
    }

    function eliminarCliente(id,id_qr){
      $('#id_clienteE').val(id);
      $('#id_delete').val(id);
      $('#id_qr_delete').val(id_qr);


      $('.VistaLateralClientes').fadeOut('slow',
        function() { 
          $(this).hide();
      });
      $('#EliminarClientes').fadeIn(300);
    }
  </script>
@section('scripts')
@endsection
