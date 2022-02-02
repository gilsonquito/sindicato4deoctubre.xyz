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
use App\Models\DocenteModuloHorario;
use App\Models\DocenteModulo;
use App\Models\Horario;
use App\Models\Docente;
use App\Models\PeriodoAcademico;
use App\Models\PeriodoHorario;
use App\Models\Modulo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use DateTime;
Use \Carbon\Carbon;
class DocenteModuloHorarioController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexsVista(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            
            return view('DOCENTEMODULOHORARIO.indexDocenteModuloHorario');
        }
        else{
            return redirect("/home");
        }
    }
    public function indexs(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            if($request->ajax())
            {
                $docentemodulohor=DB::select('select docentemodulo_horario.id_docmod_hor,docente_modulo.id_doc_mod,modulo.nombre_mod,docente.instruccion_doc,docente.name,docente.apellido_doc,horario.id_horario, horario.tipo_dias,horario.hora_inicio,horario.hora_fin,cursolicencia.id_tlic,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,paralelos.nombre_paralelo,periodohorario.fecha_inicio,periodohorario.fecha_fin,periodoacademico.fechaini,periodoacademico.fechafin from docente_modulo
                inner join docentemodulo_horario on docentemodulo_horario.id_doc_mod = docente_modulo.id_doc_mod
                inner join horario on docentemodulo_horario.id_horario =horario.id_horario
                inner join docente on docente_modulo.id_doc = docente.id_doc
                inner join modulo on docente_modulo.id_mod=modulo.id_mod
                inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
				inner join tipolicencia on cursolicencia.id_tlic = tipolicencia.id_tlic
				inner join paralelos on cursolicencia.id_paralelo = paralelos.id_paralelo
				inner join periodohorario on docentemodulo_horario.id_phorario = periodohorario.id_phorario
				inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo');
                return DataTables::of($docentemodulohor)
                ->addColumn('action',function($docentemodulohor){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarDocenteModuloHorario('.$docentemodulohor->id_docmod_hor.')" class="btn btn-warning btn-sm " title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="delete" id="'.$docentemodulohor->id_docmod_hor.'"  class="delete btn btn-danger  btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTEMODULOHORARIO.indexDocenteModuloHorario');
        }
        else{
            return redirect("/home");
        }
    }
   
  
    public function eliminar($id){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
                $id_PHorario= DB::table('docentemodulo_horario')
                ->select('id_phorario')
                ->where('id_docmod_hor', $id)
                ->first()
                ->id_phorario;
                $idPeriodo= DB::table('periodohorario')
                ->select('id_periodo')
                ->where('id_phorario',  $id_PHorario)
                ->first()
                ->id_periodo;
                $now = new \DateTime("America/Guayaquil");
                $fechaactual=$now->format('Y-m-d');
                $periodoactual=DB::select("select * from periodoacademico
                where id=? and ? <= fechafin",[$idPeriodo,$fechaactual]);
                if($periodoactual)
                {       
                    $docentemodulohorario=DB::select('call eliminardocentemodulohorario(?)',[$id]); 
                    return 1;
                }
                else{
                    return 2;
                }
           
        
        }
        else{
            return redirect("/home");
        }
    }
    public function asignar(){ 
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $docentes = Docente::select("*")
            ->orderBy('name', 'asc')
           ->get();
            $horarios = Horario::select("*")
             ->orderBy('id_horario', 'asc')
            ->get();
            $periodoscademicos = PeriodoAcademico::select("*")
             ->orderBy('fechaini', 'desc')
            ->get();
            return view('DOCENTEMODULOHORARIO.asignarHorario')->with(compact('periodoscademicos','horarios','docentes'));
        
        }
        else{
            return redirect("/home");
        }
    }
    
    public function ingresar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
                $now = new \DateTime("America/Guayaquil");
                $fechaactual=$now->format('Y-m-d');
                $periodoactual=DB::select("select * from periodoacademico
                where id=? and ? <= fechafin",[$request->id_periodo,$fechaactual]);
                if($periodoactual)
                {                
                    $docentemodulohorario=DB::select('CALL insertarDocenteModuloHorario(?,?,?)',
                     [$request->id_doc_mod,$request->id_horario,$request->id_phorario]);
                     return 1;  
                }
                else{
                    return 2;
                }              
        }
        else{
            return redirect("/home");
        }
    }
    public function editar($id)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {

            $docenteshe = DB::table('docente_modulo')
            ->join('docente', 'docente_modulo.id_doc', '=', 'docente.id_doc')
            ->join('modulo', 'docente_modulo.id_mod', '=', 'modulo.id_mod')
            ->join('cursolicencia', 'docente_modulo.id_curlic', '=', 'cursolicencia.id_curlic')
            ->join('tipolicencia', 'tipolicencia.id_tlic', '=', 'cursolicencia.id_tlic')
            ->join('paralelos', 'paralelos.id_paralelo', '=', 'cursolicencia.id_paralelo')
            ->select('*')
            ->orderBy('nombre_mod', 'asc')
            ->get();
            $horariose = Horario::select("*")
             ->orderBy('tipo_dias', 'asc')
             ->orderBy('hora_inicio', 'asc')
            ->get();
           $periodoshorarios =  DB::table('periodohorario')
           ->join('periodoacademico','periodohorario.id_periodo', '=', 'periodoacademico.id')
           ->select('*')
           ->orderBy('fecha_inicio', 'desc')
           ->get(); 
            $docentehorariose = DocenteModuloHorario::select("*")
             ->where('id_docmod_hor', '=', $id)
            ->get();
           $datose = Arr::collapse([$docentehorariose,$docenteshe,$horariose,$periodoshorarios]);
           return response()->json($datose);
           
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $docentemodulohorario=DB::select('CALL actualizarDocenteModuloHorario(?,?,?,?)',
            [$request->id_docmod_hor,$request->id_doc_mod,$request->id_horario,$request->id_phorario]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function cargarmodulos($id)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
           
            $modulosl = DB::table('docente_modulo')
            ->join('modulo', 'docente_modulo.id_mod', '=', 'modulo.id_mod')
            ->join('cursolicencia', 'docente_modulo.id_curlic', '=', 'cursolicencia.id_curlic')
            ->join('tipolicencia', 'tipolicencia.id_tlic', '=', 'cursolicencia.id_tlic')
            ->join('paralelos', 'paralelos.id_paralelo', '=', 'cursolicencia.id_paralelo')
            ->select('*')
            ->where('id_doc', '=', $id)
            ->orderBy('nombre_mod', 'asc')
            ->get();
           return response()->json($modulosl);
        }
        else{
            return redirect("/home");
        }
    }
    public function cargarminiperiodos($id)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
           
            $periodosm = DB::table('periodohorario')
            ->join('periodoacademico', 'periodoacademico.id', '=', 'periodohorario.id_periodo')
            ->select('*')
            ->where('id_periodo', '=', $id)
            ->orderBy('fecha_inicio', 'desc')
            ->get();
           return response()->json($periodosm);
        }
        else{
            return redirect("/home");
        }
    }
}
