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

use App\Models\Unidad;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;


class UnidadController extends Controller
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
   
    public function mostrarUnidades($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['silabosU']=DB::select('select id_sil from silabo where id_sil=?',[$id]);
             $unidades=DB::table('unidades')
                                ->select('*')
                                ->where('id_sil',$id)
                                ->orderBy('orden_unidad', 'asc')
                                ->get();
             return view('DOCENTE.SILABO.tablaUnidades',$silabo)->with(compact('unidades',$unidades));
        }
        else{
            return redirect("/home");
        }
       
    }
    public function mostrarUnidades2($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['silabosU']=DB::select('select id_sil from silabo where id_sil=?',[$id]);
             $unidades=DB::table('unidades')
                                ->select('*')
                                ->where('id_sil',$id)
                                ->orderBy('orden_unidad', 'asc')
                                ->get();
             return view('DOCENTE.SILABOSOLODATOS.tablaUnidades',$silabo)->with(compact('unidades',$unidades));
        }
        else{
            return redirect("/home");
        }
       
    }
    
    public function idSilabo($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            
            //$id = $request->session()->get('idAvance');
            $idSil= DB::table('avanceacademico')
                ->select('id_sil')
                ->where('id_avance', $id)
                ->first()
                ->id_sil;
            return response()->json($idSil); 
        }
        else{
            return redirect("/home");
        }
       
    }
    public function mostrarUnidades3($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            //$id = $request->session()->get('idAvance');
          
            $silabo['silabosU']=DB::select('select id_sil from silabo where id_sil=?',[$id]);
             $unidades=DB::table('unidades')
                                ->select('*')
                                ->where('id_sil',$id)
                                ->orderBy('orden_unidad', 'asc')
                                ->get();
             return view('DOCENTE.AVANCESACADEMICO.tablaUnidades',$silabo)->with(compact('unidades',$unidades));
        }
        else{
            return redirect("/home");
        }
       
    }
    
    public function ingresarUnidad(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $unidad=DB::select('CALL insertarUnidad(?,?,?,?,?)',
            [$request->ordenUnidad,$request->tituloUnidad,$request->horasUnidad,$request->criteriosUnidad,$request->id_silU]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function eliminarUnidad($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $unidad=DB::select('call eliminarUnidad(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function editarUnidad($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $tablaUnidad=DB::select('select * from unidades where id_unidad=?',[$id]);
            return response()->json($tablaUnidad);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function actualizarUnidad(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $unidades=DB::select('CALL actualizarUnidad(?,?,?,?,?)',
            [$request->id_unidad,$request->orden_unidad,$request->titulo_unidad,$request->horas_unidad,$request->criterioevaluacion_unidad]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    
    
}
