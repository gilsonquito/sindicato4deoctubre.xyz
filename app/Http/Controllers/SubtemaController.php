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
use App\Models\Subtema;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;


class SubtemaController extends Controller
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
    public function mostrarSubTemas($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['temasS']=DB::select('select * from temas 
            inner join unidades on unidades.id_unidad=temas.id_unidad 
            where id_tema=?',[$id]);
             $subtemas=DB::table('subtemas')
                                ->select('*')
                                ->where('id_tema',$id)
                                ->orderBy('orden_subtema', 'asc')
                                ->get();
             return view('DOCENTE.SILABO.tablaSubtemas',$silabo)->with(compact('subtemas',$subtemas));
        }
        else{
            return redirect("/home");
        }  
    }
    public function mostrarSubTemas2($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['temasS']=DB::select('select * from temas 
            inner join unidades on unidades.id_unidad=temas.id_unidad 
            where id_tema=?',[$id]);
             $subtemas=DB::table('subtemas')
                                ->select('*')
                                ->where('id_tema',$id)
                                ->orderBy('orden_subtema', 'asc')
                                ->get();
             return view('DOCENTE.SILABOSOLODATOS.tablaSubtemas',$silabo)->with(compact('subtemas',$subtemas));
        }  
        else{
            return redirect("/home");
        }
    }
    public function mostrarSubTemas3($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $temasS['temasS']=DB::select('select * from temas 
            inner join unidades on unidades.id_unidad=temas.id_unidad 
            where id_tema=?',[$id]);
             $subtemas=DB::table('subtemas')
                                ->select('*')
                                ->where('id_tema',$id)
                                ->orderBy('orden_subtema', 'asc')
                                ->get();
             return view('DOCENTE.AVANCESACADEMICO.tablaSubtemas',$temasS)->with(compact('subtemas',$subtemas));
        }
        else{
            return redirect("/home");
        }  
    }
    
    public function ingresarSubTema(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $subtema=DB::select('CALL insertarSubTema(?,?,?)',
            [$request->orden_subtema,$request->titulo_subtema,$request->id_tema]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    public function eliminarSubtema($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $subtema=DB::select('call eliminarSubTema(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function editarSubtema($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $tablaSubTema=DB::select('select * from subtemas where id_subtema=?',[$id]);
            return response()->json($tablaSubTema);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function actualizarSubTema(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $subtemas=DB::select('CALL actualizarSubTema(?,?,?)',
            [$request->id_subtema,$request->orden_subtema,$request->titulo_subtema]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
}
