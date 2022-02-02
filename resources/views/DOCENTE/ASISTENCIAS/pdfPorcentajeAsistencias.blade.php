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
                            <div class="titulo2">Licencia: <spam class="normal"> tipo {{$dato->nombre_tlic}} Paralelo {{$dato->nombre_paralelo}} </spam></div>
                            <div class="titulo2">Módulo: <spam class="normal">{{$dato->nombre_mod}} </spam></div>
                            @foreach ($periodos as $periodo)
                            <div class="titulo2">Período Académico: <spam class="normal">{{$periodo->fechaini}} - {{$periodo->fechafin}}</spam></div>
                            @endforeach
                            <div class="titulo2">DOCENTE: <spam class="normal">{{$dato->instruccion_doc}} {{$dato->apellido_doc}} {{$dato->name}}</spam></div>   
                            <div class="titulo2">CI: <spam class="normal">{{$dato->cedula_doc}}</spam></div>   
                @endforeach    
            </div>
            <table id="" class="yourtableclass">
                    <thead >
                        <tr>
                                <th class="">
                                    Estudiante
                                </th>
                                <th class="">% Porcentaje de Asistencia</th>
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
                                                        @php
                                                            $contPresentes=$contPresentes+1;
                                                        @endphp
                                                    @else
                                                       
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
    </body>
</html>
