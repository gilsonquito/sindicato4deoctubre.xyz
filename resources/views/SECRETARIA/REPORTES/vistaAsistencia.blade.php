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
                        <a class="navbar-brand text-success" href="#">Reporte de Asistencias de Estudiantes</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item ">
                                        <a class=" nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i class="fa fa-table text-success mr-2" aria-hidden="true"></i>Reporte de Asistencias</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                <!--editar asistencia-->
                                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <form id="asistencia_Form">
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione período académico</label>
                                                        <select class="form-control" id="SelPeriodoAcademico3" name="SelPeriodoAcademico3" tabindex="1" tile="Seleccione periodo acadeemico" required>
                                                        </select>
                                                    </div> 
                                                </div>
                                                <div class="p-2">
                                                    <button type="submit" class="btn btn-success" id="btnEditarAsistencia" name="btnEditarAsistencia"><i class="fa fa-search mr-2" aria-hidden="true"></i>Consultar Asistencias</button>
                                                </div>
                                            </form>
                                            <div class="row justify-content-start" >
                                                <div class="py-3 col-md-2 align-self-start">
                                                    <button  id="descargarReporteAsistencia" type="submit" class="btn btn-success w-100"  onclick="descargarAsistencias()" target="_blank" disabled><i class="fa fa-download mr-2"></i>Descargar</button>
                                                </div>
                                            </div> 
                                            <div id="SeccionAsistencias">
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
                        
                    }); 
                </script>
                 <script>
                    function descargarAsistencias()
                    { 
                        var idP=$('#SelPeriodoAcademico3').val();
                        window.open("/secretaria/descargarAsistencias/"+idP)      
                    }
                </script>
                 <script> //consultar asistencias
                    $('#asistencia_Form').submit(function(e){ 
                        e.preventDefault();
                        var id_periodo=$('#SelPeriodoAcademico3').val();
                        $.ajax({
                                url:'/secretaria/reporteAsistencias/'+id_periodo,
                                success : function(data){
                                    setTimeout(function(){
                                        $('#SeccionAsistencias').empty().append($(data));
                                    }
                                    );
                                }
                        });
                        document.getElementById('descargarReporteAsistencia').disabled=false;
                    })
                </script>
    <body>
</html>

