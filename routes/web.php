<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModeradorController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\SilaboController;
use App\Http\Controllers\PeriodoAcademicoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\DocenteModuloController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\DocenteModuloHorarioController;
use App\Http\Controllers\TipoLicenciaController;
use App\Http\Controllers\ParaleloController;
use App\Http\Controllers\PeriodoHorarioController;
use App\Http\Controllers\AvanceAcademicoController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\DireccionInspectorController;
use App\Http\Controllers\DirecionDirectorController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\PrerrequisitoController;
use App\Http\Controllers\DatosAsignaturaController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\SubtemaController;
use App\Http\Controllers\EvaluacionUnidadController;
use App\Http\Controllers\TecnicaInstrumentoController;
use App\Http\Controllers\ResultadoUnidadController;
use App\Http\Controllers\MetodosEnseñanzaController;
use App\Http\Controllers\RecursosEnseñanzaController;
use App\Http\Controllers\EscenariosAprendizajeController;
use App\Http\Controllers\BibliografiaController;
use App\Http\Controllers\BibliografiaComplementariaController;
use App\Http\Controllers\WebgrafiaController;
use App\Http\Controllers\BibliografiaDigitalController;
use App\Http\Controllers\AvanceAcademicoSubtemasController;
use App\Http\Controllers\DetalleAvanceController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\LoginSecurityController;
use App\Http\Middleware\LoginSecurityMiddleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/periodo', function () {
    return view('periodoAcademico/indexPA');
});
Auth::routes();
//rutas admin
            Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth', '2fa']);
            Route::post('/usuario',[UserController::class,'ingresar'])->name('usuario.ingresar')->middleware(['auth', '2fa']);
            Route::resource('/moders', ModeradorController::class)->middleware(['auth', '2fa']);
            Route::resource('DIRECTOR/director', DirecionDirectorController::class)->middleware(['auth', '2fa']);
            Route::resource('/INSPECTOR/inspector', DireccionInspectorController::class)->middleware(['auth', '2fa']);
            Route::resource('/estudiante', UserController::class)->middleware(['auth', '2fa']);
            Route::resource('/SECRETARIA/secretaria', SecretariaController::class)->middleware(['auth', '2fa']);
       //periodo academico
            Route::get('periodoAcademico',[PeriodoAcademicoController::class,'index'])->name('periodoAcademico.index')->middleware(['auth', '2fa']);
            Route::post('periodoAcademico',[PeriodoAcademicoController::class,'ingresar'])->name('periodoAcademico.ingresar')->middleware(['auth', '2fa']);
            Route::get('periodoAcademico/eliminar/{id}',[PeriodoAcademicoController::class,'eliminar'])->name('periodoAcademico.eliminar')->middleware(['auth', '2fa']);
            Route::get('periodoAcademico/editar/{id}',[PeriodoAcademicoController::class,'editar'])->name('periodoAcademico.editar')->middleware(['auth', '2fa']);
            Route::post('periodoAcademico/actualizar',[PeriodoAcademicoController::class,'actualizar'])->name('periodoAcademico.actualizar')->middleware(['auth', '2fa']);
            Route::get('periodoAcademico/cargarlicencia',[PeriodoAcademicoController::class,'cargarlicencia'])->name('periodoAcademico.cargarlicencia')->middleware(['auth', '2fa']);
        //rutas para ingresar cursos
            Route::get('/cursos',[CursoController::class,'indexVista'])->name('cursos.indexVista')->middleware(['auth', '2fa'])->middleware(['auth', '2fa']);
            Route::get('cursolicencia',[CursoController::class,'index'])->name('cursolicencia.index')->middleware(['auth', '2fa'])->middleware(['auth', '2fa']);
            Route::post('cursolicencia',[CursoController::class,'ingresar'])->name('cursolicencia.ingresar')->middleware(['auth', '2fa']);
            Route::get('cursolicencia/eliminar/{id}',[CursoController::class,'eliminar'])->name('cursolicencia.eliminar')->middleware(['auth', '2fa']);
            Route::get('cursolicencia/editar/{id}',[CursoController::class,'editar'])->name('cursolicencia.editar')->middleware(['auth', '2fa']);
            Route::post('cursolicencia/actualizar',[CursoController::class,'actualizar'])->name('cursolicencia.actualizar')->middleware(['auth', '2fa']);
            Route::get('cursolicencia/cargarSelect',[CursoController::class,'cargarSelect'])->name('cursolicencia.cargarlicencia')->middleware(['auth', '2fa']);
            /*Route::get('/cursos', function () {
                return view('CURSOS/indexCurso');
            })->middleware(['auth', '2fa']);*/
            
        ///rutas para docentes
            /*Route::get('/docente', function () {
                return view('DOCENTE/indexDocente');
            })->middleware(['auth', '2fa']);*/
            Route::get('/docente',[DocenteController::class,'indexVista'])->name('docente.indexVista')->middleware(['auth', '2fa']);
            Route::get('docentes',[DocenteController::class,'index'])->name('docentes.index')->middleware(['auth', '2fa']);
            Route::post('docentes',[DocenteController::class,'ingresar'])->name('docentes.ingresar')->middleware(['auth', '2fa']);
            Route::get('docentes/eliminar/{id}',[DocenteController::class,'eliminar'])->name('docentes.eliminar')->middleware(['auth', '2fa']);
            Route::get('docentes/editar/{id}',[DocenteController::class,'editar'])->name('docentes.editar')->middleware(['auth', '2fa']);
            Route::post('docentes/actualizar',[DocenteController::class,'actualizar'])->name('docentes.actualizar')->middleware(['auth', '2fa']);
        //rutas modulos
            /*Route::get('/modulo', function () {
                return view('MODULO/indexModulo');
            });*/
            Route::get('/modulo',[ModuloController::class,'indexVistaM'])->name('modulo.indexVistaM')->middleware(['auth', '2fa']);
            Route::get('modulos',[ModuloController::class,'index'])->name('modulos.index')->middleware(['auth', '2fa']);
            Route::post('modulos',[ModuloController::class,'ingresar'])->name('modulos.ingresar')->middleware(['auth', '2fa']);
            Route::get('modulos/eliminar/{id}',[ModuloController::class,'eliminar'])->name('modulos.eliminar')->middleware(['auth', '2fa']);
            Route::get('modulos/editar/{id}',[ModuloController::class,'editar'])->name('modulos.editar')->middleware(['auth', '2fa']);
            Route::post('modulos/actualizar',[ModuloController::class,'actualizar'])->name('modulos.actualizar')->middleware(['auth', '2fa']);
        //rutas docente/modulos
            /*Route::get('/docente_modulo', function () {
                return view('DOCENTEMODULO/indexDocenteModulo');
            });*/
            Route::get('/docente_modulo',[DocenteModuloController::class,'indexVista'])->name('docente_modulo.indexVista')->middleware(['auth', '2fa']);
            Route::get('docentemodulo',[DocenteModuloController::class,'index'])->name('docentemodulo.index')->middleware(['auth', '2fa']);
            Route::get('docentemodulo/eliminar/{id}',[DocenteModuloController::class,'eliminar'])->name('docentemodulo.eliminar')->middleware(['auth', '2fa']);
            Route::get('docentemodulo/asignar',[DocenteModuloController::class,'asignar'])->name('docentemodulo.asignar')->middleware(['auth', '2fa']);
            Route::post('docentemodulo',[DocenteModuloController::class,'ingresar'])->name('docentemodulo.ingresar')->middleware(['auth', '2fa']);
            Route::get('docentemodulo/editar/{id}',[DocenteModuloController::class,'editar'])->name('docentemodulo.editar')->middleware(['auth', '2fa']);
            Route::post('docentemodulo/actualizar',[DocenteModuloController::class,'actualizar'])->name('docentemodulo.actualizar')->middleware(['auth', '2fa']);
        //rutas horarios 
            /*Route::get('/horarios', function () {
                return view('HORARIO/indexHorario');
            });*/
            Route::get('/horarios',[HorarioController::class,'indexVista'])->name('horarios.indexVista')->middleware(['auth', '2fa']);
            Route::get('horario',[HorarioController::class,'index'])->name('horario.index')->middleware(['auth', '2fa']);
            Route::post('horario',[HorarioController::class,'ingresar'])->name('horario.ingresar')->middleware(['auth', '2fa']);
            Route::get('horario/eliminar/{id}',[HorarioController::class,'eliminar'])->name('horario.eliminar')->middleware(['auth', '2fa']);
            Route::get('horario/editar/{id}',[HorarioController::class,'editar'])->name('horario.editar')->middleware(['auth', '2fa']);
            Route::post('horario/actualizar',[HorarioController::class,'actualizar'])->name('horario.actualizar')->middleware(['auth', '2fa']);
        //asignacion de horarios
        //rutas horarios 
            /*Route::get('/docentemodulohorarios', function () {
                return view('DOCENTEMODULOHORARIO/indexDocenteModuloHorario');
            });*/
            Route::get('/docentemodulohorarios',[DocenteModuloHorarioController::class,'indexsVista'])->name('docentemodulohorarios.indexsVista')->middleware(['auth', '2fa']);
            Route::get('docentemodulohorario',[DocenteModuloHorarioController::class,'indexs'])->name('docentemodulohorario.indexs')->middleware(['auth', '2fa']);
            Route::get('docentemodulohorario/eliminar/{id}',[DocenteModuloHorarioController::class,'eliminar'])->name('docentemodulohorario.eliminar')->middleware(['auth', '2fa']);
            Route::get('docentemodulohorario/asignar',[DocenteModuloHorarioController::class,'asignar'])->name('docentemodulohorario.asignar')->middleware(['auth', '2fa']);
            Route::post('docentemodulohorario',[DocenteModuloHorarioController::class,'ingresar'])->name('docentemodulohorario.ingresar')->middleware(['auth', '2fa']);
            Route::get('docentemodulohorario/editar/{id}',[DocenteModuloHorarioController::class,'editar'])->name('docentemodulohorario.editar')->middleware(['auth', '2fa']);
            Route::post('docentemodulohorario/actualizar',[DocenteModuloHorarioController::class,'actualizar'])->name('docentemodulohorario.actualizar')->middleware(['auth', '2fa']);
            Route::get('docentemodulohorario/cargarmodulos/{id}',[DocenteModuloHorarioController::class,'cargarmodulos'])->name('docentemodulohorario.cargarmodulos')->middleware(['auth', '2fa']);
            Route::get('docentemodulohorario/cargarminiperiodos/{id}',[DocenteModuloHorarioController::class,'cargarminiperiodos'])->name('docentemodulohorario.cargarminiperiodos')->middleware(['auth', '2fa']);
        //tipos de licencia
            /*Route::get('/tipolicenciaA', function () {
                return view('TIPOLICENCIA/indexTipoLicencia');
            });*/
            Route::get('/tipolicenciaA',[TipoLicenciaController::class,'indexVista'])->name('tipolicenciaA.indexVista')->middleware(['auth', '2fa']);
            Route::get('tipolicencia',[TipoLicenciaController::class,'index'])->name('tipolicencia.index')->middleware(['auth', '2fa']);
            Route::post('tipolicencia',[TipoLicenciaController::class,'ingresar'])->name('tipolicencia.ingresar')->middleware(['auth', '2fa']);
            Route::get('tipolicencia/eliminar/{id}',[TipoLicenciaController::class,'eliminar'])->name('tipolicencia.eliminar')->middleware(['auth', '2fa']);
            Route::get('tipolicencia/editar/{id}',[TipoLicenciaController::class,'editar'])->name('tipolicencia.editar')->middleware(['auth', '2fa']);
            Route::post('tipolicencia/actualizar',[TipoLicenciaController::class,'actualizar'])->name('tipolicencia.actualizar')->middleware(['auth', '2fa']);
        //paralelos
            /*Route::get('/paralelosA', function () {
                return view('PARALELO.indexParalelo');
            });*/
            Route::get('paralelosA',[ParaleloController::class,'indexVista'])->name('paralelosA.indexVista')->middleware(['auth', '2fa']);
            Route::get('paralelos',[ParaleloController::class,'index'])->name('paralelos.index')->middleware(['auth', '2fa']);
            Route::post('paralelos',[ParaleloController::class,'ingresar'])->name('paralelos.ingresar')->middleware(['auth', '2fa']);
            Route::get('paralelos/eliminar/{id}',[ParaleloController::class,'eliminar'])->name('paralelos.eliminar')->middleware(['auth', '2fa']);
            Route::get('paralelos/editar/{id}',[ParaleloController::class,'editar'])->name('paralelos.editar')->middleware(['auth', '2fa']);
            Route::post('paralelos/actualizar',[ParaleloController::class,'actualizar'])->name('paralelos.actualizar')->middleware(['auth', '2fa']);
        //rutas periodos-horarios 
            /*Route::get('/periodoshorarios', function () {
                return view('PERIODOHORARIO/indexPeriodoHorario');
            });*/
            Route::get('/periodoshorarios',[PeriodoHorarioController::class,'indexVista'])->name('periodoshorarios.indexVista')->middleware(['auth', '2fa']);
            Route::get('periodohorario',[PeriodoHorarioController::class,'index'])->name('periodohorario.index')->middleware(['auth', '2fa']);
            Route::post('periodohorario',[PeriodoHorarioController::class,'ingresar'])->name('periodohorario.ingresar')->middleware(['auth', '2fa']);
            Route::get('periodohorario/eliminar/{id}',[PeriodoHorarioController::class,'eliminar'])->name('periodohorario.eliminar')->middleware(['auth', '2fa']);
            Route::get('periodohorario/editar/{id}',[PeriodoHorarioController::class,'editar'])->name('periodohorario.editar')->middleware(['auth', '2fa']);
            Route::post('periodohorario/actualizar',[PeriodoHorarioController::class,'actualizar'])->name('periodohorario.actualizar')->middleware(['auth', '2fa']);
            Route::get('periodohorario/cargarperiodoa',[PeriodoHorarioController::class,'cargarperiodoa'])->name('periodohorario.cargarlicencia')->middleware(['auth', '2fa']);
        ///rutas para cambiar datos admin
        //cargar datos usuarioS   editar
            Route::get('user/editarDatosAdmin/{email}',[UserController::class,'editarDatosAdmin'])->name('user.editarDatosAdmin')->middleware(['auth', '2fa']);
        //actualiza datos usuario
            Route::post('user/actualizarUsuario',[UserController::class,'actualizarUsuario'])->name('user.actualizarUsuario')->middleware(['auth', '2fa']);
        // cambiar contraseña usuario
            /*Route::get('/changeAdmin', function () {
                return view('ADMIN/DATOSADMIN/cambiarPasswordAdmin');
            });*/
            Route::get('/changeAdmin',[UserController::class,'vistaCmabiarPassAsmin'])->name('changeAdmin.vistaCmabiarPassAsmin')->middleware(['auth', '2fa']);
            Route::post('user/cambiarPassAdmin',[UserController::class,'cambiarPassAdmin'])->name('user.cambiarPassAdmin')->middleware(['auth', '2fa']);
        ///rutas para usuarios ROOOOOOOOOOOOOOLEEEEEEEEEEEEEEEEEEEESSSSSSSSSSS
            /*Route::get('/usuariorol', function () {
                return view('USUARIOS/indexUsuarios');
            });*/
            Route::get('/usuariorol',[UsuariosController::class,'indexVista'])->name('usuariorol.indexVista')->middleware(['auth', '2fa']);
            Route::get('usuariosrol',[UsuariosController::class,'index'])->name('usuariosrol.index')->middleware(['auth', '2fa']);
            Route::post('usuariosrol',[UsuariosController::class,'ingresar'])->name('usuariosrol.ingresar')->middleware(['auth', '2fa']);
            Route::get('usuariosrol/eliminar/{id}',[UsuariosController::class,'eliminar'])->name('usuariosrol.eliminar')->middleware(['auth', '2fa']);
            Route::get('usuariosrol/editar/{id}',[UsuariosController::class,'editar'])->name('usuariosrol.editar')->middleware(['auth', '2fa']);
            Route::post('usuariosrol/actualizar',[UsuariosController::class,'actualizar'])->name('usuariosrol.actualizar')->middleware(['auth', '2fa']);
         ///rutas para estudiantes
            /*Route::get('/estudiantea', function () {
                return view('ESTUDIANTE/indexEstudiante');
            });*/
            Route::get('/estudiantea',[EstudianteController::class,'indexVista'])->name('estudiantea.indexVista')->middleware(['auth', '2fa']);
            Route::get('estudiantes',[EstudianteController::class,'index'])->name('estudiantes.index')->middleware(['auth', '2fa']);
            Route::post('estudiantes',[EstudianteController::class,'ingresar'])->name('estudiantes.ingresar')->middleware(['auth', '2fa']);
            Route::get('estudiantes/eliminar/{id}',[EstudianteController::class,'eliminar'])->name('estudiantes.eliminar')->middleware(['auth', '2fa']);
            Route::get('estudiantes/editar/{id}',[EstudianteController::class,'editar'])->name('estudiantes.editar')->middleware(['auth', '2fa']);
            Route::post('/estudiantes/actualizar',[EstudianteController::class,'actualizar'])->name('estudiantes.actualizar')->middleware(['auth', '2fa']);
            Route::get('/estudiantes/caragarSelectPeriodosMat',[EstudianteController::class,'caragarSelectPeriodosMat'])->name('estudiantes.caragarSelectPeriodosMat')->middleware(['auth', '2fa']);
            Route::get('/estudiantes/caragarSelectCursosMat/{id}',[EstudianteController::class,'caragarSelectCursosMat'])->name('estudiantes.caragarSelectCursosMat')->middleware(['auth', '2fa']);
        //rutas para matriculas
             Route::get('/matriculasg',[MatriculaController::class,'indexVista'])->name('matriculasg.indexVista')->middleware(['auth', '2fa']);
             Route::get('/matriculas',[MatriculaController::class,'index'])->name('matriculas.index')->middleware(['auth', '2fa']);
             Route::post('/matriculas',[MatriculaController::class,'ingresar'])->name('matriculas.ingresar')->middleware(['auth', '2fa']);
             Route::get('/matriculas/eliminar/{id}',[MatriculaController::class,'eliminar'])->name('matriculas.eliminar')->middleware(['auth', '2fa']);
             Route::get('/matriculas/editar/{id}',[MatriculaController::class,'editar'])->name('matriculas.editar')->middleware(['auth', '2fa']);
             Route::post('/matriculas/actualizar',[MatriculaController::class,'actualizar'])->name('matriculas.actualizar')->middleware(['auth', '2fa']);
             Route::get('/matriculas/cargarSelect',[MatriculaController::class,'cargarSelect'])->name('matriculas.cargarSelect')->middleware(['auth', '2fa']);
             Route::get('/matriculas/cambiarCursoEstudiante/{idP}/{idCur}',[MatriculaController::class,'cambiarCursoEstudiante'])->name('matriculas.cambiarCursoEstudiante')->middleware(['auth', '2fa']);
             Route::post('/matriculas/cambiarCursoParaleloEstudiante',[MatriculaController::class,'cambiarCursoParaleloEstudiante'])->name('matriculas.cambiarCursoParaleloEstudiante')->middleware(['auth', '2fa']);
             /*Route::get('/matriculasg', function () {
                 return view('MATRICULAS/indexMatricula');
             });*/
        //ruta para evaluacion de docentes
            /*Route::get('/evaluaciondoc', function () {
                return view('ADMIN/EVALUACIONDOCENTE/indexEvaluacion');
            });*/
            Route::get('/evaluaciondoc',[EvaluacionController::class,'indexVista'])->name('evaluaciondoc.indexVista')->middleware(['auth', '2fa']);
            Route::get('/evaluacion',[EvaluacionController::class,'index'])->name('evaluacion.index')->middleware(['auth', '2fa']);
            Route::get('evaluacion/cargarSelectEvaluacion',[EvaluacionController::class,'cargarSelectEvaluacion'])->name('evaluacion.cargarSelectEvaluacion')->middleware(['auth', '2fa']);
            Route::get('evaluacion/cargarSelectCursos/{id}',[EvaluacionController::class,'cargarSelectCursos'])->name('evaluacion.cargarSelectCursos')->middleware(['auth', '2fa']);
            Route::get('evaluacion/cargarSelectModulos/{id}/{cur}',[EvaluacionController::class,'cargarSelectModulos'])->name('evaluacion.cargarSelectModulos')->middleware(['auth', '2fa']);
            Route::post('evaluacion',[EvaluacionController::class,'ingresar'])->name('evaluacion.ingresar')->middleware(['auth', '2fa']);
            Route::get('evaluacion/eliminar/{id}',[EvaluacionController::class,'eliminar'])->name('evaluacion.eliminar')->middleware(['auth', '2fa']);
            Route::get('evaluacion/editar/{id}',[EvaluacionController::class,'editar'])->name('evaluacion.editar')->middleware(['auth', '2fa']);
            Route::post('evaluacion/actualizar',[EvaluacionController::class,'actualizar'])->name('evaluacion.actualizar')->middleware(['auth', '2fa']);
            Route::post('evaluacion/actualizarEstado',[EvaluacionController::class,'actualizarEstado'])->name('evaluacion.actualizarEstado')->middleware(['auth', '2fa']);
        //RUTAS PARA PREGUNTAS
            Route::get('evaluacion/cargarSelectEvaluaciones/{id}',[EvaluacionController::class,'cargarSelectEvaluaciones'])->name('evaluacion.cargarSelectEvaluaciones')->middleware(['auth', '2fa']);
            Route::get('/evaluacion/tablaPreguntas/{idP}',[EvaluacionController::class,'tablaPreguntas'])->name('evaluacion.tablaPreguntas')->middleware(['auth', '2fa']);
            Route::post('preguntas',[PreguntaController::class,'ingresar'])->name('preguntas.ingresar')->middleware(['auth', '2fa']);
            Route::get('preguntas/eliminar/{id}',[PreguntaController::class,'eliminar'])->name('preguntas.eliminar')->middleware(['auth', '2fa']);
            Route::get('preguntas/editar/{id}',[PreguntaController::class,'editar'])->name('preguntas.editar')->middleware(['auth', '2fa']);
            Route::post('preguntas/actualizar',[PreguntaController::class,'actualizar'])->name('preguntas.actualizar')->middleware(['auth', '2fa']);
        //quitar seguridad
            Route::get('/admin/quitarSeguridad2faVista',[UserController::class,'quitarSeguridad2faVista'])->name('admin.quitarSeguridad2faVista')->middleware(['auth', '2fa']);
            Route::post('/admin/quitarSeguridad2fa',[UserController::class,'quitarSeguridad2fa'])->name('admin.quitarSeguridad2fa')->middleware(['auth', '2fa']);
            Route::post('/admin/emailEliminar',[UserController::class,'emailEliminar'])->name('admin.emailEliminar')->middleware(['auth', '2fa']);
