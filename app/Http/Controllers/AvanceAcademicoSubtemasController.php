<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AvanceAcademicoSubtemas;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;//procedimientos bd
use Illuminate\Support\Collection;
use DataTables;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use DateTime;
Use \Carbon\Carbon;
class AvanceAcademicoSubtemasController extends Controller
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
    
    public function visualizarIndex($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $avances['avances']=DB::select("select * from avanceacademico where id_avance=?",[$id]);
            return view('DOCENTE.AVANCESACADEMICO.avanceSubtemas',$avances);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function index(Request $request,$id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            if($request->ajax())
            {
                //$id = $request->session()->get('idAvance');
                $avanceSubtema=DB::select('select avanceacademico_subtemas.id_avance_subtema,subtemas.titulo_subtema,temas.titulo_tema,unidades.titulo_unidad from avanceacademico_subtemas
                inner join subtemas on subtemas.id_subtema=avanceacademico_subtemas.id_subtema
                inner join temas on temas.id_tema=subtemas.id_tema
                inner join unidades on unidades.id_unidad=temas.id_unidad
                where id_avance=?',[$id]);
                return DataTables::of($avanceSubtema)
                ->addColumn('action',function($avanceSubtema){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a onclick="eliminarAvanceSubtemas('.$avanceSubtema->id_avance_subtema.')" class="btn btn-outline-danger btn-sm " title="Eliminar subtema agregado"><i class="fa fa-trash" aria-hidden="true"></i> </a></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
               
            }
         
            return view('DOCENTE.AVANCESACADEMICO.avanceSubtemas');
        }
        else{
            return redirect("/home");
        }
    }
    public function indexEditar(Request $request,$id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            if($request->ajax())
            {
                //$id = $request->session()->get('idAvance');
                $avanceSubtema=DB::select('select avanceacademico_subtemas.id_avance_subtema,subtemas.titulo_subtema,temas.titulo_tema,unidades.titulo_unidad from avanceacademico_subtemas
                inner join subtemas on subtemas.id_subtema=avanceacademico_subtemas.id_subtema
                inner join temas on temas.id_tema=subtemas.id_tema
                inner join unidades on unidades.id_unidad=temas.id_unidad
                where id_avance=?',[$id]);
                return DataTables::of($avanceSubtema)
                ->addColumn('action',function($avanceSubtema){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a onclick="eliminarAvanceSubtemas('.$avanceSubtema->id_avance_subtema.')" class="btn btn-outline-danger btn-sm " title="Eliminar subtema agregad"><i class="fa fa-trash" aria-hidden="true"></i> </a></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
               
            }
           
            return view('DOCENTE.AVANCESACADEMICO.avanceSubtemasEditar')->with(compact('idAvances',$id));
        }
        else{
            return redirect("/home");
        }
    }
    public function visualizarEditar($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $avances['avances']=DB::select("select * from avanceacademico where id_avance=?",[$id]);
            return view('DOCENTE.AVANCESACADEMICO.avanceSubtemasEditar',$avances);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function ingresar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
                $subtemaAvance=DB::select("select * from avanceacademico_subtemas
                where id_subtema=? and id_avance=?",[$request->id_subtema,$request->id_avance]);
                if($subtemaAvance) 
                {
                    return false;
                }
                else{
                    $avance=DB::select('CALL insertaravanceacademico_subtemas(?,?)',
                    [$request->id_subtema,$request->id_avance]);
                    return true;
                }
        }
        else{
            return redirect("/home");
        }
    }
    public function eliminar($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $now = new \DateTime("America/Guayaquil");
            $fecha=$now->format('Y-m-d');
                $subtemaAvance=DB::select("  select * from avanceacademico_subtemas
                inner join avanceacademico on avanceacademico.id_avance =avanceacademico_subtemas.id_avance
                where avanceacademico_subtemas.id_avance_subtema=? and avanceacademico.fecha_avance=?",[$id,$fecha]);
                if($subtemaAvance) 
                {
                    $avance=DB::select('CALL eliminaravanceacademico_subtemas(?)',
                    [$id]);
                    return true;
                }
                else{
                   return false;
                }
        }
        else{
            return redirect("/home");
        }
    }
}
