    <head>
        <link href="{{asset('css/tecnicaInstrumento.css')}}" rel="stylesheet">
        <title>Técnicas e instrumentos</title>
    </head>
    <body>
        <div id="contenidoTecnicasInstrumentos">
            <h5 class="text-left font-weight-normal text-dark" href="#">Técnicas e instrumentos</h5>
            <hr color="" class="border border-muted w-100 p-0">
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <button onclick="agregarTecnicaInstumento()" class="btn btn-outline-success" id="btnAgregarEvaluacion" name="btnAgregarEvaluacion"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>Agregar técnica e instrumento</button>
                    </div>
                </div>
                <p class="text-left font-weight-bold text-muted" href="#">Listado de tecnicas e instrumentos</p>
                <table id="tablaTecnicasInstrumentos" class="table table-striped table-bordered table-responsive-lg w-100">
                        <thead class="font-weight-bold text-center text-muted bg-light" >
                            <tr>
                                <td class="col-md-3 align-middle" rowspan="3">Acciones</td>
                                <td class="col-md-3 align-middle" rowspan="3">Técnica</td>
                                <td class="col-md-6 align-middle" rowspan="3">Instrumento</td>
                            </tr>   
                        </thead>
                        <tbody class="text-center text-dark">         
                            @foreach ($tecnicas as $tecnica)
                              <tr>    
                                  <td class="py-1">
                                      <div class="row justify-content-center">
                                          <div class="p-1 justify-content-center">
                                              <a  onclick="editarTecnicaInstrumento({{$tecnica->id_tecnicas}})" class="btn btn btn-outline-warning btn-sm " title="Editar tecnica e instrumento">
                                                   <i class="fa fa-pencil px-2" aria-hidden="true"></i>
                                                </a>
                                          </div>
                                          <div class="p-1 justify-content-center">
                                               <button type="button" name="DeleteTI"  class="DeleteTI btn btn-outline-danger btn-sm" id="{{$tecnica->id_tecnicas}}" title="Eliminar Tecnica e Instrumento">
                                                  <i class="fa fa-trash-o px-2" aria-hidden="true"></i>
                                              </button>
                                          </div>
                                      </div>  
                                  </td>  
                                  <td class="py-1">{{$tecnica->tecnica}}</td>
                                  <td class="py-1">{{$tecnica->instrumento}}</td>
                              </tr>
                          @endforeach   
                      </tbody>                                 
                </table>    
                @foreach ($unidadesT as $unidad)
                    <input type="hidden" id="txtIdunidadT" name="txtIdunidadT" value="{{$unidad->id_unidad}}">
                @endforeach   
                <!--------------------------------------------------modal ingresar tecnica instrumento ..........................-->
                <div class="modal fade bg-dark" id="ingresarTecnicaInstrumentoModal" data-backdrop="static" tabindex="1040" role="dialog" aria-labelledby="staticBackdropLabel6" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel6"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Ingresar técnica e instrumento</h5>
                            <button onclick="cerrarModalTecnicaInstrumento()" type="button" class="close" data-dismiss="" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="ingresarTecnicaInstrumento_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Técnica</label>
                                                <input id="txtTecnicaI" name="txtTecnicaI" type="text" class="form-control" tabindex="1" required maxlength="50">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Instrumento</label>
                                                    <input id="txtInstrumentoT" name="txtInstrumentoT" type="text" class="form-control" tabindex="2" required maxlength="50">
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss=""  onclick="cerrarModalTecnicaInstrumento()"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnIngresarTecnicaInstrumento" name="btnIngresarTecnicaInstrumento"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Técnica e Instrumento</button>
                                    <div id="girarIngresarTecnicaInstrumento" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->
                <!-----------------------------------modal eliminar tecnica instrumento--------------------------------------->             
                <div class="modal fade bg-dark" id="modalEliminarTI" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
                    <div class="modal-dialog  " role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-light text-dark ">
                                <h5 class="modal-title text-center text-muted" id="exampleModalLabel"><i class="fa fa-check-circle-o mr-2" aria-hidden="true"></i>Confirmar para eliminar</h5>
                                <button  onclick="cerrarModalEliminarTI()"  type="button" class="close" data-dismiss="" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <hr>
                                    ¿Esta seguro de eliminar la técnica e instrumento seleccionada?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss=""  onclick="cerrarModalEliminarTI()"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarTI" name="btnEliminarTI"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar Técnica e Instrumento     
                                </button>  
                            </div>
                            <div id="girarEliminarTI" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                <!--------------------------------------------------modal editar TI ..........................-->
                <div class="modal fade bg-dark" id="editarTIModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel7" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel7"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar Técnica e instrumento</h5>
                            <button  onclick="cerrarModalEditarTI()" type="button" class="close" data-dismiss="" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="editarTI_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <input type="hidden" id="txtIDTecnica" name="txtIDTecnica">
                                    <input type="hidden" id="txtIdUnidadTI" name="txtIdUnidadTI">
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Técnica</label>
                                                <input id="txtTecnicaI2" name="txtTecnicaI2" type="text" class="form-control" tabindex="1" required maxlength="50">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Instrumento</label>
                                                    <input id="txtInstrumentoT2" name="txtInstrumentoT2" type="text" class="form-control" tabindex="2" required maxlength="50">
                                            </div>
                                    </div>  
                                </div>
                                <div class="modal-footer">
                                    <button onclick="cerrarModalEditarTI()"  type="button" class="btn btn-secondary" data-dismiss=""><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnActualizarTI" name="btnActualizarTI"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                    <div id="girarActualizarTI" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->                 
        </div>        
        <script>//CARGAER  EL FORMULARIO PARA ingresar tecnicas
            function agregarTecnicaInstumento(){          
                    $('#ingresarTecnicaInstrumentoModal').modal('toggle');
                    $("input[name=_token]").val();
            }
            function cerrarModalTecnicaInstrumento(){          
                    $('#ingresarTecnicaInstrumentoModal').modal('hide');
                    
            }
            function cerrarModalEliminarTI(){          
                    $('#modalEliminarTI').modal('hide');
                   
            }
            function cerrarModalEditarTI(){          
                    $('#editarTIModal').modal('hide');
                   
            }
        </script>  
        <script>//ingresar tecnicas
                $('#ingresarTecnicaInstrumento_form').submit(function(e){
                e.preventDefault();
                var tecnica=$('#txtTecnicaI').val();
                var instrumento=$('#txtInstrumentoT').val();
                var id_unidad=$('#txtIdunidadT').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('tecnicas.ingresarTecnicaInstrumento')}}",
                            type:"POST",
                            data:{ 
                                tecnica:tecnica,
                                instrumento:instrumento, 
                                id_unidad:id_unidad,
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnIngresarTecnicaInstrumento').text('Ingresando Datos..'); 
                                $('#girarIngresarTecnicaInstrumento').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    $.ajax({
                                        url:'/tecnicas/mostrarTecnicasInstrumentos/'+id_unidad,
                                            success : function(data){
                                                setTimeout(function(){
                                                    $('#contenidoTecnicasInstrumentos').empty().append($(data));
                                                }
                                                );
                                            }
                                    });
                                    $('#ingresarTecnicaInstrumentoModal').modal('hide');
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    $('#btnIngresarTecnicaInstrumento').text('Agregar Técnica e Instrumento'); 
                                    $('#girarIngresarTecnicaInstrumento').hide(); 
                                }
                            },
                            error:function(response)
                            {
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnIngresarTecnicaInstrumento').text('Agregar Técnica e Instrumento'); 
                                $('#girarIngresarTecnicaInstrumento').hide(); 
                               
                            }
                        });
                })
            </script>
            <script>//eliminar tecnica
                    var _id;
                    $(document).on('click','.DeleteTI',function(){
                        _id=$(this).attr('id'); 
                        $('#modalEliminarTI').modal('show');
                    });
                    $('#btnEliminarTI').click(function(){
                        var id_unidad=$('#txtIdunidadT').val();
                        $.ajax({
                            url:"/tecnicas/eliminarTI/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarTI').text('Eliminando..'); 
                                $('#girarEliminarTI').show(); 
                            },
                            success:function(data){              
                                    $.ajax({
                                        url:'/tecnicas/mostrarTecnicasInstrumentos/'+id_unidad,
                                            success : function(data){
                                                setTimeout(function(){
                                                    $('#contenidoTecnicasInstrumentos').empty().append($(data));
                                                }
                                                );
                                            }
                                    });
                                    $('#modalEliminarTI').modal('hide');
                                    toastr.success('La tecnica fue eliminada exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarTI').text('Eliminar Técnica e Instrumento'); 
                                    $('#girarEliminarTI').hide();     
                            },
                            error : function(data){
                                toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarTI').text('Eliminar Técnica e Instrumento'); 
                                $('#girarEliminarTI').hide();  
                            }  
                        });
                    });
            </script>      
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR tecnica
                function editarTecnicaInstrumento(id){ 
                    $.get('/tecnicas/editarTI/'+id, function(Tecnica)
                    {  
                        //asignar datos recuperados
                        $('#txtIDTecnica').val(Tecnica[0].id_tecnicas);
                        $('#txtTecnicaI2').val(Tecnica[0].tecnica);
                        $('#txtInstrumentoT2').val(Tecnica[0].instrumento);
                        $('#txtIdUnidadTI').val(Tecnica[0].id_unidad);
                        $('#editarTIModal').modal('toggle');
                        $("input[name=_token]").val();
                    });
                }
            </script> 
             <script>//actualizar tecnica
                $('#editarTI_form').submit(function(e){
                    e.preventDefault();
                    var id_tecnicas2=$('#txtIDTecnica').val();
                    var tecnica2=$('#txtTecnicaI2').val();
                    var instrumento2=$('#txtInstrumentoT2').val();
                    var id_unidad2=$('#txtIdUnidadTI').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('tecnicas.actualizarTI')}}",
                                type:"POST",
                                data:{
                                    id_tecnicas:id_tecnicas2,
                                    tecnica:tecnica2,
                                    instrumento:instrumento2,
                                    id_unidad:id_unidad2,
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizarTI').text('Actualizando..'); 
                                    $('#girarActualizarTI').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        $.ajax({
                                            url:'/tecnicas/mostrarTecnicasInstrumentos/'+id_unidad2,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#contenidoTecnicasInstrumentos').empty().append($(data));
                                                    }
                                                    );
                                                }
                                        });  
                                        $('#editarTIModal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                        $('#btnActualizarTI').text('Guardar cambios'); 
                                        $('#girarActualizarTI').hide();    
                                    }
                                },
                                error:function(response)
                                {
                                        toastr.error('No se actualizaron correctamente los datos intente nuevammente','ERROR AL ACTUALIZAR',{timeOut:1000});
                                        $('#btnActualizarTI').text('Guardar cambios'); 
                                        $('#girarActualizarTI').hide();  
                                }
                            });
                    })
            </script>        
    <body>
