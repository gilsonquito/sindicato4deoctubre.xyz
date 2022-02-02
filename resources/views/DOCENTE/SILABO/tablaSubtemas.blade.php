    <head>
        <link href="{{asset('css/tablaSubtema.css')}}" rel="stylesheet">
        <title>Subtemas</title>
    </head>
    <body>
        <div id="contenidoSubTemas">
            @foreach ($temasS as $tema)
                    <input type="hidden" id="txtTemaS" name="txtTemaS" value="{{$tema->id_tema}}">
                    <input type="hidden" id="txtUnidadS" name="txtUnidadS" value="{{$tema->id_unidad}}">
                    <input type="hidden" id="txtSilaboS" name="txtSilaboS" value="{{$tema->id_sil}}">
                    <h5 class="text-left font-weight-normal text-muted text-uppercase"><strong>Unidad: </strong>{{$tema->orden_unidad}}. {{$tema->titulo_unidad}}</h5>
                    <p class="text-left font-weight-normal text-muted"><strong>Tema: </strong>{{$tema->orden_tema}}. {{$tema->titulo_tema}}</p>
            @endforeach 
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <button onclick="agregarSubtema()" class="btn btn-outline-success" id="btnAgregarSubTema" name="btnAgregarSubTema"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>Agregar Subtema</button>
                    </div>
                    <div class="p-2">
                        <button onclick="volverUnidadesS()" class="btn btn-outline-dark" id="btnVolverUnidadesS" name="btnVolverUnidadesS"><i class="fa fa-caret-left mr-2" aria-hidden="true"></i>Mostrar Unidades</button>
                    </div>
                    <div class="p-2">
                        <button onclick="volverTemas()" class="btn btn-outline-dark" id="btnVolverTemas" name="btnVolverTemas"><i class="fa fa-caret-left mr-2" aria-hidden="true"></i>Mostrar Temas</button>
                    </div>
                </div>
                <p class="text-left font-weight-bold text-muted" href="#">Listado de Subtemas</p>
                <hr color="" class="border border-muted w-100 p-0">
                <table id="tablaSubtemas" class="table table-striped table-bordered table-responsive-lg w-100">
                        <thead class="font-weight-bold text-center text-muted" >
                            <tr>
                                <td class="col-md-3 align-middle" rowspan="3">Acciones</td>
                                <td class="col-md-3 align-middle" rowspan="3">Orden de SubTema</td>
                                <td class="col-md-6 align-middle" rowspan="3">Titulo del Subtema</td>
                            </tr>   
                        </thead>
                        <tbody class="text-center text-dark">         
                            @foreach ($subtemas as $subtema)
                              <tr>    
                                  <td class="py-1">
                                      <div class="row justify-content-center">
                                          <div class="p-1 justify-content-center">
                                              <a  onclick="editarSubTema({{$subtema->id_subtema}})" class="btn btn btn-outline-warning btn-sm " title="Editar subtema">
                                                   <i class="fa fa-pencil px-2" aria-hidden="true"></i>
                                                </a> 
                                          </div>
                                          <div class="p-1 justify-content-center">
                                               <button type="button" name="DeleteSubTema"  class="DeleteSubTema btn btn-outline-danger btn-sm" id="{{$subtema->id_subtema}}" title="Eliminar subtema">
                                                  <i class="fa fa-trash-o px-2" aria-hidden="true"></i>
                                              </button>
                                          </div>
                                      </div>  
                                  </td>  
                                  <td class="py-1">{{$subtema->orden_subtema}}</td>
                                  <td class="py-1">{{$subtema->titulo_subtema}}</td>
                              </tr>
                          @endforeach   
                      </tbody>                                 
                </table>    
                    <!--------------------------------------------------modal ingresar subtema ..........................-->
                <div class="modal fade " id="ingresarSubTemaModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel18" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel18"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Ingresar Subtema</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="ingresarSubTema_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Orden de subtema</label>
                                                <input id="txtOrdenSubTema" name="txtOrdenSubTema" type="text" class="form-control" tabindex="1" required maxlength="3">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Título del subtema</label>
                                                <input id="txtTituloSubTema" name="txtTituloSubTema" type="text" class="form-control" tabindex="2" required maxlength="100">
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnIngresarSubTema" name="btnIngresarSubTema"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Subtema</button>
                                    <div id="girarIngresarSubTema" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->
                <!-----------------------------------modal eliminar unidad--------------------------------------->             
                <div class="modal fade" id="modalEliminarSubTema_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
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
                                    ¿Esta seguro de eliminar el subtema seleccionado?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarSubTema" name="btnEliminarSubTema"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar Subtema     
                                </button>  
                            </div>
                            <div id="girarEliminarSubTema" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                       <!--------------------------------------------------modal editar tema ..........................-->
                    <div class="modal fade " id="editarSubTemaModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel19" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel19"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar Subtema</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="editarSubTema_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <input type="hidden" id="txtIdSubTema" name="txtIdSubTema">
                                    <input type="hidden" id="txtIdTemaS" name="txtIdTemaS">
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Orden de subtema</label>
                                                <input id="txtOrdenSubTema2" name="txtOrdenSubTema2" type="text" class="form-control" tabindex="1" required maxlength="3">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Título del subtema</label>
                                                <input id="txtTituloSubTema2" name="txtTituloSubTema2" type="text" class="form-control" tabindex="2" required maxlength="100">
                                            </div>
                                    </div> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnActualizarSubTema" name="btnActualizarSubTema"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                    <div id="girarActualizarSubTema" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->                   
        </div>        
        <script>//CARGAER  EL FORMULARIO PARA ingresar tema
            function agregarSubtema(){          
                    $('#ingresarSubTemaModal').modal('toggle');
                    $("input[name=_token]").val();
            }
        </script>  
        <script>//ingresar subtema
                $('#ingresarSubTema_form').submit(function(e){
                e.preventDefault();
                var orden_subtema=$('#txtOrdenSubTema').val();
                var titulo_subtema=$('#txtTituloSubTema').val();
                var id_tema=$('#txtTemaS').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('subtemas.ingresarSubTema')}}",
                            type:"POST",
                            data:{ 
                                orden_subtema:orden_subtema,
                                titulo_subtema:titulo_subtema, 
                                id_tema:id_tema,
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnIngresarSubTema').text('Ingresando Datos..'); 
                                $('#girarIngresarSubTema').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    $.ajax({
                                            url:'/subtemas/mostrarSubTemas/'+id_tema,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#contenidoSubTemas').empty().append($(data));
                                                    }
                                                    );
                                                }
                                    });
                                    $('#ingresarSubTemaModal').modal('hide');
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    $('#btnIngresarSubTema').text('Agregar Subtema'); 
                                    $('#girarIngresarSubTema').hide(); 
                                }
                            },
                            error:function(response)
                            {
                                $('#ingresarSubTemaModal').modal('hide');
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnIngresarSubTema').text('Agregar Subtema'); 
                            }
                        });
                })
            </script>
           <script>
                    $("#txtOrdenSubTema").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#txtOrdenSubTema2").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
            </script>
            <script>//eliminar subtema
                    var _id;
                    $(document).on('click','.DeleteSubTema',function(){
                        _id=$(this).attr('id'); 
                       
                        $('#modalEliminarSubTema_modal').modal('show');
                    });
                    $('#btnEliminarSubTema').click(function(){
                        var tema=$('#txtTemaS').val();
                        $.ajax({ 
                            url:"/subtemas/eliminarSubtema/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarSubTema').text('Eliminando..'); 
                                $('#girarEliminarSubTema').show(); 
                            },
                            success:function(data){              
                                    $.ajax({  
                                            url:'/subtemas/mostrarSubTemas/'+tema,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#contenidoSubTemas').empty().append($(data));
                                                    }
                                                    );
                                                }
                                    }); 
                                    $('#modalEliminarSubTema_modal').modal('hide');
                                    toastr.success('El Subtema fue eliminado exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarSubTema').text('Eliminar Subtema'); 
                                    $('#girarEliminarSubTema').hide(); 
                            },
                            error : function(data){
                                toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarSubTema').text('Eliminar Subtema'); 
                                $('#girarEliminarSubTema').hide(); 
                            }  
                        });
                    });
            </script> 
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR subtema
                function editarSubTema(id){    
                    $.get('/subtemas/editarSubtema/'+id, function(SubTema)
                    {  
                        //asignar datos recuperados
                        $('#txtIdSubTema').val(SubTema[0].id_subtema);
                        $('#txtOrdenSubTema2').val(SubTema[0].orden_subtema);
                        $('#txtTituloSubTema2').val(SubTema[0].titulo_subtema);
                        $('#txtIdTemaS').val(SubTema[0].id_tema);
                        $('#editarSubTemaModal').modal('toggle');
                        $("input[name=_token]").val();
                    });
                }
            </script> 
             <script>//actualizar subtema
                $('#editarSubTema_form').submit(function(e){
                    e.preventDefault();
                    var id_subtema2=$('#txtIdSubTema').val();
                    var orden_subtema2=$('#txtOrdenSubTema2').val();
                    var titulo_subtema2=$('#txtTituloSubTema2').val();
                    var id_tema2=$('#txtIdTemaS').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('subtemas.actualizarSubTema')}}",
                                type:"POST",
                                data:{
                                    id_subtema:id_subtema2,
                                    orden_subtema:orden_subtema2,
                                    titulo_subtema:titulo_subtema2,
                                    id_tema:id_tema2,
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizarSubTema').text('Actualizando..'); 
                                    $('#girarActualizarSubTema').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        $.ajax({         
                                            url:'/subtemas/mostrarSubTemas/'+id_tema2,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#contenidoSubTemas').empty().append($(data));
                                                    }
                                                    );
                                                }
                                        });   
                                        $('#editarSubTemaModal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                        $('#btnActualizarSubTema').text('Guardar cambios'); 
                                        $('#girarActualizarSubTema').hide();    
                                    }
                                },
                                error:function(response)
                                {  
                                    toastr.error('No se actualizaron correctamente los datos intente nuevammente','ERROR AL ACTUALIZAR',{timeOut:1000});
                                        $('#btnActualizarSubTema').text('Guardar cambios'); 
                                        $('#girarActualizarSubTema').hide(); 
                                }
                            });
                    })
            </script>     
            <script>//CARGAER volver a unidades
                function volverUnidadesS(){
                    var id_SilaboU=$('#txtSilaboS').val();
                    $.ajax({
                        url:'/unidad/mostrarUnidades/'+id_SilaboU,
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenidoSubTemas').empty().append($(data));
                                }
                                );
                            }
                    });
                }
                function volverTemas(){
                    var id_UnidadS=$('#txtUnidadS').val();
                    $.ajax({                 
                        url:'/temas/mostrarTemas/'+id_UnidadS,
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenidoSubTemas').empty().append($(data));
                                }
                                );
                            }
                    });
                }
            </script> 
    <body>
