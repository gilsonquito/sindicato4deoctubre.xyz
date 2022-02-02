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
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Paralelo;
use App\Models\Estudiante;
use App\Models\PeriodoAcademico;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;


class MatriculaController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
            
            return view('MATRICULAS.indexMatricula');
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
                $matriculas=DB::select('select matricula.id_matricula,estudiante.apellido_est,estudiante.name_est,estudiante.cedula_est,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,cursolicencia.duracion_meses,paralelos.nombre_paralelo,periodoacademico.fechaini,periodoacademico.fechafin,periodoacademico.nombre_tipolicencia from matricula
                inner join cursolicencia on cursolicencia.id_curlic = matricula.id_curlic
                inner join estudiante on estudiante.id_est = matricula.id_est
                inner join periodoacademico on periodoacademico.id = matricula.id_periodo
                inner join paralelos on cursolicencia.id_paralelo = paralelos.id_paralelo
                inner join tipolicencia on cursolicencia.id_tlic = tipolicencia.id_tlic');
                return DataTables::of($matriculas)
                ->addColumn('action',function($matriculas){
                    $acciones='<div class="row justify-content-center"><div class="p-1 "><a href="javascript:void(0)" onclick="editarMatricula('.$matriculas->id_matricula.')" class="btn btn-warning btn-sm " title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1 "><button type="button" name="delete" id="'.$matriculas->id_matricula.'"  class="delete btn btn-danger  btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('MATRICULAS.indexMatricula');
        }
        else{
            return redirect("/home");
        }
    }
    public function cargarSelect()
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
            $cursos = DB::table('cursolicencia')
            ->join('tipolicencia', 'cursolicencia.id_tlic', '=', 'tipolicencia.id_tlic')
            ->join('paralelos', 'cursolicencia.id_paralelo', '=', 'paralelos.id_paralelo')
            ->select('*')
            ->orderBy('nombre_tlic', 'asc')
            ->get();
            $estudiantes =Estudiante::select("*")
            ->orderBy('apellido_est', 'asc')
            ->get();
           
            $periodos = PeriodoAcademico::select("*")
            ->orderBy('fechaini', 'desc')
            ->get();
            $datos = Arr::collapse([$cursos,$periodos,$estudiantes]);
           return response()->json($datos);
        }
        else{
            return redirect("/home");
        }
    }
   
   
    public function ingresar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
            $now = new \DateTime("America/Guayaquil");
            $fechaactual=$now->format('Y-m-d');
            $periodoactual=DB::select("select * from periodoacademico
                where id=? and ? <= fechafin"
            ,[$request->id_periodo,$fechaactual]);
            if($periodoactual)
            {
                $matricula=DB::select("select * from matricula
                where id_curlic=? and id_est=? and id_periodo=?"
                ,[$request->id_curlic,$request->id_est,$request->id_periodo]);
                if($matricula)
                {
                    return 2;
                }
                else{
                    $matricula=DB::select('CALL insertarMatricula(?,?,?)',
                    [$request->id_curlic,$request->id_est,$request->id_periodo]);
                    return  1;
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
     
    public function eliminar($id){
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
            $idPeriodo= DB::table('matricula')
            ->select('id_periodo')
            ->where('id_matricula', $id)
            ->first()
            ->id_periodo;
            $now = new \DateTime("America/Guayaquil");
            $fechaactual=$now->format('Y-m-d');
            $periodoactual=DB::select("select * from periodoacademico
                where id=? and ? <= fechafin"
            ,[$idPeriodo,$fechaactual]);
            if($periodoactual)
            {
                $cursos=DB::select('call eliminarMatricula(?)',[$id]);
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
    public function editar($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {           
            $cursos = DB::table('cursolicencia')
            ->join('tipolicencia', 'cursolicencia.id_tlic', '=', 'tipolicencia.id_tlic')
            ->join('paralelos', 'cursolicencia.id_paralelo', '=', 'paralelos.id_paralelo')
            ->select('*')
            ->orderBy('nombre_tlic', 'asc')
            ->get();
            $estudiantes =Estudiante::select("*")
            ->orderBy('apellido_est', 'asc')
            ->get();
           
            $periodos = PeriodoAcademico::select("*")
            ->orderBy('fechaini', 'desc')
            ->get();
            $matricula=DB::select('select * from matricula where id_matricula=?',[$id]);
            $datos = Arr::collapse([$matricula,$cursos,$periodos,$estudiantes]);
            return response()->json($datos);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
            $idPeriodo= DB::table('matricula')
            ->select('id_periodo')
            ->where('id_matricula', $request->id_matricula)
            ->first()
            ->id_periodo;
            $now = new \DateTime("America/Guayaquil");
            $fechaactual=$now->format('Y-m-d');
            $periodoactual=DB::select("select * from periodoacademico
                where id=? and ? <= fechafin"
            ,[$idPeriodo,$fechaactual]);
            if($periodoactual)
            {
                $matricula=DB::select('CALL actualizarMatricula(?,?,?,?)',
                [$request->id_matricula,$request->id_curlic,$request->id_est,$request->id_periodo]);
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
    public function cambiarCursoEstudiante($idP,$idCur)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
           
            $tipoLicencia= DB::table('periodoacademico')
                ->select('nombre_tipolicencia')
                ->where('id', $idP)
                ->first()
                ->nombre_tipolicencia;
            $estudiantes=DB::select("select  distinct estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,cursolicencia.id_curlic,tipolicencia.id_tlic,tipolicencia.nombre_tlic,paralelos.id_paralelo,paralelos.nombre_paralelo from matricula as m
            inner join estudiante on estudiante.id_est = m.id_est
            inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
            inner join periodoacademico on periodoacademico.id=m.id_periodo
            where periodoacademico.id=? and  cursolicencia.id_curlic=?
            order by estudiante.apellido_est,estudiante.name_est ",[$idP,$idCur]);
            $cursos['cursos'] = DB::table('cursolicencia')
            ->join('tipolicencia', 'cursolicencia.id_tlic', '=', 'tipolicencia.id_tlic')
            ->join('paralelos', 'cursolicencia.id_paralelo', '=', 'paralelos.id_paralelo')
            ->select('*')
            ->where('tipolicencia.nombre_tlic', $tipoLicencia)
            ->orderBy('nombre_tlic', 'asc')
            ->orderBy('jornada', 'asc')
            ->orderBy('modalidad', 'asc')
            ->orderBy('nombre_paralelo', 'asc')
            ->get();
            return view('MATRICULAS.gestionCursos',$cursos)->with('estudiantes',$estudiantes);
           
        }
        else{
            return redirect("/home");
        }
    }
    public function cambiarCursoParaleloEstudiante(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
            $now = new \DateTime("America/Guayaquil");
            $fechaactual=$now->format('Y-m-d');
            $periodoactual=DB::select("select * from periodoacademico
                where id=? and ? <= fechafin"
            ,[$request->id_periodo,$fechaactual]);
            if($periodoactual)
            {
                $matricula=DB::select('CALL actualizarParaleloEstudiante(?,?)',
                [$request->id_matricula,$request->id_curlic]);
                return 1;
            }
            else{
                return false;
            }
           
        }
        else{
            return redirect("/home");
        }
    }
}
