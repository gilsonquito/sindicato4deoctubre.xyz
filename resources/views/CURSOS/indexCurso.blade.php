<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/cursos.css')}}" rel="stylesheet">     
        <title>Cursos</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Cursos de licencias</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de cursos</a>
                                    </li>
                                    <li class="nav-item"  onclick="cargarSelects()">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Nuevo curso</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <!--<h3 class="py-3">Periodos Académicos</h3>-->
                                    <table id="tabla-cursos" class="table table-responsive-lg table-hover w-100">
                                        <thead  class="font-weight-bold text-dark ">
                                            <td scope="col">Id</td>
                                            <td scope="col">Tipo de licencia</td>
                                            <td scope="col">Jornada</td>
                                            <td scope="col">Modalidad</td>
                                            <td scope="col">Duración meses</td>
                                            <td scope="col">Paralelo</td>
                                            <td scope="col">Acciones</td>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                   <!-- <h3 class="py-3" >Nuevo curso</h3-->
                                    <form id="ingreso-curso">
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="select">Tipo de licencia</label>
                                                    <select class="form-control" id="selTipoLicencia" name="selTipoLicencia" tabindex="1" tile="Seleccione Tipo de licencia" required>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="select">Jornada</label>
                                                    <select class="form-control" id="selJornada" name="selJornada" tile="Seleccione jornada" tabindex="2" required>
                                                        <option value="Diurno">Diurno</option>
                                                        <option value="Nocturno">Nocturno</option>
                                                        <option value="Fines-de-semana">Fines-de-semana</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                <label for="select">Modalidad</label>
                                                <select class="form-control" id="selModalidad" name="selModalidad" tile="Seleccione modalidad"tabindex="3" required>
                                                    <option value="Regular">Regular</option>
                                                    <option value="Convalidado">Convalidado</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label">Duración Meses</label>
                                                <input id="txtduracion_meses" name="txtduracion_meses" type="text" class="form-control" tile="Ingresa duracion meses" tabindex="4" maxlength="2" required>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="select">Paralelo</label>
                                                    <select class="form-control" id="selParalelo" name="selParalelo" tile="Seleccione paralelo"tabindex="5" required>                     
                                                    </select>
                                                </div>
                                        </div>
                                            <button type="submit" class="btn btn-success btn-lg" tile="Crear curso"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Crear curso</button>
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
                                                        ¿Esta seguro de eliminar el curso seleccionado?
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
                                        <div class="modal fade " id="curso_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar curso</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="curso_edit_form">
                                                <div class="modal-body">
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                                <div class="row justify-content-center p-2">
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="select">Tipo de licencia</label>
                                                                            <select class="form-control" id="selTipoLicencia2" name="selTipoLicencia2" tabindex="1" tile="Seleccione Tipo de licencia" required>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="select">Jornada</label>
                                                                            <select class="form-control" id="selJornada2" name="selJornada2" tile="Seleccione jornada" tabindex="2" required>
                                                                                <option value="Diurno">Diurno</option>
                                                                                <option value="Nocturno">Nocturno</option>
                                                                                <option value="Fines-de-semana">Fines-de-semana</option>
                                                                            </select>
                                                                        </div>
                                                                </div>
                                                                <div class="row justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="select">Modalidad</label>
                                                                        <select class="form-control" id="selModalidad2" name="selModalidad2" tile="Seleccione modalidad"tabindex="3" required>
                                                                            <option value="Regular">Regular</option>
                                                                            <option value="Convalidado">Convalidado</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="" class="form-label">Duración meses</label>
                                                                        <input id="txtduracion_meses2" name="txtduracion_meses2" type="text" class="form-control" tile="Ingresa cantidad" tabindex="4" maxlength="2" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-center p-2">
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="select">Paralelo</label>
                                                                            <select class="form-control" id="selParalelo2" name="selParalelo2" tile="Seleccione paralelo"tabindex="5" required>                    
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
                    
                    var cursolicencia=$('#tabla-cursos').DataTable({
                        columnDefs: [
                                { className: "align-middle" , targets: "_all" }
                            ],
                        processing:true,
                        serverSide:true,
                        order: [[1, "asc"], [5, "asc"]],
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
                            url:"{{route('cursolicencia.index')}}",
                        },
                        columns:[
                            {data:'id_curlic'},
                            {data:'nombre_tlic'},
                            {data:'jornada'},
                            {data:'modalidad'},
                            {data:'duracion_meses'}, 
                            {data:'nombre_paralelo'},
                            {data:'action',orderable:false}
                        ]

                    });
                });
            </script>
            <script>//CARGAR selects
                function cargarSelects(){
                    $.get('/cursolicencia/cargarSelect', function(data)
                    {
                        //asignar valores a select tipos licencia
                        $('#selTipoLicencia').empty();
                        for (var i in data) {
                            if(data[i].id_tlic)
                            {        
                                    document.getElementById("selTipoLicencia").innerHTML += "<option value='"+data[i].id_tlic+"'>"+data[i].nombre_tlic+"</option>";            
                            }     
                        }
                        //asignar valores a select paralelo licencia
                        $('#selParalelo').empty();
                        for (var i in data) {
                            if(data[i].id_paralelo)
                            {        
                                    document.getElementById("selParalelo").innerHTML += "<option value='"+data[i].id_paralelo+"'>"+data[i].nombre_paralelo+"</option>";            
                            }     
                        }                       
                    });
                    

                }
            </script>
        
           
            <script> //ingresar un nuevo curso
              
               $('#ingreso-curso').submit(function(e){
                   e.preventDefault();
                    var id_tlic=$('#selTipoLicencia').val();
                    var jornada=$('#selJornada').val();
                    var modalidad =$('#selModalidad').val();
                    var duracion_meses=$('#txtduracion_meses').val();
                    var id_paralelo=$('#selParalelo').val();
                    var _token=$("input[name=_token]").val(); 
                    //alert(id_tlic+" "+id_paralelo);
                                $.ajax({
                                    url:"{{route('cursolicencia.ingresar')}}",
                                    type:"POST",
                                    async: true,
                                    data:{
                                        id_tlic:id_tlic,
                                        jornada:jornada,
                                        modalidad:modalidad,
                                        duracion_meses:duracion_meses,
                                        id_paralelo:id_paralelo,
                                        _token:_token
                                    },
                                    success:function(response)
                                    {   
                                        if(response)
                                        {
                                        
                                            $('#ingreso-curso')[0].reset();
                                            toastr.success('El ingreso fue exitoso','¡EXITOSO!',{timeOut:3000});
                                            $('#tabla-cursos').DataTable().ajax.reload();
                                        }
                                    },
                                    
                                    error : function(response){
                                        toastr.error('El ingreso fue fallido, intente nuevamente','¡FALLIDA!',{timeOut:3000});
                                    }
                                });        
                })
                
        </script> 
        <script>//eliminar un curso
            var _id;
            $(document).on('click','.delete',function(){
                _id=$(this).attr('id'); 
                $('#confirmModal').modal('show');
            });
            $('#btnEliminar').click(function(){
                $.ajax({
                    url:"/cursolicencia/eliminar/"+_id,
                    beforeSend:function(){
                        $('#btnEliminar').text('Eliminando..'); 
                        $('#girar').show(); 
                    },
                    success:function(data){
                        setTimeout(function(){
                            $('#confirmModal').modal('hide');
                            toastr.success('El curso fue eliminado exitosamente','¡EXITOSO!',{timeOut:3000});
                            $('#tabla-cursos').DataTable().ajax.reload();
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                        },2000);
                    
                    }
                });
            });

        </script>
        <script>//CARGAER EN EL FORMULARIO PARA EDITAR
            function editarCurso(id){
                $.get('/cursolicencia/editar/'+id, function(curso)
                {
                   //asignar valores a select tipos licencia
                   $('#selTipoLicencia2').empty();
                        for (var i in curso) {
                            if(curso[i].id_tlic)
                            {
                                if(!(i==0))
                                    { 
                                        document.getElementById("selTipoLicencia2").innerHTML += "<option value='"+curso[i].id_tlic+"'>"+curso[i].nombre_tlic+"</option>";            
                                    }
                            }     
                        }
                        //asignar valores a select paralelo licencia
                        $('#selParalelo2').empty();
                        for (var i in curso) {
                            if(curso[i].id_paralelo)
                            {
                                if(!(i==0))
                                    {         
                                        document.getElementById("selParalelo2").innerHTML += "<option value='"+curso[i].id_paralelo+"'>"+curso[i].nombre_paralelo+"</option>";            
                                    }
                            }     
                        }                  

                    //asignar datos recuperados
                    $('#txtId2').val(curso[0].id_curlic);
                    $('#selTipoLicencia2').val(curso[0].id_tlic);
                    $('#selJornada2').val(curso[0].jornada);
                    $('#selModalidad2').val(curso[0].modalidad);
                    $('#txtduracion_meses2').val(curso[0].duracion_meses);
                    $('#selParalelo2').val(curso[0].id_paralelo);
                    $("input[name=_token]").val();
                    $('#curso_edit_modal').modal('toggle');

                });

            }
        </script>
        <script>//actualizar cambios realizados
    
            $('#curso_edit_form').submit(function(e){
        
                e.preventDefault();
                var id_curlic2=$('#txtId2').val();
                var id_tlic2=$('#selTipoLicencia2').val();
                var jornada2=$('#selJornada2').val();
                var modalidad2=$('#selModalidad2').val();
                var duracion_meses2=$('#txtduracion_meses2').val();
                var id_paralelo2=$('#selParalelo2').val();
                var _token2=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('cursolicencia.actualizar')}}",
                            type:"POST",
                            data:{
                                id_curlic:id_curlic2, 
                                id_tlic:id_tlic2,
                                jornada:jornada2,
                                modalidad:modalidad2,
                                duracion_meses:duracion_meses2,
                                id_paralelo:id_paralelo2,
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
                                    $('#curso_edit_modal').modal('hide');
                                    toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                    $('#tabla-cursos').DataTable().ajax.reload();
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
                
            })
        </script>
        <script>
            $("#txtduracion_meses").bind('keypress', function(event) {
            var regex = new RegExp("^[0-9]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
            });
            $("#txtduracion_meses2").bind('keypress', function(event) {
            var regex = new RegExp("^[0-9]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
            });
        </script>

    <body>
</html>

