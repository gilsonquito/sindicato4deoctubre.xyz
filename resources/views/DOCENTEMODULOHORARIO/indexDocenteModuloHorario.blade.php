<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/docentemodulohorario.css')}}" rel="stylesheet">
        <title>DocenteModuloHorario</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Lista de asignaciones de horarios</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de docentes/módulos/horarios</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <!--<h3 class="py-3">Periodos Académicos</h3>-->
                                    <table id="tabla-asignacionhorario" class="table table-striped table-responsive table-hover table-bordered w-100">
                                        <thead  class="font-weight-bold text-dark ">
                                            <tr>
                                                <td class="align-middle" colspan="2">PERÍODO ACADÉMICO</td>
                                                <td class="align-middle" colspan="2">PERÍODO HORARIO</td>
                                                <td class="align-middle" colspan="2">HORAS</td>
                                                <td class="align-middle" rowspan="2">Módulo</td>
                                                <td class="align-middle" rowspan="2">Paralelo</td>
                                                <td class="align-middle" rowspan="2">Tipo de licencia</td>
                                                <td class="align-middle" rowspan="2">Jornada</td>
                                                <td class="align-middle" rowspan="2">Modalidad</td>
                                                <td class="align-middle" rowspan="2">Instruccion</td>
                                                <td class="align-middle" rowspan="2">Nombre docente</td>
                                                <td class="align-middle" rowspan="2">Apellido docente</td>
                                                <td class="align-middle" rowspan="2">Dias</td>
                                                <td class="align-middle" rowspan="2">Acciones</td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle">Fecha Inicio</td>
                                                <td class="align-middle" >Fecha Fin</td>
                                                <td class="align-middle" >Fecha Inicio</td>
                                                <td class="align-middle" >Fecha Fin</td>
                                                <td class="align-middle" >Hora Inicio</td>
                                                <td class="align-middle">Hora Fin</td> 
                                            </tr>
                                        </thead>
                                    </table>
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
                                                        ¿Esta seguro de eliminar esta asignación de horario?
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
                                </div><!---------Final modal eliminar------->
                                <!--------------------------------------------------modal editar ..........................-->
                                    <!-- Button trigger modal -->
                                        <!-- Modal -->
                                        <div class="modal fade " id="modulodocentehorario_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar Asignación Docente/Módulo</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="docentemodulohorario_edit_form">
                                                <div class="modal-body">     
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                                <div class="row  justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left text-truncate">
                                                                        <label for="select">Docente/Modulo</label>
                                                                        <select class="form-control" data-container="body" id="selDocenteModuloHorario3" name="selDocenteModuloHorario3" tabindex="1" required>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="" class="form-label text-nowrap">Período de horario</label>
                                                                            <select class="form-control" id="selPeriodoHorario3" name="selPeriodoHorario3" tabindex="4" required>
                                                                            </select>
                                                                    </div>
                                                                </div> 
                                                                <div class="row  justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="select">Horarios</label>
                                                                        <select class="form-control" id="selHorarios3" name="selHorarios3" tabindex="2" required>
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
                                    </div><!--fin modulo editar-->
                    </div><!--finc container--> 
            </div><!--digeneral-->  
            <script type="text/javascript"> //cargar tabla en el index
                $(document).ready(function(){
                    
                    var docentesHorarios=$('#tabla-asignacionhorario').DataTable({
                        processing:true,
                        serverSide:true,
                        order: [[0, "desc"], [1, "desc"], [2, "desc"], [3, "desc"], [4, "asc"], [5, "asc"], [6, "asc"],[7, "asc"]],
                        "columnDefs": [
                            { className: "font-weight-bold text-muted", "targets": [ 0,1 ] },
                            { className: "font-italic", "targets": [ 2,3 ] },
                            { className: "align-middle" , targets: "_all" }
                        ],
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
                            url:"{{route('docentemodulohorario.indexs')}}",
                        },
                        columns:[
                            {data:'fechaini'},
                            {data:'fechafin'},
                            {data:'fecha_inicio'},
                            {data:'fecha_fin'},
                            {data:'hora_inicio'},
                            {data:'hora_fin'},
                            {data:'nombre_mod'},
                            {data:'nombre_paralelo'},
                            {data:'nombre_tlic'},
                            {data:'jornada'},
                            {data:'modalidad'},
                            {data:'instruccion_doc'},
                            {data:'name'},
                            {data:'apellido_doc'},
                            {data:'tipo_dias'},  
                            {data:'action',orderable:false}
                        ]

                    });
                   
                });
            </script>
        <script>/////////////////////////eliminar asigancion------------------------------
            var _id;
            $(document).on('click','.delete',function(){
                _id=$(this).attr('id'); 
                $('#confirmModal').modal('show');
            });
            $('#btnEliminar').click(function(){
                
                $.ajax({
                   
                    url:"/docentemodulohorario/eliminar/"+_id,
                    beforeSend:function(){
                        $('#btnEliminar').text('Eliminando..'); 
                        $('#girar').show(); 
                    },
                    success:function(data){
                      
                        if(data==1)
                        {
                            $('#confirmModal').modal('hide');
                            toastr.success('La asignación fue eliminada exitosamente','¡EXITOSO!',{timeOut:3000});
                            $('#tabla-asignacionhorario').DataTable().ajax.reload();
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                        }
                        if(data==2)
                        {
                            toastr.warning('El periodo acadÉmico al cual pertene la asignacion a culminado, NADA QUE HAVER','¡FALLIDO!',{timeOut:3000});
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                        }                 
                        
                    },
                    error : function(data){
                        
                         toastr.error('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                         $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                    }  
                });
            });

        </script> 
         <script>//CARGAER EN EL FORMULARIO PARA EDITAR asignacion de horario 
            function editarDocenteModuloHorario(id){
                $.get('/docentemodulohorario/editar/'+id, function(datose)
                {
                    //asiganr valores a select modulos docentes
                    $('#selDocenteModuloHorario3').empty();
                    //console.log(datose);
                    for (var i in datose) {
                        if(datose[i].id_doc_mod)
                        {
                            if(!(i==0))
                            { 
                                document.getElementById("selDocenteModuloHorario3").innerHTML += "<option value='"+datose[i].id_doc_mod+"'>"+datose[i].nombre_mod+" / "+datose[i].nombre_tlic+" "+datose[i].jornada+" "+datose[i].modalidad+" "+datose[i].nombre_paralelo+" / "+datose[i].name+" "+datose[i].apellido_doc+"</option>";      
                            }
                        }    
                    }
                    $('#selDocenteModuloHorario3').val(datose[0].id_doc_mod);
                    //asignar valores a select horarios
                    $('#selHorarios3').empty();
                    for (var i in datose) {
                        if(datose[i].id_horario)
                        {
                            if(!(i==0))
                            {   
                                document.getElementById("selHorarios3").innerHTML += "<option value='"+datose[i].id_horario+"'>"+datose[i].tipo_dias+" "+datose[i].hora_inicio+" "+datose[i].hora_fin+"</option>";            
                            }
                        }     
                    } 
                    $('#selHorarios3').val(datose[0].id_horario);    
                  
                    //asignar valores a select periodo horarios
                    $('#selPeriodoHorario3').empty();
                    for (var i in datose) {
                        if(datose[i].id_phorario)
                        {
                            if(!(i==0))
                            {   
                                document.getElementById("selPeriodoHorario3").innerHTML += "<option value='"+datose[i].id_phorario+"'>"+" PH "+datose[i].fecha_inicio+" / "+datose[i].fecha_fin+" <> PA "+datose[i].fechaini+" / "+datose[i].fechafin+" "+datose[i].nombre_tipolicencia+"</option>";            
                            }
                        }     
                    } 
                    $('#selPeriodoHorario3').val(datose[0].id_phorario);  
                    //asignar datos recuperados
                    $('#txtId2').val(datose[0].id_docmod_hor);
                    $('#modulodocentehorario_edit_modal').modal('toggle');
                    $("input[name=_token]").val();
                });
            }
        </script>
        <script>//actualizar cambios realizados
                
                $('#docentemodulohorario_edit_form').submit(function(e){
                    e.preventDefault();
                    var id_docmod_hor4=$('#txtId2').val();
                    var id_doc_mod4=$('#selDocenteModuloHorario3').val();
                    var id_horario4=$('#selHorarios3').val();
                    var id_phorario4=$('#selPeriodoHorario3').val();
                    var _token4=$("input[name=_token]").val(); 
                        $.ajax({
                                    url:"{{route('docentemodulohorario.actualizar')}}",
                                    type:"POST",
                                    data:{
                                        id_docmod_hor:id_docmod_hor4, 
                                        id_doc_mod:id_doc_mod4,
                                        id_horario:id_horario4,
                                        id_phorario:id_phorario4,
                                        _token:_token4
                                    },
                                    beforeSend:function(){
                                        $('#btnActualizar').text('Actualizando..'); 
                                        $('#girar2').show(); 
                                    },
                                    success:function(response)
                                    {
                                    
                                        if(response)
                                        {
                                            $('#modulodocentehorario_edit_modal').modal('hide');
                                            toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                            $('#tabla-asignacionhorario').DataTable().ajax.reload();
                                            $('#btnActualizar').text('Guardar cambios'); 
                                            $('#girar2').hide(); 
                                        }
                                        else{
                                           toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                        }
                                    },
                                    error : function(response){
                                        toastr.error('Ocurrio un error La asignaciond de horario ya existe','¡FALLIDA!',{timeOut:3000});
                                        $('#btnActualizar').text('Guardar cambios'); 
                                        $('#girar2').hide(); 
                                    }
                                });
                    
                   
                    
                })
            </script>

    <body>
</html>

