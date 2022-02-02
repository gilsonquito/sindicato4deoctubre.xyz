<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="{{asset('css/reporteAvance.css')}}" rel="stylesheet">
        <title>ReporteAvanceAcadémico</title>
    </head>
    <body >
        <div id="todoContenido">
            <div class="py-2">
                <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Reportes de Avances Académicos - Docente</a>
                </nav>
            </div>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <h5 class="text-left font-weight-normal text-dark" href="#">Seleccionar Módulo</h5>
                    <hr color="" class="border border-success w-100 p-0">
                    <button onclick="consultarModal()" type="submit" class="btn btn-outline-success  font-weight-bold" tabindex="10" > <i class="fa fa-search mr-2" aria-hidden="true"></i>Consultar</button>
                </div>
            </div>
            <br>
            <div class="p-3 border ">
                <div class="justify-content" >
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Datos Asignatura</h5> 
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderDatosInformativos()" title="Ocultar Datos Informativos"><i id="btnClose1" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div> 
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionDatosInformativos"  >
                    </div>
                </div>
            </div>
            <br>
            <div class="p-3 border ">
                <div class="justify-content" >
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Filtro de reporte</h5> 
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderFiltrosAvance()" title="Ocultar filtros avance academico"><i id="btnClose2" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div> 
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionFiltrosAvanceAcademico"  >
                        <div id="fechasFiltroAvance"  >
                            <form id="generarPdfAvances_form"> 
                                @csrf                                
                                <div class="row justify-content-center p-2">
                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                        <label for="" class="form-label ml-2 text-nowrap">Desde</label>
                                        <input id="fechaInicioA" name="fechaInicioA" type="date" class="form-control" tabindex="1" required >
                                    </div>
                                    <div class="form-group col-md-6 px-2  justify-content-center text-left">
                                        <label for="" class="form-label ml-2 text-nowrap">Hasta</label>
                                        <input id="fechaFinA" name="fechaFinA" type="date" class="form-control" tabindex="2" required >
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-file-pdf-o mr-2" aria-hidden="true"></i>Generar Reporte</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <input type="hidden" id="txtEstadoSilabo" name="txtEstadoSilabo">
            <input type="hidden" id="txtIdSilaboAvaReporte" name="txtIdSilaboAvaReporte">
        <!--------------------------------------------------modal consultar ..........................-->
        <div class="container">
                <div class="modal fade" id="consultar_Silabo_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel21" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header btn-light">                         
                                    <h5 class="modal-title text-muted" id="staticBackdropLabel21"><i class="fa fa-check-square-o mr-2 " aria-hidden="true"></i>Seleccione Módulo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="consultarSilabo_form">
                                    <div class="modal-body">                            
                                        @csrf
                                        <div class="row justify-content-center p-2">
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-secondary">Período académico</label>
                                                <select class="form-control" id="SelPeriodoAcademicoM" name="SelPeriodoAcademicoM" tabindex="1" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="seccion-silabos">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                        <button type="submit" class="btn btn-warning" id="btnActualizar" name="btnActualizar"><i class="fa fa-list-ul mr-2" aria-hidden="true"></i>Consultar sílabo</button>
                                        <div id="girar2" class="lds-dual-ring col-md-12"></div> 
                                    </div>          
                                </form>
                            </div>
                        </div>
                    </div>   <!-----finmodal----->                                                                  
                </div>    
            </div>
            <!-----finmodal----->                                                                  
                </div>    
            </div>

            <script>
                $(document).ready(function(){    
                            $('#SelPeriodoAcademicoM').on('change', function(e){//cargar  cursos
                                var periodoM = e.target.value;
                                $.ajax({
                                    url:'/silabodocente/tablaSilabos/'+periodoM,
                                        success : function(data){
                                            setTimeout(function(){
                                                $('#seccion-silabos').empty().append($(data));
                                            }
                                            );
                                        }
                                });      
                            });  
                });                         
            </script>
            <script>
                function consultarModal() {
                    $('#consultar_Silabo_modal').modal('toggle');
                    $.get('/silabodocente/selectPeriodosA',function(data) {
                            $('#SelPeriodoAcademicoM').empty();
                            $('#SelPeriodoAcademicoM').append('<option value="" disabled="true" selected="true">Seleccione un periodo académico</option>');
                            $.each(data, function(fetch, regenciesObj){
                                $('#SelPeriodoAcademicoM').append('<option value="'+ regenciesObj.id +'">'+"Desde "+ regenciesObj.fechaini +" Hasta "+ regenciesObj.fechafin+" / Licencia tipo "+ regenciesObj.nombre_tipolicencia+'</option>');
                            })          
                    });
                }   
            </script>
            
            <script>//silabo sleccionado
                        $('#consultarSilabo_form').submit(function(e){
                                e.preventDefault();
                                var arr = $('[name="checks[]"]:checked').map(function(){
                                    return this.value;
                                }).get();
                                var str = arr.join(',');
                                if(str)
                                {   
                                        $.get('/estadoSilabo/mostrarEstadoSilaboBoton/'+str, function(data)
                                        {  
                                            $('#txtEstadoSilabo').val(data[0].estado);
                                            var silEst= $('#txtEstadoSilabo').val();
                                            if(silEst=="APROBADO")
                                            {                                            
                                                
                                                $.ajax({
                                                    url:'/silabodocente/mostrarDatosInfo/'+str,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionDatosInformativos').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                }); 
                                                $('#txtIdSilaboAvaReporte').val(str);
                                                var divFechas = document.getElementById('fechasFiltroAvance');
                                                divFechas.style.display = 'block';
                                                $('#consultar_Silabo_modal').modal('hide'); 
                                            }
                                            else{
                                                toastr.warning('El sílabo aun no ha sido APROBADO,','¡ERROR!',{timeOut:3000});
                                              
                                            }
                                        });     
                                }
                                else{
                                    toastr.warning('Seleccione un sílabo,','¡ERROR!',{timeOut:3000});
                                }
                        }); 
                </script>
                <script>
                    function esconderDatosInformativos() {
                        var x = document.getElementById("seccionDatosInformativos");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                        if (document.getElementById("btnClose1").className.match(/(?:^|\s)fa fa-chevron-down(?!\S)/) )
                        {
                            $("#btnClose1").removeClass("fa fa-chevron-down");
                            $("#btnClose1").addClass("fa fa-chevron-up");
                        }
                        else{
                            $("#btnClose1").removeClass("fa fa-chevron-up");
                            $("#btnClose1").addClass("fa fa-chevron-down");
                        }
                    }
                    function esconderFiltrosAvance() {
                        var x = document.getElementById("seccionFiltrosAvanceAcademico");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                        if (document.getElementById("btnClose2").className.match(/(?:^|\s)fa fa-chevron-down(?!\S)/) )
                        {
                            $("#btnClose2").removeClass("fa fa-chevron-down");
                            $("#btnClose2").addClass("fa fa-chevron-up");
                        }
                        else{
                            $("#btnClose2").removeClass("fa fa-chevron-up");
                            $("#btnClose2").addClass("fa fa-chevron-down");
                        }
                    }  
            </script>
               <script>//generar pdf
                        $('#generarPdfAvances_form').submit(function(e){
                                e.preventDefault();
                                var idSilabos = $('#txtIdSilaboAvaReporte').val();
                                var fechaInicio = $('#fechaInicioA').val();
                                var fechaFin = $('#fechaFinA').val();
                                if(fechaFin<fechaInicio)
                                {   
                                    toastr.warning('Ingrese una fecha final mayor a la fecha de inicio','¡ERROR!',{timeOut:2000});
                                }
                                else{
                                    window.open("/avancesacademico/pdfReporteAvance/"+idSilabos+"/"+fechaInicio+"/"+fechaFin, '_blank'); 
                                }
                        }); 
                </script>
            
    </body>
</html>
