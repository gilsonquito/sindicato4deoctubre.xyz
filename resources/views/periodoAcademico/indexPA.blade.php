<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/periodoaca.css')}}" rel="stylesheet">
        <title>Periodo academico</title>
    </head>
    <body>
            <div class="container-fluid p-2 "><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success " href="#">Periodos Académicos</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de periodos académicos</a>
                                    </li>
                                    <li class="nav-item" id="cargarTipoLicencia"  onclick="cargarLicencia()">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Nuevo periodo académico</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <!--<h3 class="py-3">Periodos Académicos</h3>-->
                                    <table id="tabla-periodo" class="table table-responsive-lg table-hover w-100">
                                        <thead  class="font-weight-bold text-dark ">
                                            <td scope="col">Id</td>
                                            <td scope="col">Fecha Inicio </td>
                                            <td scope="col">Fecha Fin</td>
                                            <td scope="col">Tipo licencia</td>
                                            <td scope="col">Acciones</td>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                   <!-- <h3 class="py-3" >Nuevo periodo académico</h3-->
                                    <form id="ingreso-periodo">
                                            <div class="row justify-content-center p-2">
                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label ml-2 text-nowrap">Fecha de inicio de periodo académico </label>
                                                        <input id="dateIni" name="dateIni" type="date" class="form-control" tabindex="1" required>
                                                    </div>
                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                        <label for="" class="form-label text-nowrap">Fecha de finalización de periodo académico</label>
                                                        <input id="dateFin" name="dateFin" type="date" class="form-control" tabindex="2" required>
                                                    </div>
                                            </div>
                                            <div class="row justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="select">Tipo de Licencia</label>
                                                                            <select class="form-control" id="selTipoLicencia" name="selTipoLicencia" tabindex="3" required>
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
                                                        <h5 class="modal-title text-center" id="exampleModalLabel">Confirmar para eliminar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <hr>
                                                        ¿Esta seguro de eliminar el periodo académico seleccionado?
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
                                        <div class="modal fade " id="periodo_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar periodo académico</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="periodo_edit_form">
                                                <div class="modal-body">
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                                <div class="row justify-content-center p-2">
                                                                        <div class="form-group col-md-12 px-2  justify-content-center text-left">
                                                                            <label for="" class="form-label ml-2 text-nowrap col-md-12">Fecha de inicio de periodo académico </label>
                                                                            <input id="dateIni2" name="dateIni2" type="date" class="form-control" tabindex="1" required>
                                                                        </div>
                                                                        <div class="form-group col-md-12 px-2  justify-content-center text-left">
                                                                            <label for="" class="form-label text-nowrap col-md-12">Fecha de finalización de periodo académico</label>
                                                                            <input id="dateFin2" name="dateFin2" type="date" class="form-control" tabindex="2" required>
                                                                        </div>
                                                                </div>
                                                                <div class="row justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="select">Tipo de Licencia</label>
                                                                            <select class="form-control" id="selTipoLicencia2" name="selTipoLicencia2" title="seleccione tipo de licencia" tabindex="3" required>
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
                        
                        var periodoacademico=$('#tabla-periodo').DataTable({
                            columnDefs: [
                                { className: "align-middle" , targets: "_all" }
                            ],
                            processing:true,
                            serverSide:true,
                            order: [[1, "desc"], [2, "desc"], [3, "asc"]],
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
                                url:"{{route('periodoAcademico.index')}}",
                            },
                            columns:[
                                {data:'id'},
                                {data:'fechaini'},
                                {data:'fechafin'},
                                {data:'nombre_tipolicencia'},
                                {data:'action',orderable:false}
                            ]

                        });
                    });

            </script>
            <script>//CARGAER select
                function cargarLicencia(){
                    $.get('periodoAcademico/cargarlicencia', function(data)
                    {
                        //asignar valores a select cursos licencia
                        $('#selTipoLicencia').empty();
                        for (var i in data) {
                            if(data[i].id_tlic)
                            {        
                                    document.getElementById("selTipoLicencia").innerHTML += "<option value='"+data[i].nombre_tlic+"'>"+data[i].nombre_tlic+"</option>";            
                            }     
                        }                 
                    });
                    

                }
            </script>
        
            <script> //ingresar un nuevo perido

                    $('#ingreso-periodo').submit(function(e){
                    
                    e.preventDefault();
                    
                        var fechaini=$('#dateIni').val();
                        var fechafin=$('#dateFin').val();
                        var TipoLicencia=$('#selTipoLicencia').val();
                        
                        var _token=$("input[name=_token]").val();
                        
                    
                                if (fechaini<fechafin)
                                {
                                    $.ajax({
                                        url:"{{route('periodoAcademico.ingresar')}}",
                                        type:"POST",
                                        async: true,
                                        data:{
                                            fechaini:fechaini,
                                            fechafin:fechafin,
                                            TipoLicencia:TipoLicencia,
                                            _token:_token
                                        },
                                        success:function(response)
                                        {   
                                            if(response)
                                            {
                                            
                                                $('#ingreso-periodo')[0].reset();
                                                toastr.success('El registro fue exitoso','¡EXITOSO!',{timeOut:3000});
                                                $('#tabla-periodo').DataTable().ajax.reload();
                                            }
                                        },
                                        error : function(response){
                                            toastr.error('No se realizo el registro','Error',{timeOut:3000});
                                        }
                                    });
                                }
                                else
                                {
                                    toastr.warning('Ingrese una fecha final mayor a  la fecha inicial','FECHA INCORRECTA',{timeOut:3000});
                                }
                            
                    

                    
                    })

            </script>
            <script>//eliminar un periodo
                    var _id;
                    $(document).on('click','.delete',function(){
                    _id=$(this).attr('id'); 
                    $('#confirmModal').modal('show');
                    });
                    $('#btnEliminar').click(function(){
                    $.ajax({
                        url:"periodoAcademico/eliminar/"+_id,
                        beforeSend:function(){
                            $('#btnEliminar').text('Eliminando..'); 
                            $('#girar').show(); 
                        },
                        success:function(data){
                            setTimeout(function(){
                                $('#confirmModal').modal('hide');
                                toastr.success('El periodo académico fue eliminado exitosamente','¡EXITOSO!',{timeOut:3000});
                                $('#tabla-periodo').DataTable().ajax.reload();
                                $('#btnEliminar').text('Eliminar'); 
                                $('#girar').hide(); 
                            },2000);
                        
                        },
                        error : function(response){
                                toastr.error('Ocurrio un error, es posible que el periodo ya este asignado en otra tabla y no se puede borrar','¡FALLIDA!',{timeOut:4000});
                                $('#confirmModal').modal('hide');
                                $('#btnEliminar').text('Eliminar'); 
                                $('#girar').hide(); 
                        }
                    });
                    });

            </script>
            <script>//CARGAR EN EL FORMULARIO PARA EDITAR
                    function editarPeriodo(id){
                        $.get('periodoAcademico/editar/'+id, function(periodo)
                        {
                            //asignar valores a select tipo licencia2
                            $('#selTipoLicencia2').empty();
                            for (var i in periodo) {
                                if(periodo[i].id_tlic)
                                {        
                                    if(!(i==0))
                                        {   
                                            document.getElementById("selTipoLicencia2").innerHTML += "<option value='"+periodo[i].nombre_tlic+"'>"+periodo[i].nombre_tlic+"</option>";            
                                        }
                                }     
                            }       
                            //asignar datos recuperados
                            $('#txtId2').val(periodo[0].id);
                            
                            $('#dateIni2').val(periodo[0].fechaini);
                            $('#dateFin2').val(periodo[0].fechafin);
                            $('#selTipoLicencia2').val(periodo[0].nombre_tipolicencia);
                            $("input[name=_token]").val();
                            $('#periodo_edit_modal').modal('toggle');

                        });

                    }
            </script>
            <script>//actualizar datos

                    $('#periodo_edit_form').submit(function(e){

                    e.preventDefault();
                    var id2=$('#txtId2').val();
                    var fechaini2=$('#dateIni2').val();
                    var fechafin2=$('#dateFin2').val();
                    var TipoLicencia2=$('#selTipoLicencia2').val();
                    var _token2=$("input[name=_token]").val();

                    if (fechaini2<fechafin2)
                    {
                            $.ajax({
                                url:"{{route('periodoAcademico.actualizar')}}",
                                type:"POST",
                                data:{
                                    id:id2, 
                                    fechaini:fechaini2,
                                    fechafin:fechafin2,
                                    TipoLicencia:TipoLicencia2,
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
                                        $('#periodo_edit_modal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                        $('#tabla-periodo').DataTable().ajax.reload();
                                        $('#btnActualizar').text('Guardar cambios'); 
                                        $('#girar2').hide(); 
                                    }
                                }
                            });
                    }
                    else
                    {
                            toastr.warning('Ingrese una fecha final mayor a  la fecha inicial','FECHA INCORRECTA',{timeOut:3000});
                    }
                    })
            </script>
     
            
    <body>
</html>

