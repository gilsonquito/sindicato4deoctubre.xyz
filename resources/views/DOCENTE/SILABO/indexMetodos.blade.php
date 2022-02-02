    <head>
        <link href="{{asset('css/tablaMetodos.css')}}" rel="stylesheet">
        <title>Metodos</title>
    </head>
    <body>
        <div id="contenidoMetodos">
            <p class="text-left font-weight-bold text-muted" href="#">MÉTODOS</p>
                <hr color="" class="border border-muted w-100 p-0">
            <input type="hidden" id="txtSilaboM" name="txtSilaboM" value="{{session('idSilabo')}}">
            <div class="row w-100">
                    <div class="col col-md-6">
                        <div>
                            <table id="tablaMetodos"  class="table table-striped table-bordered table-responsive-lg w-100">
                                <thead  class="font-weight-bold text-dark ">
                                    <td scope="col-md-4">Metodos</td>
                                    <td scope="col-md-3">Acciones</td>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="col col-md-6 align-self-center">
                        <div class="mr-auto p-2">
                            <button onclick="agregarMetodoE()" class="btn btn-outline-success" id="btnAgregarMetodoE" name="btnAgregarMetodoE"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>Agregar Método</button>
                        </div>
                        <div class=" p-2">
                            <button onclick="selecionarMetodoE()" class="btn btn-outline-success" id="btnSeleccionarMetodoE" name="btnSeleccionarMetodoE"><i class="fa fa-list-ul mr-2" aria-hidden="true"></i>Seleccionar método</button>
                        </div>
                    </div>  
            </div>
                    <!--------------------------------------------------modal ingresar metodo ..........................-->
                <div class="modal fade " id="ingresarMetodo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelM1" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabelM1"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Ingresar Método</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="ingresarMetodo_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Método</label>
                                                    <input id="txtMetodoE" name="txtMetodoE" type="text" class="form-control" tabindex="1" required maxlength="80">
                                            </div>   
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnIngresarMetodo" name="btnIngresarMetodo"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Método</button>
                                    <div id="girarIngresarMetodo" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->
                      <!--------------------------------------------------modal seleccionar metodo ..........................-->
                    <div class="modal fade " id="seleccionarMetodo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelM2" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabelM2"><i class="fa fa-list-ul mr-2" aria-hidden="true"></i>Seleccionar Método</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="seleccionarMetodo_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Método</label>
                                                    <select class="form-control" id="selMetodo" name="selMetodo" tabindex="1" title="seleccionar metodo" required>
                                                                    <option value="Analítico">Analítico</option>
                                                                    <option value="Aprendizaje Activo">Aprendizaje Activo</option>
                                                                    <option value="Aprendizaje basado en proyectos">Aprendizaje basado en proyectos</option>
                                                                    <option value="Aprendizaje basado en problemas">Aprendizaje basado en problemas</option>
                                                                    <option value="Aprendizaje Colaborativo">Aprendizaje Colaborativo</option>
                                                                    <option value="Aprendizaje por Descubrimiento">Aprendizaje por Descubrimiento</option>
                                                                    <option value="Constructivista-Participativo">Constructivista-Participativo</option>
                                                                    <option value="Digitales">Digitales</option>
                                                                    <option value="Exposición de trabajos">Exposición de trabajos</option>
                                                                    <option value="Foros">Foros</option>
                                                                    <option value="Itinerarios">Itinerarios</option>
                                                                    <option value="Taller de discusión">Taller de discusión</option>
                                                                    <option value="Topográfico">Topográfico</option> 
                                                    </select>
                                            </div>   
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnseleccionarMetodo" name="btnseleccionarMetodo"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Agregar Método</button>
                                    <div id="girarIngresarMetodoSel" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->
                <!-----------------------------------modal eliminar metodo--------------------------------------->             
                <div class="modal fade" id="modalEliminarMetodo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
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
                                    ¿Esta seguro de eliminar el método seleccionado?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarMetodo" name="btnEliminarMetodo"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar Método     
                                </button>  
                            </div>
                            <div id="girarEliminarMetodo" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                <!--------------------------------------------------modal editar metodo ..........................-->
                    <div class="modal fade " id="editarMetodoModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelM3" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header btn-light">
                            <h5 class="modal-title text-secondary" id="staticBackdropLabelM3"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar Método</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <form id="editarMetodo_form">
                                <div class="modal-body">                      
                                    @csrf
                                    <input type="hidden" id="txtIdMetodo" name="txtIdMetodo">
                                    <input type="hidden" id="txtIdSilMe" name="txtIdSilMe">
                                    <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="" class="form-label ml-2 text-nowrap">Método</label>
                                                    <input id="txtMetodoE2" name="txtMetodoE2" type="text" class="form-control" tabindex="1" required maxlength="80">
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                    <button type="submit" class="btn btn-success" id="btnActualizarMetodo" name="btnActualizarMetodo"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                    <div id="girarActualizarMetodo" class="lds-dual-ring col-md-12"></div> 
                                </div>                         
                            </form>
                        </div>
                    </div>
                </div><!--fin modal ingresar-->                  
        </div>        
            <script > //cargar tabla en el index
                    $(document).ready(function(){
                            var metodos=$('#tablaMetodos').DataTable({
                                columnDefs: [
                                { className: "align-middle" , targets: "_all" }
                            ], language: {
                            "decimal": "",
                            "emptyTable": "No hay información",
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ Entradas",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscar:",
                            "zeroRecords": "Sin resultados encontrados",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ultimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        },
                            lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
                            ajax:{
                                url:"/metodos",
                            },
                            columns:[
                                {data:'descripcion_metodo'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });

            </script>    
        <script>//CARGAER  EL FORMULARIO PARA ingresar metodo
            function agregarMetodoE(){          
                    $('#ingresarMetodo').modal('toggle');
                    $("input[name=_token]").val();
            }
            function selecionarMetodoE(){          
                    $('#seleccionarMetodo').modal('toggle');
                    $("input[name=_token]").val();
            }
            
        </script>  
        <script>//ingresar metodo
                $('#ingresarMetodo_form').submit(function(e){
                e.preventDefault();
                var descripcion_metodo=$('#txtMetodoE').val();
                var id_silM=$('#txtSilaboM').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('metodos.ingresarMetodos')}}",
                            type:"POST",
                            data:{ 
                                descripcion_metodo:descripcion_metodo,
                                id_sil:id_silM, 
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnIngresarMetodo').text('Ingresando Datos..'); 
                                $('#girarIngresarMetodo').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    var metodos=$('#tablaMetodos').DataTable();
                                    metodos.ajax.reload();
                                    $('#ingresarMetodo').modal('hide');
                                    document.getElementById("ingresarMetodo_form").reset();
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    $('#btnIngresarMetodo').text('Agregar Método'); 
                                    $('#girarIngresarMetodo').hide(); 
                                }
                            },
                            error:function(response)
                            {
                                
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnIngresarMetodo').text('Agregar Método'); 
                                $('#ingresarSubTemaModal').modal('hide');
                               
                            }
                        });
                })
            </script>
            <script>//seleccionar metodo
                $('#seleccionarMetodo_form').submit(function(e){
                e.preventDefault();
                var descripcion_metodo=$('#selMetodo').val();
                var id_silM=$('#txtSilaboM').val();
                var _token=$("input[name=_token]").val();
                
                        $.ajax({
                            url:"{{route('metodos.ingresarMetodos')}}",
                            type:"POST",
                            data:{ 
                                descripcion_metodo:descripcion_metodo,
                                id_sil:id_silM, 
                                _token:_token
                            },
                            beforeSend:function(){
                                $('#btnseleccionarMetodo').text('Ingresando Datos..'); 
                                $('#girarIngresarMetodoSel').show(); 
                            },
                            success:function(response)
                            {
                                if(response)
                                {
                                    $('#tablaMetodos').DataTable().ajax.reload();
                                    $('#seleccionarMetodo').modal('hide');
                                    document.getElementById("seleccionarMetodo_form").reset();
                                    toastr.success('Se ingresaron correctamente los datos','INGRESO EXITOSO',{timeOut:1000});
                                    $('#btnseleccionarMetodo').text('Agregar Método'); 
                                    $('#girarIngresarMetodoSel').hide(); 
                                }
                            },
                            error:function(response)
                            {
                                
                                toastr.error('No se ingresaron los datos','ERROR AL INGRESAR',{timeOut:1000});
                                $('#btnseleccionarMetodo').text('Agregar Método'); 
                                $('#girarIngresarMetodoSel').hide();                             
                            }
                        });
                })
            </script>  
            <script>//eliminar metodo
                    var _id;
                    $(document).on('click','.DeleteMetodo',function(){
                        _id=$(this).attr('id');       
                        $('#modalEliminarMetodo_modal').modal('show');
                    });
                    $('#btnEliminarMetodo').click(function(){
                        var idSilabo=$('#txtSilaboM').val();
                        $.ajax({
                            url:"/metodos/eliminarMetodos/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarMetodo').text('Eliminando..'); 
                                $('#girarEliminarMetodo').show(); 
                            },
                            success:function(data){              
                                    $('#tablaMetodos').DataTable().ajax.reload();
                                    $('#modalEliminarMetodo_modal').modal('hide');
                                    toastr.success('El método fue eliminado exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarMetodo').text('Eliminar Método'); 
                                    $('#girarEliminarMetodo').hide();   
                            },
                            error : function(data){
                                toastr.warning('Ocurrio un error inesperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarMetodo').text('Eliminar Método'); 
                                $('#girarEliminarMetodo').hide(); 
                            }  
                        });
                    });
            </script>
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR metodo
                function editarMetodoE(id){   
                    $.get('/metodos/editarMetodos/'+id, function(metodo)
                    {  
                        //asignar datos recuperados
                        $('#txtIdMetodo').val(metodo[0].id_metodo);
                        $('#txtMetodoE2').val(metodo[0].descripcion_metodo);
                        $('#txtIdSilMe').val(metodo[0].id_sil);
                        $('#editarMetodoModal').modal('toggle');
                        $("input[name=_token]").val();
                    });
                }
            </script> 
             <script>//actualizar metodo
                $('#editarMetodo_form').submit(function(e){
                    e.preventDefault();
                    var id_metodo2=$('#txtIdMetodo').val();
                    var descripcion_metodo2=$('#txtMetodoE2').val();
                    var id_sil2=$('#txtIdSilMe').val();
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('metodos.actualizarMetodos')}}",
                                type:"POST",
                                data:{
                                    id_metodo:id_metodo2,
                                    descripcion_metodo:descripcion_metodo2,
                                    id_sil:id_sil2,
                                    _token:_token2
                                },
                                beforeSend:function(){
                                    $('#btnActualizarMetodo').text('Actualizando..'); 
                                    $('#girarActualizarMetodo').show(); 
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        $('#tablaMetodos').DataTable().ajax.reload();  
                                        $('#editarMetodoModal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                        $('#btnActualizarMetodo').text('Guardar cambios'); 
                                        $('#girarActualizarMetodo').hide(); 
                                        
                                    }
                                },
                                error:function(response)
                                {     
                                    toastr.error('No se actualizaron correctamente los datos intente nuevammente','ERROR AL ACTUALIZAR',{timeOut:3000});
                                    $('#btnActualizarMetodo').text('Guardar cambios'); 
                                    $('#girarActualizarMetodo').hide(); 
                                }
                            });
                    })
            </script> 
    <body>
