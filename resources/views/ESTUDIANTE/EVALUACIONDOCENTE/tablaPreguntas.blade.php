<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Preguntas</title>
    </head>
    <body>
        <div id="contenidoActualizar" class="p-1">
                        
                                <table id="" class="table table-responsive w-100">
                                        <thead class="font-weight-bold text-dark" >
                                            <td class="col-md-3">Aspecto</td>
                                            <td class="col-md-1">Pregunta</td>
                                            <td class="col-md-3">Acción</td>
                                        </thead>
                                        <tbody class="text-center text-dark">     
                                            @php
                                                $i=1;
                                            @endphp      
                                            @foreach ($preguntas as $pregunta)
                                                <tr>    
                                                    <td>{{$i}}</td>
                                                    <td>{{$pregunta->aspecto_evaluar}}</td>
                                                    <td>{{$pregunta->pregunta}}</td>
                                                    <td>
                                                        <div class="row justify-content-center">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                                <label class="form-check-label" for="exampleRadios1">
                                                                    Si cumple
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                                                <label class="form-check-label" for="exampleRadios2">
                                                                    No cumple
                                                                </label>
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
        </div> 
        <script>//CARGAER EN EL FORMULARIO PARA EDITAR
            function evaluarDocente(id){
                $('#evaluacion_edit_modal').modal('toggle');
                $.get('/cursolicencia/editar/'+id, function(curso)
                {
                                  
                       /* 
                    //asignar datos recuperados
                    $('#txtId2').val(curso[0].id_curlic);
                    $('#selTipoLicencia2').val(curso[0].id_tlic);
                    $('#selJornada2').val(curso[0].jornada);
                    $('#selModalidad2').val(curso[0].modalidad);
                    $('#txtduracion_meses2').val(curso[0].duracion_meses);
                    $('#selParalelo2').val(curso[0].id_paralelo);
                    $("input[name=_token]").val();
                    $('#curso_edit_modal').modal('toggle');*/

                });

            }
        </script>
        <body>
</html>