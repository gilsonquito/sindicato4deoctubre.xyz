<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
                            @php
                                $idCurso=""; 
                            @endphp 
                            @foreach ($cursosLista as $curso)
                                @if($curso->id_curlic!=$idCurso)
                                    <table>
                                        <tr>
                                            <td  colspan="10" valign="center" align="center"><strong>ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES 4 DE OCTUBRE</strong></td>
                                            <img src="image/logoempresa_exel.png"/>
                                        </tr>
                                        <tr>
                                            <td  colspan="11" align="center"><strong>GRADO PRÁCTICO Y TEÓRICO-LICENCIA TIPO "{{$curso->nombre_tipolicencia}}" PERÍODO ACADÉMICO {{$curso->fechaini}} AL {{$curso->fechafin}} </strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="11"  align="center"><strong>Paralelo: {{$curso->nombre_paralelo}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="11"  align="center"><strong>Jornada: {{$curso->jornada}} - Modalidad: {{$curso->modalidad}}</strong></td>
                                        </tr>
                                    </table>
                                    <table>
                                            <thead >
                                                <tr>
                                                    <td style="width:4px;" valign="center" align="center"><strong><h5>Nº</h5></strong></td>
                                                    <td style="width: 40px;" valign="center" align="center"><strong><h5>Apellidos Y Nombres</h5></strong></td>
                                                    <td style="width: 15px;" valign="center" align="center"><strong><h5>LEY Y REGLAMENTO DE TRÁNSITO</h5></strong></td>
                                                    <td style="width: 12px;" valign="center" align="center"><strong><h5>EDUCACIÓN VIAL</h5></strong></td>
                                                    <td style="width: 12px;" valign="center" align="center"><strong><h5>MECÁNICA BÁSICA</h5></strong></td>
                                                    <td style="width: 12px;" valign="center" align="center"><strong><h5>SUMATORIA</h5></strong></td>
                                                    <td style="width: 16px;" valign="center" align="center"><strong><h5>PROMEDIO GRADO TEÓRICO</h5></strong></td>
                                                    <td style="width: 14px;" valign="center" align="center"><strong><h5>GRADO PRÁCTICO CONDUCCIÓN</h5></strong></td>
                                                    <td style="width: 11px;" valign="center" align="center"><strong><h5>PROMEDIO MÓDULOS</h5></strong></td>
                                                    <td style="width: 12px;"valign="center" align="center"><strong><h5>PROMEDIO</h5></strong></td>
                                                    <td valign="center" align="center"></td>
                                                </tr>
                                            </thead>
                                            <tbody>         
                                            @php
                                                $i=1; 
                                                $sumPromedioGeneral=0;
                                            @endphp  
                                                @foreach ($estudiantes as $estudiante)
                                                    @if($estudiante->id_curlic==$curso->id_curlic)
                                                        @php
                                                            $sumatoria=0;
                                                        @endphp  
                                                        <tr>    
                                                        @if($i==1)
                                                            @endIf
                                                                <td  valign="center" align="center" >{{$i}}</td>
                                                                <td  valign="center" align="center">{{$estudiante->apellido_est}} {{$estudiante->name_est}}</td>
                                                               
                                                            @if($estudiante->nota_ley_reglamento)
                                                                <td  valign="center" align="center">{{$estudiante->nota_ley_reglamento}}</td>
                                                                @php
                                                                    $sumatoria=$sumatoria+$estudiante->nota_ley_reglamento;
                                                                @endphp 
                                                            @else
                                                                <td  valign="center" align="center">--</td>
                                                            @endIf
                                                            @if($estudiante->nota_educacion_vial)
                                                                <td  valign="center" align="center">{{$estudiante->nota_educacion_vial}}</td>
                                                                @php
                                                                    $sumatoria=$sumatoria+$estudiante->nota_educacion_vial;
                                                                @endphp
                                                            @else
                                                                <td  valign="center" align="center" >--</td>
                                                            @endIf
                                                            @if($estudiante->nota_mecanica_basica)
                                                                <td  valign="center" align="center">{{$estudiante->nota_mecanica_basica}}</td>
                                                                @php
                                                                    $sumatoria=$sumatoria+$estudiante->nota_mecanica_basica;
                                                                @endphp
                                                            @else
                                                                <td  valign="center" align="center">--</td>
                                                            @endIf
                                                            <td  valign="center" align="center">{{$sumatoria}}</td>
                                                            <td  valign="center" align="center">
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
                                                            @if($estudiante->nota_grado_practico)
                                                                <td  valign="center" align="center">{{$estudiante->nota_grado_practico}}</td>
                                                                @php
                                                                    $sumPromedioGeneral=$sumPromedioGeneral+$estudiante->nota_grado_practico
                                                                @endphp
                                                            @else
                                                                <td  valign="center" align="center">--</td>
                                                            @endIf
                                                            <td  valign="center" align="center">
                                                                @php
                                                                    $contModulos=0;
                                                                @endphp    
                                                                                                    @php
                                                                                                        $modulos="";   
                                                                                                    @endphp
                                                                                                            @foreach ($estudiantesNotas as $estudianteMod)
                                                                                                                @if(($estudiante->id_curlic==$estudianteMod->id_curlic)&&($estudianteMod->id_mod!=$modulos))
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
                                                                                                                    @if($estudianteNota->id_est==$estudiante->id_est)
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
                                                            <td  valign="center" align="center">
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
                                                            @if($totalPromedioF>=16)
                                                                <td  valign="center" align="center" style="background-color:#92D050;"><span >APROBADO</span> </td>  
                                                            @else
                                                                <td  valign="center" align="center" style="background-color:#FFC7CE;"><span >REPROBADO</span> </td>  
                                                            @endif                  
                                                        </tr>
                                                        @php
                                                            $i=$i+1;
                                                            $sumPromedioGeneral=0;
                                                        @endphp
                                                    @endIf
                                                @endforeach   
                                            </tbody>
                                    </table>
                                    <br>
                                @endif
                                @php
                                    $idCurso=$curso->id_curlic; 
                                @endphp 
                            @endforeach 

</html>