//RUTAS PARA MODERADORES/DOCENTES--------------------------------------------------------------------------------------------------------------------------------------
///rutas para docentes
        //crag docente  a editar
            Route::get('datosDocente/editarDatos/{email}',[DocenteController::class,'editarDatos'])->name('datosDocente.editarDatos')->middleware(['auth', '2fa']);
        //actualiza datos docente
            Route::post('docentes/actualizarM',[DocenteController::class,'actualizarM'])->name('docentes.actualizarM')->middleware(['auth', '2fa']);
        // cambiar contraseña
            Route::get('/change',[DocenteController::class,'changeVista'])->name('change.changeVista')->middleware(['auth', '2fa']);
            /*Route::get('/change', function () {
                return view('MDocente/cambiarPassword');
            });*/
            Route::post('docentes/cambiarPass',[DocenteController::class,'cambiarPass'])->name('docentes.cambiarPass')->middleware(['auth', '2fa']);
            Route::post('user/changeImage',[UserController::class,'changeImage'])->name('user.changeImage')->middleware(['auth', '2fa']);
        //ruta silabos de docente
         //rutas general silabo
            /*Route::get('/silabo', function () {
                return view('SILABO/indexSilabo');
            });*/
        //ruta metodos silabo
            Route::get('silabo',[SilaboController::class,'indexVista'])->name('silabo.indexVista')->middleware(['auth', '2fa']);
            Route::get('silabodoc',[SilaboController::class,'index'])->name('silabodoc.index')->middleware(['auth', '2fa']);
            Route::get('silabodoc/eliminar/{id}',[SilaboController::class,'eliminar'])->name('silabodoc.eliminar')->middleware(['auth', '2fa']);
            Route::post('silabodoc/guardarSilabo',[SilaboController::class,'guardarSilabo'])->name('silabodoc.guardarSilabo')->middleware(['auth', '2fa']);
            Route::get('silabodoc/descargarSilabo/{id}',[SilaboController::class,'descargarSilabo'])->name('silabodoc.descargarSilabo')->middleware(['auth', '2fa']);
            Route::get('silabodoc/editar/{id}',[SilaboController::class,'editar'])->name('silabodoc.editar')->middleware(['auth', '2fa']);
            Route::post('silabodoc/actualizar',[SilaboController::class,'actualizar'])->name('silabodoc.actualizar')->middleware(['auth', '2fa']);
            Route::get('silabodoc/selectModulosSilabos/{id}',[SilaboController::class,'selectModulosSilabos'])->name('silabodoc.selectModulosSilabos')->middleware(['auth', '2fa']);
        //mostrar horario docente 
            Route::get('horariodoc',[HorarioController::class,'horarioDocente'])->name('horariodoc.horarioDocente')->middleware(['auth', '2fa']);
            Route::get('descargarhorario/{id}',[HorarioController::class,'descargar'])->name('descargarhorario.descargar')->middleware(['auth', '2fa']);
            Route::get('docentehorario/cargarminiperiodoshorarios/{id}',[HorarioController::class,'cargarminiperiodoshorarios'])->name('docentehorario.cargarminiperiodoshorarios')->middleware(['auth', '2fa']);
            Route::get('/docentehorariop/{id}', function () {
                return view('DOCENTE/HORARIODOCENTE/tablahorario');
            })->middleware(['auth', '2fa']);
            Route::get('docentehorario/cargartablahorario/{id}',[HorarioController::class,'cargartablahorario'])->name('docentehorario.cargartablahorario')->middleware(['auth', '2fa']);
        ////ruta metodos avances academicos
            /*Route::get('/avancesacademicos', function () {
                return view('DOCENTE/AVANCESACADEMICO/listarAvances');
            });*/
            Route::get('/avancesacademicos',[AvanceAcademicoController::class,'indexVista'])->name('avancesacademicos.indexVista')->middleware(['auth', '2fa']);
            Route::get('/avanceacademico',[AvanceAcademicoController::class,'index'])->name('avanceacademico.index')->middleware(['auth', '2fa']);
            Route::get('/avancesacademico/generarAvance',[AvanceAcademicoController::class,'generarAvance'])->name('avancesacademico.generarAvance')->middleware(['auth', '2fa']);
            Route::get('/avancesacademico/ingresarAvanceVista/{id}',[AvanceAcademicoController::class,'ingresarAvanceVista'])->name('avancesacademico.ingresarAvanceVista')->middleware(['auth', '2fa']);
            Route::post('/avancesacademico/ingresarAvanceAcedmico',[AvanceAcademicoController::class,'ingresarAvanceAcedmico'])->name('avancesacademico.ingresarAvanceAcedmico')->middleware(['auth', '2fa']);
            Route::get('/avancesacademico/eliminar/{id}',[AvanceAcademicoController::class,'eliminar'])->name('avancesacademico.eliminar')->middleware(['auth', '2fa']);
            Route::get('/avancesacademico/editarAvanceAcdemico/{id}',[AvanceAcademicoController::class,'editarAvanceAcdemico'])->name('avancesacademico.editarAvanceAcdemico')->middleware(['auth', '2fa']);
            //rutas avance subtemas
            /*Route::get('/avancesSubtemas', function () {
                return view('DOCENTE/AVANCESACADEMICO/avanceSubtemas');
            });*/
            Route::get('/avancesSubtemas/{id}',[AvanceAcademicoSubtemasController::class,'visualizarIndex'])->name('avancesSubtemas.visualizarIndex')->middleware(['auth', '2fa']);
            Route::get('/avanceSubtema/{id}',[AvanceAcademicoSubtemasController::class,'index'])->name('avanceSubtema.index')->middleware(['auth', '2fa']);
            Route::get('/avanceSubtema/visualizarEditar/{id}',[AvanceAcademicoSubtemasController::class,'visualizarEditar'])->name('avanceSubtema.visualizarEditar')->middleware(['auth', '2fa']);
            Route::get('/avanceSubtemaEditar/{id}',[AvanceAcademicoSubtemasController::class,'indexEditar'])->name('avanceSubtemaEditar.indexEditar')->middleware(['auth', '2fa']);
            Route::get('/unidad/idSilabo/{id}',[UnidadController::class,'idSilabo'])->name('unidad.idSilabo')->middleware(['auth', '2fa']);
            Route::get('/unidad/mostrarUnidades3/{id}',[UnidadController::class,'mostrarUnidades3'])->name('unidad.mostrarUnidades3')->middleware(['auth', '2fa']);
            Route::get('/temas/mostrarTemas3/{id}',[TemaController::class,'mostrarTemas3'])->name('temas.mostrarTemas3')->middleware(['auth', '2fa']);
            Route::get('/subtemas/mostrarSubTemas3/{id}',[SubtemaController::class,'mostrarSubTemas3'])->name('subtemas.mostrarSubTemas3')->middleware(['auth', '2fa']);
            Route::post('/avanceSubtema/ingresar',[AvanceAcademicoSubtemasController::class,'ingresar'])->name('avanceSubtema.ingresar')->middleware(['auth', '2fa']);
            Route::get('/avanceSubtema/eliminar/{id}',[AvanceAcademicoSubtemasController::class,'eliminar'])->name('avanceSubtema.eliminar')->middleware(['auth', '2fa']);
            Route::get('/avanceSubtema/visualizarDetalle/{id}',[DetalleAvanceController::class,'visualizarDetalle'])->name('avanceSubtema.visualizarDetalle')->middleware(['auth', '2fa']);
            Route::get('/avanceAcademico/visualizarMetodos/{id}',[MetodosEnseñanzaController::class,'visualizarMetodos'])->name('avanceAcademico.visualizarMetodos')->middleware(['auth', '2fa']);
            Route::get('/avanceAcademico/visualizarRecursos/{id}',[RecursosEnseñanzaController::class,'visualizarRecursos'])->name('avanceAcademico.visualizarRecursos')->middleware(['auth', '2fa']);
            Route::post('/detalleAvance/ingresar',[DetalleAvanceController::class,'ingresar'])->name('detalleAvance.ingresar')->middleware(['auth', '2fa']);
            //reporte avance academico
                Route::get('/avancesacademico/reporteAvance',[AvanceAcademicoController::class,'reporteAvance'])->name('avancesacademico.reporteAvance')->middleware(['auth', '2fa']);
                Route::get('/avancesacademico/pdfReporteAvance/{id}/{fechainicio}/{fechafin}',[AvanceAcademicoController::class,'pdfReporteAvance'])->name('avancesacademico.pdfReporteAvance')->middleware(['auth', '2fa']);
        //ruta para notas de docente
            ////ruta metodos avances academicos
            /*Route::get('/notasDocentes', function () {
                return view('DOCENTE/NOTAS/indexNotas');
            });*/
            Route::get('/notasDocentes',[NotasController::class,'indexVista'])->name('notasDocentes.indexVista')->middleware(['auth', '2fa']);
            Route::get('/notasDocente',[NotasController::class,'index'])->name('notasDocente.index')->middleware(['auth', '2fa']);
            Route::get('/notasDocente/selectPeriodos',[NotasController::class,'selectPeriodos'])->name('notasDocente.selectPeriodos')->middleware(['auth', '2fa']);
            Route::get('/notasDocente/selectCursos/{id}',[NotasController::class,'selectCursos'])->name('notasDocente.selectCursos')->middleware(['auth', '2fa']);
            Route::get('/notasDocente/selectModulos/{idP}/{idCur}',[NotasController::class,'selectModulos'])->name('notasDocente.selectModulos')->middleware(['auth', '2fa']);
            Route::get('/notasDocente/tablaEstudiantes/{idP}/{idCur}/{idMod}',[NotasController::class,'tablaEstudiantes'])->name('notasDocente.tablaEstudiantes')->middleware(['auth', '2fa']);
            Route::get('/notasDocente/mostrarCalificarEstudiante/{idDoc}/{idMat}',[NotasController::class,'mostrarCalificarEstudiante'])->name('notasDocente.mostrarCalificarEstudiante')->middleware(['auth', '2fa']);
            Route::post('/notasDocente',[NotasController::class,'ingresar'])->name('notasDocente.ingresar')->middleware(['auth', '2fa']);
            Route::post('notasDocente/actualizar',[NotasController::class,'actualizar'])->name('notasDocente.actualizar')->middleware(['auth', '2fa']);
            Route::get('/notasDocente/eliminar/{id}',[NotasController::class,'eliminar'])->name('notasDocente.eliminar')->middleware(['auth', '2fa']);
        //ruta para modulos de docente
            Route::get('/modulosDocente/selectPeriodos',[ModuloController::class,'selectPeriodos'])->name('modulosDocente.selectPeriodos')->middleware(['auth', '2fa']);
            Route::get('/modulosDocente/selectCursos/{id}',[ModuloController::class,'selectCursos'])->name('modulosDocente.selectCursos')->middleware(['auth', '2fa']);
            Route::get('/modulosDocente/tablaModulosPeriodos/{idP}',[ModuloController::class,'tablaModulosPeriodos'])->name('modulosDocente.tablaModulosPeriodos')->middleware(['auth', '2fa']);
            Route::get('/modulosDocente/tablaModulosPeriodosCursos/{idP}/{idCur}',[ModuloController::class,'tablaModulosPeriodosCursos'])->name('modulosDocente.tablaModulosPeriodosCursos')->middleware(['auth', '2fa']);
         //ruta para listado de estudiantes
            Route::get('/listaEstudiantes/estudianteSelectPeriodos',[EstudianteController::class,'estudianteSelectPeriodos'])->name('listaEstudiantes.estudianteSelectPeriodos')->middleware(['auth', '2fa']);
            Route::get('/listaEstudiantes/selectCursosEstudiantes/{id}',[EstudianteController::class,'selectCursosEstudiantes'])->name('listaEstudiantes.selectCursosEstudiantes')->middleware(['auth', '2fa']);
            Route::get('/listaEstudiantes/tablaEstudiantesPeriodos/{idP}',[EstudianteController::class,'tablaEstudiantesPeriodos'])->name('listaEstudiantes.tablaEstudiantesPeriodos')->middleware(['auth', '2fa']);
            Route::get('/listaEstudiantes/tablaEstudiantesPeriodosCursos/{idP}/{idCur}',[EstudianteController::class,'tablaEstudiantesPeriodosCursos'])->name('listaEstudiantes.tablaEstudiantesPeriodosCursos')->middleware(['auth', '2fa']);
        //rutas para generar silabo
            Route::get('/silabodocente',[SilaboController::class,'generarSilabo'])->name('silabodocente.generarSilabo')->middleware(['auth', '2fa']);
            Route::get('/silabodocente/selectCursosSilabo/{id}',[SilaboController::class,'selectCursosSilabo'])->name('silabodocente.selectCursosSilabo')->middleware(['auth', '2fa']);
            Route::get('/silabodocente/selectModulosSilabo/{idP}/{idCur}',[SilaboController::class,'selectModulosSilabo'])->name('silabodocente.selectModulosSilabo')->middleware(['auth', '2fa']);
            Route::post('silabodocente',[SilaboController::class,'ingresar'])->name('silabodocente.ingresar')->middleware(['auth', '2fa']);
            Route::get('/silabodocente/selectPeriodosA',[SilaboController::class,'selectPeriodosA'])->name('silabodocente.selectPeriodosA')->middleware(['auth', '2fa']);
            Route::get('/silabodocente/tablaSilabos/{id}',[SilaboController::class,'tablaSilabos'])->name('silabodocente.tablaSilabos')->middleware(['auth', '2fa']);
            Route::get('/silabodocente/mostrarDatosInfo/{id}',[SilaboController::class,'mostrarDatosInfo'])->name('silabodocente.mostrarDatosInfo')->middleware(['auth', '2fa']);
            //gestion prerrequisitos silabo
                /*Route::get('/prerrequisitoss', function () {
                    return view('DOCENTE/SILABO/prerrequisitos');
                });*/
                Route::get('/prerrequisitoss',[PrerrequisitoController::class,'indexVista'])->name('prerrequisitoss.indexVista')->middleware(['auth', '2fa']);
                Route::get('/prerrequisitos',[PrerrequisitoController::class,'index'])->name('prerrequisitos.index')->middleware(['auth', '2fa']);
                Route::get('/prerrequisitos/mostrarPrerrequisitos/{id}',[PrerrequisitoController::class,'mostrarPrerrequisitos'])->name('prerrequisitos.mostrarPrerrequisitos')->middleware(['auth', '2fa']);
                Route::post('/prerrequisitos/ingresarPrerrequisito',[PrerrequisitoController::class,'ingresarPrerrequisito'])->name('prerrequisitos.ingresarPrerrequisito')->middleware(['auth', '2fa']);
                Route::get('/prerrequisitos/eliminarPrerrequisito/{id}',[PrerrequisitoController::class,'eliminarPrerrequisito'])->name('prerrequisitos.eliminarPrerrequisito')->middleware(['auth', '2fa']);
                Route::get('/prerrequisitos/editarPrerrequisito/{id}',[PrerrequisitoController::class,'editarPrerrequisito'])->name('prerrequisitos.editarPrerrequisito')->middleware(['auth', '2fa']);
                Route::post('prerrequisitos/actualizarPrerrequisito',[PrerrequisitoController::class,'actualizarPrerrequisito'])->name('prerrequisitos.actualizarPrerrequisito')->middleware(['auth', '2fa']);
            //GESTION DE datos de asignatura de silabo
                Route::get('/datosAsignatura/mostrarDatosAsignatura/{id}',[DatosAsignaturaController::class,'mostrarDatosAsignatura'])->name('datosAsignatura.mostrarDatosAsignatura')->middleware(['auth', '2fa']);
                Route::post('/datosAsignatura/ingresarDatosAsignatura',[DatosAsignaturaController::class,'ingresarDatosAsignatura'])->name('datosAsignatura.ingresarDatosAsignatura')->middleware(['auth', '2fa']);
                Route::post('/datosAsignatura/actualizarDatosAsignatura',[DatosAsignaturaController::class,'actualizarDatosAsignatura'])->name('datosAsignatura.actualizarDatosAsignatura')->middleware(['auth', '2fa']);
            //GESTION DE unidades de silabo
                Route::get('/unidad/mostrarUnidades/{id}',[UnidadController::class,'mostrarUnidades'])->name('unidad.mostrarUnidades')->middleware(['auth', '2fa']);
                Route::post('/unidad/ingresarUnidad',[UnidadController::class,'ingresarUnidad'])->name('unidad.ingresarUnidad')->middleware(['auth', '2fa']);
                Route::get('/unidad/eliminarUnidad/{id}',[UnidadController::class,'eliminarUnidad'])->name('unidad.eliminarUnidad')->middleware(['auth', '2fa']);
                Route::get('/unidad/editarUnidad/{id}',[UnidadController::class,'editarUnidad'])->name('unidad.editarUnidad')->middleware(['auth', '2fa']);
                Route::post('/unidad/actualizarUnidad',[UnidadController::class,'actualizarUnidad'])->name('unidad.actualizarUnidad')->middleware(['auth', '2fa']);
            //GESTION DE tema de unidades
                Route::get('/temas/mostrarTemas/{id}',[TemaController::class,'mostrarTemas'])->name('temas.mostrarTemas')->middleware(['auth', '2fa']);
                Route::post('/temas/ingresarTema',[TemaController::class,'ingresarTema'])->name('temas.ingresarTema')->middleware(['auth', '2fa']);
                Route::get('/temas/eliminartemas/{id}',[TemaController::class,'eliminartemas'])->name('temas.eliminartemas')->middleware(['auth', '2fa']);
                Route::get('/temas/editartema/{id}',[TemaController::class,'editartema'])->name('temas.editartema')->middleware(['auth', '2fa']);
                Route::post('/temas/actualizarTema',[TemaController::class,'actualizarTema'])->name('temas.actualizarTema')->middleware(['auth', '2fa']);
            //GESTION DE subtema de temas
                Route::get('/subtemas/mostrarSubTemas/{id}',[SubtemaController::class,'mostrarSubTemas'])->name('subtemas.mostrarSubTemas')->middleware(['auth', '2fa']);
                Route::post('/subtemas/ingresarSubTema',[SubtemaController::class,'ingresarSubTema'])->name('subtemas.ingresarSubTema')->middleware(['auth', '2fa']);
                Route::get('/subtemas/eliminarSubtema/{id}',[SubtemaController::class,'eliminarSubtema'])->name('subtemas.eliminarSubtema')->middleware(['auth', '2fa']);
                Route::get('/subtemas/editarSubtema/{id}',[SubtemaController::class,'editarSubtema'])->name('subtemas.editarSubtema')->middleware(['auth', '2fa']);
                Route::post('/subtemas/actualizarSubTema',[SubtemaController::class,'actualizarSubTema'])->name('subtemas.actualizarSubTema')->middleware(['auth', '2fa']);
            //GESTION DE evaluaciones por unidad
                Route::get('/evaluaciones/mostrarEvaluaciones/{id}',[EvaluacionUnidadController::class,'mostrarEvaluaciones'])->name('evaluaciones.mostrarEvaluaciones')->middleware(['auth', '2fa']);
                Route::post('/evaluaciones/ingresarEvaluacion',[EvaluacionUnidadController::class,'ingresarEvaluacion'])->name('evaluaciones.ingresarEvaluacion')->middleware(['auth', '2fa']);
                Route::get('/evaluaciones/eliminarEvaluacion/{id}',[EvaluacionUnidadController::class,'eliminarEvaluacion'])->name('evaluaciones.eliminarEvaluacion')->middleware(['auth', '2fa']);
                Route::get('/evaluaciones/editarEvaluacion/{id}',[EvaluacionUnidadController::class,'editarEvaluacion'])->name('evaluaciones.editarEvaluacion')->middleware(['auth', '2fa']);
                Route::post('/evaluaciones/actualizarEvaluacion',[EvaluacionUnidadController::class,'actualizarEvaluacion'])->name('evaluaciones.actualizarEvaluacion')->middleware(['auth', '2fa']);
             //GESTION DE tecnicas e instrumentos por unidad
                Route::get('/tecnicas/mostrarTecnicasInstrumentos/{id}',[TecnicaInstrumentoController::class,'mostrarTecnicasInstrumentos'])->name('tecnicas.mostrarTecnicasInstrumentos')->middleware(['auth', '2fa']);
                Route::post('/tecnicas/ingresarTecnicaInstrumento',[TecnicaInstrumentoController::class,'ingresarTecnicaInstrumento'])->name('tecnicas.ingresarTecnicaInstrumento')->middleware(['auth', '2fa']);
                Route::get('/tecnicas/eliminarTI/{id}',[TecnicaInstrumentoController::class,'eliminarTI'])->name('tecnicas.eliminarTI')->middleware(['auth', '2fa']);
                Route::get('/tecnicas/editarTI/{id}',[TecnicaInstrumentoController::class,'editarTI'])->name('tecnicas.editarTI')->middleware(['auth', '2fa']);
                Route::post('/tecnicas/actualizarTI',[TecnicaInstrumentoController::class,'actualizarTI'])->name('tecnicas.actualizarTI')->middleware(['auth', '2fa']);
            //GESTION DE resultados por unidad
                Route::get('/resultados/mostrarRU/{id}',[ResultadoUnidadController::class,'mostrarRU'])->name('resultados.mostrarRU')->middleware(['auth', '2fa']);
                Route::post('/resultados/ingresarRU',[ResultadoUnidadController::class,'ingresarRU'])->name('resultados.ingresarRU')->middleware(['auth', '2fa']);
                Route::get('/resultados/eliminarRU/{id}',[ResultadoUnidadController::class,'eliminarRU'])->name('resultados.eliminarRU')->middleware(['auth', '2fa']);
                Route::get('/resultados/editarRU/{id}',[ResultadoUnidadController::class,'editarRU'])->name('resultados.editarRU')->middleware(['auth', '2fa']);
                Route::post('/resultados/actualizarRU',[ResultadoUnidadController::class,'actualizarRU'])->name('resultados.actualizarRU')->middleware(['auth', '2fa']);
             //GESTION DE metodos de enseñanza
                Route::get('/metodos/variableSesion/{id}',[MetodosEnseñanzaController::class,'variableSesion'])->name('metodos.variableSesion')->middleware(['auth', '2fa']);
                /*Route::get('/metodosprueba', function () {
                    return view('DOCENTE/SILABO/indexMetodos');
                });*/
                Route::get('/metodosprueba',[MetodosEnseñanzaController::class,'indexVista'])->name('metodosprueba.indexVista')->middleware(['auth', '2fa']);
                Route::get('/metodos',[MetodosEnseñanzaController::class,'index'])->name('metodos.index')->middleware(['auth', '2fa']);
                Route::get('/get_ajax_Metodos/{id}',[MetodosEnseñanzaController::class,'get_ajax_Metodos'])->name('metodos.get_ajax_Metodos')->middleware(['auth', '2fa']);
                Route::post('/metodos/ingresarMetodos',[MetodosEnseñanzaController::class,'ingresarMetodos'])->name('metodos.ingresarMetodos')->middleware(['auth', '2fa']);
                Route::get('/metodos/eliminarMetodos/{id}',[MetodosEnseñanzaController::class,'eliminarMetodos'])->name('metodos.eliminarMetodos')->middleware(['auth', '2fa']);
                Route::get('/metodos/editarMetodos/{id}',[MetodosEnseñanzaController::class,'editarMetodos'])->name('metodos.editarMetodos')->middleware(['auth', '2fa']);
                Route::post('/metodos/actualizarMetodos',[MetodosEnseñanzaController::class,'actualizarMetodos'])->name('metodos.actualizarMetodos')->middleware(['auth', '2fa']);
            //gestion recuros de enseñanza silabo
                /*Route::get('/recursos', function () {
                    return view('DOCENTE/SILABO/tablaRecursos');
                });*/
                Route::get('/recursos',[RecursosEnseñanzaController::class,'indexVista'])->name('recursos.indexVista')->middleware(['auth', '2fa']);
                Route::get('/recurso',[RecursosEnseñanzaController::class,'index'])->name('recurso.index')->middleware(['auth', '2fa']);
                Route::post('/recurso/ingresarRecurso',[RecursosEnseñanzaController::class,'ingresarRecurso'])->name('recurso.ingresarRecurso')->middleware(['auth', '2fa']);
                Route::get('/recurso/eliminarRecurso/{id}',[RecursosEnseñanzaController::class,'eliminarRecurso'])->name('recurso.eliminarRecurso')->middleware(['auth', '2fa']);
                Route::get('/recurso/editarRecurso/{id}',[RecursosEnseñanzaController::class,'editarRecurso'])->name('recurso.editarRecurso')->middleware(['auth', '2fa']);
                Route::post('/recurso/actualizarRecurso',[RecursosEnseñanzaController::class,'actualizarRecurso'])->name('recurso.actualizarRecurso')->middleware(['auth', '2fa']);
            //gestion recuros de escenarios de aprendizaje de silabo
                /*Route::get('/escenarios', function () {
                    return view('DOCENTE/SILABO/tablaEscenariosAprensizaje');
                });*/
                Route::get('/escenarios',[EscenariosAprendizajeController::class,'indexVista'])->name('escenarios.indexVista')->middleware(['auth', '2fa']);
                Route::get('/escenario',[EscenariosAprendizajeController::class,'index'])->name('escenario.index')->middleware(['auth', '2fa']);
                Route::post('/escenario/ingresarEscenario',[EscenariosAprendizajeController::class,'ingresarEscenario'])->name('escenario.ingresarEscenario')->middleware(['auth', '2fa']);
                Route::get('/escenario/eliminarEscenario/{id}',[EscenariosAprendizajeController::class,'eliminarEscenario'])->name('escenario.eliminarEscenario')->middleware(['auth', '2fa']);
                Route::get('/escenario/editarEscenario/{id}',[EscenariosAprendizajeController::class,'editarEscenario'])->name('escenario.editarEscenario')->middleware(['auth', '2fa']);
                Route::post('/escenario/actualizarEscenario',[EscenariosAprendizajeController::class,'actualizarEscenario'])->name('escenario.actualizarEscenario')->middleware(['auth', '2fa']);
            //gestion de bibliografia de silabo
                /*Route::get('/bibliografias', function () {
                    return view('DOCENTE/SILABO/tablaBibliografia');
                });*/
                Route::get('/bibliografias',[BibliografiaController::class,'indexVista'])->name('bibliografias.indexVista')->middleware(['auth', '2fa']);
                Route::get('/bibliografia',[BibliografiaController::class,'index'])->name('bibliografia.index')->middleware(['auth', '2fa']);
                Route::post('/bibliografia/ingresarBibliografia',[BibliografiaController::class,'ingresarBibliografia'])->name('bibliografia.ingresarBibliografia')->middleware(['auth', '2fa']);
                Route::get('/bibliografia/eliminarBibliografia/{id}',[BibliografiaController::class,'eliminarBibliografia'])->name('bibliografia.eliminarBibliografia')->middleware(['auth', '2fa']);
                Route::get('/bibliografia/editarBibliografia/{id}',[BibliografiaController::class,'editarBibliografia'])->name('bibliografia.editarBibliografia')->middleware(['auth', '2fa']);
                Route::post('/bibliografia/actualizarBibliografia',[BibliografiaController::class,'actualizarBibliografia'])->name('bibliografia.actualizarBibliografia')->middleware(['auth', '2fa']);
            //gestion de bibliografia complementaria de silabo
                /*Route::get('/bibliografiaCs', function () {
                    return view('DOCENTE/SILABO/tablaBibliografiaComplementaria');
                });*/
                Route::get('/bibliografiaCs',[BibliografiaComplementariaController::class,'indexVista'])->name('bibliografiaCs.indexVista')->middleware(['auth', '2fa']);
                Route::get('/bcomplementaria',[BibliografiaComplementariaController::class,'index'])->name('bcomplementaria.index')->middleware(['auth', '2fa']);
                Route::post('/bcomplementaria/ingresarBibliografiaComplementaria',[BibliografiaComplementariaController::class,'ingresarBibliografiaComplementaria'])->name('bcomplementaria.ingresarBlibliografiaComplementaria')->middleware(['auth', '2fa']);
                Route::get('/bcomplementaria/eliminarBibliografiaComplementaria/{id}',[BibliografiaComplementariaController::class,'eliminarBibliografiaComplementaria'])->name('bcomplementaria.eliminarBlibliografiaComplementaria')->middleware(['auth', '2fa']);
                Route::get('/bcomplementaria/editarBibliografiaComplementaria/{id}',[BibliografiaComplementariaController::class,'editarBibliografiaComplementaria'])->name('bcomplementaria.editarBlibliografiaComplementaria')->middleware(['auth', '2fa']);
                Route::post('/bcomplementaria/actualizarBibliografiaComplementaria',[BibliografiaComplementariaController::class,'actualizarBibliografiaComplementaria'])->name('bcomplementaria.actualizarBlibliografiaComplementaria')->middleware(['auth', '2fa']);
            //gestion de webgrafias de silabo
                /*Route::get('/webgrafias', function () {
                    return view('DOCENTE/SILABO/tablaWebgrafia');
                });*/
                Route::get('/webgrafias',[WebgrafiaController::class,'indexVista'])->name('webgrafias.indexVista')->middleware(['auth', '2fa']);
                Route::get('/webgrafia',[WebgrafiaController::class,'index'])->name('webgrafia.index')->middleware(['auth', '2fa']);
                Route::post('/webgrafia/ingresarWebgrafia',[WebgrafiaController::class,'ingresarWebgrafia'])->name('webgrafia.ingresarWebgrafia')->middleware(['auth', '2fa']);
                Route::get('/webgrafia/eliminarWebgrafia/{id}',[WebgrafiaController::class,'eliminarWebgrafia'])->name('webgrafia.eliminarWebgrafia')->middleware(['auth', '2fa']);
                Route::get('/webgrafia/editarWebgrafia/{id}',[WebgrafiaController::class,'editarWebgrafia'])->name('webgrafia.editarWebgrafia')->middleware(['auth', '2fa']);
                Route::post('/webgrafia/actualizarWebgrafia',[WebgrafiaController::class,'actualizarWebgrafia'])->name('webgrafia.actualizarWebgrafia')->middleware(['auth', '2fa']);
            //gestion de  bibliografia digital de silabo
                /*Route::get('/Bdigitales', function () {
                    return view('DOCENTE/SILABO/tablaBibliografiaDigital');
                });*/
                Route::get('/Bdigitales',[BibliografiaDigitalController::class,'indexVista'])->name('Bdigitales.indexVista')->middleware(['auth', '2fa']);
                Route::get('/bdigital',[BibliografiaDigitalController::class,'index'])->name('bdigital.index')->middleware(['auth', '2fa']);
                Route::post('/bdigital/ingresarBDigital',[BibliografiaDigitalController::class,'ingresarBDigital'])->name('bdigital.ingresarBDigital')->middleware(['auth', '2fa']);
                Route::get('/bdigital/eliminarBDigital/{id}',[BibliografiaDigitalController::class,'eliminarBDigital'])->name('bdigital.eliminarBDigital')->middleware(['auth', '2fa']);
                Route::get('/bdigital/editarBDigital/{id}',[BibliografiaDigitalController::class,'editarBDigital'])->name('bdigital.editarBDigital')->middleware(['auth', '2fa']);
                Route::post('/bdigital/actualizarBDigital',[BibliografiaDigitalController::class,'actualizarBDigital'])->name('bdigital.actualizarBDigital')->middleware(['auth', '2fa']);
            //mostrar estado de silabo
                Route::get('/estadoSilabo/{id}',[SilaboController::class,'mostrarEstadoSilabo'])->name('estadoSilabo.mostrarEstadoSilabo')->middleware(['auth', '2fa']);
                Route::get('/estadoSilabo/mostrarEstadoSilaboBoton/{id}',[SilaboController::class,'mostrarEstadoSilaboBoton'])->name('estadoSilabo.mostrarEstadoSilaboBoton')->middleware(['auth', '2fa']);
            //duplicar silabo
                Route::get('/silabo/duplicarSilaboDocenteModal/{id}',[SilaboController::class,'duplicarSilaboDocenteModal'])->name('silabo.duplicarSilaboDocenteModal')->middleware(['auth', '2fa']);
                Route::post('/silaboD',[SilaboController::class,'duplicarSilaboDocente'])->name('silaboD.duplicarSilaboDocente')->middleware(['auth', '2fa']);
            //SOLO MOSTRAR SILABO
                    Route::get('/datosAsignatura/mostrarDatosAsignatura2/{id}',[DatosAsignaturaController::class,'mostrarDatosAsignatura2'])->name('datosAsignatura.mostrarDatosAsignatura2')->middleware(['auth', '2fa']);
                    /*Route::get('/prerrequisitoss2', function () {
                        return view('DOCENTE/SILABOSOLODATOS/prerrequisitos');
                    });*/
                    Route::get('/prerrequisitoss2',[PrerrequisitoController::class,'index2Vista'])->name('prerrequisitoss2.index2Vista')->middleware(['auth', '2fa']);
                    Route::get('/prerrequisitos2',[PrerrequisitoController::class,'index2'])->name('prerrequisitos2.index2')->middleware(['auth', '2fa']);
                    Route::get('/unidad/mostrarUnidades2/{id}',[UnidadController::class,'mostrarUnidades2'])->name('unidad.mostrarUnidades2')->middleware(['auth', '2fa']);
                    Route::get('/temas/mostrarTemas2/{id}',[TemaController::class,'mostrarTemas2'])->name('temas.mostrarTemas2')->middleware(['auth', '2fa']);
                    Route::get('/subtemas/mostrarSubTemas2/{id}',[SubtemaController::class,'mostrarSubTemas2'])->name('subtemas.mostrarSubTemas2')->middleware(['auth', '2fa']);
                    Route::get('/evaluaciones/mostrarEvaluaciones2/{id}',[EvaluacionUnidadController::class,'mostrarEvaluaciones2'])->name('evaluaciones.mostrarEvaluaciones2')->middleware(['auth', '2fa']);
                    Route::get('/tecnicas/mostrarTecnicasInstrumentos2/{id}',[TecnicaInstrumentoController::class,'mostrarTecnicasInstrumentos2'])->name('tecnicas.mostrarTecnicasInstrumentos2')->middleware(['auth', '2fa']);
                    Route::get('/resultados/mostrarRU2/{id}',[ResultadoUnidadController::class,'mostrarRU2'])->name('resultados.mostrarRU2')->middleware(['auth', '2fa']);
                    /*Route::get('/metodosprueba2', function () {
                        return view('DOCENTE/SILABOSOLODATOS/indexMetodos');
                    });*/
                    Route::get('/metodosprueba2',[MetodosEnseñanzaController::class,'index2Vista'])->name('metodosprueba2.index2Vista')->middleware(['auth', '2fa']);
                    Route::get('/metodos2',[MetodosEnseñanzaController::class,'index2'])->name('metodos2.index2')->middleware(['auth', '2fa']);
                    /*Route::get('/recursos2', function () {
                        return view('DOCENTE/SILABOSOLODATOS/tablaRecursos');
                    });*/
                    Route::get('/recursos2',[RecursosEnseñanzaController::class,'index2Vista'])->name('recursos2.index2Vista')->middleware(['auth', '2fa']);
                    Route::get('/recurso2',[RecursosEnseñanzaController::class,'index2'])->name('recurso2.index2')->middleware(['auth', '2fa']);
                    /*Route::get('/escenarios2', function () {
                        return view('DOCENTE/SILABOSOLODATOS/tablaEscenariosAprensizaje');
                    });*/
                    Route::get('/escenarios2',[EscenariosAprendizajeController::class,'index2Vista'])->name('escenarios2.index2Vista')->middleware(['auth', '2fa']);
                    Route::get('/escenario2',[EscenariosAprendizajeController::class,'index2'])->name('escenario2.index2')->middleware(['auth', '2fa']);
                    /*Route::get('/bibliografias2', function () {
                        return view('DOCENTE/SILABOSOLODATOS/tablaBibliografia');
                    });*/
                    Route::get('/bibliografias2',[BibliografiaController::class,'index2Vista'])->name('bibliografias2.index2Vista')->middleware(['auth', '2fa']);
                    Route::get('/bibliografia2',[BibliografiaController::class,'index2'])->name('bibliografia2.index2')->middleware(['auth', '2fa']);
                    /*Route::get('/bibliografiaCs2', function () {
                        return view('DOCENTE/SILABOSOLODATOS/tablaBibliografiaComplementaria');
                    });*/
                    Route::get('/bibliografiaCs2',[BibliografiaComplementariaController::class,'index2Vista'])->name('bibliografiaCs2.index2Vista')->middleware(['auth', '2fa']);
                    Route::get('/bcomplementaria2',[BibliografiaComplementariaController::class,'index2'])->name('bcomplementaria2.index2')->middleware(['auth', '2fa']);
                    /*Route::get('/webgrafias2', function () {
                        return view('DOCENTE/SILABOSOLODATOS/tablaWebgrafia');
                    });*/
                    Route::get('/webgrafias2',[WebgrafiaController::class,'index2Vista'])->name('webgrafias2.index2Vista')->middleware(['auth', '2fa']);
                    Route::get('/webgrafia2',[WebgrafiaController::class,'index2'])->name('webgrafia2.index2')->middleware(['auth', '2fa']);
                    /*Route::get('/Bdigitales2', function () {
                        return view('DOCENTE/SILABOSOLODATOS/tablaBibliografiaDigital');
                    });*/
                    Route::get('/Bdigitales2',[BibliografiaDigitalController::class,'index2Vista'])->name('Bdigitales2.index2Vista')->middleware(['auth', '2fa']);
                    Route::get('/bdigital2',[BibliografiaDigitalController::class,'index2'])->name('bdigital2.index2')->middleware(['auth', '2fa']);
                    Route::get('/estadoSilabo2/{id}',[SilaboController::class,'mostrarEstadoSilabo2'])->name('estadoSilabo2.mostrarEstadoSilabo2')->middleware(['auth', '2fa']);
                //corregir silabo 
            //rutas para asistncia de estudiante
                /*Route::get('/asistenciasEstudiantes', function () {
                    return view('DOCENTE/ASISTENCIAS/indexAsistencia');
                });*/
                Route::get('/asistenciasEstudiantes',[AsistenciaController::class,'indexVista'])->name('asistenciasEstudiantes.indexVista')->middleware(['auth', '2fa']);
                Route::get('/asistenciaEstudiante',[AsistenciaController::class,'index'])->name('asistenciaEstudiante.index')->middleware(['auth', '2fa']);
                Route::get('/asistenciaEstudiante/selectPeriodos',[AsistenciaController::class,'selectPeriodos'])->name('asistenciaEstudiante.selectPeriodos')->middleware(['auth', '2fa']);
                Route::get('/asistenciaEstudiante/selectCursos/{id}',[AsistenciaController::class,'selectCursos'])->name('asistenciaEstudiante.selectCursos')->middleware(['auth', '2fa']);
                Route::get('/asistenciaEstudiante/selectModulos/{idP}/{idCur}',[AsistenciaController::class,'selectModulos'])->name('asistenciaEstudiante.selectModulos')->middleware(['auth', '2fa']);
                Route::post('/asistenciaEstudiante/crearAsistencia',[AsistenciaController::class,'crearAsistencia'])->name('asistenciaEstudiante.crearAsistencia')->middleware(['auth', '2fa']);
                Route::get('/asistenciaEstudiante/tablaAsistenciaEstudiantes/{idP}/{fecha}/{idDocMod}',[AsistenciaController::class,'tablaAsistenciaEstudiantes'])->name('asistenciaEstudiante.tablaAsistenciaEstudiantes')->middleware(['auth', '2fa']);
                //Route::get('/asistencias/{idP}/{fecha}/{idDocMod}',[AsistenciaController::class,'indexEstado'])->name('asistencias.indexEstado');
                Route::get('/estadosAsisntencias/cambiarEstado/{id}/{estado}',[AsistenciaController::class,'cambiarEstado'])->name('estadosAsisntencias.cambiarEstado')->middleware(['auth', '2fa']);
                Route::get('/asistenciaEstudiante/eliminarAsistencia/{idP}/{fecha}/{idDocMod}',[AsistenciaController::class,'eliminarAsistencia'])->name('asistenciaEstudiante.eliminarAsistencia')->middleware(['auth', '2fa']);
                Route::get('/asistenciaEstudiante/reporteAsistencia/{idP}/{idDocMod}/{fechaini}/{fechafin}',[AsistenciaController::class,'reporteAsistencia'])->name('asistenciaEstudiante.reporteAsistencia')->middleware(['auth', '2fa']);
                Route::get('/asistenciaEstudiante/reporteAsistenciaContador/{idP}/{idDocMod}/{fechaini}/{fechafin}',[AsistenciaController::class,'reporteAsistenciaContador'])->name('asistenciaEstudiante.reporteAsistenciaContador')->middleware(['auth', '2fa']);
                Route::get('/asistenciaEstudiante/porcentajeAsistencia/{idP}/{idDocMod}',[AsistenciaController::class,'porcentajeAsistencia'])->name('asistenciaEstudiante.porcentajeAsistencia')->middleware(['auth', '2fa']);
