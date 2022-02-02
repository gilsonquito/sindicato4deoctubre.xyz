<head>
        <title>DetalleAvance</title>
        <link href="{{asset('css/detalleAvance.css')}}" rel="stylesheet">
    </head>
    <body>
        <div id="detalleAvanceAcademico" > 
                @if($no=="noexiste")
                    <form id="ingreso_DetalleAvance">
                        @csrf   
                            <div class="row  justify-content-center p-2">
                                <div class="col-md-12 px-2  justify-content-center text-left">
                                    <label for="" class="form-label ml-2 font-weight-bold text-secondary">Metodología Utilizada:</label>
                                    <textarea id="txtMetodologiaAvance" name="txtMetodologiaAvance" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="700" required></textarea>    
                                </div>
                                <div class="col-md-12 p-2 px-3">
                                    <button class="btn btn-outline-success" onclick="agregarMetodosAvance()" title="Ocultar Detalle avance academico"><i  class="fa fa-check-square mr-2" aria-hidden="true"></i>Métodos</button>
                                </div>
                                <div class="container-fluid" id="seccionMetodosAvance">
                                   
                                </div>
                            </div>
                            <div class="row  justify-content-center p-2">
                                <div class="col-md-12 px-2  justify-content-center text-left">
                                    <label for="" class="form-label ml-2 font-weight-bold text-secondary">Recursos Didácticos:</label>
                                    <textarea id="txtRecursosAvance" name="txtRecursosAvance" class="form-control" aria-label="With textarea"  tabindex="2" maxlength="700" required></textarea>    
                                </div>
                                <div class="col-md-12 p-2 px-3">
                                    <button class="btn btn-outline-success" onclick="agregarRecurosAvance()" title="Ocultar Detalle avance academico"><i  class="fa fa-check-square mr-2" aria-hidden="true"></i>Recursos</button>
                                </div>
                                <div class="container-fluid" id="seccionRecursosAvance">
                                   
                                </div>
                            </div>
                            <div class="row  justify-content-center p-2">
                                <div class="col-md-12 px-2  justify-content-center text-left">
                                    <label for="" class="form-label ml-2 font-weight-bold text-secondary">Actividades de Evaluación:</label>
                                    <textarea id="txtActividadesAvance" name="txtActividadesAvance" class="form-control" aria-label="With textarea"  tabindex="3" maxlength="700" required></textarea>    
                                </div>
                            </div>
                            <div class="row  justify-content-center p-2">
                                <div class="col-md-12 px-2  justify-content-center text-left">
                                    <label for="" class="form-label ml-2 font-weight-bold text-secondary">Evidencias:</label>
                                    <textarea id="txtEvidenciaAvance" name="txtEvidenciaAvance" class="form-control" aria-label="With textarea"  tabindex="4" maxlength="700" required></textarea>    
                                </div>
                            </div>
                            <div class="row  justify-content-center p-2">
                                <div class="col-md-12 px-2  justify-content-center text-left">
                                    <label for="" class="form-label ml-2 font-weight-bold text-secondary">Motivo inasistencia:</label>
                                        <select class="form-control" id="selInasistencia" name="selInasistencia" tabindex="5" title="seleccionar motivo inasistencia" required>
                                            <option value="Ninguna">Ninguna</option>
                                            <option value="Feriado">Feriado</option>
                                            <option value="Actividades Extracurriculares">Actividades Extracurriculares</option>
                                            <option value="Reuniones de Trabajo">Reuniones de Trabajo</option>
                                        </select>    
                                </div>
                            </div>
                            <div class="row  justify-content-center p-2">
                                <div class="col-md-12 px-2  justify-content-center text-left">
                                    <label for="" class="form-label ml-2 font-weight-bold text-secondary">Observación:</label>
                                    <textarea id="txtObservacionAvance" name="txtObservacionAvance" class="form-control" aria-label="With textarea"  tabindex="6" maxlength="700"></textarea>    
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-success "><i class="fa fa-plus mr-2" aria-hidden="true"></i>Guardar Avance Académico</button>
                    </form>
                @else     
                        @foreach ($detallesAvances as $detalleAvance)
                        <form id="editar_DetalleAvance">
                            @csrf   
                                <input type="hidden" id="txtId_detalle_avance" name="txtId_detalle_avance" value="{{$detalleAvance->id_detalle_avance}}">
                                <div class="row  justify-content-center p-2">
                                    <div class="col-md-12 px-2  justify-content-center text-left">
                                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Metodología Utilizada:</label>
                                        <textarea id="txtMetodologiaAvance" name="txtMetodologiaAvance" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="700" required>{{$detalleAvance->metodologias_avance}}</textarea>    
                                    </div>
                                    <div class="col-md-12 p-2 px-3">
                                        <a class="btn btn-outline-success" onclick="agregarMetodosAvance()" title="agregar avance academico"><i  class="fa fa-check-square mr-2" ></i>Métodos</a>
                                    </div>
                                    <div class="container-fluid" id="seccionMetodosAvance">
                                    
                                    </div>
                                </div>
                                <div class="row  justify-content-center p-2">
                                    <div class="col-md-12 px-2  justify-content-center text-left">
                                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Recursos Didácticos:</label>
                                        <textarea id="txtRecursosAvance" name="txtRecursosAvance" class="form-control" aria-label="With textarea"  tabindex="2" maxlength="700" required>{{$detalleAvance->recursos_avance}}</textarea>    
                                    </div>
                                    <div class="col-md-12 p-2 px-3">
                                        <a class="btn btn-outline-success" onclick="agregarRecurosAvance()" title="agregar recursos avance academico"><i  class="fa fa-check-square mr-2" ></i>Recursos</a>
                                    </div>
                                    <div class="container-fluid" id="seccionRecursosAvance">
                                    
                                    </div>
                                </div>
                                <div class="row  justify-content-center p-2">
                                    <div class="col-md-12 px-2  justify-content-center text-left">
                                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Actividades de Evaluación:</label>
                                        <textarea id="txtActividadesAvance" name="txtActividadesAvance" class="form-control" aria-label="With textarea"  tabindex="3" maxlength="700" required>{{$detalleAvance->actividades_avance}}</textarea>    
                                    </div>
                                </div>
                                <div class="row  justify-content-center p-2">
                                    <div class="col-md-12 px-2  justify-content-center text-left">
                                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Evidencias:</label>
                                        <textarea id="txtEvidenciaAvance" name="txtEvidenciaAvance" class="form-control" aria-label="With textarea"  tabindex="4" maxlength="700" required>{{$detalleAvance->evidencias_avance}}</textarea>    
                                    </div>
                                </div>
                                <div class="row  justify-content-center p-2">
                                    <div class="col-md-12 px-2  justify-content-center text-left">
                                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Motivo inasistencia:</label>
                                            <select class="form-control" id="selInasistencia" name="selInasistencia" tabindex="5" title="seleccionar motivo inasistencia" required>
                                                @if($detalleAvance->motivo_inasistencia_avance=="Ninguna")
                                                    <option selected value="Ninguna">Ninguna</option>
                                                    <option value="Feriado">Feriado</option>
                                                    <option value="Actividades Extracurriculares">Actividades Extracurriculares</option>
                                                    <option value="Reuniones de Trabajo">Reuniones de Trabajo</option>
                                                @endif
                                                @if($detalleAvance->motivo_inasistencia_avance=="Feriado")
                                                    <option  value="Ninguna">Ninguna</option>
                                                    <option selected value="Feriado">Feriado</option>
                                                    <option value="Actividades Extracurriculares">Actividades Extracurriculares</option>
                                                    <option value="Reuniones de Trabajo">Reuniones de Trabajo</option>
                                                @endif
                                                @if($detalleAvance->motivo_inasistencia_avance=="Actividades Extracurriculares")
                                                    <option  value="Ninguna">Ninguna</option>
                                                    <option  value="Feriado">Feriado</option>
                                                    <option selected value="Actividades Extracurriculares">Actividades Extracurriculares</option>
                                                    <option value="Reuniones de Trabajo">Reuniones de Trabajo</option>
                                                @endif
                                                @if($detalleAvance->motivo_inasistencia_avance=="Reuniones de Trabajo")
                                                    <option  value="Ninguna">Ninguna</option>
                                                    <option  value="Feriado">Feriado</option>
                                                    <option  value="Actividades Extracurriculares">Actividades Extracurriculares</option>
                                                    <option selected value="Reuniones de Trabajo">Reuniones de Trabajo</option>
                                                @endif
                                            </select>    
                                    </div>
                                </div>
                                <div class="row  justify-content-center p-2">
                                    <div class="col-md-12 px-2  justify-content-center text-left">
                                        <label for="" class="form-label ml-2 font-weight-bold text-secondary">Observación:</label>
                                        <textarea id="txtObservacionAvance" name="txtObservacionAvance" class="form-control" aria-label="With textarea"  tabindex="6" maxlength="700">{{$detalleAvance->observacion_avance}}</textarea>    
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-success "><i class="fa fa-plus mr-2" aria-hidden="true"></i>Guardar Avance Académico</button>
                        </form>  
                        @endforeach   
                @endIf
            @foreach ($avanceAcademico as $avance)
                    <input type="hidden" id="txtIdAvanceD" name="txtIdAvanceD" value="{{$avance->id_avance}}">
            @endforeach                                
        </div>
        <script> //ingresar un nuevo detalle_avance
            $('#ingreso_DetalleAvance').submit(function(e){ 
                e.preventDefault();
                var metodologias_avance=$('#txtMetodologiaAvance').val();
                var recursos_avance=$('#txtRecursosAvance').val();
                var actividades_avance=$('#txtActividadesAvance').val();
                var evidencias_avance=$('#txtEvidenciaAvance').val();
                var motivo_inasistencia_avance=$('#selInasistencia').val();
                var observacion_avance=$('#txtObservacionAvance').val();
                var id_avance=$('#txtIdAvanceD').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                                url:"{{route('detalleAvance.ingresar')}}",
                                type:"POST",
                                async: true,
                                data:{
                                    metodologias_avance:metodologias_avance,
                                    recursos_avance:recursos_avance,
                                    actividades_avance:actividades_avance,
                                    evidencias_avance:evidencias_avance,
                                    motivo_inasistencia_avance:motivo_inasistencia_avance,
                                    observacion_avance:observacion_avance,
                                    id_avance:id_avance,
                                    _token:_token
                                },
                                success:function(response)
                                {   
                                    if(response)
                                    {
                                        toastr.success('El ingreso del avance acadeémico fue exitoso','¡EXITOSO!',{timeOut:3000});
                                        $.ajax({
                                                url:'/avancesacademico/generarAvance',
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#contenido').empty().append($(data));
                                                    }
                                                    );
                                                }
                                        });
                                    }
                                },
                                error : function(response){
                                    toastr.error('No se realizo el registro','Error',{timeOut:2000});
                                }
                            });
            })
        </script> 
        <!--//actualizar datos-->
        <script> //
            $('#editar_DetalleAvance').submit(function(e){ 
                e.preventDefault();
                
                var id_detalle_avance=$('#txtId_detalle_avance').val();
                var metodologias_avance=$('#txtMetodologiaAvance').val();
                var recursos_avance=$('#txtRecursosAvance').val();
                var actividades_avance=$('#txtActividadesAvance').val();
                var evidencias_avance=$('#txtEvidenciaAvance').val();
                var motivo_inasistencia_avance=$('#selInasistencia').val();
                var observacion_avance=$('#txtObservacionAvance').val();
                var id_avance=$('#txtIdAvanceD').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                                url:"{{route('detalleAvance.ingresar')}}",
                                type:"POST",
                                async: true,
                                data:{
                                    id_detalle_avance:id_detalle_avance,
                                    metodologias_avance:metodologias_avance,
                                    recursos_avance:recursos_avance,
                                    actividades_avance:actividades_avance,
                                    evidencias_avance:evidencias_avance,
                                    motivo_inasistencia_avance:motivo_inasistencia_avance,
                                    observacion_avance:observacion_avance,
                                    id_avance:id_avance,
                                    _token:_token
                                },
                                success:function(response)
                                {   
                                    if(response)
                                    {
                                        
                                        toastr.success('La actualizacion se realizó correctamente','¡EXITOSO!',{timeOut:2000});
                                    }
                                },
                                error : function(response){
                                    toastr.error('No se realizo la actualización','Error',{timeOut:2000});
                                }
                            });
            })
        </script> 
               <script>
                    function agregarMetodosAvance() {
                        var idAvanceM=$('#txtIdAvanceD').val();
                        $.ajax({
                            url:'/avanceAcademico/visualizarMetodos/'+idAvanceM,
                                success : function(data){
                                    setTimeout(function(){
                                        $('#seccionMetodosAvance').empty().append($(data));
                                    }
                                    );
                            }
                        });
                    }   
                    function agregarRecurosAvance() {
                        var idAvanceR=$('#txtIdAvanceD').val();
                        $.ajax({
                            url:'/avanceAcademico/visualizarRecursos/'+idAvanceR,
                                success : function(data){
                                    setTimeout(function(){
                                        $('#seccionRecursosAvance').empty().append($(data));
                                    }
                                    );
                            }
                        });
                    }   
            </script>
        <body>