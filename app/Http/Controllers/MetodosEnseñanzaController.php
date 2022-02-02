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
use App\Models\Metodos;

use Illuminate\Http\Response;



class MetodosEnseñanzaController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function variableSesion($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            session(['idSilabo' => $id]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            return view('DOCENTE.SILABO.indexMetodos');
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
            $silabo['Msilabos']=DB::select('select id_sil from silabo where id_sil=?',[$id]);
            if($request->ajax())
            {
               
               
                $metodos=DB::select('select * from metodos_enseñanza where id_sil=? ',[$id]);
                return DataTables::of($metodos)
                ->addColumn('action',function($metodos){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarMetodoE('.$metodos->id_metodo.')" class="btn btn btn-outline-warning btn-sm" title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="DeleteMetodo" id="'.$metodos->id_metodo.'"  class="DeleteMetodo btn btn-outline-danger btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            //return view('PARALELO.indexParalelo');
            return view('DOCENTE.SILABO.indexMetodos',$silabo);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function index2Vista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            
            return view('DOCENTE.SILABOSOLODATOS.indexMetodos');
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
            $silabo['Msilabos']=DB::select('select id_sil from silabo where id_sil=?',[$id]);
            if($request->ajax())
            {
               
               
                $metodos=DB::select('select * from metodos_enseñanza where id_sil=? ',[$id]);
                return DataTables::of($metodos)
                ->addColumn('action',function($metodos){
                    $acciones='';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            //return view('PARALELO.indexParalelo');
            return view('DOCENTE.SILABOSOLODATOS.indexMetodos',$silabo);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function mostrarMetodos($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['Msilabos']=DB::select('select id_sil from silabo where id_sil=?',[$id]);
             $metodos=DB::table('metodos_enseñanza')
                                ->select('*')
                                ->where('id_sil',$id)
                                ->orderby('descripcion_metodo','asc')
                                ->get();
             return view('DOCENTE.SILABO.tablaMetodos',$silabo)->with(compact('metodos',$metodos));
        } 
        else{
            return redirect("/home");
        }
    }
    function get_ajax_Metodos($id,Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            if($request->ajax())
            {
                if ((auth()->check()) && (auth()->user()->rol=="3"))
                {  
                    $silabo['Msilabos']=DB::select('select id_sil from silabo where id_sil=?',[$id]);
                    $metodos=DB::table('metodos_enseñanza')
                                        ->select('*')
                                        ->where('id_sil',$id)
                                        ->orderby('descripcion_metodo','asc')
                                        ->paginate(6);               
                    return view('DOCENTE.SILABO.metodos',$silabo)->with(compact('metodos',$metodos));
                } 
                    
            }
            return response()->json($id);  
        }
        else{
            return redirect("/home");
        }
    }
    public function ingresarMetodos(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $metodos=DB::select('CALL insertarMetodoEnseñanza(?,?)',
            [$request->descripcion_metodo,$request->id_sil]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
   
    public function eliminarMetodos($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $resultado=DB::select('call eliminarMetodoEnseñanza(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
  
    public function editarMetodos($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $metodo=DB::select('select * from metodos_enseñanza where id_metodo=?',[$id]);
            return response()->json($metodo);
        }
        else{
            return redirect("/home");
        }
    }
       
    public function actualizarMetodos(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $metodos=DB::select('CALL actualizarMetodoEnseñanza(?,?)',
            [$request->id_metodo,$request->descripcion_metodo]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function visualizarMetodos($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $idSil= DB::table('avanceacademico')
            ->select('id_sil')
            ->where('id_avance', $id)
            ->first()
            ->id_sil;
             $metodos=DB::table('metodos_enseñanza')
                                ->select('*')
                                ->where('id_sil',$idSil)
                                ->orderby('descripcion_metodo','asc')
                                ->get();
             return view('DOCENTE.AVANCESACADEMICO.metodos')->with(compact('metodos',$metodos));
        } 
        else{
            return redirect("/home");
        }
    }
}
