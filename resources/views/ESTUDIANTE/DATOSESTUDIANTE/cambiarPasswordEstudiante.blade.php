
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href=" css/changePass.css" rel="stylesheet">
    </head>
    <body>
<hr>
@extends('layouts.app')
@section('content')
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <i class="fa fa-pencil-square-o  mr-3 lead  text-dark" aria-hidden="true"></i>       
            <a class="navbar-brand font-weight-bold text-warning" href="#">Cambiar contraseña</a>
        </nav>
        <!--action="{{ url('docentes/cambiarPass') }}"-->
       <div id="changepass" class="container p-4 bg-lg">
                <div class="justify-content-center">
                    @if (session('error'))
                        <div class="alert alert-danger col-md-6">
                            {{ session('error') }}
                        </div>
                    @endif
                        @if (session('success'))
                            <div class="alert alert-success col-md-6">
                                {{ session('success') }}
                            </div>
                        @endif
                    <form class="form-horizontal" method="POST" action="{{ route('estudiantes.cambiarPass') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">Contraseña actual</label>
                            <div class="col-md-6">
                                <input id="current-password" type="password" class="form-control" name="current-password" required>
                                @if ($errors->has('current-password'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">Nueva Contraseña</label>
                            <div class="col-md-6">
                                <input id="new-password" type="password" class="form-control" name="new-password" required>
                                @if ($errors->has('new-password'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new-password-confirm" class="col-md-4 control-label">Confirmar nueva contraseña</label>

                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-6">
                                <button type="submit" class="btn text-bold btn-warning ont-weight-bold"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>
                                    Cambiar contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection
</body>
</html>