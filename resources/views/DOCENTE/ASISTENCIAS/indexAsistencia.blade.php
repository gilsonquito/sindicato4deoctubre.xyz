<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Asistencia de estudiantes</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Asistencia de estudiantes</a>
                    </nav>
                    <div class="container-fuid">
                          
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item" onclick="cargarSelectPeriodos()">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Crear Asistencias</a>
                                    </li>
                                    <li class="nav-item" onclick="cargarSelectPeriodos2()">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-search text-success mr-2" aria-hidden="true"></i>Consultar Asistencias</a>
                                    </li>
                                    <li class="nav-item" onclick="cargarSelectPeriodos3()" >
                                        <a class=" nav-link" id="editar-tab" data-toggle="tab" href="#editar" role="tab" aria-controls="editar" aria-selected="false"><i class="fa fa-trash text-danger mr-2" aria-hidden="true"></i>Eliminar Asistencia</a>
                                    </li>
                                    <li class="nav-item" onclick="cargarSelectPeriodos4()" >
                                        <a class=" nav-link" id="reporte-tab" data-toggle="tab" href="#reporte" role="tab" aria-controls="reporte" aria-selected="false"><i class="fa fa-file-pdf-o text-dark mr-2" aria-hidden="true"></i>Reporte Asistencias</a>
                                    </li>
                                    <li class="nav-item" onclick="cargarSelectPeriodos5()" >
                                        <a class=" nav-link" id="porcentaje-tab" data-toggle="tab" href="#porcentaje" role="tab" aria-controls="porcentaje" aria-selected="false"><i class="fa fa-percent text-success mr-2" aria-hidden="true"></i> Asistencias</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent"><!--ingrsar  nueva asistencia-->
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <form id="crearAsistencia_Form">
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
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Fecha de Asistencia</label>
                                                        <input id="dateFechaAsistencia" name="dateFechaAsistencia" type="date" class="form-control" tabindex="4" required >
                                                    </div>  
                                                </div>
                                                <div class="p-2">
                                                    <button type="submit" class="btn btn-success" id="btnCrearAsistencia" name="btnCrearAsistencia"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Crear Asistencia</button>
                                                </div>
                                            </form>
                                                
                                            <div id="SeccionAsistencia">

                                            </div>
                                </div>
                                <!--editar asistencia-->
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                                        <select class="form-control" id="SelModulos3" name="SelModulos3" tabindex="3" tile="Seleccione periodo acadeemico" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un módulo</option>
                                                        </select>
                                                    </div>  
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Fecha de Asistencia</label>
                                                        <input id="dateFechaAsistencia3" name="dateFechaAsistencia3" type="date" class="form-control" tabindex="4" required >
                                                    </div>  
                                                </div>
                                                <div class="p-2">
                                                    <button type="submit" class="btn btn-success" id="btnEditarAsistencia" name="btnEditarAsistencia"><i class="fa fa-search mr-2" aria-hidden="true"></i>Consultar Asistencia</button>
                                                </div>
                                            </form>
                                                
                                            <div id="SeccionEditarAsistencia">

                                            </div>
                                    </div>    
                                    <!--eliminar asistencia-->
                                    <div class="tab-pane fade" id="editar" role="tabpanel" aria-labelledby="editar-tab">
                                        <form id="eliminarAsistencia_Form">
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione período académico</label>
                                                        
                                                        <select class="form-control" id="SelPeriodoAcademico4" name="SelPeriodoAcademico4" tabindex="1" tile="Seleccione periodo acadeemico" required>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione curso</label>
                                                        <select class="form-control" id="SelCursos4" name="SelCursos4" tabindex="2" tile="Seleccione curso" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un curso</option>    
                                                        </select>
                                                    </div>    
                                                </div>
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione módulo</label>
                                                        <select class="form-control" id="SelModulos4" name="SelModulos4" tabindex="3" tile="Seleccione periodo acadeemico" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un módulo</option>
                                                        </select>
                                                    </div>  
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Fecha de Asistencia</label>
                                                        <input id="dateFechaAsistencia4" name="dateFechaAsistencia4" type="date" class="form-control" tabindex="4" required >
                                                    </div>  
                                                </div>
                                                <div class="p-2">
                                                    <button type="submit" class="btn btn-outline-danger" id="btnEliminarAsistencia" name="btnEliminarAsistencia"><i class="fa fa-trash mr-2" aria-hidden="true"></i>Eliminar Asistencias</button>
                                                </div>
                                            </form>
                                    </div> <!--fin seccion tab-->
                                    <!--reporte asistencia-->
                                    <div class="tab-pane fade" id="reporte" role="tabpanel" aria-labelledby="reporte-tab">
                                        <form id="reporteAsistencia_Form">
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione período académico</label>
                                                        <select class="form-control" id="SelPeriodoAcademico5" name="SelPeriodoAcademico5" tabindex="1" tile="Seleccione periodo acadeemico" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione curso</label>
                                                        <select class="form-control" id="SelCursos5" name="SelCursos5" tabindex="2" tile="Seleccione curso" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un curso</option>    
                                                        </select>
                                                    </div>    
                                                </div>
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione módulo</label>
                                                        <select class="form-control" id="SelModulos5" name="SelModulos5" tabindex="3" tile="Seleccione periodo acadeemico" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un módulo</option>
                                                        </select>
                                                    </div>  
                                                </div>
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Desde</label>
                                                        <input id="dateInicioAsistencia5" name="dateInicioAsistencia5" type="date" class="form-control" tabindex="4" required >
                                                    </div>   
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Hasta</label>
                                                        <input id="dateFinAsistencia5" name="dateFinAsistencia5" type="date" class="form-control" tabindex="5" required >
                                                    </div>  
                                                </div>
                                                <div class="p-2">
                                                    <button type="submit" class="btn btn-warning" id="btnReporteAsistencia" name="btnReporteAsistencia"><i class="fa fa-file-pdf-o mr-2" aria-hidden="true"></i>Generar Reporte</button>
                                                </div>
                                            </form>
                                    </div> 
                                    <!--porcentajes asistencias-->
                                    <div class="tab-pane fade" id="porcentaje" role="tabpanel" aria-labelledby="porcentaje-tab">
                                        <form id="porcentajeAsistencia_Form">
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione período académico</label>
                                                        <select class="form-control" id="SelPeriodoAcademico6" name="SelPeriodoAcademico6" tabindex="1" tile="Seleccione periodo acadeemico" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione curso</label>
                                                        <select class="form-control" id="SelCursos6" name="SelCursos6" tabindex="2" tile="Seleccione curso" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un curso</option>    
                                                        </select>
                                                    </div>    
                                                </div>
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione módulo</label>
                                                        <select class="form-control" id="SelModulos6" name="SelModulos6" tabindex="3" tile="Seleccione periodo acadeemico" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un módulo</option>
                                                        </select>
                                                    </div>  
                                                </div>
                                                <div class="p-2">
                                                    <button type="submit" class="btn btn-warning" id="btnPorcentajeAsistencia" name="btnPorcentajeAsistencia"><i class="fa fa-percent mr-2" aria-hidden="true"></i>Porcentaje Asistencias</button>
                                                </div>
                                            </form>
                                    </div> <!--fin porcentaje-->
                            </div><!--finc tab content-->                   
                    </div><!--finc container--> 
                </div><!--digeneral--> 
            
            <script>
                $(document).ready(function(){  
                    $.get('/asistenciaEstudiante/selectPeriodos',function(data) {
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
                        $.get('/asistenciaEstudiante/selectCursos/'+periodoacad,function(data) {
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
                        $.get('/asistenciaEstudiante/selectModulos/'+periodoA+"/"+curso,function(data) {
                                $('#SelModulos').empty();
                                $('#SelModulos').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelModulos').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod +'</option>');
                                })              
                        });
                        
                    });
                    $('#SelPeriodoAcademico3').on('change', function(e){//cargar  cursos
                        //$("#descarhorario").attr('disabled','disabled');
                        $('#SelModulos3').empty();
                        $('#SelModulos3').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                        var periodoacad = e.target.value;
                        $.get('/asistenciaEstudiante/selectCursos/'+periodoacad,function(data) {
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
                        $.get('/asistenciaEstudiante/selectModulos/'+periodoA+"/"+curso,function(data) {
                                $('#SelModulos3').empty();
                                $('#SelModulos3').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelModulos3').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod +'</option>');
                                })              
                        });
                        
                    });
                    $('#SelPeriodoAcademico4').on('change', function(e){//cargar  cursos
                        //$("#descarhorario").attr('disabled','disabled');
                        $('#SelModulos4').empty();
                        $('#SelModulos4').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                        var periodoacad = e.target.value;
                        $.get('/asistenciaEstudiante/selectCursos/'+periodoacad,function(data) {
                                $('#SelCursos4').empty();
                                $('#SelCursos4').append('<option value="" disabled="true" selected="true">Elija un curso</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelCursos4').append('<option value="'+ regenciesObj.id_curlic +'">'+"Licencia tipo "+ regenciesObj.nombre_tlic +" / "+ regenciesObj.jornada+" / "+ regenciesObj.modalidad+" / "+ regenciesObj.duracion_meses+" meses "+" / Paralelo "+ regenciesObj.nombre_paralelo+'</option>');
                                })          
                        });
                        
                    });
                    $('#SelCursos4').on('change', function(e){//cargar  modulos
                        //$("#descarhorario").attr('disabled','disabled');
                        var curso = e.target.value;
                        var periodoA = $('#SelPeriodoAcademico4').val();
                        $.get('/asistenciaEstudiante/selectModulos/'+periodoA+"/"+curso,function(data) {
                                $('#SelModulos4').empty();
                                $('#SelModulos4').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelModulos4').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod +'</option>');
                                })              
                        });
                    });
                    $('#SelPeriodoAcademico5').on('change', function(e){//cargar  cursos
                        //$("#descarhorario").attr('disabled','disabled');
                        $('#SelModulos5').empty();
                        $('#SelModulos5').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                        var periodoacad = e.target.value;
                        $.get('/asistenciaEstudiante/selectCursos/'+periodoacad,function(data) {
                                $('#SelCursos5').empty();
                                $('#SelCursos5').append('<option value="" disabled="true" selected="true">Elija un curso</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelCursos5').append('<option value="'+ regenciesObj.id_curlic +'">'+"Licencia tipo "+ regenciesObj.nombre_tlic +" / "+ regenciesObj.jornada+" / "+ regenciesObj.modalidad+" / "+ regenciesObj.duracion_meses+" meses "+" / Paralelo "+ regenciesObj.nombre_paralelo+'</option>');
                                })          
                        });
                        
                    });
                    $('#SelCursos5').on('change', function(e){//cargar  modulos
                        //$("#descarhorario").attr('disabled','disabled');
                        var curso = e.target.value;
                        var periodoA = $('#SelPeriodoAcademico5').val();
                        $.get('/asistenciaEstudiante/selectModulos/'+periodoA+"/"+curso,function(data) {
                                $('#SelModulos5').empty();
                                $('#SelModulos5').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelModulos5').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod +'</option>');
                                })              
                        });
                    });
                    $('#SelPeriodoAcademico6').on('change', function(e){//cargar  cursos
                        //$("#descarhorario").attr('disabled','disabled');
                        $('#SelModulos6').empty();
                        $('#SelModulos6').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                        var periodoacad = e.target.value;
                        $.get('/asistenciaEstudiante/selectCursos/'+periodoacad,function(data) {
                                $('#SelCursos6').empty();
                                $('#SelCursos6').append('<option value="" disabled="true" selected="true">Elija un curso</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelCursos6').append('<option value="'+ regenciesObj.id_curlic +'">'+"Licencia tipo "+ regenciesObj.nombre_tlic +" / "+ regenciesObj.jornada+" / "+ regenciesObj.modalidad+" / "+ regenciesObj.duracion_meses+" meses "+" / Paralelo "+ regenciesObj.nombre_paralelo+'</option>');
                                })          
                        });
                        
                    });
                    $('#SelCursos6').on('change', function(e){//cargar  modulos
                        //$("#descarhorario").attr('disabled','disabled');
                        var curso = e.target.value;
                        var periodoA = $('#SelPeriodoAcademico6').val();
                        $.get('/asistenciaEstudiante/selectModulos/'+periodoA+"/"+curso,function(data) {
                                $('#SelModulos6').empty();
                                $('#SelModulos6').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelModulos6').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod +'</option>');
                                })              
                        });
                    });
                });
            </script>
            <script>
                  function cargarSelectPeriodos(){//cargar periodos academicos
                            //asignar valores a select periodos
                            $.get('/asistenciaEstudiante/selectPeriodos',function(data) {
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
                    }
                    function cargarSelectPeriodos2(){//cargar periodos academicos
                            //asignar valores a select periodos
                            $.get('/asistenciaEstudiante/selectPeriodos',function(data) {
                                    $('#SelPeriodoAcademico3').empty();
                                    $('#SelPeriodoAcademico3').append('<option value="" disabled="true" selected="true">Elija un período acádemico</option>');
                                    $.each(data, function(fetch, regenciesObj){
                                        $('#SelPeriodoAcademico3').append('<option value="'+ regenciesObj.id +'">'+"Desde "+ regenciesObj.fechaini +" Hasta "+ regenciesObj.fechafin+" Licencia tipo "+ regenciesObj.nombre_tipolicencia+'</option>');
                                    })   
                            });     
                            $('#SelModulos3').empty();
                            $('#SelModulos3').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');    
                            $('#SelCursos3').empty();
                            $('#SelCursos3').append('<option value="" disabled="true" selected="true">Elija un curso</option>');           
                    }
                    function cargarSelectPeriodos3(){//cargar periodos academicos
                            //asignar valores a select periodos
                            $.get('/asistenciaEstudiante/selectPeriodos',function(data) {
                                    $('#SelPeriodoAcademico4').empty();
                                    $('#SelPeriodoAcademico4').append('<option value="" disabled="true" selected="true">Elija un período acádemico</option>');
                                    $.each(data, function(fetch, regenciesObj){
                                        $('#SelPeriodoAcademico4').append('<option value="'+ regenciesObj.id +'">'+"Desde "+ regenciesObj.fechaini +" Hasta "+ regenciesObj.fechafin+" Licencia tipo "+ regenciesObj.nombre_tipolicencia+'</option>');
                                    })   
                            });     
                            $('#SelModulos4').empty();
                            $('#SelModulos4').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');    
                            $('#SelCursos4').empty();
                            $('#SelCursos4').append('<option value="" disabled="true" selected="true">Elija un curso</option>');           
                    }
                    function cargarSelectPeriodos4(){//cargar periodos academicos
                            //asignar valores a select periodos
                            $.get('/asistenciaEstudiante/selectPeriodos',function(data) {
                                    $('#SelPeriodoAcademico5').empty();
                                    $('#SelPeriodoAcademico5').append('<option value="" disabled="true" selected="true">Elija un período acádemico</option>');
                                    $.each(data, function(fetch, regenciesObj){
                                        $('#SelPeriodoAcademico5').append('<option value="'+ regenciesObj.id +'">'+"Desde "+ regenciesObj.fechaini +" Hasta "+ regenciesObj.fechafin+" Licencia tipo "+ regenciesObj.nombre_tipolicencia+'</option>');
                                    })   
                            });     
                            $('#SelModulos5').empty();
                            $('#SelModulos5').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');    
                            $('#SelCursos5').empty();
                            $('#SelCursos5').append('<option value="" disabled="true" selected="true">Elija un curso</option>');           
                    }
                    function cargarSelectPeriodos5(){//cargar periodos academicos
                            //asignar valores a select periodos
                            $.get('/asistenciaEstudiante/selectPeriodos',function(data) {
                                    $('#SelPeriodoAcademico6').empty();
                                    $('#SelPeriodoAcademico6').append('<option value="" disabled="true" selected="true">Elija un período acádemico</option>');
                                    $.each(data, function(fetch, regenciesObj){
                                        $('#SelPeriodoAcademico6').append('<option value="'+ regenciesObj.id +'">'+"Desde "+ regenciesObj.fechaini +" Hasta "+ regenciesObj.fechafin+" Licencia tipo "+ regenciesObj.nombre_tipolicencia+'</option>');
                                    })   
                            });     
                            $('#SelModulos6').empty();
                            $('#SelModulos6').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');    
                            $('#SelCursos6').empty();
                            $('#SelCursos6').append('<option value="" disabled="true" selected="true">Elija un curso</option>');           
                    }
                    
            </script>
          
             <script> //ingresar nueva asistencia
                $('#crearAsistencia_Form').submit(function(e){ 
                    e.preventDefault();
                    var id_periodo=$('#SelPeriodoAcademico').val();
                    var id_curlic=$('#SelCursos').val();
                    var id_doc_mod=$('#SelModulos').val();
                    var fecha_asistencia=$('#dateFechaAsistencia').val();
                   
                    var _token=$("input[name=_token]").val();
                            $.ajax({
                                    url:"/asistenciaEstudiante/crearAsistencia",
                                    type:"POST",
                                    async: true,
                                    data:{
                                        id_periodo:id_periodo,
                                        id_curlic:id_curlic,
                                        id_doc_mod:id_doc_mod,
                                        fecha_asistencia:fecha_asistencia,
                                        _token:_token
                                    },
                                    success:function(response)
                                    {   
                                        if(response)
                                        {
                                            if(response==2)
                                            {
                                                toastr.warning('La fecha ingresada esta fuera del rango del Período Académico Seleccionado','¡AVISO!',{timeOut:3000});
                                            }
                                            else{
                                                if(response==3)
                                                {
                                                    toastr.warning('La fecha actual esta fuera del rango del Período Académico seleccionado','FALLIDO!',{timeOut:3000});
                                                }
                                                else{
                                                    //$('#crearAsistencia_Form')[0].reset();
                                                    toastr.success('El registro fue exitoso','¡EXITOSO!',{timeOut:2000});
                                                    $.ajax({
                                                        url:'/asistenciaEstudiante/tablaAsistenciaEstudiantes/'+id_periodo+"/"+fecha_asistencia+"/"+id_doc_mod,
                                                            success : function(data){
                                                                setTimeout(function(){
                                                                    $('#SeccionAsistencia').empty().append($(data));
                                                                }
                                                                );
                                                            }
                                                    });
                                                    
                                                }
                                            }
                                        }
                                        else{
                                            toastr.warning('YA existe la asistencia de la fecha seleccionada','¡AVISO!',{timeOut:3000});
                                        }
                                    },
                                    error : function(response){
                                        toastr.error('No se realizo el registro','¡ERROR!',{timeOut:2000});
                                    }
                                });
                })

            </script>
             <script> //editar asistencia
                $('#editarAsistencia_Form').submit(function(e){ 
                    e.preventDefault();
                    var id_periodo=$('#SelPeriodoAcademico3').val();
                    var id_curlic=$('#SelCursos3').val();
                    var id_doc_mod=$('#SelModulos3').val();
                    var fecha_asistencia=$('#dateFechaAsistencia3').val();
                    $.ajax({
                        url:'/asistenciaEstudiante/tablaAsistenciaEstudiantes/'+id_periodo+"/"+fecha_asistencia+"/"+id_doc_mod,
                            success : function(data){
                                setTimeout(function(){
                                    $('#SeccionEditarAsistencia').empty().append($(data));
                                }
                                );
                            }
                    });
                })

            </script>
             <script> //eliminar asistencia
                $('#eliminarAsistencia_Form').submit(function(e){ 
                    e.preventDefault();
                    var id_periodo=$('#SelPeriodoAcademico4').val();
                    var id_curlic=$('#SelCursos4').val();
                    var id_doc_mod=$('#SelModulos4').val();
                    var fecha_asistencia=$('#dateFechaAsistencia4').val();
                    $.ajax({
                            url:"/asistenciaEstudiante/eliminarAsistencia/"+id_periodo+"/"+fecha_asistencia+"/"+id_doc_mod,
                            success:function(data){
                                if(data)
                                {
                                    if(data==2)
                                    {
                                        toastr.warning('NO se puede eliminar la asistencia de la fecha seleccionada una vez haya culminado el período académico','¡FALLIDA!',{timeOut:3000});
                                     
                                    }
                                    if(data==3)
                                    {
                                       
                                        toastr.success('Se elimino asistencia de la fecha Seleccionada','¡EXITOSO!',{timeOut:1000});
                                    }
                                }
                                else
                                {
                                    toastr.warning('NO existe asistencia en la fecha seleccionada','¡FALLIDA!',{timeOut:2000});
                                    //toastr.warning('NO se puede eliminar la asistencia de la fecha seleccionada una vez haya culminado el período académico','¡FALLIDA!',{timeOut:3000});
                                }
                            },
                            error : function(response){
                                    toastr.error('Ocurrio un error, vuelva a intentarlo','¡FALLIDA!',{timeOut:2000});
                            }
                        });
                })

            </script>
            <script> //reporte asistencia
                $('#reporteAsistencia_Form').submit(function(e){ 
                    e.preventDefault();
                    var id_periodo=$('#SelPeriodoAcademico5').val();
                    var id_doc_mod=$('#SelModulos5').val();
                    var fechainicio=$('#dateInicioAsistencia5').val();
                    var fechafin=$('#dateFinAsistencia5').val();
                    if(fechafin<fechainicio)
                    {   
                       
                        toastr.warning('Ingrese una Fecha Final MAYOR a la Fecha de Inicio','¡ERROR!',{timeOut:2000});
                    }
                    else{
                        $.ajax({
                            url:"/asistenciaEstudiante/reporteAsistenciaContador/"+id_periodo+"/"+id_doc_mod+"/"+fechainicio+"/"+fechafin,
                            success:function(data){
                                if(data)
                                {
                                    window.open("/asistenciaEstudiante/reporteAsistencia/"+id_periodo+"/"+id_doc_mod+"/"+fechainicio+"/"+fechafin, '_blank'); 
                                }
                                else
                                {
                                    toastr.warning('NÚMERO MAXIMO 20 asistencias elija un rango de fechas menor','¡FALLIDA!',{timeOut:3000});
                                    
                                }
                            },
                            error : function(response){
                                    toastr.error('Ocurrio un error, vuelva a intentarlo','¡FALLIDA!',{timeOut:2000});
                            }
                        });
                    } 
                });
            </script>
             <script> //porcentaje de asistencias
                $('#porcentajeAsistencia_Form').submit(function(e){ 
                    e.preventDefault();
                    var id_periodo=$('#SelPeriodoAcademico6').val();
                    var id_doc_mod=$('#SelModulos6').val();
                       
                    window.open("/asistenciaEstudiante/porcentajeAsistencia/"+id_periodo+"/"+id_doc_mod, '_blank'); 
                              
                });
            </script>
    <body>
</html>

