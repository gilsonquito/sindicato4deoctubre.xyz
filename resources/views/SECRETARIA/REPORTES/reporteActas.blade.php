<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/actaCalifcicaciones.css')}}" rel="stylesheet">
        <title>Estudiantes</title>
    </head>
    <body>
        <div id="contenidoActualizar" >
                        <form id="form_tabla">
                        <div id="" class="form-inline py-3" >      
                                <div class="col-md-10"> 
                                    <h4 class="">ESCUELA DE FORMACIÓN Y CAPACITACIÓN DE CONDUCTORES PROFESIONALES 4 DE OCTUBRE</h4>
                                    <h4>ACTAS DE GRADO</h4>
                                </div> 
                                <div class="col-md-2 text-right">
                                    <img src="{{asset('image/logoempresa_exel.png')}}" alt="Logo del sindicato de choferes de penipe" class="img-fluid " id="logo" >
                                </div> 
                        </div>
                            @php
                                $idCurso=""; 
                            @endphp 
                            @foreach ($cursosLista as $curso)
                                @if($curso->id_curlic!=$idCurso)
                                    <div class="border"><h5>PARALELO {{$curso->nombre_paralelo}}</h5></div>
                                    <table id="tabla-horariodocente" class="table table-bordered table-responsive table-hover w-100">
                                            <thead class="font-weight-bold text-center text-dark" >
                                                <tr>
                                                    <td class="align-middle" rowspan="2">#</td>
                                                    <td class="align-middle" rowspan="2">Apellidos</td>
                                                    <td class="align-middle" colspan="7">Notas</td>
                                                    <td class="align-middle" rowspan="2">PROMEDIO</td>
                                                    <td class="align-middle" rowspan="2"></td>
                                                    <td class="align-middle" rowspan="2">Calificar</td>
                                                </tr>
                                                <tr>
                                                    <td >LEY Y REGLAMENTO DE TRÁNSITO</td>
                                                    <td >EDUCACIÓN VIAL</td>
                                                    <td >MECÁNICA BÁSICA</td>
                                                    <td >SUMATORIA</td>
                                                    <td >PROMEDIO GRADO TEÓRICO</td>
                                                    <td >GRADO PRÁCTICO CONDUCCIÓN</td>
                                                    <td >PROMEDIO MÓDULOS</td>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center text-dark align-middle">         
                                            @php
                                                $i=1; 
                                                $sumPromedioGeneral=0;
                                            @endphp  
                                                @foreach ($estudiantes as $estudiante)
                                                    @if($estudiante->id_curlic==$curso->id_curlic)
                                                        @php
                                                            $sumatoria=0;
                                                        @endphp  
                                                        <tr>    
                                                        @if($i==1)
                                                                <input type="hidden" id="idCurLic" name="idCurLic" value="{{$estudiante->id_curlic}}">
                                                                <input type="hidden" id="idPerAcad" name="idPerAcad" value="{{$estudiante->id}}">
                                                            @endIf
                                                                <td class="py-2 align-middle">{{$i}}</td>
                                                                <td class="py-2 align-middle">{{$estudiante->apellido_est}} {{$estudiante->name_est}}</td>
                                                            @if($estudiante->nota_ley_reglamento)
                                                                <td class="py-2 align-middle">{{$estudiante->nota_ley_reglamento}}</td>
                                                                @php
                                                                    $sumatoria=$sumatoria+$estudiante->nota_ley_reglamento;
                                                                @endphp 
                                                            @else
                                                                <td class="py-2 align-middle">--</td>
                                                            @endIf
                                                            @if($estudiante->nota_educacion_vial)
                                                                <td class="py-2 align-middle">{{$estudiante->nota_educacion_vial}}</td>
                                                                @php
                                                                    $sumatoria=$sumatoria+$estudiante->nota_educacion_vial;
                                                                @endphp
                                                            @else
                                                                <td class="py-2 align-middle">--</td>
                                                            @endIf
                                                            @if($estudiante->nota_mecanica_basica)
                                                                <td class="py-2 align-middle">{{$estudiante->nota_mecanica_basica}}</td>
                                                                @php
                                                                    $sumatoria=$sumatoria+$estudiante->nota_mecanica_basica;
                                                                @endphp
                                                            @else
                                                                <td class="py-2 align-middle">--</td>
                                                            @endIf
                                                            <td class="py-2 align-middle">{{$sumatoria}}</td>
                                                            <td class="py-2  align-middle">
                                                                @php
                                                                    $promTeorico=$sumatoria/3;
                                                                    $promTeoricoTotal=bcdiv($promTeorico, '1', 0);
                                                                @endphp
                                                                @if(($promTeorico-$promTeoricoTotal)>=0.5)
                                                                    @php
                                                                        $promTeoricoTotal=$promTeoricoTotal+1;
                                                                    @endphp
                                                                @endif
                                                                @php
                                                                    $sumPromedioGeneral=$sumPromedioGeneral+$promTeoricoTotal;
                                                                @endphp
                                                                {{$promTeoricoTotal}}
                                                            </td>
                                                            @if($estudiante->nota_grado_practico)
                                                                <td class="py-2 align-middle">{{$estudiante->nota_grado_practico}}</td>
                                                                @php
                                                                    $sumPromedioGeneral=$sumPromedioGeneral+$estudiante->nota_grado_practico
                                                                @endphp
                                                            @else
                                                                <td class="py-2 align-middle">--</td>
                                                            @endIf
                                                            <td class="py-2 align-middle">
                                                                @php
                                                                    $contModulos=0;
                                                                @endphp    
                                                                                                    @php
                                                                                                        $modulos="";   
                                                                                                    @endphp
                                                                                                            @foreach ($estudiantesNotas as $estudianteMod)
                                                                                                                @if(($estudiante->id_curlic==$estudianteMod->id_curlic)&&($estudianteMod->id_mod!=$modulos))
                                                                                                                    @php
                                                                                                                        $contModulos= $contModulos+1;
                                                                                                                    @endphp
                                                                                                                @endif
                                                                                                                @php
                                                                                                                    $modulos=$estudianteMod->id_mod;    
                                                                                                                @endphp
                                                                                                            @endforeach  
                                                                                                    @php
                                                                                                        $contFilas=0;
                                                                                                    @endphp         
                                                                                                            @php
                                                                                                                
                                                                                                                $PromedioTotal=0;
                                                                                                            @endphp  
                                                                                                                @foreach ($estudiantesNotas as $estudianteNota)
                                                                                                                    @if($estudianteNota->id_est==$estudiante->id_est)
                                                                                                                        @php
                                                                                                                            $sum=0;
                                                                                                                            $sum2=0;
                                                                                                                        @endphp  
                                                                                                                            @if($estudianteNota->nota_trabajo_equipo)
                                                                                                                            @else
                                                                                                                            @endIf
                                                                                                                            @if($estudianteNota->nota_estudio_caso)
                                                                                                                            @else
                                                                                                                            @endIf
                                                                                                                            @if($estudianteNota->nota_prueba_practica)
                                                                                                                            @else
                                                                                                                            @endIf
                                                                                                                            @if($estudianteNota->nota_prueba_teorica)
                                                                                                                            @else
                                                                                                                            @endIf
                                                                                                                                @php
                                                                                                                                    $sum2=($estudianteNota->nota_trabajo_equipo+$estudianteNota->nota_estudio_caso+$estudianteNota->nota_prueba_practica+$estudianteNota->nota_prueba_teorica)/4;
                                                                                                                                    $total1=bcdiv($sum2, '1', 2);
                                                                                                                                @endphp
                                                                                                                            @if(($estudianteNota->nota_suspenso))
                                                                                                                            @else
                                                                                                                            @endIf
                                                                                                                                @if(($estudianteNota->nota_suspenso==null))
                                                                                                                                    @php
                                                                                                                                    $sum=($estudianteNota->nota_trabajo_equipo+$estudianteNota->nota_estudio_caso+$estudianteNota->nota_prueba_practica+$estudianteNota->nota_prueba_teorica)/4;
                                                                                                                                    $total2=bcdiv($sum, '1', 2);
                                                                                                                                    $PromedioTotal=$PromedioTotal+$total2;
                                                                                                                                    @endphp
                                                                                                                                    @if($total2>=16)
                                                                                                                                    @else
                                                                                                                                    @endif
                                                                                                                                @else
                                                                                                                                    @php
                                                                                                                                        $sum=((($estudianteNota->nota_trabajo_equipo+$estudianteNota->nota_estudio_caso+$estudianteNota->nota_prueba_practica+$estudianteNota->nota_prueba_teorica)/4)+($estudianteNota->nota_suspenso))/(2);
                                                                                                                                        $total2=bcdiv($sum, '1', 2);
                                                                                                                                        $PromedioTotal=$PromedioTotal+$total2;
                                                                                                                                    @endphp
                                                                                                                                    @if($total2>=16)
                                                                                                                                    @else
                                                                                                                                    @endif
                                                                                                                                @endIf
                                                                                                                    @endIf
                                                                                                                @endforeach  
                                                                                                                    @if($contModulos>0)
                                                                                                                        @php
                                                                                                                            $PromMod=$PromedioTotal/$contModulos; 
                                                                                                                            $totalPromedio=bcdiv($PromMod, '1', 0);
                                                                                                                            $mayor=$PromMod-$totalPromedio;
                                                                                                                        @endphp
                                                                                                                    @else
                                                                                                                        @php
                                                                                                                            $PromMod=$PromedioTotal/1; 
                                                                                                                            $totalPromedio=bcdiv($PromMod, '1', 0);
                                                                                                                            $mayor=$PromMod-$totalPromedio;
                                                                                                                        @endphp
                                                                                                                    @endif
                                                                                                                    @if($mayor>=0.5)
                                                                                                                        @php
                                                                                                                            $totalPromedio=$totalPromedio+1;
                                                                                                                        @endphp
                                                                                                                    @endif
                                                                                                                    @php
                                                                                                                        $sumPromedioGeneral=$sumPromedioGeneral+$totalPromedio;
                                                                                                                    @endphp
                                                                                                                    @if($totalPromedio>=16)
                                                                                                                        <span class="">{{$totalPromedio}}</span>
                                                                                                                    @else
                                                                                                                        <span class=" text-danger">{{$totalPromedio}}</span>
                                                                                                                    @endif
                                                                        @php
                                                                            $contModulos=0;
                                                                        @endphp  
                                                            </td>
                                                            <td class="py-2 align-middle font-weight-bold">
                                                                @php
                                                                    $promF1=$sumPromedioGeneral/3; 
                                                                    $totalPromedioF=bcdiv($promF1, '1', 0);
                                                                    $mayorF=$promF1-$totalPromedioF;
                                                                @endphp
                                                                @if($mayorF>=0.5)
                                                                    @php
                                                                        $totalPromedioF=$totalPromedioF+1;
                                                                    @endphp
                                                                @endif
                                                                <span>{{$totalPromedioF}}</span>
                                                            </td>  
                                                            <td class="py-2 align-middle">
                                                                @if($totalPromedioF>=16)
                                                                    <span class="text-success">APROBADO</span>
                                                                @else
                                                                    <span class="text-danger">REPROBADO</span>
                                                                @endif
                                                            </td>  
                                                            <td class="py-2 align-middle">
                                                                <a  onclick="subirNota({{$estudiante->id_matricula}})" class="btn btn-warning btn-sm " title="Subir Nota"><i class="fa fa-star-half-o" aria-hidden="true"></i> </a>
                                                            </td>  
                                                        </tr>
                                                        @php
                                                            $i=$i+1;
                                                            $sumPromedioGeneral=0;
                                                        @endphp
                                                    @endIf
                                                @endforeach   
                                            </tbody>
                                    </table>
                                    <br>
                                @endif
                                @php
                                    $idCurso=$curso->id_curlic; 
                                @endphp 
                            @endforeach 
                        </form>
                                 <!--------------------------------------------------modal editar ..........................-->
                                    <!-- Button trigger modal -->
                                        <!-- Modal -->
                                        <div class="modal fade " id="calificar_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header btn-light">
                                                    <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-star-half-o mr-3" aria-hidden="true"></i>Calificar Estudiante</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="calificar_form">
                                                    <div class="modal-body">
                                                            @csrf
                                                            <input type="hidden" id="idNota" name="idNota">
                                                            <input type="hidden" id="idMatr" name="idMatr">
                                                            <input type="hidden" id="idPeriodo" name="idPeriodo">
                                                            <div class="row  justify-content-center p-2">
                                                                <div class="col-md-3 px-2 justify-content-center  text-left">
                                                                    <label for="" class="form-label ml-2"><span class="font-weight-bold">Nota:</span> Ley y Reglamento de Tránsito</label>
                                                                        <input id="notaLeyReglamento" name="notaLeyReglamento" type="text" class="form-control" tabindex="1" maxlength="2" required>
                                                                </div>
                                                                <div class="col-md-3 px-2 justify-content-center  text-left">
                                                                    <label for="" class="form-label ml-2"><span class="font-weight-bold">Nota:</span> Educación Vial</label>
                                                                        <input id="notaEducacionVial" name="notaEducacionVial" type="text" class="form-control" tabindex="2" maxlength="2" required>
                                                                </div>
                                                                <div class="col-md-3 px-2 justify-content-center  text-left">
                                                                    <label for="" class="form-label ml-2"><span class="font-weight-bold">Nota:</span> Mecánica Básica</label>
                                                                        <input id="notaMecanica" name="notaMecanica" type="text" class="form-control" tabindex="3" maxlength="2" required>
                                                                </div>
                                                                <div class="col-md-3 px-2 justify-content-center  text-left">
                                                                    <label for="" class="form-label ml-2"><span class="font-weight-bold">Nota:</span> Grado Práctico Conducción</label>
                                                                        <input id="notaGradoPractico" name="notaGradoPractico" type="text" class="form-control" tabindex="4" maxlength="2" required>
                                                                </div>
                                                            </div> 
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button  type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                                        <button type="submit" class="btn btn-success" id="btnActualizar" name="btnActualizar"><i class="fa fa-arrow-up mr-2" aria-hidden="true"></i>Subir nota</button>
                                                        <div id="girar2" class="lds-dual-ring col-md-12"></div> 
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
        </div> 
        <script>
                    $("#notaLeyReglamento").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });   
                    $("#notaEducacionVial").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });   
                    $("#notaMecanica").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });   
                    $("#notaGradoPractico").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });   
                  
        </script>
        <script>//CARGAER EN EL FORMULARIO PARA EDITAR
            function subirNota(idMat){
                
               
                $.get('/secretaria/mostrarCalificarActa/'+idMat, function(nota)
                {
                    $('#calificar_form')[0].reset();
                    //asignar datos recuperados
                        
                        if(nota[0])
                        { 
                            $('#idNota').val(nota[0].id_nota);
                            $('#notaLeyReglamento').val(nota[0].nota_ley_reglamento);   
                            $('#notaEducacionVial').val(nota[0].nota_educacion_vial);   
                            $('#notaMecanica').val(nota[0].nota_mecanica_basica);   
                            $('#notaGradoPractico').val(nota[0].nota_grado_practico);   
                        }
                        else
                        { 
                            $('#idNota').val("");
                            $('#notaLeyReglamento').val("");   
                            $('#notaEducacionVial').val("");   
                            $('#notaMecanica').val("");   
                            $('#notaGradoPractico').val("");   
                        }
                    $('#idMatr').val(nota.idMatricula);
                    $('#idPeriodo').val(nota.id_periodo);
                    $('#calificar_modal').modal('toggle');
                    $("input[name=_token]").val();
                });
            }
        </script>
           <script>//subir o actualizar nota
                $('#calificar_form').submit(function(e){
                    e.preventDefault();
                    var id_nota2,nota_ley_reglamento2,nota_educacion_vial2,nota_mecanica_basica2,nota_grado_practico2,id_matricula2;
                    id_nota2=$('#idNota').val();
                    nota_ley_reglamento2=$('#notaLeyReglamento').val();
                    nota_educacion_vial2=$('#notaEducacionVial').val();
                    nota_mecanica_basica2=$('#notaMecanica').val();
                    nota_grado_practico2=$('#notaGradoPractico').val();
                    id_matricula2 =$('#idMatr').val();
                    id_Periodo2=$('#idPeriodo').val();
                    var _token2=$("input[name=_token]").val(); 
                    if(id_nota2==""||id_nota2==null)
                    {
                        document.getElementById('btnActualizar').disabled=true;
                        $.ajax({
                                    url:"{{route('secretaria.ingresarNotasActa')}}",
                                    type:"POST",
                                    async: true,
                                    data:{
                                        nota_ley_reglamento:nota_ley_reglamento2,
                                        nota_educacion_vial:nota_educacion_vial2,
                                        nota_mecanica_basica:nota_mecanica_basica2,
                                        nota_grado_practico:nota_grado_practico2,
                                        id_matricula:id_matricula2,
                                        _token:_token2
                                    },
                                    beforeSend:function(){
                                        $('#btnActualizar').text('Ingresando..'); 
                                        $('#girar2').show(); 
                                    },
                                    success:function(response)
                                    {   
                                        if(response)
                                        {                                         
                                            $('#calificar_form')[0].reset();
                                            $('#calificar_modal').modal('hide');
                                            $('#btnActualizar').text('Subir nota'); 
                                            $('#girar2').hide(); 
                                            toastr.success('Se subio nota correctamente','¡EXITOSO!',{timeOut:3000});
                                                    $.ajax({
                                                        url:'/secretaria/tablaActasEstudiantes/'+id_Periodo2,
                                                            success : function(data){
                                                                setTimeout(function(){
                                                                    $('#contenidoActualizar').empty().append($(data));
                                                                }
                                                                );
                                                            }
                                                        });
                                                        document.getElementById('btnActualizar').disabled=false;
                                        }
                                        else{
                                            toastr.error('El período académico a culminado,NADA QUE HACER','¡FALLIDA!',{timeOut:2000});
                                            $('#btnActualizar').text('Subir nota'); 
                                            $('#girar2').hide(); 
                                            document.getElementById('btnActualizar').disabled=false;
                                        }
                                    },
                                    error : function(response){
                                        toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                        $('#btnActualizar').text('Subir nota'); 
                                        $('#girar2').hide(); 
                                        document.getElementById('btnActualizar').disabled=false;
                                    }
                                });      
                    }
                    else
                    {   
                        $.ajax({
                                    url:"{{route('secretaria.actualizarNotasActa')}}",
                                    type:"POST",
                                    data:{
                                        id_nota:id_nota2,
                                        nota_ley_reglamento:nota_ley_reglamento2,
                                        nota_educacion_vial:nota_educacion_vial2,
                                        nota_mecanica_basica:nota_mecanica_basica2,
                                        nota_grado_practico:nota_grado_practico2,
                                        id_matricula:id_matricula2,
                                        _token:_token2
                                    },
                                    beforeSend:function(){
                                        $('#btnActualizar').text('Actualizando..'); 
                                        $('#girar2').show(); 
                                    },
                                    success:function(response)
                                    {
                                        if(response)
                                        {
                                            $('#calificar_modal').modal('hide');
                                            toastr.success('Se actualizó nota correctamente','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                            $('#btnActualizar').text('Subir nota'); 
                                            $('#girar2').hide();  
                                            $('#calificar_form')[0].reset(); 
                                                    $.ajax({
                                                        url:'/secretaria/tablaActasEstudiantes/'+id_Periodo2,
                                                            success : function(data){
                                                                setTimeout(function(){
                                                                    $('#contenidoActualizar').empty().append($(data));
                                                                }
                                                                );
                                                            }
                                                        });
                                        }
                                        else{
                                            toastr.error('El período académico a culminado,NADA QUE HACER','¡FALLIDA!',{timeOut:2000});
                                                $('#btnActualizar').text('Subir nota'); 
                                                $('#girar2').hide(); 
                                        }
                                    },
                                    error : function(response){
                                                toastr.warning('Ocurrio un error intente nuevamente','¡FALLIDA!',{timeOut:3000});
                                                $('#btnActualizar').text('Subir nota'); 
                                                $('#girar2').hide(); 
                                    }
                                });    
                    }     
                })
            </script>
            

        <body>
</html>