//RUTAS PARA directooooooor--------------------------------------------------------------------------------------------------------------------------------------
        ///rutas para cambiar datos director
        //cargar datos director   editar
            Route::get('/director/editarDatosDirector/{email}',[DirecionDirectorController::class,'editarDatosDirector'])->name('director.editarDatosDirector')->middleware(['auth', '2fa']);
        //actualiza datos director
            Route::post('director/actualizarDirector',[DirecionDirectorController::class,'actualizarDirector'])->name('director.actualizarDirector')->middleware(['auth', '2fa']);
        // cambiar contraseña director
            /*Route::get('/changeAdminDirector', function () {
                return view('DIRECTOR/DATOSDIRECTOR/cambiarPasswordDirector');
            });*/
            Route::get('/changeAdminDirector',[DirecionDirectorController::class,'cambiarAdminDirector'])->name('changeAdminDirector.cambiarAdminDirector')->middleware(['auth', '2fa']);
            Route::post('director/cambiarPassDirector',[DirecionDirectorController::class,'cambiarPassDirector'])->name('director.cambiarPassDirector')->middleware(['auth', '2fa']);
            Route::post('director/changeImage',[DirecionDirectorController::class,'changeImage'])->name('director.changeImage')->middleware(['auth', '2fa']);
        //silabo pdf
            /*Route::get('/silabosPendientess', function () {
                return view('DIRECTOR.SILABOS.silabosDirector');
            });*/
            Route::get('/silabosPendientess',[SilaboController::class,'silabosPendientesVista'])->name('silabosPendientess.silabosPendientesVista')->middleware(['auth', '2fa']);
            Route::get('/silabosPendientes',[SilaboController::class,'silabosPendientes'])->name('director.silabosPendientes')->middleware(['auth', '2fa']);
            Route::get('/silabosTodos',[SilaboController::class,'silabosTodos'])->name('director.silabosTodos')->middleware(['auth', '2fa']);
            Route::get('/director/mostrarDatosInfoDir/{id}',[SilaboController::class,'mostrarDatosInfoDir'])->name('director.mostrarDatosInfoDir')->middleware(['auth', '2fa']);
            Route::get('/director/silaboDocente/{id}',[SilaboController::class,'silaboDocente'])->name('director.silaboDocente')->middleware(['auth', '2fa']);
            Route::get('/director/aprobarSilabo/{id}',[SilaboController::class,'aprobarSilabo'])->name('director.aprobarSilabo')->middleware(['auth', '2fa']);
            Route::get('/director/pendienteSilabo/{id}',[SilaboController::class,'pendienteSilabo'])->name('director.pendienteSilabo')->middleware(['auth', '2fa']);
            Route::post('/director/revisarSilabo',[SilaboController::class,'revisarSilabo'])->name('director.revisarSilabo')->middleware(['auth', '2fa']);
            Route::get('/director/cargarTablaP/{id}',[SilaboController::class,'cargarTablaP'])->name('director.cargarTablaP')->middleware(['auth', '2fa']);
        //periodos academicos 
            Route::get('/director/periodosAcademicos',[PeriodoAcademicoController::class,'periodosAcademicos'])->name('director.periodosAcademicos')->middleware(['auth', '2fa']);
          //
