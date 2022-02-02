<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/notasDocente.css')}}" rel="stylesheet">
        <title>Notas docente</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Notas docente</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item" onclick="recargarTabla()">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de notas</a>
                                    </li>
                                    <li class="nav-item" onclick="cargarSelectPeriodos()">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Subir notas</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <table id="tabla-notasDocente" class="table table-responsive table-hover w-100">
                                        <thead  class="font-weight-bold text-dark ">
                                            <tr>
                                                <td class="align-middle" rowspan="2">Nombre de módulo</td>
                                                <td class="align-middle" colspan="2">Período Académico</td>
                                                <td class="align-middle" rowspan="2">Tipo licencia</td>
                                                <td class="align-middle" rowspan="2">Jornada</td>
                                                <td class="align-middle" rowspan="2">Modalidad</td>
                                                <td class="align-middle" rowspan="2">Paralelo</td>
                                                <td class="align-middle" rowspan="2">Apellido Est</td>
                                                <td class="align-middle" rowspan="2">Nombre Est</td>
                                                <td class="align-middle" colspan="5">Notas</td>
                                                <td class="align-middle" rowspan="2">Acciones</td>
                                            </tr>
                                            <tr>
                                                <td >Inicio</td>
                                                <td >Fin</td>
                                                <td >Trabajo en Equipo</td>
                                                <td >Estudios de Caso</td>
                                                <td >Prueba Práctica</td>
                                                <td >Prueba Teórica</td>
                                                <td >Suspenso</td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!--INgresar nuevo modulo-->
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                   
                                     <!-- <form id="ingreso-notasDocente"   enctype="multipart/form-data">-->
                                            <!--@csrf-->
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione período académico</label>
                                                        <select class="form-control" id="SelPeriodoAcademico" name="SelPeriodoAcademico" tabindex="1" tile="Seleccione periodo acadeemico" required>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione curso</label>
                                                        <select class="form-control" id="SelCursos" name="SelCursos" tabindex="2" tile="Seleccione curso" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un curso</option>    
                                                        </select>
                                                    </div>    
                                                </div>
                                                <div class="row  justify-content-center p-2">
                                                    <div class="col-md-6 px-2 justify-content-center  text-left">
                                                        <label for="" class="form-label ml-2">Seleccione módulo</label>
                                                        <select class="form-control" id="SelModulos" name="SelModulos" tabindex="3" tile="Seleccione periodo acadeemico" required>
                                                            <option selected="true" disabled="disabled" value="">Elija un módulo</option>
                                                        </select>
                                                    </div>  
                                                </div>
                                                <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                                                    <a class="navbar-brand text-dark" href="#">Listado de estudiantes</a>
                                                </nav>
                                                <div id="tabla-listaEstudiantes">
                                                </div>
                                    <!--</form>-->
                                    <!--fin del formulario d eingreso-->
                                </div>
                            </div>
                            <!-----------------------------------modal eliminar--------------------------------------->
                                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--inicio modal--> 
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light text-dark ">
                                                        <h5 class="modal-title text-center" id="exampleModalLabel">Confirmar para eliminar modulo</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <hr>
                                                        ¿Esta seguro de eliminar la nota seleccionada?
                                                        <hr>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                                        <button type="button" class="btn btn-danger" id="btnEliminar" name="btnEliminar"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Eliminar</button>       
                                                    </div>
                                                    <div id="girar" class="lds-dual-ring"></div> 
                                                </div>
                                            </div>
                                    </div><!--finc modal-->                         
                    </div><!--finc container--> 
            </div><!--digeneral-->  
            <script type="text/javascript"> //cargar tabla en el index
                $(document).ready(function(){
                    
                    var notas=$('#tabla-notasDocente').DataTable({
                        processing:true,
                        serverSide:true,
                        ajax:{
                            url:"{{route('notasDocente.index')}}",
                        },
                        columns:[
                            {data:'nombre_mod'},
                            {data:'fechaini'},
                            {data:'fechafin'},
                            {data:'nombre_tlic'},
                            {data:'jornada'},
                            {data:'modalidad'},
                            {data:'nombre_paralelo'},
                            {data:'apellido_est'},
                            {data:'name_est'},
                            {data:'nota_trabajo_equipo'},
                            {data:'nota_estudio_caso'},
                            {data:'nota_prueba_practica'},
                            {data:'nota_prueba_teorica'},
                            {data:'nota_suspenso'},
                            {data:'action',orderable:false}
                        ]

                    });
                   
                });
            </script>
            
            <script>
                $(document).ready(function(){    
                    $('#SelPeriodoAcademico').on('change', function(e){//cargar  cursos
                        //$("#descarhorario").attr('disabled','disabled');
                        $('#SelModulos').empty();
                        $('#SelModulos').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                        var periodoacad = e.target.value;
                        $.get('/notasDocente/selectCursos/'+periodoacad,function(data) {
                                $('#SelCursos').empty();
                                $('#SelCursos').append('<option value="" disabled="true" selected="true">Elija un curso</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelCursos').append('<option value="'+ regenciesObj.id_curlic +'">'+"Licencia tipo "+ regenciesObj.nombre_tlic +" / "+ regenciesObj.jornada+" / "+ regenciesObj.modalidad+" / "+ regenciesObj.duracion_meses+" meses "+" / Paralelo "+ regenciesObj.nombre_paralelo+'</option>');
                                })          
                        });
                        
                    });
                    $('#SelCursos').on('change', function(e){//cargar  modulos
                        //$("#descarhorario").attr('disabled','disabled');
                        var curso = e.target.value;
                        var periodoA = $('#SelPeriodoAcademico').val();
                        $.get('/notasDocente/selectModulos/'+periodoA+"/"+curso,function(data) {
                                $('#SelModulos').empty();
                                $('#SelModulos').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                                $.each(data, function(fetch, regenciesObj){
                                    $('#SelModulos').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod +'</option>');
                                })              
                        });
                        
                    });
                    $('#SelModulos').on('change', function(e){//cargar periodo de horarios
                        var periodoA = $('#SelPeriodoAcademico').val();
                        var cursoL = $('#SelCursos').val();
                        var idModulo = e.target.value;
                        $.ajax({
                                url:'/notasDocente/tablaEstudiantes/'+periodoA+"/"+cursoL+"/"+idModulo,
                                success : function(data){
                                    setTimeout(function(){
                                        $('#tabla-listaEstudiantes').empty().append($(data));
                                    }
                                    );
                                }
                            });
                        }); 
                });
            </script>
            <script>
                  function cargarSelectPeriodos(){//cargar periodos academicos
                            //asignar valores a select periodos
                            $.get('/notasDocente/selectPeriodos',function(data) {
                                    $('#SelPeriodoAcademico').empty();
                                    $('#SelPeriodoAcademico').append('<option value="" disabled="true" selected="true">Elija un período acádemico</option>');
                                    $.each(data, function(fetch, regenciesObj){
                                        $('#SelPeriodoAcademico').append('<option value="'+ regenciesObj.id +'">'+"Desde "+ regenciesObj.fechaini +" Hasta "+ regenciesObj.fechafin+" Licencia tipo "+ regenciesObj.nombre_tipolicencia+'</option>');
                                    })   
                            });     
                            $('#SelModulos').empty();
                            $('#SelModulos').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');    
                            $('#SelCursos').empty();
                            $('#SelCursos').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');           
                    }
            </script>
            <script>//recragar tabla
                function recargarTabla(){//cargar periodos academicos
                    $('#tabla-notasDocente').DataTable().ajax.reload();                    
                }
            </script>
        <script>/////////////////////////eliminar nota------------------------------
            var _id;
            $(document).on('click','.delete',function(){
                _id=$(this).attr('id'); 
                $('#confirmModal').modal('show');
            });
            $('#btnEliminar').click(function(){
                $.ajax({     
                    url:"/notasDocente/eliminar/"+_id,
                    beforeSend:function(){
                        $('#btnEliminar').text('Eliminando..'); 
                        $('#girar').show(); 
                    },
                    success:function(data){
                       if(data)
                       {
                            $('#confirmModal').modal('hide');
                            toastr.success('La nota fue eliminada exitosamente','¡EXITOSO!',{timeOut:2000});
                            $('#tabla-notasDocente').DataTable().ajax.reload();
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                       }
                       else
                       {
                            toastr.error('El período académico a culminado,NADA QUE HACER','¡FALLIDA!',{timeOut:2000});
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                            $('#confirmModal').modal('hide');
                       }
                       
                    },
                    error : function(data){
                        toastr.error('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:2000});
                        $('#btnEliminar').text('Eliminar'); 
                        $('#girar').hide(); 
                        $('#confirmModal').modal('hide');
                    }  
                });
            });
        </script>
    <body>
</html>

