@extends('layouts.app')
@section('css')
	<title>Reportes</title>
@endsection

@section('content-header')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Reportes</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Reportes</a></li>
          <li class="breadcrumb-item active">Filtro</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
  <div class="container-fluid">
    <div class="card bg-white shadow" style="border-radius: 30px !important;">
      <div class="card-body">
        <h4 class="header-title mb-3">Reportes</h4>
        <div class="mb-3">
        	<form action="{{ route('mostrar_reporte') }}" name="mostrar_reportes" method="POST">
	            @csrf
	            <div class="form-group">
	            	<label>Repartidores</label>
	            	<select class="choices form-select multiple-remove" multiple="multiple" name="id_repartidor[]">
                        <optgroup label="Repartidores">
                            @foreach($repartidores as $key)
			          			<option value="{{$key->id}}" style="color: black !important;">{{$key->nombres}} {{$key->apellidos}}.- {{$key->rut}}</option>
			          		@endforeach()
                        </optgroup>
                    </select>
	            </div>
	          	
	        	<center>
		          	<div class="row">
			          	<div class="col-lg-6">
			          		<div class="form-group">
					          	<label>Desde</label>
					          	<input type="date" max="<?php echo date('Y-m-d');?>" class="form-control" name="desde" required="required">
					         </div>
			          	</div>
			          	<div class="col-lg-6">
			          		<div class="form-group">
					          	<label>Hasta</label>
					          	<input type="date" min="<?php echo date('Y-m-d');?>" class="form-control" name="hasta" required="required">
					        </div>
			          	</div>
		          	</div>
	        	</center>
		        <div class="custom-control custom-checkbox">
		            <input name="cancelado" type="checkbox" class="custom-control-input" id="customCheck1" value="1">
		            <label class="custom-control-label" for="customCheck1">Cancelado</label>
		        </div>
		        <div class="custom-control custom-checkbox">
		            <input name="no_cancelado" type="checkbox" class="custom-control-input" id="customCheck2" value="1">
		            <label class="custom-control-label" for="customCheck2">No Cancelado</label>
		        </div>
			    <center>
			    	<button type="submit" class="btn btn-success">Generar</button>
			    </center>
			</form>
        </div>
      </div>
    </div>
  </div>
@endsection

  <script type="text/javascript">

    
  </script>
@section('scripts')
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
</script>
@endsection
