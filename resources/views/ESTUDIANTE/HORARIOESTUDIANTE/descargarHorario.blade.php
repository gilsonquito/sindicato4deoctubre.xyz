<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href=" css/horariodocentepdf.css" rel="stylesheet">
        <title>Horario Docente</title>
        <style>
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
            table,td, th { border: 1px solid black; }
            table { border-collapse: collapse; margin: auto;text-align: center; }
            td, th { width: max-content; height: 10px; }
            #encabezado{
                font-weight: normal;
                color:#006400;
            }
            table.show {border-collapse:separate;
            empty-cells: hide;
            }
            body{width: 100%}
            #titulo
            {
                font-family: Arial, Helvetica, Sans-serif;
                padding: 1px;
                text-align: center;
            }
            #caja-logo
            {
                align-self: left;
            }
            #logo
            {
                width: 65px;
                height: 65px;
                text-align: start;
                margin:10px;
            }
            .box 
            {
                display: inline-flex;
                width: 100%;
                margin: 0;
                text:center;
            }
            .push { 
                font-size: 0.99em;
               float:left;
                padding-bottom:0px;
                padding-top:10px;
                font-weight:bold;
                color: black ;
                opacity: 0.85;
                text-transform:Uppercase;
            }
            .push2 {
                display: inline;
                text-align: center;
                padding-right:60px;
                padding-left:20px;
                margin-left: 20px;
                margin-top: -6px;
                float:right;
            }
            @page {
            margin: 0cm 0cm;
            font-family: Arial;
            }
            body {
                margin: 1cm 2cm 2cm;
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
                line-height: 30px;
            }
            #titulosistemaacademico{
                color:black;
            }
            #TITULO
            {
                font-family: Arial, Helvetica, Sans-serif;
                text-align: center;
                font-weight: bold;
                margin:3px;
                font-size:12;
                color:black;
            }
            tbody tr > td{
                    border-top:3px solid rgb(220,220,220);
                    padding: 5px;
                    color:rgb(0,0,0);
                }
                #g-table{
                    padding-left: 40px;
                    margin-top: 0px;
                }
                .espacio{
					height:10px;
				}
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
          .modulos
          {
              display:block;
              padding: auto;
              text-transform: uppercase;
              font-weight:bold;
                color: black;
                font-size:0.85em;
                font-style: italic;
          }
          .docentes
          {
            font-style: italic;
            font-size:0.75em;
          }
        </style>
    </head>
    <body>
            <div class="col-md-2 p-0 border-right mt-2" id="caja-logo" >
                       <div id="" class="box2">
                           <div id="" class="push3">
                               <img id="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/logo_empresa.png'))) }}">
                           </div>
                           <div class="push4">
                               <h3>ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES 4 DE OCTUBRE</h3>
                           </div>
                           <h4 id="TITULO" href="#">HORARIO DE ESTUDIANTE</h4>   
                       </div>
           </div>
           <div id="seccionDatosInformativos"  >    
                @php
                    $contdatos=1;
                @endphp    
               @foreach ($datos as $dato)
                    @if($contdatos==1)
                           <div class="titulo2">Licencia: <spam class="normal"> Tipo {{$dato->nombre_tipolicencia}}</spam></div>
                           <div class="titulo2">Paralelo: <spam class="normal"> {{$dato->nombre_paralelo}}</spam></div>
                           <div class="titulo2">Período Académico: <spam class="normal">{{$dato->fechaini}} - {{$dato->fechafin}} </spam></div>
                    @endif
                    @php
                        $contdatos=$contdatos+1;
                    @endphp   
               @endforeach    
           </div>
            <div class="container-fluid p-4 "><!--digeneral-->  
                                @php
                                    $periodos="";
                                @endphp 
                                @foreach ($horariosTotales as $horariot)
                                    @if($periodos!==$horariot->id_phorario)
                                        <div class="box">
                                            <p class="push">Desde {{$horariot->fecha_inicio}} Hasta {{$horariot->fecha_fin}}</p>
                                        </div>   
                                        <br>
                                        <br>
                                        <table id="tabla-horario">
                                                    <thead id="encabezado" >
                                                        <tr>
                                                            <td>Hora</td>
                                                            <td>Lunes</td>
                                                            <td>Martes</td>
                                                            <td>Miércoles</td>
                                                            <td>Jueves</td>
                                                            <td>Viernes</td>
                                                            <td>Sábado</td>
                                                            <td>Domingo</td>
                                                        </tr> 
                                                    </thead>
                                                <tbody>
                                                    @foreach ($horariosTotales as $horario2)
                                                        @if($horariot->id_phorario==$horario2->id_phorario)
                                                            <tr>   
                                                                @if($horario2->tipo_dias=="Lun-Vie")
                                                                    <td>{{$horario2->hora_inicio}} {{$horario2->hora_fin}}</td>
                                                                    <td><spam class="modulos">{{$horario2->nombre_mod}}</spam> <spam class="docentes"> {{$horario2->instruccion_doc}} {{$horario2->name}} {{$horario2->apellido_doc}} </spam> </td>
                                                                    <td><spam class="modulos">{{$horario2->nombre_mod}}</spam> <spam class="docentes"> {{$horario2->instruccion_doc}} {{$horario2->name}} {{$horario2->apellido_doc}} </spam> </td>
                                                                    <td><spam class="modulos">{{$horario2->nombre_mod}}</spam> <spam class="docentes"> {{$horario2->instruccion_doc}} {{$horario2->name}} {{$horario2->apellido_doc}} </spam> </td>
                                                                    <td><spam class="modulos">{{$horario2->nombre_mod}}</spam> <spam class="docentes"> {{$horario2->instruccion_doc}} {{$horario2->name}} {{$horario2->apellido_doc}} </spam> </td>
                                                                    <td><spam class="modulos">{{$horario2->nombre_mod}}</spam> <spam class="docentes"> {{$horario2->instruccion_doc}} {{$horario2->name}} {{$horario2->apellido_doc}} </spam> </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                @endif
                                                                @if($horario2->tipo_dias=="Sab-Dom")
                                                                    <td>{{$horario2->hora_inicio}} {{$horario2->hora_fin}}</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><spam class="modulos">{{$horario2->nombre_mod}}</spam> <spam class="docentes"> {{$horario2->instruccion_doc}} {{$horario2->name}} {{$horario2->apellido_doc}} </spam> </td>
                                                                    <td><spam class="modulos">{{$horario2->nombre_mod}}</spam> <spam class="docentes"> {{$horario2->instruccion_doc}} {{$horario2->name}} {{$horario2->apellido_doc}} </spam> </td>
                                                                @endif
                                                            </tr>
                                                        @endif 
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                        @php
                                            $periodos=$horariot->id_phorario;
                                        @endphp 
                                    @endforeach                 
            </div><!--digeneral-->  
    <body>
</html>

