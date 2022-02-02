    <head>
        <link href="{{asset('css/evaluacionUnidad.css')}}" rel="stylesheet">
        <title>Evaluaciónes de unidad</title>
    </head>
    <body>
        <div id="contenidoEvaluaciones">
            <h5 class="text-left font-weight-normal text-dark" href="#">Tipo de Evaluación</h5>
            <hr color="" class="border border-muted w-100 p-0">
                <div class="d-flex">
                </div>
                <p class="text-left font-weight-bold text-muted" href="#">Listado de evaluaciones</p>
                <table id="tablaEvaluaciones" class="table table-striped table-bordered table-responsive-lg w-100">
                        <thead class="font-weight-bold text-center text-muted bg-light" >
                            <tr>
                                <td class="col-md-3 align-middle" rowspan="3">Acciones</td>
                                <td class="col-md-3 align-middle" rowspan="3">Tipo de Evaluación</td>
                                <td class="col-md-6 align-middle" rowspan="3">Detalle de Evaluaciones</td>
                            </tr>   
                        </thead>
                        <tbody class="text-center text-dark">         
                            @foreach ($evaluaciones as $evaluacion)
                              <tr>    
                                  <td class="py-1">
                                      <div class="row justify-content-center">
                                      </div>  
                                  </td>  
                                  <td class="py-1">{{$evaluacion->tipo_evaluacion}}</td>
                                  <td class="py-1">{{$evaluacion->detalle_evaluacion}}</td>
                              </tr>
                          @endforeach   
                      </tbody>                                 
                </table>    
                @foreach ($unidadesE as $unidad)
                    <input type="hidden" id="txtIdunidadE" name="txtIdunidadE" value="{{$unidad->id_unidad}}">
                @endforeach      
        </div>             
    <body>
</html>