//RUTAS PARA inspector--------------------------------------------------------------------------------------------------------------------------------------
    ///rutas para cambiar datos inspector
        //cargar datos inspector   editar
            Route::get('/inspector/editarDatosInspector/{email}',[DireccionInspectorController::class,'editarDatosInspector'])->name('inspector.editarDatosInspector')->middleware(['auth', '2fa']);
        //actualiza datos inspector
            Route::post('inspector/actualizarInspector',[DireccionInspectorController::class,'actualizarInspector'])->name('inspector.actualizarInspector')->middleware(['auth', '2fa']);
        // cambiar contraseña inspector
            /*Route::get('/changeAdminInspector', function () {
                return view('INSPECTOR/DATOSINSPECTOR/cambiarPasswordInspector');
            });*/
            Route::get('/changeAdminInspector',[DireccionInspectorController::class,'cambiarClaveVista'])->name('changeAdminInspector.cambiarClaveVista')->middleware(['auth', '2fa']);
            Route::post('inspector/cambiarPassInspector',[DireccionInspectorController::class,'cambiarPassInspector'])->name('inspector.cambiarPassInspector')->middleware(['auth', '2fa']);
            Route::post('inspector/changeImage',[DireccionInspectorController::class,'changeImage'])->name('director.changeImage')->middleware(['auth', '2fa']);
