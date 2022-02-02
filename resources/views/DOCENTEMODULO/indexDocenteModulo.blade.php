<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/docentemodulo.css')}}" rel="stylesheet">
        <title>DocenteMoulo</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Lista de asignaciones de Docentes/Módulos</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de docentes/módulos</a>
                                    </li>
                                </ul>
                           
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <!--<h3 class="py-3">Periodos Académicos</h3>-->
                                    <table id="tabla-docentemodulo" class="table table-responsive-lg w-100 table-hover">
                                        <thead  class="font-weight-bold text-dark ">
                                            <td scope="col" class="">Módulo</td>
                                            <td scope="col" class="">Apéllido Docente</td>
                                            <td scope="col" class="">Nombre Docente</td>
                                            <td scope="col" class="">Tipo de licencia</td>
                                            <td scope="col" class="">Jornada</td>
                                            <td scope="col" class="">Modalidad</td>
                                            <td scope="col" class="">Paralelo</td>
                                            <td scope="col" class="">Id</td>
                                            <td scope="col" class="">Acciones</td>
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
                                                        ¿Esta seguro de eliminar esta asignación de docente clase módulo?
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
                                            <form id="docentemodulo_edit_form">
                                                <div class="modal-body">     
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                                <div class="row  justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left text-truncate">
                                                                        <label for="select">Modulo</label>
                                                                        <select class="form-control" data-container="body" id="selModulos2" name="selModulos2" tabindex="1" required>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="select">Docente</label>
                                                                        <select class="form-control" id="selDocentes2" name="selDocentes2" tabindex="2" required>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="select"> Curso/Tipo de Licencia</label>
                                                                        <select class="form-control" id="selCursos2" name="selCursos2" tabindex="3" required>
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
                    
                    var docentes=$('#tabla-docentemodulo').DataTable({
                        columnDefs: [
                                { className: "align-middle" , targets: "_all" }
                            ],
                        processing:true,
                        serverSide:true,
                        order: [[0, "asc"], [1, "asc"], [2, "asc"], [3, "asc"], [6, "asc"]],
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
                            url:"{{route('docentemodulo.index')}}",
                        },
                        columns:[
                            {data:'nombre_mod'},
                            {data:'apellido_doc'},
                            {data:'name'},
                            {data:'nombre_tlic'},
                            {data:'jornada'},
                            {data:'modalidad'},
                            {data:'nombre_paralelo'},
                            {data:'id_doc_mod'},
                            {data:'action',orderable:false}
                        ]

                    });
                   
                });
            </script>
        <script>/////////////////////////eliminar un docente------------------------------
            var _id;
            $(document).on('click','.delete',function(){
                _id=$(this).attr('id'); 
                $('#confirmModal').modal('show');
            });
            $('#btnEliminar').click(function(){
                
                $.ajax({
                   
                    url:"docentemodulo/eliminar/"+_id,
                    beforeSend:function(){
                        $('#btnEliminar').text('Eliminando..'); 
                        $('#girar').show(); 
                    },
                    success:function(data){
                        setTimeout(function(){
                            console.log(data);
                            $('#confirmModal').modal('hide');
                            toastr.success('La asignación fue eliminada exitosamente','¡EXITOSO!',{timeOut:3000});
                            $('#tabla-docentemodulo').DataTable().ajax.reload();
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                        },2000);
                        
                    },
                    error : function(data){
                        toastr.error('Ocurrio un error ineperado vuelva a intentarlo','¡FALLIDA!',{timeOut:3000});
                        toastr.warning('No se pueden eliminar la asignación si el docente ya fue asignado a un Período Académico','¡FALLIDA!',{timeOut:3000});
                        $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                    }  
                });
            });

        </script> 
         <script>//CARGAER EN EL FORMULARIO PARA EDITAR
            function editarDocenteModulo(id){
            
                $.get('docentemodulo/editar/'+id, function(data)
                {
                    //asiganr valores a select modulos
                    $('#selModulos2').empty();
                    for (var i in data) {
                        if(data[i].id_mod)
                        {
                            if(!(i==0))
                            { 
                                document.getElementById("selModulos2").innerHTML += "<option value='"+data[i].id_mod+"'>"+data[i].nombre_mod+"</option>";      
                            }
                        }    
                    }
                    $('#selModulos2').val(data[0].id_mod);
                    //asignar valores a select docentes
                    $('#selDocentes2').empty();
                   
                    for (var i in data) {
                        if(data[i].id_doc)
                        {
                            if(!(i==0))
                            {   
                                document.getElementById("selDocentes2").innerHTML += "<option value='"+data[i].id_doc+"'>"+data[i].apellido_doc+" "+data[i].name+"-"+data[i].cedula_doc+"</option>";            
                            }
                        }     
                    }
                    $('#selDocentes2').val(data[0].id_doc);
                     //asignar valores a select cursos licencia
                     $('#selCursos2').empty();
                    for (var i in data) {
                        if(data[i].id_curlic)
                        {
                            if(!(i==0))
                            {   
                                document.getElementById("selCursos2").innerHTML += "<option value='"+data[i].id_curlic+"'>"+data[i].nombre_tlic+" "+data[i].jornada+" "+data[i].modalidad+" / "+data[i].nombre_paralelo+"</option>";            
                            }
                        }     
                    }
                    $('#selCursos2').val(data[0].id_curlic);                  
                    //asignar datos recuperados
                    $('#txtId2').val(data[0].id_doc_mod);
                    $('#modulodocente_edit_modal').modal('toggle');
                    $("input[name=_token]").val();
                });
                

            }
        </script>
        <script>//actualizar cambios realizados
                
                $('#docentemodulo_edit_form').submit(function(e){
                    e.preventDefault();
                    var id_doc_mod2=$('#txtId2').val();
                    var id_mod2=$('#selModulos2').val();
                   var id_doc2=$('#selDocentes2').val();
                   var id_curlic2 =$('#selCursos2').val();
                  
                   var _token2=$("input[name=_token]").val(); 
                  
                        $.ajax({
                                    url:"{{route('docentemodulo.actualizar')}}",
                                    type:"POST",
                                    data:{
                                        id_doc_mod:id_doc_mod2, 
                                        id_mod:id_mod2,
                                        id_doc:id_doc2,
                                        id_curlic:id_curlic2,
                                     
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
                                            $('#modulodocente_edit_modal').modal('hide');
                                            toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                            $('#tabla-docentemodulo').DataTable().ajax.reload();
                                            $('#btnActualizar').text('Guardar cambios'); 
                                            $('#girar2').hide(); 
                                        }
                                    },
                                    error : function(response){
                                                toastr.warning('Ocurrio un error intente nuevamente','¡FALLIDA!',{timeOut:3000});
                                                $('#btnActualizar').text('Guardar cambios'); 
                                                $('#girar2').hide(); 
                                    }
                                });
                    
                   
                    
                })
            </script>

    <body>
</html>

