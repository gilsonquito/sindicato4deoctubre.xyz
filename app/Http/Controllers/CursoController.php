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
use App\Models\Curso;
use App\Models\Paralelo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
class CursoController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    public function indexVista(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            return view('CURSOS.indexCurso');
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
                $cursos=DB::select('select * from cursolicencia
                inner join tipolicencia on cursolicencia.id_tlic = tipolicencia.id_tlic
                inner join paralelos on cursolicencia.id_paralelo = paralelos.id_paralelo');
                return DataTables::of($cursos)
                ->addColumn('action',function($cursos){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarCurso('.$cursos->id_curlic.')" class="btn btn-warning btn-sm " title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="delete" id="'.$cursos->id_curlic.'"  class="delete btn btn-danger  btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('CURSOS.indexCurso');
        }
        else{
            return redirect("/home");
        }
    }
   
   
    public function ingresar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            //llamarr procedimiento 
            $cursos=DB::select('CALL insertarCurso(?,?,?,?,?)',
            [$request->id_tlic,$request->jornada,$request->modalidad,$request->duracion_meses,$request->id_paralelo]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
     
    public function eliminar($id){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $cursos=DB::select('call eliminarCurso(?)',[$id]);
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
            $tipolicencias=DB::select('select * from tipolicencia ORDER BY nombre_tlic');
            $paralelos=DB::select('select * from paralelos ORDER BY nombre_paralelo');
            $curso=DB::select('select * from cursolicencia  where id_curlic=?',[$id]);
            $datos = Arr::collapse([$curso,$tipolicencias,$paralelos]);
            return response()->json($datos);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $cursos=DB::select('CALL actualizarCurso(?,?,?,?,?,?)',
            [$request->id_curlic,$request->id_tlic,$request->jornada,$request->modalidad,$request->duracion_meses,$request->id_paralelo]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function cargarSelect()
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $paralelos = Paralelo::select("*")
            ->orderBy('nombre_paralelo', 'asc')
            ->get();
            $cursos=DB::select('select * from tipolicencia ORDER BY nombre_tlic ');
            $datos = Arr::collapse([$cursos,$paralelos]);
           return response()->json($datos);
        }
        else{
            return redirect("/home");
        }
    }
   
   

}
