<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
    <link href="{{asset('css/loginSin.css')}}" rel="stylesheet">
    <title>Princial</title>
</head>
<body>
<header id="header">
          <nav class="navbar navbar-expand-lg p-0" id="navb">  
              <div class="row w-100 P-0">
                  
                    <div class="col-md-1 align-self-center justify-content-center text-center form-group px-4 py-1" id="logoe">
                                <div class="p-0 mt-2">
                                        <img src="image/logo_empresa.png" alt="logo del sindicato de choferes de penipe" class="center img-fluid "  id="logo">
                                </div>
                    </div>
                    <div class="col-md-11 P-1 align-self-center justify-content-center text-center" id="tAcademico"> 
                        <h4  id="titulologin">ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES 4 DE OCTUBRE </h4>
                    </div>
                  
            </div>
          </nav>
  </header>
<div id="sectionlogin" class="py-0 ">
         <div class="row  justify-content-center py-0">
             <div class="col-md-6 align-self-center justify-content-center text-center py-0 ">                     
             <h2 class="text-dark"></BR>  <i class="fa fa-graduation-cap text-dark mb-2" aria-hidden="true" id=""> </i>Sistema Académico </h2>
                     <div class="justify-content-center justify-items-center text-center" id="bloquelogin">
                        <div class="w-75 border rounded py-5 px-3 justify-content-center" id="">
                                <!--<form id="form_login" method="POST" action="{{ route('login') }}">-->
                                <form id="form_login" method="POST">   
                                                @csrf
                                                <div class="py-3"> 
                                                        <label class="input-group-text col-lg py-1">
                                                                <input id="email" name="email" type="email" placeholder="Ingrese su email" class="form-control" required>  
                                                        </label>
                                                        @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                </div>      
                                                <div class="py-3"> 
                                                        <label class="input-group-text col-lg py-1">
                                                                <input id="password" name="password" type="password" placeholder="Ingrese su contraseña" class="form-control" required>
                                                        </label>
                                                        @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                        
                                                </div>
                                                <div>
                                                        <p class="text-danger p-0" role="alert" id="mensajesCredenciales">
                                                                        ¡Credenciales incorrectas!
                                                        </p> 
                                                </div>
                                                <div class="form-group justify-content-center text-center col-md-12">
                                                                <div class="col-md-12 py-2 justify-content-center text-center " >
                                                                        <div class="col-md-12 p-0">
                                                                                <button type="submit" type="submit" class="btn btn-warning col-md-5 px-2 font-weight-bold"  >
                                                                                {{ ('Ingresar') }}
                                                                                </button>
                                                                        </div>
                                                                        @if (Route::has('password.request'))
                                                                        
                                                                                <a class="btn btn-link  px-2 text-success" href="{{ route('password.request') }}">
                                                                                        {{('¿Olvidé mi contraseña?') }}
                                                                                </a>
                                                                        @endif
                                                                </div>
                                                </div>
                                                <div class="form-group row mb-0">
                                                </div>
                                        </form>   
                        </div>
                </div>       
             </div>
             <div class="col-md-6 align-self-center text-center py-0  " id="imagenlogin">           
                     <img src="{{asset('image/imglogin.png')}}" alt="imagen de conductor publicidad" id="img-acercade" class="pr-2 img-fluid center  rounded-left" >
             </div>
         </div>
</div>
<footer class="footer py-1">
      <div class="container-fluid py-1">
        <div class=" justify-content-center">             
          <div class="align-self-center text-center py-0">
              <h6 class="text-dark"><strong>Copyright © 2021  | Sindicato de choferes profecionesles- 4 de octubre</h6>
      </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script> //login
              
               $('#form_login').submit(function(e){
                   e.preventDefault();
                    var email=$('#email').val();
                    var password=$('#password').val();
                    var _token=$("input[name=_token]").val();
                    //alert(id_tlic+" "+id_paralelo);
                                $.ajax({
                                    url:"{{route('login')}}",
                                    type:"POST",
                                    async: true,
                                    data:$("#form_login").serialize(),
                                    success:function(response)
                                    {   
                                        if(response)
                                        {
                                           window.open("/home","_self")
                                        }
                                        else
                                        {       
                                                $('#form_login')[0].reset();
                                                $('#mensajesCredenciales').show();
                                                
                                                setTimeout(function(){
                                                        $('#mensajesCredenciales').hide(2000);
                                                },4000);                                                   
                                        }
                                    },
                                    error : function(response){
                                        toastr.error('Ocurrio un error intente nuevamente','¡FALLIDA!',{timeOut:3000});
                                    }
                                });        
                })
                
        </script> 

</body>

</html>
