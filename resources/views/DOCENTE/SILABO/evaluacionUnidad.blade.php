    <head>
        <link href="{{asset('css/evaluacionUnidad.css')}}" rel="stylesheet">
        <title>Evaluaciónes de unidad</title>
    </head>
    <body>
        <div id="contenidoEvaluaciones">
            <h5 class="text-left font-weight-normal text-dark" href="#">Tipo de Evaluación</h5>
            <hr color="" class="border border-muted w-100 p-0">
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <button onclick="agregarEvaluacion()" class="btn btn-outline-success" id="btnAgregarEvaluacion" name="btnAgregarEvaluacion"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>Agregar evaluación</button>
                    </div>
                </div>
                <p class="text-left font-weight-bold text-muted" href="#">Listado de evaluaciones</p>
                <table id="tablaEvaluaciones" class="table table-striped table-bordered table-responsive-lg w-100">
                        <thead class="font-weight-bold text-center text-muted bg-light" >
                            <tr>
                                <td class="col-md-3 align-middle" rowspan="3">Acciones</td>
                                <td class="col-md-3 align-middle" rowspan="3">Tipo de Evaluación</td>
                                <td class="col-md-6 align-middle" rowspan="3">Detalle de Evaluaciones</td>
                            </tr>   
                        </thead>
                        <tbody class="text-center text-dark">         
                            @foreach ($evaluaciones as $evaluacion)
                              <tr>    
                                  <td class="py-1">
                                      <div class="row justify-content-center">
                                          <div class="p-1 justify-content-center">
                                              <a  onclick="editarEvaluacion({{$evaluacion->id_evaluacion}})" class="btn btn btn-outline-warning btn-sm " title="Editar evaluacion">
                                                   <i class="fa fa-pencil px-2" aria-hidden="true"></i>
                                                </a>    
                                          </div>
                                          <div class="p-1 justify-content-center">
                                               <button type="button" name="DeleteEvaluacion"  class="DeleteEvaluacion btn btn-outline-danger btn-sm" id="{{$evaluacion->id_evaluacion}}" title="Eliminar evaluacion">
                                                  <i class="fa fa-trash-o px-2" aria-hidden="true"></i>
                                              </button>
                                          </div>
                                      </div>  
                                  </td>  
                                  <td class="py-1">{{$evaluacion->tipo_evaluacion}}</td>
                                  <td class="py-1">{{$evaluacion->detalle_evaluacion}}</td>
                              </tr>
                          @endforeach   
                      </tbody>                                 
                </table>    
                @foreach ($unidadesE as $unidad)
                    <input type="hidden" id="txtIdunidadE" name="txtIdunidadE" value="{{$unidad->id_unidad}}">
                @endforeach   
                <!--------------------------------------------------modal ingresar evaluacion ..........................-->
                <div class="modal fade bg-dark" id="ingresarEvaluacionModal" data-backdrop="static" tabindex="1040" role="dialog" aria-labelledby="staticBackdropLabel4" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel4"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Ingresar evaluacion unidad</h5>
                            <button onclick="cerrarModalEvaluaciones()" type="button" class="close" data-dismiss="" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="ingresarEvaluacion_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Tipo de evaluación</label>
                                                <input id="txtTipoEvaluacion" name="txtTipoEvaluacion" type="text" class="form-control" tabindex="1" required maxlength="50">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Detalle de evaluación</label>
                                                    <textarea id="txtDetalleEvaluacion" name="txtDetalleEvaluacion" class="form-control" aria-label="With textarea"  tabindex="2" maxlength="300" required ></textarea>
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss=""  onclick="cerrarModalEvaluaciones()"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnIngresarEvaluacion" name="btnIngresarEvaluacion"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Evaluación</button>
                                    <div id="girarIngresarEvaluacion" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->
                <!-----------------------------------modal eliminar evaluacion--------------------------------------->             
                <div class="modal fade bg-dark" id="modalEliminarEvaluacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
                    <div class="modal-dialog  " role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-light text-dark ">
                                <h5 class="modal-title text-center text-muted" id="exampleModalLabel"><i class="fa fa-check-circle-o mr-2" aria-hidden="true"></i>Confirmar para eliminar</h5>
                                <button  onclick="cerrarModalEliminarEvaluaciones()"  type="button" class="close" data-dismiss="" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <hr>
                                    ¿Esta seguro de eliminar la evaluación seleccionada?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss=""  onclick="cerrarModalEliminarEvaluaciones()"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarEvaluacion" name="btnEliminarEvaluacion"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar Evaluacion     
                                </button>  
                            </div>
                            <div id="girarEliminarEvaluacion" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                <!--------------------------------------------------modal editar evaluacion ..........................-->
                    <div class="modal fade bg-dark" id="editarEvaluacionModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel5" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel5"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar Evaluación</h5>
                            <button  onclick="cerrarModalEditarEvaluaciones()" type="button" class="close" data-dismiss="" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="editarEvaluacion_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <input type="hidden" id="txtIdEvaluacion" name="txtIdEvaluacion">
                                    <input type="hidden" id="txtIdUnidadEE" name="txtIdUnidadEE">
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Tipo e evaluación</label>
                                                <input id="txtTipoEvaluacion2" name="txtTipoEvaluacion2" type="text" class="form-control" tabindex="1" required maxlength="50">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Detalle de evaluación</label>
                                                    <textarea id="txtDetalleEvaluacion2" name="txtDetalleEvaluacion2" class="form-control" aria-label="With textarea"  tabindex="2" maxlength="300" required ></textarea>
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button onclick="cerrarModalEditarEvaluaciones()"  type="button" class="btn btn-secondary" data-dismiss=""><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnActualizarEvaluacion" name="btnActualizarEvaluacion"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                    <div id="girarActualizarEvaluacion" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->               
        </div>        
        <script>//CARGAER  EL FORMULARIO PARA ingresar tema
            function agregarEvaluacion(){          
                    $('#ingresarEvaluacionModal').modal('toggle');
                    $("input[name=_token]").val();
            }
            
            function cerrarModalEvaluaciones(){          
                    $('#ingresarEvaluacionModal').modal('hide');
                    
            }
            function cerrarModalEliminarEvaluaciones(){          
                    $('#modalEliminarEvaluacion').modal('hide');
                   
            }
            function cerrarModalEditarEvaluaciones(){          
                    $('#editarEvaluacionModal').modal('hide');
                   
            }
            
        </script>  
        <script>//ingresar evaluacion
                $('#ingresarEvaluacion_form').submit(function(e){
                e.preventDefault();
                var tipo_evaluacion=$('#txtTipoEvaluacion').val();
                var detalle_evaluacion=$('#txtDetalleEvaluacion').val();
                var id_unidad=$('#txtIdunidadE').val();
                var _token=$("input[name=_token]").val();
                
                        $.ajax({
                            url:"{{route('evaluaciones.ingresarEvaluacion')}}",
                            type:"POST",
                            data:{ 
                                tipo_evaluacion:tipo_evaluacion,
                                detalle_evaluacion:detalle_evaluacion, 
                                id_unidad:id_unidad,
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnIngresarEvaluacion').text('Ingresando Datos..'); 
                                $('#girarIngresarEvaluacion').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    $.ajax({
                                        
                                            url:'/evaluaciones/mostrarEvaluaciones/'+id_unidad,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#contenidoEvaluaciones').empty().append($(data));
                                                    }
                                                    );
                                                }
                                    });
                                    $('#ingresarEvaluacionModal').modal('hide');
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    $('#btnIngresarEvaluacion').text('Agregar Evaluación'); 
                                    $('#girarIngresarEvaluacion').hide(); 
                                }
                            },
                            error:function(response)
                            {
                                $('#ingresarEvaluacionModal').modal('hide');
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#girarIngresarEvaluacion').text('Agregar Subtema'); 
                               
                            }
                        });
                })
            </script>
            <script>//eliminar evaluacion
                    var _id;
                    $(document).on('click','.DeleteEvaluacion',function(){
                        _id=$(this).attr('id'); 
                       
                        $('#modalEliminarEvaluacion').modal('show');
                    });
                    $('#btnEliminarEvaluacion').click(function(){
                        var id_unidad=$('#txtIdunidadE').val();
                        $.ajax({
                            url:"/evaluaciones/eliminarEvaluacion/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarEvaluacion').text('Eliminando..'); 
                                $('#girarEliminarEvaluacion').show(); 
                            },
                            success:function(data){              
                                    $.ajax({
                                            url:'/evaluaciones/mostrarEvaluaciones/'+id_unidad,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#contenidoEvaluaciones').empty().append($(data));
                                                    }
                                                    );
                                                }
                                    });
                                    $('#modalEliminarEvaluacion').modal('hide');
                                    toastr.success('La evaluación fue eliminada exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarEvaluacion').text('Eliminar Evaluacion'); 
                                    $('#girarEliminarEvaluacion').hide(); 
                           
                               
                            },
                            error : function(data){
                                toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarEvaluacion').text('Eliminar Evaluacion'); 
                                $('#girarEliminarEvaluacion').hide();  
                            }  
                        });
                    });
            </script>  
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR subtema
                function editarEvaluacion(id){
                    $.get('/evaluaciones/editarEvaluacion/'+id, function(Evaluacion)
                    {  
                        //asignar datos recuperados
                        $('#txtIdEvaluacion').val(Evaluacion[0].id_evaluacion);
                        $('#txtTipoEvaluacion2').val(Evaluacion[0].tipo_evaluacion);
                        $('#txtDetalleEvaluacion2').val(Evaluacion[0].detalle_evaluacion);
                        $('#txtIdUnidadEE').val(Evaluacion[0].id_unidad);
                        $('#editarEvaluacionModal').modal('toggle');
                        $("input[name=_token]").val();
                    });
                }
            </script> 
             <script>//actualizar subtema
                $('#editarEvaluacion_form').submit(function(e){
                    e.preventDefault();
                    var id_evaluacion2=$('#txtIdEvaluacion').val();
                    var tipo_evaluacion2=$('#txtTipoEvaluacion2').val();
                    var detalle_evaluacion2=$('#txtDetalleEvaluacion2').val();
                    var id_unidad2=$('#txtIdUnidadEE').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('evaluaciones.actualizarEvaluacion')}}",
                                type:"POST",
                                data:{
                                    id_evaluacion:id_evaluacion2,
                                    tipo_evaluacion:tipo_evaluacion2,
                                    detalle_evaluacion:detalle_evaluacion2,
                                    id_unidad:id_unidad2,
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizarEvaluacion').text('Actualizando..'); 
                                    $('#girarActualizarEvaluacion').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        $.ajax({
                                            url:'/evaluaciones/mostrarEvaluaciones/'+id_unidad2,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#contenidoEvaluaciones').empty().append($(data));
                                                    }
                                                    );
                                                }
                                        });  
                                        $('#editarEvaluacionModal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                        $('#btnActualizarEvaluacion').text('Guardar cambios'); 
                                        $('#girarActualizarEvaluacion').hide(); 
                                    }
                                },
                                error:function(response)
                                {
                                    
                                        toastr.error('No se actualizaron correctamente los datos intente nuevammente','ERROR AL ACTUALIZAR',{timeOut:1000});
                                        $('#btnActualizarEvaluacion').text('Guardar cambios'); 
                                        $('#girarActualizarEvaluacion').hide();  
                                }
                            });
                    })
            </script>
                 
    <body>
</html>