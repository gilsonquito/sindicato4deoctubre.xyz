<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('css/estilos.css')}}" rel="stylesheet">
    <title>Princial</title>
</head>
<body>
<header class="header">
          <nav class="navbar navbar-expand-lg" id="navb">  
              <div class="row  text-center" id="logoe">  
              <img src="{{asset('image/logo_empresa.png')}}" alt="logo del sindicato de choferes de penipe" class="img-fluid COL "  id="logo">
              </div>
              <div class="ml-5"> <button   title="Menu" class="" type="button"  id="menu-icon"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></button></div>
              <div class="container">
                  <div class="col-m" id="" >        
                      <a id="menu1" href="#inicio" class="nav-link"  title="Ir a la seccion inicio"><i class="fa fa-home" aria-hidden="true" > INICIO</i> </a>   
                  </div>   
                  <div class="col-m" id="">    
                      <a id="menu2" href="#acercade" class="nav-link " title="Ir a la seccion nosotros"><i class="fa fa-users " aria-hidden="true"> NOSOTROS</i> </span></a>
                  </div>  
                  <div class="col-m"id="">  
                      <a id="menu3" href="#contacto"  class="nav-link " title="Ir a la seccion contacto" ><i class="fa fa-phone" aria-hidden="true"> CONTACTO</i> </a>
                  </div>    
                  <div class="col-m"id="">  
                      <a id="menu4" href="#cursos"  class="nav-link" title="Ir a la seccion cursos"><i class="fa fa-car" aria-hidden="true"> CURSOS</i></a>
                  </div>  
                  <div class="col-m"id="">  
                      <a id="menu5" href="{{asset('/home')}}" target=”_blank” class="nav-link" title="Ir a la pagina de sistema academico"><i class="fa fa-address-book" aria-hidden="true" target="_blank" > SISTEMA ACADEMICO</i></a>
                  </div>  
              </div>
          </nav>
  </header>
  <div id="" class="">
          <img src="{{asset('image/header.jpg')}}" alt="SLIDER sindicato de choferes de penipe" id="headerimg"  >
  </div>   
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script href="{{asset('js/menu.js')}}"></script>
  <script type="text/javascript">
    $( document ).ready(function() {

$("#menu-icon").click(function(){
    $('#menu1').toggle(100,function() {
    });
    $('#menu2').toggle(100,function() {
    });
    $('#menu3').toggle(100,function() {
    });
    $('#menu4').toggle(100,function() {
    });
    $('#menu5').toggle(100,function() {
    });
});

});


  </script>

</body>

</html>
