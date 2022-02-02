<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
    <link href="{{asset('css/inspector.css')}}" rel="stylesheet">
    <title>Academico Inspector</title>
</head>
<body>
    <header class="header p-0">
          <nav class="row border bg-light  text-center p-0" id="navb"> 
                    <div class="col-md-2 p-0 border-right mt-2" id="caja-logo" >
                        <div class="text-center">
                            <img src="{{asset('image/logo_empresa.png')}}" alt="Logo del sindicato de choferes de penipe" class="img-fluid " id="logo" >
                        </div>
                    </div>
                    <div class="col-md-8 align-self-center">
                            <div class="w-100  justify-content-center text-center py-0" id=""> 
                                    <i class="fa fa-graduation-cap px-2 form-line " aria-hidden="true" id="titulosistemaacademico"><spam class="ml-2 ">SISTEMA ACADÉMICO - INSPECTOR</spam></i>
                                    <h6 class="font-weight-light" id="tituloslogan">ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES 4 DE OCTUBRE</h6>
                            </div>
                    </div>
                    <div class="col-md-2  border-rigth mt-1" id="divcerrarsesion">   
                             <!--Comprobar si existe foto de usuario-->
                             @if(is_null(auth()->user()->imagen))
                                    <img src="{{asset('users').'/'.'defecto.jpg'}}" alt="imagen-usuario" id="fotoUsuario" class="p-0">
                                @else
                                    <img src="{{asset('users').'/'.auth()->user()->id.'.'.auth()->user()->imagen}}" alt="imagen-usuario" id="fotoUsuario" class="p-0">
                                @endif         
                             <form action="/logout" method="POST" class="p-0" id="formcerrarsesion">
                             @csrf  
                                <a class="p-0 text-dark" id=""> {{auth()->user()->email}}</a>
                                 <a href="#" onclick="this.closest('form').submit()" class="text-success" id="cerrarsesion">Cerrar Sesión<i class="fa fa-sign-out ml-1" aria-hidden="true"></i></a>
                             </form>
                    </div> 
                    <div class="col-md-1">
                        <div id="caja-menu-docente"> 
                            <button   class="" type="button"  id="menu-icon" title="Menu desplegable">
                                <i class="fa fa-bars " aria-hidden="true"></i>
                            </button>  
                        </div> 
                    </div>
          </nav>
  </header>
  <div  class="row h-100  ">
                <div id="caja-menu" class="col-md-2 p-0 "><!--menu lateral-->
                        <div id="menu-lateral" class="h-100 border" > 
                            <div class="menu bg-ligth h-100 ml-3" id="menu">  
                            <a class="d-block p-3" id="dosFactores" href="/2fa">
                                        <i class="fa fa-lock mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Seguridad</span>  
                                </a> 
                                <a class="d-block p-3" id="datosInspector">
                                        <i class="fa fa-user-circle mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Datos usuario</span>
                                        <i class="fa fa-caret-down text-dark" aria-hidden="true"></i>
                                </a>             
                                <div class="p-0 p-0 col-md-12" id="submenu-Inspector" >
                                            <ul class="list-group justify-content-center ">       
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-editarperfilInspector">Editar datos</li>   
                                                <li class="list-group-item  py-1 font-weight-light" href="#" target="_blank" id="sub-menu-cambiarPaswworInspector">Cambiar contraseña</li>   
                                            </ul>
                                </div>
                                <div class="d-block p-3" id="menuParalelos" href="#">
                                    <i class="fa fa-clone mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Paralelos</span>
                                </div>   
                                <div class="d-block p-3" id="cursosA" href="#">
                                    <i class="fa fa-id-card-o mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Cursos de Licencias</span>
                                </div>        
                                <a class="d-block p-3" id="modulos">
                                        <i class="fa fa-book mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" id="btnCargarHorario" >Modulos</span>
                                </a>            
                                <a class="d-block p-3" id="horario">
                                        <i class="fa fa-clock-o mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Horario de clases</span>
                                        <i class="fa fa-caret-down text-dark" aria-hidden="true"></i>
                                </a>
                                <div class="p-0 p-0 col-md-12" id="submenu-horario"   >
                                            <ul class="list-group justify-content-center ">
                                                <li class="list-group-item  py-1 font-weight-light" href="" id="sub-menu-listarHorarios">Horarios</li>
                                                <li class="list-group-item  py-1 font-weight-light" href="" id="sub-menu-periodoHorarios">Período de horarios</li>
                                                <li class="list-group-item  py-1 font-weight-light" href="" id="sub-menu-listaAsignacionHorario">Lista de asignaciones de horarios</li> 
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-asignarHorario">Asignar Horario</li> 
                                            </ul>
                                </div> 
                                <div class="d-block p-3" id="menuMatriculas2">
                                        <i class="fa fa-desktop mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Matrículas</span> 
                                </div>
                                <a class="d-block p-3" id="evaluacionDocente" >
                                        <i class="fa fa-address-card-o mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Evaluación al docente</span>                                       
                                </a > 
                                <a class="d-block p-3" id="pdfManual" >
                                        <i class="fa fa-question-circle mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Ayuda</span>                                       
                                    </a >
                            </div>
                        </div>       
                </div>  
                <div id="contenido" class="col-md-10 justify-content-center text-center" >
                        <div class="container-fluid p-2">
                            <div class="row">
                                <div class="w-100 align-self-center justify-content-center text-center py-1"> 
                                    <div class="w-100 justify-content-center text-center " >
                                        <h3 class="font-weight-light" id=""></h3 ><hr class="col-md-3 bg-light mt-1">
                                    </div>            
                                </div>   
                                <div class="col-md-6 py-2 border">
                                        <h4 class="text-dark text-center py-2 font-weight-light">Asignar</h4>
                                        <div class="container col py-2" id="menuParalelos2">
                                            <button type="button" class="btn btn-light border py-2 w-100 " id="btnlc">
                                                <i class="fa fa-clone mr-2 lead" aria-hidden="true" id="icon-silabo"></i><a>Paralelos</a>
                                            </button>
                                        </div>
                                        <div class="col py-2" id="cursosA2">
                                            <button type="button" class="btn btn-light border py-2 w-100" id="btnlc4">
                                                <i class="fa fa-id-card-o  mr-2 lead" aria-hidden="true" id="icon-list-estudiantes"></i>Cursos
                                            </button>
                                        </div>
                                        <div class="col py-2 align-self-center " id="modulos2">
                                            <button type="button" class="btn btn-light border w-100 py-2" id="btnlc1">
                                                <i class="fa fa-book mr-2 lead" aria-hidden="true" id="icon-avance-academico"></i><a>Módulos</a>
                                            </button>
                                        </div>
                                        <div class="col py-2" id="sub-menu-asignarHorario2">
                                            <button type="button" class="btn btn-light border w-100 py-2" id="btnlc3">
                                                <i class="fa fa-clock-o mr-2 lead" aria-hidden="true" id="icon-horario"></i><a>Horario de clases</a>
                                            </button>
                                        </div>
                                </div>
                            <div class="col-md-6 py-2 border">
                                    <h4 class="text-dark text-center py-2 font-weight-light">Visualizar</h4>
                                
                                    <div class="col py-2" id="evaluacionDocente2">
                                        <button type="button" class="btn btn-light border py-2 w-100" id="btnlc4">
                                            <i class="fa fa-address-card-o  mr-2 lead" aria-hidden="true" id="icon-list-estudiantes"></i>Evaluación al Docente
                                        </button>
                                    </div>
                            </div>
                        </div>
                </div>
    </div>
  <div class="w-100 footer border bg-light">    
		<div class="">
                <div class="justify-content-center text-center p-2">            
                    <h6 class="p-0 TEXT-DARK" id="text"><strong>© 2020 Todos los derechos reservados</strong></h6>                                           
                </div>
        </div>		          
    </div>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script >

        $(document).ready(function(){
             //desplegar submenu datos admin
             $("#datosInspector").mouseenter(function() {
                $('#submenu-Inspector').stop().show(300);
            });
            $("#datosInspector, #submenu-Inspector").mouseleave(function() {
                if(!$('#submenu-Inspector').is(':hover')){
                    $('#submenu-Inspector').hide(500);
                }
            });
            $('#sub-menu-editarperfilInspector').click(function(){
            $.ajax({
                    url:'/inspector/editarDatosInspector/{{auth()->user()->email}}',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#sub-menu-cambiarPaswworInspector').click(function(){
                window.open("/changeAdminInspector", "Cambiar password");
            }); 
            $('#menuParalelos').click(function(){
            $.ajax({
                    url:'/paralelosA',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#menuParalelos2').click(function(){
            $.ajax({
                    url:'/paralelosA',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#cursosA').click(function(){
            $.ajax({
                    url:'/cursos',
                
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#cursosA2').click(function(){
            $.ajax({
                    url:'/cursos',
                
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#modulos').click(function(){
                $.ajax({
                    url:'/modulo',
                
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#modulos2').click(function(){
                $.ajax({
                    url:'/modulo',
                
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
              //desplegar submenu horario
              $("#horario").mouseenter(function() {
                $('#submenu-horario').stop().show(300);
            });
            $("#horario, #submenu-horario").mouseleave(function() {
                if(!$('#submenu-horario').is(':hover')){
                    $('#submenu-horario').hide(500);
                }
            });
            $('#sub-menu-listarHorarios').click(function(){
                $.ajax({
                        url:'/horarios',
                        success : function(data){
                            setTimeout(function(){
                                $('#contenido').empty().append($(data));
                            }
                            );
                        }
                });
            });
            $('#sub-menu-periodoHorarios').click(function(){
            $.ajax({
                    url:'/periodoshorarios',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#sub-menu-listaAsignacionHorario').click(function(){
                $.ajax({
                        url:'/docentemodulohorarios',
                        success : function(data){
                            setTimeout(function(){
                                $('#contenido').empty().append($(data));
                            }
                            );
                        }
                });
            });
            $('#sub-menu-asignarHorario').click(function(){
                $.ajax({
                        url:'/docentemodulohorario/asignar',
                        success : function(data){
                            setTimeout(function(){
                                $('#contenido').empty().append($(data));
                            }
                            );
                        }
                });
            });
            $('#sub-menu-asignarHorario2').click(function(){
                $.ajax({
                        url:'/docentemodulohorario/asignar',
                        success : function(data){
                            setTimeout(function(){
                                $('#contenido').empty().append($(data));
                            }
                            );
                        }
                });
            });
            $('#evaluacionDocente').click(function(){
            $.ajax({
                    url:'/evaluaciondoc',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            }); 
            $('#evaluacionDocente2').click(function(){
            $.ajax({
                    url:'/evaluaciondoc',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });  
            $( "#menu-icon" ).click(function() {
                $('#menu-lateral').toggle(100,function() {
                });
            });
            $('#menuMatriculas2').click(function(){
            $.ajax({
                    url:'/matriculasg',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#pdfManual').click(function(){
                window.open("/manual/manualInspector")
            }); 
        });
        
                        
    </script>


</body>

</html>
