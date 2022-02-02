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
use App\Models\Evaluacion;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use DateTime;
use Illuminate\Support\Carbon;



class EvaluacionController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
            
            return view('ADMIN.EVALUACIONDOCENTE.indexEvaluacion');
        }
        else{
            return redirect("/home");
        }
    }
    public function index(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
            if($request->ajax())
            {
                $evaluacion=DB::select('select * from evaluacion_docente 
                inner join docente_modulo on docente_modulo.id_doc_mod=evaluacion_docente.id_doc_mod
				inner join cursolicencia on cursolicencia.id_curlic=docente_modulo.id_curlic
				inner join paralelos on paralelos.id_paralelo= cursolicencia.id_paralelo
                inner join docente on docente.id_doc=docente_modulo.id_doc
                inner join modulo on modulo.id_mod=docente_modulo.id_mod
                inner join periodoacademico on evaluacion_docente.id_periodo=periodoacademico.id');
                return DataTables::of($evaluacion)
                ->addColumn('action',function($evaluacion){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarEvaluacion('.$evaluacion->id_evaluacion.')" class="btn btn-warning btn-sm " title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="delete" id="'.$evaluacion->id_evaluacion.'"  class="delete btn btn-danger  btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('ADMIN.EVALUACIONDOCENTE.indexEvaluacion');
        }
        else{
            return redirect("/home");
        }
    }
    public function cargarSelectEvaluacion()
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
           
           $periodos=DB::select('select DISTINCt periodoacademico.id,periodoacademico.fechaini,periodoacademico.fechafin, periodoacademico.nombre_tipolicencia from matricula 
           inner join periodoacademico on periodoacademico.id=matricula.id_periodo
          order by periodoacademico.fechaini desc');
           return response()->json($periodos);
        }
        else{
            return redirect("/home");
        }
    }
    public function cargarSelectCursos($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
           
           $cursos=DB::select('select DISTINCt cursolicencia.id_curlic,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,cursolicencia.duracion_meses,paralelos.nombre_paralelo from matricula 
           inner join periodoacademico on periodoacademico.id=matricula.id_periodo
		   inner join cursolicencia on cursolicencia.id_curlic=matricula.id_curlic
		    inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
			 inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
			 where periodoacademico.id=?
          order by tipolicencia.nombre_tlic ',[$id]);
           return response()->json($cursos);
        }
        else{
            return redirect("/home");
        }
    }
    public function cargarSelectModulos($id,$cur)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
           
           $modulos=DB::select('select DISTINCT docente_modulo.id_doc_mod,modulo.id_mod,modulo.nombre_mod,docente.apellido_doc,docente.name from matricula
                       inner join cursolicencia on matricula.id_curlic = cursolicencia.id_curlic
                       inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
                       inner join modulo on modulo.id_mod = docente_modulo.id_mod
                       inner join docente on docente.id_doc = docente_modulo.id_doc
                       inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
                       inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
                       inner join docentemodulo_horario on docentemodulo_horario.id_doc_mod=docente_modulo.id_doc_mod
                       inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
                       inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo	
                       where periodoacademico.id=? and cursolicencia.id_curlic=?
                       order by modulo.nombre_mod asc',[$id,$cur]);
           return response()->json($modulos);
        }
        else{
            return redirect("/home");
        }
    }

   
   
    public function ingresar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
            //llamarr procedimiento 
            $evaluacione=DB::select("select * from evaluacion_docente
                        inner join docente_modulo on docente_modulo.id_doc_mod=evaluacion_docente.id_doc_mod
                        where evaluacion_docente.id_periodo=? and id_curlic=? and evaluacion_docente.id_doc_mod=?",[$request->id_periodo,$request->id_curlic,$request->id_doc_mod]);
            if($evaluacione) 
            {
                return false;
            }
            else{
                $now = new \DateTime("America/Guayaquil");
                $fechaactual=$now->format('Y-m-d');
                $periodoactual=DB::select("select * from periodoacademico
                where id=? and ? >= fechaini and ? <= fechafin"
                ,[$request->id_periodo,$fechaactual,$fechaactual]);
                if($periodoactual)
                {
                    $fechasingresadas=DB::select("select * from periodoacademico
                    where id=? and ? >= fechaini and ? <= fechafin"
                    ,[$request->id_periodo,$request->fecha_ini_evaluacion,$request->fecha_fin_evaluacion]);
                    if($fechasingresadas)
                    {
                        $evaluacion=DB::select('CALL insertarEvaluacionDocente(?,?,?,?,?,?)',
                        [$request->id_doc_mod,$request->id_periodo,$request->fecha_ini_evaluacion,$request->fecha_fin_evaluacion,$request->estado,$request->link_evaluacion]);
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
   
    public function eliminar($id){
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
            $idPeriodo= DB::table('evaluacion_docente')
            ->select('id_periodo')
            ->where('id_evaluacion', $id)
            ->first()
            ->id_periodo;
            $now = new \DateTime("America/Guayaquil");
                $fechaactual=$now->format('Y-m-d');
                $periodoactual=DB::select("select * from periodoacademico
                where id=? and ? >= fechaini and ? <= fechafin"
                ,[$idPeriodo,$fechaactual,$fechaactual]);
                if($periodoactual)
                {
                    $evaluacion=DB::select('call eliminarEvaluacion(?)',[$id]);
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
    
    public function editar($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
           
            $idPeriodo= DB::table('evaluacion_docente')
            ->select('id_periodo')
            ->where('id_evaluacion', $id)
            ->first()
            ->id_periodo;
            $now = new \DateTime("America/Guayaquil");
                $fechaactual=$now->format('Y-m-d');
                $periodoactual=DB::select("select * from periodoacademico
                where id=? and ? >= fechaini and ? <= fechafin"
                ,[$idPeriodo,$fechaactual,$fechaactual]);
                if($periodoactual)
                {
                    $modulo = DB::table('docente_modulo')
                    ->join('modulo', 'modulo.id_mod', '=', 'docente_modulo.id_mod')
                    ->join('docente', 'docente.id_doc', '=', 'docente_modulo.id_doc')
                    ->join('evaluacion_docente', 'evaluacion_docente.id_doc_mod', '=', 'docente_modulo.id_doc_mod')
                    ->select('docente_modulo.id_doc_mod','modulo.nombre_mod','docente.apellido_doc','docente.name','docente_modulo.id_curlic')
                    ->where('evaluacion_docente.id_evaluacion', '=', $id)
                    ->get();
                
                    $periodos=DB::select('select DISTINCt periodoacademico.id,periodoacademico.fechaini,periodoacademico.fechafin, periodoacademico.nombre_tipolicencia from matricula 
                    inner join periodoacademico on periodoacademico.id=matricula.id_periodo
                order by periodoacademico.fechaini desc');
                
                    $evaluacion=DB::select('select * from evaluacion_docente  where id_evaluacion=?',[$id]);
                    $datos = Arr::collapse([$evaluacion,$periodos,$modulo]);
                    return response()->json($datos);
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
   
    public function actualizar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
            $evaluacione=DB::select("select * from evaluacion_docente
            inner join docente_modulo on docente_modulo.id_doc_mod=evaluacion_docente.id_doc_mod
            where evaluacion_docente.id_periodo=? and id_curlic=? and evaluacion_docente.id_doc_mod=?",[$request->id_periodo,$request->id_curlic,$request->id_doc_mod]);
            foreach($evaluacione as $e)
            {
                if($e->id_evaluacion!=$request->id_evaluacion) 
                {
                    return false;
                }
                else{
                    $evaluacion=DB::select('CALL actualizarEvaluacionDocente(?,?,?,?,?,?,?)',
                    [$request->id_evaluacion,$request->id_doc_mod,$request->id_periodo,$request->fecha_ini_evaluacion,$request->fecha_fin_evaluacion,$request->estado,$request->link_evaluacion]);
                    return back();
                }
            }
            
            
        }
        else{
            return redirect("/home");
        }
    }
    
    
    public function cargarSelectEvaluaciones($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
           
           $evaluaciones=DB::select('select DISTINCt evaluacion_docente.id_evaluacion, docente_modulo.id_doc_mod,modulo.nombre_mod,docente.apellido_doc,docente.name from evaluacion_docente 
           inner join periodoacademico on periodoacademico.id=evaluacion_docente.id_periodo
		   inner join docente_modulo on docente_modulo.id_doc_mod=evaluacion_docente.id_doc_mod
		    inner join modulo on modulo.id_mod = docente_modulo.id_mod
            inner join docente on docente.id_doc = docente_modulo.id_doc
			 where periodoacademico.id=?
          order by modulo.nombre_mod',[$id]);
           return response()->json($evaluaciones);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function tablaPreguntas($idP)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
           
            $preguntas=DB::select("select pregunta.id_pregunta,pregunta.pregunta,pregunta.aspecto_evaluar  from pregunta 
            inner join evaluacion_docente on evaluacion_docente.id_evaluacion = pregunta.id_evaluacion
            where evaluacion_docente.id_evaluacion=?
            order by pregunta.aspecto_evaluar",[$idP]);

            return view('ADMIN.PREGUNTAS.tablaPreguntas')->with('preguntas',$preguntas);
           
        }
        else{
            return redirect("/home");
        }
    }
      
    public function actualizarEstado(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
           
                $now = new \DateTime("America/Guayaquil");
                $fechaactual=$now->format('Y-m-d');
                $periodoactual=DB::select("select * from periodoacademico
                where id=? and ? >= fechaini and ? <= fechafin"
                ,[$request->id_periodo,$fechaactual,$fechaactual]);
                if($periodoactual)
                {
                    $evaluacion=DB::select('CALL actualizarEstadoEvaluacion(?,?)',
                    [$request->id_periodo,$request->estado]);
                    return true;
                }
                else{
                    false;
                }
        }
        else{
            return redirect("/home");
        }
    }
    public function evaluacionPeriodos()
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
           return view('ESTUDIANTE.EVALUACIONDOCENTE.indexEvaluacion',$periodos);
           //return response()->json($periodosacademicos);
           
        }
        else{
            return redirect("/home");
        }
    }

    public function tablaEvaluacion($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
            $idEst= DB::table('estudiante')
            ->select('id_est')
            ->where('email_est', auth()->user()->email)
            ->first()
            ->id_est;
            $modulos=DB::select("select  evaluacion_docente.id_evaluacion,modulo.nombre_mod,docente.instruccion_doc,docente.apellido_doc,docente.name,evaluacion_docente.link_evaluacion,evaluacion_docente.fecha_ini_evaluacion,fecha_fin_evaluacion,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia from evaluacion_docente 
            inner join periodoacademico on periodoacademico.id=evaluacion_docente.id_periodo
            inner join docente_modulo on docente_modulo.id_doc_mod=evaluacion_docente.id_doc_mod
			inner join cursolicencia on cursolicencia.id_curlic=docente_modulo.id_curlic
            inner join paralelos on cursolicencia.id_paralelo=paralelos.id_paralelo
            inner join modulo on modulo.id_mod = docente_modulo.id_mod
            inner join docente on docente.id_doc = docente_modulo.id_doc
			inner join matricula on matricula.id_curlic = cursolicencia.id_curlic
			inner join estudiante on matricula.id_est = estudiante.id_est
            where periodoacademico.id=? and  estudiante.id_est=? and evaluacion_docente.estado='Activo' 
           order by modulo.nombre_mod",[$id,$idEst]);

            return view('ESTUDIANTE.EVALUACIONDOCENTE.tablaEvaluacion')->with('modulos',$modulos);
           
        }
        else{
            return redirect("/home");
        }
    }
    public function evalularDocente($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
            
            $evaluaciones=DB::select("select * from evaluacion_docente where id_evaluacion=?",[$id]);
         
            //return view('ESTUDIANTE.EVALUACIONDOCENTE.tablaEvaluacion')->with('modulos',$modulos);
            //$errorLog->timestamps = false;
            //$errorLog->created_at = date("Y-m-d H:i:s");
            
            $now = new \DateTime("America/Guayaquil");
            $var=$now->format('Y-m-d');
            //return response()->json($var);
            foreach($evaluaciones as $ev)
            {
                //return response()->json($ev->fecha_ini_evaluacion);
        
               if(($var>=$ev->fecha_ini_evaluacion) && ($var<=$ev->fecha_fin_evaluacion))
                {
                    $link=$ev->link_evaluacion;
                    return response()->json($link);
                }
                else
                {
                    return false;
                }
            }
            
            //return response()->json($var);
        }
        else{
            return redirect("/home");
        }
    }
    

}
