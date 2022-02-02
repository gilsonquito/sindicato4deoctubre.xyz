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
use App\Models\Asistencia;    
use App\Exports\InvoicesExport;          
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use DateTime;
Use \Carbon\Carbon;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AsistenciaModuloExport;   
use App\Exports\AsistenciasExport;    

class AsistenciaController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            
            return view('DOCENTE.ASISTENCIAS.indexAsistencia');
        }
        else{
            return redirect("/home");
        }
    } 
    public function indexVistaSecretaria(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            
            return view('SECRETARIA.ASISTENCIAS.indexAsistencia');
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
                $notasDoc=DB::select('select notas.id_nota,modulo.nombre_mod,periodoacademico.fechaini,periodoacademico.fechafin,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,paralelos.nombre_paralelo,notas.valor_nota,notas.descripcion_nota,estudiante.apellido_est,estudiante.name_est from notas
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
            return view('DOCENTE.ASISTENCIAS.indexAsistencia');
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
    
    public function crearAsistencia(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $asistencias=DB::select("select * from asistenciaestudiante
            inner join matricula on asistenciaestudiante.id_matricula=matricula.id_matricula
            where asistenciaestudiante.id_doc_mod=? and asistenciaestudiante.fecha_asistencia=? and matricula.id_periodo=? ",[$request->id_doc_mod,$request->fecha_asistencia,$request->id_periodo]);
            if($asistencias)
            {
                return false;
            }
            else
            {   
                $periodos=DB::select("select periodoacademico.fechaini,periodoacademico.fechafin from periodoacademico
                where id=? and ? >= periodoacademico.fechaini  and ?<= periodoacademico.fechafin ",[$request->id_periodo,$request->fecha_asistencia,$request->fecha_asistencia]);
                if($periodos)
                {
                    $now = new \DateTime("America/Guayaquil");
                    $fechaactual=$now->format('Y-m-d');
                    $periodoactual=DB::select("select periodoacademico.fechaini,periodoacademico.fechafin from periodoacademico
                    where id=? and ? >= periodoacademico.fechaini  and ?<= periodoacademico.fechafin ",[$request->id_periodo,$fechaactual,$fechaactual]);
                    if($periodoactual)
                    {
                        $estudiantes=DB::select("select estudiante.id_est,estudiante.apellido_est,estudiante.name_est,docente_modulo.id_doc_mod,m.id_matricula,periodoacademico.id,cursolicencia.id_curlic from matricula as m
                        inner join estudiante on estudiante.id_est = m.id_est
                        inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
                        inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
                        inner join periodoacademico on periodoacademico.id=m.id_periodo
                        where docente_modulo.id_doc_mod=? and periodoacademico.id=? and  cursolicencia.id_curlic=? 
                        order by estudiante.apellido_est asc,estudiante.name_est",[$request->id_doc_mod,$request->id_periodo,$request->id_curlic]);
                        foreach($estudiantes as $estudiante)
                        {
                            $asistenciaIng=DB::select('CALL insertarAsistenciaEstudiante(?,?,?,?)',
                            ["PRESENTE",$request->fecha_asistencia,$request->id_doc_mod,$estudiante->id_matricula]);
                        }
                        return true;
                    }
                    else{
                        return 3;
                    } 
                }
                else{
                    return 2;
                }       
            } 
        }
        else{
            return redirect("/home");
        }
    }
   public function tablaAsistenciaEstudiantes($idP,$fecha,$idDocMod)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $estudiantes=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
           inner join estudiante on estudiante.id_est = matricula.id_est
           inner join periodoacademico on periodoacademico.id=matricula.id_periodo
           where asistenciaestudiante.id_doc_mod=? and asistenciaestudiante.fecha_asistencia=? and periodoacademico.id=?
           order by estudiante.apellido_est,estudiante.name_est",[$idDocMod,$fecha,$idP]);
            return view('DOCENTE.ASISTENCIAS.tablaTomarAsistencia')->with('estudiantes',$estudiantes);
        }
        else{
            return redirect("/home");
        }
    }
   
    public function cambiarEstado($id,$estado)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
                    $now = new \DateTime("America/Guayaquil");
                    $fechaactual=$now->format('Y-m-d');
                    $periodoactual=DB::select("select periodoacademico.fechaini,periodoacademico.fechafin,asistenciaestudiante.id_asistencia from asistenciaestudiante 
                    inner join matricula on  matricula.id_matricula=asistenciaestudiante.id_matricula
                    inner join periodoacademico on  periodoacademico.id=matricula.id_periodo
                     where asistenciaestudiante.id_asistencia=? and ? >= periodoacademico.fechaini  and ?<= periodoacademico.fechafin",[$id,$fechaactual,$fechaactual]);
                    if($periodoactual)
                    {
                        $estados=DB::select('CALL actualizarEstadoAsistenciaEstudiante(?,?)',
                        [$id,$estado]);
                        return  true;
                    }
                    else
                    {
                        return false;
                    }
        }
        else{
            return redirect("/home");
        }
    } 
    
    public function eliminarAsistencia($idP,$fecha,$idDocMod)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $asistencias=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
           inner join estudiante on estudiante.id_est = matricula.id_est
           inner join periodoacademico on periodoacademico.id=matricula.id_periodo
           where asistenciaestudiante.id_doc_mod=? and asistenciaestudiante.fecha_asistencia=? and periodoacademico.id=?",[$idDocMod,$fecha,$idP]);
            if($asistencias)
            {
                $now = new \DateTime("America/Guayaquil");
                $fechaactual=$now->format('Y-m-d');
                $periodoactual=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia  from matricula
                inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
               inner join estudiante on estudiante.id_est = matricula.id_est
               inner join periodoacademico on periodoacademico.id=matricula.id_periodo
               where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? and asistenciaestudiante.fecha_asistencia=? and ? >= periodoacademico.fechaini  and ?<= periodoacademico.fechafin
               ",[$idDocMod,$idP,$fecha,$fechaactual,$fechaactual]);
                if($periodoactual)
                {
                    foreach($periodoactual as $asistenciaActual)
                    {
                        $estados=DB::select('CALL eliminarAsistenciaEstudiante(?)',
                        [$asistenciaActual->id_asistencia]);
                    }
                    return  3;
                }
                else
                {
                    return 2;
                }
            }
            else
            {
                return false;
            }

                   
        }
        else{
            return redirect("/home");
        }
    }
    
    public function reporteAsistencia($idP,$idDocMod,$fechaini,$fechafin)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            
                    $datos=DB::select("select modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,docente.instruccion_doc,docente.apellido_doc,docente.name,docente.cedula_doc from docente_modulo
                    inner join docente on docente_modulo.id_doc=docente.id_doc
                    inner join modulo on modulo.id_mod=docente_modulo.id_mod
                    inner join cursolicencia on cursolicencia.id_curlic=docente_modulo.id_curlic
                    inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
                    inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
                    where docente_modulo.id_doc_mod=?",[$idDocMod]);
                    $periodos=DB::select("	select * from periodoacademico where id=?",[$idP]);
                    $fechas=DB::select("select distinct asistenciaestudiante.fecha_asistencia,estudiante.id_est from matricula
                    inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
                inner join estudiante on estudiante.id_est = matricula.id_est
                inner join periodoacademico on periodoacademico.id=matricula.id_periodo
                where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? and asistenciaestudiante.fecha_asistencia>=? and asistenciaestudiante.fecha_asistencia<=?
                order by asistenciaestudiante.fecha_asistencia",[$idDocMod,$idP,$fechaini,$fechafin]);
                    $estudiantes=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia  from matricula
                    inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
                inner join estudiante on estudiante.id_est = matricula.id_est
                inner join periodoacademico on periodoacademico.id=matricula.id_periodo
                where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? and asistenciaestudiante.fecha_asistencia>=? and asistenciaestudiante.fecha_asistencia<=?
                order by estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.fecha_asistencia",[$idDocMod,$idP,$fechaini,$fechafin]);
                $estudiantesOrders=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia  from matricula
                inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
                inner join estudiante on estudiante.id_est = matricula.id_est
                inner join periodoacademico on periodoacademico.id=matricula.id_periodo
                where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? and asistenciaestudiante.fecha_asistencia>=? and asistenciaestudiante.fecha_asistencia<=?
                order by estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.fecha_asistencia",[$idDocMod,$idP,$fechaini,$fechafin]);

                    $datosT = ['datos' => $datos,'fechaini' => $fechaini,'fechafin' => $fechafin,'periodos' => $periodos,'fechas' => $fechas,'estudiantes' => $estudiantes,'estudiantesOrders' => $estudiantesOrders];
                    $pdf=PDF::loadView('DOCENTE.ASISTENCIAS.pdfAsistencia',$datosT)->setPaper('a4', 'landscape');
                    return $pdf->stream('ReporteAsistencias'.'.pdf');     
                    return view('DOCENTE.ASISTENCIAS.pdfAsistencia',$datosT); 
           
        }
        else{
            return redirect("/home");
        }
    }

  
    
     public function reporteAsistenciaContador($idP,$idDocMod,$fechaini,$fechafin)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $contadores=DB::select("select distinct asistenciaestudiante.fecha_asistencia from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
           inner join estudiante on estudiante.id_est = matricula.id_est
           inner join periodoacademico on periodoacademico.id=matricula.id_periodo
           where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? and asistenciaestudiante.fecha_asistencia>=? and asistenciaestudiante.fecha_asistencia<=?
           order by asistenciaestudiante.fecha_asistencia",[$idDocMod,$idP,$fechaini,$fechafin]);
            $conta=0;
           foreach($contadores as $cont)
           {
            $conta=$conta+1;
           }
           if($conta<=20)
           {
                   return true;
           }
           else
           {
               return false;
           }
        }
        else{
            return redirect("/home");
        }
    }
    public function porcentajeAsistencia($idP,$idDocMod)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
                    $datos=DB::select("select modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,docente.instruccion_doc,docente.apellido_doc,docente.name,docente.cedula_doc from docente_modulo
                    inner join docente on docente_modulo.id_doc=docente.id_doc
                    inner join modulo on modulo.id_mod=docente_modulo.id_mod
                    inner join cursolicencia on cursolicencia.id_curlic=docente_modulo.id_curlic
                    inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
                    inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
                    where docente_modulo.id_doc_mod=?",[$idDocMod]);
                    $periodos=DB::select("select * from periodoacademico where id=?",[$idP]);
                    $fechas=DB::select("select distinct asistenciaestudiante.fecha_asistencia,estudiante.id_est from matricula
                    inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
                    inner join estudiante on estudiante.id_est = matricula.id_est
                    inner join periodoacademico on periodoacademico.id=matricula.id_periodo
                    where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? 
                    order by asistenciaestudiante.fecha_asistencia",[$idDocMod,$idP]);
                    $estudiantes=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia  from matricula
                    inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
                    inner join estudiante on estudiante.id_est = matricula.id_est
                    inner join periodoacademico on periodoacademico.id=matricula.id_periodo
                    where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? 
                    order by estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.fecha_asistencia",[$idDocMod,$idP]);
                    $estudiantesOrders=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia  from matricula
                    inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
                    inner join estudiante on estudiante.id_est = matricula.id_est
                    inner join periodoacademico on periodoacademico.id=matricula.id_periodo
                    where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? 
                    order by estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.fecha_asistencia",[$idDocMod,$idP]);

                    $datosT = ['datos' => $datos,'periodos' => $periodos,'fechas' => $fechas,'estudiantes' => $estudiantes,'estudiantesOrders' => $estudiantesOrders];
                    $pdf=PDF::loadView('DOCENTE.ASISTENCIAS.pdfPorcentajeAsistencias',$datosT);
                    return $pdf->stream('porcentajeAsistencias'.'.pdf');     
                    //return view('DOCENTE.ASISTENCIAS.pdfPorcentajeAsistencias',$datosT); 
           
        }
        else{
            return redirect("/home");
        }
    }
    
    public function indexAsistenciaEstudiante()
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
           ->join('cursolicencia','matricula.id_curlic', '=', 'cursolicencia.id_curlic')
           ->join('paralelos','paralelos.id_paralelo', '=', 'cursolicencia.id_paralelo')
           ->select('*')
           ->where('estudiante.id_est', $idEst)
           ->orderBy('fechaini', 'desc')
           ->get();
            return view('ESTUDIANTE.ASISTENCIA.indexAsistencia',$periodos); 
           
        }
        else{
            return redirect("/home");
        }
    }
    public function tablaAsistencia($id)
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
                $modulos=DB::select('select distinct modulo.id_mod,modulo.nombre_mod,periodoacademico.id,estudiante.id_est,matricula.id_matricula,docente_modulo.id_doc_mod,docente_modulo.id_mod,cursolicencia.id_curlic from matricula
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
                $asistencias['asistencias']=DB::select('select * from asistenciaestudiante
                inner join docente_modulo on docente_modulo.id_doc_mod = asistenciaestudiante.id_doc_mod
                inner join matricula on matricula.id_matricula = asistenciaestudiante.id_matricula
                where matricula.id_periodo=? and matricula.id_est=? and matricula.id_curlic=?
                order by fecha_asistencia',[$id,$idEst,$curso]);
            //return view('ESTUDIANTE.SILABO.tablaSilabos');
            return view('ESTUDIANTE.ASISTENCIA.tablaAsistencias',$asistencias)->with('modulos',$modulos);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function pdfAsistenciaEstudiante($idM,$idDocMod)
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
                    $idEst= DB::table('estudiante')
                    ->select('id_est')
                    ->where('email_est', auth()->user()->email)
                    ->first()
                    ->id_est;
                    $datos=DB::select("select * from matricula
                    inner join cursolicencia on matricula.id_curlic=cursolicencia.id_curlic
                    inner join paralelos on paralelos.id_paralelo =cursolicencia.id_paralelo
                    inner join estudiante on estudiante.id_est=matricula.id_est
                    inner join periodoacademico on periodoacademico.id= matricula.id_periodo
                    where estudiante.id_est=? and matricula.id_matricula=?",[$idEst,$idM]);
                    $asistencias=DB::select("select * from asistenciaestudiante
					where id_matricula=? and id_doc_mod=?
					order by fecha_asistencia",[$idM,$idDocMod]);
                    $modulos=DB::select("select * from docente_modulo 
                    inner join modulo on modulo.id_mod =docente_modulo.id_mod
                    where docente_modulo.id_doc_mod=?",[$idDocMod]);
                    $datosT = ['datos' => $datos,'asistencias' => $asistencias,'modulos' => $modulos];
                    $pdf=PDF::loadView('ESTUDIANTE.ASISTENCIA.pdfAsistencias',$datosT);
                    return $pdf->stream('AsistenciasEstudiante'.'.pdf');     
                    //return view('DOCENTE.ASISTENCIAS.pdfPorcentajeAsistencias',$datosT); 
           
        }
        else{
            return redirect("/home");
        }
    }
    public function selectPeriodosSecretaria()
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            
            $periodosaca=DB::select("
            select DISTINCT periodoacademico.id,periodoacademico.fechaini,periodoacademico.fechafin,periodoacademico.nombre_tipolicencia from docentemodulo_horario
                        inner join docente_modulo on docente_modulo.id_doc_mod = docentemodulo_horario.id_doc_mod
                        inner join docente on docente_modulo.id_doc = docente.id_doc
                        inner join modulo on docente_modulo.id_mod=modulo.id_mod
                        inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
                        inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
                        inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
                        inner join matricula on matricula.id_curlic=cursolicencia.id_curlic
                        inner join periodoacademico on periodoacademico.id=matricula.id_periodo
                        order by periodoacademico.fechaini desc,periodoacademico.fechafin desc,periodoacademico.nombre_tipolicencia  asc");
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
            $modulos=DB::select("
            select DISTINCT docente_modulo.id_doc_mod,modulo.id_mod,modulo.nombre_mod from matricula
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
    public function selectEstudiantes($idP,$idCur,$idDocMod)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            $estudiantes=DB::select("select DISTINCT estudiante.id_est,estudiante.apellido_est,estudiante.name_est,estudiante.cedula_est from matricula
            inner join estudiante on estudiante.id_est=matricula.id_est
            inner join cursolicencia on matricula.id_curlic = cursolicencia.id_curlic
            inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
            inner join modulo on modulo.id_mod = docente_modulo.id_mod
            inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
            inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join docentemodulo_horario on docentemodulo_horario.id_doc_mod=docente_modulo.id_doc_mod
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo	
            where  matricula.id_curlic=? and matricula.id_periodo=? and docente_modulo.id_doc_mod=?
            order by estudiante.apellido_est,estudiante.name_est",[$idCur,$idP,$idDocMod]);
            return response()->json($estudiantes);  
        }
        else{
            return redirect("/home");
        }
    }
   
    public function tablaAsistenciaEstudiantesSecretaria($idP,$id_est,$idDocMod)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            $estudiantes=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,estudiante.email_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
           inner join estudiante on estudiante.id_est = matricula.id_est
           inner join periodoacademico on periodoacademico.id=matricula.id_periodo
           where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? and estudiante.id_est=?
           order by asistenciaestudiante.fecha_asistencia desc",[$idDocMod,$idP,$id_est]);
            return view('SECRETARIA.ASISTENCIAS.tablaTomarAsistencia')->with('estudiantes',$estudiantes);
        }
        else{
            return redirect("/home");
        }
    }
    public function cambiarEstadoSecretaria($id,$estado)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
                    $now = new \DateTime("America/Guayaquil");
                    $fechaactual=$now->format('Y-m-d');
                    $periodoactual=DB::select("select periodoacademico.fechaini,periodoacademico.fechafin,asistenciaestudiante.id_asistencia from asistenciaestudiante 
                    inner join matricula on  matricula.id_matricula=asistenciaestudiante.id_matricula
                    inner join periodoacademico on  periodoacademico.id=matricula.id_periodo
                     where asistenciaestudiante.id_asistencia=? and ? >= periodoacademico.fechaini  and ?<= periodoacademico.fechafin",[$id,$fechaactual,$fechaactual]);
                    if($periodoactual)
                    {
                        $estados=DB::select('CALL actualizarEstadoAsistenciaEstudiante(?,?)',
                        [$id,$estado]);
                        return  true;
                    }
                    else
                    {
                        return false;
                    }
        }
        else{
            return redirect("/home");
        }
    } 
    
    public function vistaAsistenciaEst()
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            return view('SECRETARIA.REPORTES.vistaAsistencia');
        }
        else{
            return redirect("/home");
        }
    } 
    public function exportAsistencias() 
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            return Excel::download(new InvoicesExport(88) , 'notas.xlsx');
        }
        else{
            return redirect("/home");
        }
    }
    public function vistaAsistenciasModulos() 
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            return view('SECRETARIA.REPORTES.vistaAsistenciaModulo');
        }
        else{
            return redirect("/home");
        }
    }
    public function reporteAsistenciasModulos($idP,$idDocMod) 
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            $datos=DB::select("select modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,docente.instruccion_doc,docente.apellido_doc,docente.name,docente.cedula_doc from docente_modulo
            inner join docente on docente_modulo.id_doc=docente.id_doc
            inner join modulo on modulo.id_mod=docente_modulo.id_mod
            inner join cursolicencia on cursolicencia.id_curlic=docente_modulo.id_curlic
            inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
            inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
            where docente_modulo.id_doc_mod=?",[$idDocMod]);
            $periodos=DB::select("select * from periodoacademico where id=?",[$idP]);
            $fechas=DB::select("select distinct asistenciaestudiante.fecha_asistencia,estudiante.id_est from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
            inner join estudiante on estudiante.id_est = matricula.id_est
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? 
            order by asistenciaestudiante.fecha_asistencia",[$idDocMod,$idP]);
            $estudiantes=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia  from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
            inner join estudiante on estudiante.id_est = matricula.id_est
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? 
            order by estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.fecha_asistencia",[$idDocMod,$idP]);
            $estudiantesOrders=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia  from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
            inner join estudiante on estudiante.id_est = matricula.id_est
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? 
            order by estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.fecha_asistencia",[$idDocMod,$idP]);
            $datosT = ['datos' => $datos,'periodos' => $periodos,'fechas' => $fechas,'estudiantes' => $estudiantes,'estudiantesOrders' => $estudiantesOrders];
            return view('SECRETARIA.REPORTES.reporteAsistenciasModulo', $datosT);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function descargarAsistenciasModulos($idP,$idDocMod) 
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            return Excel::download(new AsistenciaModuloExport($idP,$idDocMod) , 'AsistenciasModulos.xlsx');
        }
        else{
            return redirect("/home");
        }
    }
    public function reporteAsistencias($idP) 
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            $datos=DB::select("select distinct cursolicencia.id_curlic,tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,periodoacademico.fechaini,periodoacademico.fechafin from docente_modulo
            inner join docente on docente_modulo.id_doc=docente.id_doc
            inner join modulo on modulo.id_mod=docente_modulo.id_mod
            inner join cursolicencia on cursolicencia.id_curlic=docente_modulo.id_curlic
            inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
            inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
			inner join docentemodulo_horario on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
			inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
			inner join periodoacademico on periodohorario.id_periodo=periodoacademico.id
			where periodohorario.id_periodo=?
			order by cursolicencia.id_curlic",[$idP]);
        
            $estudiantes=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia,modulo.id_mod,modulo.nombre_mod  from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
            inner join estudiante on estudiante.id_est = matricula.id_est
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
			inner join cursolicencia on cursolicencia.id_curlic=matricula.id_curlic
			inner join docente_modulo on docente_modulo.id_doc_mod=asistenciaestudiante.id_doc_mod
			inner join modulo on docente_modulo.id_mod=modulo.id_mod
            where  matricula.id_periodo=?
            order by matricula.id_curlic,modulo.nombre_mod",[$idP]);
            $modulos=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia,modulo.id_mod,modulo.nombre_mod  from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
            inner join estudiante on estudiante.id_est = matricula.id_est
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
			inner join cursolicencia on cursolicencia.id_curlic=matricula.id_curlic
			inner join docente_modulo on docente_modulo.id_doc_mod=asistenciaestudiante.id_doc_mod
			inner join modulo on docente_modulo.id_mod=modulo.id_mod
            where  matricula.id_periodo=?
            order by matricula.id_curlic,modulo.nombre_mod",[$idP]);
            $estudaintesOrders=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia,modulo.id_mod,modulo.nombre_mod  from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
            inner join estudiante on estudiante.id_est = matricula.id_est
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
			inner join cursolicencia on cursolicencia.id_curlic=matricula.id_curlic
			inner join docente_modulo on docente_modulo.id_doc_mod=asistenciaestudiante.id_doc_mod
			inner join modulo on docente_modulo.id_mod=modulo.id_mod
            where matricula.id_periodo=?
            order by estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.id_doc_mod",[$idP]);
            $datosT = ['datos' => $datos,'estudiantes' => $estudiantes,'modulos' => $modulos,'estudaintesOrders' => $estudaintesOrders];
            return view('SECRETARIA.REPORTES.reporteAsistencia', $datosT);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function descargarAsistencias($idP) 
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            return Excel::download(new AsistenciasExport($idP) , 'Asistencias.xlsx');
        }
        else{
            return redirect("/home");
        }
    }
}
