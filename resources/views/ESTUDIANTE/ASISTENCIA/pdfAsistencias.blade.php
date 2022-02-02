<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Slabo</title>
        <script src="rotatetablecellcontent.js" type="text/javascript"></script>
        <style>
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
                text-align: left;
            }
            .body {
                margin: 0cm 1cm 1cm;
            }
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1cm;
                background-color: #DAA520;
                color: white;
                text-align: center;
                line-height: 20px;
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
            text:center;
           }
           h4
           {
            color:black;
            text-align: center;
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
            .box 
            {
                display: inline-flex;
                width: 100%;
                margin: 0;
                text:center;
                margin: 10px;
            }
            .push { 
                display: inline;
                margin: 0;
                float:left;
                padding-left:0px;
                margin: 10px;
            }
            .push2 {
                display: inline;
                text-align: center;
                padding-right:50px;
                margin: 10px;
                float:right;
                
            }
           .normal
           {
            font-weight: normal;
           }
            table {
                border:1px solid;
                border-collapse: collapse;
                text-align:center;
                align:center;
                margin: auto;
                margin-top:10px;
                width:90%;
            }
            th {
                border:1px solid;
                border-spacing: 0;
                font-size: 0.9em;
                padding:3px;
            }
            tr {
                border:1px solid;
                border-spacing: 0;
                font-size: 0.9em;
            }
            td {
                border:1px solid;
                border-spacing: 0;
                font-size: 0.9em;
                padding:3px;
            }
            .box2
            {
                display: inline-flex;
                margin: 0;
            }
            .nombres
            {
                text-align:left;
            }
            .divTabla
            {
              text-align:center;
            }
           #seccionDatosInformativos
           {
               padding: 5px;
           }
        </style>
    </head>
    <body >
        <div class="body">
            <div class="col-md-2 p-0 border-right mt-2" id="caja-logo" >
                        <div id="" class="box">
                            <div id="" class="push">
                                <img id="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/logo_empresa.png'))) }}">
                            </div>
                            <div class="push2">
                                <h3>ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES 4 DE OCTUBRE</h3>
                            </div>
                        </div>
                        <h3 class="titulo1" href="#">REPORTE DE ASISTENCIAS</h3>  
            </div>
            <div id="seccionDatosInformativos"  >      
                @foreach ($datos as $dato)
                            <div class="titulo2">Licencia: <spam class="normal"> tipo {{$dato->nombre_tipolicencia}} Paralelo {{$dato->nombre_paralelo}} </spam></div>
                            <div class="titulo2">Período Académico: <spam class="normal">{{$dato->fechaini}} - {{$dato->fechafin}}</spam></div>
                            @foreach ($modulos as $modulo)
                                <div class="titulo2">Módulo: <spam class="normal">{{$modulo->nombre_mod}}</spam></div> 
                            @endforeach 
                            <div class="titulo2">Estudiante: <spam class="normal">{{$dato->apellido_est}} {{$dato->name_est}}</spam></div>   
                @endforeach    
            </div>
            <table id="" class="yourtableclass">
                    <thead >
                        <tr>
                                <th class="">
                                    Fecha
                                </th>
                                <th class="">Asistencia</th>
                        </tr>
                    </thead>
                    <tbody class=""> 
                        @php
                            $idEstudiante="";
                            $cont=0;
                            $contunico=1;
                            $contPresentes=0;
                        @endphp
                        @foreach ($asistencias as $asistencia)
                                    <tr>
                                        <td class="nombres">{{$asistencia->fecha_asistencia}}</td>
                                        <td>{{$asistencia->estado_asistencia}}</td>
                                    </tr>
                        @endforeach
                        <tr>
                            @php
                                $contPresentes=0;
                                $contTotalP=0;
                            @endphp   
                            <th>TOTAL</th>
                            <th>
                                @foreach ($asistencias as $asistencia2)
                                    @php
                                        $contTotalP=$contTotalP+1;
                                    @endphp
                                    @if($asistencia2->estado_asistencia=="PRESENTE")
                                        @php
                                            $contPresentes=$contPresentes+1;
                                        @endphp  
                                    @endif
                                @endforeach
                                @if($contTotalP==0)
                                            <spam>--</spam>
                                @else
                                    @php
                                        $contPresentes=($contPresentes*100)/$contTotalP;
                                        $porcentaje=bcdiv($contPresentes, '1', 2);
                                    @endphp
                                    @if($porcentaje>=75)
                                        <spam class="porcentajeReprobado">{{$porcentaje}} % </spam>
                                    @else
                                        <spam class="porcentajeAprobado">{{$porcentaje}} % </spam>
                                    @endif
                                @endif  
                            </th>
                        </tr>
                    </tbody>    
            </table> 
    </body>
</html>
