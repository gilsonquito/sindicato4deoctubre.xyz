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
use App\Models\EscenariosAprendizaje;
use Illuminate\Http\Response;



class EscenariosAprendizajeController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
           
            return view('DOCENTE.SILABO.tablaEscenariosAprensizaje');
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
            if($request->ajax())
            {
                $escenarios=DB::select('select * from escenarios_aprendizaje where id_sil=? ',[$id]);
                return DataTables::of($escenarios)
                ->addColumn('action',function($escenarios){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarEscenarioE('.$escenarios->id_escenario.')" class="btn btn btn-outline-warning btn-sm" title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="DeleteEscenario" id="'.$escenarios->id_escenario.'"  class="DeleteEscenario btn btn-outline-danger btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.SILABO.tablaEscenariosAprensizaje');
        }
        else{
            return redirect("/home");
        }
    }
    
    public function index2Vista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            
            return view('DOCENTE.SILABOSOLODATOS.tablaEscenariosAprensizaje');
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
                $escenarios=DB::select('select * from escenarios_aprendizaje where id_sil=? ',[$id]);
                return DataTables::of($escenarios)
                ->addColumn('action',function($escenarios){
                    $acciones='';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.SILABOSOLODATOS.tablaEscenariosAprensizaje');
        }
        else{
            return redirect("/home");
        }
    }
    
    
    public function ingresarEscenario(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $escenario=DB::select('CALL insertarEscenariosAprendizaje(?,?)',
            [$request->descripcion_escenario,$request->id_sil]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
   
    public function eliminarEscenario($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $escenario=DB::select('call eliminarEscenariosAprendizaje(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
  
    public function editarEscenario($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $escenario=DB::select('select * from escenarios_aprendizaje where id_escenario=?',[$id]);
            return response()->json($escenario);
        }
        else{
            return redirect("/home");
        }
    }
       
    public function actualizarEscenario(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $recurso=DB::select('CALL actualizarEscenariosAprendizaje(?,?)',
            [$request->id_escenario,$request->descripcion_escenario]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
}