//RUTAS PARA estudiantes--------------------------------------------------------------------------------------------------------------------------------------
        //crag docente  a editar
            Route::get('/datosEstudiante/editarDatos/{email}',[EstudianteController::class,'editarDatos'])->name('datosEstudiante.editarDatos')->middleware(['auth', '2fa']);
        //actualiza datos docente
            Route::post('/estudiantes/actualizarE',[EstudianteController::class,'actualizarE'])->name('estudiantes.actualizarE')->middleware(['auth', '2fa']);
        // cambiar contraseña
            /*Route::get('/changeEstudiante', function () {
                return view('ESTUDIANTE/DATOSESTUDIANTE/cambiarPasswordEstudiante');
            });*/
            Route::get('/changeEstudiante',[EstudianteController::class,'cambiarClaveVista'])->name('changeEstudiante.cambiarClaveVista')->middleware(['auth', '2fa']);
            Route::post('/estudiantes/cambiarPass',[EstudianteController::class,'cambiarPass'])->name('estudiantes.cambiarPass')->middleware(['auth', '2fa']);
            Route::post('/estudiantes/changeImage',[EstudianteController::class,'changeImage'])->name('estudiantes.changeImage')->middleware(['auth', '2fa']);
        //rutas para silabos estudiantes
            Route::get('/estudiantes/silabosEstudiante',[SilaboController::class,'silabosEstudiante'])->name('estudiantes.silabosEstudiante')->middleware(['auth', '2fa']);
            Route::get('/estudiantes/silabosEstudianteMostrar/{id}',[SilaboController::class,'silabosEstudianteMostrar'])->name('estudiantes.silabosEstudianteMostrar')->middleware(['auth', '2fa']);
            Route::get('/estudiantes/descargarSilaboEstudiante/{id}',[SilaboController::class,'descargarSilaboEstudiante'])->name('estudiantes.descargarSilaboEstudiante')->middleware(['auth', '2fa']);
        //mostrar horario estudiante 
            Route::get('/horarioest',[HorarioController::class,'horarioEstudiante'])->name('horarioest.horarioEstudiante')->middleware(['auth', '2fa']);
            Route::get('/descargarHorarioEstudiante/{id}',[HorarioController::class,'descargarHorarioEstudiante'])->name('descargarHorarioEst.descargarHorarioEstudiante')->middleware(['auth', '2fa']);
            Route::get('/estudianteHorario/cargarPerHorariosEst/{id}',[HorarioController::class,'cargarPerHorariosEst'])->name('estudianteHorario.cargarPerHorariosEst')->middleware(['auth', '2fa']);
            Route::get('/estudianteHorario/cargartablahorarioEst/{id}',[HorarioController::class,'cargartablahorarioEst'])->name('estudianteHorario.cargartablahorarioEst')->middleware(['auth', '2fa']);
        //NOtas de estudiante
            Route::get('/notasEstudiante',[NotasController::class,'notasEstudiante'])->name('notasEstudiante.notasEstudiante')->middleware(['auth', '2fa']);
            Route::get('/notasEstudiante/notasEstudianteMostrar/{id}',[NotasController::class,'notasEstudianteMostrar'])->name('notasEstudiante.notasEstudianteMostrar')->middleware(['auth', '2fa']);
        //notas grado estudaiNTE
            Route::get('/notasGradoE',[NotasController::class,'notasGradoE'])->name('notasGradoE.notasGradoE')->middleware(['auth', '2fa']);
            Route::get('/notasGradoEstudianteMostrar/{id}',[NotasController::class,'notasGradoEstudianteMostrar'])->name('notasGradoEstudianteMostrar.notasGradoEstudianteMostrar')->middleware(['auth', '2fa']);
        //Evaluacion docentes
            Route::get('/evaluacionDocentes',[EvaluacionController::class,'evaluacionPeriodos'])->name('evaluacionDocentes.evaluacionPeriodos')->middleware(['auth', '2fa']);
            Route::get('/evaluacionEstudiante/{id}',[EvaluacionController::class,'evaluacionCursoEstudiante'])->name('evaluacionEstudiante.evaluacionCursoEstudiante')->middleware(['auth', '2fa']);
            Route::get('/evaluacionDocentes/tablaEvaluacion/{id}',[EvaluacionController::class,'tablaEvaluacion'])->name('evaluacionDocentes.tablaEvaluacion')->middleware(['auth', '2fa']);
            Route::get('/evaluacionDocentes/evalularDocente/{id}',[EvaluacionController::class,'evalularDocente'])->name('evaluacionDocentes.evalularDocente')->middleware(['auth', '2fa']);
        //asistencia de estudiante
            Route::get('/asistenciaEstudiante',[AsistenciaController::class,'indexAsistenciaEstudiante'])->name('asistenciaEstudiante.indexAsistenciaEstudiante')->middleware(['auth', '2fa']);
            Route::get('/asistenciaEstudiante/tablaAsistencia/{id}',[AsistenciaController::class,'tablaAsistencia'])->name('asistenciaEstudiante.tablaAsistencia')->middleware(['auth', '2fa']);
            Route::get('/asistenciaEstudiante/pdfAsistenciaEstudiante/{idM}/{idDocMod}',[AsistenciaController::class,'pdfAsistenciaEstudiante'])->name('asistenciaEstudiante.pdfAsistenciaEstudiante')->middleware(['auth', '2fa']);
