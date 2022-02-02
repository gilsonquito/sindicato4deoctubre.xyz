    <head>
        <link href="{{asset('css/prerrequisito.css')}}" rel="stylesheet">
    <title>Prerrequisitos</title>
    </head>
    <body>  
        <div id="datosPrerrequisitos" class="px-3">    
                <input type="hidden" id="txtIdSilaboP" name="txtIdSilaboP" value="{{session('idSilabo')}}">
                <p class="text-left font-weight-bold text-muted" href="#">Listado de prerrequisitos</p>
                <hr color="" class="border border-muted w-100 p-0">
                <div class="row col-md-12 ">
                    <div class="col-md-6">
                        <table id="tabla_prerrequisitos" class="table-bordered  ">
                                <thead class="font-weight-bold text-center text-dark" >
                                    <td class="col-md-2 py-2">Prerrequisito</td>
                                    <td class="col-md-1 py-2">Acciones</td>
                                </thead>
                        </table>   
                    </div>
                    <div class="col-md-6  align-self-center" >
                        <form id="ingresoPrerrequisito_Form">   
                                <div class="col-md-12 text-center">
                                        <div class="form-group ">
                                            
                                            <input id="txtPrerrequisito" name="txtPrerrequisito" type="text" class="form-control" tabindex="1" maxlength="100" required>
                                        </div>
                                        <button type="submit" class="btn btn-outline-success " id="btnIngresarPrerrequisito" name="btnIngresarPrerrequisito" ><i class="fa fa-plus mr-2" aria-hidden="true"></i>Agregar Prerrequisito</button>
                                </div>   
                        </form>
                    </div>
                    <br>                                        
        </div> 
              <!-----------------------------------modal eliminar--------------------------------------->           
              <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light text-dark ">
                                                        <h5 class="modal-title text-center" id="exampleModalLabel"><i class="fa fa-check-circle-o mr-2" aria-hidden="true"></i>Confirmar para eliminar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <hr>
                                                        ¿Esta seguro de eliminar el prerrequisito?
                                                        <hr>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                                        <button type="button" class="btn btn-danger" id="btnEliminar" name="btnEliminar"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar     
                                                        </button>  
                                                    </div>
                                                    <div id="girarEliminarP" class="lds-dual-ring"></div> 
                                                </div>
                                            </div>
                                </div><!---------Final modal eliminar------->
                                <!--------------------------------------------------modal editar ..........................-->
                                        <div class="modal fade " id="prerrequisito_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel20" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title text-muted" id="staticBackdropLabel20"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar prerrequisito</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form autocomplete="off" id="prerrequisito_edit_form" action="{{url('avancesacademico/actualizar')}}" method="POST" enctype="multipart/form-data" class="p-4">
                                                <div class="modal-body">     
                                                            @csrf
                                                                <input type="hidden" id="txtIdP2" name="txtIdP2">
                                                                <div class="row justify-content-center p-2">
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <input id="prerrequisito2" name="prerrequisito2" type="text" class="form-control" tabindex="1" maxlength="100" required>
                                                                        </div>
                                                                </div>                
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                                    <button type="submit" class="btn btn-success" id="btnActualizar" name="btnActualizar"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                                    <div id="girarActualizarP" class="lds-dual-ring col-md-12"></div> 
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div><!--fin modulo editar-->                
        </div> 
        <script> //cargar tabla en el index
          
                    $(document).ready(function(){
                            prerrequisito=$('#tabla_prerrequisitos').DataTable({
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
                            //processing:false,  
                            //:false,
                            ajax:{
                                url:"/prerrequisitos",
                            },
                            columns:[
                                {data:'descripcion_prerrequisito'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });
            </script> 
        <script> //ingresar un nuevo prerrequisito
            $('#ingresoPrerrequisito_Form').submit(function(e){ 
                e.preventDefault();
                var descripcion_prerrequisito=$('#txtPrerrequisito').val();
                var id_silp=$('#txtIdSilaboP').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                                url:"{{route('prerrequisitos.ingresarPrerrequisito')}}",
                                type:"POST",
                                async: true,
                                data:{
                                    descripcion_prerrequisito:descripcion_prerrequisito,
                                    id_sil:id_silp,
                                    _token:_token
                                },
                                success:function(response)
                                {   
                                    if(response)
                                    {
                                        $('#ingresoPrerrequisito_Form')[0].reset();
                                        var prerrequisitost=$('#tabla_prerrequisitos').DataTable();
                                        prerrequisitost.ajax.reload(); 
                                        toastr.success('El registro fue exitoso','¡EXITOSO!',{timeOut:1000});
                                    }
                                },
                                error : function(response){
                                    toastr.error('No se realizo el registro','Error',{timeOut:1000});
                                }
                            });
            })
        </script>
        <script>/////////////////////////eliminar un prerrequisito------------------------------
            var _id;
            $(document).on('click','.deleteP',function(){
                _id=$(this).attr('id'); 
                $('#confirmModal').modal('show');
            });
            $('#btnEliminar').click(function(){
                var id_silp=$('#txtSilabo').val();
                $.ajax({
                    url:"/prerrequisitos/eliminarPrerrequisito/"+_id,
                    beforeSend:function(){
                        $('#btnEliminar').text('Eliminando..'); 
                        $('#girarEliminarP').show(); 
                    },
                    success:function(data){              
                            var prerrequisitost=$('#tabla_prerrequisitos').DataTable();
                            prerrequisitost.ajax.reload(); 
                            $('#confirmModal').modal('hide');
                            toastr.success('El prerrequisito fue eliminado exitosamente','¡EXITOSO!',{timeOut:1000});
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girarEliminarP').hide(); 
                        $('#confirmModal').modal('hide'); 
                    },
                    error : function(data){
                        toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                        $('#btnEliminar').text('Eliminar'); 
                        $('#girarEliminarP').hide(); 
                    }  
                });
            });
        </script> 
      
        
         <script>//CARGAER EN EL FORMULARIO PARA EDITAR
            function editarPrerrequisito(id){
                $.get('/prerrequisitos/editarPrerrequisito/'+id, function(data)
                {  
                    //asignar datos recuperados
                    $('#txtIdP2').val(data[0].id_prerrequisito);
                    $('#prerrequisito2').val(data[0].descripcion_prerrequisito);
                    $('#prerrequisito_edit_modal').modal('toggle');
                    $("input[name=_token]").val();
                });   
            }
        </script>  
            <script>
                $('#prerrequisito_edit_form').submit(function(e){
                e.preventDefault();
                var id_silp=$('#txtSilabo').val();
                var id2=$('#txtIdP2').val();
                var nombre_prerrequisito2=$('#prerrequisito2').val();
                var _token2=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('prerrequisitos.actualizarPrerrequisito')}}",
                            type:"POST",
                            data:{
                                id_prerrequisito:id2, 
                                nombre_prerrequisito:nombre_prerrequisito2,
                                _token:_token2
                            },
                            beforeSend:function(){
                                $('#btnActualizar').text('Actualizando..'); 
                                $('#girarActualizarP').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    var prerrequisitost=$('#tabla_prerrequisitos').DataTable();
                                        prerrequisitost.ajax.reload(); 
                                    $('#prerrequisito_edit_modal').modal('hide');
                                    toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                    $('#btnActualizar').text('Guardar cambios'); 
                                    $('#girarActualizarP').hide();   
                                }
                            },
                            error:function(response)
                            {
                                $('#prerrequisito_edit_modal').modal('hide');
                                toastr.error('No se actualizaron correctamente los datos','ERROR AL ACTUALIZAR',{timeOut:1000});
                                $('#btnActualizar').text('Guardar cambios'); 
                                ('#girarActualizarP').hide();  
                            }
                        });
                })
            </script>   
        <body>
</html>