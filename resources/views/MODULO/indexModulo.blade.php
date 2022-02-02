<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/modulo.css')}}" rel="stylesheet">
        <title>Modulos</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Módulos</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de módulos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Nuevo módulo</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <table id="tabla-modulos" class="table table-responsive w-100 table-hover">
                                        <thead  class="font-weight-bold text-dark ">
                                            <td scope="col" class="col-md-2">Id</td>
                                            <td scope="col" class="col-md-3">Nombre de módulo</td>
                                            <td scope="col" class="col-md-3">Duración en horas</td>
                                            <td scope="col" class="col-md-3">Acciones</td>
                                        </thead>
                                    </table>
                                </div>
                                <!--INgresar nuevo modulo-->
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                      <form id="ingreso-modulo"   enctype="multipart/form-data">
                                            @csrf
                                                        <div class="row  justify-content-center p-2">
                                                            <div class="col-md-6 px-2 justify-content-center  text-left">
                                                                <label for="" class="form-label ml-2">Nombre de módulo</label>
                                                                <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" maxlength="100" required>
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Duracion en horas</label>
                                                                <input id="duracion" name="duracion" type="text" class="form-control" tabindex="2" maxlength="3" maxlength="2" required>    
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-success btn-lg" tile="Crear docente"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Crear módulo</button>
                                    </form>
                                    <!--fin del formulario d eingreso-->
                                </div>
                            </div>
                            <!-----------------------------------modal eliminar--------------------------------------->
                                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light text-dark ">
                                                        <h5 class="modal-title text-center" id="exampleModalLabel">Confirmar para eliminar módulo</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <hr>
                                                        ¿Esta seguro de eliminar el módulo seleccionado?
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
                                        <div class="modal fade " id="modulo_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar módulo</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="modulo_edit_form">
                                                <div class="modal-body">
                                                        @csrf
                                                        <input type="hidden" id="txtId2" name="txtId2">
                                                        <div class="row  justify-content-center p-2">
                                                            <div class="col-md-6 px-2 justify-content-center  text-left">
                                                                <label for="" class="form-label ml-2">Nombre de módulo</label>
                                                                <input id="nombre2" name="nombre2" type="text" class="form-control" tabindex="1" maxlength="100" required>
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Duracion en horas</label>
                                                                <input id="duracion2" name="duracion2" type="text" class="form-control" tabindex="2" maxlength="3" maxlength="2" required>    
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
                    
                    var docentes=$('#tabla-modulos').DataTable({
                        columnDefs: [
                                { className: "align-middle" , targets: "_all" }
                            ],
                        processing:true,
                        serverSide:true,
                        order: [[1, "asc"], [2, "asc"]],
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
                            url:"{{route('modulos.index')}}",
                        },
                        columns:[
                            {data:'id_mod'},
                            {data:'nombre_mod'},
                            {data:'duracion_horas'},
                            {data:'action',orderable:false}
                        ]

                    });
                   
                });
            </script>
           
           <script>
                    $("#duracion").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#duracion2").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                   
                
            </script>
            
         
            <script> //ingresar un nuevo modulo
              
               $('#ingreso-modulo').submit(function(e){
                   e.preventDefault();
                    var nombre_mod=$('#nombre').val();
                    var duracion_horas=$('#duracion').val();
                    var _token=$("input[name=_token]").val(); 
                   
                   //alert()
                                $.ajax({
                                    url:"{{route('modulos.ingresar')}}",
                                    type:"POST",
                                    async: true,
                                    data:{
                                        nombre_mod:nombre_mod,
                                        duracion_horas:duracion_horas,
                                        _token:_token
                                    },
                                    success:function(response)
                                    {   
                                        if(response)
                                        {                                         
                                            $('#ingreso-modulo')[0].reset();
                                           toastr.success('El ingreso fue exitoso','¡EXITOSO!',{timeOut:3000});
                                           $('#tabla-modulos').DataTable().ajax.reload();
                                          
                                        }
                                        else{
                                            toastr.danger('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                        }
                                    },
                                    
                                    error : function(response){
                                        toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                        
                                    }
                                });      
                })
                
        </script>
         
        <script>/////////////////////////eliminar un docente------------------------------
            var _id;
            $(document).on('click','.delete',function(){
                _id=$(this).attr('id'); 
                $('#confirmModal').modal('show');
            });
            $('#btnEliminar').click(function(){
                
                $.ajax({
                   
                    url:"/modulos/eliminar/"+_id,
                    beforeSend:function(){
                        $('#btnEliminar').text('Eliminando..'); 
                        $('#girar').show(); 
                    },
                    success:function(data){
                            $('#confirmModal').modal('hide');
                            toastr.success('El módulo fue eliminado exitosamente','¡EXITOSO!',{timeOut:3000});
                            $('#tabla-modulos').DataTable().ajax.reload();
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide();    
                    },
                    error : function(data){
                        
                                        toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                    }
                    
                });
            });

        </script>
        
           <script>//CARGAER EN EL FORMULARIO PARA EDITAR
            function editarModulo(id){
                $.get('/modulos/editar/'+id, function(modulo)
                {
                    //asignar datos recuperados
                    $('#txtId2').val(modulo[0].id_mod);
                    $('#nombre2').val(modulo[0].nombre_mod);
                    $('#duracion2').val(modulo[0].duracion_horas);
                    $('#modulo_edit_modal').modal('toggle');
                    $("input[name=_token]").val();


                });

            }
        </script>
        
        <script>//actualizar cambios realizados
                
                $('#modulo_edit_form').submit(function(e){

                    e.preventDefault();
                    var id_mod2=$('#txtId2').val();
                    var nombre_mod2=$('#nombre2').val();
                    var duracion_horas2=$('#duracion2').val();
                    var _token2=$("input[name=_token]").val(); 
                  
                    $.ajax({
                                url:"{{route('modulos.actualizar')}}",
                                type:"POST",
                                data:{
                                        id_mod:id_mod2, 
                                        nombre_mod:nombre_mod2,
                                        duracion_horas:duracion_horas2,
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
                                        $('#modulo_edit_modal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                        $('#tabla-modulos').DataTable().ajax.reload();
                                        $('#btnActualizar').text('Guardar cambios'); 
                                        $('#girar2').hide(); 
                                    }
                                },
                                error : function(response){
                                            toastr.warning('Ocurrio un error intente nuevamente','¡FALLIDA!',{timeOut:3000});
                                }
                            });
                    
                })
            </script>
 
    <body>
</html>

