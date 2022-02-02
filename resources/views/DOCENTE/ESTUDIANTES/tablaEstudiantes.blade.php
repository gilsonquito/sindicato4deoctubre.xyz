<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>Estudiantes</title>
    </head>
    <body>
        <div id="contenidoActualizar">
                                <table id="tabla-horariodocente" class="table table-responsive-lg table-hover w-100">
                                        <thead class="font-weight-bold text-center text-dark" >
                                            <td class="col-md-1">#</td>
                                            <td class="col-md-3">Apellido</td>
                                            <td class="col-md-3">Nombre</td>
                                            <td class="col-md-3">Email</td>
                                            <td class="col-md-1">Tipo licencia</td>
                                            <td class="col-md-2">Jornada</td>
                                            <td class="col-md-2">Modalidad</td>
                                            <td class="col-md-1">Paralelo</td>
                                        </thead>
                                        <tbody class="text-center text-dark">         
                                        @php
                                            $i=1;
                                        @endphp  
                                            @foreach ($estudiantes as $estudiante)
                                                <tr>    
                                                    <td class="py-2">{{$i}}</td>
                                                  
                                                    <td class="py-2">{{$estudiante->apellido_est}}</td>
                                                    <td class="py-2">{{$estudiante->name_est}}</td>
                                                    <td class="py-2">{{$estudiante->email_est}}</td>
                                                    <td class="py-2">{{$estudiante->nombre_tlic}}</td>
                                                    <td class="py-2">{{$estudiante->jornada}}</td>
                                                    <td class="py-2">{{$estudiante->modalidad}}</td>
                                                    <td class="py-2">{{$estudiante->nombre_paralelo}}</td>     
                                                </tr>
                                                @php
                                                    $i=$i+1;
                                                    
                                                @endphp
                                            @endforeach   
                                        </tbody>
                                </table>                  
        </div> 
        <body>
</html>