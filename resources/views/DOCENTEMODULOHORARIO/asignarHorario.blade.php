<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/asignar.css')}}" rel="stylesheet">
        <title>Nueva Asignación de horario</title>
    </head>
    <body>
            <div class="container-fluid p-2">
                <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                            <a class="navbar-brand text-success" href="#">Nueva asignación de horario</a>
                </nav>
            
                                   <!-- <h3 class="py-3" >Nuevo docente</h3-->
                                      <form id="ingreso-asignacionhorario"   enctype="multipart/form-data">
                                  <!--{!! Form::open([ 'url'=> 'docentes', 'method'=>'POST', 'id'=> 'ingreso-docente', 'files'=>'true'] ) !!}-->
                                            @csrf
                                                        <div class="row justify-content-center p-2">
                                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                    <label for="" class="form-label ml-2 text-nowrap">Docente</label>
                                                                    <select class="form-control" id="selDocentes" name="selDocentes" tabindex="1" required>
                                                                        <option selected="true" disabled="disabled" value="">Elija un docente</option>
                                                                        @foreach ($docentes as $docente)
                                                                            <option value="{{$docente->id_doc}}">{{$docente->name}}&nbsp;{{$docente->apellido_doc}}&nbsp;/&nbsp;{{$docente->cedula_doc}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                    <label for="" class="form-label text-nowrap">Modulos/Cursos</label>
                                                                        <select class="form-control" id="selModulosCursos" name="selModulosCursos" tabindex="2" required>
                                                                            <option selected="true" disabled="disabled" value="">Elija un módulo/curso</option>
                                                                        </select>
                                                                </div>
                                                        </div>
                                                        <div class="row justify-content-center p-2">
                                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                    <label for="" class="form-label ml-2 text-nowrap">Periodo acádemico</label>
                                                                    <select class="form-control" id="selPeridoAca" name="selPeridoAca" tabindex="3" required>
                                                                        <option selected="true" disabled="disabled" value="">Elija un período acádemico</option>
                                                                        @foreach ($periodoscademicos as $periodocademico)
                                                                            <option value="{{$periodocademico->id}}">{{$periodocademico->fechaini}}&nbsp;{{$periodocademico->fechafin}}&nbsp;/&nbsp;{{$periodocademico->nombre_tipolicencia}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                    <label for="" class="form-label text-nowrap">Período de horario</label>
                                                                        <select class="form-control" id="selPeriodoHorario" name="selPeriodoHorario" tabindex="2" required>
                                                                            <option selected="true" disabled="disabled" value="">Elija un mini período para horario</option>
                                                                        </select>
                                                                </div>
                                                        </div>                                                    
                                                        <div class="row justify-content-center p-2">
                                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                <label for="select">Horarios</label>
                                                                <select class="form-control" id="selHorarios" name="selHorarios" tabindex="2" required>
                                                                        @foreach ($horarios as $horario)
                                                                            <option value="{{ $horario['id_horario'] }}">{{ $horario['tipo_dias'] }}&nbsp;{{ $horario['hora_inicio'] }}&nbsp;{{ $horario['hora_fin'] }}</option>
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                        </div>                                                    
                                                        <input type="hidden" id="rol" name="rol" value="3">
                                                        <button type="submit" class="btn btn-success btn-lg" tile="Crear docente"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Asignar Horario</button>
                                    </form>
                                    <!--{!! Form::close() !!}-->
            </div>
        <script >//cargar select dinamicos 
            $('#selDocentes').on('change', function(e){//caragr docentes
               
                var docente = e.target.value;

                $.get('/docentemodulohorario/cargarmodulos/'+docente,function(data) {

                        $('#selModulosCursos').empty();
                        $('#selModulosCursos').append('<option value="" disabled="true" selected="true">Eliga un modulo/curso</option>');
                        $.each(data, function(fetch, regenciesObj){
                           
                            $('#selModulosCursos').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod +" / Tipo "+ regenciesObj.nombre_tlic+" "+regenciesObj.jornada+" "+regenciesObj.modalidad+" "+regenciesObj.nombre_paralelo+'</option>');
                        })
                        
                });
            });
            $('#selPeridoAca').on('change', function(e){//cargar periodo de horarios
                
                var periodoid = e.target.value;
                
                $.get('/docentemodulohorario/cargarminiperiodos/'+periodoid,function(data) {
                        $('#selPeriodoHorario').empty();
                        $('#selPeriodoHorario').append('<option value="" disabled="true" selected="true">Elija un mini período para horario</option>');
                        $.each(data, function(fetch, regenciesObj){
                            
                            $('#selPeriodoHorario').append('<option value="'+ regenciesObj.id_phorario +'">'+ regenciesObj.fecha_inicio +" / "+ regenciesObj.fecha_fin+'</option>');
                        })
                        
                });
            });
        </script>
        <script> //ingresar und nueva asignacion
              
              $('#ingreso-asignacionhorario').submit(function(e){
                  e.preventDefault();
                   var id_doc_mod2=$('#selModulosCursos').val();
                   var id_horario2=$('#selHorarios').val();
                   var id_phorario2=$('#selPeriodoHorario').val();
                   var id_periodo=$('#selPeridoAca').val();
                   
                   var _token=$("input[name=_token]").val(); 
                        $.ajax({
                                   url:"{{route('docentemodulohorario.ingresar')}}",
                                   type:"POST",
                                   async: true,
                                   data:{
                                        id_doc_mod:id_doc_mod2,
                                        id_horario:id_horario2,
                                        id_phorario:id_phorario2,
                                        id_periodo:id_periodo,
                                       _token:_token
                                   },
                                   success:function(response)
                                   {   
                                       if(response==1)
                                       {                                         
                                           $('#ingreso-asignacionhorario')[0].reset();
                                          toastr.success('El ingreso fue exitoso','¡EXITOSO!',{timeOut:3000});
                                       }
                                       if(response==2)
                                       {
                                           toastr.warning('El período académico seleccionado a culminado','¡FALLIDA!',{timeOut:3000});
                                       }
                                   },
                                   error : function(response){
                                       toastr.error('Ocurrio un error, La asignaciond de horario ¡YA EXISTE!','¡FALLIDA!',{timeOut:3000});
                                   }
                               }); 
                   
                   
               })
               
       </script>
 
    <body>
</html>

