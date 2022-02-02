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
use App\Models\TipoLicencia;



class TipoLicenciaController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('soloadmin',['only'=> ['index']]);
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            return view('TIPOLICENCIA.indexTipoLicencia');
        }
        else{
            return redirect("/home");
        }
    }
    public function index(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            if($request->ajax())
            {
                $tipolicencia=DB::select('select * from tipolicencia');
                return DataTables::of($tipolicencia)
                ->addColumn('action',function($tipolicencia){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarTipoLicencia('.$tipolicencia->id_tlic.')" class="btn btn-warning btn-sm " title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="delete" id="'.$tipolicencia->id_tlic.'"  class="delete btn btn-danger  btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('TIPOLICENCIA.indexTipoLicencia');
        }
        else{
            return redirect("/home");
        }
    }
   
    public function ingresar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            //llamarr procedimiento 
            $tipolicencia=DB::select('CALL insertartipodelicencia(?)',
            [$request->nombre_tlic]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
     
    public function eliminar($id){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            $tipolicencia=DB::select('call eliminartipolicencia(?)',[$id]);
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
            $tipolicencia=DB::select('select * from tipolicencia  where id_tlic=?',[$id]);
            return response()->json($tipolicencia);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            $tipolicencia=DB::select('CALL actualizartipolicencia(?,?)',
            [$request->id_tlic,$request->nombre_tlic]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }

}
