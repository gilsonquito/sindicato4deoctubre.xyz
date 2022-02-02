<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
               @foreach ($datos as $dato)
                            <table>
                                <tr>
                                    <td  colspan="14" valign="center" align="center"><strong>ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES 4 DE OCTUBRE</strong></td>
                                    <img src="image/logoempresa_exel.png"/>
                                </tr>
                                <tr>
                                    <td  colspan="15" align="center"><strong>REPORTE DE ASISTENCIAS</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="15" >Licencia: Tipo {{$dato->nombre_tlic}} Jornada-{{$dato->jornada}} Modalidad-{{$dato->modalidad}}</td>
                                </tr>
                                <tr>
                                    <td colspan="15" >Paralelo: {{$dato->nombre_paralelo}}</td>
                                </tr>
                                <tr>
                                    <td  colspan="15" >Período Académico: {{$dato->fechaini}} - {{$dato->fechafin}}</td>  
                                </tr>
                            </table>
                            <table>
                                <thead>
                                    <tr>
                                            <td valign="center" align="center" style="width:4px;background-color:#D1E5FE;">
                                                Nº
                                            </td>
                                            <td style="width: 35px;" valign="center" align="center">
                                                <strong>Estudiante</strong>
                                            </td>
                                            @php
                                                $modulosId="";
                                            @endphp
                                            @foreach ($modulos as $modulo)
                                                @if(($dato->id_curlic==$modulo->id_curlic)&&($modulo->id_mod!=$modulosId))
                                                    <td valign="center" align="center" style="width:14px;"><h5 valign="center" align="center"><strong>{{$modulo->nombre_mod}}<h5></strong></td>
                                                @endif
                                                @php
                                                    $modulosId=$modulo->id_mod;
                                                @endphp
                                            @endforeach 
                                    </tr>
                                </thead>
                                <tbody > 
                                    @php
                                        $idEstudiante="";
                                        $i=0;
                                    @endphp
                                    @foreach ($estudaintesOrders as $estudiante)
                                            @if(($idEstudiante!=$estudiante->id_est)&&($dato->id_curlic==$estudiante->id_curlic))
                                                @php
                                                    $i=$i+1;
                                                @endphp  
                                                <tr>
                                                    <td valign="center" align="center">{{$i}}</td>
                                                    <td valign="center" align="center">{{$estudiante->apellido_est}} {{$estudiante->name_est}}</td>
                                                    @php
                                                        $modulosId="";
                                                    @endphp
                                                    @foreach ($modulos as $modulo)
                                                        @if(($dato->id_curlic==$modulo->id_curlic)&&($modulo->id_mod!=$modulosId))
                                                            @php
                                                                $cont=0;
                                                                $contunico=1;
                                                                $contPresentes=0;
                                                            @endphp
                                                                            @foreach ($estudaintesOrders as $est)
                                                                                @if(($estudiante->id_est==$est->id_est)&&($modulo->id_mod==$est->id_mod)&&($modulo->id_curlic==$est->id_curlic)&&($modulo->id_mod==$est->id_mod))
                                                                                        @if($est->estado_asistencia=="PRESENTE")   
                                                                                            @php
                                                                                                $contPresentes=$contPresentes+1;
                                                                                            @endphp
                                                                                        @else
                                                                                            
                                                                                        @endif
                                                                                        
                                                                                        @php
                                                                                            $cont=$cont+1;
                                                                                         @endphp
                                                                                @endif    
                                                                            @endforeach
                                                                            @php
                                                                                $contunico=$contunico+1;
                                                                                $contPresentes=($contPresentes*100)/$cont;
                                                                                $porcentaje=bcdiv($contPresentes, '1', 2);
                                                                            @endphp
                                                                            @if($porcentaje>=95)
                                                                                    <td valign="center" align="center">{{$porcentaje}} %</td>
                                                                            @else
                                                                                    <td valign="center" align="center" style="color:#FF0000">{{$porcentaje}} %</td>
                                                                            @endif
                                                                    @php
                                                                        $contPresentes=0; 
                                                                    @endphp
                                                        @endif
                                                        @php
                                                            $modulosId=$modulo->id_mod;
                                                        @endphp
                                                    @endforeach
                                                </tr>
                                                
                                            @endif
                                            @php
                                                $idEstudiante=$estudiante->id_est;
                                                $contPresentes=0;
                                            @endphp
                                    @endforeach
                                </tbody>  
                            </table>
                @endforeach    
</html>