@extends('layouts.app')
@section('css')
@endsection

@section('content')
<div class="content">             
  <div class="breadcrumb-wrapper">
    <h1>Usuarios</h1>           
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb p-0">
        <li class="breadcrumb-item">
          <a href="index.html"><span class="mdi mdi-home"></span></a>
        </li>
        <li class="breadcrumb-item">Usuarios</li>
        <li class="breadcrumb-item" aria-current="page">Usuarios registrados</li>
      </ol>
    </nav>
  </div>

  <div class="card bg-white shadow" style="border-radius: 30px !important;">
    <div class="card-body">
        <a href="#RegistrarUsers" onclick="RegistrarUser()" class="btn btn-outline-primary btn-sm text-uppercase float-right">
          <i class=" mdi mdi-link mr-1"></i>  Registrar
        </a>
        <br><br>
      <div class="row">
        <div class="col-md-8" style="position: relative !important;">
          <table class="table dataTable data-table-basic table-curved table-striped tabla-estilo" style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>RUT</th>
                <th>status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($Users as $key)
              <tr>
                <td>{{$num++}}</td>
                <td>{{$key->nombres}}</td>
                <td>{{$key->apellidos}}</td>
                <td>{{$key->rut}}</td>
                <td>{{$key->status}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="col-md-4" style="position: relative !important;">
          <div class="VistaLateralUsers RegistrarUsers shadow" id="RegistrarUsers">
            <div class="card card-default">
              <div class="card-body">
                <form action="{{ route('Users.store') }}" name="registro_Users" method="POST">
                  @csrf
                      <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" placeholder="Ingrese nombres" id="nombres" required="required" name="nombres">
                      </div>
                      <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" placeholder="Ingrese apellidos" id="apellidos" required="required" name="apellidos">
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Ingrese email" name="email" required id="email">
                      </div>
                      <div class="form-group">
                        <label for="rut">RUT</label>
                        <input type="text" class="form-control" placeholder="Ingrese RUT" name="rut" id="rut" required>
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
          <div class="VistaLateralUsers VerUsers shadow" id="VerUsers">
            
          </div>
          <div class="VistaLateralUsers EditarUsers shadow" id="EditarUsers">
            <div class="card card-primary border border-primary">
              <div class="card-body">
                <form action="{{ route('Users.store') }}" name="registro_Users" method="POST">
                  @csrf
                      <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" placeholder="Ingrese nombres" id="nombres" required="required" name="nombres">
                      </div>
                      <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" placeholder="Ingrese apellidos" id="apellidos" required="required" name="apellidos">
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Ingrese email" name="email" required id="email">
                      </div>
                      <div class="form-group">
                        <label for="rut">RUT</label>
                        <input type="text" class="form-control" placeholder="Ingrese RUT" name="rut" id="rut" required>
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
          <div class="VistaLateralUsers EliminarUsers shadow" id="EliminarUsers">
            <div class="card card-primary border border-primary">
              <div class="card-body">
                <form action="{{ route('Users.store') }}" name="registro_Users" method="POST">
                  @csrf
                      <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" placeholder="Ingrese nombres" id="nombres" required="required" name="nombres">
                      </div>
                      <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" placeholder="Ingrese apellidos" id="apellidos" required="required" name="apellidos">
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Ingrese email" name="email" required id="email">
                      </div>
                      <div class="form-group">
                        <label for="rut">RUT</label>
                        <input type="text" class="form-control" placeholder="Ingrese RUT" name="rut" id="rut" required>
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
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

  <script type="text/javascript">
    function RegistrarUser() {
      $('.VistaLateralUsers').fadeOut('slow',
        function() { 
          $(this).hide();
          $('#RegistrarUsers').fadeIn(300);
      });
    }

    function verUser(id) {
      $('.VistaLateralUsers').fadeOut('slow',
        function() { 
          $(this).hide();
          $('#VerUsers').fadeIn(300);
      });
    }

    function editarUser(argument) {
      $('.VistaLateralUsers').fadeOut('slow',
        function() { 
          $(this).hide();
          $('#EditarUsers').fadeIn(300);
      });
    }

    function eliminarUser(id){
      $('.VistaLateralUsers').fadeOut('slow',
        function() { 
          $(this).hide();
          $('#EliminarUsers').fadeIn(300);
      });
    }
  </script>
@section('scripts')
@endsection
