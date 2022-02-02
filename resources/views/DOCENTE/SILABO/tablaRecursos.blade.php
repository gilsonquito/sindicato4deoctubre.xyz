    <head>
        <link href="{{asset('css/tablaRecursos.css')}}" rel="stylesheet">
        <title>Recursos</title>
    </head>
    <body>
        <div id="contenidoRecursos"> 
            <p class="text-left font-weight-bold text-muted" href="#">RECURSOS</p>
            <hr color="" class="border border-muted w-100 ">
            <input type="hidden" id="txtSilaboR" name="txtSilaboR" value="{{session('idSilabo')}}">
            <div class="row col-md-12">
                    <div class="col-md-6">
                        <table id="tablaRecursos" class="table table-striped table-bordered table-responsive-lg w-100">
                            <thead  class="font-weight-bold text-dark p-0 ">
                                <td class="col-md-4">Recurso</td>
                                <td class="col-md-3">Acciones</td>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="mr-auto p-2">
                            <button onclick="agregarRecurso()" class="btn btn-outline-success" id="btnAgregarMetodoE" name="btnAgregarMetodoE"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>Agregar Recurso</button>
                        </div>
                        <div class=" p-2">
                            <button onclick="selecionarRecursoE()" class="btn btn-outline-success" id="btnSeleccionarRecursoE" name="btnSeleccionarRecursoE"><i class="fa fa-list-ul mr-2" aria-hidden="true"></i>Seleccionar Recurso</button>
                        </div>
                    </div>   
            </div>
                    <!--------------------------------------------------modal ingresar recursos ..........................-->
                <div class="modal fade " id="ingresarRecurso_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelR" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabelR"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Ingresar Recurso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="ingresarRecurso_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Recurso</label>
                                                    <input id="txtRecursoE" name="txtRecursoE" type="text" class="form-control" tabindex="1" required maxlength="100">
                                            </div>    
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnIngresarRecurso" name="btnIngresarRecurso"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Recurso </button>
                                    <div id="girarIngresarRecurso" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->
                      <!--------------------------------------------------modal seleccionar recurso ..........................-->
                    <div class="modal fade " id="seleccionarRecurso_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelR2" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabelR2"><i class="fa fa-list-ul mr-2" aria-hidden="true"></i>Seleccionar Recurso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="seleccionarRecurso_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Recurso</label>
                                                    <select class="form-control" id="selRecurso" name="selRecurso" tabindex="1" title="seleccionar recurso" required>
                                                                    <option value="Aula Virtual">Aula Virtual</option>
                                                                    <option value="Bibliografia especializada">Bibliografia especializada</option>
                                                                    <option value="Computador">Computador</option>
                                                                    <option value="Esfera Terrestre">Esfera Terrestre</option>
                                                                    <option value="Mapas Geográficos físicos y políticos">Mapas Geográficos físicos y políticos</option>
                                                                    <option value="Material Didáctico">Material Didáctico</option>   
                                                                    <option value="Constitución">Constitución</option>   
                                                                    <option value="Ley Orgánica de Tranporte Terrestre Transito y Educación Vial">Ley Orgánica de Tranporte Terrestre Transito y Educación Vial</option>  
                                                                    <option value="Código Orgánico Integral Penal">Código Orgánico Integral Penal</option> 
                                                                    <option value="Compilación de Contenidos Expuestos en el Aula Virtual">Compilación de Contenidos Expuestos en el Aula Virtual</option> 
                                                    </select>
                                            </div>      
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnseleccionarRecurso" name="btnseleccionarRecurso"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Recurso</button>
                                    <div id="girarIngresarRecursoSel" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->
                <!-----------------------------------modal eliminar recurso--------------------------------------->             
                <div class="modal fade" id="modalEliminarRecurso_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
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
                                    ¿Esta seguro de eliminar el Recurso seleccionado?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarRecurso" name="btnEliminarRecurso"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar Recurso     
                                </button>  
                            </div>
                            <div id="girarEliminarRecurso" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                <!-- Button trigger modal -->
                       <!--------------------------------------------------modal editar recurso ..........................-->
                    <div class="modal fade " id="editarRecursoModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelR3" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabelR3"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar Recurso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="editarRecurso_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <input type="hidden" id="txtIdRecurso" name="txtIdRecurso">
                                    <input type="hidden" id="txtIdSilRE" name="txtIdSilRE">
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Recurso</label>
                                                    <input id="txtRecursoE2" name="txtRecursoE2" type="text" class="form-control" tabindex="1" required maxlength="100">
                                            </div>                                 
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnActualizarRecurso" name="btnActualizarRecurso"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                    <div id="girarActualizarRecurso" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->                
        </div>       
        <script > //cargar tabla en el index
                    $(document).ready(function(){   
                            var recursos=$('#tablaRecursos').DataTable({
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
                                url:"/recurso",
                            },
                            columns:[
                                {data:'descripcion_recurso'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });

        </script>   
        <script>//CARGAER  EL FORMULARIO PARA ingresar metodo
            function agregarRecurso(){          
                    $('#ingresarRecurso_modal').modal('toggle');
                    $("input[name=_token]").val();
            }
            function selecionarRecursoE(){          
                    $('#seleccionarRecurso_modal').modal('toggle');
                    $("input[name=_token]").val();
            } 
        </script>  
        <script>//ingresar recurso
                $('#ingresarRecurso_form').submit(function(e){
                e.preventDefault();
                var descripcion_recurso=$('#txtRecursoE').val();
                var id_silR=$('#txtSilaboR').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('recurso.ingresarRecurso')}}",
                            type:"POST",
                            data:{ 
                                descripcion_recurso:descripcion_recurso,
                                id_sil:id_silR, 
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnIngresarRecurso').text('Ingresando Datos..'); 
                                $('#girarIngresarRecurso').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    var recursos=$('#tablaRecursos').DataTable();
                                    recursos.ajax.reload();
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    document.getElementById("ingresarRecurso_form").reset();
                                    $('#ingresarRecurso_modal').modal('hide');
                                    $('#btnIngresarRecurso').text('Agregar Recurso'); 
                                    $('#girarIngresarRecurso').hide(); 
                                }
                            },
                            error:function(response)
                            {
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnIngresarRecurso').text('Agregar Recurso'); 
                                $('#girarIngresarRecurso').hide(); 
                               
                            }
                        });
                })
            </script>
            <script>//seleccionar recurso
                $('#seleccionarRecurso_form').submit(function(e){
                e.preventDefault();
                var descripcion_recurso2=$('#selRecurso').val();
                var id_silR2=$('#txtSilaboR').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('recurso.ingresarRecurso')}}",
                            type:"POST",
                            data:{ 
                                descripcion_recurso:descripcion_recurso2,
                                id_sil:id_silR2, 
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnseleccionarRecurso').text('Ingresando Datos..'); 
                                $('#girarIngresarRecursoSel').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    var recursos=$('#tablaRecursos').DataTable();
                                    recursos.ajax.reload();
                                    document.getElementById("seleccionarRecurso_form").reset();
                                    $('#seleccionarRecurso_modal').modal('hide');
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    $('#btnseleccionarRecurso').text('Agregar Recurso'); 
                                    $('#girarIngresarRecursoSel').hide(); 
                                }
                            },
                            error:function(response)
                            {  
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnseleccionarRecurso').text('Agregar Recurso'); 
                                    $('#girarIngresarRecursoSel').hide(); 
                               
                            }
                        });
                })
            </script> 
            <script>//eliminar recurso
                    var _id;
                    $(document).on('click','.DeleteRecurso',function(){
                        _id=$(this).attr('id'); 
                       
                        $('#modalEliminarRecurso_modal').modal('show');
                    });
                    $('#btnEliminarRecurso').click(function(){
                        var idSilaboR=$('#txtSilaboR').val();
                        $.ajax({
                            url:"/recurso/eliminarRecurso/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarRecurso').text('Eliminando..'); 
                                $('#girarEliminarRecurso').show(); 
                            },
                            success:function(data){              
                                    var recursos=$('#tablaRecursos').DataTable();
                                    recursos.ajax.reload();
                                    $('#modalEliminarRecurso_modal').modal('hide');
                                    toastr.success('El recurso fue eliminado exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarRecurso').text('Eliminar Recurso'); 
                                    $('#girarEliminarRecurso').hide(); 
                            },
                            error : function(data){
                                toastr.warning('Ocurrio un error inesperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarRecurso').text('Eliminar Recurso'); 
                                $('#girarEliminarRecurso').hide(); 
                            }  
                        });
                    });
            </script>
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR recurso
                function editarRecursoE(id){
                    
                    $.get('/recurso/editarRecurso/'+id, function(recurso)
                    {  
                        //asignar datos recuperados
                        $('#txtIdRecurso').val(recurso[0].id_recurso);
                        $('#txtRecursoE2').val(recurso[0].descripcion_recurso);
                        $('#txtIdSilRE').val(recurso[0].id_sil);
                        $('#editarRecursoModal').modal('toggle');
                        $("input[name=_token]").val();
                    });
                }
            </script> 
             <script>//actualizar recurso
                $('#editarRecurso_form').submit(function(e){
                    e.preventDefault();
                    var id_recurso2=$('#txtIdRecurso').val();
                    var descripcion_recurso3=$('#txtRecursoE2').val();
                    var id_sil3=$('#txtIdSilRE').val();
                    var _token2=$("input[name=_token]").val();
                    
                            $.ajax({
                                url:"{{route('recurso.actualizarRecurso')}}",
                                type:"POST",
                                data:{
                                    id_recurso:id_recurso2,
                                    descripcion_recurso:descripcion_recurso3,
                                    id_sil:id_sil3,
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizarRecurso').text('Actualizando..'); 
                                    $('#girarActualizarRecurso').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        var recursos=$('#tablaRecursos').DataTable();
                                        recursos.ajax.reload();
                                        $('#editarRecursoModal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                        $('#btnActualizarRecurso').text('Guardar cambios'); 
                                        $('#girarActualizarRecurso').hide(); 
                                        
                                    }
                                },
                                error:function(response)
                                {
                                    toastr.error('No se actualizaron correctamente los datos, intente nuevammente','ERROR AL ACTUALIZAR',{timeOut:1000});
                                    $('#btnActualizarRecurso').text('Guardar cambios'); 
                                    $('#girarActualizarRecurso').hide(); 
                                }
                            });
                    })
            </script>   
    <body>
