<head>   
    <link href="{{asset('css/tablaBdigital.css')}}" rel="stylesheet">
    <title>Webgrafías</title>
</head>
    <body>
        <div id="contenidoBibliCom"> 
         
            <input type="hidden" id="txtIdSilaboBdigital" name="txtIdSilaboBdigital" value="{{session('idSilabo')}}">
            <div class="w-100">
                    <form id="ingresarBdigital_form">                     
                        @csrf
                            <div class="row justify-content-center">
                                <div class="form-group col-md-10 px-2  justify-content-center text-left">
                                        <textarea id="txtBdigitalE" name="txtBdigitalE" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="500" required ></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success" id="btnIngresarBdigital" name="btnIngresarBdigital"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Bibliografía</button>
                            </div>                      
                    </form>
            </div>
            <div class="row col-md-12 ">
                    <div class="col-md-12">
                        <table id="tablaBdigitals" class="table table-striped table-bordered table-responsive-lg w-100">
                            <thead  class="font-weight-bold text-dark p-0 ">
                                <td class="col-md-9">Bibliografía Digital</td>
                                <td class="col-md-3">Acciones</td>
                            </thead>
                        </table>
                    </div>     
            </div>
            <!-----------------------------------modal eliminar bibliografia digital--------------------------------------->             
                <div class="modal fade" id="modalEliminarBdigital_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
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
                                    ¿Esta seguro de eliminar la bibliografía digital seleccionada?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarBdigital" name="btnEliminarBdigital"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar Bibliografía  
                                </button>  
                            </div>
                            <div id="girarEliminarBdigital" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                <!--------------------------------------------------modal editar bibliografia digital..........................-->
                    <!-- Modal -->
                    <div class="modal fade " id="editarBdigitalModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelR3" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header btn-light">
                                    <h5 class="modal-title text-secondary" id="staticBackdropLabelR3"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar Bibliografía Digital</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editarBdigital_form">
                                    <div class="modal-body">                      
                                        @csrf
                                        <input type="hidden" id="txtIdBdigital" name="txtIdBdigital">
                                        <input type="hidden" id="txtIdSilaboBD" name="txtIdSilaboBD">
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-10 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Bibliografía Complementaria</label>
                                                        <textarea id="txtBdigitalEA" name="txtBdigitalEA" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="500" required ></textarea>
                                                </div> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                        <button type="submit" class="btn btn-success" id="btnActualizarBdigital" name="btnActualizarBdigital"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                        <div id="girarActualizarBdigital" class="lds-dual-ring col-md-12"></div> 
                                    </div>                         
                                </form>
                            </div>
                        </div>
                    </div><!--fin modal ingresar-->                   
            </div> 
        <script > //cargar tabla en el index
                    $(document).ready(function(){
                            var bdigital=$('#tablaBdigitals').DataTable({
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
                                url:"/bdigital",
                            },
                            columns:[
                                {data:'descripcion_bdigital'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });
        </script>  
        <script>//ingresar bibliografai complementaria
                $('#ingresarBdigital_form').submit(function(e){
                e.preventDefault();
                var descripcion_bdigitalc=$('#txtBdigitalE').val();
                var id_silC=$('#txtIdSilaboBdigital').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('bdigital.ingresarBDigital')}}",
                            type:"POST",
                            data:{ 
                                descripcion_bdigital:descripcion_bdigitalc,
                                id_sil:id_silC, 
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnIngresarBdigital').text('Ingresando Datos..'); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    var bDigital=$('#tablaBdigitals').DataTable();
                                    bDigital.ajax.reload();
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    document.getElementById("ingresarBdigital_form").reset();
                                    $('#btnIngresarBdigital').text('Agregar Bibliografía'); 
                                }
                            },
                            error:function(response)
                            { 
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnIngresarBdigital').text('Agregar Bibliografía');                             
                            }
                        });
                })
            </script> 
            <script>//eliminar bibliografia digital
                    var _id;
                    $(document).on('click','.DeleteBdigital',function(){
                        _id=$(this).attr('id'); 
                       
                        $('#modalEliminarBdigital_modal').modal('show');
                    });
                    $('#btnEliminarBdigital').click(function(){
                        
                        $.ajax({
                            url:"/bdigital/eliminarBDigital/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarBdigital').text('Eliminando..'); 
                                $('#girarEliminarBdigital').show(); 
                            },
                            success:function(data){              
                                    var bDigital=$('#tablaBdigitals').DataTable();
                                    bDigital.ajax.reload();
                                    $('#modalEliminarBdigital_modal').modal('hide');
                                    toastr.success('La bibliografía digital fue eliminada exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarBdigital').text('Eliminar Bibliografía'); 
                                    $('#girarEliminarBdigital').hide(); 
                            },
                            error : function(data){
                                toastr.warning('Ocurrio un error inesperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarBdigital').text('Eliminar Bibliografía'); 
                                $('#girarEliminarBdigital').hide();  
                            }  
                        });
                    });
            </script>
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR  Bibliografía  digital
                function editarBdigital(id){
                    $.get('/bdigital/editarBDigital/'+id, function(BibDigital)
                    {  
                        //asignar datos recuperados
                        $('#txtIdBdigital').val(BibDigital[0].id_bdigital);
                        $('#txtBdigitalEA').val(BibDigital[0].descripcion_bdigital);
                        $('#txtIdSilaboBD').val(BibDigital[0].id_sil);
                        $('#editarBdigitalModal').modal('toggle');
                        $("input[name=_token]").val();
                    });
                }
            </script> 
             <script>//actualizar Bibliografía  digital
                $('#editarBdigital_form').submit(function(e){
                    e.preventDefault();
                    var id_bdigital3=$('#txtIdBdigital').val();
                    var descripcion_bdigital3=$('#txtBdigitalEA').val();
                    var id_sil3=$('#txtIdSilaboBD').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('bdigital.actualizarBDigital')}}",
                                type:"POST",
                                data:{
                                    id_bdigital:id_bdigital3,
                                    descripcion_bdigital:descripcion_bdigital3,
                                    id_sil:id_sil3,
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizarBdigital').text('Actualizando..'); 
                                    $('#girarActualizarBdigital').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        var bDigital=$('#tablaBdigitals').DataTable();
                                        bDigital.ajax.reload();
                                        $('#editarBdigitalModal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                        $('#btnActualizarBdigital').text('Guardar cambios'); 
                                        $('#girarActualizarBdigital').hide(); 
                                        
                                    }
                                },
                                error:function(response)
                                {
                                    toastr.error('No se actualizaron correctamente los datos, intente nuevammente','ERROR AL ACTUALIZAR',{timeOut:1000});
                                    $('#btnActualizarBdigital').text('Guardar cambios'); 
                                    $('#girarActualizarBdigital').hide(); 
                                }
                            });
                    })
            </script>       
    <body>