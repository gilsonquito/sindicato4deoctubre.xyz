
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
    <link href="{{asset('css/secretaria.css')}}" rel="stylesheet">
    <title>Academico secretaria</title>
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
                                    <i class="fa fa-graduation-cap px-2 form-line " aria-hidden="true" id="titulosistemaacademico"><spam class="ml-2 ">SISTEMA ACADÉMICO - SECRETARÍA</spam></i>
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
                                <a class="d-block p-3" id="datosSecretaria">
                                        <i class="fa fa-user-circle mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Datos usuario</span>
                                        <i class="fa fa-caret-down text-dark" aria-hidden="true"></i>
                                </a> 
                                <div class="p-0 p-0 col-md-12" id="submenu-secretaria" >
                                            <ul class="list-group justify-content-center ">       
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-editarperfilSecretaria">Editar datos</li>   
                                                <li class="list-group-item  py-1 font-weight-light" href="#" target="_blank" id="sub-menu-cambiarPaswworSecretaria">Cambiar contraseña</li>   
                                            </ul>
                                </div>
                                <a class="d-block p-3" id="dosFactores" href="/2fa">
                                        <i class="fa fa-lock mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Seguridad</span>  
                                </a>  
                                <a class="d-block p-3" id="quitarSeguridad" >
                                        <i class="fa fa-shield mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Quitar Seguridad Usuarios</span>                                       
                                </a>
                                <div class="d-block p-3" id="reporteNotas" href="#">
                                    <i class="fa fa-list-alt mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Reporte Cuadro General de Calificaciones</span>
                                </div>   
                                <div class="d-block p-3" id="actasCalificaciones" href="#">
                                    <i class="fa fa-list-alt mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Acta de calificaciones</span>
                                </div> 
                                <div class="d-block p-3" id="reporteAsistencias" href="#">
                                    <i class="fa fa-list-alt mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Reporte de asistencias</span>
                                </div>    
                                <div class="d-block p-3" id="asistenciasModulos" href="#">
                                    <i class="fa fa-list-alt mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Reporte de asistencias por módulo</span>
                                </div>  
                                <a class="d-block p-3" id="notasEstudiante">
                                        <i class="fa fa-table mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" id="btnCargarHorario" >Notas de estudiante</span>
                                        
                                </a>       
                                <a class="d-block p-3" id="idAsistencias">
                                        <i class="fa fa-calendar-check-o mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" id="btnCargarHorario" >Aistencias de estudiante</span>
                                        
                                </a>         
                                <a class="d-block p-3" id="pdfManualS" >
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
                                        <h4 class="text-dark text-center py-2 font-weight-light">REPORTES</h4>
                                        <div class="container col py-2" id="reporteNotas2">
                                            <button type="button" class="btn btn-light border py-2 w-100 " id="btnlc">
                                                <i class="fa fa-file-excel-o mr-3 lead" aria-hidden="true" id="icon-silabo"></i><a>Cuadro General de Calificaciones</a>
                                            </button>
                                        </div>
                                        <div class="col py-2" id="actasCalificaciones2">
                                            <button type="button" class="btn btn-light border py-2 w-100" id="btnlc4">
                                                <i class="fa fa-file-excel-o  mr-3 lead" aria-hidden="true" id="icon-list-estudiantes"></i>Acta de Calificaciones
                                            </button>
                                        </div>
                                        <div class="col py-2 align-self-center " id="reporteAsistencias2">
                                            <button type="button" class="btn btn-light border w-100 py-2" id="btnlc1">
                                                <i class="fa fa-file-excel-o mr-3 lead" aria-hidden="true" id="icon-avance-academico"></i><a>Reporte de Asistencias</a>
                                            </button>
                                        </div>
                                        <div class="col py-2" id="asistenciasModulos2">
                                            <button type="button" class="btn btn-light border w-100 py-2" id="btnlc3">
                                                <i class="fa fa-file-excel-o mr-3 lead" aria-hidden="true" id="icon-horario"></i><a>Reporte de Asistencias por Módulo</a>
                                            </button>
                                        </div>
                                </div>
                            <div class="col-md-6 py-2 border">
                                    <h4 class="text-dark text-center py-2 font-weight-light">ACCIONES</h4>
                                
                                    <div class="col py-2" id="notasEstudiante2">
                                        <button type="button" class="btn btn-light border py-2 w-100" id="btnlc4">
                                            <i class="fa fa-table  mr-3 lead" aria-hidden="true" id="icon-silabo"></i>Notas Estudiantes
                                        </button>
                                    </div>
                                    <div class="col py-2" id="idAsistencias2">
                                        <button type="button" class="btn btn-light border py-2 w-100" id="btnlc4">
                                            <i class="fa fa-calendar-check-o  mr-3 lead" aria-hidden="true" id="icon-horario"></i>Asistencias Estudaintes
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
             $("#datosSecretaria").mouseenter(function() {
                $('#submenu-secretaria').stop().show(300);
            });
            $("#datosSecretaria, #submenu-secretaria").mouseleave(function() {
                if(!$('#submenu-secretaria').is(':hover')){
                    $('#submenu-secretaria').hide(500);
                }
            });
            $('#sub-menu-editarperfilSecretaria').click(function(){
            $.ajax({
                    url:'/secretaria/editarDatosSecretaria/{{auth()->user()->email}}',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#sub-menu-cambiarPaswworSecretaria').click(function(){
                window.open("/changeAdminSecretaria", "Cambiar password");
            }); 
            $('#idAsistencias').click(function(){
                $.ajax({
                        url:'/secretaria/asistenciaEstudianteSe',
                        success : function(data){
                            setTimeout(function(){
                                $('#contenido').empty().append($(data));
                            }
                            );
                        }
                });
            });
            $('#idAsistencias2').click(function(){
                $.ajax({
                        url:'/secretaria/asistenciaEstudianteSe',
                        success : function(data){
                            setTimeout(function(){
                                $('#contenido').empty().append($(data));
                            }
                            );
                        }
                });
            });
            $('#quitarSeguridad').click(function(){
                    $.ajax({
                            url:'/admin/quitarSeguridad2faVista',
                        
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenido').empty().append($(data));
                                }
                                );
                            }
                    });
            });
            $('#reporteAsistencias').click(function(){
                    $.ajax({
                            url:'/vistaAsistenciasEstudiantes',
                        
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenido').empty().append($(data));
                                }
                                );
                            }
                    });
            });
            $('#reporteAsistencias2').click(function(){
                    $.ajax({
                            url:'/vistaAsistenciasEstudiantes',
                        
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenido').empty().append($(data));
                                }
                                );
                            }
                    });
            });
            $('#reporteNotas').click(function(){
                    $.ajax({
                            url:'/vistaNotasEstudiantes',
                        
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenido').empty().append($(data));
                                }
                                );
                            }
                    });
            });
            $('#reporteNotas2').click(function(){
                    $.ajax({
                            url:'/vistaNotasEstudiantes',
                        
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenido').empty().append($(data));
                                }
                                );
                            }
                    });
            });
            $('#notasEstudiante').click(function(){
                    $.ajax({
                            url:'/notasSecretarias',
                        
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenido').empty().append($(data));
                                }
                                );
                            }
                    });
            });
            $('#notasEstudiante2').click(function(){
                    $.ajax({
                            url:'/notasSecretarias',
                        
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenido').empty().append($(data));
                                }
                                );
                            }
                    });
            });
            $('#asistenciasModulos').click(function(){
                    $.ajax({
                            url:'/asistenciasModulos',
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenido').empty().append($(data));
                                }
                                );
                            }
                    });
            });
            $('#asistenciasModulos2').click(function(){
                    $.ajax({
                            url:'/asistenciasModulos',
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenido').empty().append($(data));
                                }
                                );
                            }
                    });
            });
            $('#actasCalificaciones').click(function(){
                    $.ajax({
                            url:'/secretaria/vistaActasEstudiantes',
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenido').empty().append($(data));
                                }
                                );
                            }
                    });
            });
            $('#actasCalificaciones2').click(function(){
                    $.ajax({
                            url:'/secretaria/vistaActasEstudiantes',
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenido').empty().append($(data));
                                }
                                );
                            }
                    });
            });
            
            $('#pdfManualS').click(function(){
                window.open("/manual/manualSecretaria")
            }); 
        });
        
                        
    </script>
</body>
</html>
