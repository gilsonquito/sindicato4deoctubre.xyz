<head>
    <title>Silabos Pendientes</title>
    <link href="{{asset('css/directorSilabos.css')}}" rel="stylesheet">
</head>
    <body>
            <div class="container-fluid p-2">  
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success " href="#">Sílabos</a>
                    </nav>
                    <div class="container-fluid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Sílabos para Revisión</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Todos los sílabos</a>
                                    </li>
                                </ul> 
                                <div class="p-5 tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        
                                        <table id="tablaSilabosP" class="table table-responsive table-striped w-100">
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
                                                <td class="col-md-1 py-2">Apellido Doc</td>
                                                <td class="col-md-1 py-2">Nombre Doc</td>
                                                <td class="col-md-2 py-2">Acciones</td>
                                            </thead>
                                        </table>
                                    </div> 
                                    <div  class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                       
                                        <div id="seccionSilabos">
                                            <table id="tablaSilabosTodos" class="table table-responsive table-striped w-100">
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
                                                    <td class="col-md-1 py-2">Apellido Doc</td>
                                                    <td class="col-md-1 py-2">Nombre Doc</td>
                                                    <td class="col-md-2 py-2">Acciones</td>
                                                </thead>
                                            </table>
                                        </div> 
                                    </div>     
                                </div>
                        </div>
                                                      
                    </div><!--finc container--> 
                      <!-- Modal CORREGIR -->
                      <div class="modal fade " id="corregirSilabo_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel24" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header btn-light">
                                                    <h5 class="modal-title" id="staticBackdropLabel24">Corregir Sílabo</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="corregirSilabo_edit_form">
                                                    <div class="modal-body">
                                                                @csrf
                                                                    <input type="hidden" id="txtIdSilaboCorregir" name="txtIdSilaboCorregir">
                                                                    <div class="row justify-content-center p-2">
                                                                            <div class="form-group col-md-10 px-2  justify-content-center text-left">
                                                                                <label for="" class="form-label ml-2 text-nowrap">Observaciones</label>
                                                                                <textarea id="txtObservacionesSil" name="txtObservacionesSil" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="200" required ></textarea>
                                                                            </div>
                                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                                        <button type="submit" class="btn btn-success" id="btnCorregirSil" name="btnCorregirSil"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Enviar correciones</button>
                                                        <div id="girarCorregirSilabo" class="lds-dual-ring col-md-12"></div> 
                                                    </div>
                                                
                                                </form>
                                                </div>
                                            </div>
                                        </div>
            </div><!--digeneral-->    
    <script > //cargar tabla en el index
                    $(document).ready(function(){   
                        var silabos=$('#tablaSilabosP').DataTable({
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
                            lengthMenu: [[5,10, 25, -1], [5,10, 25, "All"]],
                            processing:true,  
                            serverSide:true,
                            order: [[9, "desc"], [10, "asc"]],
                            ajax:{
                                url:"/silabosPendientes",
                            },
                            columns:[
                                {data:'escuela'},
                                {data:'plan_estudio'},
                                {data:'nombre_mod'},
                                {data:'duracion_horas'},
                                {data:'nombre_tlic'},
                                {data:'jornada'},
                                {data:'modalidad'},
                                {data:'nombre_paralelo'},
                                {data:'estado'},
                                {data:'fecha_creacion'},
                                {data:'apellido_doc'},
                                {data:'name'},
                                {data:'action',orderable:false}
                            ]
                        });
                        var silaboTodos=$('#tablaSilabosTodos').DataTable({
                            lengthMenu: [[5,10, 25, -1], [5,10, 25, "All"]],
                            processing:true,  
                            serverSide:true,
                            order: [[9, "desc"], [10, "asc"], [2, "asc"]],
                            ajax:{
                                url:"/silabosTodos",
                            },
                            columns:[
                                {data:'escuela'},
                                {data:'plan_estudio'},
                                {data:'nombre_mod'},
                                {data:'duracion_horas'},
                                {data:'nombre_tlic'},
                                {data:'jornada'},
                                {data:'modalidad'},
                                {data:'nombre_paralelo'},
                                {data:'estado'},
                                {data:'fecha_creacion'},
                                {data:'apellido_doc'},
                                {data:'name'},
                                {data:'action',orderable:false}
                            ]
                        });

                    });

        </script>  
         <script>//CARGAR EN EL FORMULARIO PARA visualizar
                    function visualizarSilabo(id){
                            if(id)
                            { 
                               window.open("/director/silaboDocente/"+id, '_blank');  
                            }  
                    }
                    function aprobarSilabos(id){
                                $.ajax({
                                    url:"/director/aprobarSilabo/"+id,
                                    success:function(data){
                                        var estado=$('#tablaSilabosP').DataTable();
                                        estado.ajax.reload(); 
                                        var estado2=$('#tablaSilabosTodos').DataTable();
                                        estado2.ajax.reload(); 
                                        toastr.success('El sílabo fue aprobado exitosamente','¡EXITOSO!',{timeOut:1000});
                                    },
                                    error : function(response){
                                            toastr.error('Ocurrio un error, vuelva a intentarlo','¡FALLIDA!',{timeOut:1000});
                                    }
                                });      
                    }
                    function silaboAPendiente(id){
                                $.ajax({
                                    url:"/director/pendienteSilabo/"+id,
                                    success:function(data){
                                        var estado=$('#tablaSilabosP').DataTable();
                                        estado.ajax.reload(); 
                                        var estado2=$('#tablaSilabosTodos').DataTable();
                                        estado2.ajax.reload(); 
                                        toastr.success('El sílabo fue enviado a Pendiente exitosamente','¡EXITOSO!',{timeOut:1000});
                                    },
                                    error : function(response){
                                            toastr.error('Ocurrio un error, vuelva a intentarlo','¡FALLIDA!',{timeOut:1000});
                                    }
                                });      
                    }
                   
                    
          </script>
     
            <script>//
            
                    function corregirSilbaos(id){
                        $('#txtIdSilaboCorregir').val(id);
                        $('#corregirSilabo_edit_modal').modal('toggle');       
                    }
                   
                    $('#corregirSilabo_edit_form').submit(function(e){
                        e.preventDefault();
                        var id_sil=$('#txtIdSilaboCorregir').val();
                        var estado=$('#txtObservacionesSil').val();
                        
                        var _token2=$("input[name=_token]").val();
                        
                                $.ajax({
                                    url:"{{route('director.revisarSilabo')}}",
                                    type:"POST",
                                    data:{
                                        id_sil:id_sil, 
                                        estado:estado,
                                        _token:_token2
                                    },
                                    beforeSend:function(){
                                        $('#btnCorregirSil').text('Enviando Corrección..'); 
                                        $('#girarCorregirSilabo').show(); 
                                    },
                                    success:function(response)
                                    {
                                        if(response)
                                        {
                                            $('#corregirSilabo_edit_modal').modal('hide');
                                            toastr.success('Se envió correción exitosamente','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                            var estado=$('#tablaSilabosP').DataTable();
                                            estado.ajax.reload(); 
                                            var estado2=$('#tablaSilabosTodos').DataTable();
                                            estado2.ajax.reload(); 
                                            $('#btnCorregirSil').text('Enviar correciones'); 
                                            $('#girarCorregirSilabo').hide(); 
                                        }
                                    },
                                    error:function(response)
                                    {
                                        $('#corregirSilabo_edit_modal').modal('hide');
                                        toastr.error('No se envio la correción','ERROR AL ENVIAR',{timeOut:1000});
                                        $('#btnCorregirSil').text('Enviar correciones'); 
                                        $('#girarCorregirSilabo').hide();  
                                    }
                                    
                                });
                    })
            </script>

           
</body>

