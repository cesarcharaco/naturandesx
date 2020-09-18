@extends('layouts.app')

@section('css')
  <title>Repartidores</title>
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
          <li class="breadcrumb-item active">Consulta</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection

@section('content')
  <input type="hidden" id="nameRegistrar" value="1">
  <div class="container-fluid">
    <div class="card bg-white">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-12">
            <a class="btn btn-outline-primary btn-sm text-uppercase float-right" data-toggle="collapse" href="#RegistrarEmpleado" role="button" aria-expanded="false" aria-controls="RegistrarEmpleado" onclick="RegistrarEmpleado()">
              <span id="Registrar">Registrar</span>
            </a>
          </div>
        </div>
        @include('empleados.layouts.create')
        @include('empleados.layouts.show')
        @include('empleados.layouts.edit')
        @include('empleados.layouts.delete')
        <div class="row">
          <div class="col-md-12" id="columna" style="position: relative !important;">
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
          <div id="columna2" style="position: relative !important;">
           
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

  <script type="text/javascript">
    function RegistrarEmpleado() {
      var opcion = $('#nameRegistrar').val();
      if (opcion == 1) {
        $('#Registrar').html('Cerrar');
        $('#nameRegistrar').val(2);
      }else{
        $('#Registrar').html('Registrar');
        $('#nameRegistrar').val(1);
      }
      
    }

    function verEmpleado(id,codigo_qr,nombres,apellidos,email,rut) {
      $('#columna').removeAttr('class',false);
      $('#columna').attr('class','col-md-8');
      $('#columna2').attr('class','col-md-4');
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
      $('#columna').removeAttr('class',false);
      $('#columna').attr('class','col-md-8');
      $('#columna2').attr('class','col-md-4');
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
      $('#columna').removeAttr('class',false);
      $('#columna').attr('class','col-md-8');
      $('#columna2').attr('class','col-md-4');
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
