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
use App\Models\Paralelo;



class ParaleloController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    public function indexVista(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            return view('PARALELO.indexParalelo');
        }
        else{
            return redirect("/home");
        }
    }
    public function index(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            if($request->ajax())
            {
                $paralelo=DB::select('select * from paralelos');
                return DataTables::of($paralelo)
                ->addColumn('action',function($paralelo){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarParalelo('.$paralelo->id_paralelo.')" class="btn btn-warning btn-sm " title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="delete" id="'.$paralelo->id_paralelo.'"  class="delete btn btn-danger  btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('PARALELO.indexParalelo');
        }
        else{
            return redirect("/home");
        }
    }
   
    public function ingresar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            //llamarr procedimiento 
            $paralelo=DB::select('CALL insertarparalelo(?)',
            [$request->nombre_paralelo]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
     
    public function eliminar($id){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $paralelo=DB::select('call eliminarparalelo(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function editar($id)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $paralelos=DB::select('select * from paralelos where id_paralelo=?',[$id]);
            return response()->json($paralelos);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $paralelos=DB::select('CALL actualizarparalelo(?,?)',
            [$request->id_paralelo,$request->nombre_paralelo]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }

}
