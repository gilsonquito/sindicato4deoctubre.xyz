<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>Módulos</title>
    </head>
    <body>
        <div id="contenidoActualizar">
                                <table id="tabla-horariodocente" class="table table-responsive-lg table-hover w-100">
                                        <thead class="font-weight-bold text-center text-dark" >
                                            <td class="col-md-3 py-2">Nombre módulo</td>
                                            <td class="col-md-2 py-2">Número de horas</td>
                                            <td class="col-md-1 py-2">Tipo licencia</td>
                                            <td class="col-md-2 py-2">Jornada</td>
                                            <td class="col-md-2 py-2">Modalidad</td>
                                            <td class="col-md-1 py-2">Paralelo</td>
                                        </thead>
                                        <tbody class="text-center text-dark">         
                                      
                                            @foreach ($modulos as $modulo)
                                                <tr>   
                                                    <td class="py-2">{{$modulo->nombre_mod}}</td>
                                                    <td class="py-2">{{$modulo->duracion_horas}}</td>
                                                    <td class="py-2">{{$modulo->nombre_tlic}}</td>
                                                    <td class="py-2">{{$modulo->jornada}}</td>
                                                    <td class="py-2">{{$modulo->modalidad}}</td>
                                                    <td class="py-2">{{$modulo->nombre_paralelo}}</td>     
                                                </tr>
                                            @endforeach   
                                        </tbody>
                                </table>                  
        </div> 
        <body>
</html>