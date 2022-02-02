<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/descargarHorario.css')}}" rel="stylesheet">
        <title>Horario Docente</title>
    </head>
    <body>
        <div class="p-1">
                                <table id="tabla-horariodocente" class="table table-responsive-lg table-hover w-100">
                                        <thead class="font-weight-bold text-center text-dark" >
                                            <td class="col-md-1">Hora</td>
                                            <td class="col-md-1">Lunes</td>
                                            <td class="col-md-1">Martes</td>
                                            <td class="col-md-1">Miércoles</td>
                                            <td class="col-md-1">Jueves</td>
                                            <td class="col-md-1">Viernes</td>
                                            <td class="col-md-1">Sábado</td>
                                            <td class="col-md-1">Domingo</td>
                                        </thead>
                                        <tbody class="text-center text-dark">      
                                            @foreach ($horarioclases as $horario)
                                                <tr>
                                                    <td >{{$horario[0]}}</td>
                                                    <td >{{$horario[1]}}</td>
                                                    <td >{{$horario[2]}}</td>
                                                    <td >{{$horario[3]}}</td>
                                                    <td >{{$horario[4]}}</td>
                                                    <td >{{$horario[5]}}</td>
                                                    <td >{{$horario[6]}}</td>
                                                    <td >{{$horario[7]}}</td>          
                                                </tr>
                                            @endforeach   
                                        </tbody>
                                </table>
        </div> 
        <body>
</html>