    <div class="p-3 border" >
                <div class="p-2">
                    <form id="ingreso_AvanceAcademio" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center p-2">
                            <div class="col-md-6 px-2  justify-content-center text-left">
                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Fecha Clase</label>
                                    <input readonly="readonly" id="fechaClase" name="fechaClase" type="text" class="form-control" tabindex="1" maxlength="20" required value="{{$fechas}}">
                            </div>
                            <div class="col-md-6 px-2  justify-content-center text-left">
                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Hora clase</label>
                                <select class="form-control" id="SelHoraClase" name="SelHoraClase" tabindex="2" required>
                                    <option selected="true" disabled="disabled" value="">Seleccione Hora</option>
                                    @foreach ($horarios as $hora)
                                        <option value="{{$hora->hora_inicio}} - {{$hora->hora_fin}}">{{$hora->hora_inicio}} - {{$hora->hora_fin}}&nbsp;/&nbsp;{{$hora->tipo_dias}}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                        <div class="row justify-content-center p-2">
                            <div class="col-md-6 px-2  justify-content-center text-left">
                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Director / Inspector</label>
                                <select class="form-control" id="SelResponsableAva" name="SelResponsableAva" tabindex="3" required>
                                    @foreach ($directores as $director)
                                        <option value="{{$director->name}}">{{$director->name}}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                        <button type="submit" class="btn btn-outline-success" tabindex="4" title="Ingresar Avance academico"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Crear avance</button>
                    </form>
                    @foreach ($silaboId as $silabo)
                        <input type="hidden" id="txtIdSilAvance" name="txtIdSilAvance" value="{{$silabo->id_sil}}">
                    @endforeach
                </div>
    </div>
    <br>
    <div class="p-2 border ">
                <div class="justify-content" >
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Unidades, Temas y Subtemas</h5> 
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderSubtemas()" title="Ocultar Datos subtemas"><i id="btnClose3" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div> 
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionSubtemas">
                        
                    </div>
                </div>
    </div>
    <br>
    <div class="p-2 border ">
                <div class="justify-content" >
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Detalle Avance Académico</h5> 
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderDetalleAvance()" title="Ocultar Detalle avance academico"><i id="btnClose4" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div> 
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionDetalleAvance">
                    </div>
                </div>
    </div>
<script>//enviar crear avance
                $('#ingreso_AvanceAcademio').submit(function(e){
                    e.preventDefault();
                        var fecha_avance=$('#fechaClase').val();
                        var hora_avance=$('#SelHoraClase').val();
                        var responsable_avance=$('#SelResponsableAva').val();
                        var id_sil=$('#txtIdSilAvance').val();
                        var _token=$("input[name=_token]").val(); 
                                    $.ajax({
                                        url:"/avancesacademico/ingresarAvanceAcedmico",
                                        type:"POST",
                                        async: true,
                                        data:{
                                                fecha_avance:fecha_avance,
                                                hora_avance:hora_avance,
                                                responsable_avance:responsable_avance,
                                                id_sil:id_sil,
                                                _token:_token
                                        },
                                        success:function(response)
                                        {   
                                            if(response)
                                            {                                   
                                                toastr.success('El avance académico fue ingresado exitosamente','¡EXITOSO!',{timeOut:2000});
                                                $.ajax({
                                                    url:'/avancesSubtemas/'+response,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionSubtemas').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/avanceSubtema/visualizarDetalle/'+response,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionDetalleAvance').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                      
                                            }
                                            else{
                                                
                                                toastr.warning('El avance académico yá existe','¡FALLIDA!',{timeOut:2000});
                                            }
                                        },
                                        error : function(response){
                                            
                                            toastr.error('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:2000});
                                            
                                        }
                                    });     
                    })
            </script> 
            <script>
                    function esconderSubtemas() {
                        var x = document.getElementById("seccionSubtemas");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                        if (document.getElementById("btnClose3").className.match(/(?:^|\s)fa fa-chevron-down(?!\S)/) )
                        {
                            $("#btnClose3").removeClass("fa fa-chevron-down");
                            $("#btnClose3").addClass("fa fa-chevron-up");
                        }
                        else{
                            $("#btnClose3").removeClass("fa fa-chevron-up");
                            $("#btnClose3").addClass("fa fa-chevron-down");
                        }
                    }  
                    function esconderDetalleAvance() {
                        var x = document.getElementById("seccionDetalleAvance");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                        if (document.getElementById("btnClose4").className.match(/(?:^|\s)fa fa-chevron-down(?!\S)/) )
                        {
                            $("#btnClose4").removeClass("fa fa-chevron-down");
                            $("#btnClose4").addClass("fa fa-chevron-up");
                        }
                        else{
                            $("#btnClose4").removeClass("fa fa-chevron-up");
                            $("#btnClose4").addClass("fa fa-chevron-down");
                        }
                    }
                    
            </script>