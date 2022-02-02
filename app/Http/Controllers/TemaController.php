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
use App\Models\Tema;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;


class TemaController extends Controller
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
   
    
    public function mostrarTemas($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['unidadesT']=DB::select('select * from unidades where id_unidad=?',[$id]);
             $temas=DB::table('temas')
                                ->select('*')
                                ->where('id_unidad',$id)
                                ->orderBy('orden_tema', 'asc')
                                ->get();
             return view('DOCENTE.SILABO.tablaTemas',$silabo)->with(compact('temas',$temas));
        }
        else{
            return redirect("/home");
        }
       
    }
    public function mostrarTemas2($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['unidadesT']=DB::select('select * from unidades where id_unidad=?',[$id]);
             $temas=DB::table('temas')
                                ->select('*')
                                ->where('id_unidad',$id)
                                ->orderBy('orden_tema', 'asc')
                                ->get();
             return view('DOCENTE.SILABOSOLODATOS.tablaTemas',$silabo)->with(compact('temas',$temas));
        }
        else{
            return redirect("/home");
        }
       
    }
    public function mostrarTemas3($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['unidadesT']=DB::select('select * from unidades where id_unidad=?',[$id]);
             $temas=DB::table('temas')
                                ->select('*')
                                ->where('id_unidad',$id)
                                ->orderBy('orden_tema', 'asc')
                                ->get();
             return view('DOCENTE.AVANCESACADEMICO.tablaTemas',$silabo)->with(compact('temas',$temas));
        }
        else{
            return redirect("/home");
        }
       
    }
    public function ingresarTema(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $unidad=DB::select('CALL insertarTema(?,?,?,?,?,?,?,?,?,?,?)',
            [$request->tipo_clase,$request->orden_tema,$request->titulo_tema,$request->actividadesdocencia_tema,$request->actdocpracapliexp_tema,$request->actaprauto_tema,$request->horasdocencia_tema,$request->horasapreexp_tema,$request->horastraaut_tema,$request->semana_tema,$request->id_unidadT]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    public function eliminartemas($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $unidad=DB::select('call eliminarTema(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function editartema($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $tablaTema=DB::select('select * from temas where id_tema=?',[$id]);
            return response()->json($tablaTema);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function actualizarTema(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $temas=DB::select('CALL actualizarTema(?,?,?,?,?,?,?,?,?,?,?)',
            [$request->id_tema,$request->tipo_clase,$request->orden_tema,$request->titulo_tema,$request->actividadesdocencia_tema,$request->actdocpracapliexp_tema,$request->actaprauto_tema,$request->horasdocencia_tema,$request->horasapreexp_tema,$request->horastraaut_tema,$request->semana_tema]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
}
