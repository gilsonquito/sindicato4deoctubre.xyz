<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Asistencia de estudiantes por módulo</title>
    </head>
    <body>
            <div class="container-fluid p-2 "><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Asistencia de estudiantes por módulo</a>
                    </nav>
                    <div class="container-fuid">
                                    <form id="reporteAsistencia_Form">
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione período académico</label>
                                                        <select class="form-control" id="SelPeriodoAcademico" name="SelPeriodoAcademico" tabindex="1" tile="Seleccione periodo acadeemico" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione curso</label>
                                                        <select class="form-control" id="SelCursos" name="SelCursos" tabindex="2" tile="Seleccione curso" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un curso</option>    
                                                        </select>
                                                    </div>    
                                                </div>
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione módulo</label>
                                                        <select class="form-control" id="SelModulos" name="SelModulos" tabindex="3" tile="Seleccione periodo acadeemico" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un módulo</option>
                                                        </select>
                                                    </div>   
                                                </div>
                                                <div class="p-2">
                                                    <button type="submit" class="btn btn-success" id="btnCrearAsistencia" name="btnCrearAsistencia"><i class="fa fa-search mr-2" aria-hidden="true"></i>Consultar Asistencias</button>
                                                </div>
                                    </form> 
                                    <div class="row justify-content-start" >
                                        <div class="py-3 col-md-2 align-self-start">
                                            <button  id="descarReporteAsistencia" type="submit" class="btn btn-success w-100"  onclick="descargarAsistenciasModulos()" target="_blank" disabled><i class="fa fa-download mr-2"></i>Descargar</button>
                                        </div>
                                    </div>        
                                    <div id="SeccionAsistencias" class="p-4">
                                    </div>   
                </div><!--digeneral--> 
            <script>
                $(document).ready(function(){  
                    $.get('/secretaria/asistenciasEstudiantesSe/selectPeriodosSecretaria',function(data) {
                                    $('#SelPeriodoAcademico').empty();
                                    $('#SelPeriodoAcademico').append('<option value="" disabled="true" selected="true">Elija un período acádemico</option>');
                                    $.each(data, function(fetch, regenciesObj){
                                        $('#SelPeriodoAcademico').append('<option value="'+ regenciesObj.id +'">'+"Desde "+ regenciesObj.fechaini +" Hasta "+ regenciesObj.fechafin+" Licencia tipo "+ regenciesObj.nombre_tipolicencia+'</option>');
                                    })   
                            });     
                            $('#SelModulos').empty();
                            $('#SelModulos').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');    
                            $('#SelCursos').empty();
                            $('#SelCursos').append('<option value="" disabled="true" selected="true">Elija un curso</option>');   
                    $('#SelPeriodoAcademico').on('change', function(e){//cargar  cursos
                        //$("#descarhorario").attr('disabled','disabled');
                        $('#SelModulos').empty();
                        $('#SelModulos').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                        var periodoacad = e.target.value;
                        $.get('/secretaria/asistenciasEstudiantesSe/selectCursosSecretaria/'+periodoacad,function(data) {
                                $('#SelCursos').empty();
                                $('#SelCursos').append('<option value="" disabled="true" selected="true">Elija un curso</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelCursos').append('<option value="'+ regenciesObj.id_curlic +'">'+"Licencia tipo "+ regenciesObj.nombre_tlic +" / "+ regenciesObj.jornada+" / "+ regenciesObj.modalidad+" / "+ regenciesObj.duracion_meses+" meses "+" / Paralelo "+ regenciesObj.nombre_paralelo+'</option>');
                                })          
                        });    
                    });
                    $('#SelCursos').on('change', function(e){//cargar  modulos
                        //$("#descarhorario").attr('disabled','disabled');
                        var curso = e.target.value;
                        var periodoA = $('#SelPeriodoAcademico').val();
                        $.get('/secretaria/asistenciasEstudiantesSe/selectModulosSecretaria/'+periodoA+"/"+curso,function(data) {
                                $('#SelModulos').empty();
                                $('#SelModulos').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelModulos').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod +'</option>');
                                })              
                        });
                    });
                });
            </script>
            <script> //consultar asistencias
                $('#reporteAsistencia_Form').submit(function(e){ 
                    e.preventDefault();
                    var id_periodo=$('#SelPeriodoAcademico').val();
                    var id_curlic=$('#SelCursos').val();
                    var id_doc_mod=$('#SelModulos').val();
                    $.ajax({
                            url:'/secretaria/reporteAsistenciasModulos/'+id_periodo+'/'+id_doc_mod,
                            success : function(data){
                                setTimeout(function(){
                                    $('#SeccionAsistencias').empty().append($(data));
                                }
                                );
                            }
                    });
                    document.getElementById('descarReporteAsistencia').disabled=false;
                })
            </script>
             <script>
                function descargarAsistenciasModulos()
                { 
                    var idP=$('#SelPeriodoAcademico').val();
                    var idDocMod=$('#SelModulos').val();
                    window.open("/secretaria/descargarAsistenciasModulos/"+idP+'/'+idDocMod)      
                }
            </script>
            
    <body>
</html>

