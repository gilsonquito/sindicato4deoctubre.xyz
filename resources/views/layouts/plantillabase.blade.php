<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <link href="css/docente.css" rel="stylesheet">
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
                                    <i class="fa fa-graduation-cap px-2 form-line " aria-hidden="true" id="titulosistemaacademico"><spam class="ml-2 ">SISTEMA ACADEMICO</spam></i>
                                    <h6 class="font-weight-light" id="tituloslogan">SINDICATO DE CHOFERES PROFESIONALES 4 DE OCTUBRE-CANTON PENIPE</h6>
                            </div>
                    </div>
                    <div class="col-md-2  border-rigth mt-1" id="divcerrarsesion">   
                             <img src="image/usuario.jpg" alt="logo del sindicato de choferes de penipe"   id="fotoUsuario" class="p-0">  
                             <form action="/logout" method="POST" class="p-0" id="formcerrarsesion">
                             @csrf  
                                <a class="p-0 text-dark" id=""> {{auth()->user()->name}}</a>
                                 <a href="#" onclick="this.closest('form').submit()" class="text-success" id="cerrarsesion">Cerrar Sesión<i class="fa fa-sign-out ml-1" aria-hidden="true"></i></a>
                             </form>
                    </div> 
                    <div class="col-md-1">
                        <div id="caja-menu-docente"> 
                            <button   class="" type="button"  id="menu-icon">
                                <i class="fa fa-bars " aria-hidden="true"></i>
                            </button>  
                        </div> 
                    </div>
          </nav>
  </header>
  <div  class="row h-100  ">
                <div id="caja-menu" class="col-md-2 p-0 ">
                        <div id="menu-lateral" class="h-100 border" > 
                            <div class="menu bg-ligth h-100 ml-3" id="menu">    
                                    <a class="d-block p-3" id="datosdocente" >
                                            <i class="fa fa-user mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                            <span class="menu-text text-dark" id="btnCargar" >Datos Docente</span>
                                            <i class="fa fa-caret-down text-dark" aria-hidden="true"></i>
                                    </a>
                                    <div class="p-0 p-0 col-md-12" id="submenu-docente" style="display:none">
                                            <ul class="list-group justify-content-center ">
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-ingresarperfil">Ingresar Perfil</li>  
                                                <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-editarperfil">Editar Perfil</li>  
                                            </ul>
                                    </div>
                                <a class="d-block p-3" id="silabodocente" >
                                        <i class="fa fa-file-text  mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Silabo docente</span>
                                        <i class="fa fa-caret-down text-dark" aria-hidden="true"></i>
                                </a >
                                    <div class="p-0 col-md-12" id="submenu-silabodocente" style="display:none">
                                            <ul class="list-group justify-content-center ">
                                            <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-li">Subir silabo</li>
                                            <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-li">Editar silabo</li> 
                                            <li class="list-group-item py-1 font-weight-light" href="#" id="sub-menu-li">Reporte silabo</li>    
                                            </ul>
                                    </div>
                                <a class="d-block p-3" id="menu3">
                                <i class="fa fa-list-alt mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Academico</span>
                                </a>
                                <a class="d-block p-3" id="menu3">
                                        <i class="fa fa-clock-o mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" >Horario de clases</span>
                                </a>
                                <a class="d-block p-3" id="estudiantesdocente">
                                        <i class="fa fa-users mr-3 lead  text-success" aria-hidden="true" id=""></i>
                                        <span class="menu-text text-dark" id="btnCargarHorario" >Estudiantes</span>
                                        <i class="fa fa-caret-down text-dark" aria-hidden="true"></i>
                                </a>
                                <div class="p-0 col-md-12" id="submenu-estudiantesdocente" style="display:none">
                                            <ul class="list-group justify-content-center ">
                                            <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-li">Listado de estudiantes</li>
                                            <li class="list-group-item  py-1 font-weight-light" href="#" id="sub-menu-li">Asistencia de estudiantes</li> 
                                            <li class="list-group-item py-1 font-weight-light" href="#" id="sub-menu-li">Calificaciones</li> 
                                            <li class="list-group-item py-1 font-weight-light" href="#" id="sub-menu-li">Asignaturas</li>    
                                            </ul>
                                </div>
                            </div>
                        </div>       
                </div>  
                <div id="contenido" class="col-md-10 justify-content-center text-center" >
                        @yield('contenido')
                </div>
    </div>
  <div class="w-100 footer border bg-light">          
		<div class="">
                <div class="justify-content-center text-center p-2">            
                    <h6 class="p-0 TEXT-DARK" id="text"><strong>© 2020 Todos los derechos reservados</strong></h6>                                           
                </div>
        </div>		          
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script href="{{asset('js/menu-docente.js')}}"></script>
  <script type='text/javascript' >
        $(document).ready(function(){
            $("#datosdocente").mouseenter(function() {
                $('#submenu-docente').stop().show(500);
            });
            
            $("#datosdocente, #submenu-docente").mouseleave(function() {
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
            $("#estudiantesdocente").mouseenter(function() {
                $('#submenu-estudiantesdocente').stop().show(600);
            });
            
            $("#estudiantesdocente, #submenu-estudiantesdocente").mouseleave(function() {
            if(!$('#submenu-estudiantesdocente').is(':hover')){
                $('#submenu-estudiantesdocente').hide(300);
            };
            });
            //$("#menu-icon").onclick(function() {
               // $('#caja-menu').stop().show(600);
           // });
           $( "#menu-icon" ).click(function() {
            
           
            $('#menu-lateral').toggle(100,function() {
            });
            
            });
          
            $('#sub-menu-ingresarperfil').click(function(){
                $.ajax({
                    url:'/docente',
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
                        
           
            
        });
                        
    </script>

</body>
</html>
