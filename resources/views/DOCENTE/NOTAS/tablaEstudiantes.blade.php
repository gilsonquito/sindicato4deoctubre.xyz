<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/tablaEstudiante.css')}}" rel="stylesheet">
        <title>Estudiantes</title>
    </head>
    <body>
        <div id="contenidoActualizar">
                        <form id="form_tabla">
                                <table id="tabla-horariodocente" class="table table-responsive-lg table-hover w-100">
                                        <thead class="font-weight-bold text-center text-dark" >
                                            <tr>
                                                <td class="align-middle" rowspan="2">#</td>
                                                <td class="align-middle" rowspan="2">Apellidos</td>
                                                <td class="align-middle" rowspan="2">Nombres</td>
                                                <td class="align-middle" colspan="6">Notas</td>
                                                <td class="align-middle" rowspan="2">Nota Final</td>
                                                <td class="align-middle" rowspan="2">Estado</td>
                                                <td class="align-middle" rowspan="2">Calificar</td>
                                            </tr>
                                            <tr>
                                                <td >Trabajo en Equipo</td>
                                                <td >Estudios de Caso</td>
                                                <td >Prueba Práctica</td>
                                                <td >Prueba Teórica</td>
                                                <td >Promedio</td>
                                                <td >Suspenso</td>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center text-dark">         
                                        @php
                                            $i=1; 
                                        @endphp  
                                            @foreach ($estudiantes as $estudiante)
                                                @php
                                                    $sum=0;
                                                    $sum2=0;
                                                @endphp  
                                                <tr>    
                                                   @if($i==1)
                                                        <input type="hidden" id="idCurLic" name="idCurLic" value="{{$estudiante->id_curlic}}">
                                                        <input type="hidden" id="idPerAcad" name="idPerAcad" value="{{$estudiante->id}}">
                                                    @endIf
                                                    <td class="py-2">{{$i}}</td>
                                                    <td class="py-2">{{$estudiante->apellido_est}}</td>
                                                    <td class="py-2">{{$estudiante->name_est}}</td>
                                                    @if($estudiante->nota_trabajo_equipo)
                                                        <td class="py-2">{{$estudiante->nota_trabajo_equipo}}</td>
                                                    @else
                                                        <td class="py-2">--</td>
                                                    @endIf
                                                    @if($estudiante->nota_estudio_caso)
                                                        <td class="py-2">{{$estudiante->nota_estudio_caso}}</td>
                                                    @else
                                                        <td class="py-2">--</td>
                                                    @endIf
                                                    @if($estudiante->nota_prueba_practica)
                                                        <td class="py-2">{{$estudiante->nota_prueba_practica}}</td>
                                                    @else
                                                        <td class="py-2">--</td>
                                                    @endIf
                                                    @if($estudiante->nota_prueba_teorica)
                                                        <td class="py-2">{{$estudiante->nota_prueba_teorica}}</td>
                                                    @else
                                                        <td class="py-2">--</td>
                                                    @endIf
                                                    <td class="py-2">
                                                           @php
                                                              $sum2=($estudiante->nota_trabajo_equipo+$estudiante->nota_estudio_caso+$estudiante->nota_prueba_practica+$estudiante->nota_prueba_teorica)/4;
                                                              $total1=bcdiv($sum2, '1', 2);
                                                           @endphp
                                                           <span class="font-weight-bold text-muted" >{{$total1}}/20</span>
                                                   </td>
                                                    @if(($estudiante->nota_suspenso))
                                                        <td class="py-2">{{$estudiante->nota_suspenso}}</td>
                                                    @else
                                                        <td class="py-2">--</td>
                                                    @endIf
                                                    <td class="py-2">
                                                        @if(($estudiante->nota_suspenso==null))
                                                            @php
                                                               $sum=($estudiante->nota_trabajo_equipo+$estudiante->nota_estudio_caso+$estudiante->nota_prueba_practica+$estudiante->nota_prueba_teorica)/4;
                                                               $total2=bcdiv($sum, '1', 2);
                                                            @endphp
                                                            <span class="font-weight-bold text-dark" >{{$total2}}/20</span>
                                                        @else
                                                            @php
                                                                $sum=((($estudiante->nota_trabajo_equipo+$estudiante->nota_estudio_caso+$estudiante->nota_prueba_practica+$estudiante->nota_prueba_teorica)/4)+($estudiante->nota_suspenso))/(2);
                                                                $total2=bcdiv($sum, '1', 2);
                                                            @endphp
                                                            <span class="font-weight-bold text-dark" >{{$total2}}/20</span>
                                                        @endIf
                                                    </td>
                                                    <td class="py-2">
                                                        @if($sum>=16)
                                                            <span class="text-success">APROBADO</span>
                                                        @else
                                                            <span class="text-danger">REPROBADO</span>
                                                        @endIf
                                                    </td>
                                                    <td class="py-2">
                                                        <a  onclick="subirNota({{$estudiante->id_doc_mod}},{{$estudiante->id_matricula}})" class="btn btn-warning btn-sm " title="Subir Nota"><i class="fa fa-star-half-o" aria-hidden="true"></i> </a>
                                                    </td>  
                                                </tr>
                                                @php
                                                    $i=$i+1;
                                                @endphp
                                            @endforeach   
                                        </tbody>
                                </table>
                        </form>
                                 <!--------------------------------------------------modal editar ..........................-->
                                    <!-- Button trigger modal -->
                                        <!-- Modal -->
                                        <div class="modal fade " id="calificar_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header btn-light">
                                                    <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-star-half-o mr-3" aria-hidden="true"></i>Calificar Estudiante</h5>
                                                    <button onclick="cancelarNota()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="calificar_form">
                                                    <div class="modal-body">
                                                            @csrf
                                                            <input type="hidden" id="idNota" name="idNota">
                                                            <input type="hidden" id="idDocMod" name="idDocMod">
                                                            <input type="hidden" id="idMatr" name="idMatr">
                                                            <div class="row  justify-content-center p-2">
                                                                <div class="col-md-6 px-2 justify-content-center  text-left">
                                                                    <label for="" class="form-label ml-2"><span class="font-weight-bold">Nota:</span> Trabajos en Equipo</label>
                                                                        <input id="notaTrabajosEquipo" name="notaTrabajosEquipo" type="text" class="form-control" tabindex="1" maxlength="2" required>
                                                                </div>
                                                                <div class="col-md-6 px-2 justify-content-center  text-left">
                                                                    <label for="" class="form-label ml-2"><span class="font-weight-bold">Nota:</span>  Estudios de Caso</label>
                                                                        <input id="notaEstudiosCaso" name="notaEstudiosCaso" type="text" class="form-control" tabindex="2" maxlength="2" required>
                                                                </div>
                                                            </div> 
                                                            <div class="row  justify-content-center p-2">
                                                                <div class="col-md-6 px-2 justify-content-center  text-left">
                                                                    <label for="" class="form-label ml-2"><span class="font-weight-bold">Nota:</span>  Prueba Práctica</label>
                                                                        <input id="notaPruebaPractica" name="notaPruebaPractica" type="text" class="form-control" tabindex="3" maxlength="2" required>
                                                                </div>
                                                                <div class="col-md-6 px-2 justify-content-center  text-left">
                                                                    <label for="" class="form-label ml-2"><span class="font-weight-bold">Nota:</span>  Prueba Teórica</label>
                                                                        <input id="notaPruebaTeorica" name="notaPruebaTeorica" type="text" class="form-control" tabindex="4" maxlength="2" required>
                                                                </div>
                                                            </div>
                                                            <div class="row  justify-content-center p-2">
                                                                <div class="col-md-6 px-2 justify-content-center  text-left">
                                                                    <label for="" class="form-label ml-2"><span class="font-weight-bold">Nota:</span>  Suspenso</label>
                                                                        <input id="notaSuspenso" name="notaSuspenso" type="text" class="form-control" tabindex="5" maxlength="2">
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button onclick="cancelarNota()" type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                                        <button type="submit" class="btn btn-success" id="btnActualizar" name="btnActualizar"><i class="fa fa-arrow-up mr-2" aria-hidden="true"></i>Subir nota</button>
                                                        <div id="girar2" class="lds-dual-ring col-md-12"></div> 
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
        </div> 
        <script>
                    $("#notaTrabajosEquipo").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });   
                    $("#notaEstudiosCaso").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });   
                    $("#notaPruebaPractica").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });   
                    $("#notaPruebaTeorica").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });   
                    $("#notaSuspenso").bind('keypress', function(event) {
                        var regex = new RegExp("^[0-9]+$");
                        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                        if (!regex.test(key)) {
                            event.preventDefault();
                            return false;
                        }
                    });   
        </script>
        <script>//CARGAER EN EL FORMULARIO PARA EDITAR
            function subirNota(idDoc,idMat){
                $.get('/notasDocente/mostrarCalificarEstudiante/'+idDoc+"/"+idMat, function(nota)
                {
                    $('#calificar_form')[0].reset();
                    //asignar datos recuperados
                  
                        if(nota[0])
                        { 
                            $('#idNota').val(nota[0].id_nota);
                            $('#notaTrabajosEquipo').val(nota[0].nota_trabajo_equipo);   
                            $('#notaEstudiosCaso').val(nota[0].nota_estudio_caso);   
                            $('#notaPruebaPractica').val(nota[0].nota_prueba_practica);   
                            $('#notaPruebaTeorica').val(nota[0].nota_prueba_teorica);   
                            $('#notaSuspenso').val(nota[0].nota_suspenso);   
                            $('#idCurLic').val(nota[0].id_curlic);
                            $('#idPerAcad').val(nota[0].id_periodo); 
                        }
                        else
                        { 
                            $('#idNota').val("");
                            $('#notaTrabajosEquipo').val("");   
                            $('#notaEstudiosCaso').val("");   
                            $('#notaPruebaPractica').val("");   
                            $('#notaPruebaTeorica').val("");   
                            $('#notaSuspenso').val("");     
                        }
                    $('#idDocMod').val(nota.idDocMod);
                    $('#idMatr').val(nota.idMatricula);
                    $('#calificar_modal').modal('toggle');
                    $("input[name=_token]").val();
                    
                   
                });
            }
        </script>
           <script>//subir o actualizar nota
                $('#calificar_form').submit(function(e){
                    e.preventDefault();
                    var id_nota2,nota_trabajo_equipo2,nota_estudio_caso2,nota_prueba_practica2,nota_prueba_teorica2,nota_suspenso2,id_doc_mod2,id_matricula2;
                    id_nota2=$('#idNota').val();
                    nota_trabajo_equipo2=$('#notaTrabajosEquipo').val();
                    nota_estudio_caso2=$('#notaEstudiosCaso').val();
                    nota_prueba_practica2=$('#notaPruebaPractica').val();
                    nota_prueba_teorica2=$('#notaPruebaTeorica').val();
                    nota_suspenso2=$('#notaSuspenso').val();
                   id_doc_mod2 =$('#idDocMod').val();
                   id_matricula2 =$('#idMatr').val();
                   var _token2=$("input[name=_token]").val(); 
                    if(id_nota2==""||id_nota2==null)
                    {
                        document.getElementById('btnActualizar').disabled=true;
                        $.ajax({
                                    url:"{{route('notasDocente.ingresar')}}",
                                    type:"POST",
                                    async: true,
                                    data:{
                                        nota_trabajo_equipo:nota_trabajo_equipo2,
                                        nota_estudio_caso:nota_estudio_caso2,
                                        nota_prueba_practica:nota_prueba_practica2,
                                        nota_prueba_teorica:nota_prueba_teorica2,
                                        nota_suspenso:nota_suspenso2,
                                        id_doc_mod:id_doc_mod2,
                                        id_matricula:id_matricula2,
                                        _token:_token2
                                    },
                                    beforeSend:function(){
                                        $('#btnActualizar').text('Ingresando..'); 
                                        $('#girar2').show(); 
                                    },
                                    success:function(response)
                                    {   
                                        if(response)
                                        {                                         
                                            $('#calificar_form')[0].reset();
                                            $('#calificar_modal').modal('hide');
                                            $('#btnActualizar').text('Subir nota'); 
                                            $('#girar2').hide(); 
                                            toastr.success('Se subio nota correctamente','¡EXITOSO!',{timeOut:3000});
                                                    var periodoA = $('#idPerAcad').val();
                                                    var cursoL = $('#idCurLic').val();
                                                    $.ajax({
                                                        url:'/notasDocente/tablaEstudiantes/'+periodoA+"/"+cursoL+"/"+id_doc_mod2,
                                                            success : function(data){
                                                                setTimeout(function(){
                                                                    $('#contenidoActualizar').empty().append($(data));
                                                                }
                                                                );
                                                            }
                                                        });
                                                        document.getElementById('btnActualizar').disabled=false;
                                        }
                                        else{
                                            toastr.error('El período académico a culminado,NADA QUE HACER','¡FALLIDA!',{timeOut:2000});
                                            $('#btnActualizar').text('Subir nota'); 
                                            $('#girar2').hide(); 
                                            document.getElementById('btnActualizar').disabled=false;
                                        }
                                    },
                                    error : function(response){
                                        toastr.warning('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                        $('#btnActualizar').text('Subir nota'); 
                                        $('#girar2').hide(); 
                                        document.getElementById('btnActualizar').disabled=false;
                                    }
                                });      
                    }
                    else
                    {
                        
                        $.ajax({
                                    url:"{{route('notasDocente.actualizar')}}",
                                    type:"POST",
                                    data:{
                                        id_nota:id_nota2,
                                        nota_trabajo_equipo:nota_trabajo_equipo2,
                                        nota_estudio_caso:nota_estudio_caso2,
                                        nota_prueba_practica:nota_prueba_practica2,
                                        nota_prueba_teorica:nota_prueba_teorica2,
                                        nota_suspenso:nota_suspenso2,
                                        id_doc_mod:id_doc_mod2,
                                        id_matricula:id_matricula2,
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
                                            $('#calificar_modal').modal('hide');
                                            toastr.success('Se actualizó nota correctamente','ACTUALIZACIÓN EXITOSA',{timeOut:3000});
                                            $('#btnActualizar').text('Subir nota'); 
                                            $('#girar2').hide();  
                                            $('#calificar_form')[0].reset(); 
                                                    var periodoA = $('#idPerAcad').val();
                                                    var cursoL = $('#idCurLic').val();
                                                    $.ajax({
                                                        url:'/notasDocente/tablaEstudiantes/'+periodoA+"/"+cursoL+"/"+id_doc_mod2,
                                                            success : function(data){
                                                                setTimeout(function(){
                                                                    $('#contenidoActualizar').empty().append($(data));
                                                                }
                                                                );
                                                            }
                                                        });
                                        }
                                        else{
                                            toastr.error('El período académico a culminado,NADA QUE HACER','¡FALLIDA!',{timeOut:2000});
                                                $('#btnActualizar').text('Subir nota'); 
                                                $('#girar2').hide(); 
                                        }
                                    },
                                    error : function(response){
                                                toastr.warning('Ocurrio un error intente nuevamente','¡FALLIDA!',{timeOut:3000});
                                                $('#btnActualizar').text('Subir nota'); 
                                                $('#girar2').hide(); 
                                    }
                                });    
                        
                    }
                    
                   
                    
                })
            </script>
             <script>
                  function cancelarNota(){//recragar form
                    $('#calificar_form')[0].reset(); 
                                                 
                }
            </script>
            <script >
               
                        
               
            </script>
        <body>
</html>