<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        @php
            $CursoLic="";   
            $contModulos=0;
        @endphp  
        <table> 
            <tr> 
                <th colspan="8" valign="center" align="center">
                   <h1><strong>ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES 4 DE OCTUBRE</strong></h1>
                </th>
                <img src="image/logoempresa_exel.png"/>
            </tr>
            <tr> 
                <td colspan="8" valign="center" align="center"><strong>REPORTE DE ASISTENCIAS</strong></td>           
            </tr>
               @foreach ($datos as $dato)
                            <tr>
                                <td colspan="9">Licencia: Tipo {{$dato->nombre_tlic}} Paralelo {{$dato->nombre_paralelo}} Jornada-{{$dato->jornada}} Modalidad-{{$dato->modalidad}}</td>
                            </tr>   
                            <tr>
                                <td colspan="9">Módulo: {{$dato->nombre_mod}}</td>
                            </tr>
                            <tr>
                                @foreach ($periodos as $periodo)
                                    <td colspan="9">Período Académico: {{$periodo->fechaini}} - {{$periodo->fechafin}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="9">DOCENTE: {{$dato->instruccion_doc}} {{$dato->apellido_doc}} {{$dato->name}}</td>   
                            </tr>
                            <tr>
                                <td colspan="9">CI: {{$dato->cedula_doc}}</td>    
                            </tr>
                           
               @endforeach    
        </table> 
        <table >
            <thead>
                <tr>
                    <th class="" align="center"><strong>Nº</strong></th>
                    <th class="" colspan="4"><strong>Estudiante</strong></th>
                    <th class="" align="center" colspan="4"><strong>% Porcentaje de Asistencia</strong></th>
                </tr>
            </thead>
            <tbody class=""> 
                @php
                    $idEstudiante="";
                    $cont=0;
                    $contunico=1;
                    $contPresentes=0;
                    $i=0;
                @endphp
                @foreach ($estudiantes as $estudiante) 
                        @if($idEstudiante!==$estudiante->id_est) 
                            @php
                               $i=$i+1;
                            @endphp
                            <tr>
                                <td class="" align="center">{{$i}}</td>
                                <td class="" colspan="4">{{$estudiante->apellido_est}} {{$estudiante->name_est}}</td>      
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
                                @if($porcentaje>=95)
                                        <td colspan="4" align="center">{{$porcentaje}} % </td>
                                    @else
                                        <td colspan="4" align="center" style="color:#FF0000">{{$porcentaje}} % </td>
                                    @endif
                            </tr>     
                        @endif
                        @php
                            $idEstudiante=$estudiante->id_est;
                            $contPresentes=0;
                        @endphp          
                @endforeach  
            </tbody>    
        </table>
</html>