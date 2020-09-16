@extends('layouts.app')
@section('css')
  <title>Reportes</title>
@endsection

@section('page-title-area')
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Reportes</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('empleados.index') }}">Reportes</a></li>
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
        <h4 class="header-title mb-3">Reportes</h4>
        <div class="mb-3">
        	<form action="{{ route('mostrar_reporte') }}" name="mostrar_reportes" method="POST">
	            @csrf
	          	<div class="form-group">
		          	<label>Repartidores</label>
		          	<select class="form-control select2" multiple="multiple" name="id_repartidores[]" required="required">
		          		@foreach($repartidores as $key)
		          			<option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}}.- {{$key->rut}}</option>
		          		@endforeach()
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
@endsection
