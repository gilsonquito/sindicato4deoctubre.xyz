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
use App\Models\RecursosEnseñanza;

use Illuminate\Http\Response;



class RecursosEnseñanzaController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            
            return view('DOCENTE.SILABO.tablaRecursos');
        }
        else{
            return redirect("/home");
        }
    }
    public function index(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $id = $request->session()->get('idSilabo');
            //$id = 3;
           // $silabo['Rsilabos']=DB::select('select id_sil from silabo where id_sil=?',[$id]);
            if($request->ajax())
            {
                $recurso=DB::select('select * from recursos_enseñanza where id_sil=? ',[$id]);
                return DataTables::of($recurso)
                ->addColumn('action',function($recurso){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarRecursoE('.$recurso->id_recurso.')" class="btn btn btn-outline-warning btn-sm" title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="DeleteRecurso" id="'.$recurso->id_recurso.'"  class="DeleteRecurso btn btn-outline-danger btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            //return view('PARALELO.indexParalelo');
            return view('DOCENTE.SILABO.tablaRecursos');
        }
        else{
            return redirect("/home");
        }
    }
    
    public function index2Vista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            return view('DOCENTE.SILABOSOLODATOS.tablaRecursos');
        }
        else{
            return redirect("/home");
        }
    }
    public function index2(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $id = $request->session()->get('idSilabo');
            if($request->ajax())
            {
                $recurso=DB::select('select * from recursos_enseñanza where id_sil=? ',[$id]);
                return DataTables::of($recurso)
                ->addColumn('action',function($recurso){
                    $acciones='';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.SILABOSOLODATOS.tablaRecursos');
        }
        else{
            return redirect("/home");
        }
    }
    
    
    public function ingresarRecurso(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $recursos=DB::select('CALL insertarRecursoEnseñanza(?,?)',
            [$request->descripcion_recurso,$request->id_sil]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
   
    public function eliminarRecurso($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $recurso=DB::select('call eliminarRecursoEnseñanza(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
  
    public function editarRecurso($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $recurso=DB::select('select * from recursos_enseñanza where id_recurso=?',[$id]);
            return response()->json($recurso);
        }
        else{
            return redirect("/home");
        }
    }
       
    public function actualizarRecurso(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $recurso=DB::select('CALL actualizarRecursoEnseñanza(?,?)',
            [$request->id_recurso,$request->descripcion_recurso]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function visualizarRecursos($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $idSil= DB::table('avanceacademico')
            ->select('id_sil')
            ->where('id_avance', $id)
            ->first()
            ->id_sil;
             $recursos=DB::table('recursos_enseñanza')
                                ->select('*')
                                ->where('id_sil',$idSil)
                                ->orderby('descripcion_recurso','asc')
                                ->get();
             return view('DOCENTE.AVANCESACADEMICO.recursosAvance')->with(compact('recursos',$recursos));
        } 
        else{
            return redirect("/home");
        }
    }
}
