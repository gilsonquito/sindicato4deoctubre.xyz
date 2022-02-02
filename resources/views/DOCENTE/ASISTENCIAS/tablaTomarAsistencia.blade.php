
    <head>
        <!--<link href="{{asset('css/tablaEstudiante.css')}}" rel="stylesheet">-->
        <title>AsistenciasEstudiantes</title>
    </head>
    <body>
        <div id="contenidoAsistencias">
                                <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                                    <a class="navbar-brand text-dark" href="#">Listado de estudiantes</a>
                                </nav>
                                <table id="tabla_tomarAsistencia" class="table table-responsive-lg table-hover table-striped  w-100">
                                        <thead class="font-weight-bold text-center text-dark" >
                                            <td class="col-md-1">#</td>
                                            <td class="col-md-3">Apellidos</td>
                                            <td class="col-md-3">Nombres</td>
                                            <td class="col-md-2">Estado</td>
                                            <td class="col-md-3">Acciones</td>
                                        </thead>
                                        <tbody class="text-center text-dark">         
                                        @php
                                            $i=1;
                                        @endphp  
                                            @foreach ($estudiantes as $estudiante)
                                                <tr>    
                                                   @if($i==1)
                                                        <input type="hidden" id="idfecha_asistencia" name="idfecha_asistencia" value="{{$estudiante->fecha_asistencia}}">
                                                        <input type="hidden" id="idPerAcadListar" name="idPerAcadListar" value="{{$estudiante->id}}">
                                                        <input type="hidden" id="idDocModListar" name="idDocModListar" value="{{$estudiante->id_doc_mod}}">
                                                    @endIf
                                                    <td class="py-2">{{$i}}</td>
                                                    <td class="py-2">{{$estudiante->apellido_est}}</td>
                                                    <td class="py-2">{{$estudiante->name_est}}</td>
                                                    <td class="py-2">{{$estudiante->estado_asistencia}}</td>
                                                    <td class="py-2">
                                                        @if($estudiante->estado_asistencia=="PRESENTE")
                                                            <div class="form-check form-check-inline p-1">
                                                                <input onclick="marcarPresente({{$estudiante->id_asistencia}})" class="form-check-input" type="radio" name="{{$estudiante->id_est}}" id="inlineRadio1" value="option1" checked>
                                                                <label class="form-check-label font-weight-normal text-success" for="{{$estudiante->id_est}}">PRESENTE</label>
                                                            </div>
                                                            <div class="form-check form-check-inline p-1">
                                                                <input onclick="marcarAusente({{$estudiante->id_asistencia}})"class="form-check-input" type="radio" name="{{$estudiante->id_est}}" id="inlineRadio2" value="option2">
                                                                <label class="form-check-label font-weight-bold text-muted" for="{{$estudiante->id_est}}">AUSENTE</label>
                                                            </div>
                                                        @else
                                                        <div class="form-check form-check-inline p-1">
                                                                <input onclick="marcarPresente({{$estudiante->id_asistencia}})" class="form-check-input" type="radio" name="{{$estudiante->id_est}}" id="inlineRadio1" value="option1" >
                                                                <label class="form-check-label font-weight-normal text-success" for="{{$estudiante->id_est}}">PRESENTE</label>
                                                            </div>
                                                            <div class="form-check form-check-inline p-1">
                                                                <input onclick="marcarAusente({{$estudiante->id_asistencia}})"class="form-check-input" type="radio" name="{{$estudiante->id_est}}" id="inlineRadio2" value="option2" checked>
                                                                <label class="form-check-label font-weight-bold text-muted" for="{{$estudiante->id_est}}">AUSENTE</label>
                                                            </div>
                                                        @endif
                                                    </td>  
                                                </tr>
                                                @php
                                                    $i=$i+1; 
                                                @endphp
                                            @endforeach   
                                        </tbody>
                                </table>      
        </div> 
           <script>
                    function marcarPresente(id)
                    {
                      var estadoP="PRESENTE";
                        $.ajax({
                            url:"/estadosAsisntencias/cambiarEstado/"+id+"/"+estadoP,
                            success:function(data){
                                if(data)
                                {
                                    var id_periodo=$('#idPerAcadListar').val();
                                    var fecha_asistencia=$('#idfecha_asistencia').val();
                                    var id_doc_mod=$('#idDocModListar').val();
                                    $.ajax({
                                        url:'/asistenciaEstudiante/tablaAsistenciaEstudiantes/'+id_periodo+"/"+fecha_asistencia+"/"+id_doc_mod,
                                            success : function(data){
                                                setTimeout(function(){
                                                    $('#contenidoAsistencias').empty().append($(data));
                                                }
                                                );
                                            }
                                    });
                                    toastr.success('Cambio exitoso PRESENTE','¡EXITOSO!',{timeOut:1000});
                                }
                                else
                                {
                                    toastr.warning('NO se puede modificar La asistencia una vez terminado el período académico','¡FALLIDA!',{timeOut:3000});
                                }
                            },
                            error : function(response){
                                    toastr.error('Ocurrio un error, vuelva a intentarlo','¡FALLIDA!',{timeOut:2000});
                            }
                        });
                    }
                    function marcarAusente(id)
                    {
                      var estadoA="AUSENTE";
                        $.ajax({
                            url:"/estadosAsisntencias/cambiarEstado/"+id+"/"+estadoA,
                            success:function(data){
                                if(data)
                                {
                                    var id_periodo=$('#idPerAcadListar').val();
                                    var fecha_asistencia=$('#idfecha_asistencia').val();
                                    var id_doc_mod=$('#idDocModListar').val();
                                    $.ajax({
                                        url:'/asistenciaEstudiante/tablaAsistenciaEstudiantes/'+id_periodo+"/"+fecha_asistencia+"/"+id_doc_mod,
                                            success : function(data){
                                                setTimeout(function(){
                                                    $('#contenidoAsistencias').empty().append($(data));
                                                }
                                                );
                                            }
                                    });
                                    toastr.success('Cambio exitoso AUSENTE','¡EXITOSO!',{timeOut:1000});
                                   
                                }
                                else
                                {
                                    toastr.warning('NO se puede modificar La asistencia una vez terminado el período académico','¡FALLIDA!',{timeOut:3000});
                                }
                            },
                            error : function(response){
                                    toastr.error('Ocurrio un error, vuelva a intentarlo','¡FALLIDA!',{timeOut:2000});
                            }
                        });
                    }
            </script>
        <body>
</html>