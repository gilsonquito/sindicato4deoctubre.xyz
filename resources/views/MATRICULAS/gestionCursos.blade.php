<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/gestionCursos.css')}}" rel="stylesheet">
        <title>EstudiantesPorCurso</title>
    </head>
    <body>
        <div id="listaEstudiantes">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Lista de Estudiantes</a>
                    </nav>
                        <form id="form_tabla">
                                <table id="tabla-horariodocente" class="table table-responsive-lg table-hover w-100">
                                        <thead class="font-weight-bold text-center text-dark" >
                                            <td class="col-md-1">#</td>
                                            <td class="col-md-2">Apellidos</td>
                                            <td class="col-md-2">Nombres</td>
                                            <td class="col-md-1">Tipo Licencia</td>
                                            <td class="col-md-1">Paralelo</td>
                                            <td class="col-md-4">Acciones</td>
                                        </thead>
                                        <tbody class="text-center text-dark">         
                                        @php
                                            $i=1;
                                        @endphp  
                                            @foreach ($estudiantes as $estudiante)
                                                <tr>    
                                                   @if($i==1)
                                                        <input type="hidden" id="idPerAcad" name="idPerAcad" value="{{$estudiante->id}}">
                                                    @endIf
                                                    <td class="py-2">{{$i}}</td>
                                                    <td class="py-2">{{$estudiante->apellido_est}}</td>
                                                    <td class="py-2">{{$estudiante->name_est}}</td>
                                                    <td class="py-2">{{$estudiante->nombre_tlic}}</td>
                                                    <td class="py-2">{{$estudiante->nombre_paralelo}}</td>
                                                    <td class="py-2">
                                                    <div class="row justify-content-center">
                                                        <div class="col p-1">
                                                            <a href="javascript:void(0)" onclick="asignarNuevoCurso({{$estudiante->id_est}},{{$estudiante->id_curlic}},{{$estudiante->id}},{{$estudiante->id_matricula}});" class="btn btn btn-secondary btn-sm" title="Cambiar curso">
                                                                <i class="fa fa-pencil-square-o px-2" aria-hidden="true"></i> Cambiar Curso
                                                            </a>
                                                        </div>
                                                    </div>
                                                    </td>  
                                                </tr>
                                                @php
                                                    $i=$i+1;
                                                    
                                                @endphp
                                            @endforeach   
                                        </tbody>
                                </table>
                        </form>
                         <!--------------------------------------------------modal editar ..........................-->
                                    <div class="modal fade " id="cursoEstudiante_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="cursoEstudiante_edit_modala" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="cursoEstudiante_edit_modala">Cambiar curso a estudiante</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="cursoEstudiante_edit_form">
                                                <div class="modal-body">
                                                            @csrf
                                                                <input type="hidden" id="txtIdMatriculaE" name="txtIdMatriculaE">
                                                                <input type="hidden" id="txtIdPeriodoAca" name="txtIdPeriodoAca">
                                                                <input type="hidden" id="txtIdEstudiante" name="txtIdEstudiante">
                                                                <input type="hidden" id="txtIdCur1" name="txtIdCur1">
                                                                <select class="form-control" id="selCursosEditarCu" name="selCursosEditarCu" tabindex="1" required>
                                                                    <option selected="true" disabled="disabled" value="">Elija curso a trasladar</option>
                                                                    @foreach ($cursos as $curso)
                                                                        <option value="{{$curso->id_curlic}}">Licencia tipo {{$curso->nombre_tlic}} / {{$curso->jornada}} / {{$curso->modalidad}} / {{$curso->duracion_meses}} meses / Paralelo {{$curso->nombre_paralelo}} </option>
                                                                    @endforeach
                                                                </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                                    <button type="submit" class="btn btn-success" id="btnActualizarParalelo" name="btnActualizarParalelo"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                                    <div id="girarActualizarParalelo" class="lds-dual-ring col-md-12"></div> 
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
        </div>       
        <script>//CARGAER EN EL FORMULARIO PARA trasladar a curso
                    function asignarNuevoCurso(idEst,idCur,idPe,idMat){
                        //asignar datos recuperados
                        
                        $('#txtIdMatriculaE').val(idMat);
                       $('#txtIdEstudiante').val(idEst);
                        $('#selCursosEditarCu').val(idCur);
                        $('#txtIdPeriodoAca').val(idPe);
                        $('#txtIdCur1').val(idCur);
                        
                        $("input[name=_token]").val();
                        $('#cursoEstudiante_edit_modal').modal('toggle');
                    }
          </script>
          <!--//actualizar datos-->
            <script>
                $('#cursoEstudiante_edit_form').submit(function(e){
                    e.preventDefault();
                    var id_est=$('#txtIdEstudiante').val();
                    var id_curlic=$('#selCursosEditarCu').val();
                    var id_periodoA=$('#txtIdPeriodoAca').val();
                    var id_matricula=$('#txtIdMatriculaE').val();

                    var _token3=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('matriculas.cambiarCursoParaleloEstudiante')}}",
                                type:"POST",
                                data:{
                                    id_est:id_est, 
                                    id_curlic:id_curlic,
                                    id_periodo:id_periodoA,
                                    id_matricula:id_matricula,
                                    _token:_token3
                                },
                                beforeSend:function(){
                                    $('#btnActualizarParalelo').text('Actualizando..'); 
                                    $('#girarActualizarParalelo').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        
                                            var curso1=$('#txtIdCur1').val();
                                            $.ajax({
                                                url:'/matriculas/cambiarCursoEstudiante/'+id_periodoA+'/'+curso1,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#tablaEstudiantes').empty().append($(data));
                                                    }
                                                    );
                                                }
                                            });
                                            toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:2000});
                                            $('#btnActualizarParalelo').text('Guardar cambios'); 
                                            $('#girarActualizarParalelo').hide(); 
                                            $('#cursoEstudiante_edit_modal').modal('hide');
                                        
                                    }
                                    else
                                    {
                                        toastr.warning('EL período académico selecionado a culminado, ¡NADA QUE HACER!','FALLIDA',{timeOut:2000});
                                        $('#btnActualizarParalelo').text('Guardar cambios'); 
                                            $('#girarActualizarParalelo').hide(); 
                                    }
                                },
                                error:function(response)
                                {
                                    
                                    toastr.error('No se actualizaron correctamente los datos','ERROR AL ACTUALIZAR',{timeOut:3000});
                                    $('#btnActualizarParalelo').text('Guardar cambios'); 
                                    $('#girarActualizarParalelo').hide(); 
                                }
                                
                            });
                })
            </script>
        <body>
</html>