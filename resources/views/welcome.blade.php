
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
    @extends('template/nav')     
    
  <div id="inicio" class="col-lg p-0 w-100">
            <div class="row h-100 text-light" id="textoprincipal"> ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE <br>CONDUCTORES PROFESIONALES 4 DE OCTUBRE</div>      
            <img src="{{asset('image/principal.jpg')}}" alt="SLIDER sindicato de choferes de penipe" id="imgprincipalno" class="img-fluid w-100"  >
  </div>

  <div id="servicios" class="container-fluid p-2">
            <div class="container py-3 text-warning" id="cursos"> <h1 id="titulo2">Servicios </h1><hr class="w-50"></div>
           
            
            <div class="row">
                <div class="col-md-4 py-2 border">
                    
                        <img src="{{asset('image/c.png')}}" alt="imagen licencia tipo c"  id="img-licenciac" class="p-1 img-fluid ">
                        <h3 class="text-dark text-center py-2">Licencia tipo C</h3>
                        <P class="text-dark text-justify py-4">Taxis convencionales, ejecutivos, camionetas livianas o mixta hasta 3.500 kg, hasta 8 pasajeros; vehículos de transporte de pasajeros de no más de 25 asientos y los vehículos comprendidos en el tipo B.</p>
                        <a type="button" class="btn btn-warning py-2" id="btnlc" href="https://sindicatopenipe.escuelasconduccion.com/cat-producto/licencias-profesionales/" target="_blank">Más Información</a> </hr>
                </div>
                <div class="col-md-4 py-2 border">
                    
                        <img src="{{asset('image/d.png')}}" alt="imagen licencia tipo d" id="img-licenciad" class="p-1 img-fluid" >
                        <h3 class="text-dark text-center py-2">Licencia tipo D</h3>
                        <p class="text-dark  text-justify py-4">Servicio de pasajeros (intracantonales, interprovinciales, intra – provinciales, intraregionales y por cuenta propia); y para vehículos del Estado ecuatoriano comprendidos en el tipo B.</p>
                        <a type="button" class="btn btn-warning py-2" id="btnld"  href="https://sindicatopenipe.escuelasconduccion.com/cat-producto/licencias-profesionales/" target="_blank">Más Información</a></hr>
                </div>
                <div class="col-md-4 py-2 border">
                    
                        <img src="{{asset('image/e.png')}}" alt="imagen licencia tipo d"  id="img-licenciae" class="p-1 img-fluid" >   
                        <h3 class="text-dark text-center py-2">Licencia tipo E</h3>
                        <p class="text-dark text-justify py-4"> Camiones pesados y extra pesados con o sin remolque de más de 3,5 toneladas, tráiler, volquetas, tanqueros, plataformas públicas, cuenta propia, otros camiones y los vehículos estatales con estas características.</p>
                        <a type="button" class="btn btn-warning py-2" id="btnle"  href="https://sindicatopenipe.escuelasconduccion.com/cat-producto/licencias-profesionales/" target="_blank">Más Información</a></hr>
                </div>
            </div>
     
  </div>
  <div id="acercade" class="h-100 py-3">
         
            <div class="row h-100 justify-content-center py-4">
                <div class="col-md-6 align-self-center text-center py-4">                     
                        <h3 class="text-warning">Acerca de Escuela de conductores </br>Profesionales 4 De Octubre De Penipe </h3>
                        <P class="text-dark text-justify px-3">Escuela de conductores Profesionales 4 De Octubre ubicada en el canton Penipe es un empresa que se dedica a la Formación de conductores profesionales, conscientes de su identidad, con gran sentido de respeto, responsabilidad y solidaridad, de formación humanística, con actitud técnica científica, capacidad de liderazgo, comprometidos con el cambio social.</p>
                        <a type="button" class="btn  btn-dark float-right" id="btnacerca"  href="https://sindicatopenipe.escuelasconduccion.com/cat-producto/licencias-profesionales/" target="_blank">Más Información</a>
                </div>
                <div class="col-md-6 align-self-center text-center py-4  ">           
                        <img src="{{asset('image/acerca.jpg')}}" alt="imagen licencia tipo d" id="img-acercade" class="pr-2 img-fluid center  rounded-left" >
                </div>
                
            </div>
     
  </div>     
  <div id="contacto" class="container-fluid py-4">
         
            <div class="row h-100 w-100 justify-content-center py-4">
               
                <div class="col-md-6 align-self-center  px-2 py-5">           
                    <h1 class="w-100 text-warning text-center ">Contáctanos </h1>
                    <div class="row w-100 text-center">
                        <div class="col-md-6 py-5">  
                           
                                <h5 class="col-md-6 text-warning float-left" >Dirección</h5></br>
                                <p class="col-md-12 text-dark float-left" >Penipe Av Amazonas Sn Y Via A Banos</p></br></br></br></br></br></br>
                                <h5 class="col-md-6 text-warning float-left">Horarios</h5>
                                <p class="col-md-12 text-dark float-left" >Jornada vispertina-Jornada nocturna</br>

                                    LUN-VIE </br>

                                    Jornada de fines de semana</br>

                                    SAB-DOM
                                </p>
                            
                        </div>
                        <div class="col-md-6 py-5">
                            <h5 class="col-md-6 text-warning float-left">Contácto</h5>
                            <p class="col-md-12 text-dark float-left" >Teléfono:</br> +593 97 906 5800</p>
                            <p class="col-md-12 text-dark float-left" >Correo:</br>info@sindicatochoferespenipe.com</p>
                            <h5 class="col-md-6 text-warning float-left">Síguenos</h5> 
                            <p class="col-md-12 text-dark float-left p-0" ></p>
                   
                            <div class="row w-100 text-center  justify-content-center">
                                <a class="btn btn-primary rounded" id="btnfacebook"href="https://www.facebook.com/Sindicato-de-Choferes-Profesionales-4-de-Octubre-de-Penipe-1713075182043802/" role="button" title="Ir a facebook" target="_blank"><i class="fa fa-facebook"></i></a>     
                                <p class="col-1" ></p>
                                <a class="btn btn-primary rounded" id="btntwetter" href="www.twetter.com" role="button" title="Ir a twtter">
                                        <i class="fa fa-twitter"></i>
                                </a>   
                                  
                            </div>       
                         

                        </div>
                    </div>
                </div>
                <div class="col-md-6  justify-content-center text-center px-2 rounded w-100">                     
                    <iframe title="Mapa de localizacion de sindicato de choferes" id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.3361818328326!2d-78.53269878599112!3d-1.5617765988610663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d3a386755d3285%3A0xb8d67784a92a2079!2sSindicato%20De%20Choferes%20Profesionales%204%20De%20Octubre!5e0!3m2!1ses!2sec!4v1612290253592!5m2!1ses!2sec"  frameborder="0"  allowfullscreen="" aria-hidden="false" tabindex="0" class="px-2 text-center"></iframe>
                </div>
                
            </div>
     
  </div>     

      

  @extends('template/footer')  
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 

</body>

</html>
