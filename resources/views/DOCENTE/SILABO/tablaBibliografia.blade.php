
    <link href="{{asset('css/tablaBibliografia.css')}}" rel="stylesheet">
    <body>
        <div id="contenidoBibliografias"> 
            <p class="text-left font-weight-bold text-muted" href="#">Listado de bibliografías</p>
            <hr color="" class="border border-muted w-100 ">
            <input type="hidden" id="txtIdSilaboBib" name="txtIdSilaboBib" value="{{session('idSilabo')}}">
            <div class="mr-auto p-2">
                <button onclick="agregarBibliografia()" class="btn btn-outline-success" id="btnAgregarBibliografia" name="btnAgregarBibliografia"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>Agregar Bibliografia</button>
            </div>
            <div class="row col-md-12 ">
                    <div class="col-md-12">
                        <table id="tablaBibliografias" class="table table-striped table-bordered table-responsive-lg w-100">
                            <thead  class="font-weight-bold text-dark p-0 ">
                                <td class="col-md-4">Tipo de Bibliografía</td>
                                <td class="col-md-4">Título</td>
                                <td class="col-md-4">Autor</td>
                                <td class="col-md-4">Tipo de documento</td>
                                <td class="col-md-4">Editorial</td>
                                <td class="col-md-4">Fecha de Publicaión</td>
                                <td class="col-md-4">Número Página</td>
                                <td class="col-md-3">Acciones</td>
                            </thead>
                        </table>
                    </div>
            </div>
            <!--------------------------------------------------modal ingresar bibliografia ..........................-->
                <div class="modal fade " id="ingresarBibliografia_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelBb" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabelBb"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Ingresar Bibliografía</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="ingresarBibliografia_form">
                                <div class="modal-body">                      
                                    @csrf
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Tipo de Bibliografía</label>
                                                        <input id="txtTipoBibliografia" name="txtTipoBibliografia" type="text" class="form-control" tabindex="1" required maxlength="50">
                                                </div>
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Título</label>
                                                        <input id="txtTituloBibliografia" name="txtTituloBibliografia" type="text" class="form-control" tabindex="2" required maxlength="100">
                                                </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Autor</label>
                                                        <input id="txtAutorBibliografia" name="txtAutorBibliografia" type="text" class="form-control" tabindex="3" required maxlength="200">
                                                </div>
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Tipo de documento</label>
                                                        <input id="txtTipoDocumentoBibliografia" name="txtTipoDocumentoBibliografia" type="text" class="form-control" tabindex="4" required maxlength="80">
                                                </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Editorial</label>
                                                        <input id="txtEditorialBibliografia" name="txtEditorialBibliografia" type="text" class="form-control" tabindex="5" required maxlength="100">
                                                </div>
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Fecha de publicación</label>
                                                        <input id="txtFechaBibliografia" name="txtFechaBibliografia" type="text" class="form-control" tabindex="6" required maxlength="10">
                                                </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Número de página</label>
                                                        <input id="txtNumPagBibliografia" name="txtNumPagBibliografia" type="text" class="form-control" tabindex="7" required maxlength="50">
                                                </div>
                                        </div>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnIngresarBibliografia" name="btnIngresarBibliografia"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Bibliografía</button>
                                    <div id="girarIngresarBibliografia" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->
                <!-----------------------------------modal eliminar bibliografia--------------------------------------->             
                <div class="modal fade" id="modalEliminarBibliografia_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
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
                                    ¿Esta seguro de eliminar la Bibliografía seleccionada?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarBibliografia" name="btnEliminarBibliografia"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar Bibliografía     
                                </button>  
                            </div>
                            <div id="girarEliminarBibliografia" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                <!--------------------------------------------------modal editar bibliografia ..........................-->
                    <!-- Modal -->
                    <div class="modal fade " id="editarBibliografiaModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelB3" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header btn-light">
                                <h5 class="modal-title text-secondary" id="staticBackdropLabelB3"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar Bibliografía</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="editarBibliografia_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <input type="hidden" id="txtIdBibliografia" name="txtIdBibliografia">
                                    <input type="hidden" id="txtIdSilBibliografia" name="txtIdSilBibliografia">
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Tipo de Bibliografía</label>
                                                        <input id="txtTipoBibliografia2" name="txtTipoBibliografia2" type="text" class="form-control" tabindex="1" required maxlength="50">
                                                </div>
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Título</label>
                                                        <input id="txtTituloBibliografia2" name="txtTituloBibliografia2" type="text" class="form-control" tabindex="2" required maxlength="100">
                                                </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Autor</label>
                                                        <input id="txtAutorBibliografia2" name="txtAutorBibliografia2" type="text" class="form-control" tabindex="3" required maxlength="200">
                                                </div>
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Tipo de documento</label>
                                                        <input id="txtTipoDocumentoBibliografia2" name="txtTipoDocumentoBibliografia2" type="text" class="form-control" tabindex="4" required maxlength="80">
                                                </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Editorial</label>
                                                        <input id="txtEditorialBibliografia2" name="txtEditorialBibliografia2" type="text" class="form-control" tabindex="5" required maxlength="100">
                                                </div>
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Fecha de publicaión</label>
                                                        <input id="txtFechaBibliografia2" name="txtFechaBibliografia2" type="text" class="form-control" tabindex="6" required maxlength="10">
                                                </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Número de página</label>
                                                        <input id="txtNumPagBibliografia2" name="txtNumPagBibliografia2" type="text" class="form-control" tabindex="7" required maxlength="50">
                                                </div>
                                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnActualizarBibliografia" name="btnActualizarBibliografia"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                    <div id="girarActualizarBibliografia" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->                   
        </div>        
        <script > //cargar tabla en el index
                    $(document).ready(function(){
                            var recursos=$('#tablaBibliografias').DataTable({
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
                                url:"/bibliografia",
                            },
                            columns:[
                                {data:'tipo_bibliografia'},
                                {data:'titulo_bibliografia'},
                                {data:'autor_bibliografia'},
                                {data:'tipo_documento_bibliografia'},
                                {data:'editorial_bibliografia'},
                                {data:'fecha_publicacion_bibliografia'},
                                {data:'numero_pagina_bibliografia'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });
        </script>   
        <script>//CARGAER  EL FORMULARIO PARA ingresar bibliografia
            function agregarBibliografia(){          
                    $('#ingresarBibliografia_modal').modal('toggle');
                    $("input[name=_token]").val();
            }  
        </script>  
        <script>//ingresar escenario
                $('#ingresarBibliografia_form').submit(function(e){
                e.preventDefault();
                var tipo_bibliografia=$('#txtTipoBibliografia').val();
                var titulo_bibliografia=$('#txtTituloBibliografia').val();
                var autor_bibliografia=$('#txtAutorBibliografia').val();
                var tipo_documento_bibliografia=$('#txtTipoDocumentoBibliografia').val();
                var editorial_bibliografia=$('#txtEditorialBibliografia').val();
                var fecha_publicacion_bibliografia=$('#txtFechaBibliografia').val();
                var numero_pagina_bibliografia=$('#txtNumPagBibliografia').val();
                var id_silBi=$('#txtIdSilaboBib').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('bibliografia.ingresarBibliografia')}}",
                            type:"POST",
                            data:{ 
                                tipo_bibliografia:tipo_bibliografia,
                                titulo_bibliografia:titulo_bibliografia,
                                autor_bibliografia:autor_bibliografia,
                                tipo_documento_bibliografia:tipo_documento_bibliografia,
                                editorial_bibliografia:editorial_bibliografia,
                                fecha_publicacion_bibliografia:fecha_publicacion_bibliografia,
                                numero_pagina_bibliografia:numero_pagina_bibliografia,
                                id_sil:id_silBi, 
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnIngresarBibliografia').text('Ingresando Datos..'); 
                                $('#girarIngresarBibliografia').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    var bibliografia=$('#tablaBibliografias').DataTable();
                                    bibliografia.ajax.reload();
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    document.getElementById("ingresarBibliografia_form").reset();
                                    $('#ingresarBibliografia_modal').modal('hide');
                                    $('#btnIngresarBibliografia').text('Agregar Bibliografía'); 
                                    $('#girarIngresarBibliografia').hide(); 
                                }
                            },
                            error:function(response)
                            {
                                
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnIngresarBibliografia').text('Agregar Bibliografía'); 
                                $('#girarIngresarBibliografia').hide();    
                            }
                        });
                })
            </script>
            <script>//eliminar bibliografia
                    var _id;
                    $(document).on('click','.DeleteBibliografia',function(){
                        _id=$(this).attr('id'); 
                        $('#modalEliminarBibliografia_modal').modal('show');
                    });
                    $('#btnEliminarBibliografia').click(function(){
                        $.ajax({
                            url:"/bibliografia/eliminarBibliografia/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarBibliografia').text('Eliminando..'); 
                                $('#girarEliminarBibliografia').show(); 
                            },
                            success:function(data){              
                                    var bibliografia=$('#tablaBibliografias').DataTable();
                                    bibliografia.ajax.reload();
                                    $('#modalEliminarBibliografia_modal').modal('hide');
                                    toastr.success('El Bibliografia fue eliminado exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarBibliografia').text('Eliminar Bibliografía'); 
                                    $('#girarEliminarBibliografia').hide(); 
                            },
                            error : function(data){
                                toastr.warning('Ocurrio un error inesperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarBibliografia').text('Eliminar Bibliografía'); 
                                $('#girarEliminarBibliografia').hide(); 
                            }  
                        });
                    });
            </script>
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR bibliografia
                function editarBibliografia(id){
                    $.get('/bibliografia/editarBibliografia/'+id, function(bibliografia)
                    {  
                        //asignar datos recuperados
                        $('#txtIdBibliografia').val(bibliografia[0].id_bibliografia);
                        $('#txtTipoBibliografia2').val(bibliografia[0].tipo_bibliografia);
                        $('#txtTituloBibliografia2').val(bibliografia[0].titulo_bibliografia);
                        $('#txtAutorBibliografia2').val(bibliografia[0].autor_bibliografia);
                        $('#txtTipoDocumentoBibliografia2').val(bibliografia[0].tipo_documento_bibliografia );
                        $('#txtEditorialBibliografia2').val(bibliografia[0].editorial_bibliografia);
                        $('#txtFechaBibliografia2').val(bibliografia[0].fecha_publicacion_bibliografia);
                        $('#txtNumPagBibliografia2').val(bibliografia[0].numero_pagina_bibliografia);
                        $('#txtIdSilBibliografia').val(bibliografia[0].id_sil);
                        $('#editarBibliografiaModal').modal('toggle');
                        $("input[name=_token]").val();
                    });
                }
            </script> 
             <script>//actualizar bibliografia
                $('#editarBibliografia_form').submit(function(e){
                    e.preventDefault();
                    var id_bibliografia3=$('#txtIdBibliografia').val();
                    var tipo_bibliografia3=$('#txtTipoBibliografia2').val();
                    var titulo_bibliografia3=$('#txtTituloBibliografia2').val();
                    var autor_bibliografia3=$('#txtAutorBibliografia2').val();
                    var tipo_documento_bibliografia3=$('#txtTipoDocumentoBibliografia2').val();
                    var editorial_bibliografia3=$('#txtEditorialBibliografia2').val();
                    var fecha_publicacion_bibliografia3=$('#txtFechaBibliografia2').val();
                    var numero_pagina_bibliografia3=$('#txtNumPagBibliografia2').val();
                    var id_sil3=$('#txtIdSilBibliografia').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('bibliografia.actualizarBibliografia')}}",
                                type:"POST",
                                data:{
                                    id_bibliografia:id_bibliografia3,
                                    tipo_bibliografia:tipo_bibliografia3,
                                    titulo_bibliografia:titulo_bibliografia3,
                                    autor_bibliografia:autor_bibliografia3,
                                    tipo_documento_bibliografia:tipo_documento_bibliografia3,
                                    editorial_bibliografia:editorial_bibliografia3,
                                    fecha_publicacion_bibliografia:fecha_publicacion_bibliografia3,
                                    numero_pagina_bibliografia:numero_pagina_bibliografia3,
                                    id_sil:id_sil3,
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizarBibliografia').text('Actualizando..'); 
                                    $('#girarActualizarBibliografia').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        var bibliogtafia=$('#tablaBibliografias').DataTable();
                                        bibliogtafia.ajax.reload();
                                        $('#editarBibliografiaModal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                        $('#btnActualizarBibliografia').text('Guardar cambios'); 
                                        $('#girarActualizarBibliografia').hide(); 
                                        
                                    }
                                },
                                error:function(response)
                                {
                                    toastr.error('No se actualizaron correctamente los datos, intente nuevammente','ERROR AL ACTUALIZAR',{timeOut:1000});
                                    $('#btnActualizarBibliografia').text('Guardar cambios'); 
                                    $('#girarActualizarBibliografia').hide(); 
                                }
                            });
                    })
            </script>       
            <script>
                    $("#txtFechaBibliografia").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9-]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#txtFechaBibliografia2").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9-]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
            </script>
    <body>