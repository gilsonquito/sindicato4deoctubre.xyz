<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        @php
            $CursoLic="";   
            $contModulos=0;
        @endphp  
        <div>
            @foreach ($estudiantes as $estudianteCur)  
               
                @if($estudianteCur->id_curlic!=$CursoLic) 
                    <table>
                        <thead>
                            <tr>
                                <td colspan="50" align="center"><strong>ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES "4 DE OCTUBRE" DEL CANTÓN PENIPE </strong></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="5" align="center"><strong>PARALELO "{{$estudianteCur->nombre_paralelo}}"</strong></td>
                                <td colspan="5" align="center"><strong>LICENCIA TIPO "{{$estudianteCur->nombre_tipolicencia}}"</strong></td>
                                <td colspan="13" align="center"><strong>PERÍODO ACADÉMICO "{{$estudianteCur->fechaini}} - {{$estudianteCur->fechafin}}"</strong></td>
                                <td colspan="7" align="center"><strong>JORNADA - {{$estudianteCur->jornada}}</strong></td>
                                <td colspan="8" align="center"><strong>MODALIDAD - {{$estudianteCur->modalidad}} </strong></td>
                            </tr>
                        </thead>
                    </table>
                                <table  >
                                        <thead  >
                                            @php
                                                $modulos="";   
                                                $contFilas=0; 
                                                $arrayColores=array(
                                                "#00B0F0",
                                                "#92D050", 
                                                "#FFFF00", 
                                                "#00FFFF", 
                                                "#D9D9D9", 
                                                "#CCECFF", 
                                                "#4BACC6", 
                                                "#00B050", 
                                                "#FFC000", 
                                                "#FF0000",
                                                "#E6B8B7", 
                                                "#92D050", 
                                                "#963634", 
                                                "#00B0F0", 
                                                "#92D050", 
                                                "#FFFF00", 
                                                "#00FFFF", 
                                                "#D9D9D9", 
                                                "#CCECFF", 
                                                "#4BACC6", 
                                                "#00B050", 
                                                "#FFC000", 
                                                "#FF0000",
                                                "#E6B8B7", 
                                                "#92D050", 
                                                "#963634",
                                                );
                                            @endphp
                                                <tr>
                                                    @php 
                                                        $contColores=0;
                                                    @endphp
                                                    @foreach ($estudiantes as $estudianteMod)
                                                        @if(($estudianteCur->id_curlic==$estudianteMod->id_curlic)&&($estudianteMod->id_mod!=$modulos))
                                                            
                                                            @if($contFilas==0)
                                                                @php  
                                                                    $contFilas=$contFilas+1;
                                                                @endphp
                                                                <td align="center" style="width: 4px; background-color:#D1E5FE;" rowspan="2"><strong>Nº</strong></td>
                                                                <td align="center" style="width: 35px; background-color:#C5D9F1;" rowspan="2"><strong>Apellidos y Nombres</strong></td>
                                                                <td align="center" style="background-color: {{$arrayColores[$contColores]}};" colspan="7"><strong>{{$estudianteMod->nombre_mod}}</strong></td>
                                                            @else  
                                                                    <td  align="center" colspan="7" style="background-color: {{$arrayColores[$contColores]}};"><strong>{{$estudianteMod->nombre_mod}}</strong></td>
                                                            @endif
                                                            @php 
                                                                $contColores=$contColores+1; 
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $modulos=$estudianteMod->id_mod;  
                                                        @endphp
                                                    @endforeach  
                                                    <td align="center" colspan="2" style="background-color: #BDBBBA;"><strong>Promedios</strong></td>
                                                </tr>
                                                <tr>
                                                    @php 
                                                        $contColores=0;
                                                        $modulos="";
                                                    @endphp
                                                    @foreach ($estudiantes as $estudianteMod)
                                                        @if(($estudianteCur->id_curlic==$estudianteMod->id_curlic)&&($estudianteMod->id_mod!=$modulos))
                                                            @php
                                                                $contModulos= $contModulos+1;
                                                            @endphp
                                                            <td align="center" style="width:4px; background-color: {{$arrayColores[$contColores]}}; "><strong>Trabajo en Equipo</strong></td>
                                                            <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}; "><strong>Estudios de Caso</strong></td>
                                                            <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}};"><strong>Prueba Práctica</strong></td>
                                                            <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}; "><strong>Prueba Teórica</strong></td>
                                                            <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}; "><strong>Promedio</strong></td>
                                                            <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}; "><strong>Suspenso</strong></td>
                                                            <td align="center"><strong>Nota Final</strong></td>
                                                            @php
                                                                    $contColores=$contColores+1;
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $modulos=$estudianteMod->id_mod;    
                                                        @endphp
                                                    @endforeach  
                                                    <td align="center" style="width:4px; background-color: #4BACC6;"><strong>Promedio Módulos</strong></td>
                                                    <td align="center" style="width:10px; background-color: #D9D9D9;"><strong>Observación</strong></td>
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
                                                        <td align="center" style="width:4px;background-color:#D1E5FE;">{{$i}}</td>
                                                        <td align="center" >{{$estudiante->apellido_est}} {{$estudiante->name_est}}</td>
                                                        @php 
                                                            $contColores=0;
                                                        @endphp
                                                        @foreach ($estudiantes as $estudianteNota)
                                                            @if($estudianteNota->id_est==$estudiante->id_est)
                                                                @php
                                                                    $sum=0;
                                                                    $sum2=0;
                                                                @endphp  
                                                                    @if($estudianteNota->nota_trabajo_equipo)
                                                                        <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}">{{$estudianteNota->nota_trabajo_equipo}}</td>
                                                                    @else
                                                                        <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}"></td>
                                                                    @endIf
                                                                    @if($estudianteNota->nota_estudio_caso)
                                                                        <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}">{{$estudianteNota->nota_estudio_caso}}</td>
                                                                    @else
                                                                        <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}"></td>
                                                                    @endIf
                                                                    @if($estudianteNota->nota_prueba_practica)
                                                                        <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}">{{$estudianteNota->nota_prueba_practica}}</td>
                                                                    @else
                                                                        <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}"></td>
                                                                    @endIf
                                                                    @if($estudianteNota->nota_prueba_teorica)
                                                                        <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}">{{$estudianteNota->nota_prueba_teorica}}</td>
                                                                    @else
                                                                        <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}"></td>
                                                                    @endIf
                                                                    <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}">
                                                                        @php
                                                                            $sum2=($estudianteNota->nota_trabajo_equipo+$estudianteNota->nota_estudio_caso+$estudianteNota->nota_prueba_practica+$estudianteNota->nota_prueba_teorica)/4;
                                                                            $total1=bcdiv($sum2, '1', 2);
                                                                        @endphp
                                                                        {{$total1}}
                                                                </td>
                                                                    @if(($estudianteNota->nota_suspenso))
                                                                        <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}">{{$estudianteNota->nota_suspenso}}</td>
                                                                    @else
                                                                        <td align="center" style="width:4px;background-color: {{$arrayColores[$contColores]}}"></td>
                                                                    @endIf
                                                                        @if(($estudianteNota->nota_suspenso==null))
                                                                            @php
                                                                            $sum=($estudianteNota->nota_trabajo_equipo+$estudianteNota->nota_estudio_caso+$estudianteNota->nota_prueba_practica+$estudianteNota->nota_prueba_teorica)/4;
                                                                            $total2=bcdiv($sum, '1', 2);
                                                                            $PromedioTotal=$PromedioTotal+$total2;
                                                                            @endphp
                                                                            @if($total2>=16)
                                                                                <td align="center" style="width:4px;"> {{$total2}} </td>
                                                                            @else
                                                                                <td align="center" style="width:4px;background-color: #FFC7CE; color:#FF0000"> {{$total2}} </td>
                                                                            @endif
                                                                        @else
                                                                            @php
                                                                                $sum=((($estudianteNota->nota_trabajo_equipo+$estudianteNota->nota_estudio_caso+$estudianteNota->nota_prueba_practica+$estudianteNota->nota_prueba_teorica)/4)+($estudianteNota->nota_suspenso))/(2);
                                                                                $total2=bcdiv($sum, '1', 2);
                                                                                $PromedioTotal=$PromedioTotal+$total2;
                                                                            @endphp
                                                                       
                                                                            @if($total2>=16)
                                                                                <td align="center" style="width:4px;"> {{$total2}} </td>
                                                                            @else
                                                                                <td align="center" style="width:4px;background-color: #FFC7CE;color:#FF0000"> {{$total2}} </td>
                                                                            @endif
                                                                        @endIf
                                                                    @php
                                                                        $contColores=$contColores+1;
                                                                    @endphp
                                                            @endIf
                                                        @endforeach  
                                                        
                                                            @if($contModulos==0)
                                                                @php
                                                                   $PromMod=$PromedioTotal/1; 
                                                                   $totalPromedio=bcdiv($PromMod, '1', 0);
                                                                   $mayor=$PromMod-$totalPromedio;
                                                                @endphp
                                                            @else
                                                                @php
                                                                   $PromMod=$PromedioTotal/$contModulos; 
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
                                                                <td align="center" style="width:4px;background-color: #4BACC6;">{{$totalPromedio}}</td>
                                                            @else
                                                                <td align="center" style="width:4px;background-color: #FFC7CE;color:#FF0000">{{$totalPromedio}}</td>
                                                            @endif
                                                        <td align="center" style="width:10px;background-color: #D9D9D9;"></td> 
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
    </html>