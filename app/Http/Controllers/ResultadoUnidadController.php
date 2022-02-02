<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Silabo;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;//procedimientos bd
use Illuminate\Support\Collection;
use DataTables;
use App\Models\ResultadoUnidad;

use Illuminate\Http\Response;



class ResultadoUnidadController extends Controller
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
    public function mostrarRU($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $unidad['unidadesRU']=DB::select('select id_unidad from unidades where id_unidad=?',[$id]);
             $resultados=DB::table('resultados_unidad')
                                ->select('*')
                                ->where('id_unidad',$id)
                                ->get();
             return view('DOCENTE.SILABO.tablaResultadosU',$unidad)->with(compact('resultados',$resultados));
        }  
        else{
            return redirect("/home");
        }
    }
    public function mostrarRU2($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $unidad['unidadesRU']=DB::select('select id_unidad from unidades where id_unidad=?',[$id]);
             $resultados=DB::table('resultados_unidad')
                                ->select('*')
                                ->where('id_unidad',$id)
                                ->get();
             return view('DOCENTE.SILABOSOLODATOS.tablaResultadosU',$unidad)->with(compact('resultados',$resultados));
        } 
        else{
            return redirect("/home");
        } 
    }
    
    public function ingresarRU(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $resultado=DB::select('CALL insertarResultadoUnidad(?,?)',
            [$request->resultado,$request->id_unidad]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
   
    public function eliminarRU($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $resultado=DB::select('call eliminarResultadoUnidad(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function editarRU($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $TECNICA=DB::select('select * from resultados_unidad where id_resultado=?',[$id]);
            return response()->json($TECNICA);
        }
        else{
            return redirect("/home");
        }
    }
     
    public function actualizarRU(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $subtemas=DB::select('CALL actualizarResultadoUnidad(?,?)',
            [$request->id_resultado,$request->resultado]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
}