//ruta de secretaria----------------------------------------------------------------------------------------------------------
             //cargar datos secretyaria   editar
             Route::get('/secretaria/editarDatosSecretaria/{email}',[SecretariaController::class,'editarDatosSecretaria'])->name('secretaria.editarDatosSecretaria')->middleware(['auth', '2fa']);
             //actualiza datos secretaria
                 Route::post('secretaria/actualizarSecretaria',[SecretariaController::class,'actualizarSecretaria'])->name('secretaria.actualizarSecretaria')->middleware(['auth', '2fa']);
             // cambiar contraseña secretaria
                 /*Route::get('/changeAdminSecretaria', function () {
                     return view('SECRETARIA/DATOSSECRETARIA/cambiarPasswordSecretaria');
                 });*/
                 Route::get('/changeAdminSecretaria',[SecretariaController::class,'cambiarClaveVista'])->name('changeAdminSecretaria.cambiarClaveVista')->middleware(['auth', '2fa']);
                 Route::post('/secretaria/cambiarPassSecretaria',[SecretariaController::class,'cambiarPassSecretaria'])->name('secretaria.cambiarPassSecretaria')->middleware(['auth', '2fa']);
                 Route::post('/secretaria/changeImage',[SecretariaController::class,'changeImage'])->name('secretaria.changeImage')->middleware(['auth', '2fa']);
            //NOTAS SECRETARIA
                Route::get('/notasSecretarias',[NotasController::class,'indexVistaSecretaria'])->name('notasSecretarias.indexVistaSecretaria')->middleware(['auth', '2fa']);
                Route::get('/notasSecretaria',[NotasController::class,'indexSecretaria'])->name('notasSecretaria.indexSecretaria')->middleware(['auth', '2fa']);
                Route::get('/notasSecretaria/selectPeriodosSecretaria',[NotasController::class,'selectPeriodosSecretaria'])->name('notasSecretaria.selectPeriodosSecretaria')->middleware(['auth', '2fa']);
                Route::get('/notasSecretaria/selectCursosSecretaria/{id}',[NotasController::class,'selectCursosSecretaria'])->name('notasSecretaria.selectCursosSecretaria')->middleware(['auth', '2fa']);
                Route::get('/notasSecretaria/selectModulosSecretaria/{idP}/{idCur}',[NotasController::class,'selectModulosSecretaria'])->name('notasSecretaria.selectModulosSecretaria')->middleware(['auth', '2fa']);
                Route::get('/notasSecretaria/tablaEstudiantesSecretaria/{idP}/{idCur}/{idMod}',[NotasController::class,'tablaEstudiantesSecretaria'])->name('notasSecretaria.tablaEstudiantesSecretaria')->middleware(['auth', '2fa']);
                Route::get('/notasSecretaria/mostrarCalificarEstudiante/{idDoc}/{idMat}',[NotasController::class,'mostrarCalificarEstudiante'])->name('notasSecretaria.mostrarCalificarEstudiante')->middleware(['auth', '2fa']);
            //asistencias secretaria
                Route::get('/secretaria/asistenciaEstudianteSe',[AsistenciaController::class,'indexVistaSecretaria'])->name('asistenciaEstudianteSe.indexVistaSecretaria')->middleware(['auth', '2fa']);
                Route::get('/secretaria/asistenciasEstudiantesSe',[AsistenciaController::class,'indexSecretaria'])->name('asistenciasEstudiantesSe.indexSecretaria')->middleware(['auth', '2fa']);
                Route::get('/secretaria/asistenciasEstudiantesSe/selectPeriodosSecretaria',[AsistenciaController::class,'selectPeriodosSecretaria'])->name('asistenciasEstudiantesSe.selectPeriodosSecretaria')->middleware(['auth', '2fa']);
                Route::get('/secretaria/asistenciasEstudiantesSe/selectCursosSecretaria/{id}',[AsistenciaController::class,'selectCursosSecretaria'])->name('asistenciasEstudiantesSe.selectCursosSecretaria')->middleware(['auth', '2fa']);
                Route::get('/secretaria/asistenciasEstudiantesSe/selectModulosSecretaria/{idP}/{idCur}',[AsistenciaController::class,'selectModulosSecretaria'])->name('asistenciasEstudiantesSe.selectModulosSecretaria')->middleware(['auth', '2fa']);
                Route::get('/secretaria/asistenciasEstudiantesSe/selectEstudiantes/{idP}/{idCur}/{idDocMod}',[AsistenciaController::class,'selectEstudiantes'])->name('asistenciasEstudiantesSe.selectEstudiantes')->middleware(['auth', '2fa']);
                Route::get('/secretaria/asistenciasEstudiantesSe/tablaAsistenciaEstudiantesSecretaria/{idP}/{id_est}/{idDocMod}',[AsistenciaController::class,'tablaAsistenciaEstudiantesSecretaria'])->name('asistenciasEstudiantesSe.tablaAsistenciaEstudiantesSecretaria')->middleware(['auth', '2fa']);
                Route::get('/secretaria/estadosAsisntenciasSe/cambiarEstadoSecretaria/{id}/{estado}',[AsistenciaController::class,'cambiarEstadoSecretaria'])->name('estadosAsisntenciasSe.cambiarEstadoSecretaria')->middleware(['auth', '2fa']);
            //exportar excel asistencias por modulo
                Route::get('/asistenciasModulos',[AsistenciaController::class,'vistaAsistenciasModulos'])->name('asistenciasModulos.vistaAsistenciasModulos')->middleware(['auth', '2fa']);
                Route::get('/secretaria/reporteAsistenciasModulos/{idP}/{idDocMod}',[AsistenciaController::class,'reporteAsistenciasModulos'])->name('secretaria.reporteAsistenciasModulos')->middleware(['auth', '2fa']);
                Route::get('/secretaria/descargarAsistenciasModulos/{idP}/{idDocMod}',[AsistenciaController::class,'descargarAsistenciasModulos'])->name('secretaria.descargarAsistenciasModulos')->middleware(['auth', '2fa']);
             //exportar excel asistencias
                Route::get('/vistaAsistenciasEstudiantes',[AsistenciaController::class,'vistaAsistenciaEst'])->name('vistaAsistenciasEstudiantes.vistaAsistenciaEst')->middleware(['auth', '2fa']);
                Route::get('/secretaria/reporteAsistencias/{idP}',[AsistenciaController::class,'reporteAsistencias'])->name('secretaria.reporteAsistencias')->middleware(['auth', '2fa']);
                Route::get('/secretaria/descargarAsistencias/{idP}',[AsistenciaController::class,'descargarAsistencias'])->name('secretaria.descargarAsistencias')->middleware(['auth', '2fa']);
            //exportar excel notas
                Route::get('/vistaNotasEstudiantes',[NotasController::class,'vistaNotaEst'])->name('vistaNotasEstudiantes.vistaNotaEst')->middleware(['auth', '2fa']);
                Route::get('/notasPeriodo/{idP}',[NotasController::class,'tablaNotasPeriodoAcademico'])->name('notasPeriodo.tablaNotasPeriodoAcademico')->middleware(['auth', '2fa']);
                Route::get('/descargarNotasGenerales/{idP}',[NotasController::class,'exportNotasGenerales'])->name('descargarNotasGenerales.exportNotasGenerales')->middleware(['auth', '2fa']);
             //exportar excel actas
                Route::get('/secretaria/vistaActasEstudiantes',[NotasController::class,'vistaActasEstudiantes'])->name('secretaria.vistaActasEstudiantes')->middleware(['auth', '2fa']);
                Route::get('/secretaria/tablaActasEstudiantes/{idP}',[NotasController::class,'tablaActasEstudiantes'])->name('secretaria.tablaActasEstudiantes')->middleware(['auth', '2fa']);
                Route::get('/secretaria/mostrarCalificarActa/{idMat}',[NotasController::class,'mostrarCalificarActa'])->name('secretaria.mostrarCalificarActa')->middleware(['auth', '2fa']);
                Route::post('/secretaria/ingresarNotasActa',[NotasController::class,'ingresarNotasActa'])->name('secretaria.ingresarNotasActa')->middleware(['auth', '2fa']);
                Route::post('/secretaria/actualizarNotasActa',[NotasController::class,'actualizarNotasActa'])->name('secretaria.actualizarNotasActa')->middleware(['auth', '2fa']);
                Route::get('/secretaria/descargarActaNotas/{idP}',[NotasController::class,'descargarActaNotas'])->name('secretaria.descargarActaNotas')->middleware(['auth', '2fa']);
