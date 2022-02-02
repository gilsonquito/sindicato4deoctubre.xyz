<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/matricula.css')}}" rel="stylesheet">     
        <title>Matriculas</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Matrículas</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de matrículas</a>
                                    </li>
                                    <li class="nav-item"  onclick="cargarSelectsMatriculas()">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Nueva matrícula</a>
                                    </li>
                                    <li class="nav-item"  onclick="cargarSelectsCursosM()">
                                        <a class=" nav-link" id="gestionCursos-tab" data-toggle="tab" href="#gestionCursos" role="tab" aria-controls="gestionCursos" aria-selected="false"><i class="fa fa-columns text-success mr-2" aria-hidden="true"></i>Gestión de estudiantes por cursos</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <!--<h3 class="py-3">Periodos Académicos</h3>-->
                                    <table id="tabla-matriculas" class="table-striped table-responsive table-hover w-100">
                                        <thead  class="font-weight-bold text-dark ">
                                            <tr>
                                                <td colspan="2" class="align-middle">PERÍODO ACADÉMICO</td>
                                                <td rowspan="2" class="align-middle">Tipo Licencia</td>
                                                <td rowspan="2" class="align-middle">Paralelo</td>
                                                <td rowspan="2" class="align-middle">Apellido Estudiante</td>
                                                <td rowspan="2" class="align-middle">Nombre estudiante</td>
                                                <td rowspan="2" class="align-middle">Cédula</td>
                                                <td rowspan="2" class="align-middle">Jornada</td>
                                                <td rowspan="2" class="align-middle">Modalidad</td>
                                                <td rowspan="2" class="align-middle">Duración</td>
                                                <td rowspan="2" class="align-middle">ID</td>
                                                <td rowspan="2" class="align-middle">Acciones</td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle" >Inicio</td>
                                                <td class="align-middle">Fin</td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                   <!-- <h3 class="py-3" >Nuevo curso</h3-->
                                    <form id="ingreso-matricula">
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                            <label for="select">Período académico</label>
                                                            <select class="form-control" id="selPeridoAcaM" name="selPeridoAcaM" tile="Seleccione periodo academico"tabindex="2" required>
                                                        </select>
                                                </div>
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="select">Curso</label>
                                                    <select class="form-control" id="selCursoM" name="selCursoM" tabindex="1" tile="Seleccione cursos" required>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="row justify-content-center p-2">                                            
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="select">Estudiante</label>
                                                    <select class="form-control" id="selEstudianteM" name="selEstudianteM" tile="Seleccione estudiante"tabindex="3" required>
                                                </select>
                                                </div>
                                        </div>
                                            <button type="submit" class="btn btn-success btn-lg" tile="Crear curso"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Generar matrícula</button>
                                    </form>
                                </div>
                                 <!-- gestion paralelos  -->
                                <div class="tab-pane fade" id="gestionCursos" role="tabpanel" aria-labelledby="gestionCursos-tab">
                                    <form id="cambiarCurso_Matricula">
                                        <div class="row justify-content-center p-2">
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                            <label for="select">Período académico</label>
                                                            <select class="form-control" id="selPeridoAcaMEditC" name="selPeridoAcaMEditC" tile="Seleccione periodo academico"tabindex="1" required>
                                                        </select>
                                                </div>
                                                <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                    <label for="select">Curso</label>
                                                    <select class="form-control" id="selCursoMEditC" name="selCursoMEditC" tabindex="2" tile="Seleccione cursos" required>
                                                    </select>
                                                </div>
                                        </div>
                                        <div id="tablaEstudiantes">
                                        </div>
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
                                                            ¿Esta seguro de eliminar la matrícula seleccionada?
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
                                        <div class="modal fade w-100" id="matricula_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar matrícula</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="matricula_edit_form">
                                                <div class="modal-body">                                                    
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                                <div class="row justify-content-center p-2">
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="select">Curso</label>
                                                                        <select class="form-control" id="selCursoM2" name="selCursoM2" tabindex="1" tile="Seleccione cursos" required>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                        <label for="select">Período académico</label>
                                                                        <select class="form-control" id="selPeridoAcaM2" name="selPeridoAcaM2" tile="Seleccione periodo academico"tabindex="2" required>
                                                                    </select>
                                                                </div>
                                                                </div>
                                                                <div class="row justify-content-center p-2">                                            
                                                                        <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                            <label for="select">Estudiante</label>
                                                                            <select class="form-control" id="selEstudianteM2" name="selEstudianteM2" tile="Seleccione estudiante"tabindex="3" required>
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
                    var cursolicencia=$('#tabla-matriculas').DataTable({
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
                        order: [[0, "desc"],[1, "desc"],[2, "asc"],[3, "asc"],[4, "asc"], [5, "asc"]],
                       
                        ajax:{
                            url:"{{route('matriculas.index')}}",
                        },
                        columns:[
                            {data:'fechaini'},
                            {data:'fechafin'},
                            {data:'nombre_tlic'},
                            {data:'nombre_paralelo'}, 
                            {data:'apellido_est'},
                            {data:'name_est'},
                            {data:'cedula_est'},
                          
                            {data:'jornada'}, 
                            {data:'modalidad'},
                            {data:'duracion_meses'},
                         
                            
                            {data:'id_matricula'},
                            {data:'action',orderable:false}
                        ]

                    });
                    $('#selPeridoAcaM').on('change', function(e){//cargar  curso
                        var periodoacadM = e.target.value;
                        $.get('/estudiantes/caragarSelectCursosMat/'+periodoacadM,function(data) {
                                $('#selCursoM').empty();
                                $('#selCursoM').append('<option value="" disabled="true" selected="true">Elija un curso</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#selCursoM').append('<option value="'+ regenciesObj.id_curlic +'">'+"Licencia tipo "+ regenciesObj.nombre_tlic +" / "+ regenciesObj.jornada+" / "+ regenciesObj.modalidad+" / "+ regenciesObj.duracion_meses+" meses "+" / Paralelo "+ regenciesObj.nombre_paralelo+'</option>');
                                })          
                        });  
                    });
                    $('#selPeridoAcaMEditC').on('change', function(e){//cargar  curso
                        var periodoacadM = e.target.value;
                        $.get('/estudiantes/caragarSelectCursosMat/'+periodoacadM,function(data) {
                                $('#selCursoMEditC').empty();
                                $('#selCursoMEditC').append('<option value="" disabled="true" selected="true">Elija un curso</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#selCursoMEditC').append('<option value="'+ regenciesObj.id_curlic +'">'+"Licencia tipo "+ regenciesObj.nombre_tlic +" / "+ regenciesObj.jornada+" / "+ regenciesObj.modalidad+" / "+ regenciesObj.duracion_meses+" meses "+" / Paralelo "+ regenciesObj.nombre_paralelo+'</option>');
                                })          
                        });  
                    });
                    $('#selCursoMEditC').on('change', function(e){//cargar  tabla estudiantes
                        var id_curso = e.target.value;
                        var periodoA = $('#selPeridoAcaMEditC').val();;
                        $.ajax({
                            url:'/matriculas/cambiarCursoEstudiante/'+periodoA+'/'+id_curso,
                            success : function(data){
                                setTimeout(function(){
                                    $('#tablaEstudiantes').empty().append($(data));
                                }
                                );
                            }
                        });
                    });
                });
            </script>
             
            <script>//CARGAR selects
                function cargarSelectsMatriculas(){
                    $.get('/matriculas/cargarSelect', function(data)
                    {
                       
                        //asignar valores a select tipos licencia
                        //asignar valores a select paralelo licencia
                        $('#selPeridoAcaM').empty();
                        $('#selPeridoAcaM').append('<option value="" disabled="true" selected="true">Elija un período académico</option>');
                       
                        for (var i in data) {
                            if(data[i].id)
                            {        
                                    document.getElementById("selPeridoAcaM").innerHTML += "<option value='"+data[i].id+"'>"+"Desde "+data[i].fechaini+" hasta "+data[i].fechafin+" "+data[i].nombre_tipolicencia+"</option>";            
                            }     
                        } 
                        //asignar valores a select estudiantes
                        $('#selEstudianteM').empty();
                        for (var i in data) {
                            if(data[i].id_est)
                            {        
                                    //document.getElementById("selEstudianteMs").innerHTML += "<option value='"+data[i].id_est+"'>"+data[i].apellido_est+data[i].name_est+data[i].cedula_est+"</option>";            
                                    document.getElementById("selEstudianteM").innerHTML += "<option value='"+data[i].id_est+"'>"+data[i].apellido_est+" "+data[i].name_est+" "+data[i].cedula_est+"</option>";
                            }     
                        }                           
                    });
                }
                function cargarSelectsCursosM(){
                    $.get('/matriculas/cargarSelect', function(data)
                    {
                       
                        //asignar valores a select tipos licencia
                        //asignar valores a select paralelo licencia
                        $('#selPeridoAcaMEditC').empty();
                        $('#selPeridoAcaMEditC').append('<option value="" disabled="true" selected="true">Elija un período académico</option>');
                       
                        for (var i in data) {
                            if(data[i].id)
                            {        
                                    document.getElementById("selPeridoAcaMEditC").innerHTML += "<option value='"+data[i].id+"'>"+"Desde "+data[i].fechaini+" hasta "+data[i].fechafin+" "+data[i].nombre_tipolicencia+"</option>";            
                            }     
                        } 
                        //asignar valores a select estudiantes                         
                    });
                }
            </script>
        
           
            <script> //ingresar NUEVA MATRICULA              
               $('#ingreso-matricula').submit(function(e){
                   e.preventDefault();
                    var id_curlic=$('#selCursoM').val();
                    var id_est=$('#selEstudianteM').val();
                    var id_periodo =$('#selPeridoAcaM').val();
                    var _token=$("input[name=_token]").val(); 
                                $.ajax({
                                    url:"{{route('matriculas.ingresar')}}",
                                    type:"POST",
                                    async: true,
                                    data:{
                                        id_curlic:id_curlic,
                                        id_est:id_est,
                                        id_periodo:id_periodo,
                                        _token:_token
                                    },
                                    success:function(response)
                                    {   
                                        if(response)
                                        {   
                                            if(response==1)
                                            {                                     
                                                $('#ingreso-matricula')[0].reset();
                                                toastr.success('El ingreso fue exitoso','¡EXITOSO!',{timeOut:3000});
                                                $('#tabla-matriculas').DataTable().ajax.reload();
                                            }
                                            if(response==2)
                                            {                                     
                                                toastr.warning('Ya existe la matricula de estudiante, revise en MATRICULAS','¡FALLIDA!',{timeOut:3000});
                                            }
                                        }
                                        else{
                                            toastr.warning('El período académico seleccionado a culminado NADA QUE HACER','¡EXITOSO!',{timeOut:3000});
                                        }
                                    },                                    
                                    error : function(response){
                                        toastr.error('El ingreso fue fallido, intente nuevamente','¡FALLIDA!',{timeOut:3000});
                                    }
                                });        
                })
                
        </script>
        
        <script>//eliminar una matricula
            var _id;
            $(document).on('click','.delete',function(){
                _id=$(this).attr('id'); 
                $('#confirmModal').modal('show');
            });
            $('#btnEliminar').click(function(){
                $.ajax({
                    url:"/matriculas/eliminar/"+_id,
                    beforeSend:function(){
                        $('#btnEliminar').text('Eliminando..'); 
                        $('#girar').show(); 
                    },
                    success:function(data){
                        if(data)
                        {
                            $('#confirmModal').modal('hide');
                            toastr.success('La matrícula fue eliminada exitosamente','¡EXITOSO!',{timeOut:3000});
                            $('#tabla-matriculas').DataTable().ajax.reload();
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                        }
                        else{
                          
                            toastr.error('El período académico seleccionado a culminado nada que hacer ','FALLIDA!',{timeOut:3000});
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                        }
                            
                                          
                    }
                });
            });

        </script>
       
        <script>//CARGAER EN EL FORMULARIO PARA EDITAR
            function editarMatricula(id){
                $.get('/matriculas/editar/'+id, function(curso)
                {
                   //asignar valores a select cursos
                        $('#selCursoM2').empty();
                        for (var i in curso) {
                            if(curso[i].id_curlic)
                            {
                                if(!(i==0))
                                    { 
                                        document.getElementById("selCursoM2").innerHTML += "<option value='"+curso[i].id_curlic+"'>"+curso[i].nombre_tlic+" - "+curso[i].jornada+" - "+curso[i].modalidad+" - "+curso[i].duracion_meses+" meses - Paralelo "+curso[i].nombre_paralelo+"</option>";              
                                    }
                            }     
                        }
                        //asignar valores a select periodos academicos
                        $('#selPeridoAcaM2').empty();
                        for (var i in curso) {
                            if(curso[i].id)
                            {
                                if(!(i==0))
                                    {         
                                        document.getElementById("selPeridoAcaM2").innerHTML += "<option value='"+curso[i].id+"'>"+"Desde "+curso[i].fechaini+" hasta "+curso[i].fechafin+" "+curso[i].nombre_tipolicencia+"</option>";
                                    }
                            }     
                        }  //asignar valores a select estudiantes
                        $('#selEstudianteM2').empty();
                        for (var i in curso) {
                            if(curso[i].id_est)
                            {
                                if(!(i==0))
                                    {         
                                        document.getElementById("selEstudianteM2").innerHTML += "<option value='"+curso[i].id_est+"'>"+curso[i].apellido_est+" "+curso[i].name_est+" "+curso[i].cedula_est+"</option>";            
                                    }
                            }     
                        }                    
                    //asignar datos recuperados
                    $('#txtId2').val(curso[0].id_matricula);
                    $('#selCursoM2').val(curso[0].id_curlic);
                    $('#selPeridoAcaM2').val(curso[0].id_periodo);
                    $('#selEstudianteM2').val(curso[0].id_est);
                    $("input[name=_token]").val();
                    $('#matricula_edit_modal').modal('toggle');
                });
            }
        </script>
       
        <script>//actualizar cambios realizados
    
            $('#matricula_edit_form').submit(function(e){        
                e.preventDefault();
                var id_matricula2=$('#txtId2').val();
                var id_curlic2=$('#selCursoM2').val();
                var id_periodo2=$('#selPeridoAcaM2').val();
                var id_est2=$('#selEstudianteM2').val();
                var _token2=$("input[name=_token]").val();
                        $.ajax({
                            url:"{{route('matriculas.actualizar')}}",
                            type:"POST",
                            data:{
                                id_matricula:id_matricula2, 
                                id_curlic:id_curlic2,
                                id_periodo:id_periodo2,
                                id_est:id_est2,
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
                                    $('#matricula_edit_modal').modal('hide');
                                    toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                    $('#tabla-matriculas').DataTable().ajax.reload();
                                    $('#btnActualizar').text('Guardar cambios'); 
                                    $('#girar2').hide(); 
                                }
                                else{
                                    toastr.error('El período académico seleccionado a culminado nada que hacer','FALLIDA',{timeOut:2000});
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
        
    <body>
</html>

