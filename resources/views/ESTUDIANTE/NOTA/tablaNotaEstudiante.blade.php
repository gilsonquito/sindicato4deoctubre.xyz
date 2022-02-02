<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Notas Estudiante</title>
    </head>
    <body>
        <div id="contenidoActualizar" class="py-3 px-5">
                                <table id="" class="table table-responsive-lg w-100">
                                        <thead class="font-weight-bold text-dark" >
                                            <tr>
                                                <td class="align-middle text-center px-2" rowspan="2">Módulos</td>
                                                <td class="align-middle" colspan="6">NOTAS</td>
                                                <td class="align-middle" rowspan="2">Nota Final</td>
                                                <td class="align-middle" rowspan="2">Estado</td>
                                            </tr>
                                            <tr>
                                                <td >Trabajo en Equipo</td>
                                                <td >Estudios de Caso</td>
                                                <td >Prueba Práctica</td>
                                                <td >Prueba Teórica</td>
                                                <td >Promedio</td>
                                                <td >Suspenso</td>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center text-dark">  
                                                 @php
                                                    $sum=0;
                                                    $sum2=0;
                                                @endphp         
                                            @foreach ($notas as $nota)
                                                <tr>    
                                                    <td class="text-left px-2 align-middle">{{$nota->nombre_mod}}</td>
                                                    @if($nota->nota_trabajo_equipo)
                                                        <td class="py-2 align-middle">{{$nota->nota_trabajo_equipo}}</td>
                                                    @else
                                                        <td class="py-2 align-middle">--</td>
                                                    @endIf
                                                    @if($nota->nota_estudio_caso)
                                                        <td class="py-2 align-middle">{{$nota->nota_estudio_caso}}</td>
                                                    @else
                                                        <td class="py-2 align-middle">--</td>
                                                    @endIf
                                                    @if($nota->nota_prueba_practica)
                                                        <td class="py-2 align-middle">{{$nota->nota_prueba_practica}}</td>
                                                    @else
                                                        <td class="py-2 align-middle">--</td>
                                                    @endIf
                                                    @if($nota->nota_prueba_teorica)
                                                        <td class="py-2 align-middle">{{$nota->nota_prueba_teorica}}</td>
                                                    @else
                                                        <td class="py-2 align-middle">--</td>
                                                    @endIf
                                                    <td class="py-2 align-middle">
        
                                                           @php
                                                              $sum2=($nota->nota_trabajo_equipo+$nota->nota_estudio_caso+$nota->nota_prueba_practica+$nota->nota_prueba_teorica)/4;
                                                              $total1=bcdiv($sum2, '1', 0);
                                                           @endphp
                                                           @if(($sum2-$total1)>=0.5)
                                                                @php
                                                                    $total1=$total1+1;
                                                                @endphp
                                                           @endif
                                                           <span class="" >{{$total1}}</span>
                                                    
                                                   </td>
                                                    @if(($nota->nota_suspenso))
                                                        <td class="py-2 align-middle">{{$nota->nota_suspenso}}</td>
                                                    @else
                                                        <td class="py-2 align-middle">--</td>
                                                    @endIf
                                                    <td class="py-2 align-middle">
                                                        @if(($nota->nota_suspenso==null))
                                                            @php
                                                               $sum=($nota->nota_trabajo_equipo+$nota->nota_estudio_caso+$nota->nota_prueba_practica+$nota->nota_prueba_teorica)/4;
                                                               $total2=bcdiv($sum, '1', 0);
                                                            @endphp
                                                            @if(($sum-$total2)>=0.5)
                                                                @php
                                                                    $total2=$total2+1;
                                                                @endphp
                                                            @endif
                                                            <span class="font-weight-bold text-muted" >{{$total2}}</span>
                                                        @else
                                                            @php
                                                                $sum=((($nota->nota_trabajo_equipo+$nota->nota_estudio_caso+$nota->nota_prueba_practica+$nota->nota_prueba_teorica)/4)+($nota->nota_suspenso))/(2);
                                                                $total2=bcdiv($sum, '1', 0);
                                                            @endphp
                                                            @if(($sum-$total2)>=0.5)
                                                                @php
                                                                    $total2=$total2+1;
                                                                @endphp
                                                            @endif
                                                            <span class="font-weight-bold text-muted" >{{$total2}}</span>
                                                        @endIf
                                                    </td>
                                                    <td class="py-2 align-middle">
                                                        @if($total2>=16)
                                                            <span class="text-light bg-success border-rounded p-2">APROBADO</span>
                                                        @else
                                                            <span class="text-light bg-danger p-2">REPROBADO</span>
                                                        @endIf
                                                    </td>
                                                </tr>
                                            @endforeach   
                                        </tbody>
                                </table>               
        </div> 
        <body>
</html>