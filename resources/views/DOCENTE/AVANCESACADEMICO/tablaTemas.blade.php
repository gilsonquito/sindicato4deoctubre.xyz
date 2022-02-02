    <head>
        <link href="{{asset('css/tablaTemas.css')}}" rel="stylesheet">
        <title>Temas</title>
    </head>
    <body>
        <div id="contenidoTemas">
            <hr color="" class="border border-muted w-100 p-0">
            @foreach ($unidadesT as $unidad)
                    <input type="hidden" id="txtUnidadT" name="txtUnidadT" value="{{$unidad->id_unidad}}">
                    <input type="hidden" id="txtSilaboT" name="txtSilaboT" value="{{$unidad->id_sil}}">
                    <h5 class="text-left font-weight-normal text-dark text-uppercase"><strong>Unidad: </strong>{{$unidad->orden_unidad}}. {{$unidad->titulo_unidad}}</h5>
            @endforeach  
                <div class="d-flex">
                    <div class="p-2">
                        <button onclick="volverUnidades()" class="btn btn-outline-dark" id="btnVolverUnidades" name="btnVolverUnidades"><i class="fa fa-caret-left mr-2" aria-hidden="true"></i>Mostrar Unidades</button>
                    </div>
                </div>
                <p class="text-left font-weight-bold text-muted" href="#">Listado de Temas</p>
                <table id="tabla-temas" class="table table-striped table-bordered table-responsive-lg w-100">
                        <thead class="font-weight-bold text-center text-secondary" >
                            <tr>
                                <td class="col-md-1 align-middle" rowspan="3">Seleccionar</td>
                                <td class="col-md-1 align-middle" rowspan="3">Título de tema</td>
                            </tr>
                        </thead>
                        <tbody class="text-center text-dark">         
                            @foreach ($temas as $tema)
                              <tr>    
                                  <td class="py-1">
                                        <div class="row justify-content-center p-2">
                                              <a  href="javascript:void(0)" onclick="listarSubTemas({{$tema->id_tema}})" class="btn btn-info" title="Listar Subtemas">
                                                Subtemas</a>
                                        </div>                                 
                                  </td>  
                                  <td class="py-1">{{$tema->titulo_tema}}</td>
                              </tr>
                          @endforeach   
                      </tbody>                                 
                </table>                                   
        </div>        
            <script>//CARGAER volver a unidades
                function volverUnidades(){
                    var id_SilaboT=$('#txtSilaboT').val();
                    $.ajax({
                        url:'/unidad/mostrarUnidades3/'+id_SilaboT,
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenidoTemas').empty().append($(data));
                                }
                                );
                            }
                    });
                }
                function listarSubTemas(id){                   
                    $.ajax({
                        url:'/subtemas/mostrarSubTemas3/'+id,
                            success : function(data){
                                 setTimeout(function(){
                                    $('#contenidoTemas').empty().append($(data));
                                }
                            );
                        }
                    });
                }               
            </script>    
    <body>