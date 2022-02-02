<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Silabo;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;//procedimientos bd
use Illuminate\Support\Collection;
use DataTables;
use App\Models\EvaluacionUnidad;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;


class EvaluacionUnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function mostrarEvaluaciones($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['unidadesE']=DB::select('select id_unidad from unidades where id_unidad=?',[$id]);
             $evaluaciones=DB::table('evaluacion_unidad')
                                ->select('*')
                                ->where('id_unidad',$id)
                                ->orderBy('tipo_evaluacion', 'asc')
                                ->get();
             return view('DOCENTE.SILABO.evaluacionUnidad',$silabo)->with(compact('evaluaciones',$evaluaciones));
        }  
        else{
            return redirect("/home");
        }
    }
    public function mostrarEvaluaciones2($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['unidadesE']=DB::select('select id_unidad from unidades where id_unidad=?',[$id]);
             $evaluaciones=DB::table('evaluacion_unidad')
                                ->select('*')
                                ->where('id_unidad',$id)
                                ->orderBy('tipo_evaluacion', 'asc')
                                ->get();
             return view('DOCENTE.SILABOSOLODATOS.evaluacionUnidad',$silabo)->with(compact('evaluaciones',$evaluaciones));
        }  
        else{
            return redirect("/home");
        }
    }
    
    public function ingresarEvaluacion(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $evalaucion=DB::select('CALL insertarEvaluacionUnidad(?,?,?)',
            [$request->tipo_evaluacion,$request->detalle_evaluacion,$request->id_unidad]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    public function eliminarEvaluacion($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $subtema=DB::select('call eliminarEvaluacionUnidad(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function editarEvaluacion($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $evaluacionUnidad=DB::select('select * from evaluacion_unidad where id_evaluacion=?',[$id]);
            return response()->json($evaluacionUnidad);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function actualizarEvaluacion(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $subtemas=DB::select('CALL actualizarEvaluacionUnidad(?,?,?)',
            [$request->id_evaluacion,$request->tipo_evaluacion,$request->detalle_evaluacion]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
}
