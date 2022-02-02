<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/periodohorario.css')}}" rel="stylesheet">
        <title>Periodo Horarios</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success " href="#">Período de Horarios</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de períodos de horarios</a>
                                    </li>
                                    <li class="nav-item" onclick="cargarPeriodoA()">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Nuevo período de horarios</a>
                                    </li>
                                </ul>
                           
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <!--TablaPeriodos horarios</h3>-->
                                    <table id="tabla-periodohorarios" class="table table-striped table-responsive-lg table-hover w-100">
                                        <thead  class="font-weight-bold text-dark ">
                                            <tr>
                                                <td class="align-middle" rowspan="2">Id</td>
                                                <td class="align-middle" colspan="2">PERÍODO ACADÉMICO</td>
                                                <td class="align-middle" colspan="2">PERÍODO HORARIO</td>
                                                <td class="align-middle" rowspan="2">Tipo Licencia</td>
                                                <td class="align-middle" rowspan="2">Acciones</td>
                                            </tr>
                                            <tr>
                                                <td >Fecha Inicio PA</td>
                                                <td >Fecha fin PA</td>
                                                <td  >Fecha Inicio PH</td>
                                                <td  >Fecha Fin PH</td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <!-- <h3 class="py-3" >Nuevo periodo horario</h3-->
                                    <form id="ingreso-periodohorario">
                                            <div class="row justify-content-center p-2">
                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Fecha de inicio de período</label>
                                                        <input id="dateInih" name="dateInih" type="date" class="form-control" tabindex="1" required>
                                                    </div>
                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label text-nowrap">Fecha de finalización de período</label>
                                                        <input id="dateFinh" name="dateFinh" type="date" class="form-control" tabindex="2" required>
                                                    </div>
                                            </div>
                                            <div class="row justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="select">Período académico</label>
                                                                            <select class="form-control" id="selPeriodoAcademico" name="selPeriodoAcademico" tabindex="3" required>
                                                                        </select>
                                                                    </div>          
                                            </div>
                                            <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Crear</button>
                                    </form>
                                </div>
                            </div>
                            <!-----------------------------------modal eliminar--------------------------------------->
                                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header btn-light text-dark ">
                                                        <h5 class="modal-title text-center" id="exampleModalLabel">Confirmar para eliminar Periodo de horario</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <hr>
                                                        ¿Esta seguro de eliminar el período de horario seleccionado?
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
                                        <div class="modal fade " id="periodohorario_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar Periodo</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="periodohorario_edit_form">
                                                <div class="modal-body">
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                                <div class="row justify-content-center p-2">
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="" class="form-label ml-2 text-nowrap">Fecha de inicio de período</label>
                                                                            <input id="dateInih2" name="dateInih2" type="date" class="form-control" tabindex="1" required>
                                                                        </div>
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="" class="form-label text-nowrap">Fecha de finalización de período</label>
                                                                            <input id="dateFinh2" name="dateFinh2" type="date" class="form-control" tabindex="2" required>
                                                                        </div>
                                                                </div>
                                                                <div class="row justify-content-center p-2">
                                                                                        <div class="form-group col-md-12 px-2  justify-content-center text-left">
                                                                                            <label for="select">Período académico</label>
                                                                                                <select class="form-control" id="selPeriodoAcademico2" name="selPeriodoAcademico2" tabindex="3" required>
                                                                                            </select>
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
                        
                        var periodoacademico=$('#tabla-periodohorarios').DataTable({
                            processing:true,
                            columnDefs: [
                                { className: "align-middle" , targets: "_all" }
                            ],
                            serverSide:true,
                            order: [[1, "desc"], [2, "desc"], [3, "desc"], [4, "desc"], [5, "asc"]],
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
                                url:"{{route('periodohorario.index')}}",
                            },
                            columns:[
                                {data:'id_phorario'},
                                {data:'fechaini'},
                                {data:'fechafin'},
                                {data:'fecha_inicio'},
                                {data:'fecha_fin'},
                                {data:'nombre_tipolicencia'},
                                {data:'action',orderable:false}
                            ]
                        });
                    });

            </script>
             <script>//CARGAER select periodos academicos
                function cargarPeriodoA(){
                    $.get('/periodohorario/cargarperiodoa', function(data)
                    {
                        //asignar valores a select cursos licencia
                        $('#selPeriodoAcademico').empty();
                        for (var i in data) {
                            if(data[i].id)
                            {        
                                    document.getElementById("selPeriodoAcademico").innerHTML += "<option value='"+data[i].id+"'>"+data[i].fechaini+" - "+data[i].fechafin+" / "+data[i].nombre_tipolicencia+"</option>";            
                            }     
                        }                 
                    });
                    

                }
            </script>
            <script> //ingresar un nuevo perido
                    $('#ingreso-periodohorario').submit(function(e){
                        e.preventDefault();  
                        var fecha_inicioh=$('#dateInih').val();
                        var fecha_finh=$('#dateFinh').val();
                        var id_periodoh=$('#selPeriodoAcademico').val();
                        var _token=$("input[name=_token]").val();
                                if (fecha_inicioh<fecha_finh)
                                {
                                    $.ajax({
                                        url:"{{route('periodohorario.ingresar')}}",
                                        type:"POST",
                                        async: true,
                                        data:{
                                            fecha_inicio:fecha_inicioh,
                                            fecha_fin:fecha_finh,
                                            id_periodo:id_periodoh,
                                            _token:_token
                                        },
                                        success:function(response)
                                        {   
                                            if(response==true)
                                            {
                                                $('#ingreso-periodohorario')[0].reset();
                                                toastr.success('El registro fue exitoso','¡EXITOSO!',{timeOut:3000});
                                                $('#tabla-periodohorarios').DataTable().ajax.reload();
                                            }
                                            if(response==false){
                                                toastr.warning('Las fechas ingresadas estan fuera del rango del periodo seleccionado','ERROR',{timeOut:3000});
                                            }
                                            if(response==2){
                                                toastr.warning('Ya existe un periodo de horario con los datos ingresados','FALLIDO',{timeOut:3000});
                                            }
                                        },
                                        error : function(response){
                                            toastr.error('No se realizo el registro, intente nuevamente','ERROR',{timeOut:3000});
                                        }
                                    });
                                }
                                else
                                {
                                    toastr.warning('La fecha final tiene que ser mayor a la fecha de inicio','FECHA INCORRECTA',{timeOut:3000});
                                }
                    })

            </script>
           
            <script>//eliminar un periodo horario
                    var _id;
                    $(document).on('click','.delete',function(){
                    _id=$(this).attr('id'); 
                    $('#confirmModal').modal('show');
                    });
                    $('#btnEliminar').click(function(){
                    $.ajax({
                        url:"/periodohorario/eliminar/"+_id,
                        beforeSend:function(){
                            $('#btnEliminar').text('Eliminando..'); 
                            $('#girar').show(); 
                        },
                        success:function(data){
                           if(data)
                           {
                                $('#confirmModal').modal('hide');
                                toastr.success('El periodo fue eliminado exitosamente','¡EXITOSO!',{timeOut:3000});
                                $('#tabla-periodohorarios').DataTable().ajax.reload();
                                $('#btnEliminar').text('Eliminar'); 
                                $('#girar').hide(); 
                           }
                           else{
                                toastr.warning('No se puede eliminar periodo de horario, El período académico seleccionado a terminado ¡NADA QUE HACER!','¡FALLIDA!',{timeOut:3000});
                                $('#btnEliminar').text('Eliminar'); 
                                $('#girar').hide(); 
                           }   
                        },
                        error : function(response){
                                toastr.error('Ocurrio un error','¡FALLIDA!',{timeOut:3000});
                                $('#confirmModal').modal('hide');
                                $('#btnEliminar').text('Eliminar'); 
                                $('#girar').hide(); 
                        }
                    });
                    });

            </script>
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR
                    function editarPeriodoHorario(id){
                    $.get('/periodohorario/editar/'+id, function(periodohorario)
                    {
                        //asignar valores a select tipo licencia2
                        $('#selPeriodoAcademico2').empty();
                            for (var i in periodohorario) {
                                if(periodohorario[i].id)
                                {        
                                    if(!(i==0))
                                        {   
                                            document.getElementById("selPeriodoAcademico2").innerHTML += "<option value='"+periodohorario[i].id+"'>"+periodohorario[i].fechaini+" - "+periodohorario[i].fechafin+" / "+periodohorario[i].nombre_tipolicencia+"</option>";            
                                        }
                                }     
                            }       
                            //asignar datos recuperados
                            $('#txtId2').val(periodohorario[0].id_phorario);
                            $('#dateInih2').val(periodohorario[0].fecha_inicio);
                            $('#dateFinh2').val(periodohorario[0].fecha_fin);
                            $('#selPeriodoAcademico2').val(periodohorario[0].id_periodo);
                            $("input[name=_token]").val();
                            $('#periodohorario_edit_modal').modal('toggle');
                    });
                    }
           </script>
           <script>
                    $('#periodohorario_edit_form').submit(function(e){
                        e.preventDefault();
                        var id_phorario2=$('#txtId2').val();
                        var fecha_inicioh2=$('#dateInih2').val();
                        var fecha_finh2=$('#dateFinh2').val();
                        var id_periodoh2=$('#selPeriodoAcademico2').val();
                        var _token2=$("input[name=_token]").val();
                        if (fecha_inicioh2<fecha_finh2)
                        {
                                $.ajax({
                                    url:"{{route('periodohorario.actualizar')}}",
                                    type:"POST",
                                    data:{
                                        id_phorario:id_phorario2, 
                                        fecha_inicioh:fecha_inicioh2,
                                        fecha_finh:fecha_finh2,
                                        id_periodoh:id_periodoh2,
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
                                            $('#periodohorario_edit_modal').modal('hide');
                                            toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                            $('#tabla-periodohorarios').DataTable().ajax.reload();
                                            $('#btnActualizar').text('Guardar cambios'); 
                                            $('#girar2').hide(); 
                                        }
                                        else
                                        {
                                            toastr.warning('Las fechas ingresadas estan fuera del rango del periodo seleccionado','ERROR',{timeOut:3000});
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
                                toastr.warning('La fecha final tiene que ser mayor a la fecha de inicio','HORA INCORRECTA',{timeOut:3000});
                        }
                        })
            </script>     
    <body>
</html>

