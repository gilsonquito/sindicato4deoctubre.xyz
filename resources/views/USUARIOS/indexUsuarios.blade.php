<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/usuarios.css')}}" rel="stylesheet">
        <title>Usuarios</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Usuarios administradores</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de usuarios</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Nuevo usuario</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content justify-content-center  text-center" id="myTabContent">
                                <div class="tab-pane fade show active justify-content-center  text-center" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <!--<h3 class="py-3">Periodos Académicos</h3>-->
                                    <table id="tabla-usuarios" class="table table-responsive-lg w-100 table-hover justify-content-center  text-center">
                                        <thead  class="font-weight-bold text-dark ">
                                            <td scope="col" class="col-md-3">Id</td>
                                            <td scope="col" class="col-md-4">Nombre</td>
                                            <td scope="col" class="col-md-4">Email</td>
                                            <td scope="col" class="col-md-4">Acciones</td>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                      <form id="ingreso-USUARIO"   enctype="multipart/form-data" autocomplete="off">
                                            @csrf   
                                                        <div class="row  justify-content-center p-2">
                                                            <div class="col-md-6 px-2 justify-content-center  text-left">
                                                                <label for="" class="form-label ml-2">Nombre</label>
                                                                <input id="name" name="name" type="text" class="form-control" tabindex="1" title="nombre"  maxlength="50" required>
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Correo electrónico</label>
                                                                <input id="email" name="email" type="email" class="form-control text-lowercase" tabindex="2" maxlength="80" title="Email" required>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center p-2">
                                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                <label for="select">Tipo de Usuario</label>
                                                                <select class="form-control" id="selRol" name="selRol" tabindex="3" title="rol" required>
                                                                    <option value="1">ADMINISTRADOR</option>
                                                                    <option value="4">DIRECTOR</option>
                                                                    <option value="5">INSPECTOR</option>
                                                                    <option value="6">SECRETARÍA</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Contraseña</label>
                                                                <input id="password" name="password" type="password" class="form-control" tabindex="4" maxlength="100" title="Contraseña" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-success btn-lg" tile="Crear docente"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Crear usuario</button>
                                    </form>
                                </div>
                            </div>
                            <!-----------------------------------modal eliminar--------------------------------------->
                                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light text-dark ">
                                                        <h5 class="modal-title text-center" id="exampleModalLabel">Confirmar para eliminar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <hr>
                                                        ¿Esta seguro de eliminar el curso seleccionado?
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
                                        <div class="modal fade " id="usuario_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar Usuario</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="usuario_edit_form">
                                                <div class="modal-body">
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                        <div class="row  justify-content-center p-2">
                                                            <div class="col-md-6 px-2 justify-content-center  text-left">
                                                                <label for="" class="form-label ml-2">Nombre</label>
                                                                <input id="name2" name="name2" type="text" class="form-control" tabindex="2" maxlength="50" required>
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Correo</label>
                                                                <input id="email2" name="email2" type="email" class="form-control text-lowercase" tabindex="8" maxlength="80" required>
                                                            </div>
                                                        </div>      
                                                        <div class="row justify-content-center p-2">
                                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                <label for="select">Tipo de usuario</label>
                                                                <select class="form-control" id="selRol2" name="selRol2" tabindex="3" title="rol" required>
                                                                    <option value="1">ADMINISTRADOR</option>
                                                                    <option value="4">DIRECTOR</option>
                                                                    <option value="5">INSPECTOR</option>
                                                                </select>
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
                    
                    var usuarioss=$('#tabla-usuarios').DataTable({
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
                        processing:true,
                        serverSide:true,
                        order: [[1, "asc"], [2, "asc"]],
                        ajax:{
                            url:"{{route('usuariosrol.index')}}",
                        },
                        columns:[
                            {data:'id'},
                            {data:'name'},
                            {data:'email'},
                            {data:'action',orderable:false}
                        ]

                    });
                   
                });
            </script>
          
         
            <script> //ingresar un nuevo curso
              
               $('#ingreso-USUARIO').submit(function(e){
                    e.preventDefault();
                    var name=$('#name').val();
                    var email=$('#email').val();
                    var password=$('#password').val();
                    var rol=$('#selRol').val();
                    var _token=$("input[name=_token]").val(); 
                                $.ajax({
                                    url:"{{route('usuariosrol.ingresar')}}",
                                    type:"POST",
                                    async: true,
                                    data:{
                                        name:name,
                                        email:email,
                                        password:password,
                                        rol:rol,
                                        _token:_token
                                    },
                                    success:function(response)
                                    {   
                                        if(response)
                                        {                                         
                                            $('#ingreso-USUARIO')[0].reset();
                                           toastr.success('El ingreso fue exitoso','¡EXITOSO!',{timeOut:3000});
                                           $('#tabla-usuarios').DataTable().ajax.reload(); 
                                        }
                                        else{
                                            toastr.danger('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                        }
                                    },
                                    error : function(response){
                                        toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                        toastr.warning('Verifique el correo, puede ser que ya exista usuario,','¡FALLIDA!',{timeOut:5000});
                                    }
                                });      
                })    
        </script>
          
        <script>/////////////////////////eliminar un usuario------------------------------
            var _id;
            $(document).on('click','.delete',function(){
                _id=$(this).attr('id'); 
                $('#confirmModal').modal('show');
            });
            $('#btnEliminar').click(function(){
                
                $.ajax({
                   
                    url:"usuariosrol/eliminar/"+_id,
                    beforeSend:function(){
                        $('#btnEliminar').text('Eliminando..'); 
                        $('#girar').show(); 
                    },
                    success:function(data){
                        setTimeout(function(){
                           
                            $('#confirmModal').modal('hide');
                            toastr.success('El usuario fue eliminado exitosamente','¡EXITOSO!',{timeOut:3000});
                            $('#tabla-usuarios').DataTable().ajax.reload();
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                        },2000);
                        
                    },
                    error : function(data){
                       
                                        toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                      
                                    }
                    
                });
            });

        </script>
           <script>//CARGAER EN EL FORMULARIO PARA EDITAR
            function editarUsuarioRol(id){
                $.get('usuariosrol/editar/'+id, function(usuario)
                {
                    //asignar datos recuperados
                    $('#txtId2').val(usuario[0].id);
                    $('#name2').val(usuario[0].name);
                    $('#email2').val(usuario[0].email);
                    $('#selRol2').val(usuario[0].rol);
                    $('#usuario_edit_modal').modal('toggle');
                    $("input[name=_token]").val();
                });
            }
        </script>
        <script>//actualizar cambios realizados
                
                $('#usuario_edit_form').submit(function(e){
                    e.preventDefault();
                    var id_usuario2=$('#txtId2').val();
                    var name2=$('#name2').val();
                    var email2=$('#email2').val();
                    var rol2=$('#selRol2').val();
                    var _token2=$("input[name=_token]").val(); 
                    $.ajax({
                                url:"{{route('usuariosrol.actualizar')}}",
                                type:"POST",
                                data:{
                                        id:id_usuario2, 
                                        name:name2,
                                        email:email2,
                                        rol:rol2,
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
                                        $('#usuario_edit_modal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                        $('#tabla-usuarios').DataTable().ajax.reload();
                                        $('#btnActualizar').text('Guardar cambios'); 
                                        $('#girar2').hide(); 
                                    }
                                },
                                error : function(response){
                                            toastr.warning('Ocurrio un error intente nuevamente','¡FALLIDA!',{timeOut:3000});
                                            toastr.warning('Verifique el correo, puede ser que ya exista usuario,','¡FALLIDA!',{timeOut:5000});
                                }
                            });
                    
                })
            </script>
 
    <body>
</html>

