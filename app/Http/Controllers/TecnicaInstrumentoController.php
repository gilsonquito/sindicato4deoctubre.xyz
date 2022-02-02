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
use App\Models\TecnicaInstrumento;

use Illuminate\Http\Response;



class TecnicaInstrumentoController extends Controller
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
    public function mostrarTecnicasInstrumentos($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['unidadesT']=DB::select('select id_unidad from unidades where id_unidad=?',[$id]);
             $tecnicas=DB::table('tecnicas_unidad')
                                ->select('*')
                                ->where('id_unidad',$id)
                                ->orderBy('tecnica', 'asc')
                                ->get();
             return view('DOCENTE.SILABO.tablaTecnicasInstrumentos',$silabo)->with(compact('tecnicas',$tecnicas));
        }
        else{
            return redirect("/home");
        }  
    }
    public function mostrarTecnicasInstrumentos2($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['unidadesT']=DB::select('select id_unidad from unidades where id_unidad=?',[$id]);
             $tecnicas=DB::table('tecnicas_unidad')
                                ->select('*')
                                ->where('id_unidad',$id)
                                ->orderBy('tecnica', 'asc')
                                ->get();
             return view('DOCENTE.SILABOSOLODATOS.tablaTecnicasInstrumentos',$silabo)->with(compact('tecnicas',$tecnicas));
        }
        else{
            return redirect("/home");
        }  
    }
    
    public function ingresarTecnicaInstrumento(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $evalaucion=DB::select('CALL insertarTecnicaInstrumento(?,?,?)',
            [$request->tecnica,$request->instrumento,$request->id_unidad]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function eliminarTI($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $tecnica=DB::select('call eliminarTecnicaInstrumento(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
   
    public function editarTI($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $TECNICA=DB::select('select * from tecnicas_unidad where id_tecnicas=?',[$id]);
            return response()->json($TECNICA);
        }
        else{
            return redirect("/home");
        }
    }
     
    public function actualizarTI(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $subtemas=DB::select('CALL actualizarTecnicaInstrumento(?,?,?)',
            [$request->id_tecnicas,$request->tecnica,$request->instrumento]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
}
