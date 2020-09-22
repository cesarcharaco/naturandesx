@extends('layouts.app')
@section('css')
	<title>Reportes</title>
	<!-- Include Choices CSS -->
	<link rel="stylesheet" href="{{ asset('plugins/choices.js/choices.min.css') }}" />
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
    <div class="card bg-white shadow">
      <div class="card-body">
        <h4 class="header-title mb-3">Reportes</h4>
        <div class="card card-primary card-outline">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#reporte_repartidor" data-toggle="tab">Reportes de repartidores</a></li>
              <li class="nav-item"><a class="nav-link" href="#reporte_cliente" data-toggle="tab">Reportes de clientes</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <p class="text-center mb-3">Todos los campos (<b style="color: red;">*</b>) son requeridos.</p>
              <div class="active tab-pane" id="reporte_repartidor">
                <form action="{{ route('mostrar_reporte') }}" name="mostrar_reportes" method="POST">
		        	<div class="row">
	            		@csrf
			            <div class="col-lg-3">
				            <div class="form-group">
				            	<label>Repartidor</label>
				            	<select class="form-control" name="id_repartidor[]" required="required">
				            		<option value="">Seleccione un cliente...</option>
		                            @foreach($repartidores as $key)
					          			<option value="{{$key->id}}" style="color: black !important;">{{$key->nombres}} {{$key->apellidos}}.- {{$key->rut}}</option>
					          		@endforeach()
			                    </select>
				            </div>	            	
			            </div>
			            <div class="col-lg-3">
			          		<div class="form-group">
					          	<label>Desde</label>
					          	<input type="date" max="<?php echo date('Y-m-d');?>" class="form-control" name="desde" required="required">
					         </div>	            	
			            </div>
			            <div class="col-lg-3">
			          		<div class="form-group">
					          	<label>Hasta</label>
					          	<input type="date" max="<?php echo date('Y-m-d');?>" class="form-control" name="hasta" required="required">
					        </div>	            	
			            </div>
			            <div class="col-lg-3">
			            	<label for="">status</label>
					        <div class="custom-control custom-checkbox">
					            <input name="cancelado" type="checkbox" class="custom-control-input" id="customCheck1" value="1">
					            <label class="custom-control-label" for="customCheck1">Cancelado</label>
					        </div>
					        <div class="custom-control custom-checkbox">
					            <input name="no_cancelado" type="checkbox" class="custom-control-input" id="customCheck2" value="1">
					            <label class="custom-control-label" for="customCheck2">No Cancelado</label>
					        </div>		            	
			            </div>
		        	</div>
				    <center>
				    	<button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Generar</button>
				    </center>
				</form>
				<hr>
		        <div class="row">
					<div class="col-lg-12 mt-4">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">
								 	<i class="fas fa-chart-pie mr-1"></i>Resultados
								</h3>
								<div class="card-tools">
									<ul class="nav nav-pills ml-auto">
									    <li class="nav-item">
									      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Gráficas</a>
									    </li>
									    <li class="nav-item">
									      <a class="nav-link" href="#sales-chart" data-toggle="tab">Tabla</a>
									    </li>
								  	</ul>
								</div>
							</div><!-- /.card-header -->
				             <div class="card-body">
				                <div class="tab-content p-0">
				                  	<!-- Morris chart - Sales -->
				                  	<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
				                  		<div class="row">
				                  			<div class="col-lg-6">
				                  				<div class="card card-default color-palette-box">
										          	<div class="card-header">
										            	<h3 class="card-title text-center"> <i class="fas fa-tag"></i> Gráfica de barra</h3>
										        	</div>
											        <div class="card-body">
								                     	<div style="width:100%;">
													    	{!! $chartjs->render() !!}
														</div>
											        </div>
										        </div>
				                  			</div>
				                  			<div class="col-lg-6">
				                  				<div class="card card-default color-palette-box">
										          	<div class="card-header">
										            	<h3 class="card-title text-center"> <i class="fas fa-tag"></i> Gráfica de torta</h3>
										        	</div>
											        <div class="card-body">
								                     	<div style="width:100%;">
													    	{!! $chartjs1->render() !!}
														</div>
											        </div>
										        </div>
				                  			</div>
				                  		</div>
				                   	</div>
					                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
					                	<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>Repartidor</th>
													<th>Cliente</th>
													<th>Promoción</th>
													<th>Cantidad</th>
													<th>Monto total</th>
													<th>Status</th>
													<th>Fecha</th>
												</tr>
											</thead>
											<tbody>
												@foreach($e_ventas as $key)
												<tr>
													<td>{{$key->empleado->nombres}} {{$key->empleado->apellidos}}</td>
													<td>{{$key->venta->cliente->nombres}} {{$key->venta->cliente->apellidos}}</td>
													<td>{{$key->venta->promociones->promocion}}</td>
													<td>{{$key->venta->cantidad}}</td>
													<td>{{$key->venta->monto_total}}</td>
													<td>{{$key->status}}</td>
													<td>{{$key->created_at}}</td>
												</tr>
												@endforeach
											</tbody>
										</table>
					                </div>  
				                </div>
				             </div><!-- /.card-body -->
			            </div>
					</div>
				</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="reporte_cliente">
                <form action="{{ route('mostrar_reporte') }}" name="mostrar_reportes" method="POST">
		        	<div class="row">
	            		@csrf
			            <div class="col-lg-3">
				            <div class="form-group">
				            	<label>Clientes</label>
				            	<select class="form-control" name="id_repartidor[]" required="required">
				            		<option value="">Seleccione un cliente...</option>
		                            @foreach($clientes as $key)
					          			<option value="{{$key->id}}" style="color: black !important;">{{$key->nombres}} {{$key->apellidos}}.- {{$key->rut}}</option>
					          		@endforeach()
			                    </select>
				            </div>	            	
			            </div>
			            <div class="col-lg-3">
			          		<div class="form-group">
					          	<label>Desde</label>
					          	<input type="date" max="<?php echo date('Y-m-d');?>" class="form-control" name="desde" required="required">
					         </div>	            	
			            </div>
			            <div class="col-lg-3">
			          		<div class="form-group">
					          	<label>Hasta</label>
					          	<input type="date" max="<?php echo date('Y-m-d');?>" class="form-control" name="hasta" required="required">
					        </div>	            	
			            </div>
			            <div class="col-lg-3">
			            	<label for="">status</label>
					        <div class="custom-control custom-checkbox">
					            <input name="cancelado" type="checkbox" class="custom-control-input" id="customCheck1" value="1">
					            <label class="custom-control-label" for="customCheck1">Cancelado</label>
					        </div>
					        <div class="custom-control custom-checkbox">
					            <input name="no_cancelado" type="checkbox" class="custom-control-input" id="customCheck2" value="1">
					            <label class="custom-control-label" for="customCheck2">No Cancelado</label>
					        </div>		            	
			            </div>
		        	</div>
				    <center>
				    	<button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Generar</button>
				    </center>
				</form>
				<hr>
		        <div class="row">
					<div class="col-lg-12 mt-4">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">
								 	<i class="fas fa-chart-pie mr-1"></i>Resultados
								</h3>
								<div class="card-tools">
									<ul class="nav nav-pills ml-auto">
									    <li class="nav-item">
									      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Gráficas</a>
									    </li>
									    <li class="nav-item">
									      <a class="nav-link" href="#sales-chart" data-toggle="tab">Tabla</a>
									    </li>
								  	</ul>
								</div>
							</div><!-- /.card-header -->
				             <div class="card-body">
				                <div class="tab-content p-0">
				                  	<!-- Morris chart - Sales -->
				                  	<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
				                  		<div class="row">
				                  			<div class="col-lg-6">
				                  				<div class="card card-default color-palette-box">
										          	<div class="card-header">
										            	<h3 class="card-title"> <i class="fas fa-tag"></i> Gráfica de barra</h3>
										        	</div>
											        <div class="card-body">
								                     	<div style="width:100%;">
													    	{!! $chartjs->render() !!}
														</div>
											        </div>
										        </div>
				                  			</div>
				                  			<div class="col-lg-6">
				                  				<div class="card card-default color-palette-box">
										          	<div class="card-header">
										            	<h3 class="card-title"> <i class="fas fa-tag"></i> Gráfica de torta</h3>
										        	</div>
											        <div class="card-body">
								                     	<div style="width:100%;">
													    	
														</div>
											        </div>
										        </div>
				                  			</div>
				                  		</div>
				                   	</div>
					                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
					                	<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>Cliente</th>
													<th>Promoción</th>
													<th>Cantidad</th>
													<th>Monto total</th>
													<th>Fecha</th>
												</tr>
											</thead>
											<tbody>
												@foreach($ventas as $key)
												<tr>
													<td>{{$key->cliente->nombres}} {{$key->cliente->apellidos}}</td>
													<td>{{$key->promociones->promocion}}</td>
													<td>{{$key->cantidad}}</td>
													<td>{{$key->monto_total}}</td>
													<td>{{$key->created_at}}</td>
												</tr>
												@endforeach
											</tbody>
										</table>
					                </div>  
				                </div>
				             </div><!-- /.card-body -->
			            </div>
					</div>
				</div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<!-- Include Choices JavaScript -->
<script src="{{ asset('plugins/choices.js/choices.min.js') }}"></script>
<!-- DataTables -->
<script src=" {{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src=" {{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src=" {{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src=" {{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/line-chart.js') }}"></script>
@endsection
