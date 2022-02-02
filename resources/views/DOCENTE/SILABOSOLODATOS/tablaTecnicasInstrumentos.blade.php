    <head>
        <link href="{{asset('css/tecnicaInstrumento.css')}}" rel="stylesheet">
        <title>Técnicas e instrumentos</title>
    </head>
    <body>
        <div id="contenidoTecnicasInstrumentos">
            <h5 class="text-left font-weight-normal text-dark" href="#">Técnicas e instrumentos</h5>
            <hr color="" class="border border-muted w-100 p-0">
                <div class="d-flex">
                </div>
                <p class="text-left font-weight-bold text-muted" href="#">Listado de tecnicas e instrumentos</p>
                <table id="tablaTecnicasInstrumentos" class="table table-striped table-bordered table-responsive-lg w-100">
                        <thead class="font-weight-bold text-center text-muted bg-light" >
                            <tr>
                                <td class="col-md-3 align-middle" rowspan="3">Acciones</td>
                                <td class="col-md-3 align-middle" rowspan="3">Técnica</td>
                                <td class="col-md-6 align-middle" rowspan="3">Instrumento</td>
                            </tr>   
                        </thead>
                        <tbody class="text-center text-dark">         
                            @foreach ($tecnicas as $tecnica)
                              <tr>    
                                  <td class="py-1">
                                      <div class="row justify-content-center">  
                                      </div>  
                                  </td>  
                                  <td class="py-1">{{$tecnica->tecnica}}</td>
                                  <td class="py-1">{{$tecnica->instrumento}}</td>
                              </tr>
                          @endforeach   
                      </tbody>                                 
                </table>    
                @foreach ($unidadesT as $unidad)
                    <input type="hidden" id="txtIdunidadT" name="txtIdunidadT" value="{{$unidad->id_unidad}}">
                @endforeach        
        </div>       
    <body>
