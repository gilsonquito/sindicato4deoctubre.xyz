<hr>
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <i class="fa fa-pencil-square-o  mr-3 lead  text-dark" aria-hidden="true"></i>       
            <a class="navbar-brand font-weight-bold text-warning" href="#">Cambiar contraseña</a>
        </nav>
        <div class="container ">  
            <div class="row">  
            <div class="col-md-12 col-md-offset-2">  
                <div class="panel panel-default">  
                <div class="panel-body">  
                    <form id="formcpass" class="form-horizontal" method="POST" role="form" action="{{ route('docentes.actualizarPassword') }}">  
                        @csrf
                    @if (count($errors) > 0)  
                        <div class="alert alert-danger">  
                        <ul>  
                            @foreach ($errors->all() as $error)  
                            <li>{{ $error }}</li>  
                            @endforeach  
                        </ul>  
                        </div>  
                    @endif  
                    {{ csrf_field() }}  
                    {{-- Current password --}}  
                    <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">  
                        <label for="current_password" class="col-md-4 control-label">Antigua Contraseña</label>  
                        <div class="col-md-6">  
                        <input id="current_password" type="password" class="form-control" name="current_password"  autofocus>  
                        @if ($errors->has('current_password'))  
                            <span class="help-block">  
                            <strong>{{ $errors->first('current_password') }}</strong>  
                        </span>  
                        @endif  
                        </div>  
                    </div>  
                    {{-- New password --}}  
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">  
                        <label for="password" class="col-md-4 control-label">Neva contraseña</label>  
                        <div class="col-md-6">  
                        <input id="password" type="password" class="form-control" name="password" > 
                        @if ($errors->has('password'))  
                            <span class="help-block">  
                            <strong>{{ $errors->first('password') }}</strong>  
                        </span>  
                        @endif  
                        </div>  
                    </div>  
                    {{-- Confirm new password --}}  
                    <div class="form-group">  
                        <label for="password-confirm" class="col-md-4 control-label">Repita Antigua Contraseña</label>  
                        <div class="col-md-6">  
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >  
                        </div>  
                    </div>  
                    {{-- Submit button --}}  
                    <div class="form-group">  
                        <div class="col-md-6 col-md-offset-4">  
                        <button type="submit" class="btn btn-warning">  
                            Cambiar Contraseña  
                        </button>  
                        </div>  
                    </div>  
                    </form>  
                </div>  
            </div>  
            </div>  
        </div>  