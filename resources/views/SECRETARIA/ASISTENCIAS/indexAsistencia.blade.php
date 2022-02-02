<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Asistencias de estudiante</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Asistencias de estudiante</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item " onclick="cargarSelectPeriodos2()">
                                        <a class=" nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i class="fa fa-search text-success mr-2" aria-hidden="true"></i>Consultar Asistencias</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                <!--editar asistencia-->
                                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <form id="editarAsistencia_Form">
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione período académico</label>
                                                        <select class="form-control" id="SelPeriodoAcademico3" name="SelPeriodoAcademico3" tabindex="1" tile="Seleccione periodo acadeemico" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione curso</label>
                                                        <select class="form-control" id="SelCursos3" name="SelCursos3" tabindex="2" tile="Seleccione curso" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un curso</option>    
                                                        </select>
                                                    </div>    
                                                </div>
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione módulo</label>
                                                        <select class="form-control" id="SelModulos3" name="SelModulos3" tabindex="3" tile="Seleccione modulo" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un módulo</option>
                                                        </select>
                                                    </div>  
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Eliga Estudiante</label>
                                                        <select class="form-control" id="SelEstudiante" name="SelEstudiante" tabindex="4" tile="Seleccione estudiante" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un estudiante</option>
                                                        </select>
                                                    </div>  
                                                </div>
                                                <div class="p-2">
                                                    <button type="submit" class="btn btn-success" id="btnEditarAsistencia" name="btnEditarAsistencia"><i class="fa fa-search mr-2" aria-hidden="true"></i>Consultar Asistencias</button>
                                                </div>
                                            </form>
                                            <div id="SeccionEditarAsistencia">
                                            </div>
                                    </div>    
                            </div><!--finc tab content-->                   
                    </div><!--finc container--> 
                </div><!--digeneral--> 
            <script>
                $(document).ready(function(){  
                    $.get('/secretaria/asistenciasEstudiantesSe/selectPeriodosSecretaria',function(data) {
                                    $('#SelPeriodoAcademico3').empty();
                                    $('#SelPeriodoAcademico3').append('<option value="" disabled="true" selected="true">Elija un período acádemico</option>');
                                    $.each(data, function(fetch, regenciesObj){
                                        $('#SelPeriodoAcademico3').append('<option value="'+ regenciesObj.id +'">'+"Desde "+ regenciesObj.fechaini +" Hasta "+ regenciesObj.fechafin+" Licencia tipo "+ regenciesObj.nombre_tipolicencia+'</option>');
                                    })   
                            });     
                            $('#SelModulos3').empty();
                            $('#SelModulos3').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');    
                            $('#SelCursos3').empty();
                            $('#SelCursos3').append('<option value="" disabled="true" selected="true">Elija un Curso</option>');  
                    $('#SelPeriodoAcademico3').on('change', function(e){//cargar  cursos
                        //$("#descarhorario").attr('disabled','disabled');
                        $('#SelModulos3').empty();
                        $('#SelModulos3').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                        $('#SelEstudiante').empty();
                        $('#SelEstudiante').append('<option value="" disabled="true" selected="true">Elija un estudiante</option>');
                        var periodoacad = e.target.value;
                        $.get('/secretaria/asistenciasEstudiantesSe/selectCursosSecretaria/'+periodoacad,function(data) {
                                $('#SelCursos3').empty();
                                $('#SelCursos3').append('<option value="" disabled="true" selected="true">Elija un curso</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelCursos3').append('<option value="'+ regenciesObj.id_curlic +'">'+"Licencia tipo "+ regenciesObj.nombre_tlic +" / "+ regenciesObj.jornada+" / "+ regenciesObj.modalidad+" / "+ regenciesObj.duracion_meses+" meses "+" / Paralelo "+ regenciesObj.nombre_paralelo+'</option>');
                                })          
                        });
                        
                    });
                    $('#SelCursos3').on('change', function(e){//cargar  modulos
                        //$("#descarhorario").attr('disabled','disabled');
                        var curso = e.target.value;
                        var periodoA = $('#SelPeriodoAcademico3').val();
                        $('#SelEstudiante').empty();
                        $('#SelEstudiante').append('<option value="" disabled="true" selected="true">Elija un estudiante</option>');
                        $.get('/secretaria/asistenciasEstudiantesSe/selectModulosSecretaria/'+periodoA+"/"+curso,function(data) {
                                $('#SelModulos3').empty();
                                $('#SelModulos3').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelModulos3').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod +'</option>');
                                })              
                        });
                        
                    });
                    $('#SelModulos3').on('change', function(e){//cargar  modulos
                        //$("#descarhorario").attr('disabled','disabled');
                        var DocMod = e.target.value;
                        var curso = $('#SelCursos3').val();
                        var periodoA = $('#SelPeriodoAcademico3').val();
                        $.get('/secretaria/asistenciasEstudiantesSe/selectEstudiantes/'+periodoA+"/"+curso+"/"+DocMod,function(data) {
                                $('#SelEstudiante').empty();
                                $('#SelEstudiante').append('<option value="" disabled="true" selected="true">Elija un estudiante</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelEstudiante').append('<option value="'+ regenciesObj.id_est +'">'+ regenciesObj.apellido_est +" "+ regenciesObj.name_est +'</option>');
                                })              
                        });
                        
                    });
                });
            </script>
            
          
             <script> //editar asistencia
                $('#editarAsistencia_Form').submit(function(e){ 
                    e.preventDefault();
                    var id_periodo=$('#SelPeriodoAcademico3').val();
                    var id_curlic=$('#SelCursos3').val();
                    var id_doc_mod=$('#SelModulos3').val();
                    var id_est=$('#SelEstudiante').val();
                    $.ajax({
                        url:'/secretaria/asistenciasEstudiantesSe/tablaAsistenciaEstudiantesSecretaria/'+id_periodo+"/"+id_est+"/"+id_doc_mod,
                            success : function(data){
                                setTimeout(function(){
                                    $('#SeccionEditarAsistencia').empty().append($(data));
                                }
                                );
                            }
                    });
                })
            </script>
    <body>
</html>

