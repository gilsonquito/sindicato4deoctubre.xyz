<head>
        <link href="{{asset('css/tablaUnidades.css')}}" rel="stylesheet">
        <title>Unidades</title>
</head>
<body>
        <div id="contenidoUnidades" class="p-2">
                <p class="text-left font-weight-bold text-muted" href="#">Listado de Unidades</p>
                <table id="tabla-sil" class="table table-striped table-bordered table-responsive-lg w-100">
                        <thead class="font-weight-bold text-center text-secondary" >
                            <td class="col-md-1 align-middle">Acciones</td>
                            <td class="col-md-1 align-middle">Orden de unidad</td>
                            <td class="col-md-2 align-middle">Título de unidad</td>
                            <td class="col-md-1 align-middle">Horas de unidad</td>
                            <td class="col-md-4 align-middle">Criterio de evaluación</td>
                            <td class="col-md-1 align-middle">Tipo de evaluación</td>
                            <td class="col-md-2 align-middle">Tecnicas e instrumentos</td>
                            <td class="col-md-1 align-middle">Resultados de aprendizaje</td>
                        </thead>
                        <tbody class="text-center text-dark">         
                            @foreach ($unidades as $unidad)
                              <tr>    
                                  <td class="py-1 align-middle">
                                        <div class="row justify-content-center p-2">
                                              <a  href="javascript:void(0)" onclick="listarTemas({{$unidad->id_unidad}})" class="btn btn-info" title="Listar temas">
                                                Temas</a>
                                        </div>                                      
                                  </td>  
                                  <td class="py-1 align-middle">{{$unidad->orden_unidad}}</td>
                                  <td class="py-1 align-middle">{{$unidad->titulo_unidad}}</td>
                                  <td class="py-1 align-middle">{{$unidad->horas_unidad}}</td>
                                  <td class="py-1 align-middle">{{$unidad->criterioevaluacion_unidad}}</td>
                                  <td class="py-1 align-middle">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col p-1 ">
                                            <a  href="javascript:void(0)" onclick="listarTiposEvaluaciones({{$unidad->id_unidad}})" class="btn btn-secondary btn-sm " title="Listar tipos de evaluaciones">
                                            Evaluaciones</a>
                                        </div> 
                                    </div> 
                                  </td>
                                  <td class="py-1 align-middle">
                                      <div class="row justify-content-center align-items-center">
                                              <div class="p-1">
                                                  <a  href="javascript:void(0)" onclick="listarTecnicasInstrumentos({{$unidad->id_unidad}})" class="btn btn-secondary btn-sm " title="Listar tecnicas e instrumentos">
                                                  Técnicas e Instrumentos</a>
                                              </div>
                                      </div>
                                  </td>
                                  <td class="py-1 align-middle">
                                      <div class="row justify-content-center align-items-center">
                                              <div class="p-1">
                                                  <a  href="javascript:void(0)" onclick="listarResultadosUnidad({{$unidad->id_unidad}})" class="btn btn-secondary btn-sm " title="Listar resultados de aprendizaje de unidad">
                                                  Resultados</a>
                                              </div>
                                      </div>
                                  </td>
                              </tr>
                          @endforeach   
                      </tbody>                                 
                </table>                 
                @foreach ($silabosU as $silabo)
                    <input type="hidden" id="txtSilaboU" name="txtSilaboU" value="{{$silabo->id_sil}}">
                @endforeach     
                <!--------------------------------------------------modal evaluacion Unidad..........................-->
                <div class="modal fade " id="evaluaciones_modal" data-backdrop="static" tabindex="1" role="dialog" aria-labelledby="staticBackdropLabel12" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header btn-light">
                                <h5 class="modal-title text-secondary" id="staticBackdropLabel12"><i class="fa fa-th-list mr-2" aria-hidden="true"></i>Evaluaciones por unidad</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body overflow-scroll" id="cargarEvaluaciones">                        
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle mr-2" aria-hidden="true"></i>Cerrar</button>       
                            </div>                           
                        </div>
                    </div>
                </div><!--fin modal evaluacion unidad-->   
                 <!--------------------------------------------------modal tecnias e instrumentos..........................-->
                    <div class="modal fade " id="tecnicasInstrumentos_modal" data-backdrop="static" tabindex="1" role="dialog" aria-labelledby="staticBackdropLabel13" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel13"><i class="fa fa-th-list mr-2" aria-hidden="true"></i>Tecnicas e instrumnetos </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                                <div class="modal-body overflow-scroll" id="cargarTecniasInstrumentos">                                                        
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle mr-2" aria-hidden="true"></i>Cerrar</button>
                                </div>                                                  
                        </div>
                    </div>
                </div><!--fin modal tecnicas e instrumentos-->   
                 <!--------------------------------------------------modal RESULTADOS DE UNIDAD..........................-->
                <div class="modal fade " id="resultadosUnidad_modal" data-backdrop="static" tabindex="1" role="dialog" aria-labelledby="staticBackdropLabel14" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel14"><i class="fa fa-th-list mr-2" aria-hidden="true"></i>Resultados </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>                         
                                <div class="modal-body overflow-scroll" id="cargarResuladosUnidad">                                                         
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle mr-2" aria-hidden="true"></i>Cerrar</button>                                  
                                </div>                                                  
                        </div>
                    </div>
                </div><!--fin modal RESULTADOS DE UNIDAD-->      
        </div>            
         <script>//CARGAER temas
                function listarTemas(id){                  
                    $.ajax({
                        url:'/temas/mostrarTemas2/'+id,
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenidoUnidades').empty().append($(data));
                                }
                                );
                            }
                    });
                }
        </script> 
         <script>//CARGAER evaluaciones
                function listarTiposEvaluaciones(id){                
                    $.ajax({
                        url:'/evaluaciones/mostrarEvaluaciones2/'+id,
                            success : function(data){
                                setTimeout(function(){
                                    $('#cargarEvaluaciones').empty().append($(data));
                                }
                                );
                            }
                    });
                    $('#evaluaciones_modal').modal('show');
                }
                function listarTecnicasInstrumentos(id){               
                   $.ajax({
                       url:'/tecnicas/mostrarTecnicasInstrumentos2/'+id,
                           success : function(data){
                               setTimeout(function(){
                                   $('#cargarTecniasInstrumentos').empty().append($(data));
                               }
                               );
                           }
                   });
                   $('#tecnicasInstrumentos_modal').modal('show');
               }
               function listarResultadosUnidad(id){
                   $.ajax({
                       url:'/resultados/mostrarRU2/'+id,
                           success : function(data){
                               setTimeout(function(){
                                   $('#cargarResuladosUnidad').empty().append($(data));
                               }
                               );
                           }
                   });
                   $('#resultadosUnidad_modal').modal('show');
               }           
        </script> 
    <body>