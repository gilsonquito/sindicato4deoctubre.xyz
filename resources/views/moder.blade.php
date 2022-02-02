
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv='cache-control' content='no-cache'>
    <link href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>     
    <link href=" css/docente.css" rel="stylesheet">
    <title>Academico Moderador</title>
</head>
<body>
    <header class="header p-0">
          <nav class="row border bg-light  text-center p-0" id="navb"> 
                    <div class="col-md-2 p-0 border-right mt-2" id="caja-logo" >
                        <div class="text-center">
                            <img src="{{asset('image/logo_empresa.png')}}" alt="logo del sindicato de choferes de penipe" class="img-fluid " id="logo" >
                        </div>
                    </div>
                    <div class="col-md-8 align-self-center">
                            <div class="w-100  justify-content-center text-center py-0" id=""> 
                                    <i class="fa fa-graduation-cap px-2 form-line " aria-hidden="true" id="titulosistemaacademico"><spam class="ml-2 ">SISTEMA ACADÉMICO - DOCENTE</spam></i>
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
                            <button   class="" type="button"  id="menu-icon" title="Menu desplegable de docente">
                                <i class="fa fa-bars " aria-hidden="true"></i>
                            </button>  
                        </div> 
                    </div>
          </nav>
  </header>
  <div  class="row h-100  ">
                <div id="caja-menu" class="col-md-2 p-0 "><!--Menulateral-->
                        <div id="menu-lateral" class="h-100 border" > 
                            <div class="menu bg-ligth h-100 ml-3" id="menu">   
                                <a class="d-block p-3" id="dosFactores" href="/2fa">
                                        <i class="fa fa-lock mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Seguridad</span>  
                                </a>  
                                    <a class="d-block p-3" id="cargarDatosDocente" >
                                            <i class="fa fa-user mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                            <span class="menu-text text-dark" id="btnCargar" >Datos Docente</span>
                                            <i class="fa fa-caret-down text-dark" aria-hidden="true"></i>
                                    </a>
                                    <div class="p-0 p-0 col-md-12" id="submenu-docente" >
                                            <ul class="list-group justify-content-center ">       
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-editarperfil">Editar Perfil</li>   
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-cambiarPaswword">Cambiar contraseña</li>   
                                            </ul>
                                    </div>
                                <a class="d-block p-3" id="silabodocente" >
                                        <i class="fa fa-file-text  mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Sílabos</span>
                                        <i class="fa fa-caret-down text-dark" aria-hidden="true"></i>
                                </a >
                                    <div class="p-0 col-md-12" id="submenu-silabodocente" >
                                            <ul class="list-group justify-content-center ">
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-misilabo">Mis sílabos</li> 
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-crearSilabo">Generar sílabo</li>  
                                            </ul>
                                    </div>
                                <a class="d-block p-3" id="horarioClase">
                                        <i class="fa fa-clock-o mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Horario de clases</span>
                                </a>
                                <a class="d-block p-3" id="avanceAcaDocente">
                                        <i class="fa fa-pie-chart mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Avance Academico</span>
                                        <i class="fa fa-caret-down text-dark" aria-hidden="true"></i>
                                </a>
                                <div class="p-0 col-md-12" id="submenu-avanceAcaDocente" >
                                            <ul class="list-group justify-content-center ">
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-miAvance">Mis Avances Académicos</li>
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-generarAvance">Generar Avance Académico</li>    
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-reporteAvance">Reporte Avance Académico</li>   
                                            </ul>
                                    </div>
                                <a class="d-block p-3" id="estudiantesdocente">
                                        <i class="fa fa-users mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" id="btnCargarHorario" >Estudiantes</span>
                                        <i class="fa fa-caret-down text-dark" aria-hidden="true"></i>
                                </a>
                                <div class="p-0 col-md-12" id="submenu-estudiantesdocente" >
                                            <ul class="list-group justify-content-center ">
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-listarEstudiantes">Listado de estudiantes</li>
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-asistencias">Asistencia de estudiantes</li>   
                                            </ul>
                                </div>
                                <a class="d-block p-3" id="notasDocente">
                                        <i class="fa fa-table mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Notas</span>
                                </a>
                                <a class="d-block p-3" id="modulosDocente">
                                        <i class="fa fa-book mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Módulos</span>
                                </a>
                                <a class="d-block p-3" id="pdfManual" >
                                        <i class="fa fa-question-circle mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Ayuda</span>                                       
                                </a >
                            </div>
                        </div>       
                </div>  
                <div id="contenido" class="col-md-10 justify-content-center text-center p-2" ><!--seccion contenido-->
                @yield('contenido')
                        <div class="container-fluid p-2">
                            <div class="row">
                                <div class="w-100 align-self-center justify-content-center text-center py-1"> 
                                    <div class="w-100 justify-content-center text-center " >
                                        <h3 class="font-weight-light" id=""></h3 ><hr class="col-md-3 bg-light mt-1">
                                    </div>            
                                </div>   
                                <div class="col-md-6 py-2 border">
                                        <h4 class="text-dark text-center py-2 font-weight-light">Docencia</h4>
                                        <div class="container col py-2" id="sub-menu-crearSilabo2">
                                            <button type="button" class="btn btn-light border py-2 w-100 " id="">
                                                <i class="fa fa-file-text  mr-2 lead" aria-hidden="true" id="icon-silabo"></i><a>Sílabo</a>
                                            </button>
                                        </div>
                                        <div class="col py-2 align-self-center " id="sub-menu-generarAvance2">
                                            <button type="button" class="btn btn-light border w-100 py-2" id="">
                                                <i class="fa fa-list-alt mr-2 lead" aria-hidden="true" id="icon-avance-academico"></i><a>Avance Académico</a>
                                            </button>
                                        </div>
                                        <div class="col py-2" id="sub-menu-reporteAvance2">
                                            <button type="button" class="btn btn-light border w-100 py-2" id="">
                                                <i class="fa fa-file-pdf-o mr-2 lead" aria-hidden="true" id="icon-avance-actividades"></i><a>Reporte Avance Académico</a>
                                            </button>
                                        </div>
                                        <div class="col py-2" id="horarioClase2">
                                            <button type="button" class="btn btn-light border w-100 py-2" id="">
                                                <i class="fa fa-clock-o mr-2 lead" aria-hidden="true" id="icon-horario"></i><a>Horario de clases</a>
                                            </button>
                                        </div>
                                </div>
                            <div class="col-md-6 py-2 border">
                                    <h4 class="text-dark text-center py-2 font-weight-light">Estudiantes</h4>
                                
                                    <div class="col py-2" id="sub-menu-listarEstudiantes2">
                                        <button type="button" class="btn btn-light border py-2 w-100" id="">
                                            <i class="fa fa-list-ul  mr-2 lead" aria-hidden="true" id="icon-list-estudiantes"></i>Listado Estudiantes
                                        </button>
                                    </div>
                                    <div class="col py-2 align-self-center " id="sub-menu-asistencias2">
                                        <button type="button" class="btn btn-light border w-100 py-2" id="">
                                
                                            <i class="fa fa-calendar-check-o mr-2 lead" aria-hidden="true" id="icon-asistencia-est"></i>Asistencia Estudiantes
                                        </button>
                                    </div>
                                    <div class="col py-2" id="notasDocente2">
                                        <button type="button" class="btn btn-light border w-100 py-2" id="">
                                           
                                            <i class="fa fa-star mr-2 lead" aria-hidden="true" id="icon-calificaciones"></i>Calificaciones 
                                        </button>
                                    </div>
                                    <div class="col py-2" id="modulosDocente2">
                                        <button type="button" class="btn btn-light border w-100 py-2" id="">
                                            <i class="fa fa-book mr-2 lead" aria-hidden="true" id="icon-asignatura"></i>Asignaturas
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
    <script type='text/javascript' >
        $(document).ready(function(){
            var token = '{{csrf_token()}}';// ó $("#token").val() si lo tienes en una etiqueta html.
            $("#cargarDatosDocente").mouseenter(function() {
                $('#submenu-docente').stop().show(500);
            });
            
            $("#cargarDatosDocente, #submenu-docente").mouseleave(function() {
            if(!$('#submenu-docente').is(':hover')){
                $('#submenu-docente').hide(300);
            };
            });
            
            $("#silabodocente").mouseenter(function() {
                $('#submenu-silabodocente').stop().show(500);
            });
            
            $("#silabodocente, #submenu-silabodocente").mouseleave(function() {
            if(!$('#submenu-silabodocente').is(':hover')){
                $('#submenu-silabodocente').hide(300);
            };
            });   
            $("#avanceAcaDocente").mouseenter(function() {
                $('#submenu-avanceAcaDocente').stop().show(500);
            });
            
            $("#avanceAcaDocente, #submenu-avanceAcaDocente").mouseleave(function() {
            if(!$('#submenu-avanceAcaDocente').is(':hover')){
                $('#submenu-avanceAcaDocente').hide(300);
            };
            });   

            $("#estudiantesdocente").mouseenter(function() {
                $('#submenu-estudiantesdocente').stop().show(600);
            });
            
            $("#estudiantesdocente, #submenu-estudiantesdocente").mouseleave(function() {
            if(!$('#submenu-estudiantesdocente').is(':hover')){
                $('#submenu-estudiantesdocente').hide(300);
            };
            });
        
           $( "#menu-icon" ).click(function() {
            
           
            $('#menu-lateral').toggle(100,function() {
            });
            
            });
          
           $('#sub-menu-ingresarperfil').click(function(){
                $.ajax({
                    url:'/docentes',
                    beforeSend : function(){
                        $('#contenido').text('Cargando...');
                    },
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                    );
                    }
                });
            });
           
            $('#sub-menu-crearperfil').click(function(){
                $.ajax({
                    url:'/docentes/create',
                    beforeSend : function(){
                        $('#contenido').text('Cargando...');
                    },
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                    );
                    }
                });
            });
            
            $('#sub-menu-crearsilabo').click(function(){
                $.ajax({
                    url:'/silabos/create',
                    beforeSend : function(){
                        $('#contenido').text('Cargando...');
                    },
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                    );
                    }
                });
            });
            $('#sub-menu-listarsilabo').click(function(){
                $.ajax({
                    url:'/silabos/create',
                    beforeSend : function(){
                        $('#contenido').text('Cargando...');
                    },
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                    );
                    }
                });
            });
           
           
            $('#sub-menu-cambiarPaswword').click(function(){
                window.open("/change", "Cambiar password");
            });
            $('#sub-menu-editarperfil').click(function(){
                $.ajax({
                    
                    url:'datosDocente/editarDatos/{{auth()->user()->email}}',
                    
                    beforeSend : function(){
                        $('#contenido').text('Cargando...');
                    },
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                    );
                    }
                });
            });    
            $('#sub-menu-misilabo').click(function(){
                $.ajax({
                    
                    url:'/silabo',
                    
                    beforeSend : function(){
                        $('#contenido').text('Cargando...');
                    },
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                    );
                    }
                });
            });
            $('#sub-menu-subirsilabo').click(function(){
            $.ajax({
                    url:'silabodoc/subirSilabo',
                
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#horarioClase').click(function(){
            $.ajax({
                    url:'horariodoc',
                
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });   
            $('#horarioClase2').click(function(){
            $.ajax({
                    url:'horariodoc',
                
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });    
            $('#sub-menu-miAvance').click(function(){
            $.ajax({
                    url:'/avancesacademicos',
                
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#sub-menu-subirAvance').click(function(){
            $.ajax({
                    url:'avancesacademico/subirAvance',
                
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });

            $('#notasDocente').click(function(){
            $.ajax({
                    url:'/notasDocentes',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#notasDocente2').click(function(){
            $.ajax({
                    url:'/notasDocentes',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            
            $('#modulosDocente').click(function(){
            $.ajax({
                    url:'/modulosDocente/selectPeriodos',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#modulosDocente2').click(function(){
            $.ajax({
                    url:'/modulosDocente/selectPeriodos',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            
            $('#sub-menu-listarEstudiantes').click(function(){
            $.ajax({
                    url:'/listaEstudiantes/estudianteSelectPeriodos',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#sub-menu-listarEstudiantes2').click(function(){
            $.ajax({
                    url:'/listaEstudiantes/estudianteSelectPeriodos',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            
            $('#sub-menu-crearSilabo').click(function(){
            $.ajax({
                    url:'/silabodocente',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#sub-menu-crearSilabo2').click(function(){
            $.ajax({
                    url:'/silabodocente',
                    success : function(data){
                        setTimeout(function(){
                            $('#contenido').empty().append($(data));
                        }
                        );
                    }
                });
            });
            $('#sub-menu-generarAvance').click(function(){
                $.ajax({
                        url:'/avancesacademico/generarAvance',
                        success : function(data){
                            setTimeout(function(){
                                $('#contenido').empty().append($(data));
                            }
                            );
                        }
                });
            });
            $('#sub-menu-generarAvance2').click(function(){
                $.ajax({
                        url:'/avancesacademico/generarAvance',
                        success : function(data){
                            setTimeout(function(){
                                $('#contenido').empty().append($(data));
                            }
                            );
                        }
                });
            });
            $('#sub-menu-reporteAvance').click(function(){
                $.ajax({
                        url:'/avancesacademico/reporteAvance',
                        success : function(data){
                            setTimeout(function(){
                                $('#contenido').empty().append($(data));
                            }
                            );
                        }
                });
            });
            $('#sub-menu-reporteAvance2').click(function(){
                $.ajax({
                        url:'/avancesacademico/reporteAvance',
                        success : function(data){
                            setTimeout(function(){
                                $('#contenido').empty().append($(data));
                            }
                            );
                        }
                });
            });
            $('#sub-menu-asistencias').click(function(){
                $.ajax({
                        url:'/asistenciasEstudiantes',
                        success : function(data){
                            setTimeout(function(){
                                $('#contenido').empty().append($(data));
                            }
                            );
                        }
                });
            });
            $('#sub-menu-asistencias2').click(function(){
                $.ajax({
                        url:'/asistenciasEstudiantes',
                        success : function(data){
                            setTimeout(function(){
                                $('#contenido').empty().append($(data));
                            }
                            );
                        }
                });
            });
            
            $('#pdfManual').click(function(){
                window.open("/manual/manualDocente")
            }); 
        });
        
                        
    </script>

</body>

</html>
