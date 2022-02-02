<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        <title>Evaluacion de docente</title>
    </head>
    <body>
        <div id="contenidoActualizar" class="p-1">
                                <table id="" class="table table-responsive w-100">
                                        <thead class="font-weight-bold text-dark" >
                                            <td class="col-md-1">Módulo</td>
                                            <td class="col-md-1">Instrucción</td>
                                            <td class="col-md-2">Apellido Docente</td>
                                            <td class="col-md-2">Nombre Docente</td>
                                            <td class="col-md-1">Curso Licencia</td>
                                            <td class="col-md-1">Paralelo</td>
                                            <td class="col-md-2">Fecha Plazo Evaluación</td>
                                            <td class="col-md-2">Acción</td>
                                        </thead>
                                        <tbody class="text-center text-dark">         
                                            @foreach ($modulos as $modulo)
                                                <tr>    
                                                    <td>{{$modulo->nombre_mod}}</td>
                                                    <td>{{$modulo->instruccion_doc}}</td>
                                                    <td>{{$modulo->apellido_doc}}</td>
                                                    <td>{{$modulo->name}}</td>
                                                    <td>{{$modulo->nombre_tipolicencia}}</td>
                                                    <td>{{$modulo->nombre_paralelo}}</td>
                                                    <td class="text-success">Desde {{$modulo->fecha_ini_evaluacion}} Hasta {{$modulo->fecha_fin_evaluacion}} </td>
                                                    <td>
                                                        <div class="row justify-content-center">
                                                            <div class="p-1 ">
                                                                <a  href="#" onclick="evaluarDocente({{$modulo->id_evaluacion}})" class="btn btn-success btn-sm " title="Evaluar docente">
                                                                    <i class="fa fa-check px-2" aria-hidden="true"></i>Evaluar
                                                                 </a>
                                                            </div>
                                                        </div>
                                                    </td>             
                                                </tr>
                                            @endforeach   
                                        </tbody>
                                </table>
                                <!--------------------------------------------------modal editar ..........................-->
                                    <!-- Button trigger modal -->
                                        <!-- Modal -->
                                    <div class="modal fade " id="evaluacione_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Evaluación docente</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="evaluacion_edit_form">
                                                <div class="modal-body"> 
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                                <table class="table table-responsive w-100">
                                                                    <thead>
                                                                        <th>Aspecto</th>
                                                                        <th>Pregunta</th>
                                                                        <th>Acción</th>
                                                                    </thead>
                                                                <tbody id="cuerpo">
                                                                </tbody>
                                                                </table>
                                                                <!--<div id="tablaPreguntas">
                                                                      
                                                                </div>       --> 
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                                    <button type="submit" class="btn btn-success" id="btnActualizar" name="btnActualizar"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Finalizar</button>
                                                    <div id="girar2" class="lds-dual-ring col-md-12"></div> 
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>   
        </div> 
        <script>//CARGAER EN EL FORMULARIO PARA EDITAR
            function evaluarDocente(id){
              
                $.get('/evaluacionDocentes/evalularDocente/'+id, function(data)
                {       
                    if(data)
                    {
                        window.open(data, '_blank');
                    }
                    else{
                        toastr.error('Esta intentando realizar la evaluación fuera de la fecha indicada','¡ERROR!',{timeOut:3000});
                    }
                
                });
            }
        </script>
        <body>
</html>