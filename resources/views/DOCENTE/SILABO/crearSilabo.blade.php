<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="{{asset('css/crearSilabo.css')}}" rel="stylesheet">
        <title>Silabo</title>
    </head>
    <body >
        <div id="todoContenido">
            <div class="py-2">
                <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                        <a class="navbar-brand text-success" href="#">Gestion sílabo - Docente</a>
                </nav>
            </div>
            <div class="p-3 border" >
                <div class="p-0">
                        <h5 class="text-left font-weight-normal text-dark p-0" href="#">Datos silabo</h5>
                        <hr color="" class="border border-success w-100 p-0">
                </div>
                <div class="p-2">
                    <form id="ingreso-silabo" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row  justify-content-center p-2">
                            <div class="col-md-10 px-2  justify-content-center text-left">
                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Escuela de conducción</label>
                                <input readonly="readonly" id="escuela" name="escuela" type="text" class="form-control font-italic" tabindex="1" maxlength="50" required value="ESCUELA DE FORMACIÓN Y CAPACITACIÓN PARA CONDUCTORES PROFESIONALES 4 DE OCTUBRE">    
                            </div>
                        </div>
                        <div class="row justify-content-center p-2">
                            <div class="col-md-6 px-2  justify-content-center text-left">
                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Plan de estudios</label>
                                <input readonly="readonly" id="planEstudio" name="planEstudio" type="text" class="form-control font-italic" tabindex="3" maxlength="100" required value="FORMACIÓN DE CONDUCTOR PROFESIONAL">
                            </div>
                            <div class="col-md-6 px-2  justify-content-center text-left">
                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Período académico</label>
                                <select class="form-control" id="SelPeriodoAcademico" name="SelPeriodoAcademico" tabindex="4" required>
                                    <option selected="true" disabled="disabled" value="">Seleccione un período acádemico</option>
                                    @foreach ($periodosaca as $periodocademico)
                                        <option value="{{$periodocademico->id}}">Desde {{$periodocademico->fechaini}}&nbsp;Hasta {{$periodocademico->fechafin}}&nbsp;/&nbsp;Licencia tipo {{$periodocademico->nombre_tipolicencia}}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                        <div class="row justify-content-center p-2">
                            <div class="col-md-6 px-2  justify-content-center text-left">
                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Curso</label>
                                <select class="form-control" id="SelCursos" name="SelCursos" tabindex="5" required>
                                    <option selected="true" disabled="disabled" value="">Seleccione un curso</option>
                                </select>
                            </div>
                            <div class="col-md-6 px-2  justify-content-center text-left">
                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Módulo / Asignatura</label>
                                <select class="form-control" id="SelModulos" name="SelModulos" tabindex="6" required>
                                    <option selected="true" disabled="disabled" value="">Seleccione módulo</option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center p-2">
                            <div class="col-md-6 px-2  justify-content-center text-left">
                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Docente</label>
                                @foreach ($apellido as $a)
                                    <input readonly="readonly" type="text" class="form-control" tabindex="7" maxlength="50" value="{{$a->apellido_doc}} {{$a->name}}">
                                @endforeach
                            </div>
                            <div class="col-md-6 px-2  justify-content-center text-left">
                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Fecha publicación</label>
                                <input id="fechaPublicacion" name="fechaPublicacion" type="date" class="form-control" tabindex="8"  required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-success" tabindex="9" ><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Generar sílabo</button>
                    </form>
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <h5 class="text-left font-weight-normal text-dark" href="#">Consultar</h5>
                    <hr color="" class="border border-success w-100 p-0">
                    <button onclick="consultarModal()" type="submit" class="btn btn-outline-success  font-weight-bold" tabindex="10" > <i class="fa fa-search mr-2" aria-hidden="true"></i>Consultar</button>
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="text-left"> 
                    <button  title="duplicar silabo" id="duplicarSilabo" type="button" class="btn btn-success" value="" disabled>Duplicar Sílabo</button>
                    <hr color="" class="border border-success w-100 p-0"> 
                </div>
            </div>    
            <br>
            <div class="p-3 border ">
                <div class="justify-content" >
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Datos informativos</h5> 
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
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Prerrequisitos</h5>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderPrerrequisitos()" title="Ocultar Prerrequisitos"><i id="btnClose2" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionPrerrequisitos" class="overflow-scroll">
                    </div>
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content">
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Datos de asignatura</h5>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderDatosAsignatura()" title="Ocultar Datos Asignatura"><i id="btnClose3" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionDatosAsignatura" class="overflow-scroll px-3">
                    </div>
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Unidades</h5>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderUnidades()" title="Ocultar Unidades"><i id="btnClose4" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionUnidades" class="overflow-scroll px-3">
                    </div>
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Ponderación para la evaluación del estudiante por actividades de aprendizaje</h5>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderPonderacion()" title="Ocultar Datos ponderacion paa ecaluación de estudiante"><i id="btnClose5" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
                <hr color="" class="border border-success w-100 p-0">
                <div class="overflow-scroll px-3" id="seccionPonderacion">
                    <table id="tablaSubtemas" class="table table-bordered table-responsive-lg w-100">
                                    <thead class="font-weight-bold text-center " >
                                        <tr>
                                            <td class="col-md-6 align-middle" rowspan="3">Descripción</td>
                                            <td class="col-md-3 align-middle" rowspan="3">Porcentaje Pacial 1</td>
                                        </tr>   
                                    </thead>
                                    <tbody class="text-center text-dark align-middle">         
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="py-1">DOCENCIA (Asistido por el profesor)</td>  
                                            <td class="py-1">5</td>
                                        </tr>
                                        <tr>    
                                        <td class="col-md-12 align-middle"colspan="3">
                                                    <ul>
                                                        <li class="text-left">Pruebas Orales </li>
                                                        <li class="text-left">Pruebas Escritas </li>
                                                        <li class="text-left">Tareas </li>
                                                        <li class="text-left">Foros </li>
                                                    </ul>
                                            </td>  
                                        </tr>
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="py-1">PRACTICAS DE APLICACIÓN Y EXPERIMENTCACIÓN</td>  
                                            <td class="py-1">5</td>
                                        </tr>
                                        <tr>    
                                            <td class="col-md-12 align-middle"colspan="3">
                                                    <ul>
                                                        <li class="text-left">Talleres</li>
                                                        <li class="text-left">Trabajos Grupales</li>
                                                        <li class="text-left">Trbajos individuales</li>
                                                        <li class="text-left">Participación en clase </li>
                                                    </ul>
                                            </td>  
                                        </tr>
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="py-1">ACTIVIDADES DE APRENDIZAJE AUTÓNOMO</td>  
                                            <td class="py-1">5</td>
                                          
                                        </tr>
                                        <tr>    
                                        <td class="col-md-12 align-middle"colspan="3">
                                                    <ul>
                                                        <li class="text-left">Demostración teórica practica </li>
                                                        <li class="text-left">Participación individual</li>
                                                        <li class="text-left">Demostracion de destrezas y competencias</li>
                                                    </ul>
                                            </td>  
                                        </tr>
                                        <tr class="bg-light font-weight-bold text-muted">    
                                            <td class="py-1">APORTE FINAL</td>  
                                            <td class="py-1">5</td>
                                        </tr>
                                        <tr>    
                                        <td class="col-md-12 align-middle"colspan="3">
                                                    <ul>
                                                        <li class="text-left">Examen escrito y/o examen Oral</li>
                                                    </ul>
                                            </td>  
                                        </tr>
                                </tbody>                                 
                            </table>  
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Metodología de enseñanza aprendizaje</h5>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderMetodologias()" title="Ocultar seccion de Metodologias de enseñanza"><i id="btnClose6" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionMetodologiasE" class="overflow-scroll px-3">
                    
                    </div>
                    <br>
                    <div id="seccionRecursosE" class="overflow-scroll px-3">
                    </div>
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Escenarios de aprendizaje</h5>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderEscenariosA()" title="Ocultar seccion de escenarios de aprendizaje"><i id="btnClose7" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionEscenariosAprensizaje" class="overflow-scroll px-3">
                    </div>    
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Bibliografía</h5>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderBibliografias()" title="Ocultar seccion de bibliografia"><i id="btnClose8" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionBibliografia" class="overflow-scroll px-3">
                    </div>    
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Bibliografía Complementaria</h5>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderBibliografiaComplementaria()" title="Ocultar seccion de bibliografaia complementaria"><i id="btnClose9" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionBibliografiaComplementaria" class="overflow-scroll px-3">
                    </div>    
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Webgrafía</h5>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderWebgrafia()" title="Ocultar seccion de webgrafía"><i id="btnClose10" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionWebgrafia" class="overflow-scroll px-3">
                    </div>    
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Bibliografía digital</h5>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderBibliografiaDigital()" title="Ocultar seccion de bibliografía digital"><i id="btnClose11" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionBibliografiaDigital" class="overflow-scroll px-3">
                    </div>    
                </div>
            </div>
            <br>
            <div class="p-3 border">
                <div class="justify-content-end"> 
                    <div class="row align-items-center">
                        <div class="col-md-11">
                            <h5 class="text-left font-weight-normal text-dark" href="#">Estado de sílabo</h5>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-outline-light" onclick="esconderEstadosilabo()" title="Ocultar seccion de estado de silabo"><i id="btnClose12" class="fa fa-chevron-up text-secondary" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr color="" class="border border-success w-100 p-0">
                    <div id="seccionEstadoSilabo" class="overflow-scroll px-3">
                    </div>    
                </div>
            </div>
            <br>
            <div class="p-3 ">
                <div class="text-align-end"> 
                    <button  title="Enviar a revision el silabo" id="enviarRevision" type="button" name="enviarRevision" class="enviarRevision btn btn-success btn-lg" value="" disabled>Enviar a Revisión</button>
                </div>
                <input type="hidden" id="txtHiddenIdSilabo" name="txtHiddenIdSilabo">
            </div>
            <input type="hidden" id="txtEstadoSilabo" name="txtEstadoSilabo">
        <!--------------------------------------------------modal consultar ..........................-->
        <div class="container">
                <div class="modal fade" id="consultar_Silabo_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel21" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header btn-light">                         
                                    <h5 class="modal-title text-muted" id="staticBackdropLabel21"><i class="fa fa-file-text-o mr-2 " aria-hidden="true"></i>Sílabos de docente</h5>
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
            <!--------------------------------------------------modal duplicar ..........................-->
            <div class="container">
                <div class="modal fade" id="duplicar_Silabo_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel22" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header btn-light">                         
                                    <h5 class="modal-title text-muted" id="staticBackdropLabel22"><i class="fa fa-file-text-o mr-2 " aria-hidden="true"></i>Duplicar Sílabo de Docente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="Duplicar_Silabo">
                                    <div class="modal-body">                            
                                        @csrf
                                        <input type="hidden" id="txtIdsilaboDublicar" name="txtIdsilaboDublicar">
                                        <div class="row  justify-content-center p-2">
                                            <div class="col-md-10 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Escuela de conducción</label>
                                                <input readonly="readonly" id="escuelaDuplicar" name="escuelaDuplicar" type="text" class="form-control font-italic" tabindex="1" maxlength="50" required value="ESCUELA DE FORMACIÓN Y CAPACITACIÓN PARA CONDUCTORES PROFESIONALES 4 DE OCTUBRE">    
                                            </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Plan de estudios</label>
                                                <input readonly="readonly" id="planEstudioDuplicar" name="planEstudioDuplicar" type="text" class="form-control font-italic" tabindex="3" maxlength="100" required value="FORMACIÓN DE CONDUCTOR PROFESIONAL">
                                            </div>
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Período académico</label>
                                                <select class="form-control" id="SelPeriodoAcademicoDuplicar" name="SelPeriodoAcademicoDuplicar" tabindex="4" required>
                                                    <option selected="true" disabled="disabled" value="">Seleccione un período acádemico</option>
                                                </select>
                                            </div>  
                                        </div>
                                        <div class="row justify-content-center p-2">
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Curso</label>
                                                <select class="form-control" id="SelCursosDuplicar" name="SelCursosDuplicar" tabindex="5" required>
                                                    <option selected="true" disabled="disabled" value="">Seleccione un curso</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Módulo / Asignatura</label>
                                                <select class="form-control" id="SelModulosDuplicar" name="SelModulosDuplicar" tabindex="6" required>
                                                    <option selected="true" disabled="disabled" value="">Seleccione módulo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center p-2">
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Docente</label>
                                                    <input id="txtDocente" name="txtDocente" readonly="readonly" type="text" class="form-control" tabindex="7" maxlength="50" >
                                            </div>
                                            <div class="col-md-6 px-2  justify-content-center text-left">
                                                <label for="" class="form-label ml-2 font-weight-bold text-muted">Fecha publicación</label>
                                                <input id="fechaPublicacionDuplicar" name="fechaPublicacionDuplicar" type="date" class="form-control" tabindex="8"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban mr-2" aria-hidden="true"></i>Cancelar</button>
                                        <button type="submit" class="btn btn-warning" id="btnDuplicar" name="btnDuplicar"><i class="fa fa-list-ul mr-2" aria-hidden="true"></i>Duplicar sílabo</button>
                                        <div id="girar2" class="lds-dual-ring col-md-12"></div> 
                                    </div>          
                                </form>
                            </div>
                        </div>
                    </div>   <!-----finmodal----->                                                                  
                </div>    
            </div>
            <script>
                $(document).ready(function(){    
                            $('#SelPeriodoAcademico').on('change', function(e){//cargar  cursos
                                //$("#descarhorario").attr('disabled','disabled');
                                $('#SelModulos').empty();
                                $('#SelModulos').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                                var periodoacad = e.target.value;
                                $.get('/silabodocente/selectCursosSilabo/'+periodoacad,function(data) {
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
                                $.get('/silabodocente/selectModulosSilabo/'+periodoA+"/"+curso,function(data) {
                                        $('#SelModulos').empty();
                                        $('#SelModulos').append('<option value="" disabled="true" selected="true">Seleccione un módulo</option>');
                                        $.each(data, function(fetch, regenciesObj){
                                            $('#SelModulos').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod +'</option>');
                                        })              
                                });   
                            });  
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
            <script> //ingresar un nuevo silabo  
                    $('#ingreso-silabo').submit(function(e){
                        e.preventDefault();
                        var id_periodo=$('#SelPeriodoAcademico').val();
                        var id_curlic=$('#SelCursos').val();
                        var id_doc_mod=$('#SelModulos').val();
                        var escuela=$('#escuela').val();
                        var plan_estudio=$('#planEstudio').val();
                        var fecha_creacion=$('#fechaPublicacion').val();
                        var _token=$("input[name=_token]").val(); 
                        //alert()
                                    $.ajax({
                                        url:"{{route('silabodocente.ingresar')}}",
                                        type:"POST",
                                        async: true,
                                        data:{
                                                id_periodo:id_periodo,
                                                id_curlic:id_curlic,
                                                id_doc_mod:id_doc_mod,
                                                escuela:escuela,
                                                plan_estudio:plan_estudio,
                                                fecha_creacion:fecha_creacion,
                                            _token:_token
                                        },
                                        success:function(response)
                                        {   
                                            if(response)
                                            {  
                                                if(response==1)
                                                {                                        
                                                    $('#ingreso-silabo')[0].reset();
                                                    toastr.success('Se ingerso sílabo exitosamente','¡EXITOSO!',{timeOut:3000});
                                                }
                                                if(response==2)
                                                {
                                                    toastr.error('El periodo academico seleccionado a culminado ¡NADA QUE HACER!','¡FALLIDO!',{timeOut:3000});
                                                }  
                                                if(response==3)
                                                {
                                                    toastr.warning('La fecha ingresdada esa fuera del rango del período académico','¡FALLIDO!',{timeOut:3000});
                                                }        
                                            }
                                            else{
                                                toastr.warning('El silabo ya existe, intente eliminar o editar en la opción CONSULTAR ','¡FALLIDA!',{timeOut:3000});
                                            }
                                        },
                                        error : function(response){
                                            toastr.error('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:3000});
                                            
                                        }
                                    });      
                    })  
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
                                            
                                            if(silEst=="APROBADO"||silEst=="REVISION")
                                            {
                                                
                                                
                                                $.ajax({
                                                    url:'/metodos/variableSesion/'+str,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                            }
                                                            );
                                                        }
                                                });   
                                                $.ajax({
                                                    url:'/silabodocente/mostrarDatosInfo/'+str,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionDatosInformativos').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                }); 
                                                $.ajax({
                                                    url:'/datosAsignatura/mostrarDatosAsignatura2/'+str,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionDatosAsignatura').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });    
                                                $.ajax({
                                                    url:'/prerrequisitoss2',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionPrerrequisitos').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                }); 
                                                $.ajax({
                                                    url:'/unidad/mostrarUnidades2/'+str,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionUnidades').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                }); 
                                                $.ajax({
                                                    url:'/metodosprueba2',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionMetodologiasE').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/recursos2',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionRecursosE').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/escenarios2',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionEscenariosAprensizaje').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/bibliografias2',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionBibliografia').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/bibliografiaCs2',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionBibliografiaComplementaria').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/webgrafias2',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionWebgrafia').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/Bdigitales2',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionBibliografiaDigital').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/estadoSilabo2/'+str,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionEstadoSilabo').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $("#duplicarSilabo").prop('disabled', false);//habilitar boton
                                                $("#duplicarSilabo").prop('value', str);//habilitar boton
                                                $('#consultar_Silabo_modal').modal('hide'); 
                                            }
                                            else{
                                                
                                                
                                                $.ajax({
                                                    url:'/metodos/variableSesion/'+str,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                            }
                                                            );
                                                        }
                                                });   
                                                $.ajax({
                                                    url:'/silabodocente/mostrarDatosInfo/'+str,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionDatosInformativos').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });   
                                                $.ajax({
                                                    url:'/prerrequisitoss',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionPrerrequisitos').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                }); 
                                                $.ajax({
                                                    url:'/datosAsignatura/mostrarDatosAsignatura/'+str,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionDatosAsignatura').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });   
                                                $.ajax({
                                                    url:'/unidad/mostrarUnidades/'+str,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionUnidades').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                }); 
                                                
                                                $.ajax({
                                                    url:'/metodosprueba',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionMetodologiasE').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/recursos',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionRecursosE').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/escenarios',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionEscenariosAprensizaje').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/bibliografias',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionBibliografia').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/bibliografiaCs',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionBibliografiaComplementaria').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/webgrafias',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionWebgrafia').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/Bdigitales',
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionBibliografiaDigital').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $.ajax({
                                                    url:'/estadoSilabo/'+str,
                                                        success : function(data){
                                                            setTimeout(function(){
                                                                $('#seccionEstadoSilabo').empty().append($(data));
                                                            }
                                                            );
                                                        }
                                                });
                                                $("#enviarRevision").prop('disabled', false);//habilitar boton
                                                $("#enviarRevision").prop('value', str);//habilitar boton
                                                $("#duplicarSilabo").prop('disabled', false);//habilitar boton
                                                $("#duplicarSilabo").prop('value', str);//habilitar boton
                                                $('#consultar_Silabo_modal').modal('hide'); 
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
                    function esconderPrerrequisitos() {
                        var x = document.getElementById("seccionPrerrequisitos");
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
                    function esconderDatosAsignatura() {
                        var x = document.getElementById("seccionDatosAsignatura");
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
                    function esconderUnidades() {
                        var x = document.getElementById("seccionUnidades");
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
                    function esconderPonderacion() {
                        var x = document.getElementById("seccionPonderacion");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                        if (document.getElementById("btnClose5").className.match(/(?:^|\s)fa fa-chevron-down(?!\S)/) )
                        {
                            $("#btnClose5").removeClass("fa fa-chevron-down");
                            $("#btnClose5").addClass("fa fa-chevron-up");
                        }
                        else{
                            $("#btnClose5").removeClass("fa fa-chevron-up");
                            $("#btnClose5").addClass("fa fa-chevron-down");
                        }
                    }
                    function esconderMetodologias() {
                        var x = document.getElementById("seccionMetodologiasE");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                        if (document.getElementById("btnClose6").className.match(/(?:^|\s)fa fa-chevron-down(?!\S)/) )
                        {
                            $("#btnClose6").removeClass("fa fa-chevron-down");
                            $("#btnClose6").addClass("fa fa-chevron-up");
                        }
                        else{
                            $("#btnClose6").removeClass("fa fa-chevron-up");
                            $("#btnClose6").addClass("fa fa-chevron-down");
                        }
                        var y = document.getElementById("seccionRecursosE");
                        if (y.style.display === "none") {
                            y.style.display = "block";
                        } else {
                            y.style.display = "none";
                        }
                    }
                    function esconderEscenariosA() {
                        var x = document.getElementById("seccionEscenariosAprensizaje");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                        if (document.getElementById("btnClose7").className.match(/(?:^|\s)fa fa-chevron-down(?!\S)/) )
                        {
                            $("#btnClose7").removeClass("fa fa-chevron-down");
                            $("#btnClose7").addClass("fa fa-chevron-up");
                        }
                        else{
                            $("#btnClose7").removeClass("fa fa-chevron-up");
                            $("#btnClose7").addClass("fa fa-chevron-down");
                        }
                    }
                    function esconderBibliografias() {
                        var x = document.getElementById("seccionBibliografia");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                        if (document.getElementById("btnClose8").className.match(/(?:^|\s)fa fa-chevron-down(?!\S)/) )
                        {
                            $("#btnClose8").removeClass("fa fa-chevron-down");
                            $("#btnClose8").addClass("fa fa-chevron-up");
                        }
                        else{
                            $("#btnClose8").removeClass("fa fa-chevron-up");
                            $("#btnClose8").addClass("fa fa-chevron-down");
                        }
                    }
                    function esconderBibliografiaComplementaria() {
                        var x = document.getElementById("seccionBibliografiaComplementaria");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                        if (document.getElementById("btnClose9").className.match(/(?:^|\s)fa fa-chevron-down(?!\S)/) )
                        {
                            $("#btnClose9").removeClass("fa fa-chevron-down");
                            $("#btnClose9").addClass("fa fa-chevron-up");
                        }
                        else{
                            $("#btnClose9").removeClass("fa fa-chevron-up");
                            $("#btnClose9").addClass("fa fa-chevron-down");
                        }
                    }
                    function esconderWebgrafia() {
                        var x = document.getElementById("seccionWebgrafia");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                        if (document.getElementById("btnClose10").className.match(/(?:^|\s)fa fa-chevron-down(?!\S)/) )
                        {
                            $("#btnClose10").removeClass("fa fa-chevron-down");
                            $("#btnClose10").addClass("fa fa-chevron-up");
                        }
                        else{
                            $("#btnClose10").removeClass("fa fa-chevron-up");
                            $("#btnClose10").addClass("fa fa-chevron-down");
                        }
                    }
                    function esconderBibliografiaDigital() {
                        var x = document.getElementById("seccionBibliografiaDigital");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                        if (document.getElementById("btnClose11").className.match(/(?:^|\s)fa fa-chevron-down(?!\S)/) )
                        {
                            $("#btnClose11").removeClass("fa fa-chevron-down");
                            $("#btnClose11").addClass("fa fa-chevron-up");
                        }
                        else{
                            $("#btnClose11").removeClass("fa fa-chevron-up");
                            $("#btnClose11").addClass("fa fa-chevron-down");
                        }
                    }
                    function esconderEstadosilabo() {
                        var x = document.getElementById("seccionEstadoSilabo");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                        if (document.getElementById("btnClose12").className.match(/(?:^|\s)fa fa-chevron-down(?!\S)/) )
                        {
                            $("#btnClose12").removeClass("fa fa-chevron-down");
                            $("#btnClose12").addClass("fa fa-chevron-up");
                        }
                        else{
                            $("#btnClose12").removeClass("fa fa-chevron-up");
                            $("#btnClose12").addClass("fa fa-chevron-down");
                        }
                    }
            </script>
             <script>//concultar duplicar silabo
                 $(document).ready(function(){   
                    $('#SelPeriodoAcademicoDuplicar').on('change', function(e){//cargar  cursos
                                //$("#descarhorario").attr('disabled','disabled');
                                $('#SelModulosDuplicar').empty();
                                $('#SelModulosDuplicar').append('<option value="" disabled="true" selected="true">Elija un módulo</option>');
                                var periodoacad = e.target.value;
                                $('#SelCursosDuplicar').empty();
                                $('#SelCursosDuplicar').append('<option value="" disabled="true" selected="true">Elija un curso</option>');
                                $.get('/silabodocente/selectCursosSilabo/'+periodoacad,function(data) { 
                                        $.each(data, function(fetch, regenciesObj){
                                            $('#SelCursosDuplicar').append('<option value="'+ regenciesObj.id_curlic +'">'+"Licencia tipo "+ regenciesObj.nombre_tlic +" / "+ regenciesObj.jornada+" / "+ regenciesObj.modalidad+" / "+ regenciesObj.duracion_meses+" meses "+" / Paralelo "+ regenciesObj.nombre_paralelo+'</option>');
                                        })          
                                }); 
                            });
                            $('#SelCursosDuplicar').on('change', function(e){//cargar  modulos
                                //$("#descarhorario").attr('disabled','disabled');
                                var curso = e.target.value;
                                var periodoA = $('#SelPeriodoAcademicoDuplicar').val();
                                $('#SelModulosDuplicar').empty();
                                $('#SelModulosDuplicar').append('<option value="" disabled="true" selected="true">Seleccione un módulo</option>');
                                $.get('/silabodocente/selectModulosSilabo/'+periodoA+"/"+curso,function(data) {
                                        $.each(data, function(fetch, regenciesObj){
                                            $('#SelModulosDuplicar').append('<option value="'+ regenciesObj.id_doc_mod +'">'+ regenciesObj.nombre_mod +'</option>');
                                        })              
                                });   
                            });
                    $("#duplicarSilabo").click(function(){
                        var idS=$(this).val();
                        $.get('/silabo/duplicarSilaboDocenteModal/'+idS, function(data)
                        {  
                            //asignar valores a select paralelo licencia
                            $('#SelPeriodoAcademicoDuplicar').empty();
                            $('#SelPeriodoAcademicoDuplicar').append('<option value="" disabled="true" selected="true">Elija un período acádemico</option>');
                            for (var i in data) {
                                if(data[i].id)
                                {        
                                        document.getElementById("SelPeriodoAcademicoDuplicar").innerHTML += "<option value='"+data[i].id+"'>"+"Desde "+data[i].fechaini+" hasta "+data[i].fechafin+" "+data[i].nombre_tipolicencia+"</option>";            
                                }     
                            } 
                            //asignar datos recuperados
                            //$('#SelPeriodoAcademicoDuplicar').val(data[0].id_periodo);
                            $('#escuelaDuplicar').val(data[0].escuela);
                            $('#planEstudioDuplicar').val(data[0].plan_estudio);
                            $('#txtDocente').val(data[1].apellido_doc+" "+data[1].name);
                            $('#fechaPublicacionDuplicar').val(data[0].fecha_creacion);
                            $('#txtIdsilaboDublicar').val(data[0].id_sil);
                            $('#duplicar_Silabo_modal').modal('toggle');
                            $("input[name=_token]").val();
                        });
                    }) 
                });
                   
            </script>
        
             
           
            <script>//
                    $('#enviarRevision').click(function(){
                            var _idCorregir =$(this).val();
                            var estadoSilEnv="REVISION";
                            var _token2=$("input[name=_token]").val();
                           
                            $.ajax({
                                url:"{{route('director.revisarSilabo')}}",
                                type:"POST",
                                data:{
                                    id_sil:_idCorregir, 
                                    estado:estadoSilEnv,
                                    _token:_token2
                                },
                                success:function(response)
                                {
                                    if(response)
                                    {
                                        toastr.success('Se envió A Revisión exitosamente','EXITOSO',{timeOut:1000});
                                        $.ajax({
                                            url:'/silabodocente',
                                                success : function(data){
                                                    setTimeout(function(){
                                                        $('#todoContenido').empty().append($(data));
                                                    }
                                                    );
                                                }
                                        });
                                    }
                                },
                                error:function(response)
                                {
                                
                                    toastr.error('No se envio la correción','ERROR AL ENVIAR',{timeOut:1000});
                               
                                }
                            });
                            
                    });
                   
            </script>
            <script>//duplicar silabo enviar
                $('#Duplicar_Silabo').submit(function(e){
                    e.preventDefault();
                        var id_silDuplicar=$('#txtIdsilaboDublicar').val();
                        var id_periodoD=$('#SelPeriodoAcademicoDuplicar').val();
                        var id_curlicD=$('#SelCursosDuplicar').val();
                        var id_doc_modD=$('#SelModulosDuplicar').val();
                        var escuelaD=$('#escuelaDuplicar').val();
                        var plan_estudioD=$('#planEstudioDuplicar').val();
                        var fecha_creacionD=$('#fechaPublicacionDuplicar').val();
                        
                        var _token2=$("input[name=_token]").val(); 
                        //alert()
                                    $.ajax({
                                        url:"/silaboD",
                                        type:"POST",
                                        async: true,
                                        data:{
                                                id_sil:id_silDuplicar,
                                                id_periodo:id_periodoD,
                                                id_curlic:id_curlicD,
                                                id_doc_mod:id_doc_modD,
                                                escuela:escuelaD,
                                                plan_estudio:plan_estudioD,
                                                fecha_creacion:fecha_creacionD,
                                                _token:_token2
                                        },
                                        success:function(response)
                                        {   
                                            if(response)
                                            {          
                                                                             
                                                $('#duplicar_Silabo_modal').modal('hide');
                                                toastr.success('El sílabo fue duplicado exitosamente','¡EXITOSO!',{timeOut:2000});
                                                      
                                            }
                                            else{
                                                
                                                toastr.warning('El silabo ya existe, cambie el período acádemico, curso o módulo','¡FALLIDA!',{timeOut:2000});
                                            }
                                        },
                                        error : function(response){
                                            $('#duplicar_Silabo_modal').modal('hide');
                                            toastr.error('Ocurrio un error ineperado vuelva a intentarlo,','¡FALLIDA!',{timeOut:2000});
                                            
                                        }
                                    });     
                    })
            </script> 
            
    </body>
</html>
