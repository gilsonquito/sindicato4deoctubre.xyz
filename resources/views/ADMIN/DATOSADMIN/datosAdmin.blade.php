<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/datosAdmin.css')}}" rel="stylesheet">
        <title>Datos admin</title>
    </head>
    <body>
        <div class="container-fluid p-2 ">
            <nav class="navbar navbar-expand-lg navbar-light bg-light p-2">
                            <i class="fa fa-pencil-square-o  mr-3 lead  text-DARK" aria-hidden="true"></i>
                            <a class="navbar-brand font-weight-bold  text-warning" href="#">Datos usuario</a>
            </nav>
        </div>
        <!-- <h3 class="py-3" >Nuevo docente</h3-->
         @foreach ($docentes as $docente)
        <form id="datosDocente" class="py-4">
            @csrf                             
            <input type="hidden" id="txtId2" name="txtId2" value="{{$docente->id}}" >       
            <div class="row  justify-content-center p-2">
                <div class="col-md-6 px-2 justify-content-center  text-left">
                    <label for="" class="form-label ml-2">Nombre</label>
                    <input id="name" name="name" type="text" class="form-control" tabindex="1" maxlength="50" title="nombre" required value="{{$docente->name}}">
                </div>
                <div class="col-md-6 px-2  justify-content-center text-left">
                    <label for="" class="form-label ml-2 ">Correo electrónico</label>
                    <input id="email" name="email" type="email" class="form-control text-lowercase" tabindex="2" maxlength="80" title="Email" required value="{{$docente->email}}">
                </div>  
            </div>
            <button type="submit" class="btn btn-warning" id="btnActualizar" name="btnActualizar"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                            <!-- Modal ACTUALIZAAAANDO-->
                <div class="modal fade" id="actualizarD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h5 class="modal-title text-center" id="exampleModalLabel">Actualizando Datos...</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body justify-content-center justify-self-center text-center">
                                <div id="girarD" class="lds-dual-ring col-md-12"></div> 
                            </div>
                        </div>
                    </div>
                </div>
        </form>
        @endforeach
<!--cambiar foto-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <i class="fa fa-pencil-square-o  mr-3 lead  text-dark" aria-hidden="true"></i>       
            <a class="navbar-brand font-weight-bold text-warning" href="#">Imagen de usuario</a>
        </nav>
        <form id="avatarForm" action="{{url('/user/changeImage')}}" method="POST" enctype="multipart/form-data" class="p-4">
            @csrf  
            <div class="row justify-content-center p-2">
                <div class="col-md-6 px-2  justify-content-center text-left">
                    <label for="" class="form-label ml-2 ">Imagen</label>
                    <input id="photo" name="photo" type="file" class="form-control" tabindex="15" required>
                </div>
                @if(is_null(auth()->user()->imagen))
                                <img src="{{asset('users').'/'.'defecto.jpg'}}" alt="imagen-usuario" id="fotoUsuario2" class="p-0">
                                @else
                                <img src="{{asset('users').'/'.auth()->user()->id.'.'.auth()->user()->imagen}}" alt="imagen-usuario" id="fotoUsuario2" class="p-0">
                                @endif                                                   
            </div>
            <button type="submit" class="btn btn-warning" tile="Crear docente"><i class="fa fa-pencil mr-2" aria-hidden="true"></i> Cambiar Foto</button>
        </form>
        <script>//actualizar cambios realizados
                
                $('#datosDocente').submit(function(e){
                    e.preventDefault();
                    var id_doc2=$('#txtId2').val();
                    var name2=$('#name').val();
                    var email2=$('#email').val();
                    var _token2=$("input[name=_token]").val(); 
                    $.ajax({
                                url:"{{route('user.actualizarUsuario')}}",
                                type:"POST",
                                data:{
                                        id_doc:id_doc2,            
                                        name:name2,
                                        email:email2,
                                        _token:_token2
                                },
                                beforeSend:function(){
                                    $('#actualizarD').modal('show');
                                    $('#btnActualizar').text('Actualizando..'); 
                                    $('#girarD').show(); 
                                },
                                success:function(response)
                                {
                                
                                    if(response)
                                    {
                                        
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                        $('#btnActualizar').text('Guardar cambios'); 
                                        $('#girarD').hide(); 
                                        $('#actualizarD').modal('hide');
                                    }
                                },
                                error : function(response){
                                            toastr.warning('Ocurrio un error intente nuevamente','¡FALLIDA!',{timeOut:3000});
                                            toastr.warning('Verifique el correo, puede ser que ya exista usuario,','¡FALLIDA!',{timeOut:5000});
                                }
                            });
                    
                })
            </script>
            <script>//cambiar foto
                $(document).ready(function(){
                    
                    var $avatarInput,$avatarImage,$avatarForm,$avatarUrl;
                    $(function(){
                        $avatarInput=$('#photo');
                        $avatarImage=$('#fotoUsuario2');
                        $avatarForm=$('#avatarForm');

                       // $avatarImage.on('click',function(){
                           // $avatarInput.click();
                        //});
                        
                        $avatarUrl=$avatarForm.attr('action');
                        $('#avatarForm').submit(function(e){

                            e.preventDefault();
                           //peticion ajax al cambiar dato del input
                           var formData=new FormData();
                           formData.append('photo',$avatarInput[0].files[0]);
                           $.ajax({
                               url:$avatarUrl+'?'+$avatarForm.serialize(),
                               method:'POST',
                               data:formData,
                               processData:false,
                               contentType:false,
                               beforeSend:function(){
                                    $('#actualizarD').modal('show');
                                    $('#btnActualizar').text('Actualizando..'); 
                                    $('#girarD').show(); 
                                }
                           })
                           
                           .done(function(data){
                               if(data.success)
                               {
                                toastr.success('La imagen fue cambiada exitosamente se refrescara pagina en 3 seg','¡EXITOSO!',{timeOut:3000});
                                $avatarImage.attr('src','users/'+data.path+'?'+new Date().getTime());
                                $('#actualizarD').modal('hide');
                                $('#btnActualizar').text('Guardar cambios'); 
                                $('#girarD').hide(); 
                                setTimeout(function(){
                                    window.location.reload();
                                },3000);
                               // window.location.reload();
                                }
                           })
                           .fail(function(){
                                $('#actualizarD').modal('hide');
                                $('#btnActualizar').text('Guardar cambios'); 
                                $('#girarD').hide(); 
                                toastr.warning('El campo imagen esta vacio o el archivo subido no es una imagen','¡FALLIDA!',{timeOut:3000});
                               
                                        
                           });

                        });
                    });
                });
            </script>
            
        <body>
</html>

