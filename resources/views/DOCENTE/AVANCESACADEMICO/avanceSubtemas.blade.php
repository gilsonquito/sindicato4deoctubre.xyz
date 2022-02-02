    <head>
    <link href="{{asset('css/avanceSubtemas.css')}}" rel="stylesheet">
      <title>SubtemasAvances</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row w-100">
                <div class="col-md-12">
                    <table id="tablaSubtemasAvance" class="table table-striped table-bordered table-responsive-lg w-100 ">
                        <thead  class="font-weight-bold text-muted p-0 ">
                            <td class="col-md-3s">Unidad</td>
                            <td class="col-md-3">Tema</td>
                            <td class="col-md-3">Subtema</td>
                            <td class="col-md-3">Acciones</td>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="">
                <button onclick="selecionarSubtemas()" class="btn btn-outline-success" id="btnSeleccionarSubtemas" name="btnSeleccionarSubtemas"><i class="fa fa-list-ul mr-2" aria-hidden="true"></i>Agregar Temas/Subtemas</button>
            </div>
        </div>            
        @foreach ($avances as $avance)
            <input type="hidden" id="txtIdAvanceAv" name="txtIdAvanceAv" value="{{$avance->id_avance}}">
        @endforeach               
        <!--------------------------------------------------modal seleccionar temas ..........................-->
        <div class="modal fade " id="seleccionarSubtemas_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabelSel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                <div class="modal-header btn-light">
                                    <h5 class="modal-title text-secondary" id="staticBackdropLabelSel"><i class="fa fa-list-ul mr-2" aria-hidden="true"></i>Agregar Temas/Subtemas</h5>
                                    <button onclick="cerrarseleccionarSubtemas_modal()" type="button" class="close"  aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                        <div class="modal-body">                      
                                            <div class="row justify-content-center p-2" id="seccionUnidadesAvance">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button onclick="cerrarseleccionarSubtemas_modal()" type="button" class="btn btn-danger" ><i class="fa fa-times-circle mr-2" aria-hidden="true"></i>Cerrar</button>
                                        </div>                         
                                </div>
                            </div>
        </div><!--fin modal -->
                 <!-----------------------------------modal eliminar subtemasavance--------------------------------------->             
                 <div class="modal fade" id="modalEliminarSubteaAvance_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelEAS" aria-hidden="true"><!--inicio modal--> 
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-light text-dark ">
                                <h5 class="modal-title text-center text-muted" id="exampleModalLabelEAS"><i class="fa fa-check-circle-o mr-2" aria-hidden="true"></i>Confirmar para eliminar</h5>
                                <button onclick="cerrarmodalEliminarSubteaAvance_modal()" type="button" class="close"  aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <hr>
                                    ¿Esta seguro de eliminar el subtema seleccionado?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button onclick="cerrarmodalEliminarSubteaAvance_modal()" type="button" class="btn btn-secondary" ><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarSubtemaAvance" name="btnEliminarSubtemaAvance"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar Subtema     
                                </button>  
                            </div>
                            <div id="girarEliminarAvanceSubema" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
            <script > //cargar tabla en el index
                        $(document).ready(function(){
                                var idActualAvances=$('#txtIdAvanceAv').val();
                                var subtemasAvance=$('#tablaSubtemasAvance').DataTable({
                                order: [[0, "asc"], [1, "asc"],[2, "asc"]],
                                lengthMenu: [[5,10, 25, -1], [5,10, 25, "All"]],
                                searching: false,
                                //processing:true,  
                                //serverSide:true,
                                ajax:{
                                    url:"/avanceSubtema/"+idActualAvances,
                                },
                                columns:[
                                    {data:'titulo_unidad'},
                                    {data:'titulo_tema'},
                                    {data:'titulo_subtema'},
                                    {data:'action',orderable:false}
                                ]
                            });
                        });
            </script>   
        <script>//CARGAER  EL FORMULARIO PARA agregar subtemas
            function selecionarSubtemas(){          
                    
                    var idAvance=$('#txtIdAvanceAv').val();
                    var idSilabAva;
                    $.ajax({
                        url:'/unidad/idSilabo/'+idAvance,
                            success : function(data){
                                $.ajax({
                                    url:'/unidad/mostrarUnidades3/'+data,
                                        success : function(data){
                                            setTimeout(function(){
                                                $('#seccionUnidadesAvance').empty().append($(data));
                                            }
                                            );
                                        }
                                });
                             }
                    });
                    $('#seleccionarSubtemas_modal').modal('toggle');
            }
            
        </script>  
          <script>//eliminar subtema avance
                    var _id;
                    function eliminarAvanceSubtemas(id_avance_subtema){
                        _id=id_avance_subtema;       
                        $('#modalEliminarSubteaAvance_modal').modal('show');
                    }
                    $('#btnEliminarSubtemaAvance').click(function(){
                        $.ajax({
                            url:"/avanceSubtema/eliminar/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarSubtemaAvance').text('Eliminando..'); 
                                $('#girarEliminarAvanceSubema').show(); 
                            },
                            success:function(data){    
                                if(data) 
                                {         
                                    $('#tablaSubtemasAvance').DataTable().ajax.reload();
                                    $('#modalEliminarSubteaAvance_modal').modal('hide');
                                    toastr.success('El subtema fue eliminado exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarSubtemaAvance').text('Eliminar Subtema'); 
                                    $('#girarEliminarAvanceSubema').hide(); 
                                }
                                else
                                {
                                    toastr.warning('Solo se puede borrar el dia que se creo el avance','¡FALLIDA!',{timeOut:1000});
                                }  
                            },
                            error : function(data){
                                toastr.error('Ocurrio un error inesperado vuelva a intentarlo','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarSubtemaAvance').text('Eliminar Subtema'); 
                                $('#girarEliminarAvanceSubema').hide();  
                            }  
                        });
                    });
            </script>
            <script>
                  function cerrarseleccionarSubtemas_modal(){
                        $('#seleccionarSubtemas_modal').modal('hide');
                    }
                    function cerrarmodalEliminarSubteaAvance_modal(){
                        $('#modalEliminarSubteaAvance_modal').modal('hide');
                    }
                    
            </script>

       