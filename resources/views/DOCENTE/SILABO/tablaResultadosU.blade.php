    <head>
        <link href="{{asset('css/tablaResultadoUnidad.css')}}" rel="stylesheet">
        <title>Resultados de aprendixaje de la unidad</title>
    </head>
    <body>
        <div id="contenidoResultadoUnidad">
            <h5 class="text-left font-weight-normal text-dark" href="#">Resultados de aprendizaje de la unidad</h5>
            <hr color="" class="border border-muted w-100 p-0">
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <button onclick="agregarResultadoUnidad()" class="btn btn-outline-success" id="btnAgregarEvaluacion" name="btnAgregarEvaluacion"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>Agregar resultado de aprendizaje</button>
                    </div>
                </div>
                <p class="text-left font-weight-bold text-muted" href="#">Listado de Resultados por Unidad</p>
                <table id="tablaResultadoUnidad" class="table table-striped table-bordered table-responsive-lg w-100">
                        <thead class="font-weight-bold text-center text-muted bg-light" >
                            <tr>
                                <td class="col-md-3 align-middle" rowspan="3">Acciones</td>
                                <td class="col-md-9 align-middle" rowspan="3">Resultado</td>
                            </tr>   
                        </thead>
                        <tbody class="text-center text-dark">         
                            @foreach ($resultados as $resultado)
                              <tr>    
                                  <td class="py-1">
                                      <div class="row justify-content-center">
                                          <div class="p-1 justify-content-center">
                                              <a  onclick="editarResultadoUnidad({{$resultado->id_resultado}})" class="btn btn btn-outline-warning btn-sm " title="Editar resultado de aprendizaje">
                                                   <i class="fa fa-pencil px-2" aria-hidden="true"></i>
                                                </a>   
                                          </div>
                                          <div class="p-1 justify-content-center">
                                               <button type="button" name="DeleteRU"  class="DeleteRU btn btn-outline-danger btn-sm" id="{{$resultado->id_resultado}}" title="Eliminar resultado de prendizaje">
                                                  <i class="fa fa-trash-o px-2" aria-hidden="true"></i>
                                              </button>
                                          </div>
                                      </div>  
                                  </td>  
                                  <td class="py-1">{{$resultado->resultado}}</td>
                              </tr>
                          @endforeach   
                      </tbody>                                 
                </table>    
                @foreach ($unidadesRU as $unidad)
                    <input type="hidden" id="txtIdunidadRU" name="txtIdunidadRU" value="{{$unidad->id_unidad}}">
                @endforeach   
                <!--------------------------------------------------modal ingresar RESULTADO UNIDAD ..........................-->
                <div class="modal fade bg-dark" id="ingresarRU_modal" data-backdrop="static" tabindex="1040" role="dialog" aria-labelledby="staticBackdropLabel8" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel8"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Ingresar resultado de aprendizaje de unidad</h5>
                            <button onclick="cerrarModalRU()" type="button" class="close" data-dismiss="" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="ingresarRU_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-9 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Resultado de Aprendizaje de Unidad</label>
                                                    <textarea id="txtRU" name="txtRU" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="1000" required ></textarea>
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss=""  onclick="cerrarModalRU()"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnIngresarRU" name="btnIngresarRU"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Resultado de Aprendizaje</button>
                                    <div id="girarIngresarRU" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal RESULTADO UNIDAD -->
                <!-----------------------------------modal eliminar RESULTADO UNIDAD--------------------------------------->             
                <div class="modal fade bg-dark" id="modalEliminarRU" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
                    <div class="modal-dialog  " role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-light text-dark ">
                                <h5 class="modal-title text-center text-muted" id="exampleModalLabel"><i class="fa fa-check-circle-o mr-2" aria-hidden="true"></i>Confirmar para eliminar</h5>
                                <button  onclick="cerrarModalEliminarRU()"  type="button" class="close" data-dismiss="" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <hr>
                                    ¿Esta seguro de eliminar el Resultado seleccionado?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss=""  onclick="cerrarModalEliminarRU()"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarRU" name="btnEliminarRU"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar Resultado     
                                </button>  
                            </div>
                            <div id="girarEliminarRU" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                       <!--------------------------------------------------modal editar resultado unidad ..........................-->
                    <div class="modal fade bg-dark" id="editarRUModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel9" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel9"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar Resultado de Undiad</h5>
                            <button  onclick="cerrarModalEditarRU()" type="button" class="close" data-dismiss="" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="editarRU_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <input type="hidden" id="txtIDResultado" name="txtIDResultado">
                                    <input type="hidden" id="txtIdUnidadRU2" name="txtIdUnidadRU2">
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-9 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Resultado de Aprendizaje de Unidad</label>
                                                    <textarea id="txtRU2" name="txtRU2" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="1000" required ></textarea>
                                            </div>
                                    </div> 
                                </div>
                                <div class="modal-footer">
                                    <button onclick="cerrarModalEditarRU()"  type="button" class="btn btn-secondary" data-dismiss=""><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnActualizarRU" name="btnActualizarRU"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                    <div id="girarActualizarRU" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->                 
        </div>        
        <script>//CARGAER  EL FORMULARIO PARA ingresar tema
            function agregarResultadoUnidad(){          
                    $('#ingresarRU_modal').modal('toggle');
                    $("input[name=_token]").val();
            } 
            function cerrarModalRU(){          
                    $('#ingresarRU_modal').modal('hide');
                    
            }
            function cerrarModalEliminarRU(){          
                    $('#modalEliminarRU').modal('hide');
                   
            }
            function cerrarModalEditarRU(){          
                    $('#editarRUModal').modal('hide');
                   
            }    
        </script>  
        <script>//ingresar RESULTADO UNIDAD
                $('#ingresarRU_form').submit(function(e){
                e.preventDefault();
                var resultado=$('#txtRU').val();
                var id_unidad=$('#txtIdunidadRU').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('resultados.ingresarRU')}}",
                            type:"POST",
                            data:{ 
                                resultado:resultado,
                                id_unidad:id_unidad,
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnIngresarRU').text('Ingresando Datos..'); 
                                $('#girarIngresarRU').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    $.ajax({
                                        url:'/resultados/mostrarRU/'+id_unidad,
                                            success : function(data){
                                                setTimeout(function(){
                                                    $('#contenidoResultadoUnidad').empty().append($(data));
                                                }
                                                );
                                            }
                                    });
                                    $('#ingresarRU_modal').modal('hide');
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    $('#btnIngresarRU').text('Agregar Resultado de Aprendizaje'); 
                                    $('#girarIngresarRU').hide(); 
                                }
                            },
                            error:function(response)
                            {
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnIngresarRU').text('Agregar Resultado de Aprendizaje'); 
                                $('#girarIngresarRU').hide();   
                            }
                        });
                })
            </script>
            <script>//eliminar resultado
                    var _id;
                    $(document).on('click','.DeleteRU',function(){
                        _id=$(this).attr('id'); 
                       
                        $('#modalEliminarRU').modal('show');
                    });
                    $('#btnEliminarRU').click(function(){
                        var id_unidad=$('#txtIdunidadRU').val();
                        $.ajax({
                            url:"/resultados/eliminarRU/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarRU').text('Eliminando..'); 
                                $('#girarEliminarRU').show(); 
                            },
                            success:function(data){              
                                    $.ajax({
                                        url:'/resultados/mostrarRU/'+id_unidad,
                                            success : function(data){
                                                setTimeout(function(){
                                                    $('#contenidoResultadoUnidad').empty().append($(data));
                                                }
                                                );
                                            }
                                    });
                                    $('#modalEliminarRU').modal('hide');
                                    toastr.success('El resultado fue eliminado exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarRU').text('Eliminar Resultado'); 
                                    $('#girarEliminarRU').hide();   
                            },
                            error : function(data){
                                toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarRU').text('Eliminar Resultado'); 
                                $('#girarEliminarRU').hide();  
                            }  
                        });
                    });
            </script>            
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR resultado
                function editarResultadoUnidad(id){    
                    $.get('/resultados/editarRU/'+id, function(Resultado)
                    {  
                        //asignar datos recuperados
                        $('#txtIDResultado').val(Resultado[0].id_resultado);
                        $('#txtRU2').val(Resultado[0].resultado);
                        $('#txtIdUnidadRU2').val(Resultado[0].id_unidad);
                        $('#editarRUModal').modal('toggle');
                        $("input[name=_token]").val();
                    });
                }
            </script> 
             <script>//actualizar resultado
                $('#editarRU_form').submit(function(e){
                    e.preventDefault();
                    var id_resultado2=$('#txtIDResultado').val();
                    var resultado2=$('#txtRU2').val();
                    var id_unidad2=$('#txtIdUnidadRU2').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('resultados.actualizarRU')}}",
                                type:"POST",
                                data:{
                                    id_resultado:id_resultado2,
                                    resultado:resultado2,
                                    id_unidad:id_unidad2,
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizarRU').text('Actualizando..'); 
                                    $('#girarActualizarRU').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        $.ajax({
                                            url:'/resultados/mostrarRU/'+id_unidad2,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#contenidoResultadoUnidad').empty().append($(data));
                                                    }
                                                    );
                                                }
                                        });  
                                        $('#editarRUModal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                        $('#btnActualizarRU').text('Guardar cambios'); 
                                        $('#girarActualizarRU').hide();   
                                    }
                                },
                                error:function(response)
                                {
                                        toastr.error('No se actualizaron correctamente los datos intente nuevammente','ERROR AL ACTUALIZAR',{timeOut:1000});
                                        $('#btnActualizarRU').text('Guardar cambios'); 
                                        $('#girarActualizarRU').hide();  
                                }
                            });
                    })
            </script>          
    <body>
