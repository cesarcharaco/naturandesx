@extends('layouts.app')
@section('css')
@endsection

@section('content')
<div class="content">             
  <div class="breadcrumb-wrapper">
    <h1>Ventas Pendientes por Pagar</h1>           
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb p-0">
        <li class="breadcrumb-item">
          <a href="index.html"><span class="mdi mdi-home"></span></a>
        </li>
        <li class="breadcrumb-item">Ventas</li>
        <li class="breadcrumb-item" aria-current="page">Pendientes por Pagar</li>
      </ol>
    </nav>
  </div>

  <div class="card bg-white shadow" style="border-radius: 30px !important;">
    <div class="card-body">
        
      <div class="row">
        <div class="col-md-8" style="position: relative !important;">
          <table class="table dataTable data-table-basic table-curved table-striped tabla-estilo" style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>RUT</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach($repartidores as $key)
              <tr>
                <td>{{$num++}}</td>
                <td>{{$key->nombres}}</td>
                <td>{{$key->apellidos}}</td>
                <td>{{$key->rut}}</td>
                
              </tr>
              <tr>

                <ul>
                  @foreach($key->ventas as $key2)
                  <li></li>
                  @endforeach
                </ul>
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
