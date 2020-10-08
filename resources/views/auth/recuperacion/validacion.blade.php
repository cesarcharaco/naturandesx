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
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-12 col-form-label">Transcriba el código de 8 dígitos enviado a su correo</label>
                        <input type="text" name="codigo" required class="form-control input" placeholder="Código">
                    </div>
                </div>
            </div>
            <center>
            	<button type="submit" class="btn btn-success">Aceptar</button>
            </center>
        </form>
    </div>
</div>
@endsection

<script type="text/javascript">
    
</script>
