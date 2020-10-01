@extends('layouts.app')
@section('css')
  <title>Repartidores</title>
  <link rel="stylesheet" href="{{ asset('plugins/parsleyjs/parsley.css') }}">
@endsection

@section('content-header')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Repartidores</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Repartidores</a></li>
          <li class="breadcrumb-item active" style="color:black;">Registros</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-12">
            <a class="btn btn-primary btn-sm text-uppercase float-right text-white" id="btnRegistrar" data-toggle="collapse" href="#RegistrarEmpleado" role="button" aria-expanded="false" aria-controls="RegistrarEmpleado" onclick="RegistrarEmpleado()">
              <strong>Registrar</strong>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            @include('empleados.layouts.create')
            @include('empleados.layouts.show')
            @include('empleados.layouts.edit')
            @include('empleados.layouts.cambiar_clave')
            @include('empleados.layouts.delete')
          </div>
        </div>
        <div class="row" style="position: relative !important;">
          <div class="col-md-12" style="position: relative !important;">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
              <table id="example1" class="table table-bordered table-hover table-striped dataTable dtr-inline collapsed border border-orange" style="width: 100% !important;">
                  <thead class="text-capitalize bg-primary">
                    <tr class="border-orange">
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
                        @if(Auth::user()->tipo_usuario == 'Admin')
                          @if($key->usuario->tipo_usuario!="Admin")
                          <tr>
                              <td>{!! $key->nombres !!} {!! $key->apellidos !!}</td>
                              <td>{!! $key->rut !!}</td>
                              <td>{!! $key->telefono !!}</td>
                              <td>
                                @if($key->usuario->email == null)
                                  No posee
                                @else  
                                  {!! $key->usuario->email !!}
                                @endif
                              </td>
                              <td>{!! $key->usuario->usuario !!}</td>
                              @if( $key->status == 'Activo')
                                <td class="text-success"><strong>{!! $key->status !!}</strong></td>
                              @else
                                <td class="text-danger"><strong>{!! $key->status !!}</strong></td>
                              @endif
                              <td>                                
                                <a data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" class="btn btn-success btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px;" onclick="verEmpleado('{{$key->id}}','{{$key->qr->codigo}}','{{$key->nombres}}','{{$key->apellidos}}','{{$key->usuario->usuario}}','{{$key->usuario->email}}','{{$key->rut}}')">
                                    <i class="fa fa-fw fa-eye text-white"></i>
                                </a>
                                <a data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3" class="btn btn-warning btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px;" onclick="editarEmpleado('{{$key->id}}','{{$key->usuario->id}}','{{$key->nombres}}','{{$key->apellidos}}','{{$key->usuario->usuario}}','{{$key->usuario->email}}','{{$key->rut}}','{{$key->telefono}}','{{$key->status}}','{{$key->direccion}}')">
                                    <i class="fa fa-fw fa-edit text-white"></i>
                                  </a>

                                <a data-toggle="collapse" data-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample5" class="btn btn-default btn-sm boton-tabla border border-warning" style="border-radius: 5px;" style="border-radius: 5px;" onclick="cambiarClaveRepartidor('{{$key->id}}','{{$key->usuario->id}}')">
                                  <div class="fa fa-key"></div>
                                </a>

                                  <a data-toggle="collapse" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample4" class="btn btn-danger btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px;" onclick="eliminarEmpleado('{{$key->id}}','{{$key->usuario->id}}','{{$key->qr->id}}')">
                                      <i class="fa fa-fw fa-trash text-white"></i>
                              </td>
                          </tr>
                          @endif
                        @endif
                      @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

  <script type="text/javascript">
    function RegistrarEmpleado() {
      $('#btnRegistrar').fadeOut('fast');
      $('#example1_wrapper').fadeOut('fast');
    }

    function verEmpleado(id,codigo_qr,nombres,apellidos,email,rut) {
      $('#example1_wrapper').fadeOut('fast');
      $('#btnRegistrar').fadeOut('fast');
      $('#id').val(id);
      $('#codigo_qr').val(codigo_qr);
      $('#nombres_carnet').text(nombres);
      $('#apellidos_carnet').text(apellidos);
      $('#email_carnet').text(email);
      $('#rut_carnet').text(rut);
      $("#img_qr").empty();
      $("#img_qr").append('<img src="{!! asset("'+ codigo_qr +'") !!}" style="width: 200px; height: 200px; border-radius: 30px !important;">');
    }

    function editarEmpleado(id,id_usuario,nombres,apellidos,usuario,email,rut,telefono,status,direccion) {
      var opcion = $('#nameRegistrar').val();
      $('#example1_wrapper').fadeOut('fast');
      $('#btnRegistrar').fadeOut('fast');
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



    }

    function cambiarClaveRepartidor(id,id_usuario) {
      $('#example1_wrapper').fadeOut('fast');
      $('#btnRegistrar').fadeOut('fast');
      $('#id_repartidor_pass').val(id);
      $('#id_usuario_cc').val(id_usuario);
    }

    function eliminarEmpleado(id,id_usuario,id_qr){
      $('#example1_wrapper').fadeOut('fast');
      $('#btnRegistrar').fadeOut('fast');
      $('#id_EmpleadoE').val(id);
      $('#id_delete').val(id);
      $('#id_qr_delete').val(id_qr);
      $('#id_usuarioDelete').val(id_usuario);
    }

    function cerrar(opcion) {
      $('#example1_wrapper').fadeIn('fast');
      $('#nameRegistrar').val(1);
      $('#btnRegistrar').show();
    }
  </script>
@section('scripts')
<script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('plugins/parsleyjs/i18n/es.js') }}"></script>
@endsection
