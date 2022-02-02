<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Slabo</title>
        <style>
            #titulo
            {
                font-family: Arial, Helvetica, Sans-serif;
                padding: 1px;
                text-align: center;   
            }
            #caja-logo
            {
                text-align: center;
            }
            #logo
            {
                width: 150px;
                height: 150px;
                text-align: center;
            }
            body {
                margin: 0cm 2cm 2cm;
                background: black;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none; 
            }
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                background-color: #DAA520;
                color: white;
                text-align: center;
                line-height: 20px;
            }
            #titulosistemaacademico{
                color:black;
            }
            #Titulo
            {
                font-family: Arial, Helvetica, Sans-serif;
                color:BLACK;
                text-align: center;
                font-weight: normal;
                padding:  0 10px 0 10px;
            }
            #subtitulo
            {
                font-family: Arial, Helvetica, Sans-serif;
                text-align: center;
                font-weight: normal;
                padding:  0px 20px 0px 20px;
            }
            h2
           {
            text-decoration: none;
            color:black;
           }
           h3
           {
            text-decoration: none;
            color:black;
           }
           h4
           {
            color:black;
           }
            table {
                border:1px solid;
                border-collapse: collapse;
                margin-bottom: 0px;
                margin-left: 15px;
                margin-right: 0px;
                margin-top: 0px;
                width: 100%;
            }
            th, td {
                width: 25%;
                text-align: left;
                vertical-align: top;
                border: 1px solid #000;
                border-spacing: 0;
                padding-left: 10px;
                padding-right: 10px;
                padding-top: 5px;
                padding-bottom: 5px;
            }
            .columna
            {
                font-weight: bold;
                text-transform: uppercase; 
                min-width: 100%;
                background:#DCDCDC;
            }
            .unidadesTable
            {
                width: 100%;
                text-align: left;
            }
            .tituloUnidad
            {
                font-weight: bold;
                text-transform: uppercase; 
                padding-left: 20px;
                background:#C0C0C0
            }
            .tituloFila2
            {
                font-weight: bold;
                text-transform: none; 
                padding-left: 30px;
                background:rgb(220, 220, 220);
                opacity: 0.9;
            }
            .tituloFila3
            {
                background:none;
            }
            .tituloTemac
            {
                font-style: italic;
                text-transform: none;   
                padding-left: 50px;
            }
            .subtemas
            {  
                padding-left: 50px;
            }
            .evaluaciones
            {  
                font-style: normal;
                font-weight: normal;
                text-transform: none;   
            }
            .evaluaciones2
            {  
                font-style: italic;
                font-weight: normal;
                text-transform: none;   
            }
            .porcentajes2
            {  
                text-align: center;
                font-weight: bold;
                background:#C0C0C0
            }
            .datosAsignatur
            {
                font-weight: bold;
                background:#C0C0C0
            }
            .TitBib
            {
                font-weight: bold;
                padding: 2px;
                background:#C0C0C0
            }
            .documentT
            {
                background:white;
                padding:60px;
                margin:240px;
                margin-top:0px;
                margin-bottom:0px;
            }
        </style>
    </head>
    <body class="px-4" >
        <div class="documentT">
            <input type="hidden" id="txtIdSilaboDir" name="txtIdSilaboDir" value="{{session('idSilaboDir')}}"><!--datos session-->
            <div class="col-md-2 p-0 border-right mt-2" id="caja-logo" >
                        <div id="caja-logo">
                            <img id="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/logo_empresa.png'))) }}">
                        </div>
                        <div id="Titulo">
                            <h3>ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES 4 DE OCTUBRE</h3>
                        </div>
            </div>
          
            <div id="subtitulo" class="">
                <h3 class="" href="#">SÍLABO DE DOCENTE</h3> 
            </div>
            <div class="p-3 border ">
                <div class="justify-content" >
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h3 class="Subtitulos" href="#">1.- DATOS INFORMATIVOS</h3> 
                        </div>
                    </div> 
                    <br >
                    <div id="seccionDatosInformativos"  >
                            <div id="datosInformativos" class="p-2">      
                                <table id="tablaDatos" class="table table-bordered table-responsive-lg w-100">
                                    <thead class="font-weight-bold text-center " >     
                                    </thead>  
                                    <tbody class="">    
                                        @foreach ($datos as $dato)
                                            <tr class="bg-light font-weight-bold text-muted">    
                                                <td class="columna">Institución</td>  
                                                <td class="py-1">{{$dato->escuela}}</td>
                                            </tr>
                                            <tr class="bg-light font-weight-bold text-muted">    
                                                <td class="columna">Plan de estudio</td>  
                                                <td class="py-1">{{$dato->plan_estudio}}</td>
                                            </tr>
                                            <tr class="bg-light font-weight-bold text-muted">    
                                                <td class="columna">área académica</td>  
                                                <td class="py-1">EDUCACIÓN</td>
                                            </tr>
                                            <tr class="bg-light font-weight-bold text-muted">    
                                                <td class="columna">Nombre de la asignatura</td>  
                                                <td class="py-1">{{$dato->nombre_mod}}</td>
                                            </tr>
                                            <tr class="bg-light font-weight-bold text-muted">    
                                                <td class="columna">Tipo licencia</td>  
                                                <td class="py-1">{{$dato->nombre_tlic}}</td>
                                            </tr>
                                            <tr class="bg-light font-weight-bold text-muted">    
                                                <td class="columna">Período académico</td>  
                                                <td class="py-1">Desde {{$dato->fechaini}} Hasta {{$dato->fechafin}}</td>
                                            </tr>
                                            <tr class="bg-light font-weight-bold text-muted">    
                                                <td class="columna">Fecha de creación</td>  
                                                <td class="py-1">{{$dato->fecha_creacion}}</td>
                                            </tr>
                                            <tr class="bg-light font-weight-bold text-muted">    
                                                <td class="columna">Número de horas</td>  
                                                <td class="py-1">{{$dato->duracion_horas}}</td>
                                            </tr>
                                            <tr class="bg-light font-weight-bold text-muted">    
                                                <td class="columna">Paralelo</td>  
                                                <td class="py-1">{{$dato->nombre_paralelo}}</td>
                                            </tr>
                                            <tr class="bg-light font-weight-bold text-muted">    
                                                <td class="columna">Tipo de asignatura</td>  
                                                <td class="py-1">Obligatoria</td>
                                            </tr>
                                            <tr class="bg-light font-weight-bold text-muted">    
                                                <td class="columna">DOCENTE</td>  
                                                <td class="py-1">{{$dato->instruccion_doc}} {{$dato->apellido_doc}} {{$dato->name}}</td>
                                            </tr>
                                        @endforeach              
                                    </tbody>                                 
                                </table>                          
                            </div> 
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h3 class="text-left font-weight-normal text-dark" href="#">2.- PRERREQUISITOS</h3>
                        </div>
                    </div>
                    <BR>
                    <div id="seccionPrerrequisitos" class="overflow-scroll">
                        <div class="p-2">      
                            <table class="table table-bordered table-responsive-lg w-100"> 
                                <thead class="font-weight-bold text-center " >
                                    <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="columna">COMPETENCIAS </td>      
                                    </tr>  
                                </thead>  
                                        @php
                                            $i=1;
                                        @endphp                         
                                    @foreach ($prerrequisitos as $prerrequisito)     
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="py-1">{{$i}}.- {{$prerrequisito->descripcion_prerrequisito}}</td>
                                        </tr>
                                        @php
                                            $i=$i+1;                      
                                        @endphp
                                    @endforeach                           
                            </table>                                      
                        </div> 
                    </div>
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content">
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h3 class="text-left font-weight-normal text-dark" href="#">3.- DATOS DE LA ASIGNATURA</h3>
                        </div>
                    </div>
                    <div id="seccionDatosAsignatura" class="overflow-scroll px-3">
                        <div class="p-2">      
                            <table class="table table-bordered table-responsive-lg w-100">                            
                                    @foreach ($datosAsignaturas as $datosAsignatura)     
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="columna">Descripción de la asignatura</td>     
                                        </tr>
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="py-1">{{$datosAsignatura->descripcion_asignatura}}</td>
                                        </tr>
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="columna">Competencias que aporta la asignatura</td>
                                        </tr>
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="py-1">{{$datosAsignatura->competencia_asignatura}}</td>
                                        </tr>
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="columna">Resultado de aprendizaje que aporta la asignatura</td>
                                        </tr>
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="py-1">{{$datosAsignatura->resultado_asignatura}}</td>
                                        </tr>
                                    @endforeach                           
                            </table>                                      
                        </div> 
                    </div>
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h3 class="text-left font-weight-normal text-dark" href="#">4.- UNIDADES</h3>
                        </div>
                        <div class="p-2">      
                            <table class="unidadesTable "> 
                                        @php
                                            $i=1;
                                            $t=1;
                                            $s=1;
                                            $titulou="";
                                            $tituloTema="";
                                        @endphp    
                                    @foreach ($unidades as $unidad)   
                                            @if($titulou==$unidad->id_unidad)    
                                            @else
                                                @if($i!=1)
                                                    <tr class="bg-light font-weight-bold text-muted">    
                                                        <td class="tituloUnidad" colspan="2"></td>
                                                    </tr>
                                                @endIf 
                                                <tr class="bg-light font-weight-bold text-muted">    
                                                    <td class="tituloUnidad" colspan="2">unidad {{$i}}.- {{$unidad->titulo_unidad}} <br>criterio de evaluación: {{$unidad->criterioevaluacion_unidad}} <br>  Horas de undiad: {{$unidad->horas_unidad}}  </td>
                                                </tr>
                                                <tr class="bg-light font-weight-bold text-muted">    
                                                                        <td class="tituloFila2">Evaluaciones</td>
                                                                        <td class="tituloFila3">
                                                                            @foreach ($evaluacionesU as $evaluacion)
                                                                                @if($unidad->id_unidad==$evaluacion->id_unidad)  
                                                                                            <div class="evaluaciones"><spam class="evaluaciones2">Tipo evaluación:</spam> {{$evaluacion->tipo_evaluacion}} <br><spam class="evaluaciones2">Detalle de evaluación:</spam>  {{$evaluacion->detalle_evaluacion}}</div> 
                                                                                    @php
                                                                                        $s=$s+1;                         
                                                                                    @endphp
                                                                                @endIf 
                                                                            @endforeach
                                                                        </td>
                                                </tr>  
                                                <tr class="bg-light font-weight-bold text-muted">  
                                                                        <td class="tituloFila2">Técnicas e instrumentos</td>
                                                                        <td class="tituloFila3">
                                                                            @foreach ($tecnicasU as $tecnica)
                                                                                @if($unidad->id_unidad==$tecnica->id_unidad)  
                                                                                            <div class="evaluaciones"><spam class="evaluaciones2">Técnicas:</spam> {{$tecnica->tecnica}} <br><spam class="evaluaciones2">Instrumentos:</spam>  {{$tecnica->instrumento}}</div>   
                                                                                    @php
                                                                                        $s=$s+1;                         
                                                                                    @endphp
                                                                                @endIf 
                                                                            @endforeach
                                                                        </td>
                                                </tr> 
                                                <tr class="bg-light font-weight-bold text-muted">    
                                                                        <td class="tituloFila2">Resultados</td>
                                                                        <td class="tituloFila3">
                                                                            @foreach ($resultadosU as $resultado)
                                                                                @if($unidad->id_unidad==$resultado->id_unidad)  
                                                                                            <div class="evaluaciones">{{$resultado->resultado}} </div>    
                                                                                    @php
                                                                                        $s=$s+1;                         
                                                                                    @endphp
                                                                                @endIf 
                                                                            @endforeach
                                                                        </td>
                                                </tr> 
                                                <tr class="bg-light font-weight-bold text-muted">    
                                                                        <td class="tituloFila2">Temas</td>
                                                                        <td class="tituloFila2">Subtemas</td>
                                                </tr>  
                                                    @foreach ($unidades as $tema)     
                                                        @if($tituloTema==$tema->id_tema) 
                                                        @else   
                                                                @if($unidad->id_unidad==$tema->tema_id_unidad) 
                                                                    <tr class="bg-light font-weight-bold text-muted">    
                                                                        <td class="tituloTemac" colspan="">Tema {{$t}}.- {{$tema->titulo_tema}}</td>
                                                                        <td>
                                                                            @foreach ($unidades as $subtema)
                                                                                @if($tema->id_tema==$subtema->subtema_id_tema)  
                                                                                            <div class="subtemas">{{$subtema->titulo_subtema}}</div>
                                                                                           
                                                                                    @php
                                                                                        $s=$s+1;                         
                                                                                    @endphp
                                                                                @endIf 
                                                                            @endforeach
                                                                        </td>  
                                                                    </tr>
                                                                    @php
                                                                        $tituloTema=$tema->id_tema;   
                                                                        $t=$t+1;                         
                                                                    @endphp
                                                                @endIf
                                                        @endIf
                                                    @endforeach
                                                @php
                                                    $titulou=$unidad->id_unidad;   
                                                    $i=$i+1;                  
                                                @endphp
                                            @endIf
                                    @endforeach                      
                            </table>                                      
                        </div> 
                    </div>
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h3 class="text-left font-weight-normal text-dark" href="#">5.- PONDERACIÓN PARA LA EVALUACIÓN DEL ESTUDIANTE POR ACTIVIDADES DE APRENDIZAJE</h3>
                        </div>
                    </div>
                    <BR>
                </div>
                <div class="overflow-scroll px-3" id="seccionPonderacion">
                    <table id="tablaSubtemas" class="table table-bordered table-responsive-lg w-100">
                            <tbody class="text-center text-dark align-middle">        
                                        <tr>
                                            <td class="tituloUnidad" >Descripción</td>
                                            <td class="tituloUnidad" >Porcentaje %</td>
                                        </tr>   
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="tituloUnidad">DOCENCIA (Asistido por el profesor)</td>  
                                            <td class="porcentajes2">5</td>
                                        </tr>
                                        <tr>    
                                        <td class="col-md-12 align-middle"colspan="2">
                                                    <ul>
                                                        <li class="text-left">Pruebas Orales </li>
                                                        <li class="text-left">Pruebas Escritas </li>
                                                        <li class="text-left">Tareas </li>
                                                        <li class="text-left">Foros </li>
                                                    </ul>
                                            </td>  
                                        </tr>
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="tituloUnidad">PRACTICAS DE APLICACIÓN Y EXPERIMENTCACIÓN</td>  
                                            <td class="porcentajes2">5</td>
                                        </tr>
                                        <tr>    
                                            <td class="col-md-12 align-middle"colspan="2">
                                                    <ul>
                                                        <li class="text-left">Talleres</li>
                                                        <li class="text-left">Trabajos Grupales</li>
                                                        <li class="text-left">Trbajos individuales</li>
                                                        <li class="text-left">Participación en clase </li>
                                                    </ul>
                                            </td>  
                                        </tr>
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="tituloUnidad">ACTIVIDADES DE APRENDIZAJE AUTÓNOMO</td>  
                                            <td class="porcentajes2">5</td>
                                          
                                        </tr>
                                        <tr>    
                                        <td class="col-md-12 align-middle"colspan="2">
                                                    <ul>
                                                        <li class="text-left">Demostración teórica practica </li>
                                                        <li class="text-left">Participación individual</li>
                                                        <li class="text-left">Demostracion de destrezas y competencias</li>
                                                    </ul>
                                            </td>  
                                        </tr>
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="tituloUnidad">APORTE FINAL</td>  
                                            <td class="porcentajes2">5</td>
                                           
                                        </tr>
                                        <tr>    
                                            <td class="col-md-12 align-middle"colspan="2">
                                                    <ul>
                                                        <li class="text-left">Examen escrito y/o examen Oral</li>
                                                    </ul>
                                            </td>  
                                        </tr>
                                        <tr>    
                                            <td class="tituloUnidad">TOTAL</td>  
                                            <td class="porcentajes2">20</td>  
                                        </tr>
                            </tbody>                                 
                    </table>  
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h3 class="text-left font-weight-normal text-dark" href="#">6.- METODOLOGÍA DE ENSEÑANZA APRENDIZAJE</h3>
                        </div>
                    </div>
                    <BR>
                    <div id="seccionmetodologias" class="overflow-scroll">
                        <div class="p-2">      
                            <table class="table table-bordered table-responsive-lg w-100"> 
                                <thead class="font-weight-bold text-center " >
                                    <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="columna">METODOLOGIAS</td>      
                                    </tr>  
                                </thead>  
                                        @php
                                            $numM=1;
                                        @endphp                         
                                    @foreach ($metodologias as $metodologia)     
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="py-1">{{$numM}}.- {{$metodologia->descripcion_metodo}}</td>
                                        </tr>
                                        @php
                                            $numM=$numM+1;                      
                                        @endphp
                                    @endforeach                           
                            </table>                                      
                        </div> 
                    </div>
                    <BR>
                    <div id="seccionRecurso" class="overflow-scroll">
                        <div class="p-2">      
                            <table class="table table-bordered table-responsive-lg w-100"> 
                                <thead class="font-weight-bold text-center " >
                                    <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="columna">RECURSOS</td>      
                                    </tr>  
                                </thead>  
                                        @php
                                            $numR=1;
                                        @endphp                         
                                    @foreach ($recursos as $recurso)     
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="py-1">{{$numR}}.- {{$recurso->descripcion_recurso}}</td>
                                        </tr>
                                        @php
                                            $numR=$numR+1;                      
                                        @endphp
                                    @endforeach                           
                            </table>                                      
                        </div> 
                    </div>
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h3 class="text-left font-weight-normal text-dark" href="#">7.- ESCENARIOS DE APRENDIZAJE</h3>
                        </div>
                    </div>
                    <div id="seccionEscenariosAprensizaje" class="overflow-scroll px-3">
                        <div class="p-2">      
                            <table class="table table-bordered table-responsive-lg w-100"> 
                                <thead class="font-weight-bold text-center " >
                                    <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="datosAsignatur">Escenario</td>      
                                    </tr>  
                                </thead>  
                                        @php
                                            $numE=1;
                                        @endphp                         
                                    @foreach ($escenarios as $escenario)     
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="py-1">{{$numE}}.- {{$escenario->descripcion_escenario}}</td>
                                        </tr>
                                        @php
                                            $numE=$numE+1;                      
                                        @endphp
                                    @endforeach                           
                            </table>                                      
                        </div> 
                    </div>    
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h3 class="text-left font-weight-normal text-dark" href="#">8.- BIBLIOGRAFÍA</h3>
                        </div>
                    </div>
                    <div id="seccionBibliografia" class="overflow-scroll px-3">
                    <div class="p-2">      
                            <table class="table table-bordered table-responsive-lg w-100"> 
                                <thead class="font-weight-bold text-center " >
                                    <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="TitBib">Tipo</td>   
                                            <td class="TitBib">Título</td>   
                                            <td class="TitBib">Autor</td>   
                                            <td class="TitBib">Documento</td>   
                                            <td class="TitBib">Editorial</td>   
                                            <td class="TitBib">Fecha </td>   
                                            <td class="TitBib"># Pag</td>      
                                    </tr>  
                                </thead>   
                                <tbody>                    
                                    @foreach ($bibliografias as $bibliografia)     
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="">{{$bibliografia->tipo_bibliografia}}</td>   
                                            <td class="">{{$bibliografia->titulo_bibliografia}}</td>   
                                            <td class="">{{$bibliografia->autor_bibliografia}}</td>   
                                            <td class="">{{$bibliografia->tipo_documento_bibliografia}}</td>   
                                            <td class="">{{$bibliografia->editorial_bibliografia}}</td>   
                                            <td class="">{{$bibliografia->fecha_publicacion_bibliografia}}</td>   
                                            <td class="">{{$bibliografia->numero_pagina_bibliografia}}</td>      
                                        </tr>
                                    @endforeach  
                                </tbody>                           
                            </table>                                      
                        </div> 
                    </div>    
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h3 class="text-left font-weight-normal text-dark" href="#">9.- BIBLIOGRAFÍA COMPLEMENTARIA</h3>
                        </div>
                    </div>
                    <div id="seccionBibliografiaComplementaria" class="overflow-scroll px-3">
                        <div class="p-2">      
                            <table class="table table-bordered table-responsive-lg w-100"> 
                                <thead class="font-weight-bold text-center " >
                                    <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="datosAsignatur">Bibliografía Complementaria</td>      
                                    </tr>  
                                </thead>      
                                <tbody> 
                                    <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="">               
                                                @foreach ($bibliografiasComplementarias as $bibliografiaComplementaria)     
                                                        <div class="">{{$bibliografiaComplementaria->descripcion_bibliografia}}</div>
                                                @endforeach    
                                </tbody>     
                                            </td>      
                                    </tr>                      
                            </table>                                      
                        </div> 
                    </div>    
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h3 class="text-left font-weight-normal text-dark" href="#">10.- WEBGRAFÍA</h3>
                        </div>
                    </div>
                    <div id="seccionWebgrafia" class="overflow-scroll px-3">
                        <div class="p-2">      
                            <table class="table table-bordered table-responsive-lg w-100"> 
                                <thead class="font-weight-bold text-center " >
                                    <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="datosAsignatur">Webgrafía</td>      
                                    </tr>  
                                </thead>   
                                <tbody> 
                                    <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="">               
                                                @foreach ($webgrafias as $webgrafia)     
                                                        <div class="">{{$webgrafia->descripcion_webgrafia}}</div>
                                                @endforeach    
                                </tbody>     
                                            </td>      
                                    </tr>                      
                            </table>                                      
                        </div> 
                    </div>    
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h3 class="text-left font-weight-normal text-dark" href="#">11.- BIBLIOGRAFÍA DIGITAL</h3>
                        </div>
                    </div>
                    <div id="seccionBibliografiaDigital" class="overflow-scroll px-3">
                        <div class="p-2">      
                            <table class="table table-bordered table-responsive-lg w-100"> 
                                <thead class="font-weight-bold text-center " >
                                    <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="datosAsignatur">Bibliografía digital</td>      
                                    </tr>  
                                </thead>  
                                        
                                <tbody> 
                                    <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="">               
                                                @foreach ($bibliografiasDigitales as $bibliografiaDigital)     
                                                        <div class="">{{$bibliografiaDigital->descripcion_bdigital}}</div>
                                                @endforeach    
                                </tbody>     
                                            </td>      
                                    </tr>                      
                            </table>                                      
                        </div> 
                    </div>    
                </div>
            </div>
    </body>
</html>
