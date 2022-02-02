<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/paralelo.css')}}" rel="stylesheet">
        <title>Paralelo</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success " href="#">Paralelos</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de paralelos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Nuevo paralelo</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <!--<h3 class="py-3">tipos de lciencia</h3>-->
                                    <table id="tabla-paralelos" class="table table-responsive-lg table-hover w-100">
                                        <thead  class="font-weight-bold text-dark ">
                                            <td scope="col">Id</td>
                                            <td scope="col">Nombre paralelo</td>
                                            <td scope="col">Acciones</td>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                   <!-- <h3 class="py-3" >Nuevo tipo licencia </h3-->
                                    <form id="ingreso-paralelo">
                                            <div class="row justify-content-center p-2">
                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Nombre o descripción de paralelo</label>
                                                        <input id="paralelo" name="paralelo" type="text" class="form-control" tabindex="1" required maxlength="3" onkeyup="mayusculasp(this);">
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
                                                        ¿Esta seguro de eliminar el paralelo seleccionado?
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
                                        <div class="modal fade " id="paralelos_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar Paralelo</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="paralelos_edit_form">
                                                <div class="modal-body">
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                                <div class="row justify-content-center p-2">
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="" class="form-label ml-2 text-nowrap">Nombre o descripción de paralelo</label>
                                                                            <input id="paralelo2" name="paralelo2" type="text" class="form-control" tabindex="1" required maxlength=3 onkeyup="mayusculasp(this);">
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
                        var tipolice=$('#tabla-paralelos').DataTable({
                            processing:true,
                            columnDefs: [
                                { className: "align-middle" , targets: "_all" }
                            ],
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
                                url:"{{route('paralelos.index')}}",
                            },
                            columns:[
                                {data:'id_paralelo'},
                                {data:'nombre_paralelo'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });

            </script>
            <script>
                // Funcion JavaScript para la conversion a mayusculas
                function mayusculasp(e) {
                    e.value = e.value.toUpperCase();
                }
            </script>
            
            <script> //ingresar un nuevo paralelo

                    $('#ingreso-paralelo').submit(function(e){ 
                    e.preventDefault();
                        var nombre_paralelo=$('#paralelo').val();
                        var _token=$("input[name=_token]").val();
                                 $.ajax({
                                        url:"{{route('paralelos.ingresar')}}",
                                        type:"POST",
                                        async: true,
                                        data:{
                                            nombre_paralelo:nombre_paralelo,
                                            _token:_token
                                        },
                                        success:function(response)
                                        {   
                                            if(response)
                                            {
                                                $('#ingreso-paralelo')[0].reset();
                                                toastr.success('El registro fue exitoso','¡EXITOSO!',{timeOut:3000});
                                                $('#tabla-paralelos').DataTable().ajax.reload();
                                            }
                                        },
                                        error : function(response){
                                            toastr.error('No se realizo el registro','Error',{timeOut:3000});
                                        }
                                    });
                    })

            </script>
            
            <script>//eliminar un paralelo
                    var _id;
                    $(document).on('click','.delete',function(){
                    _id=$(this).attr('id'); 
                    $('#confirmModal').modal('show');
                    });
                    $('#btnEliminar').click(function(){
                    $.ajax({
                        url:"/paralelos/eliminar/"+_id,
                        beforeSend:function(){
                            $('#btnEliminar').text('Eliminando..'); 
                            $('#girar').show(); 
                        },
                        success:function(data){
                            setTimeout(function(){
                                $('#confirmModal').modal('hide');
                                toastr.success('El paralelo fue eliminado exitosamente','¡EXITOSO!',{timeOut:3000});
                                $('#tabla-paralelos').DataTable().ajax.reload();
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
                    function editarParalelo(id){
                    $.get('/paralelos/editar/'+id, function(paralelos)
                    {
                        //asignar datos recuperados
                        $('#txtId2').val(paralelos[0].id_paralelo);
                        $('#paralelo2').val(paralelos[0].nombre_paralelo);
                        $("input[name=_token]").val();
                        $('#paralelos_edit_modal').modal('toggle');

                    });
                    }
          </script>
          <!--//actualizar datos-->
        <script>
                    $('#paralelos_edit_form').submit(function(e){
                    e.preventDefault();
                    var id2=$('#txtId2').val();
                    var nombre_paralelo2=$('#paralelo2').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('paralelos.actualizar')}}",
                                type:"POST",
                                data:{
                                    id_paralelo:id2, 
                                    nombre_paralelo:nombre_paralelo2,
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
                                        $('#paralelos_edit_modal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                        $('#tabla-paralelos').DataTable().ajax.reload();
                                        $('#btnActualizar').text('Guardar cambios'); 
                                        $('#girar2').hide(); 
                                    }
                                },
                                error:function(response)
                                {
                                    $('#paralelos_edit_modal').modal('hide');
                                    toastr.error('No se actualizaron correctamente los datos','ERROR AL ACTUALIZAR',{timeOut:3000});
                                        $('#btnActualizar').text('Guardar cambios'); 
                                        $('#girar2').hide(); 
                                }
                                
                            });
                    })
            </script>      
    <body>
</html>

