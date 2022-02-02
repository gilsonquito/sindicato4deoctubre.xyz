<table id="tablaSilabosP" class="table-responsive-lg table-striped w-100">
    <thead class="font-weight-bold text-center text-secondary" >
        <td class="col-md-2 py-2">Escuela</td>
        <td class="col-md-1 py-2">Plan de estudio</td>
        <td class="col-md-1 py-2">Módulo</td>
        <td class="col-md-1 py-2">Número de horas</td>
        <td class="col-md-1 py-2">Tipo Licencia</td>
        <td class="col-md-1 py-2">Jornada</td>
        <td class="col-md-1 py-2">Modalidad</td>
        <td class="col-md-1 py-2">Paralelo</td>
        <td class="col-md-1 py-2">Estado</td>
        <td class="col-md-1 py-2">Fecha Creación</td>
        <td class="col-md-2 py-2">Acciones</td>
    </thead>
    <tbody class=""> 
        @foreach ($silabos as $silabo)
            <tr class="">    
                <td class="col-md-2 py-2">{{$silabo->escuela}}</td>
                <td class="col-md-1 py-2">{{$silabo->plan_estudio}}</td>
                <td class="col-md-1 py-2">{{$silabo->nombre_mod}}</td>
                <td class="col-md-1 py-2">{{$silabo->duracion_horas}}</td>
                <td class="col-md-1 py-2">{{$silabo->nombre_tlic}}</td>
                <td class="col-md-1 py-2">{{$silabo->jornada}}</td>
                <td class="col-md-1 py-2">{{$silabo->modalidad}}</td>
                <td class="col-md-1 py-2">{{$silabo->nombre_paralelo}}</td>
                <td class="col-md-1 py-2">{{$silabo->estado}}</td>
                <td class="col-md-1 py-2">{{$silabo->fecha_creacion}}</td>
                <td class="col-md-1 py-2">
                    <div class="row justify-content-center">
                        <div class="col p-1">
                            <a href="javascript:void(0)" onclick="visualizarSilabo({{$silabo->id_sil}})" class="btn btn btn-outline-warning btn-sm" title="Visualizar">
                                <i class="fa fa-eye px-2" aria-hidden="true"></i> 
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach         
    </tbody>                                      
</table>
