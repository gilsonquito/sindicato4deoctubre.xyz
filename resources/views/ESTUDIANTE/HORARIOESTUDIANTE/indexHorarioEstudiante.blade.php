<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/descargarHorario.css')}}" rel="stylesheet">
        <title>Horario estudiante</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Horario de estudiante</a>
                    </nav>
                        <div class="row justify-content-start" >
                            <div class="py-3 col-md-2 align-self-start">
                                <button  id="descarhorario" type="submit" class="btn btn-success w-100"  onclick="descargarHorarrios()" target="_blank" disabled><i class="fa fa-download mr-2"></i>Descargar</button>
                            </div>
                        </div>
                    <div class="container-fuid"> 
                            <div class="tab-content" id="myTabContent">
                                <div class="row justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="" class="form-label ml-2 text-nowrap">Periodo acádemico</label>
                                                                        <select class="form-control" id="selPeridoAcad" name="selPeridoAcad" tabindex="3" required>
                                                                            <option selected="true" disabled="disabled" value="">Elija el período acádemico</option>
                                                                            @foreach ($periodosa as $periodosaca)
                                                                                <option value="{{$periodosaca->id}}">Desde {{$periodosaca->fechaini}}&nbsp;Hasta {{$periodosaca->fechafin}}&nbsp;/ Licencia tipo&nbsp;{{$periodosaca->nombre_tipolicencia}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="" class="form-label text-nowrap">Período de horario</label>
                                                                            <select class="form-control" id="selPeriodoHorarios" name="selPeriodoHorarios" tabindex="2" required>
                                                                                <option selected="true" disabled="disabled" value="">Elija un mini período para horario</option>
                                                                            </select>
                                                                    </div>
                                </div>               
                            </div>                             
                    </div><!--finc container--> 
                    <div class="p-1" id="tablacontenido">
                    </div> 
            </div><!--digeneral--> 
            <script>
                    $('#selPeriodoHorarios').on('change', function(e){//cargar tabla de horario
                        $("#descarhorario").removeAttr('disabled');
                        var idTabla = e.target.value;
                        $.ajax({
                                url:'/estudianteHorario/cargartablahorarioEst/'+idTabla,
                                success : function(data){
                                    setTimeout(function(){
                                        $('#tablacontenido').empty().append($(data));
                                    }
                                    );
                                }
                            });
                        }); 
            </script>
            <script >//cargar select dinamicos periodo horarios
                 var tperiodohorariog;
                $('#selPeridoAcad').on('change', function(e){//cargar select de periodo de horarios
                    $("#descarhorario").attr('disabled','disabled');
                    var periodoacad = e.target.value;
                    
                    $.get('/estudianteHorario/cargarPerHorariosEst/'+periodoacad,function(data) {
                            $('#selPeriodoHorarios').empty();
                            $('#selPeriodoHorarios').append('<option value="" disabled="true" selected="true">Elija el período del horario</option>');
                            $.each(data, function(fetch, regenciesObj){
                                
                                $('#selPeriodoHorarios').append('<option value="'+ regenciesObj.id_phorario +'">'+"Desde "+ regenciesObj.fecha_inicio +" Hasta "+ regenciesObj.fecha_fin+'</option>');
                            })
                            
                    });
                    
                });
                
                function descargarHorarrios()
                {
                    tperiodohorariog=$('#selPeriodoHorarios').val();
                    window.open('/descargarHorarioEstudiante/'+tperiodohorariog,'_blank');
                }

               
        </script>
       
 
    <body>
</html>

