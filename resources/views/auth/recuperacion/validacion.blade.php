@extends('layouts.app_login')

@section('content')
<div class="login-box card-black">
    <div class="card-body">

        {{--<h2 align="center" class="">{{ __('Reset Password') }}</h2>--}}
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('validar') }}">
            @csrf
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
	            <center>
	            	<button type="submit" class="btn btn-success">Verificar</button>
	            </center>
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
                    <center>
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">
                                    Verificar
                                </button>
                            </div>
                        </div>
                    </center>
                </div>
	    	@endif
        </form>
        <div class="form-footer text-center mt-5">
            <p class="text-white">Volver
                <a href="{{ route('login') }}">Iniciar sesión</a>
            </p>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    
</script>
