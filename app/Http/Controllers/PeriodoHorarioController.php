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
use App\Models\PeriodoAcademico;
use App\Models\PeriodoHorario;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
class PeriodoHorarioController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
       
    }
    
    public function indexVista(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            return view('PERIODOHORARIO.indexPeriodoHorario');
        }
        else{
            return redirect("/home");
        }
    }
    public function index(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            if($request->ajax())
            {
                $periodohorario=DB::select('select * from periodohorario
                inner join periodoacademico on periodohorario.id_periodo=periodoacademico.id');
                return DataTables::of($periodohorario)
                ->addColumn('action',function($periodohorario){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarPeriodoHorario('.$periodohorario->id_phorario.')" class="btn btn-warning btn-sm " title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="delete" id="'.$periodohorario->id_phorario.'"  class="delete btn btn-danger  btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('PERIODOHORARIO.indexPeriodoHorario');
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
                    where id=? and ? >= fechaini and ? <= fechafin"
                ,[$request->id_periodo,$request->fecha_inicio,$request->fecha_fin]);
                if($periodoactual)
                {
                    $existe=DB::select('select * from periodohorario where fecha_inicio=? and fecha_fin=? and id_periodo=?',[$request->fecha_inicio,$request->fecha_fin,$request->id_periodo]);

                    if($existe)
                    {
                        return 2;
                    }
                    else
                    {
                        //llamarr procedimiento 
                        $periodohorario=DB::select('CALL insertarPeriodoHorario(?,?,?)',
                        [$request->fecha_inicio,$request->fecha_fin,$request->id_periodo]);
                        return  true;
                    }
                        
                }
                else{
                    return  false;
                }
           
        }
        else{
            return redirect("/home");
        }
    }
     
    public function eliminar($id){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $idPeriodo= DB::table('periodohorario')
            ->select('id_periodo')
            ->where('id_phorario', $id)
            ->first()
            ->id_periodo;
            $now = new \DateTime("America/Guayaquil");
            $fechaactual=$now->format('Y-m-d');
            $periodoactual=DB::select("select * from periodoacademico
                where id=? and ? >= fechaini and ? <= fechafin"
            ,[$idPeriodo,$fechaactual,$fechaactual]);
            if($periodoactual)
            {
                $periodoacademico=DB::select('call eliminarPeriodoHorario(?)',[$id]);
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
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $periodosacademicos=DB::select('select * from periodoacademico order by fechaini,nombre_tipolicencia asc');
            $periodohorario=DB::select('select * from periodohorario where id_phorario=?',[$id]);
            $datos = Arr::collapse([$periodohorario,$periodosacademicos]);
            return response()->json($datos);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $now = new \DateTime("America/Guayaquil");
            $fechaactual=$now->format('Y-m-d');
            $periodoactual=DB::select("select * from periodoacademico
                where id=? and ? >= fechaini and ? <= fechafin"
            ,[$request->id_periodoh,$request->fecha_inicioh,$request->fecha_finh]);
            if($periodoactual)
            {
                $periodoacademico=DB::select('CALL actualizarPeriodoHorario(?,?,?,?)',
                [$request->id_phorario,$request->fecha_inicioh,$request->fecha_finh,$request->id_periodoh]);
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
    public function cargarperiodoa()
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $periodosA=DB::select('select * from periodoacademico order by fechaini desc');
           return response()->json($periodosA);
        }
        else{
            return redirect("/home");
        }
    }

}
