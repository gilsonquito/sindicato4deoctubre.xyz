<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/docente.css')}}" rel="stylesheet">
        <title>Cursos</title>
    </head>
    <body>
            <div class="container-fluid p-2"><!--digeneral-->    
                    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Docentes</a>
                    </nav>
                    <div class="container-fuid">
                                <ul class="nav nav-tabs py-1" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class=" nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-list text-success mr-2" aria-hidden="true"></i>Lista de docentes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class=" nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-plus text-success mr-2" aria-hidden="true"></i>Nuevo docente</a>
                                    </li>
                                </ul>
                            <div class="p-5 tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <!--<h3 class="py-3">Periodos Académicos</h3>-->
                                    <table id="tabla-docentes" class="table table-striped table-responsive w-100 table-hover py-0">
                                        <thead  class="font-weight-bold text-dark ">
                                            <td class="col-md-2">Id</td>
                                            <td class="col-md-3">Apellido</td>
                                            <td class="col-md-3">Nombre</td>
                                            <td class="col-md-3">Cédula</td>
                                            <td class="col-md-4">Lugar de nacimiento</td>
                                            <td class="col-md-3">Fecha de nacimiento</td>
                                            <td class="col-md-4">Dirección</td>
                                            <td class="col-md-3">Celular</td>
                                            <td class="col-md-4">Email</td>
                                            <td class="col-md-3">Etnia</td>
                                            <td class="col-md-3">Sexo</td>
                                            <td class="col-md-4">Instrucción</td>
                                            <!--<td scope="col">Imagen</td>-->
                                            <td class="col-md-3">Acciones</td>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                   <!-- <h3 class="py-3" >Nuevo docente</h3-->
                                      <form id="ingreso-docente"   enctype="multipart/form-data">
                                  <!--{!! Form::open([ 'url'=> 'docentes', 'method'=>'POST', 'id'=> 'ingreso-docente', 'files'=>'true'] ) !!}-->
                                            @csrf  
                                                        <div class="row  justify-content-center p-2">
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                            <label for="" class="form-label ml-2 ">Cédula</label>
                                                            <input id="cedula" name="cedula" type="text" class="form-control" tabindex="1" maxlength="10" title="cedula" required>    
                                                            </div>
                                                            <div class="col-md-6 px-2 justify-content-center  text-left">
                                                            <label for="" class="form-label ml-2">Nombre</label>
                                                            <input id="name" name="name" type="text" class="form-control" tabindex="2" title="nombre"  maxlength="50" required>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center p-2">
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                            <label for="" class="form-label ml-2 ">Apellido</label>
                                                            <input id="apellido" name="apellido" type="text" class="form-control" tabindex="3" title="apellido"  maxlength="80" required>
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                            <label for="" class="form-label ml-2 ">Lugar de nacimiento</label>
                                                            <input id="lugarNacimiento" name="lugarNacimiento" type="text" class="form-control" tabindex="4" maxlength="100" title="Lugar de nacimiento" required>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center p-2">
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Fecha de nacimiento</label>
                                                                <input id="fechaNacimiento" name="fechaNacimiento" type="date" class="form-control" tabindex="5" title="Fecha de nacimiento" required max="2004-01-01" >
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Dirección</label>
                                                                <input id="direccion" name="direccion" type="text" class="form-control" tabindex="6" maxlength="80" title="Direccion"  required>
                                                            </div>  
                                                        </div>
                                                        <div class="row justify-content-center p-2">
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Celular</label>
                                                                <input id="celular" name="celular" type="text" class="form-control" tabindex="7" maxlength="15" title="Celular" required>
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                            <label for="" class="form-label ml-2 ">Correo electrónico</label>
                                                            <input id="email" name="email" type="email" class="form-control text-lowercase" tabindex="8" maxlength="80" title="Email" required>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center p-2">
                                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                <label for="select">Etnia</label>
                                                                <select class="form-control" id="selEtnia" name="selEtnia" tabindex="9" title="etnia" required>
                                                                    <option value="Afroecuatoriano">Afroecuatoriano</option>
                                                                    <option value="Blanco">Blanco</option>
                                                                    <option value="Indígena">Indígena</option>
                                                                    <option value="Mestizo">Mestizo</option>
                                                                    <option value="Montubio">Montubio</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                    <label for="" class="form-label ml-2 ">Sexo</label>
                                                                    <div class="col-md-6 mb-3">
                                                                            <div class="custom-control custom-radio ">
                                                                                <input type="radio" id="rdGeneroMasculino" name="rdGenero" value="Masculino" tabindex="10" title="opcion masculino" checked>
                                                                                <label class="Masculino" >Masculino</label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="rdGeneroFemenino" name="rdGenero" value="Femenino" title="opcion femenino" tabindex="11" >
                                                                                <label class="Masculino" >Femenino</label>
                                                                            </div>
                                                                    </div>
                                                            </div>  
                                                        </div>
                                                        <div class="row justify-content-center p-2">
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Instrucción</label>
                                                                <input id="instruccion" name="instruccion" type="text" class="form-control" tabindex="12" maxlength="80" title="Instrucción" required>
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Contraseña</label>
                                                                <input id="password" name="password" type="password" class="form-control" tabindex="14" maxlength="100" title="Contraseña" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="rol" name="rol" value="3">
                                                        <button type="submit" class="btn btn-success btn-lg" tile="Crear docente"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Crear docente</button>
                                    </form>
                                    <!--{!! Form::close() !!}-->
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
                                                        ¿Esta seguro de eliminar el docente seleccionado?
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
                                        <div class="modal fade " id="docente_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header btn-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar Docente</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="docente_edit_form">
                                                <div class="modal-body">
                                                            @csrf
                                                                <input type="hidden" id="txtId2" name="txtId2">
                                                        <div class="row  justify-content-center p-2">
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Cédula</label>
                                                                <input id="cedula2" name="cedula2" type="text" class="form-control" tabindex="1" maxlength="10" required>    
                                                            </div>
                                                            <div class="col-md-6 px-2 justify-content-center  text-left">
                                                                <label for="" class="form-label ml-2">Nombre</label>
                                                                <input id="name2" name="name2" type="text" class="form-control" tabindex="2" maxlength="50" required>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center p-2">
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Apellido</label>
                                                                <input id="apellido2" name="apellido2" type="text" class="form-control" tabindex="3" maxlength="80" required>
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Lugar de nacimiento</label>
                                                                <input id="lugarNacimiento2" name="lugarNacimiento2" type="text" class="form-control" tabindex="4" maxlength="100" required>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center p-2">
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Fecha de nacimiento</label>
                                                                <input id="fechaNacimiento2" name="fechaNacimiento2" type="date" class="form-control" tabindex="5" max="2004-01-01" required>
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Dirección</label>
                                                                <input id="direccion2" name="direccion2" type="text" class="form-control" tabindex="6" maxlength="80" required>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center p-2">
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Celular</label>
                                                                <input id="celular2" name="celular2" type="text" class="form-control" tabindex="7" maxlength="15"required>
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                            <label for="" class="form-label ml-2 ">Correo</label>
                                                            <input id="email2" name="email2" type="email" class="form-control text-lowercase" tabindex="8" maxlength="80" required>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center p-2">
                                                            <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                                                <label for="select">Etnia</label>
                                                                <select class="form-control" id="selEtnia2" name="selEtnia2" tabindex="9" required>
                                                                    <option value="Afroecuatoriano">Afroecuatoriano</option>
                                                                    <option value="Blanco">Blanco</option>
                                                                    <option value="Indígena">Indígena</option>
                                                                    <option value="Mestizo">Mestizo</option>
                                                                    <option value="Montubio">Montubio</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                    <label for="" class="form-label ml-2 ">Sexo</label>
                                                                    <div class="col-md-6 mb-3">
                                                                            <div class="custom-control custom-radio ">
                                                                                <input type="radio" id="rdGeneroMasculino2" name="rdGenero2" value="Masculino" tabindex="10" checked>
                                                                                <label class="Masculino" >Masculino</label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="rdGeneroFemenino2" name="rdGenero2" value="Femenino" tabindex="11" >
                                                                                <label class="Masculino" >Femenino</label>
                                                                            </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center p-2">
                                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                                <label for="" class="form-label ml-2 ">Instrucción</label>
                                                                <input id="instruccion2" name="instruccion2" type="text" class="form-control" tabindex="12" maxlength="100" required>
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
                    
                    var docentes=$('#tabla-docentes').DataTable({
                        columnDefs: [
                                { className: "align-middle" , targets: "_all" }
                            ],
                        processing:true,
                        serverSide:true,
                        order: [[1, "asc"], [2, "asc"], [3, "asc"]],
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
                            url:"{{route('docentes.index')}}",
                        },
                        columns:[
                            {data:'id_doc'},
                            {data:'apellido_doc'},
                            {data:'name'},
                            {data:'cedula_doc'},
                            {data:'lugarnacimiento_doc'},
                            {data:'fechanacimiento_doc'},
                            {data:'direccion_doc'},
                            {data:'celular_doc'},
                            {data:'email'},
                            {data:'etnia_doc'},
                            {data:'sexo_doc'},
                            {data:'instruccion_doc'},
                            //{data:'imagen_doc'},
                            {data:'action',orderable:false}
                        ]

                    });
                   
                });
            </script>
           <script>
                    $("#cedula").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    $("#cedula2").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                   
                    $("#celular").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                    
                    $("#celular2").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });
                
            </script>
            
         
            <script> //ingresar un nuevo curso
              
               $('#ingreso-docente').submit(function(e){
                 
                   e.preventDefault();
                    var cedula_doc=$('#cedula').val();
                    var name=$('#name').val();
                    var apellido_doc =$('#apellido').val();
                    var lugarnacimiento_doc=$('#lugarNacimiento').val();
                    var fechanacimiento_doc=$('#fechaNacimiento').val();
                    var direccion_doc=$('#direccion').val();
                    var celular_doc =$('#celular').val();
                    var email=$('#email').val();
                    var etnia_doc=$('#selEtnia').val();
                    var sexo_doc=$("input[name='rdGenero']:checked").val();
                    var instruccion_doc=$('#instruccion').val();
                    var password=$('#password').val();
                    var rol="3";
                    var _token=$("input[name=_token]").val(); 
                   
                   //alert(cedula_doc+" "+name+" "+apellido_doc+" "+lugarnacimiento_doc+" "+fechanacimiento_doc+" "+direccion_doc+" "+celular_doc+" "+email+" "+etnia_doc+" "+sexo_doc+" "+instruccion_doc+" "+imagen+" "+password+" "+rol)
                                $.ajax({
                                    url:"{{route('docentes.ingresar')}}",
                                    type:"POST",
                                    async: true,
                                    data:{
                                        cedula_doc:cedula_doc,
                                        name:name,
                                        apellido_doc:apellido_doc,
                                        lugarnacimiento_doc:lugarnacimiento_doc,
                                        fechanacimiento_doc:fechanacimiento_doc,
                                        direccion_doc:direccion_doc,
                                        celular_doc:celular_doc,
                                        email:email,
                                        etnia_doc:etnia_doc,
                                        sexo_doc:sexo_doc,
                                        instruccion_doc:instruccion_doc,
                                        password:password,
                                        rol:rol,
                                        _token:_token
                                    },
                                    success:function(response)
                                    {   
                                        if(response)
                                        {                                         
                                            $('#ingreso-docente')[0].reset();
                                           toastr.success('El ingreso fue exitoso','¡EXITOSO!',{timeOut:3000});
                                           $('#tabla-docentes').DataTable().ajax.reload();
                                          
                                        }
                                        else{
                                            toastr.danger('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                        }
                                    },
                                    
                                    error : function(response){
                                        toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                        toastr.warning('Verifique el correo, puede ser que ya exista usuario,','¡FALLIDA!',{timeOut:5000});
                                    }
                                });      
                })
                
        </script>
        <script>/////////////////////////eliminar un docente------------------------------
            var _id;
            $(document).on('click','.delete',function(){
                _id=$(this).attr('id'); 
                $('#confirmModal').modal('show');
            });
            $('#btnEliminar').click(function(){
                
                $.ajax({
                   
                    url:"/docentes/eliminar/"+_id,
                    beforeSend:function(){
                        $('#btnEliminar').text('Eliminando..'); 
                        $('#girar').show(); 
                    },
                    success:function(data){
                      
                            console.log(data);
                            $('#confirmModal').modal('hide');
                            toastr.success('El docente fue eliminado exitosamente','¡EXITOSO!',{timeOut:3000});
                            $('#tabla-docentes').DataTable().ajax.reload();
                            $('#btnEliminar').text('Eliminar'); 
                            $('#girar').hide(); 
                   
                    },
                    error : function(data){
                        console.log(data);
                                        toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                        toastr.warning('No se puede eliminar un docente que tenga asignado un modulo  o un horario','¡FALLIDA!',{timeOut:5000});
                                        $('#btnEliminar').text('Eliminar'); 
                                        $('#girar').hide(); 
                                    }
                    
                });
            });

        </script>
           <script>//CARGAER EN EL FORMULARIO PARA EDITAR
            function editarDocente(id){
                $.get('/docentes/editar/'+id, function(docente)
                {
                    //asignar datos recuperados
                    $('#txtId2').val(docente[0].id_doc);
                    $('#cedula2').val(docente[0].cedula_doc);
                    $('#name2').val(docente[0].name);
                    $('#apellido2').val(docente[0].apellido_doc);
                    $('#lugarNacimiento2').val(docente[0].lugarnacimiento_doc);
                    $('#fechaNacimiento2').val(docente[0].fechanacimiento_doc);
                    $('#direccion2').val(docente[0].direccion_doc);
                    $('#celular2').val(docente[0].celular_doc);
                    $('#email2').val(docente[0].email);
                    $('#selEtnia2').val(docente[0].etnia_doc);
                    if(docente[0].sexo_doc=="Masculino")
                    {
                        $('input[name=rdGenero2][value="Masculino"]').prop('checked',true);
                    }
                    if(docente[0].sexo_doc=="Femenino")
                    {
                        $('input[name=rdGenero2][value="Femenino"]').prop('checked',true);
                    }
                    $('#instruccion2').val(docente[0].instruccion_doc);    
                    $('#docente_edit_modal').modal('toggle');
                    $("input[name=_token]").val();


                });

            }
        </script>
        <script>//actualizar cambios realizados
                
                $('#docente_edit_form').submit(function(e){

                    e.preventDefault();
                    var id_doc2=$('#txtId2').val();
                    var cedula_doc2=$('#cedula2').val();
                    var name2=$('#name2').val();
                    var apellido_doc2 =$('#apellido2').val();
                    var lugarnacimiento_doc2=$('#lugarNacimiento2').val();
                    var fechanacimiento_doc2=$('#fechaNacimiento2').val();
                    var direccion_doc2=$('#direccion2').val();
                    var celular_doc2 =$('#celular2').val();
                    var email2=$('#email2').val();
                    var etnia_doc2=$('#selEtnia2').val();
                    var sexo_doc2=$("input[name='rdGenero2']:checked").val();
                    var instruccion_doc2=$('#instruccion2').val();
                    var email1=$('#email').val();
                    var _token2=$("input[name=_token]").val(); 
                    
                    $.ajax({
                                url:"{{route('docentes.actualizar')}}",
                                type:"POST",
                                data:{
                                        id_doc:id_doc2, 
                                        cedula_doc:cedula_doc2,
                                        name:name2,
                                        apellido_doc:apellido_doc2,
                                        lugarnacimiento_doc:lugarnacimiento_doc2,
                                        fechanacimiento_doc:fechanacimiento_doc2,
                                        direccion_doc:direccion_doc2,
                                        celular_doc:celular_doc2,
                                        email:email2,
                                        etnia_doc:etnia_doc2,
                                        sexo_doc:sexo_doc2,
                                        instruccion_doc:instruccion_doc2,

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
                                        $('#docente_edit_modal').modal('hide');
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                        $('#tabla-docentes').DataTable().ajax.reload();
                                        $('#btnActualizar').text('Guardar cambios'); 
                                        $('#girar2').hide(); 
                                    }
                                },
                                error : function(response){
                                            toastr.warning('Ocurrio un error intente nuevamente','¡FALLIDA!',{timeOut:3000});
                                            toastr.warning('Verifique el correo, puede ser que ya exista usuario,','¡FALLIDA!',{timeOut:5000});
                                }
                            });
                    
                })
            </script>
 
    <body>
</html>

