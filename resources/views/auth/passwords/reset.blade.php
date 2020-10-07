@extends('layouts.app_login')

@section('content')
<div class="login-box card-black">
    <div class="card-body">
        <center>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="form-group">
                    <label for="password" class="col-form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Nueva Contraseña">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Contraseña">
                </div>

                    <div class="col-md-12">
                        <input type="hidden" name="id_usuario" value="{{$user->id}}">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
            </form>
        </center>
    </div>
</div>
@endsection
