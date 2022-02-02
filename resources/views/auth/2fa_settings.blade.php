@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Autenticación de dos factores</strong></div>
                    <div class="card-body">
                        <p>La autenticación de dos factores (2FA) refuerza la seguridad del acceso al requerir dos métodos (también denominados factores) para verificar su identidad. La autenticación de dos factores protege contra ataques de phishing, ingeniería social y de fuerza bruta de contraseñas, y protege sus inicios de sesión de atacantes que explotan credenciales débiles o robadas.</p>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($data['user']->loginSecurity == null)
                            <form class="form-horizontal" method="POST" action="{{ route('generate2faSecret') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-lock mr-3" aria-hidden="true"></i>Generar clave secreta para habilitar 2FA
                                    </button>
                                </div>
                            </form>
                        @elseif(!$data['user']->loginSecurity->google2fa_enable)
                            1. Escanee este código QR con su aplicación Google Authenticator. Alternativamente, puede usar el código: <code>{{ $data['secret'] }}</code><br/>
                            <img src="{{$data['google2fa_url'] }}" alt="">
                            <br/><br/>
                            2. Ingrese el PIN de la aplicación Google Authenticator:<br/><br/>
                            <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('verify-code') ? ' has-error' : '' }}">
                                    <label for="secret" class="control-label">Código de autenticador</label>
                                    <input id="secret" type="password" class="form-control col-md-4" name="secret" required>
                                    @if ($errors->has('verify-code'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('verify-code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-lock mr-3" aria-hidden="true"></i>Habilitar 2FA
                                </button>
                            </form>
                        @elseif($data['user']->loginSecurity->google2fa_enable)
                            <div class="alert alert-success">
                                2FA es actualmente <strong>activada</strong>  en tu cuenta.
                            </div>
                            <p>Si está buscando deshabilitar la autenticación de dos factores. Confirme su contraseña y haga clic en Desactivar el botón 2FA.</p>
                            <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                    <label for="change-password" class="control-label">Contraseña Actual</label>
                                        <input id="current-password" type="password" class="form-control col-md-4" name="current-password" required>
                                        @if ($errors->has('current-password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                        @endif
                                </div>
                                <button type="submit" class="btn btn-warning "><i class="fa fa-ban mr-3" aria-hidden="true"></i>Deshabilitar 2FA</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection