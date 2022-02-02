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
use App\Models\DocenteModulo;
use App\Models\Docente;
use App\Models\User;
use App\Models\Modulo;
use App\Models\Curso;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;


class DocenteModuloController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
           
            return view('DOCENTEMODULO.indexDocenteModulo');
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
                /*$docentemodulo=DB::select('select docente_modulo.id_doc_mod,modulo.nombre_mod,docente.name,docente.apellido_doc,cursolicencia.tipo_licencia,cursolicencia.jornada,cursolicencia.modalidad from docente_modulo
                inner join docente on docente_modulo.id_doc = docente.id_doc
                inner join modulo on docente_modulo.id_mod=modulo.id_mod
                inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic');*/
                $docentemodulo=DB::select('select docente_modulo.id_doc_mod,modulo.nombre_mod,docente.name,docente.apellido_doc,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,paralelos.nombre_paralelo from docente_modulo
                inner join docente on docente_modulo.id_doc = docente.id_doc
                inner join modulo on docente_modulo.id_mod=modulo.id_mod
                inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
				inner join tipolicencia on cursolicencia.id_tlic = tipolicencia.id_tlic
				inner join paralelos on cursolicencia.id_paralelo = paralelos.id_paralelo');
                return DataTables::of($docentemodulo)
                ->addColumn('action',function($docentemodulo){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarDocenteModulo('.$docentemodulo->id_doc_mod.')" class="btn btn-warning btn-sm " title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="delete" id="'.$docentemodulo->id_doc_mod.'"  class="delete btn btn-danger  btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTEMODULO.indexDocenteModulo');
        }
        else{
            return redirect("/home");
        }
    }
   
 
    public function eliminar($id){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            
            $docentemodulo=DB::select('call eliminarDocenteModulo(?)',[$id]); 
           return back();

        
        }
        else{
            return redirect("/home");
        }
    }
    public function asignar(){ 
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            
            //$docentes = Docente::all();
            $docentes = Docente::select("*")
                ->orderBy('apellido_doc', 'asc')
                ->get();
            $modulos = Modulo::select("*")
            ->orderBy('nombre_mod', 'asc')
            ->get();
            $cursos = DB::table('cursolicencia')
            ->join('tipolicencia', 'cursolicencia.id_tlic', '=', 'tipolicencia.id_tlic')
            ->join('paralelos', 'cursolicencia.id_paralelo', '=', 'paralelos.id_paralelo')
            ->select('*')
            ->orderBy('nombre_tlic', 'asc')
            ->get();
            return view('DOCENTEMODULO.asignar')->with(compact('docentes','modulos','cursos'));
    
        }
        else{
            return redirect("/home");
        }
    }
     
    public function ingresar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {         
                    $existe=DB::select('select * from docente_modulo where id_mod=? and id_doc=? and id_curlic=?',[$request->id_mod,$request->id_doc,$request->id_curlic]);
                    if($existe)
                    {
                        return  2;   
                    }
                    else
                    {
                        $docentemodulo=DB::select('CALL insertarDocenteModulo(?,?,?)',
                        [$request->id_mod,$request->id_doc,$request->id_curlic]);
                        return  1;   
                    }
                                 
              
        }
        else{
            return redirect("/home");
        }
    }
    
    public function editar($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            $docentes = Docente::select("*")
            ->orderBy('apellido_doc', 'asc')
            ->get();
            $modulos = Modulo::select("*")
            ->orderBy('nombre_mod', 'asc')
            ->get();
            $cursos = DB::table('cursolicencia')
            ->join('tipolicencia', 'cursolicencia.id_tlic', '=', 'tipolicencia.id_tlic')
            ->join('paralelos', 'cursolicencia.id_paralelo', '=', 'paralelos.id_paralelo')
            ->select('*')
            ->orderBy('nombre_tlic', 'asc')
            ->get();
            $docentemodulo=DB::select('select * from docente_modulo  where id_doc_mod=?',[$id]);
           $datos = Arr::collapse([$docentemodulo,$docentes, $modulos,$cursos]);
           return response()->json($datos);
           
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            $docentemodulo=DB::select('CALL actualizarDocenteModulo(?,?,?,?)',
            [$request->id_doc_mod,$request->id_mod,$request->id_doc,$request->id_curlic]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
}
