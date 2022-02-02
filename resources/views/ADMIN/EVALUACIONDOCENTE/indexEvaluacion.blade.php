<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/evaluacion.css')}}" rel="stylesheet">  
        <title>Evaluación Docente</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Evaluación Docente</a>
                    </nav>
                    <div class="container-fuid">
                            <div>
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="list" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de evaluaciones</a>
                                    </li>
                                    <li class="nav-item"  onclick="cargarSelectsEvaluacion()">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="list" aria-controls="profile" aria-selected="false"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Nueva evaluación</a>

                                    </li>
                                    <li class="nav-item"  onclick="cargarSelectsActivar()">
                                        <a class=" nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="list" aria-controls="profile3" aria-selected="false"><i class="fa fa-calendar-check-o  text-success mr-2" aria-hidden="true"></i>Activar evaluaciones</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                         
                                    <table id="tabla-evaluacionDocente" class="table table-striped  table-responsive table-hover w-100">
                                        <thead  class="font-weight-bold text-dark ">
                                            <tr>
                                                <td colspan="2" class="col-md-2 align-middle" >PERÍODO ACADÉMICO</td>
                                                <td rowspan="2" class="col-md-1 align-middle">Tipo licencia</td>
                                                <td rowspan="2" class="col-md-1 align-middle">Paralelo</td>
                                                <td rowspan="2" class="col-md-1 align-middle">Módulo</td>
                                                <td rowspan="2" class="col-md-1 align-middle">Apellido</td>
                                                <td rowspan="2" class="col-md-1 align-middle">Nombre</td>
                                                <td colspan="2" class="col-md-2 align-middle">EVALUACIÓN</td>
                                                <td rowspan="2" class="col-md-1 align-middle">Estado</td>
                                                <td rowspan="2" class="col-md-2 align-middle">Link Evaluación</td>
                                                <td rowspan="2" class="col-md-1 align-middle">Acciones</td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-1 align-middle">Inicio</td>
                                                <td class="col-md-1 align-middle">Fin</td>
                                                <td class="col-md-1 align-middle">Fecha Inicio</td>
                                                <td class="col-md-1 align-middle">Fecha Fin</td>
                                            </tr>
                                        </thead>
                                    </table>

                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                   <!-- <h3 class="py-3" >Nueva evaluacion</h3-->
                                    <form id="ingreso-evaluacion">
                                    @csrf
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="select">Períodos Acádemicos</label>
                                                    <select class="form-control" id="selPeriodo" name="selPeriodo" tabindex="1" tile="Seleccione periodo academico" required>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="select">Cursos</label>
                                                    <select class="form-control" id="SelCursos" name="SelCursos" tabindex="2" tile="Seleccione periodo academico" required>
                                                        <option selected="true" disabled="disabled" value="">Seleccione un curso</option>    
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="select">Módulos</label>
                                                    <select class="form-control" id="selModulos" name="selModulos" tabindex="3" tile="Seleccione un módulo" required>
                                                        <option selected="true" disabled="disabled" value="">Seleccione un módulo</option>  
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label">Fecha Inicio</label>
                                                <input id="dateFechaInicio" name="dateFechaInicio" type="date" class="form-control" tile="Ingrese fecha de inicio evaluacion" tabindex="4" maxlength="2" required>
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label">Fecha Fin</label>
                                                <input id="dateFechaFin" name="dateFechaFin" type="date" class="form-control" tile="Ingrese fecha de finalizacion evaluacion" tabindex="5" maxlength="2" required>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="select">Estado</label>
                                                    <select class="form-control" id="selEstado" name="selEstado" tile="Seleccione estado de la evaluacion" tabindex="6" required>
                                                        <option value="Inactivo">Inactivo</option> 
                                                        <option value="Activo">Activo</option>
                                                    </select>
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label">Link de Evaluación</label>
                                                <input id="textLinkEvaluacion" name="textLinkEvaluacion" type="text" class="form-control" tile="Ingrese link de evaluacion" tabindex="7" maxlength="400" required>
                                            </div>
                                        </div>
                                            <button type="submit" class="btn btn-success btn-lg" tile="Crear evaluacion"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Crear evaluación</button>
                                    </form>
                                </div>
                               
                                <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                   <!-- <h3 class="py-3" >Activar evaluaciones</h3-->
                                    <form id="activar-evaluacion">
                                    @csrf
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="select">Períodos Acádemicos</label>
                                                    <select class="form-control" id="selPeriodo5" name="selPeriodo5" tabindex="1" tile="Seleccione periodo academico" required>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="select">Estado de evaluaciones</label>
                                                    <select class="form-control" id="selEstado5" name="selEstado5" tile="Seleccione estado de la evaluacion" tabindex="2" required>
                                                        <option value="Activo">Activo</option>
                                                        <option value="Inactivo">Inactivo</option>               
                                                    </select>
                                                </div> 
                                        </div>
                                            <button type="submit" class="btn btn-success btn-lg" tile="Actualizar estado evaluacion"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                    </form>
                                </div>
                            </div>
                            <!-----------------------------------modal eliminar--------------------------------------->
                                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light text-dark ">
                                                        <h5 class="modal-title text-center" id="exampleModalLabel">Confirmar para eliminar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <hr>
                                                        ¿Esta seguro de eliminar la evaluación seleccionada?
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
                                        <div class="modal fade " id="evaluacion_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar curso</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="evaluacion_edit_form">
                                                <div class="modal-body">
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                                <div class="row justify-content-center p-2">
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="select">Períodos Acádemicos</label>
                                                                            <select class="form-control" id="selPeriodoEditar" name="selPeriodoEditar" tabindex="1" tile="Seleccione periodo academico" required>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="select">Cursos</label>
                                                                            <select class="form-control" id="SelCursosEditar" name="SelCursosEditar" tabindex="2" tile="Seleccione periodo academico" required>
                                                                                <option selected="true" disabled="disabled" value="">Seleccione un curso</option>    
                                                                            </select>
                                                                        </div>
                                                                </div>
                                                                <div class="row justify-content-center p-2">
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="select">Módulos</label>
                                                                            <select class="form-control" id="selModulosEditar" name="selModulosEditar" tabindex="3" tile="Seleccione un módulo" required>
                                                                                <option selected="true" disabled="disabled" value="">Seleccione un módulo</option>  
                                                                            </select>
                                                                        </div>
                                                                </div>
                                                                <div class="row justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="" class="form-label">Fecha Inicio</label>
                                                                        <input id="dateFechaInicioEditar" name="dateFechaInicioEditar" type="date" class="form-control" tile="Ingrese fecha de inicio evaluacion" tabindex="4" maxlength="2" required>
                                                                    </div>
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="" class="form-label">Fecha Fin</label>
                                                                        <input id="dateFechaFinEditar" name="dateFechaFinEditar" type="date" class="form-control" tile="Ingrese fecha de finalizacion evaluacion" tabindex="5" maxlength="2" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="select">Estado</label>
                                                                            <select class="form-control" id="selEstadoEditar" name="selEstadoEditar" tile="Seleccione estado de la evaluacion" tabindex="6" required>
                                                                                <option value="Inactivo">Inactivo</option> 
                                                                                <option value="Activo">Activo</option>
                                                                            </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="" class="form-label">Link de Evaluación</label>
                                                                        <input id="textLinkEvaluacioneEditar" name="textLinkEvaluacioneEditar" type="text" class="form-control" tile="Ingrese link de evaluacion" tabindex="7" maxlength="400" required>
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

                    var evaluaciones=$('#tabla-evaluacionDocente').DataTable({
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
                        processing:true,
                        serverSide:true,
                        order: [[0, "desc"], [1, "desc"],[2, "asc"], [3, "asc"], [4, "asc"],[5, "asc"], [6, "asc"]],
                        ajax:{
                            url:"{{route('evaluacion.index')}}",
                        },
                        columns:[
                            {data:'fechaini'}, 
                            {data:'fechafin'},
                            {data:'nombre_tipolicencia'},
                            {data:'nombre_paralelo'},
                            {data:'nombre_mod'},
                            {data:'apellido_doc'},
                            {data:'name'},
                            {data:'fecha_ini_evaluacion'}, 
                            {data:'fecha_fin_evaluacion'}, 
                            {data:'estado'},
                            {data:'link_evaluacion'},
                            {data:'action',orderable:false}
                        ]
                    });
                });
            </script>
        
            <script>//CARGAR selects
                function cargarSelectsEvaluacion(){
                    $.get('/evaluacion/cargarSelectEvaluacion', function(data)
                    {
                        //asignar valores a select periodos academicos
                        $('#selPeriodo').empty();
                        $('#selPeriodo').append('<option value="" disabled="true" selected="true">Seleccione un período acádemico</option>');
                        $.each(data, function(fetch, regenciesObj){
                                        $('#selPeriodo').append('<option value="'+ regenciesObj.id +'">'+"Desde "+ regenciesObj.fechaini +" Hasta "+ regenciesObj.fechafin+" Licencia tipo "+ regenciesObj.nombre_tipolicencia+'</option>');
                        }) 
                        //asignar valores 
                                        
                    });
                    

                }
               
                function cargarSelectsActivar(){
                    $.get('/evaluacion/cargarSelectEvaluacion', function(data)
                    {
                        //asignar valores a select periodos academicos
                        $('#selPeriodo5').empty();
                        $('#selPeriodo5').append('<option value="" disabled="true" selected="true">Seleccione un período acádemico</option>');
                      
                        $.each(data, function(fetch, regenciesObj){
                                        $('#selPeriodo5').append('<option value="'+ regenciesObj.id +'">'+"Desde "+ regenciesObj.fechaini +" Hasta "+ regenciesObj.fechafin+" Licencia tipo "+ regenciesObj.nombre_tipolicencia+'</option>');
                        }) 
                     
                        //asignar valores 
                                        
                    });
                    

                }
            </script>
            <script>
                $(document).ready(function(){    
                    $('#selPeriodo').on('change', function(e){//cargar  cursos
                        $('#selModulos').empty();
                        $('#selModulos').append('<option value="" disabled="true" selected="true">Seleccione un módulo</option>');
                        var periodoacad = e.target.value;
                        $.get('/evaluacion/cargarSelectCursos/'+periodoacad,function(data) {
                                $('#SelCursos').empty();
                                $('#SelCursos').append('<option value="" disabled="true" selected="true">Elija un curso</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelCursos').append('<option value="'+ regenciesObj.id_curlic +'">'+"Licencia tipo "+ regenciesObj.nombre_tlic +" / "+ regenciesObj.jornada+" / "+ regenciesObj.modalidad+" / "+ regenciesObj.duracion_meses+" meses "+" / Paralelo "+ regenciesObj.nombre_paralelo+'</option>');
                                })          
                        });   
                    });
                    $('#SelCursos').on('change', function(e){//cargar  modulos
                       
                        var curso = e.target.value;
                        var periodoA = $('#selPeriodo').val();
                        $.get('/evaluacion/cargarSelectModulos/'+periodoA+"/"+curso,function(data) {
                                $('#selModulos').empty();
                                $('#selModulos').append('<option value="" disabled="true" selected="true">Seleccione un módulo</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#selModulos').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod + " - "+regenciesObj.apellido_doc+" " +regenciesObj.name +'</option>');
                                })              
                        });    
                    });
                        $('#selPeriodoEditar').on('change', function(e){//cargar  cursos
                            $('#selModulosEditar').empty();
                            $('#selModulosEditar').append('<option value="" disabled="true" selected="true">Seleccione un módulo</option>');
                            var periodoacad = e.target.value;
                            $.get('/evaluacion/cargarSelectCursos/'+periodoacad,function(data) {
                                    $('#SelCursosEditar').empty();
                                    $('#SelCursosEditar').append('<option value="" disabled="true" selected="true">Elija un curso</option>');
                                    $.each(data, function(fetch, regenciesObj){
                                        $('#SelCursosEditar').append('<option value="'+ regenciesObj.id_curlic +'">'+"Licencia tipo "+ regenciesObj.nombre_tlic +" / "+ regenciesObj.jornada+" / "+ regenciesObj.modalidad+" / "+ regenciesObj.duracion_meses+" meses "+" / Paralelo "+ regenciesObj.nombre_paralelo+'</option>');
                                    })          
                            });   
                        });
                        $('#SelCursosEditar').on('change', function(e){//cargar  modulos
                        
                            var curso = e.target.value;
                            var periodoA = $('#selPeriodoEditar').val();
                            $.get('/evaluacion/cargarSelectModulos/'+periodoA+"/"+curso,function(data) {
                                    $('#selModulosEditar').empty();
                                    $('#selModulosEditar').append('<option value="" disabled="true" selected="true">Seleccione un módulo</option>');
                                    $.each(data, function(fetch, regenciesObj){
                                        $('#selModulosEditar').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod + " - "+regenciesObj.apellido_doc+" " +regenciesObj.name +'</option>');
                                    })              
                            });    
                        });
                    $('#SelEvaluacion').on('change', function(e){//cargar  cursos
                        var evaluacion = e.target.value;
                        $.ajax({
                            url:'/evaluacion/tablaPreguntas/'+evaluacion,
                                success : function(data){
                                    setTimeout(function(){
                                        $('#tabla-listPreguntas').empty().append($(data));
                                    }
                                    );
                                }
                        });  
                         
                    });         
                });
            </script>
            <script> //ingresar una nueva evaluacion
               $('#ingreso-evaluacion').submit(function(e){
                   e.preventDefault();
                    var id_doc_mod=$('#selModulos').val();
                    var id_periodo=$('#selPeriodo').val();
                    var id_curlic=$('#SelCursos').val();
                    var fecha_ini_evaluacion =$('#dateFechaInicio').val();
                    var fecha_fin_evaluacion =$('#dateFechaFin').val();
                    var estado=$('#selEstado').val();
                    var link_evaluacion=$('#textLinkEvaluacion').val();
                    var _token=$("input[name=_token]").val(); 
                    if(fecha_ini_evaluacion<=fecha_fin_evaluacion)
                    {
                        $.ajax({
                                    url:"{{route('evaluacion.ingresar')}}",
                                    type:"POST",
                                    async: true,
                                    data:{
                                        id_doc_mod:id_doc_mod,
                                        id_periodo:id_periodo,
                                        id_curlic:id_curlic,
                                        fecha_ini_evaluacion:fecha_ini_evaluacion,
                                        fecha_fin_evaluacion:fecha_fin_evaluacion,
                                        estado:estado,
                                        link_evaluacion:link_evaluacion,
                                        _token:_token
                                    },
                                    success:function(response)
                                    {   
                                        if(response)
                                        {
                                            if(response==1)
                                            {
                                                $('#ingreso-evaluacion')[0].reset();
                                                toastr.success('El ingreso fue exitoso','¡EXITOSO!',{timeOut:1000});
                                                $('#tabla-evaluacionDocente').DataTable().ajax.reload();
                                            }
                                            if(response==2)
                                            {
                                                toastr.error('El periodo académico seleccionado a culminado NADA QUE HACER','¡FALLIDO!',{timeOut:2000});
                                            }
                                            if(response==3)
                                            {
                                                toastr.warning('Las fechas ingresadas estan fuera del rando del período académico seleccionado','¡FALLIDO!',{timeOut:2000});
                                            }
                                        }
                                        else {
                                           
                                            toastr.warning('Ya existe la evaluación','¡FALLIDA!',{timeOut:1000});
                                        }
                                    },
                                    
                                    error : function(response){
                                        toastr.error('El ingreso fue fallido, intente nuevamente','¡FALLIDA!',{timeOut:1000});
                                    }
                                });        
                    }
                    else{
                        toastr.warning('Ingrese una fecha FIN mayor o igual a la de inicio','¡FALLIDA!',{timeOut:2000});
                    }
                                
                })
                
        </script> 
        <script>//eliminar una  evaluacion
            var _id;
            $(document).on('click','.delete',function(){
                _id=$(this).attr('id'); 
                $('#confirmModal').modal('show');
            });
            $('#btnEliminar').click(function(){
                $.ajax({
                    url:"/evaluacion/eliminar/"+_id,
                    beforeSend:function(){
                        $('#btnEliminar').text('Eliminando..'); 
                        $('#girar').show(); 
                    },
                    success:function(data){
                        if(data)
                        {
                            if(data==1)
                            {
                                $('#confirmModal').modal('hide');
                                toastr.success('La evaluación fue eliminada exitosamente','¡EXITOSO!',{timeOut:1000});
                                $('#tabla-evaluacionDocente').DataTable().ajax.reload();
                                $('#btnEliminar').text('Eliminar'); 
                                $('#girar').hide(); 
                            }
                        }
                        else{
                            toastr.error('El periodo académico seleccionado a culminado NADA QUE HACER','¡FALLIDO!',{timeOut:2000});
                            $('#btnEliminar').text('Eliminar'); 
                                $('#girar').hide(); 
                        }                       
                    
                    }
                });
            });

        </script>
        <script>//CARGAER EN EL FORMULARIO PARA EDITAR evaluacion

            function editarEvaluacion(id){
                $.get('/evaluacion/editar/'+id, function(evaluacion)
                {
                    if(evaluacion)
                    {
                            //asignar valores a select tipos licencia
                        $('#selPeriodoEditar').empty();
                            $('#selPeriodoEditar').append('<option value="" disabled="true" selected="true">Seleccione un período académico</option>');
                            $('#SelCursosEditar').empty();
                                            $('#SelCursosEditar').append('<option value="" disabled="true" selected="true">Elija un curso</option>');
                            $('#selModulosEditar').empty();
                                            $('#selModulosEditar').append('<option value="" disabled="true" selected="true">Seleccione un módulo</option>');
                                for (var i in evaluacion) {
                                    if(evaluacion[i].id)
                                    {
                                        if(!(i==0))
                                            { 
                                                document.getElementById("selPeriodoEditar").innerHTML += "<option value='"+evaluacion[i].id+"'>"+"Desde "+evaluacion[i].fechaini+" Hasta "+evaluacion[i].fechafin+" Licencia tipo "+evaluacion[i].nombre_tipolicencia+"</option>";            
                                            }
                                    }     
                                }
                            
                            //asignar datos recuperados
                            $('#txtId2').val(evaluacion[0].id_evaluacion);
                            //$('#selPeriodoEditar').val(evaluacion[0].id_periodo);
                        // $('#selModulos3').val(evaluacion[0].id_doc_mod);
                            $('#dateFechaInicioEditar').val(evaluacion[0].fecha_ini_evaluacion);
                            $('#dateFechaFinEditar').val(evaluacion[0].fecha_fin_evaluacion);
                            $('#selEstadoEditar').val(evaluacion[0].estado);
                            $('#textLinkEvaluacioneEditar').val(evaluacion[0].link_evaluacion);
                            $("input[name=_token]").val();
                            $('#evaluacion_edit_modal').modal('toggle');
                    }
                    else{
                        toastr.error('El periodo académico seleccionado a culminado NADA QUE HACER','¡FALLIDO!',{timeOut:2000});
                    }
                   
                });

            }
        </script>
        <script>//actualizar cambios realizados
    
            $('#evaluacion_edit_form').submit(function(e){
                e.preventDefault();
                    var id_evaluacion2=$('#txtId2').val();
                    var id_doc_mod2=$('#selModulosEditar').val();
                    var id_periodo2=$('#selPeriodoEditar').val();
                    var id_curlic2=$('#SelCursosEditar').val();
                    var fecha_ini_evaluacion2 =$('#dateFechaInicioEditar').val();
                    var fecha_fin_evaluacion2 =$('#dateFechaFinEditar').val();
                    var estado2=$('#selEstadoEditar').val();
                    var link_evaluacion2=$('#textLinkEvaluacioneEditar').val();
                    var _token2=$("input[name=_token]").val(); 
                    if(fecha_ini_evaluacion2<=fecha_fin_evaluacion2)
                    {
                        $.ajax({
                            url:"{{route('evaluacion.actualizar')}}",
                            type:"POST",
                            data:{
                                id_evaluacion:id_evaluacion2, 
                                id_doc_mod:id_doc_mod2,
                                id_periodo:id_periodo2,
                                id_curlic:id_curlic2,
                                fecha_ini_evaluacion:fecha_ini_evaluacion2,
                                fecha_fin_evaluacion:fecha_fin_evaluacion2,
                                estado:estado2,
                                link_evaluacion:link_evaluacion2,
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
                                    $('#evaluacion_edit_modal').modal('hide');
                                    toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                    $('#tabla-evaluacionDocente').DataTable().ajax.reload();
                                    $('#btnActualizar').text('Guardar cambios'); 
                                    $('#girar2').hide(); 
                                }
                                else{
                                    toastr.warning('La evaluación ya existe, INTENTE con otro módulo','FALLIDA',{timeOut:3000});
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
                    else{
                        toastr.warning('Ingrese una fecha FIN mayor o igual a la de inicio','¡FALLIDA!',{timeOut:2000});
                    }
                
            })
        </script>
         <script> //ingresar una nueva pregunta
               $('#ingreso-preguntas').submit(function(e){
                   e.preventDefault();
                    var pregunta=$('#txtPregunta').val();
                    var aspecto=$('#selAspecto').val();
                    var id_evaluacion =$('#SelEvaluacion').val();
                   
                    var _token=$("input[name=_token]").val(); 
                   
                                $.ajax({
                                    url:"{{route('preguntas.ingresar')}}",
                                    type:"POST",
                                    async: true,
                                    data:{
                                        pregunta:pregunta,
                                        aspecto:aspecto,
                                        id_evaluacion:id_evaluacion,
                                    
                                        _token:_token
                                    },
                                    success:function(response)
                                    {   
                                        if(response)
                                        {
                                            $('#txtPregunta').val("");
                                            toastr.success('El ingreso fue exitoso','¡EXITOSO!',{timeOut:3000});
                                            //recargar tabla
                                                    var evaluacionac =$('#SelEvaluacion').val();
                                                    $.ajax({
                                                        url:'/evaluacion/tablaPreguntas/'+evaluacionac,
                                                            success : function(data){
                                                                setTimeout(function(){
                                                                    $('#tabla-listPreguntas').empty().append($(data));
                                                                }
                                                                );
                                                            }
                                                    });         
                                        }
                                    },
                                    
                                    error : function(response){
                                        toastr.error('El ingreso fue fallido, intente nuevamente','¡FALLIDA!',{timeOut:3000});
                                    }
                                });        
                })
                
        </script> 
          <script>//actualizar estado de evaluaciones
                $('#activar-evaluacion').submit(function(e){
                    e.preventDefault();
                    var id_periodoact=$('#selPeriodo5').val();
                    var estadoact=$('#selEstado5').val();
                    var _token3=$("input[name=_token]").val();
                   
                            $.ajax({
                                url:"{{route('evaluacion.actualizarEstado')}}",
                                type:"POST",
                                data:{
                                    id_periodo:id_periodoact, 
                                    estado:estadoact,
                                    _token:_token3

                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        $('#activar-evaluacion')[0].reset();
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                        $('#tabla-evaluacionDocente').DataTable().ajax.reload();
                                       
                                    }
                                    else{
                                        toastr.error('El periodo académico seleccionado a culminado NADA QUE HACER','¡FALLIDO!',{timeOut:2000});
                                    }
                                },
                                error : function(response){
                                        toastr.error('Ocurrio un eror intente nuevamente','¡FALLIDA!',{timeOut:3000});
                                }
                            });
                    
                })
            </script>
    <body>
</html>

