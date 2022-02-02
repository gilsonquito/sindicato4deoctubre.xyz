<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/periodoaca.css')}}" rel="stylesheet">
        <title>Horarios</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success " href="#">Horarios</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de horarios</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Nuevo horario</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <!--TablaPeriodos Académicos</h3>-->
                                    <table id="tabla-horarios" class="table table-responsive-lg table-hover w-100 ">
                                        <thead  class="font-weight-bold text-dark ">
                                            <td scope="col">Id</td>
                                            <td scope="col">Días</td>
                                            <td scope="col">Hora Inicio</td>
                                            <td scope="col">Hora Fin</td>
                                            <td scope="col">Acciones</td>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                   <!-- MODAL Nuevo Horario-->
                                    <form id="ingreso-horario">
                                            <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="select">Días</label>
                                                    <select class="form-control" id="selDia" name="selDia" tabindex="1" required>
                                                        <option value="Lun-Vie">Lun-Vie</option>
                                                        <option value="Sab-Dom">Sab-Dom</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center p-2">
                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Hora inicio </label>
                                                        <input id="timeHoraInicio" name="timeHoraInicio" type="time" class="form-control" tabindex="2" required>
                                                    </div>
                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label text-nowrap">Hora fin</label>
                                                        <input id="timeHoraFin" name="timeHoraFin" type="time" class="form-control" tabindex="3" required>
                                                    </div>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Crear horario</button>
                                    </form>
                                </div>
                            </div>
                            <!-----------------------------------modal eliminar--------------------------------------->
                                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header btn-light text-dark ">
                                                        <h5 class="modal-title text-center" id="exampleModalLabel">Confirmar para eliminar horario</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <hr>
                                                        ¿Esta seguro de eliminar el horario seleccionado?
                                                        <hr>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                                        <button type="button" class="btn btn-danger" id="btnEliminar" name="btnEliminar"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar   
                                                        </button>
                                                    </div>
                                                    <div id="girar" class="lds-dual-ring"></div> 
                                                </div>
                                            </div>
                                    </div><!--finc modal--> 
                                    <!--------------------------------------------------modal editar ..........................-->
                                    <!-- Button trigger modal -->
                                        <!-- Modal -->
                                        <div class="modal fade " id="horario_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar horario</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="horario_edit_form">
                                                <div class="modal-body">
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                                <div class="row justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="select">Día</label>
                                                                        <select class="form-control" id="selDia2" name="selDia2" tabindex="1" required>
                                                                            <option value="Lun-Vie">Lun-Vie</option>
                                                                            <option value="Sab-Dom">Sab-Dom</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-center p-2">
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="" class="form-label ml-2 text-nowrap">Hora inicio </label>
                                                                            <input id="timeHoraInicio2" name="timeHoraInicio2" type="time" class="form-control" tabindex="2" required>
                                                                        </div>
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="" class="form-label text-nowrap">Hora fin</label>
                                                                            <input id="timeHoraFin2" name="timeHoraFin2" type="time" class="form-control" tabindex="3" required>
                                                                        </div>
                                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                                    <button type="submit" class="btn btn-success" id="btnActualizar" name="btnActualizar"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                                    <div id="girar2" class="lds-dual-ring col-md-12"></div> 
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>                            
                    </div><!--finc container--> 
            </div><!--digeneral-->    
            <script type="text/javascript"> //cargar tabla en el index
                    $(document).ready(function(){
                        
                        var periodoacademico=$('#tabla-horarios').DataTable({
                            columnDefs: [
                                { className: "align-middle" , targets: "_all" }
                            ],
                            processing:true,
                            serverSide:true,
                            order: [[1, "asc"], [2, "asc"], [3, "asc"]],
                            language: {
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
                           
                            ajax:{
                                url:"{{route('horario.index')}}",
                            },
                            columns:[
                                {data:'id_horario'},
                                {data:'tipo_dias'},
                                {data:'hora_inicio'},
                                {data:'hora_fin'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });

            </script>
            <script> //ingresar un nuevo perido
                    $('#ingreso-horario').submit(function(e){
                        e.preventDefault();  
                        var tipo_dias=$('#selDia').val();
                        var hora_inicio=$('#timeHoraInicio').val();
                        var hora_fin=$('#timeHoraFin').val();
                        var _token=$("input[name=_token]").val();
                                if (hora_inicio<hora_fin)
                                {
                                    $.ajax({
                                        url:"{{route('horario.ingresar')}}",
                                        type:"POST",
                                        async: true,
                                        data:{
                                            tipo_dias:tipo_dias,
                                            hora_inicio:hora_inicio,
                                            hora_fin:hora_fin,
                                            _token:_token
                                        },
                                        success:function(response)
                                        {   
                                            if(response)
                                            {
                                                if(response==1)
                                                {
                                                    $('#ingreso-horario')[0].reset();
                                                    toastr.success('El registro fue exitoso','¡EXITOSO!',{timeOut:3000});
                                                    $('#tabla-horarios').DataTable().ajax.reload();
                                                }
                                                if(response==2)
                                                {
                                                    toastr.warning('Ya existe el horario ingresado','¡EXITOSO!',{timeOut:3000});
                                                }
                                                
                                            }
                                            
                                        },
                                        error : function(response){
                                            toastr.error('No se realizo el registro, intente nuevamente','ERROR',{timeOut:3000});
                                        }
                                    });
                                }
                                else
                                {
                                    toastr.warning('La hora final tiene que ser mayor a la hora de inicio','HORA INCORRECTA',{timeOut:3000});
                                }
                    })

            </script>
           
            <script>//eliminar un horario
                    var _id;
                    $(document).on('click','.delete',function(){
                    _id=$(this).attr('id'); 
                    $('#confirmModal').modal('show');
                    });
                    $('#btnEliminar').click(function(){
                    $.ajax({
                        url:"/horario/eliminar/"+_id,
                        beforeSend:function(){
                            $('#btnEliminar').text('Eliminando..'); 
                            $('#girar').show(); 
                        },
                        success:function(data){
                           
                                $('#confirmModal').modal('hide');
                                toastr.success('El horario fue eliminado exitosamente','¡EXITOSO!',{timeOut:3000});
                                $('#tabla-horarios').DataTable().ajax.reload();
                                $('#btnEliminar').text('Eliminar'); 
                                $('#girar').hide(); 
                        },
                        error : function(response){
                                toastr.error('Ocurrio un error, es posible que el horario ya este asignado en otra tabla y no se puede borrar','¡FALLIDA!',{timeOut:4000});
                                $('#confirmModal').modal('hide');
                                $('#btnEliminar').text('Eliminar'); 
                                $('#girar').hide(); 
                        }
                    });
                    });

            </script>
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR
                    function editarHorario(id){
                    $.get('/horario/editar/'+id, function(horario)
                    {
                        $('#txtId2').val(horario[0].id_horario);
                        $('#selDia2').val(horario[0].tipo_dias);
                        $('#timeHoraInicio2').val(horario[0].hora_inicio);
                        $('#timeHoraFin2').val(horario[0].hora_fin);
                        $("input[name=_token]").val();
                        $('#horario_edit_modal').modal('toggle');
                    });
                    }
           </script>
           <script>
                    $('#horario_edit_form').submit(function(e){
                        e.preventDefault();
                        var id_horario2=$('#txtId2').val();
                        var tipo_dias2=$('#selDia2').val();
                        var hora_inicio2=$('#timeHoraInicio2').val();
                        var hora_fin2=$('#timeHoraFin2').val();
                        var _token2=$("input[name=_token]").val();
                        if (hora_inicio2<hora_fin2)
                        {
                                $.ajax({
                                    url:"{{route('horario.actualizar')}}",
                                    type:"POST",
                                    data:{
                                        id_horario:id_horario2, 
                                        tipo_dias:tipo_dias2,
                                        hora_inicio:hora_inicio2,
                                        hora_fin:hora_fin2,
                                        _token:_token2
                                    },
                                    beforeSend:function(){
                                        $('#btnActualizar').text('Actualizando..'); 
                                        $('#girar2').show(); 
                                    },
                                    success:function(response)
                                    {   
                                        if(response)
                                        {
                                            $('#horario_edit_modal').modal('hide');
                                            toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                            $('#tabla-horarios').DataTable().ajax.reload();
                                            $('#btnActualizar').text('Guardar cambios'); 
                                            $('#girar2').hide(); 
                                        }
                                    },
                                    error : function(response){
                                        toastr.error('Ocurrio un eror intente nuevamente','¡FALLIDA!',{timeOut:3000});
                                        $('#btnActualizar').text('Guardar cambios'); 
                                        $('#girar2').hide(); 
                            }
                                });
                        }
                        else
                        {
                                toastr.warning('La hora final tiene que ser mayor a la hora de inicio','HORA INCORRECTA',{timeOut:3000});
                        }
                        })
            </script>     
    <body>
</html>

