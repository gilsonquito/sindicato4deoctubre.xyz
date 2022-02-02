<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Listado de estudiantes</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Listado de estudiantes</a>
                    </nav>
                    <div class="container-fuid">
                                <!--listado de estudiantes-->
                                <div class="" id="">
                                                <div class="row  justify-content-center p-2">
                                                        
                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="" class="form-label ml-2 text-nowrap">Periodo acádemico</label>
                                                                        <select class="form-control" id="SelPeriodoAcademico" name="SelPeriodoAcademico" tabindex="3" required>
                                                                            <option selected="true" disabled="disabled" value="">Elija un período acádemico</option>
                                                                            @foreach ($periodosaca as $periodocademico)
                                                                                <option value="{{$periodocademico->id}}">Desde {{$periodocademico->fechaini}}&nbsp;Hasta {{$periodocademico->fechafin}}&nbsp;/&nbsp;Licencia tipo {{$periodocademico->nombre_tipolicencia}}</option>
                                                                            @endforeach
                                                                        </select>
                                                        </div>
                                                        <div class="col-md-6 px-2 justify-content-center  text-left">
                                                            <label for="" class="form-label ml-2">Seleccione curso</label>
                                                            <select class="form-control" id="SelCursos" name="SelCursos" tabindex="2" tile="Seleccione curso" required>
                                                                <option selected="true" disabled="disabled" value="">Elija un curso</option>    
                                                            </select>
                                                        </div>    
                                                </div>
                                                <hr>
                                                <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                                                    <a class="navbar-brand text-dark" href="#">Listado de estudiantes</a>
                                                </nav>
                                                <div id="tabla-listaEstudiantes">
                                                </div>
                                    <!--</form>-->
                                    <!--fin del formulario d eingreso-->
                                </div>   
                            </div>                               
                    </div><!--finc container--> 
            </div><!--digeneral-->  
            
            <script>
                $(document).ready(function(){    
                    $('#SelPeriodoAcademico').on('change', function(e){//cargar  cursos
                        //$("#descarhorario").attr('disabled','disabled');
                        var periodoacad = e.target.value;
                        $.get('/listaEstudiantes/selectCursosEstudiantes/'+periodoacad,function(data) {
                                $('#SelCursos').empty();
                                $('#SelCursos').append('<option value="" disabled="true" selected="true">Elija un curso</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelCursos').append('<option value="'+ regenciesObj.id_curlic +'">'+"Licencia tipo "+ regenciesObj.nombre_tlic +" / "+ regenciesObj.jornada+" / "+ regenciesObj.modalidad+" / "+ regenciesObj.duracion_meses+" meses "+" / Paralelo "+ regenciesObj.nombre_paralelo+'</option>');
                                })          
                        });
                        $.ajax({
                            url:'/listaEstudiantes/tablaEstudiantesPeriodos/'+periodoacad,
                                success : function(data){
                                    setTimeout(function(){
                                        $('#tabla-listaEstudiantes').empty().append($(data));
                                    }
                                    );
                                }
                        });                                                         
                    });
                    $('#SelCursos').on('change', function(e){//cargar  modulos
                        var curso = e.target.value;
                        var periodoA = $('#SelPeriodoAcademico').val();
                        $.ajax({
                            url:'/listaEstudiantes/tablaEstudiantesPeriodosCursos/'+periodoA+"/"+curso,
                                success : function(data){
                                    setTimeout(function(){
                                        $('#tabla-listaEstudiantes').empty().append($(data));
                                    }
                                    );
                                }
                        });      
                    });

                    
                });
            </script>
         
            
        
    <body>
</html>

