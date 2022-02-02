<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/tipoLicencia.css')}}" rel="stylesheet">
        <title>Tipo Licencia</title>
    </head>
    <body>
            <div class="container-fluid p-2 "><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success " href="#">Tipo de licencia</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de tipos de licencia</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Nuevo tipo de licencia</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <!--<h3 class="py-3">tipos de lciencia</h3>-->
                                    <table id="tabla-tipoLicencia" class="table table-responsive-lg table-hover w-100">
                                        <thead  class="font-weight-bold text-dark ">
                                            <td scope="col">Id</td>
                                            <td scope="col">Descripción de licencia</td>
                                            <td scope="col">Acciones</td>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                   <!-- <h3 class="py-3" >Nuevo tipo licencia </h3-->
                                    <form id="ingreso-tipoLicencia">
                                            <div class="row justify-content-center p-2">
                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Nombre de tipo de licencia</label>
                                                        <input id="tipol" name="tipol" type="text" class="form-control" tabindex="1" required maxlength=3 onkeyup="mayusculas(this);">
                                                    </div>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Crear</button>
                                    </form>
                                </div>
                            </div>
                            <!-----------------------------------modal eliminar--------------------------------------->
                                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header btn-light text-dark ">
                                                        <h5 class="modal-title text-center" id="exampleModalLabel">Confirmar para eliminar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <hr>
                                                        ¿Esta seguro de eliminar el tipo de licencia seleccionado?
                                                        <hr>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                                        <button type="button" class="btn btn-danger" id="btnEliminar" name="btnEliminar"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar     
                                                        </button>
                                                    </div>
                                                    <div id="girar" class="lds-dual-ring"></div> 
                                                </div>
                                            </div>
                                    </div><!--finc modal--> 
                                    <!--------------------------------------------------modal editar ..........................-->
                                    <!-- Button trigger modal -->
                                        <!-- Modal -->
                                        <div class="modal fade " id="tipolicencia_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar tipo de licencia</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="tipolicencia_edit_form">
                                                <div class="modal-body">
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                                <div class="row justify-content-center p-2">
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="" class="form-label ml-2 text-nowrap">Nombre de tipo de licencia</label>
                                                                            <input id="tipol2" name="tipol2" type="text" class="form-control" tabindex="1" required maxlength=3 onkeyup="mayusculas(this);">
                                                                        </div>
                                                                </div> 
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                                    <button type="submit" class="btn btn-success" id="btnActualizar" name="btnActualizar"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                                    <div id="girar2" class="lds-dual-ring col-md-12"></div> 
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                    </div><!--finc container--> 
            </div><!--digeneral-->    
            <script type="text/javascript"> //cargar tabla en el index


                    $(document).ready(function(){
                        
                        var tipolice=$('#tabla-tipoLicencia').DataTable({
                            columnDefs: [
                                { className: "align-middle" , targets: "_all" }
                            ],
                            processing:true,
                            serverSide:true,
                            order: [[1, "asc"]],
                            language: {
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
                            ajax:{
                                url:"{{route('tipolicencia.index')}}",
                            },
                            columns:[
                                {data:'id_tlic'},
                                {data:'nombre_tlic'},
                                {data:'action',orderable:false}
                            ]

                        });
                    });

            </script>
            <script>
                // Funcion JavaScript para la conversion a mayusculas
                function mayusculas(e) {
                    e.value = e.value.toUpperCase();
                }
            </script>
            
            <script> //ingresar un nuevo perido

                    $('#ingreso-tipoLicencia').submit(function(e){ 
                    e.preventDefault();
                    
                        var nombre_tlic=$('#tipol').val();
                     
                        
                        var _token=$("input[name=_token]").val();
                                 $.ajax({
                                        url:"{{route('tipolicencia.ingresar')}}",
                                        type:"POST",
                                        async: true,
                                        data:{
                                            nombre_tlic:nombre_tlic,
                                            _token:_token
                                        },
                                        success:function(response)
                                        {   
                                            if(response)
                                            {
                                                $('#ingreso-tipoLicencia')[0].reset();
                                                toastr.success('El registro fue exitoso','¡EXITOSO!',{timeOut:3000});
                                                $('#tabla-tipoLicencia').DataTable().ajax.reload();
                                            }
                                        },
                                        error : function(response){
                                            toastr.error('No se realizo el registro','Error',{timeOut:3000});
                                        }
                                    });
                    })

            </script>
            
            <script>//eliminar un periodo
                    var _id;
                    $(document).on('click','.delete',function(){
                    _id=$(this).attr('id'); 
                    $('#confirmModal').modal('show');
                    });
                    $('#btnEliminar').click(function(){
                    $.ajax({
                        url:"tipolicencia/eliminar/"+_id,
                        beforeSend:function(){
                            $('#btnEliminar').text('Eliminando..'); 
                            $('#girar').show(); 
                        },
                        success:function(data){
                            setTimeout(function(){
                                $('#confirmModal').modal('hide');
                                toastr.success('El tipo de licencia fue eliminado exitosamente','¡EXITOSO!',{timeOut:3000});
                                $('#tabla-tipoLicencia').DataTable().ajax.reload();
                                $('#btnEliminar').text('Eliminar'); 
                                $('#girar').hide(); 
                            },2000);
                        },
                        error : function(response){
                                toastr.error('Ocurrio un error, vuelva a intentarlo','¡FALLIDA!',{timeOut:3000});
                                $('#confirmModal').modal('hide');
                                $('#btnEliminar').text('Eliminar'); 
                                $('#girar').hide(); 
                        }
                    });
                    });

            </script>
            
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR
                    function editarTipoLicencia(id){
                    $.get('tipolicencia/editar/'+id, function(tipolicencia)
                    {
                        //asignar datos recuperados
                        $('#txtId2').val(tipolicencia[0].id_tlic);
                        $('#tipol2').val(tipolicencia[0].nombre_tlic);
                        $("input[name=_token]").val();
                        $('#tipolicencia_edit_modal').modal('toggle');

                    });
                    }
          </script>
          <!--//actualizar datos-->
        <script>

                    $('#tipolicencia_edit_form').submit(function(e){
                    e.preventDefault();
                    var id2=$('#txtId2').val();
                    var nombre_tlic2=$('#tipol2').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('tipolicencia.actualizar')}}",
                                type:"POST",
                                data:{
                                    id_tlic:id2, 
                                    nombre_tlic:nombre_tlic2,
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizar').text('Actualizando..'); 
                                    $('#girar2').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        $('#tipolicencia_edit_modal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                        $('#tabla-tipoLicencia').DataTable().ajax.reload();
                                        $('#btnActualizar').text('Guardar cambios'); 
                                        $('#girar2').hide(); 
                                    }
                                },
                                error:function(response)
                                {
                                    $('#tipolicencia_edit_modal').modal('hide');
                                    toastr.error('No se actualizaron correctamente los datos','ACTUALIZACIÓN FALLIDA',{timeOut:3000});
                                    $('#tabla-tipoLicencia').DataTable().ajax.reload();
                                        $('#btnActualizar').text('Guardar cambios'); 
                                        $('#girar2').hide(); 
                                }
                                
                            });
                    })
            </script>

        
            
    <body>
</html>

