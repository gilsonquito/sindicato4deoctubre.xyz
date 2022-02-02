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
                                    <textarea readonly="readonly" id="txtDescripcionAsignatura" name="txtDescripcionAsignatura" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="1000" required></textarea>    
                                </div>
                            </div>
                            <div class="row  justify-content-center p-2">
                                <div class="col-md-12 px-2  justify-content-center text-left">
                                    <label for="" class="form-label ml-2 font-weight-bold text-secondary">Competencias que aporta la asignatura</label>
                                    <textarea readonly="readonly" id="txtCompetenciaAsignatura" name="txtCompetenciaAsignatura" class="form-control" aria-label="With textarea"  tabindex="2" maxlength="1000" required></textarea>    
                                </div>
                            </div>
                            <div class="row  justify-content-center p-2">
                                <div class="col-md-12 px-2  justify-content-center text-left">
                                    <label for="" class="form-label ml-2 font-weight-bold text-secondary">Resultado de aprendizaje que aporta la asignatura</label>
                                    <textarea readonly="readonly" id="txtResultadoAsignatura" name="txtResultadoAsignatura" class="form-control" aria-label="With textarea"  tabindex="2" maxlength="1000" required></textarea>    
                                </div>
                            </div>  
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
                                                <textarea readonly="readonly" id="txtDescripcionAsignatura2" name="txtDescripcionAsignatura" class="form-control" aria-label="With textarea"  tabindex="1" maxlength="1000" required >{{$datosAsignatura->descripcion_asignatura}}</textarea>    
                                            </div>
                                        </div>
                                        <div class="row  justify-content-center p-2">
                                            <div class="col-md-12 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Competencias que aporta la asignatura</label>
                                                <textarea readonly="readonly" id="txtCompetenciaAsignatura2" name="txtCompetenciaAsignatura" class="form-control" aria-label="With textarea"  tabindex="2" maxlength="1000" required >{{$datosAsignatura->competencia_asignatura}}</textarea>    
                                            </div>
                                        </div>
                                        <div class="row  justify-content-center p-2">
                                            <div class="col-md-12 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Resultado de aprendizaje que aporta la asignatura</label>
                                                <textarea readonly="readonly" id="txtResultadoAsignatura2" name="txtResultadoAsignatura" class="form-control" aria-label="With textarea"  tabindex="2" maxlength="1000" required >{{$datosAsignatura->resultado_asignatura}}</textarea>    
                                            </div>
                                        </div>
                                      
                                        <div id="girar2" class="lds-dual-ring col-md-12"></div> 
                            </form>  
                        @endforeach   
                @endIf
            @foreach ($silabosDA as $silaboDA)
                    <input type="hidden" id="txtSilaboDA" name="txtSilaboDA" value="{{$silaboDA->id_sil}}">
            @endforeach                                
        </div>
        <body>