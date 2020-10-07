@extends('layouts.app_login')

@section('content')
<div class="login-box card-black">
    <div class="card-body">
        <h2 align="center" class="">{{ __('Reset Password') }}</h2>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email" class="col-md-12 col-form-label email">RUT</label>
                        <input id="email" type="text" class="form-control email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" maxlength="12" required autocomplete="rut" autofocus placeholder="Rut">
                        <p>Ejm: 1234567-<strong>8</strong></p>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>No se ha encontrado un usuario con ese RUT.</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <center>
                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        {{--<button type="submit" class="btn btn-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>--}}
                        <button type="submit" class="btn btn-success">
                            Buscar
                        </button>
                    </div>
                </div>
            </center>
        </form>
    </div>
</div>
@endsection

<script type="text/javascript"></script>
