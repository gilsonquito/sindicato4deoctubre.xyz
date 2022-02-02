    <head>
        <title>Sílabos</title>
    </head>
    <body>
        <div id="contenidoActualizar">
            <div class="w-100">
                                <table id="tabla-sil" class="table table-striped table-responsive table-hover w-100">
                                        <thead class="font-weight-bold text-center text-secondary" >
                                            <td class="col-md-2 py-2">Escuela</td>
                                            <td class="col-md-2 py-2">Plan de estudio</td>
                                            <td class="col-md-2 py-2">Módulo</td>
                                            <td class="col-md-1 py-2">Número de horas</td>
                                            <td class="col-md-1 py-2">Tipo Licencia</td>
                                            <td class="col-md-1 py-2">Jornada</td>
                                            <td class="col-md-2 py-2">Modalidad</td>
                                            <td class="col-md-1 py-2">Paralelo</td>
                                        </thead>
                                        <tbody class="text-center text-dark">         
                                            @foreach ($silabos as $silabo)
                                                <tr>    
                                                    <td class="py-2">{{$silabo->escuela}}</td>
                                                    <td class="py-2">{{$silabo->plan_estudio}}</td>
                                                    <td class="py-2">{{$silabo->nombre_mod}}</td>
                                                    <td class="py-2">{{$silabo->duracion_horas}}</td>
                                                    <td class="py-2">{{$silabo->nombre_tlic}}</td>
                                                    <td class="py-2">{{$silabo->jornada}}</td>
                                                    <td class="py-2">{{$silabo->modalidad}}</td>
                                                    <td class="py-2">{{$silabo->nombre_paralelo}}</td>   
                                                    <td class="py-2">
                                                        <div class="btn-group btn-group-toggle text-success" data-toggle="buttons">
                                                            <label class="btn btn-link text-success active">
                                                                    <input class="text-success px-1" type="radio" name="checks[]" id="{{$silabo->id_sil}}" value="{{$silabo->id_sil}}" > 
                                                                    <i class="fa fa-check px-1" aria-hidden="true">&nbsp;Seleccionar</i>
                                                            </label>
                                                        </div>
                                                    </td>       
                                                </tr>
                                            @endforeach   
                                        </tbody>
                                </table>
                </div>                  
        </div> 
        <body>