    <head>
        <link href="{{asset('css/tablaSubtema.css')}}" rel="stylesheet">
        <title>Subtemas</title>
    </head>
    <body>
        <div id="contenidoSubTemas">
            @foreach ($temasS as $tema)
                    <input type="hidden" id="txtTemaS" name="txtTemaS" value="{{$tema->id_tema}}">
                    <input type="hidden" id="txtUnidadS" name="txtUnidadS" value="{{$tema->id_unidad}}">
                    <input type="hidden" id="txtSilaboS" name="txtSilaboS" value="{{$tema->id_sil}}">
                    <h5 class="text-left font-weight-normal text-muted text-uppercase"><strong>Unidad: </strong>{{$tema->orden_unidad}}. {{$tema->titulo_unidad}}</h5>
                    <p class="text-left font-weight-normal text-muted"><strong>Tema: </strong>{{$tema->orden_tema}}. {{$tema->titulo_tema}}</p>
            @endforeach 
                <div class="d-flex">
                    <div class="p-2">
                        <button onclick="volverUnidadesS()" class="btn btn-outline-dark" id="btnVolverUnidadesS" name="btnVolverUnidadesS"><i class="fa fa-caret-left mr-2" aria-hidden="true"></i>Mostrar Unidades</button>
                    </div>
                    <div class="p-2">
                        <button onclick="volverTemas()" class="btn btn-outline-dark" id="btnVolverTemas" name="btnVolverTemas"><i class="fa fa-caret-left mr-2" aria-hidden="true"></i>Mostrar Temas</button>
                    </div>
                </div>
                <p class="text-left font-weight-bold text-muted" href="#">Listado de Subtemas</p>
                <hr color="" class="border border-muted w-100 p-0">
                <table id="tablaSubtemas" class="table table-striped table-bordered table-responsive-lg w-100">
                        <thead class="font-weight-bold text-center text-muted" >
                            <tr>
                                <td class="col-md-3 align-middle" rowspan="3">Acciones</td>
                                <td class="col-md-3 align-middle" rowspan="3">Orden de SubTema</td>
                                <td class="col-md-6 align-middle" rowspan="3">Titulo del Subtema</td>
                            </tr>   
                        </thead>
                        <tbody class="text-center text-dark">         
                            @foreach ($subtemas as $subtema)
                              <tr>    
                                  <td class="py-1">
                                      <div class="row justify-content-center">
                                          
                                      </div>  
                                  </td>  
                                  <td class="py-1">{{$subtema->orden_subtema}}</td>
                                  <td class="py-1">{{$subtema->titulo_subtema}}</td>
                              </tr>
                          @endforeach   
                      </tbody>                                 
                </table>                 
        </div>           
            <script>//CARGAER volver a unidades
                function volverUnidadesS(){
                    var id_SilaboU=$('#txtSilaboS').val();
                    $.ajax({
                        url:'/unidad/mostrarUnidades2/'+id_SilaboU,
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenidoSubTemas').empty().append($(data));
                                }
                                );
                            }
                    });
                }
                function volverTemas(){
                    var id_UnidadS=$('#txtUnidadS').val();
                    $.ajax({                 
                        url:'/temas/mostrarTemas2/'+id_UnidadS,
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenidoSubTemas').empty().append($(data));
                                }
                                );
                            }
                    });
                }
            </script> 
    <body>
