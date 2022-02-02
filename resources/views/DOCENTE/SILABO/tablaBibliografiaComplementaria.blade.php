<head>   
    <link href="{{asset('css/tablaBobliografiaComplementaria.css')}}" rel="stylesheet">
    <title>BibliografiaComplementarias</title>
</head>
    <body>
        <div id="contenidoBibliCom"> 
            <input type="hidden" id="txtIdSilaboBibCom" name="txtIdSilaboBibCom" value="{{session('idSilabo')}}">
            <div class="w-100">
                    <form id="ingresarBibliografiaComplementaria_form">                     
                        @csrf
                            <div class="row justify-content-center p-2">
                                <div class="form-group col-md-10 px-2  justify-content-center text-left">
                                        <textarea id="txtBibliografiaComplementariaE" name="txtBibliografiaComplementariaE" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="500" required ></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success" id="btnIngresarBibliografiaComplementaria" name="btnIngresarBibliografiaComplementaria"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Blibliografía</button>
                            </div>                      
                    </form>
            </div>
            <div class="row col-md-12 ">
                    <div class="col-md-12">
                        <table id="tablaBibliografiaComplementarias" class="table table-striped table-bordered table-responsive-lg w-100">
                            <thead  class="font-weight-bold text-dark p-0 ">
                                <td class="col-md-9">Blibliografia Complementaria</td>
                                <td class="col-md-3">Acciones</td>
                            </thead>
                        </table>
                    </div>     
            </div>
            <!-----------------------------------modal eliminar bibliografia complementariaº--------------------------------------->             
                <div class="modal fade" id="modalEliminarBibliografiaComplementaria_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
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
                                    ¿Esta seguro de eliminar la Blibliografía Complementaria seleccionada?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarBibliografiaComplementaria" name="btnEliminarBibliografiaComplementaria"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar Blibliografía     
                                </button>  
                            </div>
                            <div id="girarEliminarBibliografiaComplementaria" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                <!--------------------------------------------------modal editar bibliografia complementaria ..........................-->
                    <!-- Modal -->
                    <div class="modal fade " id="editarBibliografiaComplementariaModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelR3" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header btn-light">
                                    <h5 class="modal-title text-secondary" id="staticBackdropLabelR3"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar Bibliografía Complementaria</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editarBibliografiaComplementaria_form">
                                    <div class="modal-body">                      
                                        @csrf
                                        <input type="hidden" id="txtIdBibliografiaComplementaria" name="txtIdBibliografiaComplementaria">
                                        <input type="hidden" id="txtIdSilBibCom" name="txtIdSilBibCom">
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-10 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Bibliografía Complementaria</label>
                                                        <textarea id="txtBibliografiaComplementariaEA" name="txtBibliografiaComplementariaEA" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="500" required ></textarea>
                                                </div> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                        <button type="submit" class="btn btn-success" id="btnActualizarBibliografiaComplementaria" name="btnActualizarBibliografiaComplementaria"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                        <div id="girarActualizarBibliografiaComplementaria" class="lds-dual-ring col-md-12"></div> 
                                    </div>                         
                                </form>
                            </div>
                        </div>
                    </div><!--fin modal ingresar-->                   
            </div> 
        <script > //cargar tabla en el index
                    $(document).ready(function(){
                            var recursos=$('#tablaBibliografiaComplementarias').DataTable({
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
                            //processing:true,  
                            //serverSide:true,
                            ajax:{
                                url:"/bcomplementaria",
                            },
                            columns:[
                                {data:'descripcion_bibliografia'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });
        </script>  
        <script>//ingresar bibliografai complementaria
                $('#ingresarBibliografiaComplementaria_form').submit(function(e){
                e.preventDefault();
                var descripcion_bibliografiac=$('#txtBibliografiaComplementariaE').val();
                var id_silC=$('#txtIdSilaboBibCom').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('bcomplementaria.ingresarBlibliografiaComplementaria')}}",
                            type:"POST",
                            data:{ 
                                descripcion_bibliografia:descripcion_bibliografiac,
                                id_sil:id_silC, 
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnIngresarBibliografiaComplementaria').text('Ingresando Datos..'); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    var bibliografiaCom=$('#tablaBibliografiaComplementarias').DataTable();
                                    bibliografiaCom.ajax.reload();
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    document.getElementById("ingresarBibliografiaComplementaria_form").reset();
                                    $('#btnIngresarBibliografiaComplementaria').text('Agregar Blibliografía'); 
                                }
                            },
                            error:function(response)
                            {
                                
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnIngresarBibliografiaComplementaria').text('Agregar Blibliografía');                              
                            }
                        });
                })
            </script> 
            <script>//eliminar bibliorafia complementaria
                    var _id;
                    $(document).on('click','.DeleteBibliografiaComplementaria',function(){
                        _id=$(this).attr('id'); 
                       
                        $('#modalEliminarBibliografiaComplementaria_modal').modal('show');
                    });
                    $('#btnEliminarBibliografiaComplementaria').click(function(){
                        
                        $.ajax({
                            url:"/bcomplementaria/eliminarBibliografiaComplementaria/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarBibliografiaComplementaria').text('Eliminando..'); 
                                $('#girarEliminarBibliografiaComplementaria').show(); 
                            },
                            success:function(data){              
                                    var bibliografiaCom=$('#tablaBibliografiaComplementarias').DataTable();
                                    bibliografiaCom.ajax.reload();
                                    $('#modalEliminarBibliografiaComplementaria_modal').modal('hide');
                                    toastr.success('La Bibliografía fue eliminada exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarBibliografiaComplementaria').text('Eliminar Blibliografía'); 
                                    $('#girarEliminarBibliografiaComplementaria').hide(); 
                            },
                            error : function(data){
                                toastr.warning('Ocurrio un error inesperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarBibliografiaComplementaria').text('Eliminar Blibliografía'); 
                                $('#girarEliminarBibliografiaComplementaria').hide();  
                            }  
                        });
                    });
            </script>
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR bibligorafaia complementaria
                function editarBibliografiaComplementariaE(id){
                    $.get('/bcomplementaria/editarBibliografiaComplementaria/'+id, function(bibliografiaC)
                    {  
                        //asignar datos recuperados
                        $('#txtIdBibliografiaComplementaria').val(bibliografiaC[0].id_bcomplementaria);
                        $('#txtBibliografiaComplementariaEA').val(bibliografiaC[0].descripcion_bibliografia);
                        $('#txtIdSilBibCom').val(bibliografiaC[0].id_sil);
                        $('#editarBibliografiaComplementariaModal').modal('toggle');
                        $("input[name=_token]").val();
                    });
                }
            </script> 
             <script>//actualizar escenario
                $('#editarBibliografiaComplementaria_form').submit(function(e){
                    e.preventDefault();
                    var id_bcomplementaria3=$('#txtIdBibliografiaComplementaria').val();
                    var descripcion_bibliografia3=$('#txtBibliografiaComplementariaEA').val();
                    var id_sil3=$('#txtIdSilBibCom').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('bcomplementaria.actualizarBlibliografiaComplementaria')}}",
                                type:"POST",
                                data:{
                                    id_bcomplementaria:id_bcomplementaria3,
                                    descripcion_bibliografia:descripcion_bibliografia3,
                                    id_sil:id_sil3,
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizarBibliografiaComplementaria').text('Actualizando..'); 
                                    $('#girarActualizarBibliografiaComplementaria').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        var bibliografiaCom=$('#tablaBibliografiaComplementarias').DataTable();
                                        bibliografiaCom.ajax.reload();
                                        $('#editarBibliografiaComplementariaModal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                        $('#btnActualizarBibliografiaComplementaria').text('Guardar cambios'); 
                                        $('#girarActualizarBibliografiaComplementaria').hide(); 
                                        
                                    }
                                },
                                error:function(response)
                                {
                                    toastr.error('No se actualizaron correctamente los datos, intente nuevammente','ERROR AL ACTUALIZAR',{timeOut:1000});
                                    $('#btnActualizarBibliografiaComplementaria').text('Guardar cambios'); 
                                    $('#girarActualizarBibliografiaComplementaria').hide(); 
                                }
                            });
                    })
            </script>       
    <body>