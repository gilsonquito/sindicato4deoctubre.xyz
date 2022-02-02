<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/asignar.css')}}" rel="stylesheet">
        <title>Nueva Asignación</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                            <a class="navbar-brand text-success" href="#">Nueva asignación de Docente/Módulo</a>
                </nav>
            </div>
                                 <!-- <h3 class="py-3" >Nuevo docente</h3-->
                                      <form id="ingreso-docentemodulo"   enctype="multipart/form-data">
                                  <!--{!! Form::open([ 'url'=> 'docentes', 'method'=>'POST', 'id'=> 'ingreso-docente', 'files'=>'true'] ) !!}-->
                                            @csrf
                                                        <div class="row  justify-content-center p-2">
                                                            <div class="form-group col-md-6 px-2  justify-content-center text-left text-truncate">
                                                                <label for="select">Modulo</label>
                                                                <select class="form-control" data-container="body" id="selModulos" name="selModulos" tabindex="1" required>
                                                                    @foreach ($modulos as $modulo)
                                                                        <option class=""value="{{ $modulo['id_mod'] }}">{{ $modulo['nombre_mod'] }}</option>
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                <label for="select">Docente</label>
                                                                <select class="form-control" id="selDocentes" name="selDocentes" tabindex="2" required>
                                                                    @foreach ($docentes as $docente)
                                                                        <option value="{{ $docente['id_doc'] }}">{{ $docente['apellido_doc'] }}&nbsp;{{ $docente['name'] }}-{{ $docente['cedula_doc'] }}</option>
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center p-2">
                                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                <label for="select"> Curso/Tipo de Licencia</label>
                                                                <select class="form-control" id="selCursos" name="selCursos" tabindex="3" required>
                                                                        @foreach ($cursos as $curso)
                                                                            <option value="{{ $curso->id_curlic }}">{{ $curso->nombre_tlic }}&nbsp;{{ $curso->jornada }}&nbsp;{{ $curso->modalidad }}&nbsp;/&nbsp; {{ $curso->nombre_paralelo }}</option>
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="rol" name="rol" value="3">
                                                        <button type="submit" class="btn btn-success btn-lg" tile="Crear docente"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Crear nueva asignación</button>
                                    </form>
                                    <!--{!! Form::close() !!}-->
                                </div>
        <script> //ingresar und nueva asignacion
              
              $('#ingreso-docentemodulo').submit(function(e){
                
                  e.preventDefault();
                   var id_mod=$('#selModulos').val();
                   var id_doc=$('#selDocentes').val();
                   var id_curlic =$('#selCursos').val();
                   
                   var _token=$("input[name=_token]").val(); 
                  
                        $.ajax({
                                   url:"{{route('docentemodulo.ingresar')}}",
                                   type:"POST",
                                   async: true,
                                   data:{
                                       id_mod:id_mod,
                                       id_doc:id_doc,
                                       id_curlic:id_curlic,
                                       _token:_token
                                   },
                                   success:function(response)
                                   {   
                                       if(response)
                                       {    
                                           if(response==1)   
                                           {
                                            $('#ingreso-docentemodulo')[0].reset();
                                            toastr.success('El ingreso fue exitoso','¡EXITOSO!',{timeOut:3000});
                                            $('#tabla-docentemodulo').DataTable().ajax.reload();
                                           }                                  
                                           if(response==2)   
                                           {
                                            $('#ingreso-docentemodulo')[0].reset();
                                            toastr.warning('YA EXISTE LA ASIGNACION INGRESADA','FALLIDA!',{timeOut:3000});
                                           } 
                                         
                                       }
                                       else{
                                           toastr.error('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                       }
                                   },
                                   
                                   error : function(response){
                                       toastr.error('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                   }
                               }); 
                   
                   
               })
               
       </script>
 
    <body>
</html>

