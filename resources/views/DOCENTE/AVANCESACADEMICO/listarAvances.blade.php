<head>
        <link href="{{asset('css/listarAvanceAcademico.css')}}" rel="stylesheet">
        <title>AvancesAcademicos</title>
    </head>
    <body>
        <div class="container-fluid">
            <p class="text-left font-weight-bold text-muted" href="#">Avances Académicos</p>
                <hr color="" class="border border-muted w-100 p-0">
            <div class="p-2">
                            <table id="tablaAvancesAcademicos"  class="table table-striped table-bordered table-responsive-lg w-100">
                                <thead  class="font-weight-bold text-dark ">
                                            <tr>
                                                <td class="col-md-3" rowspan="2">Fecha Avance</td>
                                                <td class="col-md-3" rowspan="2">Hora de Avance</td>
                                                <td class="col-md-3" rowspan="2">Responsable</td>
                                                <td class="col-md-2" colspan="2">Períodos Académicos</td>
                                                <td class="col-md-3" rowspan="2">MÓDULO</td>
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
        </div>  
                <!-----------------------------------modal eliminar metodo--------------------------------------->             
                <div class="modal fade" id="modalEliminaAvance_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelEliminar" aria-hidden="true"><!--inicio modal--> 
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-light text-dark ">
                                <h5 class="modal-title text-center text-muted" id="exampleModalLabelEliminar"><i class="fa fa-check-circle-o mr-2" aria-hidden="true"></i>Confirmar para eliminar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <hr>
                                    ¿Esta seguro de eliminar el avance académico seleccionado?
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btnEliminarAvanceA" name="btnEliminarAvanceA"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar Avance     
                                </button>  
                            </div>
                            <div id="girarEliminarAvanceAcademico" class="lds-dual-ring"></div> 
                        </div>  
                    </div>
                </div><!---------Final modal eliminar------->
                <!--------------------------------------------------modal editar AVANCE ACADEMICO ..........................-->
                    <div class="modal fade " id="editarAvanceAcaModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editarAvanceAcademico" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content" id="modalEditarAvanceAcademicoColor">
                                <div class="modal-header btn-light">
                                    <h5 class="modal-title text-secondary" id="editarAvanceAcademico"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Editar Avance Académico</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="modalEditarScroll">                      
                                        <input type="hidden" id="txtIdAvanceAce" name="txtIdAvanceAce">
                                        <div class="row  justify-content-center p-2">
                                            <div class="col-md-7 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Institución</label>
                                                <input readonly="readonly" id="escuelaAvance" name="escuelaAvance" type="text" class="form-control font-italic" tabindex="1" maxlength="50" required>    
                                            </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Area académica</label>
                                                <input readonly="readonly" id="areaAvance" name="areaAvance" type="text" class="form-control font-italic" tabindex="2" maxlength="100" required >
                                            </div>
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Nombre de la asignatura</label>
                                                <input readonly="readonly"  id="asignaturaAvance" name="asignaturaAvance" type="text" class="form-control font-italic" tabindex="3" required >
                                            </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Tipo licencia</label>
                                                <input readonly="readonly"  id="licenciaAvance" name="licenciaAvance" type="text" class="form-control font-italic" tabindex="4" >
                                            </div>
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Periodo académico</label>
                                                <input  readonly="readonly"  id="periodoAvance" name="periodoAvance" type="text" class="form-control font-italic" tabindex="5"  >
                                            </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Fecha de Creacion del Avance</label>
                                                <input readonly="readonly" id="fechaAvance" name="fechaAvance" type="text" class="form-control font-italic" tabindex="6" >
                                            </div>
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Paralelo</label>
                                                <input readonly="readonly" id="paraleloAvance" name="paraleloAvance" type="text" class="form-control font-italic" tabindex="7" required>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Hora</label>
                                                <input readonly="readonly" id="horaAvance" name="horaAvance" type="text" class="form-control font-italic" tabindex="8"  required>
                                            </div>
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Reponsable</label>
                                                <input readonly="readonly" id="responsableAvance" name="responsableAvance" type="text" class="form-control font-italic" tabindex="9"  required>
                                            </div>
                                        </div>
                                        <div class="p-2 border ">
                                                    <div class="justify-content" >
                                                        <div class="row align-items-center">
                                                            <div class="col-md-11">
                                                                <h5 class="text-left font-weight-normal text-dark" href="#">Unidades, Temas y Subtemas</h5> 
                                                            </div>
                                                        </div> 
                                                        <hr color="" class="border border-success w-100 p-0">
                                                        <div id="seccionSubtemasEditar">
                                                        </div>
                                                    </div>
                                        </div>
                                        <div class="p-2 border ">
                                                    <div class="justify-content" >
                                                        <div class="row align-items-center">
                                                            <div class="col-md-11">
                                                                <h5 class="text-left font-weight-normal text-dark" href="#">Detalle Avance Académico</h5> 
                                                            </div>
                                                        </div> 
                                                        <hr color="" class="border border-success w-100 p-0">
                                                        <div id="seccionDetalleAvanceEditar">
                                                        </div>
                                                    </div>
                                        </div>
                                </div><!--body end-->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle mr-2" aria-hidden="true"></i>Cerrar</button>
                                </div>                         
                            </div> <!--fin modal conetnt-->  
                        </div><!--fin modal diaolog-->          
                    </div> <!--fin modal fade-->        
            <script > //cargar tabla en el index
                    $(document).ready(function(){
                            var metodos=$('#tablaAvancesAcademicos').DataTable({
                            lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
                            "order": [[ 0, 'desc' ]],
                            "columnDefs": [
                                { className: "font-weight-bold font-italic text-dark", "targets": [ 5 ] }
                            ],
                            ajax:{
                                url:"/avanceacademico",
                            },
                            columns:[
                                {data:'fecha_avance'},
                                {data:'hora_avance'},
                                {data:'responsable_avance'},
                                {data:'fechaini'},
                                {data:'fechafin'},
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
            <script>//eliminar metodo
                    var _id;
                    $(document).on('click','.deleteAvanceAcademico',function(){
                        _id=$(this).attr('id');       
                        $('#modalEliminaAvance_modal').modal('show');
                    });
                    $('#btnEliminarAvanceA').click(function(){
                        $.ajax({
                            url:"/avancesacademico/eliminar/"+_id,
                            beforeSend:function(){
                                $('#btnEliminarAvanceA').text('Eliminando..'); 
                                $('#girarEliminarAvanceAcademico').show(); 
                            },
                            success:function(data){
                                if(data)   
                                {           
                                    $('#tablaAvancesAcademicos').DataTable().ajax.reload();
                                    $('#modalEliminaAvance_modal').modal('hide');
                                    toastr.success('El avance académico fue eliminado exitosamente','¡EXITOSO!',{timeOut:1000});
                                    $('#btnEliminarAvanceA').text('Eliminar Avance'); 
                                    $('#girarEliminarAvanceAcademico').hide();   
                                }
                                else
                                {
                                    toastr.warning('El avance académico SOLO puede ser eliminado el dia de su creación','FALLIDO!',{timeOut:3000});
                                    $('#btnEliminarAvanceA').text('Eliminar Avance'); 
                                    $('#girarEliminarAvanceAcademico').hide();   
                                }
                            },
                            error : function(data){
                                toastr.error('Ocurrio un error inesperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:1000});
                                $('#btnEliminarAvanceA').text('Eliminar Avance'); 
                                $('#girarEliminarAvanceAcademico').hide();   
                            }  
                        });
                    });
            </script>
            <script>//CARGAER EN EL FORMULARIO PARA EDITAR metodo
                function editarAvancesAcademico(id){   
                    $.get('/avancesacademico/editarAvanceAcdemico/'+id, function(Avance)
                    {  
                        if(Avance)
                        {
                            //asignar datos recuperados
                            $('#txtIdAvanceAce').val(Avance[0].id_avance);
                            $('#escuelaAvance').val(Avance[0].escuela);
                            $('#areaAvance').val(Avance[0].plan_estudio);
                            $('#asignaturaAvance').val(Avance[0].nombre_mod);
                            $('#licenciaAvance').val(Avance[0].nombre_tlic);
                            $('#periodoAvance').val("Desde "+Avance[0].fechaini+" Hasta "+Avance[0].fechafin);
                            $('#fechaAvance').val(Avance[0].fecha_avance);
                            $('#paraleloAvance').val(Avance[0].nombre_paralelo);
                            $('#horaAvance').val(Avance[0].hora_avance);
                            $('#responsableAvance').val(Avance[0].responsable_avance);
                          
                            $.ajax({
                                url:'/avancesSubtemas/'+id,
                                    success : function(data){
                                        setTimeout(function(){
                                            $('#seccionSubtemasEditar').empty().append($(data));
                                        }
                                        );
                                    }
                            });
                          
                            $.ajax({
                                url:'/avanceSubtema/visualizarDetalle/'+id,
                                    success : function(data){
                                        setTimeout(function(){
                                            $('#seccionDetalleAvanceEditar').empty().append($(data));
                                        }
                                        );
                                     }
                            });
                            $('#editarAvanceAcaModal').modal('toggle');
                            $("input[name=_token]").val();
                        }
                        else{
                            toastr.warning('SOLO se puede editar el dia que se creo el Avance Académico','FALLIDA',{timeOut:3000});
                        }
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
