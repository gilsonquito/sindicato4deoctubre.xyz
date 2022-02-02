<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Asistencia Estudiante</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Asistencia de estudiante</a>
                    </nav>
                    <div class="container-fuid"> 
                            <div class="tab-content" id="myTabContent">
                                <div class="row justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="" class="form-label ml-2 text-nowrap">Periodo acádemico</label>
                                                                        <select class="form-control" id="selPeridoAcademicos" name="selPeridoAcademicos" tabindex="3" required>
                                                                            <option selected="true" disabled="disabled" value="">Elija un período acádemico</option>
                                                                            @foreach ($periodosacademicos as $periodosaca)
                                                                            <option value="{{$periodosaca->id}}">Desde {{$periodosaca->fechaini}}&nbsp;Hasta {{$periodosaca->fechafin}}&nbsp;/ Licencia tipo&nbsp;{{$periodosaca->nombre_tipolicencia}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                </div>               
                            </div>                             
                    </div><!--finc container--> 
                    <div class="p-2" id="tablacontenido">
                    </div> 
            </div><!--digeneral-->        
            <script>
                 $(document).ready(function(){
                    $('#selPeridoAcademicos').on('change', function(e){//cargar periodo de horarios
                        var idperiodo = e.target.value;
                        $.ajax({
                                url:'/asistenciaEstudiante/tablaAsistencia/'+idperiodo,               
                                success : function(data){
                                    setTimeout(function(){
                                        $('#tablacontenido').empty().append($(data));
                                    }
                                    );
                                }
                        });
                    }); 
                });
            </script>
    <body>
</html>

