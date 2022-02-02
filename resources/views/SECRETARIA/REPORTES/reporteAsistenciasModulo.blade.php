
        @php
            $CursoLic="";   
            $contModulos=0;
        @endphp  
        <div id="contenidoActualizar" class="p-4 border border-dark" >
            <div class="w-100" id="" >
                       <div class="row align-self-center">
                            <div class="col-md-10 align-self-center">
                               <h4>ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES 4 DE OCTUBRE</h4>
                           </div>
                           <div class="col-md-2 align-self-center text-right ">
                                <img src="{{asset('image/logoempresa_exel.png')}}" alt="Logo del sindicato de choferes de penipe" class="img-fluid " id="logo" >
                           </div>
                           <div class="col-md-10 align-self-center">
                                <h5 class="text-center justify-content-center" href="#">REPORTE DE ASISTENCIAS</h5>
                           </div>
                           <div class="col-md-2 align-self-center text-right ">
                           </div>
                       </div>
           </div>
           <div id="seccionDatosInformativos" class="text-left" >      
               @foreach ($datos as $dato)
                           <div class="titulo2"><strong>Licencia:</strong> <spam class="normal"> Tipo {{$dato->nombre_tlic}} Paralelo {{$dato->nombre_paralelo}} Jornada-{{$dato->jornada}} Modalidad- {{$dato->modalidad}}</spam></div>
                           <div class="titulo2"><strong>Módulo:</strong> <spam class="normal">{{$dato->nombre_mod}} </spam></div>
                           @foreach ($periodos as $periodo)
                            <div class="titulo2"><strong>Período Académico:</strong> <spam class="normal">{{$periodo->fechaini}} - {{$periodo->fechafin}}</spam></div>
                           @endforeach
                           <div class="titulo2"><strong>DOCENTE:</strong> <spam class="normal">{{$dato->instruccion_doc}} {{$dato->apellido_doc}} {{$dato->name}}</spam></div>   
                           <div class="titulo2"><strong>CI: </strong><spam class="normal">{{$dato->cedula_doc}}</spam></div>    
               @endforeach    
           </div>
           <div class=" p-3">
                <table id="" class="table-bordered w-100">
                        <thead>
                            <tr>
                                    <th class="">
                                        Nº
                                    </th>
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
                                $i=0;
                            @endphp
                            @foreach ($estudiantes as $estudiante)
                                
                                    @if($idEstudiante!==$estudiante->id_est) 
                                        @php
                                            $i=$i+1;
                                        @endphp  
                                        <tr>
                                            <td class="nombres">{{$i}}</td>
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
                                            @if($porcentaje>=95)
                                                    <td>{{$porcentaje}} % </td>
                                                @else
                                                    <td class="text-danger">{{$porcentaje}} % </td>
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
            </div>
        </div> 