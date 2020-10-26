@extends('layouts.app')
@section('css')
  <title>Clientes</title>
  <link rel="stylesheet" href="{{ asset('plugins/parsleyjs/parsley.css') }}">
@endsection

@section('content-header')
<input type="hidden" id="nameRegistrar" value="1">
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Clientes</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Clientes</a></li>
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
        <div class="row justify-content-center">
          <div class="col-md-12">
            @include('clientes.layouts.create')
            @include('clientes.layouts.show')
            @include('clientes.layouts.edit')
            @include('clientes.layouts.cambiar_clave')
            @include('clientes.layouts.delete')
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-12">
            <a class="btn btn-primary btn-sm text-uppercase float-right text-white" id="btnRegistrar" data-toggle="collapse" href="#RegistrarCliente" role="button" aria-expanded="false" aria-controls="RegistrarCliente" onclick="RegistrarCliente()">
              <strong>Registrar</strong>
            </a>
          </div>
        </div>
        <div class="row">
           <div class="col-md-12" style="position: relative !important;">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4" style="width: 100% !important;">
              <table id="example1" class="table table-bordered table-hover table-striped dataTable dtr-inline collapsed border border-orange" style="width: 100% !important;">
                <thead class="text-capitalize bg-primary">
                  <tr class="border-orange">
                    <th>Nombres</th>
                    <th>RUT</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>status</th>
                    @if(Auth::user()->tipo_usuario == 'Admin' )
                      <th></th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @foreach($clientes as $key)
                    <tr>
                      <td>{!! $key->nombres !!} {!! $key->apellidos !!}</td>
                      <td>{!! $key->rut !!}</td>
                      <td>{!! $key->usuario->usuario !!}</td>
                      <td>
                        @if($key->usuario->email=="")
                          No posee
                        @else  
                          {!! $key->usuario->email !!}
                        @endif
                      </td>
                      <td>{!! $key->telefono !!}</td>
                      
                        <td>
                          @if($key->status == 'Activo')
                            <span class="text-success"><strong>{!! $key->status !!}</strong></span>
                          @elseif($key->status == 'Sin Aprobar')
                            <span class="text-warning"><strong>{!! $key->status !!}</strong></span>
                          @else
                            <span class="text-danger"><strong>{!! $key->status !!}</strong></span>
                          @endif
                        </td>
                      @if(Auth::user()->tipo_usuario == 'Admin' )
                        <td>
                           <a data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" class="btn btn-success btn-sm boton-tabla shadow botonesEditEli" style="border-radius: 5px;" style="border-radius: 5px;" onclick="verCliente('{{$key->id}}','{{$key->qr->codigo}}','{{$key->nombres}}','{{$key->apellidos}}','{{$key->usuario->usuario}}','{{$key->usuario->email}}','{{$key->rut}}')">
                              <div class="far fa-eye text-white"></div>
                            </a>

                            <a data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3" class="btn btn-warning btn-sm boton-tabla" style="border-radius: 5px;" onclick="editarCliente('{{$key->id}}','{{$key->usuario->id}}','{{$key->nombres}}','{{$key->apellidos}}','{{$key->usuario->usuario}}','{{$key->usuario->email}}','{{$key->telefono}}','{{$key->rut}}','{{$key->status}}')">
                              <div class="far fa-edit text-white"></div>
                            </a>

                            <a data-toggle="collapse" data-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample5" class="btn btn-default btn-sm boton-tabla border border-warning" style="border-radius: 5px;" style="border-radius: 5px;" onclick="cambiarClaveCliente('{{$key->id}}','{{$key->usuario->id}}')">
                              <div class="fa fa-key"></div>
                            </a>

                            <a data-toggle="collapse" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample4" class="btn btn-danger btn-sm boton-tabla" style="border-radius: 5px;" onclick="eliminarCliente('{{$key->id}}','{{$key->usuario->id}}','{{$key->qr->id}}')">
                                <div class="far fa-trash-alt text-white"></div>
                            </a>
                        </td>
                      @endif
                    </tr>
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

    function VerR(opcion) {
      $('#Inputrespuesta').removeAttr('type',false);
      $('#Inputrespuesta').attr('type','text');
    }
    function Refrescar() {
       location.reload();
    }

    function RegistrarCliente() {
      $('#btnRegistrar').fadeOut('fast');
      $('#example1_wrapper').fadeOut('fast');
    }

    function verCliente(id,codigo_qr,nombres,apellidos,usuario,email,rut) {
      $('#example1_wrapper').fadeOut('fast');
      $('#btnRegistrar').fadeOut('fast');
      $('#id').val(id);
      $('#codigo_qr').val(codigo_qr);
      $('#nombres_carnet').text(nombres);
      $('#apellidos_carnet').text(apellidos);
      $('#usuario').text(usuario);
      $('#email_carnet').text(email);
      $('#rut_carnet').text(rut);
      $("#img_qr").empty();
      $("#img_qr").append('<a href="{!! URL::asset("'+codigo_qr+'") !!}" download="'+codigo_qr+'"><img src="{!! URL::asset("'+ codigo_qr +'") !!}" style="width: 200px; height: 200px; border-radius: 30px !important;" download="s" onclick="Refrescar()"></a>');
    }

    function editarCliente(id, id_usuario,nombres, apellidos,usuario ,email, telefono, rut,status) {
      $('#example1_wrapper').fadeOut('fast');
      $('#btnRegistrar').fadeOut('fast');
      $('#id_edit').val(id);
      $('#id_usuario_edit').val(id_usuario);
      $('#nombres_edit').val(nombres);
      $('#apellidos_edit').val(apellidos);
      $('#usuario_edit').val(usuario);
      $('#email_edit').val(email);
      $('#telefono_edit').val(telefono);
      $('#rut_edit').val(rut.substr(0,(rut.length-2)));
      $('#verificador_edit').val(rut.substr(-1,(rut.length)));
      if(status=="Activo") {
        $("#status_editar").empty();
        $("#status_editar").append('<option selected value="Activo">Activo</option>');
        $("#status_editar").append('<option value="Inactivo">Inactivo</option>');
        $("#status_editar").append('<option value="Sin Aprobar">Sin Aprobar</option>');
      } else if(status=="Inactivo") {
        $("#status_editar").empty();
        $("#status_editar").append('<option value="Activo">Activo</option>');
        $("#status_editar").append('<option selected value="Inactivo">Inactivo</option>');
        $("#status_editar").append('<option value="Sin Aprobar">Sin Aprobar</option>');
      } else if(status=="Sin Aprobar") {
        $("#status_editar").empty();
        $("#status_editar").append('<option value="Activo">Activo</option>');
        $("#status_editar").append('<option value="Inactivo">Inactivo</option>');
        $("#status_editar").append('<option selected value="Sin Aprobar">Sin Aprobar</option>');
      }
    }

    function cambiarClaveCliente(id,id_usuario) {
      $('#example1_wrapper').fadeOut('fast');
      $('#btnRegistrar').fadeOut('fast');
      $('#id_cliente_pass').val(id);
      $('#id_usuario_cc').val(id_usuario);
    }

    function eliminarCliente(id,id_usuario,id_qr){
      $('#example1_wrapper').fadeOut('fast');
      $('#btnRegistrar').fadeOut('fast');
      $('#id_clienteE').val(id);
      $('#id_delete').val(id);
      $('#id_usuario_delete').val(id_usuario);
      $('#id_qr_delete').val(id_qr);
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
