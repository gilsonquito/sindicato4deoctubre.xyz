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
use App\Models\TipoLicencia;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
class PeriodoAcademicoController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('soloadmin',['only'=> ['index']]);
    }
  
    public function index(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            if($request->ajax())
            {
                $periodoacademico=DB::select('select * from periodoacademico');
                return DataTables::of($periodoacademico)
                ->addColumn('action',function($periodoacademico){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarPeriodo('.$periodoacademico->id.')" class="btn btn-warning btn-sm " title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="delete" id="'.$periodoacademico->id.'"  class="delete btn btn-danger  btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('periodoAcademico.indexPA');
        }
        else{
            return redirect("/home");
        }
    }
   
    public function ingresar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            //llamarr procedimiento 
            $periodoacademico=DB::select('CALL insertarPeriodo(?,?,?)',
            [$request->fechaini,$request->fechafin,$request->TipoLicencia]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
     
    public function eliminar($id){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            $periodoacademico=DB::select('call eliminarPeriodo(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function editar($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            $cursos=DB::select('select * from tipolicencia ORDER BY nombre_tlic');
            $periodoacademico=DB::select('select * from periodoacademico  where id=?',[$id]);
            $datos = Arr::collapse([$periodoacademico,$cursos]);
            return response()->json($datos);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            $periodoacademico=DB::select('CALL actualizarPeriodo(?,?,?,?)',
            [$request->id,$request->fechaini,$request->fechafin,$request->TipoLicencia]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function cargarlicencia()
    {
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            //$cursos = TipoLicencia::select("*")
            //->orderBy('nombre_tlic', 'asc')
            //->get();
            $cursos=DB::select('select * from tipolicencia ORDER BY nombre_tlic ');
           return response()->json($cursos);
        }
        else{
            return redirect("/home");
        }
    }
    public function periodosAcademicos()
    {
        if ((auth()->check()) && (auth()->user()->rol=="4"))
        {
            $periodos=DB::select('select * from periodoacademico order by fechaini desc,nombre_tipolicencia ');
           return response()->json($periodos);
        }
        else{
            return redirect("/home");
        }
    }
    

}
