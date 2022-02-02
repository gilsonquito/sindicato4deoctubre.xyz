
       
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
                           <div class="titulo2"><strong>Licencia:</strong> <spam class="normal"> Tipo {{$dato->nombre_tlic}} Jornada-{{$dato->jornada}} Modalidad-{{$dato->modalidad}}</spam></div>
                           <div class="titulo2"><strong>Paralelo:</strong> <spam class="normal"> {{$dato->nombre_paralelo}}</spam></div>
                            <div class="titulo2"><strong>Período Académico:</strong> <spam class="normal">{{$dato->fechaini}} - {{$dato->fechafin}}</spam></div>  
                            <table id="" class="table table-bordered table-responsive-lg w-100">
                                <thead>
                                    <tr>
                                            <th class="px-2 text-center">
                                                Nº
                                            </th>
                                            <th class="px-2 text-center">
                                                Estudiante
                                            </th>
                                            @php
                                                $modulosId="";
                                            @endphp
                                            @foreach ($modulos as $modulo)
                                                @if(($dato->id_curlic==$modulo->id_curlic)&&($modulo->id_mod!=$modulosId))
                                                    <th class="px-2 text-center">{{$modulo->nombre_mod}}</th>
                                                @endif
                                                @php
                                                    $modulosId=$modulo->id_mod;
                                                @endphp
                                            @endforeach
                                    </tr>
                                </thead>
                                <tbody class="text-center"> 
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
                                                    <td class="nombres">{{$i}}</td>
                                                    <td class="nombres">{{$estudiante->apellido_est}} {{$estudiante->name_est}}</td>
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
                                                                                    <td>{{$porcentaje}} %</td>
                                                                            @else
                                                                                    <td class="text-danger">{{$porcentaje}} %</td>
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
                            <br>
                @endforeach    
           </div>
        </div> 