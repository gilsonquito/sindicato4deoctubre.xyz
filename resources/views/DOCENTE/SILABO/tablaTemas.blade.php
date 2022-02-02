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
                    <div class="mr-auto p-2">
                        <button onclick="agregarTema()" class="btn btn-outline-success" id="btnAgregarTema" name="btnAgregarTema"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>Agregar tema</button>
                    </div>
                    <div class="p-2">
                        <button onclick="volverUnidades()" class="btn btn-outline-dark" id="btnVolverUnidades" name="btnVolverUnidades"><i class="fa fa-caret-left mr-2" aria-hidden="true"></i>Mostrar Unidades</button>
                    </div>
                </div>
                <p class="text-left font-weight-bold text-muted" href="#">Listado de Temas</p>
                <table id="tabla-temas" class="table table-striped table-bordered table-responsive-lg w-100">
                        <thead class="font-weight-bold text-center text-secondary" >
                            <tr>
                                <td class="col-md-1 align-middle" rowspan="3">Acciones</td>
                                <td class="col-md-1 align-middle" rowspan="3">Tipo de clase</td>
                                <td class="col-md-1 align-middle" rowspan="3">Orden de tema</td>
                                <td class="col-md-1 align-middle" rowspan="3">Título de tema</td>
                                <td class="col-md-2 align-middle" rowspan="3">Actividades de Docencia</td>
                                <td class="col-md-2 align-middle" rowspan="3">Actividades de Docencia Prácticas de Aplicación y Experimentación</td>
                                <td class="col-md-2 align-middle" rowspan="3">Actividades de Aprendizaje Autónomo</td>
                                <th class="col-md-1 align-middle"colspan="4">Temporizador</th>
                            </tr>
                            <tr>
                                <th colspan="3">Horas</th>
                                <td class="col-md-1 align-middle" rowspan="2">Semana</td>
                            </tr>
                            <td class="col-md-1 align-middle">Horas de Docencia</td>
                            <td class="col-md-1 align-middle">Horas Aprendizaje y Experimentación</td>
                            <td class="col-md-1 align-middle">Horas Trabajo Autónomo</td>
                        </thead>
                        <tbody class="text-center text-dark">         
                            @foreach ($temas as $tema)
                              <tr>    
                                  <td class="py-1">
                                        <div class="row justify-content-center p-2">
                                              <a  href="javascript:void(0)" onclick="listarSubTemas({{$tema->id_tema}})" class="btn btn-info" title="Listar Subtemas">
                                                Subtemas</a>
                                        </div>
                                      <div class="row justify-content-center">
                                          <div class="p-1 justify-content-center">
                                              <a  onclick="editarTemas({{$tema->id_tema}})" class="btn btn btn-outline-warning btn-sm " title="Editar tema">
                                                   <i class="fa fa-pencil px-2" aria-hidden="true"></i>
                                                </a>
                                             
                                          </div>
                                          <div class="p-1 justify-content-center">
                                               <button type="button" name="DeleteTema"  class="DeleteTema btn btn-outline-danger btn-sm" id="{{$tema->id_tema}}" title="Eliminar tema">
                                                  <i class="fa fa-trash-o px-2" aria-hidden="true"></i>
                                              </button>
                                          </div>
                                      </div>                                      
                                  </td>  
                                  <td class="py-1">{{$tema->tipo_clase}}</td>
                                  <td class="py-1">{{$tema->orden_tema}}</td>
                                  <td class="py-1">{{$tema->titulo_tema}}</td>
                                  <td class="py-1">{{$tema->actividadesdocencia_tema}}</td>
                                  <td class="py-1">{{$tema->actdocpracapliexp_tema}}</td>
                                  <td class="py-1">{{$tema->actaprauto_tema}}</td>
                                  <td class="py-1">{{$tema->horasdocencia_tema}}</td>
                                  <td class="py-1">{{$tema->horasapreexp_tema}}</td>
                                  <td class="py-1">{{$tema->horastraaut_tema}}</td>
                                  <td class="py-1">{{$tema->semana_tema}}</td>
                              </tr>
                          @endforeach   
                      </tbody>                                 
                </table>                    
                <!--------------------------------------------------modal ingresar tema ..........................-->
                <div class="modal fade " id="ingresarTemaModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel15" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel15"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Ingresar tema</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="ingresarTema_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Tipo de clase</label>
                                                <input id="txtTipoClase" name="txtTipoClase" type="text" class="form-control" tabindex="1" required maxlength="50">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Orden de tema</label>
                                                <input id="txtOrdenTema" name="txtOrdenTema" type="text" class="form-control" tabindex="2" required maxlength="3">
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Título del tema</label>
                                                <input id="txtTituloTema" name="txtTituloTema" type="text" class="form-control" tabindex="3" required maxlength="100">
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-12 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Actividades de docencia</label>
                                                    <textarea id="txtActDocencia" name="txtActDocencia" class="form-control" aria-label="With textarea"  tabindex="4" maxlength="1000" required ></textarea>
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-12 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Actividades de Docencia Prácticas de Aplicación y Experimentación</label>
                                                    <textarea id="txtActDocenciaPracApliExp" name="txtActDocenciaPracApliExp" class="form-control" aria-label="With textarea"  tabindex="5" maxlength="1000" required ></textarea>
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-12 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Actividades de Aprendizaje Autónomo</label>
                                                    <textarea id="txtActAprAut" name="txtActAprAut" class="form-control" aria-label="With textarea"  tabindex="6" maxlength="1000" required ></textarea>
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Horas de docencia</label>
                                                <input id="txtHorasDocencia" name="txtHorasDocencia" type="text" class="form-control" tabindex="7" required maxlength="5">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Horas Aprendizaje y experimentación</label>
                                                <input id="txtHorasAprExp" name="txtHorasAprExp" type="text" class="form-control" tabindex="8" required maxlength="5">
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Horas trabajo autónomo</label>
                                                <input id="txtHorasTraAut" name="txtHorasTraAut" type="text" class="form-control" tabindex="9" required maxlength="5">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Semana</label>
                                                <input id="txtSemana" name="txtSemana" type="text" class="form-control" tabindex="10" required maxlength="3">
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnIngresarTema" name="btnIngresarTema"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar tema</button>
                                    <div id="girarIngresarTema" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->
                <!-----------------------------------modal eliminar unidad--------------------------------------->             
                <div class="modal fade" id="modalEliminarTema_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-light text-dark ">
                                <h5 class="modal-title text-center text-muted" id="exampleModalLabel"><i class="fa fa-check-circle-o mr-2" aria-hidden="true"></i>Confirmar para eliminar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <hr>
                                    ¿Esta seguro de eliminar el tema seleccionado?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarTema" name="btnEliminarTema"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar tema     
                                </button>  
                            </div>
                            <div id="girarEliminarTema" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                <!--------------------------------------------------modal editar tema ..........................-->
                <div class="modal fade " id="editarTemaModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel16" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabel16"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar tema</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="editarTema_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <input type="hidden" id="txtIdTema" name="txtIdTema">
                                    <input type="hidden" id="txtIdUnidadT" name="txtIdUnidadT">
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Tipo de clase</label>
                                                <input id="txtTipoClase2" name="txtTipoClase2" type="text" class="form-control" tabindex="1" required maxlength="50">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Orden de tema</label>
                                                <input id="txtOrdenTema2" name="txtOrdenTema2" type="text" class="form-control" tabindex="2" required maxlength="3">
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Título del tema</label>
                                                <input id="txtTituloTema2" name="txtTituloTema2" type="text" class="form-control" tabindex="3" required maxlength="100">
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-12 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Actividades de docencia</label>
                                                    <textarea id="txtActDocencia2" name="txtActDocencia2" class="form-control" aria-label="With textarea"  tabindex="4" maxlength="1000" required ></textarea>
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-12 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Actividades de Docencia Prácticas de Aplicación y Experimentación</label>
                                                    <textarea id="txtActDocenciaPracApliExp2" name="txtActDocenciaPracApliExp2" class="form-control" aria-label="With textarea"  tabindex="5" maxlength="1000" required ></textarea>
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-12 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Actividades de Aprendizaje Autónomo</label>
                                                    <textarea id="txtActAprAut2" name="txtActAprAut2" class="form-control" aria-label="With textarea"  tabindex="6" maxlength="1000" required ></textarea>
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Horas de docencia</label>
                                                <input id="txtHorasDocencia2" name="txtHorasDocencia2" type="text" class="form-control" tabindex="7" required maxlength="5">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Horas Aprendizaje y experimentacion</label>
                                                <input id="txtHorasAprExp2" name="txtHorasAprExp2" type="text" class="form-control" tabindex="8" required maxlength="5">
                                            </div>
                                    </div>
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Horas trabajo autónomo</label>
                                                <input id="txtHorasTraAut2" name="txtHorasTraAut2" type="text" class="form-control" tabindex="9" required maxlength="5">
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Semana</label>
                                                <input id="txtSemana2" name="txtSemana2" type="text" class="form-control" tabindex="10" required maxlength="3">
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnActualizarTema" name="btnActualizarTema"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                    <div id="girarActualizarTema" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->                 
        </div>        
        <script>//CARGAER  EL FORMULARIO PARA ingresar tema
            function agregarTema(){          
                    $('#ingresarTemaModal').modal('toggle');
                    $("input[name=_token]").val();
            }
        </script>  
        <script>//ingresar tema
                $('#ingresarTema_form').submit(function(e){
                e.preventDefault();
                var tipo_clase=$('#txtTipoClase').val();
                var orden_tema=$('#txtOrdenTema').val();
                var titulo_tema=$('#txtTituloTema').val();
                var actividadesdocencia_tema=$('#txtActDocencia').val();
                var actdocpracapliexp_tema=$('#txtActDocenciaPracApliExp').val();
                var actaprauto_tema=$('#txtActAprAut').val();
                var horasdocencia_tema=$('#txtHorasDocencia').val();
                var horasapreexp_tema=$('#txtHorasAprExp').val();
                var horastraaut_tema=$('#txtHorasTraAut').val();
                var semana_tema=$('#txtSemana').val();
                var id_unidadT=$('#txtUnidadT').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('temas.ingresarTema')}}",
                            type:"POST",
                            data:{
                                tipo_clase:tipo_clase, 
                                orden_tema:orden_tema,
                                titulo_tema:titulo_tema, 
                                actividadesdocencia_tema:actividadesdocencia_tema,
                                actdocpracapliexp_tema:actdocpracapliexp_tema,
                                actaprauto_tema:actaprauto_tema, 
                                horasdocencia_tema:horasdocencia_tema,
                                horasapreexp_tema:horasapreexp_tema, 
                                horastraaut_tema:horastraaut_tema,
                                semana_tema:semana_tema,
                                id_unidadT:id_unidadT,
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnIngresarTema').text('Ingresando Datos..'); 
                                $('#girarIngresarTema').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {  
                                    $.ajax({                                        
                                            url:'/temas/mostrarTemas/'+id_unidadT,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#contenidoTemas').empty().append($(data));
                                                    }
                                                    );
                                                }
                                    });
                                    $('#ingresarTemaModal').modal('hide');
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    $('#btnIngresarTema').text('Agregar unidad'); 
                                    $('#girarIngresarTema').hide(); 
                                }
                            },
                            error:function(response)
                            {
                                $('#ingresarUnidades_modal').modal('hide');
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnIngresarTema').text('Agregar tema'); 
                                $('#girarIngresarTema').hide(); 
                            }
                        });
                })
            </script>          
           <script>
                    $("#txtOrdenTema").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#txtSemana").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#txtHorasDocencia").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9.]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#txtHorasAprExp").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9.]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#txtHorasTraAut").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9.]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#txtOrdenTema2").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#txtSemana2").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#txtHorasDocencia2").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9.]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#txtHorasAprExp2").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9.]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#txtHorasTraAut2").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9.]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
            </script>        
            <script>//eliminar tema
                    var _id;
                    $(document).on('click','.DeleteTema',function(){
                        _id=$(this).attr('id'); 
                       
                        $('#modalEliminarTema_modal').modal('show');
                    });
                    $('#btnEliminarTema').click(function(){
                        var id_unidadT=$('#txtUnidadT').val();  
                        $.ajax({                       
                            url:"/temas/eliminartemas/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarTema').text('Eliminando..'); 
                                $('#girarEliminarTema').show(); 
                            },
                            success:function(data){              
                                    $.ajax({
                                        url:'/temas/mostrarTemas/'+id_unidadT,
                                            success : function(data){
                                                setTimeout(function(){
                                                    $('#contenidoTemas').empty().append($(data));
                                                }
                                                );
                                        }
                                    });  
                                    $('#modalEliminarTema_modal').modal('hide');
                                    toastr.success('El tema fue eliminado exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarTema').text('Eliminar tema'); 
                                    $('#girarEliminarTema').hide();                                                        
                            },
                            error : function(data){
                                toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarTema').text('Eliminar tema'); 
                                $('#girarEliminarTema').hide(); 
                            }  
                        });
                    });
            </script>        
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR tema
                function editarTemas(id){                 
                    $.get('/temas/editartema/'+id, function(Tema)
                    {  
                        //asignar datos recuperados
                        $('#txtIdUnidadT').val(Tema[0].id_unidad);
                        $('#txtIdTema').val(Tema[0].id_tema);
                        $('#txtTipoClase2').val(Tema[0].tipo_clase);
                        $('#txtOrdenTema2').val(Tema[0].orden_tema);
                        $('#txtTituloTema2').val(Tema[0].titulo_tema);
                        $('#txtActDocencia2').val(Tema[0].actividadesdocencia_tema);
                        $('#txtActDocenciaPracApliExp2').val(Tema[0].actdocpracapliexp_tema);
                        $('#txtActAprAut2').val(Tema[0].actaprauto_tema);
                        $('#txtHorasDocencia2').val(Tema[0].horasdocencia_tema);
                        $('#txtHorasAprExp2').val(Tema[0].horasapreexp_tema);
                        $('#txtHorasTraAut2').val(Tema[0].horastraaut_tema);
                        $('#txtSemana2').val(Tema[0].semana_tema);
                        $('#editarTemaModal').modal('toggle');
                        $("input[name=_token]").val();
                    });
                }
            </script>           
             <script>//actualizar tema
                $('#editarTema_form').submit(function(e){
                    e.preventDefault();
                    var id_tema2=$('#txtIdTema').val();
                    var tipo_clase2=$('#txtTipoClase2').val();
                    var orden_tema2=$('#txtOrdenTema2').val();
                    var titulo_tema2=$('#txtTituloTema2').val();
                    var actividadesdocencia_tema2=$('#txtActDocencia2').val();
                    var actdocpracapliexp_tema2=$('#txtActDocenciaPracApliExp2').val();
                    var actaprauto_tema2=$('#txtActAprAut2').val();
                    var horasdocencia_tema2=$('#txtHorasDocencia2').val();
                    var horasapreexp_tema2=$('#txtHorasAprExp2').val();
                    var horastraaut_tema2=$('#txtHorasTraAut2').val();
                    var semana_tema2=$('#txtSemana2').val();
                    var id_unidadT2=$('#txtUnidadT').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('temas.actualizarTema')}}",
                                type:"POST",
                                data:{
                                    id_tema:id_tema2, 
                                    tipo_clase:tipo_clase2,
                                    orden_tema:orden_tema2,
                                    titulo_tema:titulo_tema2,
                                    actividadesdocencia_tema:actividadesdocencia_tema2,
                                    actdocpracapliexp_tema:actdocpracapliexp_tema2,
                                    actaprauto_tema:actaprauto_tema2,
                                    horasdocencia_tema:horasdocencia_tema2,
                                    horasapreexp_tema:horasapreexp_tema2,
                                    horastraaut_tema:horastraaut_tema2,
                                    semana_tema:semana_tema2,
                                    id_unidadT:id_unidadT2,
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizarTema').text('Actualizando..'); 
                                    $('#girarActualizarTema').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        $.ajax({
                                            url:'/temas/mostrarTemas/'+id_unidadT2,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#contenidoTemas').empty().append($(data));
                                                    }
                                                    );
                                            }
                                        });  
                                        $('#editarTemaModal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                        $('#btnActualizarTema').text('Guardar cambios'); 
                                        $('#girarActualizarTema').hide();                                       
                                    }
                                },
                                error:function(response)
                                {                                  
                                    toastr.error('No se actualizaron correctamente los datos intente nuevammente','ERROR AL ACTUALIZAR',{timeOut:1000});
                                        $('#btnActualizarTema').text('Guardar cambios'); 
                                        $('#girarActualizarTema').hide(); 
                                }
                            });
                    })
            </script>
            <script>//CARGAER volver a unidades
                function volverUnidades(id){
                    var id_SilaboT=$('#txtSilaboT').val();
                    $.ajax({
                        url:'/unidad/mostrarUnidades/'+id_SilaboT,
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
                        url:'/subtemas/mostrarSubTemas/'+id,
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