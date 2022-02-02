<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/2fa.css')}}" rel="stylesheet">
    
        <title>Seguridad</title>
    </head>
    <body>
        <div class="py-2">
            <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                <a class="navbar-brand text-success " href="#">Seguridad 2FA</a>
            </nav>
        <div>
        <div class="container-fluid ">
                <form class="w-100 " id="buscarCorreo" autocomplete="off">
                    <div class="row p-2 w-100">
                        <div class="form-group col-md-9 px-2  justify-content-center text-left text-muted font-weight-bold">
                            <label for="" class="form-label ml-2  h4">Ingrese E-mail</label>
                            <input id="email" name="email" type="email" class="form-control" tabindex="1" required maxlength="100" >
                            <div class="py-2">
                                <button type="submit" class="btn btn-secondary btn-lg"><i class="fa fa-search mr-2" aria-hidden="true"></i>Buscar</button>
                            </div>
                        </div>
                    </div>
                    
                </form>
        </div>
         <!--------------------------------------------------modal editar ..........................-->
                                    <!-- Button trigger modal -->
                                        <!-- Modal -->
                                    <div class="modal fade " id="email_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Eliminar 2FA</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="eliminar2fa_form">
                                                <div class="modal-body">
                                                            @csrf
                                                                <input type="hidden" id="txtIdUsuario" name="txtIdUsuario">
                                                                <div class="row justify-content-center p-2">
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="" class="form-label ml-2 text-nowrap">Nombre Usuario: </label>
                                                                            <input readonly="readonly" type="text" id="nombre2" name="nombre2" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="" class="form-label ml-2 text-nowrap">Email Usuario: </label>
                                                                            <input  readonly="readonly" type="text" id="email2" name="email2" class="form-control">
                                                                        </div>
                                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                                    <button type="submit" class="btn btn-success" id="btnActualizar" name="btnActualizar"><i class="fa fa-trash mr-2" aria-hidden="true"></i>Quitar 2FA</button>
                                                    <div id="girar2" class="lds-dual-ring col-md-12"></div> 
                                                </div>
                                               
                                            </form>
                                            </div>
                                        </div>
                                    </div>
            <script> //abrir modal
                    $('#buscarCorreo').submit(function(e){ 
                        e.preventDefault();
                        var email=$('#email').val();
                        var _token=$("input[name=_token]").val();
                                 $.ajax({
                                        url:"{{route('admin.quitarSeguridad2fa')}}",
                                        type:"POST",
                                        async: true,
                                        data:{
                                            email:email,
                                            _token:_token
                                        },
                                        success:function(response)
                                        {   
                                            if(response)
                                            {
                                                    //asignar datos recuperados
                                                        $('#txtIdUsuario').val(response[0].id);
                                                        $('#email2').val(response[0].email);
                                                        $('#nombre2').val(response[0].name);
                                                        $("input[name=_token]").val();
                                                        $('#email_modal').modal('toggle');
                                            }
                                            else
                                            {
                                                toastr.warning('No existe el usuario ingresado','¡MENSAJE!',{timeOut:2000});
                                            }
                                        },
                                        error : function(response){
                                            toastr.error('Ocurrio un error, Intente mas tarde','Error',{timeOut:2000});
                                        }
                                    });
                    })
            </script>
            <script>
                    $('#eliminar2fa_form').submit(function(e){
                    e.preventDefault();
                    var id2=$('#txtIdUsuario').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('admin.emailEliminar')}}",
                                type:"POST",
                                data:{
                                    id:id2, 
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizar').text('Eliminando..'); 
                                    $('#girar2').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        toastr.success('Se elimino 2FA correctamente de usuario','EXITOSA',{timeOut:3000});
                                        $('#btnActualizar').text('Quitar 2FA'); 
                                        $('#girar2').hide(); 
                                        $('#email_modal').modal('hide');

                                    }
                                },
                                error:function(response)
                                {
                                    toastr.error('Ocurrio un error, intente mas tarde','ERROR',{timeOut:3000});
                                    $('#btnActualizar').text('Quitar 2FA'); 
                                    $('#girar2').hide(); 
                                }
                                
                            });
                    })
            </script>      
    <body>
</html>

