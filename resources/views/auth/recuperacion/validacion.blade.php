@extends('layouts.app_login')

@section('content')
<div class="col-md-4 mx-auto">
	<div class="login-area">
	  <div class="container">
	    <div class="login-box ptb--100">
	      <form method="POST" action="{{ route('validar') }}">
	        @csrf
	        <div class="login-form-head">
	            <h4>Recuperación de contraseña con email</h4>
	        </div>
	        <div class="login-form-body">
	            <input type="hidden" value="{{$opcion}}" name="opcion">
				<input type="hidden" value="{{$id_usuario}}" name="id_usuario">
		    	@if($opcion == 1)
		            <div class="form-group row">
		                <div class="col-md-12">
		                    <div class="form-group">
		                        <label class="col-md-12 col-form-label">Transcriba el código de 8 dígitos enviado a su correo</label>
		                        <input type="text" name="codigo" required class="form-control input" placeholder="Código">
		                    </div>
		                </div>
		            </div>
		            <div class="submit-btn-area">
	                    <button id="form_submit" type="submit" class="btn btn-success btn-block" style="background: #010573; color: white;">Verificar <i class="ti-arrow-right"></i></button>
	                </div>
		    	@else
		    		<div class="row justify-content-center">
			    		<div class="col-md-6" id="pregunta">
		                    <div class="form-group">
		                        <button class="btn btn-warning" disabled style=" border-radius: 20%;">
		                            <img src="{{ asset('img/list.png') }}" style="width: 100%; height: 100%;">
		                        </button>
		                        <label class="text-white">Preguntas de seguridad</label>
		                    </div>
		                </div>
		    		</div>
		    		<div id="pregunta2">
	                	@php $num=0; @endphp
	                	@foreach($preguntas as $key)
		                    <div class="border border-warning shadow mt-3 card-black" style="border-radius: 10px !important;">
		                    	<span class="bg-success text-white" style="float: right; margin-right:  -30px !important; margin-top: -30px !important; border-radius: 30px; height: 40px; width: 40px;">
		                    		<center>
		                    			<h2>{{$num=$num+1}}</h2>
		                    		</center>
		                    	</span>
		                        <div class="card-body">
			                            <div class="form-group">
			                                <h3 class="text-white">{{$key}}</h3>
			                            </div>
			                            <div class="form-group">
			                                <label>Repuesta</label>
			                                <input type="password" name="respuesta{{$num}}" class="form-control" required>
			                            </div>
		                        </div>
		                    </div>
		                @endforeach
	                    <div class="submit-btn-area">
	                    	<button id="form_submit" type="submit" class="btn btn-success btn-block" style="background: #010573; color: white;">Verificar <i class="ti-arrow-right"></i></button>
	                	</div>
	                </div>
		    	@endif
	            <div class="form-footer text-center mt-5">
	                <p class="text-muted">Volver <a href="{{ url('/') }}" class="text-center" style="color: #010573;">Iniciar sesión</a></p>
	            </div>
	        </div>
	      </form>
	    </div>
	  </div>
	</div>
</div>
@endsection

<script type="text/javascript">
    
</script>
