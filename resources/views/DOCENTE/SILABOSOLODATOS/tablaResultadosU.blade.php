    <head>
        <link href="{{asset('css/tablaResultadoUnidad.css')}}" rel="stylesheet">
        <title>Resultados de aprendixaje de la unidad</title>
    </head>
    <body>
        <div id="contenidoResultadoUnidad">
            <h5 class="text-left font-weight-normal text-dark" href="#">Resultados de aprendizaje de la unidad</h5>
            <hr color="" class="border border-muted w-100 p-0">
                <div class="d-flex">
                </div>
                <p class="text-left font-weight-bold text-muted" href="#">Listado de Resultados por Unidad</p>
                <table id="tablaResultadoUnidad" class="table table-striped table-bordered table-responsive-lg w-100">
                        <thead class="font-weight-bold text-center text-muted bg-light" >
                            <tr>
                                <td class="col-md-3 align-middle" rowspan="3">Acciones</td>
                                <td class="col-md-9 align-middle" rowspan="3">Resultado</td>
                            </tr>   
                        </thead>
                        <tbody class="text-center text-dark">         
                            @foreach ($resultados as $resultado)
                              <tr>    
                                  <td class="py-1">
                                      <div class="row justify-content-center">   
                                      </div>  
                                  </td>  
                                  <td class="py-1">{{$resultado->resultado}}</td>
                              </tr>
                          @endforeach   
                      </tbody>                                 
                </table>    
                @foreach ($unidadesRU as $unidad)
                    <input type="hidden" id="txtIdunidadRU" name="txtIdunidadRU" value="{{$unidad->id_unidad}}">
                @endforeach     
        </div>        
    <body>
