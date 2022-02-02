
    <head>
        <link href="{{asset('css/tablaEscenarios.css')}}" rel="stylesheet">
        <title>Escenarios</title>
    </head>
    <body>
        <div id="contenidoEscenarios"> 
            <p class="text-left font-weight-bold text-muted" href="#">Listado de Escenarios</p>
            <hr color="" class="border border-muted w-100 ">
            <input type="hidden" id="txtIdSilaboEsc" name="txtIdSilaboEsc" value="{{session('idSilabo')}}">
            <div class="row col-md-12 ">
                    <div class="col-md-6">
                        <table id="tablaEscenarios" class="table table-striped table-bordered table-responsive-lg w-100">
                            <thead  class="font-weight-bold text-dark p-0 ">
                                <td class="col-md-4">Escenario</td>
                                <td class="col-md-3">Acciones</td>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="mr-auto p-2">
                            <button onclick="agregarEscenario()" class="btn btn-outline-success" id="btnAgregarEscenarioE" name="btnAgregarEscenarioE"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>Agregar Escenario</button>
                        </div>
                        <div class=" p-2">
                            <button onclick="selecionarEscenario()" class="btn btn-outline-success" id="btnSeleccionarEscenario" name="btnSeleccionarEscenario"><i class="fa fa-list-ul mr-2" aria-hidden="true"></i>Seleccionar Escenario</button>
                        </div>
                    </div> 
            </div>
                <!--------------------------------------------------modal ingresar escenario ..........................-->
                <div class="modal fade " id="ingresarEscenario_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelR" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabelR"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Ingresar Escenario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="ingresarEscenario_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Escenario</label>
                                                    <input id="txtEscenarioE" name="txtEscenarioE" type="text" class="form-control" tabindex="1" required maxlength="100">
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnIngresarEscenario" name="btnIngresarEscenario"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Escenario </button>
                                    <div id="girarIngresarEscenario" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->
                      <!--------------------------------------------------modal seleccionar escenario ..........................-->
                    <div class="modal fade " id="seleccionarEscenario_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelR2" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabelR2"><i class="fa fa-list-ul mr-2" aria-hidden="true"></i>Seleccionar Escenario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="seleccionarEscenario_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Seleccione Escenario</label>
                                                    <select class="form-control" id="selEscenario" name="selEscenario" tabindex="1" title="seleccionar recurso" required>
                                                                    <option value="Ambientes Virtuales">Ambientes Virtuales</option>
                                                                    <option value="Biblioteca Virtual">Biblioteca Virtual</option>
                                                                    <option value="Espacios Abiertos de la Escuela de Capacitación">Espacios Abiertos de la Escuela de Capacitación</option>
                                                                    <option value="Herramientas Zoom">Herramientas Zoom</option>
                                                                    <option value="Plataformas Virtuales de la Escuela Conducción">Plataformas Virtuales de la Escuela Conducción </option> 
                                                                    <option value="Parque Vial de Practicas">Parque Vial de Practicas</option> 
                                                                    <option value="Rutas Autorizadas para la Practica de Conducción">Rutas Autorizadas para la Practica de Conducción</option> 
                                                                    <option value="Taller Mecánico">Taller Mecánico</option> 
                                                                    <option value="Laboratorios de Computo">Laboratorios de Computo</option> 
                                                    </select>
                                            </div>     
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnseleccionarEscenario" name="btnseleccionarEscenario"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Escenario</button>
                                    <div id="girarIngresarEscenarioSel" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->
                <!-----------------------------------modal eliminar recurso--------------------------------------->             
                <div class="modal fade" id="modalEliminarEscenario_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
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
                                    ¿Esta seguro de eliminar el Escenario seleccionado?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarEscenario" name="btnEliminarEscenario"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar Escenario     
                                </button>  
                            </div>
                            <div id="girarEliminarEscenario" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                       <!--------------------------------------------------modal editar escenario ..........................-->
                    <!-- Modal -->
                    <div class="modal fade " id="editarEscenarioModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelR3" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header btn-light">
                                    <h5 class="modal-title text-secondary" id="staticBackdropLabelR3"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar Escenario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editarEscenario_form">
                                    <div class="modal-body">                      
                                        @csrf
                                        <input type="hidden" id="txtIdEscenario" name="txtIdEscenario">
                                        <input type="hidden" id="txtIdSilESCE" name="txtIdSilESCE">
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Escenario</label>
                                                        <input id="txtEscenarioEA" name="txtEscenarioEA" type="text" class="form-control" tabindex="1" required maxlength="100">
                                                </div> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                        <button type="submit" class="btn btn-success" id="btnActualizarEscenario" name="btnActualizarEscenario"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                        <div id="girarActualizarEscenario" class="lds-dual-ring col-md-12"></div> 
                                    </div>                         
                                </form>
                            </div>
                        </div>
                    </div><!--fin modal ingresar-->                   
            </div>        
        <script > //cargar tabla en el index
                    $(document).ready(function(){
                           
                            var recursos=$('#tablaEscenarios').DataTable({
                                columnDefs: [
                                { className: "align-middle" , targets: "_all" }
                            ], language: {
                            "decimal": "",
                            "emptyTable": "No hay información",
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ Entradas",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscar:",
                            "zeroRecords": "Sin resultados encontrados",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ultimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        },
                            lengthMenu: [[5,10, 25, -1], [5,10, 25, "All"]],
                            //processing:true,  
                            //serverSide:true,
                            ajax:{
                                url:"/escenario",
                            },
                            columns:[
                                {data:'descripcion_escenario'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });

        </script>   
        <script>//CARGAER  EL FORMULARIO PARA ingresar escenario
            function agregarEscenario(){          
                    $('#ingresarEscenario_modal').modal('toggle');
                    $("input[name=_token]").val();
            }
            function selecionarEscenario(){          
                    $('#seleccionarEscenario_modal').modal('toggle');
                    $("input[name=_token]").val();
            }
            
        </script>  
        
        <script>//ingresar escenario
                $('#ingresarEscenario_form').submit(function(e){
                e.preventDefault();
                var descripcion_escenario=$('#txtEscenarioE').val();
                var id_silE=$('#txtIdSilaboEsc').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('escenario.ingresarEscenario')}}",
                            type:"POST",
                            data:{ 
                                descripcion_escenario:descripcion_escenario,
                                id_sil:id_silE, 
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnIngresarEscenario').text('Ingresando Datos..'); 
                                $('#girarIngresarEscenario').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    var escenarios=$('#tablaEscenarios').DataTable();
                                    escenarios.ajax.reload();
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    document.getElementById("ingresarEscenario_form").reset();
                                    $('#ingresarEscenario_modal').modal('hide');
                                    $('#btnIngresarEscenario').text('Agregar Escenario'); 
                                    $('#girarIngresarEscenario').hide(); 
                                }
                            },
                            error:function(response)
                            {
                                
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnIngresarEscenario').text('Agregar Escenario'); 
                                $('#girarIngresarEscenario').hide(); 
                               
                            }
                        });
                })
            </script>
            <script>//seleccionar escenario
                $('#seleccionarEscenario_form').submit(function(e){
                e.preventDefault();
                var descripcion_escenario2=$('#selEscenario').val();
                var id_silR2=$('#txtSilaboR').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('escenario.ingresarEscenario')}}",
                            type:"POST",
                            data:{ 
                                descripcion_escenario:descripcion_escenario2,
                                id_sil:id_silR2, 
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnseleccionarEscenario').text('Ingresando Datos..'); 
                                $('#girarIngresarEscenarioSel').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    var escenarios=$('#tablaEscenarios').DataTable();
                                    escenarios.ajax.reload();
                                    document.getElementById("seleccionarEscenario_form").reset();
                                    $('#seleccionarEscenario_modal').modal('hide');
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    $('#btnseleccionarEscenario').text('Agregar Escenario'); 
                                    $('#girarIngresarEscenarioSel').hide(); 
                                }
                            },
                            error:function(response)
                            {
                                
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnseleccionarEscenario').text('Agregar Escenario'); 
                                $('#girarIngresarEscenarioSel').hide(); 
                               
                            }
                        });
                })
            </script>   
            <script>//eliminar escenario
                    var _id;
                    $(document).on('click','.DeleteEscenario',function(){
                        _id=$(this).attr('id'); 
                       
                        $('#modalEliminarEscenario_modal').modal('show');
                    });
                    $('#btnEliminarEscenario').click(function(){
                        
                        $.ajax({
                            url:"/escenario/eliminarEscenario/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarEscenario').text('Eliminando..'); 
                                $('#girarEliminarEscenario').show(); 
                            },
                            success:function(data){              
                                    var escenarios=$('#tablaEscenarios').DataTable();
                                    escenarios.ajax.reload();
                                    $('#modalEliminarEscenario_modal').modal('hide');
                                    toastr.success('El Escenario fue eliminado exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarEscenario').text('Eliminar Escenario'); 
                                    $('#girarEliminarEscenario').hide(); 
                            },
                            error : function(data){
                                toastr.warning('Ocurrio un error inesperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarEscenario').text('Eliminar Escenario'); 
                                $('#girarEliminarEscenario').hide(); 
                            }  
                        });
                    });
            </script>
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR escenario
                function editarEscenarioE(id){
                    
                    $.get('/escenario/editarEscenario/'+id, function(escenario)
                    {  
                        //asignar datos recuperados
                        $('#txtIdEscenario').val(escenario[0].id_escenario);
                        $('#txtEscenarioEA').val(escenario[0].descripcion_escenario);
                        $('#txtIdSilESCE').val(escenario[0].id_sil);
                        $('#editarEscenarioModal').modal('toggle');
                        $("input[name=_token]").val();
                    });
                }
            </script> 
             <script>//actualizar escenario
                $('#editarEscenario_form').submit(function(e){
                    e.preventDefault();
                    var id_escenario3=$('#txtIdEscenario').val();
                    var descripcion_escenario3=$('#txtEscenarioEA').val();
                    var id_sil3=$('#txtIdSilESCE').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('escenario.actualizarEscenario')}}",
                                type:"POST",
                                data:{
                                    id_escenario:id_escenario3,
                                    descripcion_escenario:descripcion_escenario3,
                                    id_sil:id_sil3,
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizarEscenario').text('Actualizando..'); 
                                    $('#girarActualizarEscenario').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        var escenarios=$('#tablaEscenarios').DataTable();
                                        escenarios.ajax.reload();
                                        $('#editarEscenarioModal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                        $('#btnActualizarEscenario').text('Guardar cambios'); 
                                        $('#girarActualizarEscenario').hide(); 
                                        
                                    }
                                },
                                error:function(response)
                                {
                                    toastr.error('No se actualizaron correctamente los datos, intente nuevammente','ERROR AL ACTUALIZAR',{timeOut:1000});
                                    $('#btnActualizarEscenario').text('Guardar cambios'); 
                                    $('#girarActualizarEscenario').hide(); 
                                }
                            });
                    })
            </script>       
    <body>
