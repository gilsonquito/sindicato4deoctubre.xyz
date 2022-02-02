<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Actas de calificaciones</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Actas de calificaciones</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item"  >
                                        <a class=" nav-link active" id="notas-tab" data-toggle="tab" href="#notas" role="tab" aria-controls="notas" aria-selected="true"><i class="fa fa-pencil-square-o text-success mr-2" aria-hidden="true"></i>Notas Actas</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                    <!--subir actas-->
                                    <div class="tab-pane fade show active" id="notas" role="notas" aria-labelledby="notas-tab">
                                            <form id="actasSubir_Form">
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Subir Actas</label> 
                                                        <select class="form-control" id="SelPeriodoAcademico4" name="SelPeriodoAcademico4" tabindex="1" tile="Seleccione período académico" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="p-2 py-2">
                                                    <button type="submit" class="btn btn-secondary" id="btnEditarAsistencia" name="btnEditarAsistencia"><i class="fa fa-search mr-2" aria-hidden="true"></i>Consultar notas</button>
                                                </div>
                                            </form>
                                            <div class="row justify-content-start" >
                                                    <div class="py-3 col-md-2 align-self-start">
                                                        <button  id="descargarActa" type="submit" class="btn btn-secondary w-100"  onclick="descargarActas()" target="_blank" disabled><i class="fa fa-download mr-2"></i>Descargar</button>
                                                    </div>
                                            </div>
                                            <div id="seccionNotasActas">
                                            </div>
                                    </div>
                            </div><!--finc tab content-->                   
                    </div><!--finc container--> 
                </div><!--digeneral--> 
                <script>
                    $(document).ready(function(){  
               
                            $.get('/secretaria/asistenciasEstudiantesSe/selectPeriodosSecretaria',function(data) {
                                    $('#SelPeriodoAcademico4').empty();
                                    $('#SelPeriodoAcademico4').append('<option value="" disabled="true" selected="true">Elija un período acádemico</option>');
                                    $.each(data, function(fetch, regenciesObj){
                                        $('#SelPeriodoAcademico4').append('<option value="'+ regenciesObj.id +'">'+"Desde "+ regenciesObj.fechaini +" Hasta "+ regenciesObj.fechafin+" Licencia tipo "+ regenciesObj.nombre_tipolicencia+'</option>');
                                    })   
                        });  
                    }); 
                </script>
                <script>
                     $('#actasSubir_Form').submit(function(e){
                        e.preventDefault();  
                        var id=$('#SelPeriodoAcademico4').val();
                        $.ajax({
                                url:'/secretaria/tablaActasEstudiantes/'+id,
                                    success : function(data){
                                        setTimeout(function(){
                                                $('#seccionNotasActas').empty().append($(data));
                                        });
                                        document.getElementById('descargarActa').disabled=false;
                                    }

                        });
                        //document.getElementById('descarhorario').disabled=false;
                        
                    })
                </script>
                <script>
                     function descargarActas()
                     { 
                        var id=$('#SelPeriodoAcademico4').val();
                        window.open("/secretaria/descargarActaNotas/"+id)
                        
                    }
                </script>
               
    <body>
</html>

