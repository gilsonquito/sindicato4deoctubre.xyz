    <head>
        <title>Datos asignatura</title>
    </head>
    <body>
        <div id="datosAsignatura" > 
                @if($no=="noexiste")
                    <form id="ingreso-datosAsignatura">   
                            <div class="row  justify-content-center p-2">
                                <div class="col-md-12 px-2  justify-content-center text-left">
                                    <label for="" class="form-label ml-2 font-weight-bold text-secondary">Descripción de la asignatura</label>
                                    <!--<input id="escuela" name="escuela" type="text" class="form-control font-italic" tabindex="1" maxlength="50" required value="SINDICATO DE CHOFERES PROFESIONALES 4 DE OCTUBRE-CANTON PENIPE">-->
                                    <textarea id="txtDescripcionAsignatura" name="txtDescripcionAsignatura" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="1000" required></textarea>    
                                </div>
                            </div>
                            <div class="row  justify-content-center p-2">
                                <div class="col-md-12 px-2  justify-content-center text-left">
                                    <label for="" class="form-label ml-2 font-weight-bold text-secondary">Competencias que aporta la asignatura</label>
                                    <textarea id="txtCompetenciaAsignatura" name="txtCompetenciaAsignatura" class="form-control" aria-label="With textarea"  tabindex="2" maxlength="1000" required></textarea>    
                                </div>
                            </div>
                            <div class="row  justify-content-center p-2">
                                <div class="col-md-12 px-2  justify-content-center text-left">
                                    <label for="" class="form-label ml-2 font-weight-bold text-secondary">Resultado de aprendizaje que aporta la asignatura</label>
                                    <textarea id="txtResultadoAsignatura" name="txtResultadoAsignatura" class="form-control" aria-label="With textarea"  tabindex="2" maxlength="1000" required></textarea>    
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-success "><i class="fa fa-plus mr-2" aria-hidden="true"></i>Guardar cambios</button>
                    </form>
                @else     
                        @foreach ($datosAsignaturas as $datosAsignatura)
                            <form id="editar_datosAsignatura">   
                                        <input type="hidden" id="txtIdDA2" name="txtIdDA2" value="{{$datosAsignatura->id_datosasignatura}}">
                                        <input type="hidden" id="txtIdSil2" name="txtIdSil2" value="{{$datosAsignatura->id_sil}}">
                                        <div class="row  justify-content-center p-2">
                                            <div class="col-md-12 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Descripción de la asignatura</label>
                                                <!--<input id="escuela" name="escuela" type="text" class="form-control font-italic" tabindex="1" maxlength="50" required value="SINDICATO DE CHOFERES PROFESIONALES 4 DE OCTUBRE-CANTON PENIPE">-->
                                                <textarea id="txtDescripcionAsignatura2" name="txtDescripcionAsignatura" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="1000" required >{{$datosAsignatura->descripcion_asignatura}}</textarea>    
                                            </div>
                                        </div>
                                        <div class="row  justify-content-center p-2">
                                            <div class="col-md-12 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Competencias que aporta la asignatura</label>
                                                <textarea id="txtCompetenciaAsignatura2" name="txtCompetenciaAsignatura" class="form-control" aria-label="With textarea"  tabindex="2" maxlength="1000" required >{{$datosAsignatura->competencia_asignatura}}</textarea>    
                                            </div>
                                        </div>
                                        <div class="row  justify-content-center p-2">
                                            <div class="col-md-12 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Resultado de aprendizaje que aporta la asignatura</label>
                                                <textarea id="txtResultadoAsignatura2" name="txtResultadoAsignatura" class="form-control" aria-label="With textarea"  tabindex="2" maxlength="1000" required >{{$datosAsignatura->resultado_asignatura}}</textarea>    
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-success" id="btnActualizar" name="btnActualizar"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Guardar cambios</button>
                                        <div id="girar2" class="lds-dual-ring col-md-12"></div> 
                            </form>  
                        @endforeach   
                @endIf
            @foreach ($silabosDA as $silaboDA)
                    <input type="hidden" id="txtSilaboDA" name="txtSilaboDA" value="{{$silaboDA->id_sil}}">
            @endforeach                                
        </div>
        <script> //ingresar un nuevo prerrequisito
            $('#ingreso-datosAsignatura').submit(function(e){ 
            e.preventDefault();
                var descripcionAsignatura=$('#txtDescripcionAsignatura').val();
                var competenciaAsignatura=$('#txtCompetenciaAsignatura').val();
                var resultadoAsignatura=$('#txtResultadoAsignatura').val();
                var id_silDA=$('#txtSilaboDA').val();
                var _token=$("input[name=_token]").val();
                        $.ajax({
                                url:"{{route('datosAsignatura.ingresarDatosAsignatura')}}",
                                type:"POST",
                                async: true,
                                data:{
                                    descripcionAsignatura:descripcionAsignatura,
                                    competenciaAsignatura:competenciaAsignatura,
                                    resultadoAsignatura:resultadoAsignatura,
                                    id_silDA:id_silDA,
                                    _token:_token
                                },
                                success:function(response)
                                {   
                                    if(response)
                                    {
                                        $.ajax({
                                            url:'/datosAsignatura/mostrarDatosAsignatura/'+id_silDA,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#datosAsignatura').empty().append($(data));
                                                    }
                                                    );
                                                }
                                        });  
                                        toastr.success('El registro fue exitoso','¡EXITOSO!',{timeOut:1000});
                                    }
                                },
                                error : function(response){
                                    toastr.error('No se realizo el registro','Error',{timeOut:1000});
                                }
                            });
            })
        </script> 
        <!--//actualizar datos-->
        <script>
                    $('#editar_datosAsignatura').submit(function(e){
                    e.preventDefault();
                    var descripcionAsignatura2=$('#txtDescripcionAsignatura2').val();
                    var competenciaAsignatura2=$('#txtCompetenciaAsignatura2').val();
                    var resultadoAsignatura2=$('#txtResultadoAsignatura2').val();        
                    var id_DA2=$('#txtIdDA2').val();
                    var id_Sil2=$('#txtIdSil2').val();
                   
                    var _token2=$("input[name=_token]").val();
                            $.ajax({
                                url:"{{route('datosAsignatura.actualizarDatosAsignatura')}}",
                                type:"POST",
                                data:{
                                    descripcionAsignatura:descripcionAsignatura2, 
                                    competenciaAsignatura:competenciaAsignatura2,
                                    resultadoAsignatura:resultadoAsignatura2, 
                                    id_DA:id_DA2,
                                    id_Sil:id_Sil2,
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
                                        $.ajax({
                                            url:'/datosAsignatura/mostrarDatosAsignatura/'+id_Sil2,
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#datosAsignatura').empty().append($(data));
                                                    }
                                                    );
                                                }
                                        });  
                                        toastr.success('Se actualizaron correctamente los datos','ACTUALIZACIÓN EXITOSA',{timeOut:1000});
                                        $('#btnActualizar').text('Guardar cambios'); 
                                        $('#girar2').hide(); 
                                    }
                                },
                                error:function(response)
                                {
                                    toastr.error('No se actualizaron correctamente los datos','ERROR AL ACTUALIZAR',{timeOut:1000});
                                        $('#btnActualizar').text('Guardar cambios'); 
                                        $('#girar2').hide(); 
                                }
                            });
                    })
            </script>
        <body>