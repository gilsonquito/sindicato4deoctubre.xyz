<head>
        <link href="{{asset('css/tablaUnidades.css')}}" rel="stylesheet">
        <title>Unidades</title>
</head>
<body>
        <div id="contenidoUnidades" class="p-2">
                <div class="px-1 py-3 text-left" >
                    <button onclick="agregarUnidad()" class="btn btn-outline-success" id="btnAgregarUnidad" name="btnAgregarUnidad"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>Agregar unidad</button>
                </div>
                <p class="text-left font-weight-bold text-muted" href="#">Listado de Unidades</p>
                <table id="tabla-sil" class="table table-striped table-bordered table-responsive-lg w-100">
                        <thead class="font-weight-bold text-center text-secondary" >
                            <td class="col-md-1 align-middle">Acciones</td>
                            <td class="col-md-1 align-middle">Orden de unidad</td>
                            <td class="col-md-2 align-middle">Título de unidad</td>
                            <td class="col-md-1 align-middle">Horas de unidad</td>
                            <td class="col-md-4 align-middle">Criterio de evaluación</td>
                            <td class="col-md-1 align-middle">Tipo de evaluación</td>
                            <td class="col-md-2 align-middle">Técnicas e instrumentos</td>
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
                                      <div class="row justify-content-center">
                                          <div class="p-1 justify-content-center">
                                              <a  onclick="editarUnidades({{$unidad->id_unidad}})" class="btn btn btn-outline-warning btn-sm " title="Editar Unidad">
                                                   <i class="fa fa-pencil px-2" aria-hidden="true"></i>
                                                </a>                                           
                                          </div>
                                          <div class="p-1 justify-content-center">
                                               <button type="button" name="DeleteUnidad"  class="DeleteUnidad btn btn-outline-danger btn-sm" id="{{$unidad->id_unidad}}" title="Eliminar Unidad">
                                                  <i class="fa fa-trash-o px-2" aria-hidden="true"></i>
                                              </button>
                                          </div>
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
                    <!--------------------------------------------------modal ingresar unidad ..........................-->
                <div class="modal fade " id="ingresarUnidades_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel10" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel10"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Ingresar unidad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="ingresarUnidades_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Orden de unidad</label>
                                                <input id="txtOrdenUnidad" name="txtOrdenUnidad" type="text" class="form-control" tabindex="1" required maxlength="2">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Título de unidad</label>
                                                <input id="txtTituloUnidad" name="txtTituloUnidad" type="text" class="form-control" tabindex="2" required maxlength="100">
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Horas de unidad</label>
                                                <input id="txtHorasUnidad" name="txtHorasUnidad" type="text" class="form-control" tabindex="3" required maxlength="3">
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-12 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Criterios de evaluación de unidad</label>
                                                    <textarea id="txtCriteriosEvaluacion" name="txtCriteriosEvaluacion" class="form-control" aria-label="With textarea"  tabindex="4" maxlength="300" required ></textarea>
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnIngresar" name="btnIngresar"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar unidad</button>
                                    <div id="girarIngresarUnidad" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->
                <!-----------------------------------modal eliminar unidad--------------------------------------->             
                <div class="modal fade" id="modalEliminarUnidad_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-light text-dark ">
                                <h5 class="modal-title text-center text-muted" id="exampleModalLabel"><i class="fa fa-check-circle-o mr-2" aria-hidden="true"></i>Confirmar para eliminar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <hr>
                                    ¿Esta seguro de eliminar la unidad seleccionada?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarUnidad" name="btnEliminarUnidad"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar unidad     
                                </button>  
                            </div>
                            <div id="girarEliminar" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                <!--------------------------------------------------modal editar unidad ..........................-->
                <div class="modal fade " id="editarUnidadModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel11" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel11"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar unidad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="editarUnidades_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <input type="hidden" id="txtIdUnidad" name="txtIdUnidad">
                                    <input type="hidden" id="txtIdSilaboUnidad" name="txtIdSilaboUnidad">
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Orden de unidad</label>
                                                <input id="txtOrdenUnidad2" name="txtOrdenUnidad2" type="text" class="form-control" tabindex="1" required maxlength="2">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Título de unidad</label>
                                                <input id="txtTituloUnidad2" name="txtTituloUnidad2" type="text" class="form-control" tabindex="2" required maxlength="100">
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Horas de unidad</label>
                                                <input id="txtHorasUnidad2" name="txtHorasUnidad2" type="text" class="form-control" tabindex="3" required maxlength="3">
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-12 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Criterios de evaluación de unidad</label>
                                                    <textarea id="txtCriteriosEvaluacion2" name="txtCriteriosEvaluacion2" class="form-control" aria-label="With textarea"  tabindex="4" maxlength="300" required ></textarea>
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnActualizarUnidad" name="btnActualizarUnidad"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                    <div id="girarActualizarUnidad" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal editar-->
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
        <script>//CARGAER EN EL FORMULARIO PARA ingresar unidad
            function agregarUnidad(){          
                    $('#ingresarUnidades_modal').modal('toggle');
                    $("input[name=_token]").val();
            }
        </script>  
        <script>//ingresar unidad
                $('#ingresarUnidades_form').submit(function(e){
                e.preventDefault();
                var ordenUnidad=$('#txtOrdenUnidad').val();
                var tituloUnidad=$('#txtTituloUnidad').val();
                var horasUnidad=$('#txtHorasUnidad').val();
                var criteriosUnidad=$('#txtCriteriosEvaluacion').val();
                var id_silU=$('#txtSilaboU').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('unidad.ingresarUnidad')}}",
                            type:"POST",
                            data:{
                                ordenUnidad:ordenUnidad, 
                                tituloUnidad:tituloUnidad,
                                horasUnidad:horasUnidad, 
                                criteriosUnidad:criteriosUnidad,
                                id_silU:id_silU,
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnIngresar').text('Ingresando Datos..'); 
                                $('#girarIngresarUnidad').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    $.ajax({
                                            url:'/unidad/mostrarUnidades/'+id_silU,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#contenidoUnidades').empty().append($(data));
                                                    }
                                                    );
                                                }
                                    });
                                    $('#ingresarUnidades_modal').modal('hide');
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    $('#btnIngresar').text('Agregar unidad'); 
                                    $('#girarIngresarUnidad').hide(); 
                                }
                            },
                            error:function(response)
                            {
                                $('#ingresarUnidades_modal').modal('hide');
                                toastr.error('No se ingresaron lso datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnIngresar').text('Agregar unidad'); 
                                $('#girarIngresarUnidad').hide(); 
                            }
                        });
                })
            </script>
           <script>
                    $("#txtOrdenUnidad").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#txtHorasUnidad").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
            </script>
            <script>//eliminar unidad
                    var _id;
                    $(document).on('click','.DeleteUnidad',function(){
                        _id=$(this).attr('id'); 
                        $('#modalEliminarUnidad_modal').modal('show');
                    });
                    $('#btnEliminarUnidad').click(function(){
                        var id_silU=$('#txtSilaboU').val();
                        $.ajax({                    
                            url:"/unidad/eliminarUnidad/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarUnidad').text('Eliminando..'); 
                                $('#girarEliminar').show(); 
                            },
                            success:function(data){              
                                    $.ajax({
                                                    url:'/unidad/mostrarUnidades/'+id_silU,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#contenidoUnidades').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                    });  
                                    $('#modalEliminarUnidad_modal').modal('hide');
                                    toastr.success('La unidad fue eliminada exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarUnidad').text('Eliminar unidad'); 
                                    $('#girarEliminar').hide();                                                           
                            },
                            error : function(data){
                                toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarUnidad').text('Eliminar unidad'); 
                                $('#girarEliminar').hide(); 
                            }  
                        });
                    });
            </script>
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR unidad
                function editarUnidades(id){                   
                    $.get('/unidad/editarUnidad/'+id, function(Unidad)
                    {  
                        //asignar datos recuperados
                        $('#txtIdUnidad').val(Unidad[0].id_unidad);
                        $('#txtIdSilaboUnidad').val(Unidad[0].id_sil);
                        $('#txtOrdenUnidad2').val(Unidad[0].orden_unidad);
                        $('#txtTituloUnidad2').val(Unidad[0].titulo_unidad);
                        $('#txtHorasUnidad2').val(Unidad[0].horas_unidad);
                        $('#txtCriteriosEvaluacion2').val(Unidad[0].criterioevaluacion_unidad);
                        $('#editarUnidadModal').modal('toggle');
                        $("input[name=_token]").val();
                    });
                }
            </script> 
             <script>//actualizar unidad
                $('#editarUnidades_form').submit(function(e){
                e.preventDefault();
                var id_silU=$('#txtIdSilaboUnidad').val();
                var id_unidad2=$('#txtIdUnidad').val();
                var orden_unidad2=$('#txtOrdenUnidad2').val();
                var titulo_unidad2=$('#txtTituloUnidad2').val();
                var horas_unidad2=$('#txtHorasUnidad2').val();
                var criterioevaluacion_unidad2=$('#txtCriteriosEvaluacion2').val();
                var _token2=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('unidad.actualizarUnidad')}}",
                            type:"POST",
                            data:{
                                id_unidad:id_unidad2, 
                                orden_unidad:orden_unidad2,
                                titulo_unidad:titulo_unidad2,
                                horas_unidad:horas_unidad2,
                                criterioevaluacion_unidad:criterioevaluacion_unidad2,
                                _token:_token2
                            },
                            beforeSend:function(){
                                $('#btnActualizarUnidad').text('Actualizando..'); 
                                $('#girarActualizarUnidad').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    $.ajax({
                                            url:'/unidad/mostrarUnidades/'+id_silU,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#contenidoUnidades').empty().append($(data));
                                                    }
                                                    );
                                                }
                                    });
                                    $('#editarUnidadModal').modal('hide');
                                    toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                    $('#btnActualizarUnidad').text('Guardar cambios'); 
                                    $('#girarActualizarUnidad').hide();                                    
                                }
                            },
                            error:function(response)
                            {                               
                                toastr.error('No se actualizaron correctamente los datos intente nuevammente','ERROR AL ACTUALIZAR',{timeOut:1000});
                                    $('#btnActualizarUnidad').text('Guardar cambios'); 
                                    $('#girarActualizarUnidad').hide(); 
                            }
                        });
                })
        </script>
         <script>//CARGAER temas
                function listarTemas(id){                  
                    $.ajax({
                        url:'/temas/mostrarTemas/'+id,
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
                        url:'/evaluaciones/mostrarEvaluaciones/'+id,
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
                       url:'/tecnicas/mostrarTecnicasInstrumentos/'+id,
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
                       url:'/resultados/mostrarRU/'+id,
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