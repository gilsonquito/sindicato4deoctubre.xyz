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
            text-align: center;
            
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
                font-size: 9;
            }
            .titulo2
            {  
                font-weight: bold;
                text-transform: uppercase;  
                text-align: center;  
                font-size: 9;
            }
            .box 
            {
                display: inline-flex;
                width: 100%;
                margin: 0;
                text:center;
            }
            .push { 
                display: inline;
                margin: 0;
                float:left;
                padding-left:20px;
            }
            .push2 {
                display: inline;
                text-align: center;
                padding-right:60px;
                margin: 0;
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
               
            }
            th {
                border:1px solid;
                width:10px;
                border-spacing: 0;
                font-size: 0.9em;
                max-width: 10px;
            }
            
            td {
                border:1px solid;
                width:10px;
                border-spacing: 0;
                font-size: 0.9em;
                max-width: 10px;
            }
            .divVertical {
                padding:0px;
                margin:0;

                transform: rotate(-90deg);
                -webkit-transform: rotate(-90deg);
                /* Safari/Chrome */
                -moz-transform: rotate(-90deg);
                /* Firefox */
                -o-transform: rotate(-90deg);
                /* Opera */
                -ms-transform: rotate(-90deg);
                /* IE 9 */
                height:80px;;
                max-width: 10px;
            }
            th.vertical {
                 height: min-content;
                 width: min-content;
                border:1px solid;
                max-width: 10px;
            }
            .columnaPrincipal
            {
                width: 200px;
                padding: 0px;
                margin:0;
            }
          
            .girar{
                height: 80px;
                max-width: 10px;
                margin-left:10px;
                margin-right:-10px;
                padding: 10px;
            }
            .box2
            {
                display: inline-flex;
                margin: 0;
            }
            .push3 { 
                display: inline;
                margin: 0;
                float:left;
                padding-left:0px;
            }
            .push4 {
                display: inline;
                text-align: center;
                padding-right:0px;
                margin: 0;
                float:right;
                transform: rotate(-90deg);
                -webkit-transform: rotate(-90deg);
                /* Safari/Chrome */
                -moz-transform: rotate(-90deg);
                /* Firefox */
                -o-transform: rotate(-90deg);
                /* Opera */
                -ms-transform: rotate(-90deg);
                /* IE 9 */
                
            }
            .nombres
            {
                text-align:left;
            }
            .divTabla
            {
               text-align:center;
            }
            .divFechasFinal
            {
                position: relative;
               transform: rotate(-90deg);
                -webkit-transform: rotate(-90deg);
                /* Safari/Chrome */
                -moz-transform: rotate(-90deg);
                /* Firefox */
                -o-transform: rotate(-90deg);
                /* Opera */
                -ms-transform: rotate(-90deg);
                /* IE 9 */
                width:80px;
                margin-left:-46.7px;
                padding-left:0px;
                padding-top:267px;
                height:110px;
            }
            #tablaHeaders
            {
                position: absolute;
                border:0px ;
            }
            .thheaders {
                border:0px solid;
                width:0px;
                border-spacing: 0;
                font-size: 0.9em;
                max-width: 100px;
                position: relative;
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
                        <h3 >REPORTE DE ASISTENCIAS</h3> 
            </div>
            <div id="seccionDatosInformativos"  >      
                @foreach ($datos as $dato)
                            <h4 class="titulo2">MÓDULO DE {{$dato->nombre_mod}} Licencia tipo {{$dato->nombre_tlic}} Paralelo {{$dato->nombre_paralelo}} </h4>
                            
                            @foreach ($periodos as $periodo)

                                <P class="titulo2">Período Académico {{$periodo->fechaini}} - {{$periodo->fechafin}}</P>
                            @endforeach
                          
                            <div class="titulo1">DOCENTE: <spam class="normal">{{$dato->instruccion_doc}} {{$dato->apellido_doc}} {{$dato->name}}</spam></div>   
                           
                            <div class="titulo1">CI: <spam class="normal">{{$dato->cedula_doc}}</spam></div>   
                           
                            <div class="box">
                                <p class="push">Desde {{$fechaini}}</p>
                                <p class="push2">Hasta {{$fechafin}}</p>
                            </div>       
                @endforeach    
            </div>
        </div>
        <table id="tablaHeaders" class="">
                    <thead >
                        <tr>
                                <th class="thheaders">
                                </th>
                                @php
                                    $fechaprimera="";
                                    $i=1;
                                @endphp
                                @foreach ($fechas as $fech)
                                    @if($fechaprimera!==$fech->fecha_asistencia)
                                            <th class="thheaders"><div class="divFechasFinal">{{$fech->fecha_asistencia}}</div></th>
                                    @endif
                                    @php
                                        $fechaprimera=$fech->fecha_asistencia;
                                    @endphp
                                @endforeach
                        </tr>
                    </thead>
        </table>
        <div class="divTabla">
            <table id="" class="yourtableclass">
                    <thead >
                        <tr>
                                <th class="columnaPrincipal">
                                    <div class="">Estudiante</div>
                                </th>
                                @php
                                    $fechaT="";
                                    $i=1;
                                @endphp
                                @foreach ($fechas as $fech)
                                    @if($fechaT!==$fech->fecha_asistencia)
                                            <th class="girar"><div class="box2"><p class="push3"></p><p class="push4"><p></div></th>
                                    @endif
                                    @php
                                        $fechaT=$fech->fecha_asistencia;
                                    @endphp
                                @endforeach
                                <th class="girar"><div class="giraar"><p class=""></p>%</div></th>
                        </tr>
                    </thead>
                    <tbody class=""> 
                        @php
                            $idEstudiante="";
                            $cont=0;
                            $contunico=1;
                            $contPresentes=0;
                        @endphp
                        @foreach ($estudiantes as $estudiante)
                            
                                @if($idEstudiante!==$estudiante->id_est) 
                                    <tr>
                                        <td class="nombres">{{$estudiante->apellido_est}} {{$estudiante->name_est}}</td>
                                        
                                        @foreach ($estudiantesOrders as $est)
                                            @if($estudiante->id_est==$est->id_est)
                                                    
                                                    @if($est->estado_asistencia=="PRESENTE")
                                                        <td>X</td>
                                                        @php
                                                            $contPresentes=$contPresentes+1;
                                                        @endphp
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                    @if($contunico==1)
                                                        @php
                                                            $cont=$cont+1;
                                                        @endphp
                                                    @endif
                                            @endif

                                        
                                        @endforeach
                                        @php
                                            $contunico=$contunico+1;
                                            $contPresentes=($contPresentes*100)/$cont;
                                            $porcentaje=bcdiv($contPresentes, '1', 2);
                                        @endphp
                                        <td>{{$porcentaje}} % </td>
                                    </tr>
                                    
                                @endif
                                @php
                                    $idEstudiante=$estudiante->id_est;
                                    $contPresentes=0;
                                @endphp
                            
                        @endforeach
                    
                    </tbody>    
            </table> 
        </div>                                   

    </body>
</html>
