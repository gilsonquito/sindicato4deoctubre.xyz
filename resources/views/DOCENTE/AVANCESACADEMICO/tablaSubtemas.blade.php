    <head>
        <link href="{{asset('css/tablaSubtema.css')}}" rel="stylesheet">
        <title>Subtemas</title>
    </head>
    <body>
        <div id="contenidoAvanceSubTemas">
            @foreach ($temasS as $tema)
                    <input type="hidden" id="txtTemaS" name="txtTemaS" value="{{$tema->id_tema}}">
                    <input type="hidden" id="txtUnidadS" name="txtUnidadS" value="{{$tema->id_unidad}}">
                    <input type="hidden" id="txtIdSilaboSubtema" name="txtIdSilaboSubtema" value="{{$tema->id_sil}}">
                    <h5 class="text-left font-weight-normal text-muted text-uppercase"><strong>Unidad: </strong>{{$tema->orden_unidad}}. {{$tema->titulo_unidad}}</h5>
                    <p class="text-left font-weight-normal text-muted"><strong>Tema: </strong>{{$tema->orden_tema}}. {{$tema->titulo_tema}}</p>
            @endforeach 
                <div class="d-flex">
                    <div class="p-2">
                            <button onclick="volverUnidadesSubtema()" class="btn btn-outline-dark" id="" name=""><i class="fa fa-caret-left mr-2" aria-hidden="true"></i>Mostrar Unidades</button>
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
                                <td class="col-md-3 align-middle" rowspan="3">Seleccionar</td>
                                <td class="col-md-9 align-middle" rowspan="3">Título del Subtema</td>
                            </tr>   
                        </thead>
                        <tbody class="text-center text-dark">         
                            @foreach ($subtemas as $subtema)
                              <tr>    
                                  <td class="py-1">
                                      <div class="p-1 justify-content-center">
                                              <a  onclick="agregarSubtemaAvance({{$subtema->id_subtema}})" class="btn btn btn-success btn-sm " title="Agegar subtema a avance academico">
                                                   <i class="fa fa-plus px-2" aria-hidden="true"></i>Agregar
                                                </a>                                           
                                        </div> 
                                  </td>  
                                  <td class="py-1">{{$subtema->titulo_subtema}}</td>
                              </tr>
                          @endforeach   
                      </tbody>                                 
                </table>                
        </div>
            <script>//CARGAER volver a unidades
                function volverUnidadesSubtema()
                {
                    var id_SilaboSubtemas=$('#txtIdSilaboSubtema').val();
                    $.ajax({
                        url:'/unidad/mostrarUnidades3/'+id_SilaboSubtemas,
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenidoAvanceSubTemas').empty().append($(data));
                                }
                                );
                            }
                    });
                }
                function volverTemas(){
                    var id_UnidadS=$('#txtUnidadS').val();
                    $.ajax({                 
                        url:'/temas/mostrarTemas3/'+id_UnidadS,
                            success : function(data){
                                setTimeout(function(){
                                    $('#contenidoAvanceSubTemas').empty().append($(data));
                                }
                                );
                            }
                    });
                }
                function agregarSubtemaAvance(id_subtema){
                    var id_avance=$('#txtIdAvanceAv').val();
                    var _token=$("input[name=_token]").val();
                    $.ajax({
                                        url:"/avanceSubtema/ingresar",
                                        type:"POST",
                                        async: true,
                                        data:{
                                                id_avance:id_avance,
                                                id_subtema:id_subtema,
                                                _token:_token
                                        },
                                        success:function(response)
                                        {   
                                            if(response)
                                            {                                   
                                                toastr.success('El subtema fue agregado exitosamente','¡EXITOSO!',{timeOut:2000}); 
                                                var subtemasi=$('#tablaSubtemasAvance').DataTable();
                                                subtemasi.ajax.reload();         
                                            }
                                            else{
                                                
                                                toastr.warning('El subtema yá fue agregado','¡FALLIDA!',{timeOut:2000});
                                            }
                                        },
                                        error : function(response){
                                            
                                            toastr.error('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:2000});
                                            
                                        }
                                    });
                }
            </script> 
    </body>
