@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center p-0">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header font-weight-bold">Autenticación de dos factores</div>
                    <div class="card-body">
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        Ingrese el pin de la aplicación Google Authenticator:<br/><br/>
                        <form class="form-horizontal" action="{{ route('2faVerify') }}" method="POST" autocomplete="off">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('one_time_password-code') ? ' has-error' : '' }}">
                                <label for="one_time_password" class="control-label">Contraseña de un solo uso</label>
                                <input id="one_time_password" name="one_time_password" class="form-control col-md-4"  type="text" required/>
                            </div>
                            <button class="btn btn-success" type="submit"><i class="fa fa-sign-in mr-3" aria-hidden="true"></i>Autenticar</button>
                            <div class="px-0 py-2">
                                <div class="alert alert-secondary p-0 text-left " role="alert">
                                    <span class="font-weight-bold font-italic">Nota:</span> 
                                    <span class="font-italic">Si pierde el acceso con Google Authenticator contáctese con el administrador</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection