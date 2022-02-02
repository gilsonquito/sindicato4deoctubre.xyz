<?php
    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/silabodoc.css')}}" rel="stylesheet">
        <meta http-equiv='cache-control' content='no-cache'>
        <title>Silabos</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Sílabos</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de sílabos</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <!--<h3 class="py-3">Periodos Académicos</h3>-->
                                    <table id="tabla-silabos" class="table table-responsive table-striped table-hover w-100">
                                        <thead  class="font-weight-bold text-dark ">
                                            <tr>
                                                <td class="col-md-3" rowspan="2">Escuela</td>
                                                <td class="col-md-3" rowspan="2">Plan de estudio</td>
                                                <td class="col-md-3" rowspan="2">Estado</td>
                                                <td class="col-md-2" colspan="2">Períodos Académicos</td>
                                                <td class="col-md-3" rowspan="2">Fecha de creación</td>
                                                <td class="col-md-3" rowspan="2">Módulo</td>
                                                <td class="col-md-2" rowspan="2">Jornada</td>
                                                <td class="col-md-2" rowspan="2">Modalidad</td>
                                                <td class="col-md-1" rowspan="2">Tipo licencia</td>
                                                <td class="col-md-1" rowspan="2">Paralelo</td>
                                                <td class="col-md-3" rowspan="2">Acciones</td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-2">Fecha Inicio PA</td>
                                                <td class="col-md-2">Fecha Fin PA</td>
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
                                                        ¿Esta seguro de eliminar el sílabo?
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
                                        <div class="modal fade " id="modulodocente_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar Asignación Docente/Módulo</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form autocomplete="off" id="silabo_edit_form" action="{{url('silabodoc/actualizar')}}" method="POST" enctype="multipart/form-data" class="p-4">
                                                <div class="modal-body">     
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                                <div class="row  justify-content-center p-3">
                                                                        <div class="col-md-6 px-2 justify-content-center  text-left">
                                                                            <label for=""><b>Cabiar Archivo: </b></label><br>
                                                                            <input type="file" name="file2"   class="form-control" tabindex="1">
                                                                        </div>  
                                                                        <div class="col-md-6 px-2 justify-content-center  text-left">
                                                                            <label for="" class="form-label ml-2">Responsable</label>
                                                                            <input id="responsable2" name="responsable2" type="text" class="form-control" tabindex="2" maxlength="50" required  readonly value="{{auth()->user()->email}}">
                                                                        </div>
                                                                </div>  
                                                                <div class="row  justify-content-center p-3">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left text-truncate">
                                                                        <label for="select">Módulo</label>
                                                                        <input type="hidden" id="txtmodulos" name="txtmodulos">
                                                                        <select class="form-control"  id="selModulos2" name="selModulos2" tabindex="3" disabled required >
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="select">Periodo Académico</label>
                                                                        <select class="form-control" id="selPeriodo2" name="selPeriodo2" tabindex="4" required>
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
                    
                    var silabos=$('#tabla-silabos').DataTable({
                        processing:true,
                        serverSide:true,
                        ajax:{
                            url:"{{route('silabodoc.index')}}",
                        },
                        columns:[
                            {data:'escuela'},
                            {data:'plan_estudio'},
                            {data:'estado'},
                            {data:'fechaini'},
                            {data:'fechafin'},
                            {data:'fecha_creacion'},
                            {data:'nombre_mod'},
                            {data:'jornada'},
                            {data:'modalidad'},
                            {data:'nombre_tlic'},
                            {data:'nombre_paralelo'},
                            {data:'action',orderable:false}
                            
                        ]
                       
                        
                    });
                   
                });
            </script>
            
        <script>/////////////////////////eliminar un silabo------------------------------
            var _id;
            $(document).on('click','.delete',function(){
                _id=$(this).attr('id'); 
                $('#confirmModal').modal('show');
            });
            $('#btnEliminar').click(function(){
                
                $.ajax({
                    url:"silabodoc/eliminar/"+_id,
                    beforeSend:function(){
                        $('#btnEliminar').text('Eliminando..'); 
                        $('#girar').show(); 
                    },
                    success:function(data){
                        if(data)
                        {
                            $('#confirmModal').modal('hide');
                            toastr.success('El sílabo fue eliminado exitosamente','¡EXITOSO!',{timeOut:2000});
                            $('#tabla-silabos').DataTable().ajax.reload();
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                        }
                        else 
                        {
                            $('#confirmModal').modal('hide');
                            toastr.warning('No se puede eliminar un sílabo APROBADO','¡FALLIDO!',{timeOut:2000});
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                        }
                    },
                    error : function(data){
                        toastr.error('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:2000});
                        toastr.warning('No se puede eliminar silabos con avances academicos ','¡FALLIDA!',{timeOut:3000});
                        $('#btnEliminar').text('Eliminar'); 
                        $('#girar').hide(); 
                    }  
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
            
          </script>
        

    <body>
</html>