//------------------------------------------------------------------------------------------------------------------AUTHENTICATION 2FA
                Route::group(['prefix'=>'2fa'], function(){
                    Route::get('/',[LoginSecurityController::class,'show2faForm'])->middleware(['auth', '2fa']);
                    Route::post('/generateSecret',[LoginSecurityController::class,'generate2faSecret'])->name('generate2faSecret')->middleware(['auth', '2fa']);
                    Route::post('/enable2fa',[LoginSecurityController::class,'enable2fa'])->name('enable2fa')->middleware(['auth', '2fa']);
                    Route::post('/disable2fa',[LoginSecurityController::class,'disable2fa'])->name('disable2fa')->middleware(['auth', '2fa']);
                    // 2fa middleware
                    Route::post('/2faVerify', function () {
                        return redirect(URL()->previous());
                    })->name('2faVerify')->middleware('2fa');
                });
////////////////MANUALES DE USUARIO 
                Route::get('/manual/manualEstudiante',[EstudianteController::class,'manualEstudiante'])->name('manual.manualEstudiante')->middleware(['auth', '2fa']);
                Route::get('/manual/manualDocente',[DocenteController::class,'manualDocente'])->name('manual.manualDocente')->middleware(['auth', '2fa']);
                Route::get('/manual/manualDirector',[DirecionDirectorController::class,'manualDirector'])->name('manual.manualDirector')->middleware(['auth', '2fa']);
                Route::get('/manual/manualInspector',[DireccionInspectorController::class,'manualInspector'])->name('manual.manualInspector')->middleware(['auth', '2fa']);
                Route::get('/manual/manualSecretaria',[SecretariaController::class,'manualSecretaria'])->name('manual.manualSecretaria')->middleware(['auth', '2fa']);
                Route::get('/manual/manualAdmin',[UserController::class,'manualAdmin'])->name('manual.manualAdmin')->middleware(['auth', '2fa']);