<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/docente.css')}}" rel="stylesheet">
        <link href="{{asset('css/datosDocente.css')}}" rel="stylesheet">
        <title>Cursos</title>
    </head>
    <body>
        <div class="container-fluid p-2"><!--digeneral-->    
            <nav class="navbar navbar-expand-lg navbar-light bg-light p-2">
                            <i class="fa fa-pencil-square-o  mr-3 lead  text-DARK" aria-hidden="true"></i>
                            <a class="navbar-brand font-weight-bold  text-warning" href="#">Datos docente</a>
            </nav>
            <!-- <h3 class="py-3" >Nuevo docente</h3-->
            @foreach ($docentes as $docente)
            <form id="datosDocente" class="py-4">
                @csrf                             
                <input type="hidden" id="txtId2" name="txtId2" value="{{$docente->id_doc}}" >       
                <div class="row  justify-content-center p-2">
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 ">Cédula</label>
                        <input id="cedula" name="cedula" type="text" class="form-control" tabindex="1" maxlength="10" title="cedula" required value="{{$docente->cedula_doc}}" >    
                    </div>
                    <div class="col-md-6 px-2 justify-content-center  text-left">
                        <label for="" class="form-label ml-2">Nombre</label>
                        <input id="name" name="name" type="text" class="form-control" tabindex="2" maxlength="50" title="nombre" required value="{{$docente->name}}">
                    </div>
                </div>
                <div class="row justify-content-center p-2">
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 ">Apellido</label>
                        <input id="apellido" name="apellido" type="text" class="form-control" tabindex="3" maxlength="80" title="apellido"  required value="{{$docente->apellido_doc}}">
                    </div>
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 ">Lugar de nacimiento</label>
                        <input id="lugarNacimiento" name="lugarNacimiento" type="text" class="form-control" tabindex="4" title="Lugar de nacimiento"  maxlength="100" required value="{{$docente->lugarnacimiento_doc}}">
                    </div>
                </div>
                <div class="row justify-content-center p-2">
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 ">Fecha de nacimiento</label>
                        <input id="fechaNacimiento" name="fechaNacimiento" type="date" class="form-control" tabindex="5" title="Fecha de nacimiento" max="2004-01-01" required value="{{$docente->fechanacimiento_doc}}">
                    </div>
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 ">Dirección</label>
                        <input id="direccion" name="direccion" type="text" class="form-control" tabindex="6" maxlength="80" title="Direccion" required value="{{$docente->direccion_doc}}">
                    </div>                                              
                </div>
                <div class="row justify-content-center p-2">
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 ">Celular</label>
                        <input id="celular" name="celular" type="text" class="form-control" tabindex="7" maxlength="15" title="Celular"  required value="{{$docente->celular_doc}}">
                    </div>
                    <div class="col-md-6 px-2  justify-content-center text-left">
                    <label for="" class="form-label ml-2 ">Correo electrónico</label>
                    <input id="email" name="email" type="email" class="form-control text-lowercase" tabindex="8" maxlength="80" title="Email" required value="{{$docente->email}}">
                    </div>                                  
                </div>
                <div class="row justify-content-center p-2">
                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                        <label for="select">Etnia</label>
                        <select title="seleccionar etnia" class="form-control" id="selEtnia" name="selEtnia" tabindex="9" title="selecionar etnia" required >
                        @if($docente->etnia_doc=="Afroecuatoriano")
                            <option selected value="Afroecuatoriano">Afroecuatoriano</option>
                        @else
                            <option value="Afroecuatoriano">Afroecuatoriano</option> 
                        @endif
                        @if($docente->etnia_doc=="Blanco")
                            <option selected value="Blanco">Blanco</option>
                        @else
                            <option value="Blanco">Blanco</option>
                        @endif   
                        @if($docente->etnia_doc=="Indígena")
                            <option selected value="Indígena">Indígena</option>
                        @else
                            <option value="Indígena">Indígena</option>
                        @endif
                        @if($docente->etnia_doc=="Mestizo")
                            <option selected value="Mestizo">Mestizo</option>
                        @else
                            <option value="Mestizo">Mestizo</option>
                        @endif   
                        @if($docente->etnia_doc=="Montubio")
                            <option selected value="Montubio">Montubio</option>
                        @else
                            <option value="Montubio">Montubio</option>
                        @endif
                        </select>
                    </div>
                    @if($docente->sexo_doc=="Masculino")
                    <div class="col-md-6 px-2  justify-content-center text-left">
                            <label for="" class="form-label ml-2 ">Sexo</label>
                            <div class="col-md-6 mb-3">
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" id="rdGeneroMasculino" name="rdGenero" value="Masculino" tabindex="10" title="opcion sexo masculino" checked >
                                        <label class="Masculino" >Masculino</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="rdGeneroFemenino" name="rdGenero" value="Femenino" tabindex="11" title="opcion sexo femenino" >
                                        <label class="Masculino" >Femenino</label>
                                    </div>
                            </div>
                    </div>
                    @else
                        <div class="col-md-6 px-2  justify-content-center text-left">
                                <label for="" class="form-label ml-2 ">Sexo</label>
                                <div class="col-md-6 mb-3">
                                        <div class="custom-control custom-radio ">
                                            <input type="radio" id="rdGeneroMasculino" name="rdGenero" value="Masculino" tabindex="10" title="opcion sexo masculino">
                                            <label class="Masculino" >Masculino</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="rdGeneroFemenino" name="rdGenero" value="Femenino" tabindex="11" title="opcion sexo femenino"  checked >
                                            <label class="Masculino" >Femenino</label>
                                        </div>
                                </div>
                        </div>           
                    @endif                                                   
                </div>
                <div class="row pb-2">                                                    
                    <div class="col-md-6 px-2  justify-content-center text-left">
                        <label for="" class="form-label ml-2 ">Instrucción</label>
                        <input id="instruccion" name="instruccion" type="text" class="form-control" tabindex="12" maxlength="100" title="Instrucción"  required value="{{$docente->instruccion_doc}}">
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
                        <input id="photo" name="photo" type="file" class="form-control" tabindex="15">
                    </div>
                    @if(is_null(auth()->user()->imagen))
                                    <img src="{{asset('users').'/'.'defecto.jpg'}}" alt="imagen-usuario" id="fotoUsuario2" class="p-0">
                                    @else
                                    <img src="{{asset('users').'/'.auth()->user()->id.'.'.auth()->user()->imagen}}" alt="imagen-usuario" id="fotoUsuario2" class="p-0">
                                    @endif                                          
                </div>
                <button type="submit" class="btn btn-warning" tile="Crear docente"><i class="fa fa-pencil mr-2" aria-hidden="true"></i> Cambiar Foto</button>
            </form>
        </div>
        <script>//actualizar cambios realizados
                
                $('#datosDocente').submit(function(e){

                    e.preventDefault();
                    var id_doc2=$('#txtId2').val();
                    var cedula_doc2=$('#cedula').val();
                    var name2=$('#name').val();
                    var apellido_doc2 =$('#apellido').val();
                    var lugarnacimiento_doc2=$('#lugarNacimiento').val();
                    var fechanacimiento_doc2=$('#fechaNacimiento').val();
                    var direccion_doc2=$('#direccion').val();
                    var celular_doc2 =$('#celular').val();
                    var email2=$('#email').val();
                    var etnia_doc2=$('#selEtnia').val();
                    var sexo_doc2=$("input[name='rdGenero']:checked").val();
                    var instruccion_doc2=$('#instruccion').val();
                    var _token2=$("input[name=_token]").val(); 
                    
                    $.ajax({
                                url:"{{route('docentes.actualizarM')}}",
                                type:"POST",
                                data:{
                                        id_doc:id_doc2, 
                                        cedula_doc:cedula_doc2,
                                        name:name2,
                                        apellido_doc:apellido_doc2,
                                        lugarnacimiento_doc:lugarnacimiento_doc2,
                                        fechanacimiento_doc:fechanacimiento_doc2,
                                        direccion_doc:direccion_doc2,
                                        celular_doc:celular_doc2,
                                        email:email2,
                                        etnia_doc:etnia_doc2,
                                        sexo_doc:sexo_doc2,
                                        instruccion_doc:instruccion_doc2,
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

