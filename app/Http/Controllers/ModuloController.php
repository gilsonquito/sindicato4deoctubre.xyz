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
use App\Models\Modulo;



class   ModuloController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
     
    }
    
    public function indexVistaM(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            return view('MODULO.indexModulo');
        }
        else{
            return redirect("/home");
        }
    }
    public function index(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            if($request->ajax())
            {
                $modulos=DB::select('select * from modulo');
                return DataTables::of($modulos)
                ->addColumn('action',function($modulos){
                    $acciones='<div class="row justify-content-center"><div class="p-1 "><a href="javascript:void(0)" onclick="editarModulo('.$modulos->id_mod.')" class="btn btn-warning btn-sm " title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1 "><button type="button" name="delete" id="'.$modulos->id_mod.'" class="delete btn btn-danger  btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('MODULO.indexModulo');
        }
        else{
            return redirect("/home");
        }
    }
   
    
   
   
    public function ingresar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            //llamarr procedimiento 
            $modulos=DB::select('CALL insertarModulo(?,?)',
            [$request->nombre_mod ,$request->duracion_horas]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function eliminar($id){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $modulos=DB::select('call eliminarModulo(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
     
    public function editar($id)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $modulos=DB::select('select * from modulo  where id_mod=?',[$id]);
            return response()->json($modulos);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function actualizar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $modulos=DB::select('CALL actualizarModulo(?,?,?)',
            [$request->id_mod,$request->nombre_mod,$request->duracion_horas]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function selectPeriodos()
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $periodosaca=DB::select("select DISTINCT periodoacademico.id,periodoacademico.fechaini,periodoacademico.fechafin,periodoacademico.nombre_tipolicencia from docentemodulo_horario
            inner join docente_modulo on docente_modulo.id_doc_mod = docentemodulo_horario.id_doc_mod
            inner join docente on docente_modulo.id_doc = docente.id_doc
            inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join matricula on matricula.id_curlic=cursolicencia.id_curlic
			inner join periodoacademico on matricula.id_periodo=periodoacademico.id
		
            where docente.id_doc=?
            order by periodoacademico.fechaini desc",[$idDoc]);
            return view('DOCENTE.MODULOS.indexModulo')->with('periodosaca',$periodosaca);
        }
        else{
            return redirect("/home");
        }
    }
    public function tablaModulosPeriodos($idP)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $modulos=DB::select("select distinct modulo.id_mod,modulo.nombre_mod,modulo.duracion_horas,paralelos.nombre_paralelo,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad from matricula as m
            inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
			 inner join modulo on modulo.id_mod = docente_modulo.id_mod
            inner join docentemodulo_horario on docentemodulo_horario.id_doc_mod=docente_modulo.id_doc_mod
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo	
            where periodoacademico.id=?  and docente_modulo.id_doc=?
            order by modulo.nombre_mod asc",[$idP,$idDoc]);
            return view('DOCENTE.MODULOS.tablaModulos')->with('modulos',$modulos);   
        }
        else{
            return redirect("/home");
        }
    }
    public function selectCursos($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $cursos=DB::select("select DISTINCT cursolicencia.id_curlic,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,cursolicencia.duracion_meses,paralelos.nombre_paralelo from matricula
            inner join cursolicencia on matricula.id_curlic = cursolicencia.id_curlic
			inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
			inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            inner join docentemodulo_horario on docentemodulo_horario.id_doc_mod=docente_modulo.id_doc_mod	
			where docente_modulo.id_doc=? and periodoacademico.id=?
			order by tipolicencia.nombre_tlic asc",[$idDoc,$id]);
            return response()->json($cursos);  
        }
        else{
            return redirect("/home");
        }
    }
    public function tablaModulosPeriodosCursos($idP,$idCur)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $modulos=DB::select("select distinct modulo.id_mod,modulo.nombre_mod,modulo.duracion_horas,paralelos.nombre_paralelo,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad from matricula as m
            inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
			inner join modulo on modulo.id_mod = docente_modulo.id_mod
            inner join docentemodulo_horario on docentemodulo_horario.id_doc_mod=docente_modulo.id_doc_mod	
			inner join periodohorario on periodohorario.id_phorario=docentemodulo_horario.id_phorario	
			inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo	
            where periodoacademico.id=?  and docente_modulo.id_doc=? and cursolicencia.id_curlic=?
            order by modulo.nombre_mod asc",[$idP,$idDoc,$idCur]);
            return view('DOCENTE.MODULOS.tablaModulos')->with('modulos',$modulos);   
        }
        else{
            return redirect("/home");
        }
    }

}
