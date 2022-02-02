<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Slabo</title>
        <style>
             .box2 
            {
                display: inline-flex;
                width: 100%;
                margin: 0;
                text:center;
                margin: 0px;
            }
            .push3 { 
                display: inline;
                margin: 0;
                float:left;
                padding-left:0px;
                margin: 0px;
                width: 100%;
            }
            .push4 {
                width: 100%;
                display: inline;
                text-align: center;
                padding-top:10px;
                padding-left:80px;
                padding-right:0px;
                margin: 0px;
                float:right;
            }
            #titulo
            {
                font-family: Arial, Helvetica, Sans-serif;
                margin: 0;
                text-align: center;   
            }
            #logo
            {
                width: 75px;
                height: 75px;
                text-align: center; 
            }
            .body {
                margin: 0cm 1.5cm 1.5cm;
            }
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1.5cm;
                background-color: #DAA520;
                color: white;
                text-align: center;
                line-height: 20px;
            }
            #Titulo
            {
                font-family: Arial, Helvetica, Sans-serif;
                color:BLACK;
                text-align: center;
                font-weight: normal;
                padding: 0px;
            }
            #subtitulo
            {
                font-family: Arial, Helvetica, Sans-serif;
                text-align: center;
                font-weight: normal;
            }
            h2
           {
                text-decoration: none;
                color:black;
                margin: 0.5em;
           }
           h3
           {
                text-decoration: none;
                color:black;
                margin: 0.5em;
           }
           h4
           {
                color:black;
                text-align: center;
                text-decoration: none; 
                margin: 0;
           }
           h5
           {
                color:black;
                text-align: center;
           }
           p 
           {
             margin: 0.5em;
           }

           table {
                border:1px solid;
                border-collapse: collapse;
                margin-bottom: 0px;
                margin-left: 3px;
                margin-right: 0px;
                margin-top: 0px;
                width: 100%;
                text-align:center;
            }
            th, td {
                width: 25%;
                text-align: left;
                vertical-align: top;
                border: 1px solid #000;
                border-spacing: 0;
                padding-left: 3px;
                padding-right: 3px;
                padding-top: 3px;
                padding-bottom: 3px;
                font-size: 0.7em;
                text-align:center;
            }
            .encabezadoTabla{
                font-weight: bold;
            }
            .mayusculas{
                text-transform: uppercase;
            }
            .titulo1
            {  
                font-style: normal;
                font-weight: bold;
                text-transform: uppercase;   
                margin: 5px; 
                font-size: 11;
                text-align: center;  
            }
            .titulo2
            {  
                font-weight: bold;
                text-transform: uppercase;  
                text-align: left;  
                font-size: 9;
            }
            .normal
           {
            font-weight: normal;
           }
            .box 
            {
                display: inline-block;
                width: 100%;
                padding-left:30px ;
                margin: 0px;
                font-size: 0.7em;
                padding: 5px;
            }
            .push { 
               
                display: inline;
                text:center;
                margin: 0;
                font-size: 10;
            }
            .push2 {
                display: inline;
                text:center;
                align-content: end;
                padding-left:650px ;
                margin: 0;
                font-size: 10;
            }
           .subtemasp
           {
            padding-left:3px; ;
           }
           #seccionDatosInformativos
           {
               margin: 10px;
           }
           #avancesAcademicos
           {
            margin-left: -50px;
           }
        </style>
    </head>
    <body >
        <div class="body">
            <div class="col-md-2 p-0 border-right mt-2" id="caja-logo" >
                        <div id="" class="box2">
                            <div id="" class="push3">
                                <img id="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/logo_empresa.png'))) }}">
                            </div>
                            <div class="push4">
                                <h3>ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES 4 DE OCTUBRE</h3>
                            </div>
                        </div>
                        <h4 class="" href="#">AVANCE ACADÉMICO</h4>
            </div>
            <div id="seccionDatosInformativos"  >      
                @foreach ($datos as $dato)
                            <div class="titulo2">Licencia: <spam class="normal"> tipo {{$dato->nombre_tlic}} Paralelo {{$dato->nombre_paralelo}} </spam></div>
                            <div class="titulo2">Módulo: <spam class="normal">{{$dato->nombre_mod}} </spam></div>
                            <div class="titulo2">Período Académico: <spam class="normal">{{$dato->fechaini}} - {{$dato->fechafin}} </spam></div>
                            <div class="titulo2">DOCENTE: <spam class="normal">{{$dato->instruccion_doc}} {{$dato->apellido_doc}} {{$dato->name}} </spam></div>
                            <div class="titulo2">CI: <spam class="normal">{{$dato->cedula_doc}}</spam></div>
                            <div class="box">
                                <div class="push">Del {{$fechainicio}}</div>
                                <div class="push2">Al {{$fechafin}}</div>
                            </div>       
                @endforeach    
            </div>
            <table id="avancesAcademicos" class="">
                <tr >
                    <td class="encabezadoTabla">FECHA</td>
                    <td class="encabezadoTabla">HORA</td>
                    <td class="encabezadoTabla">CURSO</td>
                    <td class="encabezadoTabla">MÓDULO</td>
                    <td class="encabezadoTabla">PARALELO</td>
                    <td class="encabezadoTabla">TEMA-CONTENIDOS</td>
                    <td class="encabezadoTabla">METODOLOGÍA</td>
                    <td class="encabezadoTabla">RECURSO</td>
                    <td class="encabezadoTabla">ACTIVIDADES DE EVALUACIÓN</td>
                    <td class="encabezadoTabla">EVIDENCIAS</td>
                    <td class="encabezadoTabla">MOTIVO INASISTENCIA</td>
                    <td class="encabezadoTabla">OBSERVACIÓN</td>
                </tr>
                <tbody class=""> 
                    @foreach ($avances as $avance)
                        <tr class="">    
                            <td class="">{{$avance->fecha_avance}}</td>
                            <td class="">{{$avance->hora_avance}}</td>
                            <td class="">Licencia tipo {{$avance->nombre_tlic}} <p>Modalidad: {{$avance->modalidad}} - {{$avance->jornada}} </p></td>
                            <td class="">{{$avance->nombre_mod}}</td>
                            <td class="">{{$avance->nombre_paralelo}}</td>
                            <td class="">
                                @php
                                   $temaUnidad="";
                                   $temaTema="";
                                @endphp  
                                @foreach ($subtemas as $subtema)

                                    @if($avance->id_avance==$subtema->id_avance)
                                        @if($temaUnidad!==$subtema->titulo_unidad)
                                            <p class="mayusculas">unidad: {{$subtema->titulo_unidad}}</p>
                                        @endif
                                        @if($temaTema!==$subtema->titulo_tema)
                                            <p class="">{{$subtema->titulo_tema}} </p>
                                        @endif
                                             <p class="subtemasp">-{{$subtema->titulo_subtema}}</p>
                                        @php
                                            $temaUnidad=$subtema->titulo_unidad;
                                            $temaTema=$subtema->titulo_tema;
                                        @endphp 
                                         
                                    @endif

                                @endforeach 
                            </td>
                            <td class="">{{$avance->metodologias_avance}}</td>
                            <td class="">{{$avance->recursos_avance}}</td>
                            <td class="">{{$avance->actividades_avance}}</td>
                            <td class="">{{$avance->evidencias_avance}}</td>
                            <td class="">{{$avance->motivo_inasistencia_avance}}</td>
                            <td class="">{{$avance->observacion_avance}}</td>
                        </tr>
                    @endforeach         
                </tbody>                                      
            </table>
        </div>
    </body>
</html>
