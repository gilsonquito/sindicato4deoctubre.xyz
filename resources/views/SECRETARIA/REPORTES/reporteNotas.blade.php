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
        @php
            $CursoLic="";   
            $contModulos=0;
        @endphp  
        <div id="contenidoActualizar">
            <div class="form-inline py-3" >   
                <div class="col-md-11">  
                    <h4 class="w-100"><strong>ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES 4 DE OCTUBRE</strong></h4> 
                    <h4 class="w-100 text-center"><strong>REPORTE DE NOTAS</strong></h4> 
                </div> 
                <div class="col-md-1"> 
                    <img src="{{asset('image/logoempresa_exel.png')}}" alt="Logo del sindicato de choferes de penipe" class="img-fluid" id="" >
                </div> 
           </div>
              <br>
            @foreach ($estudiantes as $estudianteCur)  
                @if($estudianteCur->id_curlic!=$CursoLic)  
                <div class="font-weight-bold">PARALELO {{$estudianteCur->nombre_paralelo}}</div> 
                                <table id="tabla-horariodocente" class="table table-responsive table-hover w-100">
                                        <thead class="font-weight-bold text-center text-dark" >
                                            @php
                                                $modulos="";   
                                                $contFilas=0;  
                                            @endphp
                                                <tr>
                                                    @foreach ($estudiantes as $estudianteMod)
                                                        @if(($estudianteCur->id_curlic==$estudianteMod->id_curlic)&&($estudianteMod->id_mod!=$modulos))
                                                            @if($contFilas===0)
                                                                @php  
                                                                    $contFilas=$contFilas+1;
                                                                @endphp
                                                                <td class="align-middle" rowspan="3">#</td>
                                                                <td class="align-middle" rowspan="3">Apellidos</td>
                                                                <td class="align-middle" rowspan="3">Nombres</td>
                                                                <td class="align-middle" colspan="6"><h5>{{$estudianteMod->nombre_mod}}<h5></td>
                                                            @else
                                                                <td class="align-middle" colspan="6"><h5>{{$estudianteMod->nombre_mod}}</h5></td>
                                                            @endif
                                                                <td class="align-middle" rowspan="3">Nota Final</td>
                                                        @endif
                                                        @php
                                                            $modulos=$estudianteMod->id_mod; 
                                                        @endphp
                                                    @endforeach  
                                                    <td class="align-middle" rowspan="2" colspan="2"><h5>Promedios</h5></td>
                                                </tr>
                                                @php
                                                    $modulos="";   
                                                @endphp
                                                    @foreach ($estudiantes as $estudianteMod)
                                                        @if(($estudianteCur->id_curlic==$estudianteMod->id_curlic)&&($estudianteMod->id_mod!=$modulos))
                                                            <td class="align-middle" colspan="6">Notas</td>
                                                        @endif
                                                        @php
                                                            $modulos=$estudianteMod->id_mod;    
                                                        @endphp
                                                    @endforeach   
                                                <tr>
                                                    @php
                                                        $modulos="";
                                                    @endphp
                                                    @foreach ($estudiantes as $estudianteMod)
                                                        @if(($estudianteCur->id_curlic==$estudianteMod->id_curlic)&&($estudianteMod->id_mod!=$modulos))
                                                            @php
                                                                $contModulos= $contModulos+1;
                                                            @endphp
                                                            <td class="align-middle">Trabajo en Equipo</td>
                                                            <td class="align-middle">Estudios de Caso</td>
                                                            <td class="align-middle">Prueba Práctica</td>
                                                            <td class="align-middle">Prueba Teórica</td>
                                                            <td class="align-middle">Promedio</td>
                                                            <td class="align-middle">Suspenso</td>
                                                        @endif
                                                        @php
                                                            $modulos=$estudianteMod->id_mod;    
                                                        @endphp
                                                    @endforeach  
                                                    <td class="align-middle" >Promedio Módulos</td>
                                                            <td class="align-middle" >Observaciones</td> 
                                                </tr>
                                        </thead>
                                        <tbody class="text-center text-dark">
                                            @php
                                                $i=0;  
                                                $estudianteId="";
                                                $contFilas=0;
                                            @endphp         
                                            @foreach ($estudiantesLista as $estudiante)
                                                @if(($estudiante->id_est!=$estudianteId)&&($estudianteCur->id_curlic==$estudiante->id_curlic)) 
                                                    @php
                                                        $i=$i+1;
                                                        $PromedioTotal=0;
                                                    @endphp  
                                                    <tr>    
                                                        <td class="py-2 align-middle ">{{$i}}</td>
                                                        <td class="py-2 align-middle">{{$estudiante->apellido_est}}</td>
                                                        <td class="py-2 align-middle">{{$estudiante->name_est}}</td>
                                                        @foreach ($estudiantes as $estudianteNota)
                                                            @if($estudianteNota->id_est==$estudiante->id_est)
                                                                @php
                                                                    $sum=0;
                                                                    $sum2=0;
                                                                @endphp  
                                                                    @if($estudianteNota->nota_trabajo_equipo)
                                                                        <td class="py-2 align-middle">{{$estudianteNota->nota_trabajo_equipo}}</td>
                                                                    @else
                                                                        <td class="py-2 align-middle">--</td>
                                                                    @endIf
                                                                    @if($estudianteNota->nota_estudio_caso)
                                                                        <td class="py-2 align-middle">{{$estudianteNota->nota_estudio_caso}}</td>
                                                                    @else
                                                                        <td class="py-2 align-middle">--</td>
                                                                    @endIf
                                                                    @if($estudianteNota->nota_prueba_practica)
                                                                        <td class="py-2 align-middle">{{$estudianteNota->nota_prueba_practica}}</td>
                                                                    @else
                                                                        <td class="py-2 align-middle">--</td>
                                                                    @endIf
                                                                    @if($estudianteNota->nota_prueba_teorica)
                                                                        <td class="py-2 align-middle">{{$estudianteNota->nota_prueba_teorica}}</td>
                                                                    @else
                                                                        <td class="py-2 align-middle">--</td>
                                                                    @endIf
                                                                    <td class="py-2 align-middle">
                                                                        @php
                                                                            $sum2=($estudianteNota->nota_trabajo_equipo+$estudianteNota->nota_estudio_caso+$estudianteNota->nota_prueba_practica+$estudianteNota->nota_prueba_teorica)/4;
                                                                            $total1=bcdiv($sum2, '1', 2);
                                                                        @endphp
                                                                        <span class="font-weight-bold text-muted align-middle text-muted" >{{$total1}}/20</span>
                                                                </td>
                                                                    @if(($estudianteNota->nota_suspenso))
                                                                        <td class="py-2 align-middle">{{$estudianteNota->nota_suspenso}}</td>
                                                                    @else
                                                                        <td class="py-2 align-middle">--</td>
                                                                    @endIf
                                                                    <td class="py-2 align-middle">
                                                                        @if(($estudianteNota->nota_suspenso==null))
                                                                            @php
                                                                            $sum=($estudianteNota->nota_trabajo_equipo+$estudianteNota->nota_estudio_caso+$estudianteNota->nota_prueba_practica+$estudianteNota->nota_prueba_teorica)/4;
                                                                            $total2=bcdiv($sum, '1', 2);
                                                                            $PromedioTotal=$PromedioTotal+$total2;
                                                                            @endphp
                                                                            @if($total2>=16)
                                                                                <span class="font-weight-bold text-dark align-middle text-muted" >{{$total2}}</span>
                                                                            @else
                                                                                <span class="font-weight-bold text-danger align-middle " >{{$total2}}</span>
                                                                            @endif
                                                                        @else
                                                                            @php
                                                                                $sum=((($estudianteNota->nota_trabajo_equipo+$estudianteNota->nota_estudio_caso+$estudianteNota->nota_prueba_practica+$estudianteNota->nota_prueba_teorica)/4)+($estudianteNota->nota_suspenso))/(2);
                                                                                $total2=bcdiv($sum, '1', 2);
                                                                                $PromedioTotal=$PromedioTotal+$total2;
                                                                            @endphp
                                                                            @if($total2>=16)
                                                                                <span class="font-weight-bold text-dark text-muted" >{{$total2}}</span>
                                                                            @else
                                                                                <span class="font-weight-bold text-danger" >{{$total2}}</span>
                                                                            @endif
                                                                        @endIf
                                                                    </td>  
                                                            @endIf
                                                        @endforeach  
                                                        <td class="align-middle"> 
                                                            @if($contModulos>0)
                                                                @php
                                                                    $PromMod=$PromedioTotal/$contModulos; 
                                                                    $totalPromedio=bcdiv($PromMod, '1', 0);
                                                                    $mayor=$PromMod-$totalPromedio;
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $PromMod=$PromedioTotal/1; 
                                                                    $totalPromedio=bcdiv($PromMod, '1', 0);
                                                                    $mayor=$PromMod-$totalPromedio;
                                                                @endphp
                                                            @endif
                                                            @if($mayor>=0.5)
                                                                @php
                                                                    $totalPromedio=$totalPromedio+1;
                                                                @endphp
                                                            @endif
                                                            @if($totalPromedio>=16)
                                                                <span class="font-weight-bold">{{$totalPromedio}}</span>
                                                            @else
                                                                <span class="font-weight-bold text-danger">{{$totalPromedio}}</span>
                                                            @endif
                                                        </td>
                                                        <td class="align-middle"></td> 
                                                       
                                                    </tr>
                                                    @php
                                                        $estudianteId=$estudiante->id_est;
                                                    @endphp
                                                @endIf
                                            @endforeach   
                                        </tbody>
                                </table>
                @endIf
                @php
                    $CursoLic=$estudianteCur->id_curlic;    
                    $contModulos=0;
                @endphp  
            @endforeach      
        </div> 