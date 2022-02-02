<head>   
    <link href="{{asset('css/tablaWebgrafia.css')}}" rel="stylesheet">
    <title>Webgrafías</title>
</head>
    <body>
        <div id="contenidoBibliCom"> 
            <input type="hidden" id="txtIdSilaboWebgrafia" name="txtIdSilaboWebgrafia" value="{{session('idSilabo')}}">
            <div class="w-100">
                    <form id="ingresarWebgrafia_form">                     
                        @csrf
                            <div class="row justify-content-center">
                                <div class="form-group col-md-10 px-2  justify-content-center text-left">
                                        <textarea id="txtWebgrafiaE" name="txtWebgrafiaE" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="500" required ></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success" id="btnIngresarWebgrafia" name="btnIngresarWebgrafia"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Webgrafía</button>
                            </div>                      
                    </form>
            </div>
            <div class="row col-md-12 ">
                    <div class="col-md-12">
                        <table id="tablaWebgrafias" class="table table-striped table-bordered table-responsive-lg w-100">
                            <thead  class="font-weight-bold text-dark p-0 ">
                                <td class="col-md-9">Webgrafía</td>
                                <td class="col-md-3">Acciones</td>
                            </thead>
                        </table>
                    </div>     
            </div>
            <!-----------------------------------modal eliminar webgrafia--------------------------------------->             
                <div class="modal fade" id="modalEliminarWebgrafia_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
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
                                    ¿Esta seguro de eliminar la Webgrafía seleccionada?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarWebgrafia" name="btnEliminarWebgrafia"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar Webgrafía     
                                </button>  
                            </div>
                            <div id="girarEliminarWebgrafia" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                <!--------------------------------------------------modal editar Webgrafía..........................-->
                    <!-- Modal -->
                    <div class="modal fade " id="editarWebgrafiaModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelR3" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header btn-light">
                                    <h5 class="modal-title text-secondary" id="staticBackdropLabelR3"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar Webgrafía</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editarWebgrafia_form">
                                    <div class="modal-body">                      
                                        @csrf
                                        <input type="hidden" id="txtIdWebgrafia" name="txtIdWebgrafia">
                                        <input type="hidden" id="txtIdSilaboWeb" name="txtIdSilaboWeb">
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-10 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Bibliografía Complementaria</label>
                                                        <textarea id="txtWebgrafiaEA" name="txtWebgrafiaEA" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="500" required ></textarea>
                                                </div> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                        <button type="submit" class="btn btn-success" id="btnActualizarWebgrafia" name="btnActualizarWebgrafia"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                        <div id="girarActualizarWebgrafia" class="lds-dual-ring col-md-12"></div> 
                                    </div>                         
                                </form>
                            </div>
                        </div>
                    </div><!--fin modal ingresar-->                   
            </div> 
        <script > //cargar tabla en el index
                    $(document).ready(function(){
                            var recursos=$('#tablaWebgrafias').DataTable({
                                lengthMenu: [[5,10, 25, -1], [5,10, 25, "All"]],
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
                                url:"/webgrafia",
                            },
                            columns:[
                                {data:'descripcion_webgrafia'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });
        </script>  
        <script>//ingresar bibliografai complementaria
                $('#ingresarWebgrafia_form').submit(function(e){
                e.preventDefault();
                var descripcion_webgrafiac=$('#txtWebgrafiaE').val();
                var id_silC=$('#txtIdSilaboWebgrafia').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('webgrafia.ingresarWebgrafia')}}",
                            type:"POST",
                            data:{ 
                                descripcion_webgrafia:descripcion_webgrafiac,
                                id_sil:id_silC, 
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnIngresarWebgrafia').text('Ingresando Datos..'); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    var webgrafiaT=$('#tablaWebgrafias').DataTable();
                                    webgrafiaT.ajax.reload();
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    document.getElementById("ingresarWebgrafia_form").reset();
                                    $('#btnIngresarWebgrafia').text('Agregar Webgrafía'); 
                                }
                            },
                            error:function(response)
                            { 
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnIngresarWebgrafia').text('Agregar Webgrafía');                             
                            }
                        });
                })
            </script> 
            <script>//eliminar wengrafia
                    var _id;
                    $(document).on('click','.DeleteWebgrafia',function(){
                        _id=$(this).attr('id'); 
                       
                        $('#modalEliminarWebgrafia_modal').modal('show');
                    });
                    $('#btnEliminarWebgrafia').click(function(){
                        
                        $.ajax({
                            url:"/webgrafia/eliminarWebgrafia/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarWebgrafia').text('Eliminando..'); 
                                $('#girarEliminarWebgrafia').show(); 
                            },
                            success:function(data){              
                                    var webgrafiaT=$('#tablaWebgrafias').DataTable();
                                    webgrafiaT.ajax.reload();
                                    $('#modalEliminarWebgrafia_modal').modal('hide');
                                    toastr.success('La webgrafía fue eliminada exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarWebgrafia').text('Eliminar Webgrafía '); 
                                    $('#girarEliminarWebgrafia').hide(); 
                            },
                            error : function(data){
                                toastr.warning('Ocurrio un error inesperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarWebgrafia').text('Eliminar Webgrafía '); 
                                $('#girarEliminarWebgrafia').hide();  
                            }  
                        });
                    });
            </script>
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR Webgrafía 
                function editarWebgrafia(id){
                    $.get('/webgrafia/editarWebgrafia/'+id, function(webgrafia)
                    {  
                        //asignar datos recuperados
                        $('#txtIdWebgrafia').val(webgrafia[0].id_webgrafia);
                        $('#txtWebgrafiaEA').val(webgrafia[0].descripcion_webgrafia);
                        $('#txtIdSilaboWeb').val(webgrafia[0].id_sil);
                        $('#editarWebgrafiaModal').modal('toggle');
                        $("input[name=_token]").val();
                    });
                }
            </script> 
             <script>//actualizar webgrafia
                $('#editarWebgrafia_form').submit(function(e){
                    e.preventDefault();
                    var id_webgrafia3=$('#txtIdWebgrafia').val();
                    var descripcion_webgrafia3=$('#txtWebgrafiaEA').val();
                    var id_sil3=$('#txtIdSilaboWeb').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('webgrafia.actualizarWebgrafia')}}",
                                type:"POST",
                                data:{
                                    id_webgrafia:id_webgrafia3,
                                    descripcion_webgrafia:descripcion_webgrafia3,
                                    id_sil:id_sil3,
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizarWebgrafia').text('Actualizando..'); 
                                    $('#girarActualizarWebgrafia').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        var webgrafiaT=$('#tablaWebgrafias').DataTable();
                                        webgrafiaT.ajax.reload();
                                        $('#editarWebgrafiaModal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                        $('#btnActualizarWebgrafia').text('Guardar cambios'); 
                                        $('#girarActualizarWebgrafia').hide(); 
                                        
                                    }
                                },
                                error:function(response)
                                {
                                    toastr.error('No se actualizaron correctamente los datos, intente nuevammente','ERROR AL ACTUALIZAR',{timeOut:1000});
                                    $('#btnActualizarWebgrafia').text('Guardar cambios'); 
                                    $('#girarActualizarWebgrafia').hide(); 
                                }
                            });
                    })
            </script>       
    <body>