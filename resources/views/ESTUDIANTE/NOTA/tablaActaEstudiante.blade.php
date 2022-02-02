<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/actaCalifcicaciones.css')}}" rel="stylesheet">
        <title>Estudiantes</title>
    </head>
    <body>
        <div id="contenidoActualizar" >
                        <form id="form_tabla">
                        <div id="" class="form-inline py-3" >   
                                <div class="col-md-10"> 
                                    <h4 class="">ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES 4 DE OCTUBRE</h4>
                                    <h4>ACTAS DE GRADO</h4>
                                </div> 
                                <div class="col-md-2 text-right">
                                    <img src="{{asset('image/logoempresa_exel.png')}}" alt="Logo del sindicato de choferes de penipe" class="img-fluid text-left" id="logo" >
                                </div> 
                        </div>
                            @php
                                $idCurso=""; 
                            @endphp 
                            @foreach ($notas as $curso)
                                    <div class="border"><h5>PARALELO {{$curso->nombre_paralelo}}</h5></div>
                                    <table id="tabla-horariodocente" class="table table-bordered table-responsive table-hover w-100">
                                            <thead class="font-weight-bold text-center text-dark" >
                                                <tr>
                                                    <td class="align-middle" rowspan="2">Apellidos y Nombres</td>
                                                    <td class="align-middle" colspan="7">Notas</td>
                                                    <td class="align-middle" rowspan="2">PROMEDIO</td>
                                                    <td class="align-middle" rowspan="2"></td>
                                                </tr>
                                                <tr>
                                                    <td >LEY Y REGLAMENTO DE TRÁNSITO</td>
                                                    <td >EDUCACIÓN VIAL</td>
                                                    <td >MECÁNICA BÁSICA</td>
                                                    <td >SUMATORIA</td>
                                                    <td >PROMEDIO GRADO TEÓRICO</td>
                                                    <td >GRADO PRÁCTICO CONDUCCIÓN</td>
                                                    <td >PROMEDIO MÓDULOS</td>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center text-dark align-middle">         
                                            @php
                                                $sumPromedioGeneral=0;
                                            @endphp  
                                                        @php
                                                            $sumatoria=0;
                                                        @endphp  
                                                        <tr>    
                                                                <td class="py-2 align-middle">{{$curso->apellido_est}} {{$curso->name_est}}</td> 
                                                            @if($curso->nota_ley_reglamento)
                                                                <td class="py-2 align-middle">{{$curso->nota_ley_reglamento}}</td>
                                                                @php
                                                                    $sumatoria=$sumatoria+$curso->nota_ley_reglamento;
                                                                @endphp 
                                                            @else
                                                                <td class="py-2 align-middle">--</td>
                                                            @endIf
                                                            @if($curso->nota_educacion_vial)
                                                                <td class="py-2 align-middle">{{$curso->nota_educacion_vial}}</td>
                                                                @php
                                                                    $sumatoria=$sumatoria+$curso->nota_educacion_vial;
                                                                @endphp
                                                            @else
                                                                <td class="py-2 align-middle">--</td>
                                                            @endIf
                                                            @if($curso->nota_mecanica_basica)
                                                                <td class="py-2 align-middle">{{$curso->nota_mecanica_basica}}</td>
                                                                @php
                                                                    $sumatoria=$sumatoria+$curso->nota_mecanica_basica;
                                                                @endphp
                                                            @else
                                                                <td class="py-2 align-middle">--</td>
                                                            @endIf
                                                            <td class="py-2 align-middle">{{$sumatoria}}</td>
                                                            <td class="py-2  align-middle">
                                                                @php
                                                                    $promTeorico=$sumatoria/3;
                                                                    $promTeoricoTotal=bcdiv($promTeorico, '1', 0);
                                                                @endphp
                                                                @if(($promTeorico-$promTeoricoTotal)>=0.5)
                                                                    @php
                                                                        $promTeoricoTotal=$promTeoricoTotal+1;
                                                                    @endphp
                                                                @endif
                                                                @php
                                                                    $sumPromedioGeneral=$sumPromedioGeneral+$promTeoricoTotal;
                                                                @endphp
                                                                {{$promTeoricoTotal}}
                                                            </td>
                                                            @if($curso->nota_grado_practico)
                                                                <td class="py-2 align-middle">{{$curso->nota_grado_practico}}</td>
                                                                @php
                                                                    $sumPromedioGeneral=$sumPromedioGeneral+$curso->nota_grado_practico
                                                                @endphp
                                                            @else
                                                                <td class="py-2 align-middle">--</td>
                                                            @endIf
                                                            <td class="py-2 align-middle">
                                                                @php
                                                                    $contModulos=0;
                                                                @endphp    
                                                                                                    @php
                                                                                                        $modulos="";   
                                                                                                    @endphp
                                                                                                            @foreach ($estudiantesNotas as $estudianteMod)
                                                                                                                @if(($curso->id_curlic==$estudianteMod->id_curlic)&&($estudianteMod->id_mod!=$modulos))
                                                                                                                    @php
                                                                                                                        $contModulos= $contModulos+1;
                                                                                                                    @endphp
                                                                                                                @endif
                                                                                                                @php
                                                                                                                    $modulos=$estudianteMod->id_mod;    
                                                                                                                @endphp
                                                                                                            @endforeach  
                                                                                                    @php
                                                                                                        $contFilas=0;
                                                                                                    @endphp         
                                                                                                            @php
                                                                                                                $PromedioTotal=0;
                                                                                                            @endphp  
                                                                                                                @foreach ($estudiantesNotas as $estudianteNota)
                                                                                                                    @if($estudianteNota->id_est==$curso->id_est)
                                                                                                                        @php
                                                                                                                            $sum=0;
                                                                                                                            $sum2=0;
                                                                                                                        @endphp  
                                                                                                                            @if($estudianteNota->nota_trabajo_equipo)
                                                                                                                            @else
                                                                                                                            @endIf
                                                                                                                            @if($estudianteNota->nota_estudio_caso)
                                                                                                                            @else
                                                                                                                            @endIf
                                                                                                                            @if($estudianteNota->nota_prueba_practica)
                                                                                                                            @else
                                                                                                                            @endIf
                                                                                                                            @if($estudianteNota->nota_prueba_teorica)
                                                                                                                            @else
                                                                                                                            @endIf
                                                                                                                                @php
                                                                                                                                    $sum2=($estudianteNota->nota_trabajo_equipo+$estudianteNota->nota_estudio_caso+$estudianteNota->nota_prueba_practica+$estudianteNota->nota_prueba_teorica)/4;
                                                                                                                                    $total1=bcdiv($sum2, '1', 2);
                                                                                                                                @endphp
                                                                                                                            @if(($estudianteNota->nota_suspenso))
                                                                                                                            @else
                                                                                                                            @endIf
                                                                                                                                @if(($estudianteNota->nota_suspenso==null))
                                                                                                                                    @php
                                                                                                                                    $sum=($estudianteNota->nota_trabajo_equipo+$estudianteNota->nota_estudio_caso+$estudianteNota->nota_prueba_practica+$estudianteNota->nota_prueba_teorica)/4;
                                                                                                                                    $total2=bcdiv($sum, '1', 2);
                                                                                                                                    $PromedioTotal=$PromedioTotal+$total2;
                                                                                                                                    @endphp
                                                                                                                                    @if($total2>=16)
                                                                                                                                    @else
                                                                                                                                    @endif
                                                                                                                                @else
                                                                                                                                    @php
                                                                                                                                        $sum=((($estudianteNota->nota_trabajo_equipo+$estudianteNota->nota_estudio_caso+$estudianteNota->nota_prueba_practica+$estudianteNota->nota_prueba_teorica)/4)+($estudianteNota->nota_suspenso))/(2);
                                                                                                                                        $total2=bcdiv($sum, '1', 2);
                                                                                                                                        $PromedioTotal=$PromedioTotal+$total2;
                                                                                                                                    @endphp
                                                                                                                                    @if($total2>=16)
                                                                                                                                    @else
                                                                                                                                    @endif
                                                                                                                                @endIf
                                                                                                                    @endIf
                                                                                                                @endforeach  
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
                                                                                                                    @php
                                                                                                                        $sumPromedioGeneral=$sumPromedioGeneral+$totalPromedio;
                                                                                                                    @endphp
                                                                                                                    @if($totalPromedio>=16)
                                                                                                                        <span class="">{{$totalPromedio}}</span>
                                                                                                                    @else
                                                                                                                        <span class=" text-danger">{{$totalPromedio}}</span>
                                                                                                                    @endif
                                                                        @php
                                                                            $contModulos=0;
                                                                        @endphp  
                                                            </td>
                                                            <td class="py-2 align-middle font-weight-bold">
                                                                @php
                                                                    $promF1=$sumPromedioGeneral/3; 
                                                                    $totalPromedioF=bcdiv($promF1, '1', 0);
                                                                    $mayorF=$promF1-$totalPromedioF;
                                                                @endphp
                                                                @if($mayorF>=0.5)
                                                                    @php
                                                                        $totalPromedioF=$totalPromedioF+1;
                                                                    @endphp
                                                                @endif
                                                                <span>{{$totalPromedioF}}</span>
                                                            </td>  
                                                            <td class="py-2 align-middle">
                                                                @if($totalPromedioF>=16)
                                                                    <span class="text-light bg-success p-2">APROBADO</span>
                                                                @else
                                                                    <span class="text-light bg-danger p-2">REPROBADO</span>
                                                                @endif
                                                            </td>  
                                                        </tr>
                                                        @php
                                                            $sumPromedioGeneral=0;
                                                        @endphp
                                            </tbody>
                                    </table>
                                    <br>
                                @php
                                    $idCurso=$curso->id_curlic; 
                                @endphp 
                            @endforeach 
                        </form>      
        </div> 
        <body>
</html>