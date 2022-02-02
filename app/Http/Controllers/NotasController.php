<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//procedimientos bd
use Illuminate\Support\Collection;
use DataTables;
use App\Models\Notas;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NotasExport; 
use App\Exports\ActasExport; 

class NotasController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function indexVistaSecretaria(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            
            return view('SECRETARIA.NOTAS.indexNotas');
        }
        else{
            return redirect("/home");
        }
    } 
    public function indexSecretaria(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            if($request->ajax())
            {
                $notasDoc=DB::select('select notas.id_nota,modulo.nombre_mod,periodoacademico.fechaini,periodoacademico.fechafin,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,paralelos.nombre_paralelo,notas.nota_trabajo_equipo,notas.nota_estudio_caso,notas.nota_prueba_practica,notas.nota_prueba_teorica,notas.nota_suspenso,estudiante.apellido_est,estudiante.name_est from notas
                inner join docente_modulo on docente_modulo.id_doc_mod = notas.id_doc_mod
                inner join modulo on modulo.id_mod = docente_modulo.id_mod
                inner join docente on docente.id_doc = docente_modulo.id_doc
                inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
                inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
                inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
                inner join matricula on matricula.id_matricula = notas.id_matricula
                inner join estudiante on matricula.id_est = estudiante.id_est
                inner join periodoacademico on periodoacademico.id = matricula.id_periodo');
                
                return DataTables::of($notasDoc)
                ->addColumn('action',function($notasDoc){
                    
                    $acciones='<div class="p-1"><button type="button" name="delete" id="'.$notasDoc->id_nota.'"  class="delete btn btn-danger  btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.NOTAS.indexNotas');
        }
        else{
            return redirect("/home");
        }
    } 
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            
            return view('DOCENTE.NOTAS.indexNotas');
        }
        else{
            return redirect("/home");
        }
    } 
    public function index(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            if($request->ajax())
            {
                $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
                $notasDoc=DB::select('select notas.id_nota,modulo.nombre_mod,periodoacademico.fechaini,periodoacademico.fechafin,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,paralelos.nombre_paralelo,notas.nota_trabajo_equipo,notas.nota_estudio_caso,notas.nota_prueba_practica,notas.nota_prueba_teorica,notas.nota_suspenso,estudiante.apellido_est,estudiante.name_est from notas
                inner join docente_modulo on docente_modulo.id_doc_mod = notas.id_doc_mod
                inner join modulo on modulo.id_mod = docente_modulo.id_mod
                inner join docente on docente.id_doc = docente_modulo.id_doc
                inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
                inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
                inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
                inner join matricula on matricula.id_matricula = notas.id_matricula
                inner join estudiante on matricula.id_est = estudiante.id_est
                inner join periodoacademico on periodoacademico.id = matricula.id_periodo
                where docente.id_doc=?',[$idDoc]);
                
                return DataTables::of($notasDoc)
                ->addColumn('action',function($notasDoc){
                    
                    $acciones='<div class="p-1"><button type="button" name="delete" id="'.$notasDoc->id_nota.'"  class="delete btn btn-danger  btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.NOTAS.indexNotas');
        }
        else{
            return redirect("/home");
        }
    } 
    public function selectPeriodos()
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $periodosaca=DB::select("select DISTINCT periodoacademico.id,periodoacademico.fechaini,periodoacademico.fechafin,periodoacademico.nombre_tipolicencia from docentemodulo_horario
            inner join docente_modulo on docente_modulo.id_doc_mod = docentemodulo_horario.id_doc_mod
            inner join docente on docente_modulo.id_doc = docente.id_doc

            inner join modulo on docente_modulo.id_mod=modulo.id_mod
            inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
			inner join matricula on matricula.id_curlic=cursolicencia.id_curlic
			inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            where docente.id_doc=?
            order by periodoacademico.fechaini desc",[$idDoc]);
            return response()->json($periodosaca);  
        }
        else{
            return redirect("/home");
        }
    }
    public function selectCursos($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $cursos=DB::select("select DISTINCT cursolicencia.id_curlic,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,cursolicencia.duracion_meses,paralelos.nombre_paralelo from matricula
            inner join cursolicencia on matricula.id_curlic = cursolicencia.id_curlic
			inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
			inner join periodoacademico on periodoacademico.id=matricula.id_periodo
			where docente_modulo.id_doc=? and periodoacademico.id=?
			order by tipolicencia.nombre_tlic asc",[$idDoc,$id]);
            return response()->json($cursos);  
        }
        else{
            return redirect("/home");
        }
    }
    public function selectModulos($idP,$idCur)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
           
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $modulos=DB::select("select DISTINCT docente_modulo.id_doc_mod,modulo.id_mod,modulo.nombre_mod from matricula
            inner join cursolicencia on matricula.id_curlic = cursolicencia.id_curlic
			inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
			inner join modulo on modulo.id_mod = docente_modulo.id_mod
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo

            inner join docentemodulo_horario on docentemodulo_horario.id_doc_mod=docente_modulo.id_doc_mod
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo	
			where docente_modulo.id_doc=? and periodoacademico.id=? and cursolicencia.id_curlic=?
			order by modulo.nombre_mod asc",[$idDoc,$idP,$idCur]);
            return response()->json($modulos);  
        }
        else{
            return redirect("/home");
        }
    }
    public function tablaEstudiantes($idP,$idCur,$idMod)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $estudiantes=DB::select("select   estudiante.id_est,estudiante.apellido_est,estudiante.name_est,docente_modulo.id_doc_mod,m.id_matricula,periodoacademico.id,cursolicencia.id_curlic,(select notas.nota_trabajo_equipo from matricula as mat
                    inner join notas on mat.id_matricula = notas.id_matricula
                    inner join docente_modulo on docente_modulo.id_doc_mod = notas.id_doc_mod
                    where docente_modulo.id_doc_mod=? and mat.id_matricula=m.id_matricula)as nota_trabajo_equipo,(select notas.nota_estudio_caso from matricula as mat
                    inner join notas on mat.id_matricula = notas.id_matricula
                    inner join docente_modulo on docente_modulo.id_doc_mod = notas.id_doc_mod
                    where docente_modulo.id_doc_mod=? and mat.id_matricula=m.id_matricula)as nota_estudio_caso,(select notas.nota_prueba_practica from matricula as mat
                    inner join notas on mat.id_matricula = notas.id_matricula
                    inner join docente_modulo on docente_modulo.id_doc_mod = notas.id_doc_mod
                    where docente_modulo.id_doc_mod=? and mat.id_matricula=m.id_matricula)as nota_prueba_practica,(select notas.nota_prueba_teorica from matricula as mat
                    inner join notas on mat.id_matricula = notas.id_matricula
                    inner join docente_modulo on docente_modulo.id_doc_mod = notas.id_doc_mod
                    where docente_modulo.id_doc_mod=? and mat.id_matricula=m.id_matricula)as nota_prueba_teorica,(select notas.nota_suspenso from matricula as mat
                    inner join notas on mat.id_matricula = notas.id_matricula
                    inner join docente_modulo on docente_modulo.id_doc_mod = notas.id_doc_mod
                    where docente_modulo.id_doc_mod=? and mat.id_matricula=m.id_matricula)as nota_suspenso from matricula as m
            inner join estudiante on estudiante.id_est = m.id_est
            inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
            inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
            inner join periodoacademico on periodoacademico.id=m.id_periodo
            where periodoacademico.id=? and  cursolicencia.id_curlic=? and docente_modulo.id_doc_mod=?
            order by estudiante.apellido_est asc",[$idMod,$idMod,$idMod,$idMod,$idMod,$idP,$idCur,$idMod]);

            return view('DOCENTE.NOTAS.tablaEstudiantes')->with('estudiantes',$estudiantes);
           
        }
        else{
            return redirect("/home");
        }
    }
    public function mostrarCalificarEstudiante($idDoc,$idMat)
    {
        if (((auth()->check()) && (auth()->user()->rol=="3"))||((auth()->check()) && (auth()->user()->rol=="6")))
        {  
            $nota = DB::table('notas')
            ->join('matricula', 'matricula.id_matricula', '=', 'notas.id_matricula')
            ->join('docente_modulo', 'docente_modulo.id_doc_mod', '=', 'notas.id_doc_mod')
            ->select('*')
            ->where('docente_modulo.id_doc_mod', '=', $idDoc)
            ->where('matricula.id_matricula', '=', $idMat)
            ->get();
            $idDoc2["idDocMod"]=$idDoc;
            $idMat2["idMatricula"]=$idMat;
            $datose = Arr::collapse([$nota,$idDoc2,$idMat2]);
            return response()->json($datose);
            //return view('DOCENTE.NOTAS.tablaEstudiantes')->with('estudiantes',$estudiantes);
           
        }
        else{
            return redirect("/home");
        }
    }
    public function ingresar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="3"))||((auth()->check()) && (auth()->user()->rol=="6")))
        {
            $now = new \DateTime("America/Guayaquil");
            $fechaactual=$now->format('Y-m-d');
            $periodoactual=DB::select("select * from matricula
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            where matricula.id_matricula=? and ? >= periodoacademico.fechaini and ? <= periodoacademico.fechafin"
            ,[$request->id_matricula,$fechaactual,$fechaactual]);
            if($periodoactual)
            { 
                $nota=DB::select('CALL insertarNota(?,?,?,?,?,?,?)',
                [$request->nota_trabajo_equipo,$request->nota_estudio_caso ,$request->nota_prueba_practica ,$request->nota_prueba_teorica ,$request->nota_suspenso ,$request->id_doc_mod,$request->id_matricula]);
                return  true;
            }
            else{
                return false;
            }
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="3"))||((auth()->check()) && (auth()->user()->rol=="6")))
        {
            $now = new \DateTime("America/Guayaquil");
            $fechaactual=$now->format('Y-m-d');
            $periodoactual=DB::select("select * from notas
            inner join matricula on matricula.id_matricula=notas.id_matricula
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            where notas.id_nota=? and ? >= periodoacademico.fechaini and ? <= periodoacademico.fechafin",[$request->id_nota,$fechaactual,$fechaactual]);
            if($periodoactual)
            {
                $notas=DB::select('CALL actualizarNota(?,?,?,?,?,?,?,?)',
                [$request->id_nota,$request->nota_trabajo_equipo,$request->nota_estudio_caso ,$request->nota_prueba_practica ,$request->nota_prueba_teorica ,$request->nota_suspenso ,$request->id_doc_mod,$request->id_matricula]);
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return redirect("/home");
        }
        
    }
    public function eliminar($id){
        if (((auth()->check()) && (auth()->user()->rol=="3"))||((auth()->check()) && (auth()->user()->rol=="6")))
        {
            $now = new \DateTime("America/Guayaquil");
            $fechaactual=$now->format('Y-m-d');
            $periodoactual=DB::select("select * from notas
            inner join matricula on matricula.id_matricula=notas.id_matricula
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            where notas.id_nota=? and ? >= periodoacademico.fechaini and ? <= periodoacademico.fechafin",[$id,$fechaactual,$fechaactual]);
            if($periodoactual)
            {
                $nota=DB::select('call eliminarNota(?)',[$id]);
                return true;
            }
          else{
              return false;
          }
        }
        else{
            return redirect("/home");
        }
    }
    public function notasEstudiante()
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
            $idEst= DB::table('estudiante')
            ->select('id_est')
            ->where('email_est', auth()->user()->email)
            ->first()
            ->id_est;
           $periodos['periodosacademicos'] =  DB::table('matricula')
           ->join('periodoacademico','matricula.id_periodo', '=', 'periodoacademico.id')
           ->join('estudiante','estudiante.id_est', '=', 'matricula.id_est')
           ->select('*')
           ->where('estudiante.id_est', $idEst)
           ->orderBy('fechaini', 'desc')
           ->get();
           return view('ESTUDIANTE.NOTA.notaEstudiante',$periodos);
           //return response()->json($periodosacademicos);
           
        }
        else{
            return redirect("/home");
        }
    }
    public function notasEstudianteMostrar($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
                $idEst= DB::table('estudiante')
                ->select('id_est')
                ->where('email_est', auth()->user()->email)
                ->first()
                ->id_est;
                $curso= DB::table('matricula')
                ->select('id_curlic')
                ->where('id_periodo',$id)
                ->where('id_est',$idEst)
                ->first()
                ->id_curlic;
                $notas=DB::select('select distinct modulo.id_mod,modulo.nombre_mod,periodoacademico.id,estudiante.id_est,(select notas.nota_trabajo_equipo from notas
                            inner join matricula as m on m.id_matricula=notas.id_matricula
                            inner join docente_modulo as dm on dm.id_doc_mod=notas.id_doc_mod
                            where dm.id_doc_mod=docente_modulo.id_doc_mod and m.id_matricula =matricula.id_matricula ) as nota_trabajo_equipo,(select notas.nota_estudio_caso from notas
                                inner join matricula as m on m.id_matricula=notas.id_matricula
                                inner join docente_modulo as dm on dm.id_doc_mod=notas.id_doc_mod
                                where dm.id_doc_mod=docente_modulo.id_doc_mod and m.id_matricula =matricula.id_matricula ) as nota_estudio_caso,(select notas.nota_prueba_practica from notas
                            inner join matricula as m on m.id_matricula=notas.id_matricula
                            inner join docente_modulo as dm on dm.id_doc_mod=notas.id_doc_mod
                            where dm.id_doc_mod=docente_modulo.id_doc_mod and m.id_matricula =matricula.id_matricula ) as nota_prueba_practica,(select notas.nota_prueba_teorica from notas
                            inner join matricula as m on m.id_matricula=notas.id_matricula
                            inner join docente_modulo as dm on dm.id_doc_mod=notas.id_doc_mod
                            where dm.id_doc_mod=docente_modulo.id_doc_mod and m.id_matricula =matricula.id_matricula ) as nota_prueba_teorica,(select notas.nota_suspenso from notas
                            inner join matricula as m on m.id_matricula=notas.id_matricula
                            inner join docente_modulo as dm on dm.id_doc_mod=notas.id_doc_mod
                            where dm.id_doc_mod=docente_modulo.id_doc_mod and m.id_matricula =matricula.id_matricula ) as nota_suspenso from matricula
                inner join cursolicencia on cursolicencia.id_curlic =matricula.id_curlic
                inner join docente_modulo on docente_modulo.id_curlic =cursolicencia.id_curlic
                inner join tipolicencia on cursolicencia.id_tlic =tipolicencia.id_tlic
                inner join paralelos on paralelos.id_paralelo =cursolicencia.id_paralelo
                inner join modulo on modulo.id_mod =docente_modulo.id_mod
                inner join docentemodulo_horario on docentemodulo_horario.id_doc_mod=docente_modulo.id_doc_mod
                inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
                inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo	
                inner join estudiante on estudiante.id_est=matricula.id_est
                where periodoacademico.id=? and estudiante.id_est=? and cursolicencia.id_curlic=?
                order by modulo.nombre_mod',[$id,$idEst,$curso]);
            //return view('ESTUDIANTE.SILABO.tablaSilabos');
            return view('ESTUDIANTE.NOTA.tablaNotaEstudiante')->with('notas',$notas);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function vistaNotaEst()
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            return view('SECRETARIA.REPORTES.vistaNotas');
        }
        else{
            return redirect("/home");
        }
    } 
    public function selectPeriodosSecretaria()
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            $periodosaca=DB::select("select DISTINCT periodoacademico.id,periodoacademico.fechaini,periodoacademico.fechafin,periodoacademico.nombre_tipolicencia from docentemodulo_horario
            inner join docente_modulo on docente_modulo.id_doc_mod = docentemodulo_horario.id_doc_mod
            inner join docente on docente_modulo.id_doc = docente.id_doc
            inner join modulo on docente_modulo.id_mod=modulo.id_mod
            inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
			inner join matricula on matricula.id_curlic=cursolicencia.id_curlic
			inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            order by periodoacademico.fechaini desc");
            return response()->json($periodosaca);  
        }
        else{
            return redirect("/home");
        }
    }
    public function selectCursosSecretaria($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            
            $cursos=DB::select("select DISTINCT cursolicencia.id_curlic,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,cursolicencia.duracion_meses,paralelos.nombre_paralelo from matricula
            inner join cursolicencia on matricula.id_curlic = cursolicencia.id_curlic
			inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
			inner join periodoacademico on periodoacademico.id=matricula.id_periodo
			where periodoacademico.id=?
			order by tipolicencia.nombre_tlic asc",[$id]);
            return response()->json($cursos);  
        }
        else{
            return redirect("/home");
        }
    }
    public function selectModulosSecretaria($idP,$idCur)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            $modulos=DB::select("select DISTINCT docente_modulo.id_doc_mod,modulo.id_mod,modulo.nombre_mod from matricula
            inner join cursolicencia on matricula.id_curlic = cursolicencia.id_curlic
			inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
			inner join modulo on modulo.id_mod = docente_modulo.id_mod
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo

            inner join docentemodulo_horario on docentemodulo_horario.id_doc_mod=docente_modulo.id_doc_mod
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo	
			where periodoacademico.id=? and cursolicencia.id_curlic=?
			order by modulo.nombre_mod asc",[$idP,$idCur]);
            return response()->json($modulos);  
        }
        else{
            return redirect("/home");
        }
    }
    public function tablaEstudiantesSecretaria($idP,$idCur,$idMod)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            $estudiantes=DB::select("select   estudiante.id_est,estudiante.apellido_est,estudiante.name_est,docente_modulo.id_doc_mod,m.id_matricula,periodoacademico.id,cursolicencia.id_curlic,(select notas.nota_trabajo_equipo from matricula as mat
                    inner join notas on mat.id_matricula = notas.id_matricula
                    inner join docente_modulo on docente_modulo.id_doc_mod = notas.id_doc_mod
                    where docente_modulo.id_doc_mod=? and mat.id_matricula=m.id_matricula)as nota_trabajo_equipo,(select notas.nota_estudio_caso from matricula as mat
                    inner join notas on mat.id_matricula = notas.id_matricula
                    inner join docente_modulo on docente_modulo.id_doc_mod = notas.id_doc_mod
                    where docente_modulo.id_doc_mod=? and mat.id_matricula=m.id_matricula)as nota_estudio_caso,(select notas.nota_prueba_practica from matricula as mat
                    inner join notas on mat.id_matricula = notas.id_matricula
                    inner join docente_modulo on docente_modulo.id_doc_mod = notas.id_doc_mod
                    where docente_modulo.id_doc_mod=? and mat.id_matricula=m.id_matricula)as nota_prueba_practica,(select notas.nota_prueba_teorica from matricula as mat
                    inner join notas on mat.id_matricula = notas.id_matricula
                    inner join docente_modulo on docente_modulo.id_doc_mod = notas.id_doc_mod
                    where docente_modulo.id_doc_mod=? and mat.id_matricula=m.id_matricula)as nota_prueba_teorica,(select notas.nota_suspenso from matricula as mat
                    inner join notas on mat.id_matricula = notas.id_matricula
                    inner join docente_modulo on docente_modulo.id_doc_mod = notas.id_doc_mod
                    where docente_modulo.id_doc_mod=? and mat.id_matricula=m.id_matricula)as nota_suspenso from matricula as m
            inner join estudiante on estudiante.id_est = m.id_est
            inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
            inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
            inner join periodoacademico on periodoacademico.id=m.id_periodo
            where periodoacademico.id=? and  cursolicencia.id_curlic=? and docente_modulo.id_doc_mod=?
            order by estudiante.apellido_est asc",[$idMod,$idMod,$idMod,$idMod,$idMod,$idP,$idCur,$idMod]);

            return view('SECRETARIA.NOTAS.tablaEstudiantes')->with('estudiantes',$estudiantes);
           
        }
        else{
            return redirect("/home");
        }
    }
    
    public function notasPeriodoAcademico($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            return view('SECRETARIA.REPORTES.indexNotas');
        }
        else{
            return redirect("/home");
        }

    } 
    public function tablaNotasPeriodoAcademico($idP)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            $estudiantes=DB::select("select cursolicencia.id_curlic,docente_modulo.id_doc_mod,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas.nota_trabajo_equipo from matricula as mat1
                    inner join notas on mat1.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm1 on dm1.id_doc_mod = notas.id_doc_mod
                    where dm1.id_doc_mod=docente_modulo.id_doc_mod and mat1.id_matricula=m.id_matricula)as nota_trabajo_equipo,(select notas.nota_estudio_caso from matricula as mat2
                    inner join notas on mat2.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm2 on dm2.id_doc_mod = notas.id_doc_mod
                    where dm2.id_doc_mod=docente_modulo.id_doc_mod and mat2.id_matricula=m.id_matricula)as nota_estudio_caso,(select notas.nota_prueba_practica from matricula as mat3
                    inner join notas on mat3.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm3 on dm3.id_doc_mod = notas.id_doc_mod
                    where dm3.id_doc_mod=docente_modulo.id_doc_mod and mat3.id_matricula=m.id_matricula)as nota_prueba_practica,(select notas.nota_prueba_teorica from matricula as mat4
                    inner join notas on mat4.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm4 on dm4.id_doc_mod = notas.id_doc_mod
                    where dm4.id_doc_mod=docente_modulo.id_doc_mod and mat4.id_matricula=m.id_matricula)as nota_prueba_teorica,(select notas.nota_suspenso from matricula as mat5
                    inner join notas on mat5.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm5 on dm5.id_doc_mod = notas.id_doc_mod
                    where dm5.id_doc_mod=docente_modulo.id_doc_mod and mat5.id_matricula=m.id_matricula)as nota_suspenso,modulo.id_mod,modulo.nombre_mod,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia from matricula as m
            inner join estudiante on estudiante.id_est = m.id_est
            inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
            inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
            inner join modulo on modulo.id_mod = docente_modulo.id_mod
            inner join periodoacademico on periodoacademico.id=m.id_periodo
            inner join docentemodulo_horario on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            where periodohorario.id_periodo=?
            order by m.id_curlic,docente_modulo.id_doc_mod, estudiante.apellido_est,estudiante.name_est,modulo.nombre_mod",[$idP]);
            $estudiantesLista=DB::select("select cursolicencia.id_curlic,docente_modulo.id_doc_mod,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas.nota_trabajo_equipo from matricula as mat1
                        inner join notas on mat1.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm1 on dm1.id_doc_mod = notas.id_doc_mod
                        where dm1.id_doc_mod=docente_modulo.id_doc_mod and mat1.id_matricula=m.id_matricula)as nota_trabajo_equipo,(select notas.nota_estudio_caso from matricula as mat2
                        inner join notas on mat2.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm2 on dm2.id_doc_mod = notas.id_doc_mod
                        where dm2.id_doc_mod=docente_modulo.id_doc_mod and mat2.id_matricula=m.id_matricula)as nota_estudio_caso,(select notas.nota_prueba_practica from matricula as mat3
                        inner join notas on mat3.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm3 on dm3.id_doc_mod = notas.id_doc_mod
                        where dm3.id_doc_mod=docente_modulo.id_doc_mod and mat3.id_matricula=m.id_matricula)as nota_prueba_practica,(select notas.nota_prueba_teorica from matricula as mat4
                        inner join notas on mat4.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm4 on dm4.id_doc_mod = notas.id_doc_mod
                        where dm4.id_doc_mod=docente_modulo.id_doc_mod and mat4.id_matricula=m.id_matricula)as nota_prueba_teorica,(select notas.nota_suspenso from matricula as mat5
                        inner join notas on mat5.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm5 on dm5.id_doc_mod = notas.id_doc_mod
                        where dm5.id_doc_mod=docente_modulo.id_doc_mod and mat5.id_matricula=m.id_matricula)as nota_suspenso,modulo.id_mod,modulo.nombre_mod,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia from matricula as m
                inner join estudiante on estudiante.id_est = m.id_est
                inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
                inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
                inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
                inner join modulo on modulo.id_mod = docente_modulo.id_mod
                inner join periodoacademico on periodoacademico.id=m.id_periodo
                inner join docentemodulo_horario on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
                inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
                where periodohorario.id_periodo=? and m.id_periodo=?
                order by estudiante.apellido_est,estudiante.name_est,estudiante.id_est",[$idP,$idP]);
            $datosT = ['estudiantes' => $estudiantes, 'estudiantesLista' => $estudiantesLista];
            return view('SECRETARIA.REPORTES.reporteNotas')->with($datosT);
           
        }
        else{
            return redirect("/home");
        }
    }
    public function exportNotasGenerales($id) 
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            return Excel::download(new NotasExport($id) , 'CuadroGeneral.xlsx');
        }
        else{
            return redirect("/home");
        }
    }
    public function vistaActasEstudiantes() 
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            return view('SECRETARIA.REPORTES.vistaActas');
        }
        else{
            return redirect("/home");
        }
    }
    
    public function tablaActasEstudiantes($idP)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            $estudiantes=DB::select("select cursolicencia.id_curlic,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas_grado.nota_ley_reglamento from matricula as mat1
                    inner join notas_grado on mat1.id_matricula = notas_grado.id_matricula
                    where mat1.id_matricula=m.id_matricula)as nota_ley_reglamento,(select notas_grado.nota_educacion_vial from matricula as mat2
                    inner join notas_grado on mat2.id_matricula = notas_grado.id_matricula
                    where mat2.id_matricula=m.id_matricula)as nota_educacion_vial,(select notas_grado.nota_mecanica_basica from matricula as mat3
                    inner join notas_grado on mat3.id_matricula = notas_grado.id_matricula
                    where mat3.id_matricula=m.id_matricula)as nota_mecanica_basica,(select notas_grado.nota_grado_practico from matricula as mat4
                    inner join notas_grado on mat4.id_matricula = notas_grado.id_matricula
                    where mat4.id_matricula=m.id_matricula)as nota_grado_practico,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia from matricula as m
            inner join estudiante on estudiante.id_est = m.id_est
            inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
            inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join periodoacademico on periodoacademico.id=m.id_periodo
            where m.id_periodo=?
            order by m.id_curlic, estudiante.apellido_est,estudiante.name_est,estudiante.id_est",[$idP]);
            $cursosLista=DB::select("select cursolicencia.id_curlic,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas_grado.nota_ley_reglamento from matricula as mat1
                    inner join notas_grado on mat1.id_matricula = notas_grado.id_matricula
                    where mat1.id_matricula=m.id_matricula)as nota_ley_reglamento,(select notas_grado.nota_educacion_vial from matricula as mat2
                    inner join notas_grado on mat2.id_matricula = notas_grado.id_matricula
                    where mat2.id_matricula=m.id_matricula)as nota_educacion_vial,(select notas_grado.nota_mecanica_basica from matricula as mat3
                    inner join notas_grado on mat3.id_matricula = notas_grado.id_matricula
                    where mat3.id_matricula=m.id_matricula)as nota_mecanica_basica,(select notas_grado.nota_grado_practico from matricula as mat4
                    inner join notas_grado on mat4.id_matricula = notas_grado.id_matricula
                    where mat4.id_matricula=m.id_matricula)as nota_grado_practico,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia from matricula as m
            inner join estudiante on estudiante.id_est = m.id_est
            inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
            inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join periodoacademico on periodoacademico.id=m.id_periodo
            where m.id_periodo=?
            order by m.id_curlic, estudiante.apellido_est,estudiante.name_est,estudiante.id_est",[$idP]);
            $estudiantesNotas=DB::select("select cursolicencia.id_curlic,docente_modulo.id_doc_mod,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas.nota_trabajo_equipo from matricula as mat1
                    inner join notas on mat1.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm1 on dm1.id_doc_mod = notas.id_doc_mod
                    where dm1.id_doc_mod=docente_modulo.id_doc_mod and mat1.id_matricula=m.id_matricula)as nota_trabajo_equipo,(select notas.nota_estudio_caso from matricula as mat2
                    inner join notas on mat2.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm2 on dm2.id_doc_mod = notas.id_doc_mod
                    where dm2.id_doc_mod=docente_modulo.id_doc_mod and mat2.id_matricula=m.id_matricula)as nota_estudio_caso,(select notas.nota_prueba_practica from matricula as mat3
                    inner join notas on mat3.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm3 on dm3.id_doc_mod = notas.id_doc_mod
                    where dm3.id_doc_mod=docente_modulo.id_doc_mod and mat3.id_matricula=m.id_matricula)as nota_prueba_practica,(select notas.nota_prueba_teorica from matricula as mat4
                    inner join notas on mat4.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm4 on dm4.id_doc_mod = notas.id_doc_mod
                    where dm4.id_doc_mod=docente_modulo.id_doc_mod and mat4.id_matricula=m.id_matricula)as nota_prueba_teorica,(select notas.nota_suspenso from matricula as mat5
                    inner join notas on mat5.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm5 on dm5.id_doc_mod = notas.id_doc_mod
                    where dm5.id_doc_mod=docente_modulo.id_doc_mod and mat5.id_matricula=m.id_matricula)as nota_suspenso,modulo.id_mod,modulo.nombre_mod,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia from matricula as m
            inner join estudiante on estudiante.id_est = m.id_est
            inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
            inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
            inner join modulo on modulo.id_mod = docente_modulo.id_mod
            inner join periodoacademico on periodoacademico.id=m.id_periodo
            inner join docentemodulo_horario on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            where periodohorario.id_periodo=?
            order by m.id_curlic,docente_modulo.id_doc_mod, estudiante.apellido_est,estudiante.name_est,modulo.nombre_mod",[$idP]);
            $estudiantesListaNotas=DB::select("select cursolicencia.id_curlic,docente_modulo.id_doc_mod,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas.nota_trabajo_equipo from matricula as mat1
                        inner join notas on mat1.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm1 on dm1.id_doc_mod = notas.id_doc_mod
                        where dm1.id_doc_mod=docente_modulo.id_doc_mod and mat1.id_matricula=m.id_matricula)as nota_trabajo_equipo,(select notas.nota_estudio_caso from matricula as mat2
                        inner join notas on mat2.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm2 on dm2.id_doc_mod = notas.id_doc_mod
                        where dm2.id_doc_mod=docente_modulo.id_doc_mod and mat2.id_matricula=m.id_matricula)as nota_estudio_caso,(select notas.nota_prueba_practica from matricula as mat3
                        inner join notas on mat3.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm3 on dm3.id_doc_mod = notas.id_doc_mod
                        where dm3.id_doc_mod=docente_modulo.id_doc_mod and mat3.id_matricula=m.id_matricula)as nota_prueba_practica,(select notas.nota_prueba_teorica from matricula as mat4
                        inner join notas on mat4.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm4 on dm4.id_doc_mod = notas.id_doc_mod
                        where dm4.id_doc_mod=docente_modulo.id_doc_mod and mat4.id_matricula=m.id_matricula)as nota_prueba_teorica,(select notas.nota_suspenso from matricula as mat5
                        inner join notas on mat5.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm5 on dm5.id_doc_mod = notas.id_doc_mod
                        where dm5.id_doc_mod=docente_modulo.id_doc_mod and mat5.id_matricula=m.id_matricula)as nota_suspenso,modulo.id_mod,modulo.nombre_mod,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia from matricula as m
                inner join estudiante on estudiante.id_est = m.id_est
                inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
                inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
                inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
                inner join modulo on modulo.id_mod = docente_modulo.id_mod
                inner join periodoacademico on periodoacademico.id=m.id_periodo
                inner join docentemodulo_horario on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
                inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
                where periodohorario.id_periodo=? and m.id_periodo=?
                order by estudiante.apellido_est,estudiante.name_est,estudiante.id_est",[$idP,$idP]);
            $datosT = ['estudiantes' => $estudiantes, 'cursosLista' => $cursosLista, 'estudiantesNotas' => $estudiantesNotas, 'estudiantesListaNotas' => $estudiantesListaNotas];
            return view('SECRETARIA.REPORTES.reporteActas')->with($datosT);
           
        }
        else{
            return redirect("/home");
        }
    }
    public function mostrarCalificarActa($idMat)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {  
            $idPer= DB::table('matricula')
                ->select('id_periodo')
                ->where('id_matricula', $idMat)
                ->first()
                ->id_periodo;
            $nota = DB::table('notas_grado')
            ->join('matricula', 'matricula.id_matricula', '=', 'notas_grado.id_matricula')
            ->select('*')
            ->where('matricula.id_matricula', '=', $idMat)
            ->get();
            $idMat2["idMatricula"]=$idMat;
            $idPeriodo["id_periodo"]=$idPer;
            $datose = Arr::collapse([$nota,$idMat2,$idPeriodo]);
            return response()->json($datose);
            //return view('DOCENTE.NOTAS.tablaEstudiantes')->with('estudiantes',$estudiantes);
           
        }
        else{
            return redirect("/home");
        }
    }
    public function ingresarNotasActa(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="6")))
        {
            $now = new \DateTime("America/Guayaquil");
            $fechaactual=$now->format('Y-m-d');
            $periodoactual=DB::select("select * from matricula
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            where matricula.id_matricula=? and ? >= periodoacademico.fechaini and ? <= periodoacademico.fechafin"
            ,[$request->id_matricula,$fechaactual,$fechaactual]);
            if($periodoactual)
            { 
                $nota=DB::select('CALL insertarNotasGrado(?,?,?,?,?)',
                [$request->nota_ley_reglamento,$request->nota_educacion_vial ,$request->nota_mecanica_basica ,$request->nota_grado_practico ,$request->id_matricula]);
                return  true;
            }
            else{
                return false;
            }
        }
        else{
            return redirect("/home");
        }
    }
    
    public function actualizarNotasActa(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="6")))
        {
            $now = new \DateTime("America/Guayaquil");
            $fechaactual=$now->format('Y-m-d');
            $periodoactual=DB::select("select * from notas_grado
            inner join matricula on matricula.id_matricula=notas_grado.id_matricula
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            where notas_grado.id_nota=? and ? >= periodoacademico.fechaini and ? <= periodoacademico.fechafin",[$request->id_nota,$fechaactual,$fechaactual]);
            if($periodoactual)
            {
                $notas=DB::select('CALL actualizarNotasGrado(?,?,?,?,?,?)',
                [$request->id_nota,$request->nota_ley_reglamento,$request->nota_educacion_vial ,$request->nota_mecanica_basica ,$request->nota_grado_practico ,$request->id_matricula]);
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return redirect("/home");
        }
    }
    public function descargarActaNotas($idP) 
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            return Excel::download(new ActasExport($idP) , 'ActaCalificacones.xlsx');
        }
        else{
            return redirect("/home");
        }
    }
    
    public function notasGradoE()
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
            $idEst= DB::table('estudiante')
            ->select('id_est')
            ->where('email_est', auth()->user()->email)
            ->first()
            ->id_est;
           $periodos['periodosacademicos'] =  DB::table('matricula')
           ->join('periodoacademico','matricula.id_periodo', '=', 'periodoacademico.id')
           ->join('estudiante','estudiante.id_est', '=', 'matricula.id_est')
           ->select('*')
           ->where('estudiante.id_est', $idEst)
           ->orderBy('fechaini', 'desc')
           ->get();
           return view('ESTUDIANTE.NOTA.actasEstudiante',$periodos);
           //return response()->json($periodosacademicos);
           
        }
        else{
            return redirect("/home");
        }
    }
    public function notasGradoEstudianteMostrar($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
                $idEst= DB::table('estudiante')
                ->select('id_est')
                ->where('email_est', auth()->user()->email)
                ->first()
                ->id_est;
                $curso= DB::table('matricula')
                ->select('id_curlic')
                ->where('id_periodo',$id)
                ->where('id_est',$idEst)
                ->first()
                ->id_curlic;
                $notas=DB::select('select cursolicencia.id_curlic,paralelos.nombre_paralelo,periodoacademico.id,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,(select notas_grado.nota_ley_reglamento from matricula as mat1
                    inner join notas_grado on mat1.id_matricula = notas_grado.id_matricula
                    where mat1.id_matricula=m.id_matricula)as nota_ley_reglamento,(select notas_grado.nota_educacion_vial from matricula as mat2
                    inner join notas_grado on mat2.id_matricula = notas_grado.id_matricula
                    where mat2.id_matricula=m.id_matricula)as nota_educacion_vial,(select notas_grado.nota_mecanica_basica from matricula as mat3
                    inner join notas_grado on mat3.id_matricula = notas_grado.id_matricula
                    where mat3.id_matricula=m.id_matricula)as nota_mecanica_basica,(select notas_grado.nota_grado_practico from matricula as mat4
                    inner join notas_grado on mat4.id_matricula = notas_grado.id_matricula
                    where mat4.id_matricula=m.id_matricula)as nota_grado_practico from matricula as m
                inner join cursolicencia on cursolicencia.id_curlic =m.id_curlic
                inner join tipolicencia on cursolicencia.id_tlic =tipolicencia.id_tlic
                inner join paralelos on paralelos.id_paralelo =cursolicencia.id_paralelo
                inner join periodoacademico on periodoacademico.id=m.id_periodo	
                inner join estudiante on estudiante.id_est=m.id_est
                where periodoacademico.id=? and estudiante.id_est=? and cursolicencia.id_curlic=?',[$id,$idEst,$curso]);
                $estudiantesNotas=DB::select("select cursolicencia.id_curlic,docente_modulo.id_doc_mod,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas.nota_trabajo_equipo from matricula as mat1
                    inner join notas on mat1.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm1 on dm1.id_doc_mod = notas.id_doc_mod
                    where dm1.id_doc_mod=docente_modulo.id_doc_mod and mat1.id_matricula=m.id_matricula)as nota_trabajo_equipo,(select notas.nota_estudio_caso from matricula as mat2
                    inner join notas on mat2.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm2 on dm2.id_doc_mod = notas.id_doc_mod
                    where dm2.id_doc_mod=docente_modulo.id_doc_mod and mat2.id_matricula=m.id_matricula)as nota_estudio_caso,(select notas.nota_prueba_practica from matricula as mat3
                    inner join notas on mat3.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm3 on dm3.id_doc_mod = notas.id_doc_mod
                    where dm3.id_doc_mod=docente_modulo.id_doc_mod and mat3.id_matricula=m.id_matricula)as nota_prueba_practica,(select notas.nota_prueba_teorica from matricula as mat4
                    inner join notas on mat4.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm4 on dm4.id_doc_mod = notas.id_doc_mod
                    where dm4.id_doc_mod=docente_modulo.id_doc_mod and mat4.id_matricula=m.id_matricula)as nota_prueba_teorica,(select notas.nota_suspenso from matricula as mat5
                    inner join notas on mat5.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm5 on dm5.id_doc_mod = notas.id_doc_mod
                    where dm5.id_doc_mod=docente_modulo.id_doc_mod and mat5.id_matricula=m.id_matricula)as nota_suspenso,modulo.id_mod,modulo.nombre_mod,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia from matricula as m
            inner join estudiante on estudiante.id_est = m.id_est
            inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
            inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
            inner join modulo on modulo.id_mod = docente_modulo.id_mod
            inner join periodoacademico on periodoacademico.id=m.id_periodo
            inner join docentemodulo_horario on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            where periodohorario.id_periodo=?
            order by m.id_curlic,docente_modulo.id_doc_mod, estudiante.apellido_est,estudiante.name_est,modulo.nombre_mod",[$id]);
            $estudiantesListaNotas=DB::select("select cursolicencia.id_curlic,docente_modulo.id_doc_mod,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas.nota_trabajo_equipo from matricula as mat1
                        inner join notas on mat1.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm1 on dm1.id_doc_mod = notas.id_doc_mod
                        where dm1.id_doc_mod=docente_modulo.id_doc_mod and mat1.id_matricula=m.id_matricula)as nota_trabajo_equipo,(select notas.nota_estudio_caso from matricula as mat2
                        inner join notas on mat2.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm2 on dm2.id_doc_mod = notas.id_doc_mod
                        where dm2.id_doc_mod=docente_modulo.id_doc_mod and mat2.id_matricula=m.id_matricula)as nota_estudio_caso,(select notas.nota_prueba_practica from matricula as mat3
                        inner join notas on mat3.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm3 on dm3.id_doc_mod = notas.id_doc_mod
                        where dm3.id_doc_mod=docente_modulo.id_doc_mod and mat3.id_matricula=m.id_matricula)as nota_prueba_practica,(select notas.nota_prueba_teorica from matricula as mat4
                        inner join notas on mat4.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm4 on dm4.id_doc_mod = notas.id_doc_mod
                        where dm4.id_doc_mod=docente_modulo.id_doc_mod and mat4.id_matricula=m.id_matricula)as nota_prueba_teorica,(select notas.nota_suspenso from matricula as mat5
                        inner join notas on mat5.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm5 on dm5.id_doc_mod = notas.id_doc_mod
                        where dm5.id_doc_mod=docente_modulo.id_doc_mod and mat5.id_matricula=m.id_matricula)as nota_suspenso,modulo.id_mod,modulo.nombre_mod,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia from matricula as m
                inner join estudiante on estudiante.id_est = m.id_est
                inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
                inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
                inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
                inner join modulo on modulo.id_mod = docente_modulo.id_mod
                inner join periodoacademico on periodoacademico.id=m.id_periodo
                inner join docentemodulo_horario on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
                inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
                where periodohorario.id_periodo=? and m.id_periodo=?
                order by estudiante.apellido_est,estudiante.name_est,estudiante.id_est",[$id,$id]);
                $datosT = ['notas' => $notas, 'estudiantesNotas' => $estudiantesNotas, 'estudiantesListaNotas' => $estudiantesListaNotas];
            //return view('ESTUDIANTE.SILABO.tablaSilabos');
            return view('ESTUDIANTE.NOTA.tablaActaEstudiante', $datosT);
        }
        else{
            return redirect("/home");
        }
    }
}
