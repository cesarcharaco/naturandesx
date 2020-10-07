@extends('layouts.app_login')

@section('content')
<div class="login-box card-black">
    <div class="card-body">
        <h2 align="center" class="mb-4">¿Cómo desea reestablecer su contraseña?</h2>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row justify-content-center">
            @if(!is_null($pregunta))
                <div class="col-md-6" id="contactar">
                    <div class="form-group">
                        <button class="btn btn-success" onclick="vista(1)" style=" border-radius: 20%;">
                            <img src="{{ asset('img/user.png') }}" style="width: 100%; height: 100%;">
                        </button>
                        <label class="text-white">Contactar con Administrador</label>
                    </div>
                </div>
                <div class="col-md-6" id="pregunta">
                    <div class="form-group">
                        <button class="btn btn-warning" onclick="vista(2)" style=" border-radius: 20%;">
                            <img src="{{ asset('img/list.png') }}" style="width: 100%; height: 100%;">
                        </button>
                        <label class="text-white">Pregunta de seguridad</label>
                    </div>
                </div>
            @else
                <div class="col-md-6" id="contactar">
                    <div class="form-group">
                        <button class="btn btn-success" style=" border-radius: 20%;">
                            <img src="{{ asset('img/user.png') }}" style="width: 100%; height: 100%;">
                        </button>
                        <label class="text-white">Contactar con Administrador</label>
                    </div>
                </div>
                <div class="col-md-6" id="pregunta">
                    <div class="form-group">
                        <button class="btn btn-default" onclick="vista(2)" style=" border-radius: 20%;" disabled="">
                            <img src="{{ asset('img/list.png') }}" style="width: 100%; height: 100%;">
                        </button>
                        <label class="text-white">No posee pregunta de seguridad</label>
                    </div>
                </div>
            @endif
        </div>

        <form method="POST" action="{{ route('password.reset') }}" name="reestablecer_contraseña">
            @csrf
            @if(!is_null($pregunta))
                <div id="contactar2" style="display: none;">
                    <div class="border border-success shadow" style="border-radius: 20px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Comuníquese con el Administrador</label>
                                <label>Teléfono</label>
                                <p class="text-white">+522221297</p>
                                <label>Correo</label>
                                <p class="text-white">{{$admin->email}}</p>
                            </div>
                            {{--<div class="form-group">
                                <label>Enviar mensaje al administrador</label>
                                <p class="text-white">El administrador recibirá un mensaje de reestablecimiento de contraseña y se pondrá en contacto con usted.<br>
                                    ¿Enviar mensaje?
                                </p>

                            </div>
                            <center>
                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success" name="opcion" value="1">
                                            Enviar Mensaje
                                        </button>
                                    </div>
                                </div>
                            </center>--}}
                        </div>
                    </div>
                </div>
            @else
                <div id="contactar2">
                    <div class="border border-success shadow" style="border-radius: 20px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Comuníquese con el Administrador</label>
                                <label>Teléfono</label>
                                <p class="text-white">+522221297</p>
                                <label>Correo</label>
                                <p class="text-white">{{$admin->email}}</p>
                            </div>
                            {{--<div class="form-group">
                                <label>Enviar mensaje al administrador</label>
                                <p class="text-white">El administrador recibirá un mensaje de reestablecimiento de contraseña y se pondrá en contacto con usted.<br>
                                    ¿Enviar mensaje?
                                </p>

                            </div>
                            <center>
                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success" name="opcion" value="1">
                                            Enviar Mensaje
                                        </button>
                                    </div>
                                </div>
                            </center>--}}
                        </div>
                    </div>
                </div>
            @endif

            @if(!is_null($pregunta))
                <div id="pregunta2" style="display: none;">
                    <div class="border border-warning shadow" style="border-radius: 20px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Pregunta</label>
                                @foreach($preguntas as $key)
                                    @if($pregunta->id_pregunta == $key->id)
                                        <h3 class="text-white">{{$key->pregunta}}</h3>
                                    @endif
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Repuesta</label>
                                <input type="password" name="respuesta" class="form-control">
                            </div>
                            <center>
                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success" name="opcion" value="1">
                                            Reestablecer
                                        </button>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            @endif
            <input type="hidden" name="id_usuario" value="{{$user->id}}">
        </form>
    </div>
</div>
@endsection

<script type="text/javascript">
    function vista(opcion) {
        if (opcion == 1) {
            $('#contactar').fadeOut('slow',
                function() { 
                    $(this).hide();
                    $('#pregunta').fadeIn(300);
                }
            );
            $('#pregunta2').fadeOut('slow',
                function() { 
                    $(this).hide();
                    $('#contactar2').fadeIn(300);
                }
            );
        }else{
            $('#pregunta').fadeOut('slow',
                function() { 
                    $(this).hide();
                    $('#contactar').fadeIn(300);
                }
            );
            $('#contactar2').fadeOut('slow',
                function() { 
                    $(this).hide();
                    $('#pregunta2').fadeIn(300);
                }
            );
        }
    }
</script>