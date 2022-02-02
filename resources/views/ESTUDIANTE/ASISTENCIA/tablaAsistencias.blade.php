<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Asistecias Estudiante</title>
    </head>
    <body>
        <div id="contenidoActualizar" class="py-3 px-5">
                                <table id="" class="table table-striped table-responsive-lg w-100">
                                        <thead class="font-weight-bold text-dark" >
                                            <td class="col-md-3 text-left px-2">Módulo</td>
                                            <td class="col-md-3 text-center px-2">Porcentaje</td>
                                            <td class="col-md-3">Visualizar</td>
                                        </thead>
                                        <tbody class="text-center text-dark"> 
                                        @php
                                            $contPresentes=0;
                                            $contTotalP=0;
                                        @endphp        
                                            @foreach ($modulos as $modulo)
                                                <tr>    
                                                    <td class="text-left px-2 py-0 align-middle">{{$modulo->nombre_mod}}</td>
                                                    <td class="text-center px-2 align-middle ">
                                                        @foreach ($asistencias as $asistencia)
                                                            @if($asistencia->id_mod==$modulo->id_mod)
                                                                @php
                                                                    $contTotalP=$contTotalP+1;
                                                                @endphp
                                                                @if($asistencia->estado_asistencia=="PRESENTE")
                                                                    @php
                                                                        $contPresentes=$contPresentes+1;
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        @if($contTotalP==0)
                                                            <spam>--</spam>
                                                        @else
                                                            @php
                                                                $contPresentes=($contPresentes*100)/$contTotalP;
                                                                $porcentaje=bcdiv($contPresentes, '1', 2);
                                                            @endphp
                                                            @if($porcentaje>=95)
                                                                <spam class="text-success">{{$porcentaje}} % </spam>
                                                            @else
                                                                <spam class="text-danger">{{$porcentaje}} % </spam>
                                                            @endif
                                                        @endif  
                                                    </td>
                                                    <td class="">
                                                        <div class=" text-center py-0">
                                                            <a type="button" name="descargar" href="/asistenciaEstudiante/pdfAsistenciaEstudiante/{{$modulo->id_matricula}}/{{$modulo->id_doc_mod}}" target="_blank" class="btn btn-lg"  title="Ver reporte de asistencias">
                                                                <i class="fa fa-file-pdf-o px-2 text-dark" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    $contPresentes=0;
                                                    $contTotalP=0;
                                                @endphp
                                            @endforeach   
                                        </tbody>
                                </table>           
        </div> 
        <body>
</html>