<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleAvance;
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
class DetalleAvanceController extends Controller
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

    
    public function visualizarDetalle($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
             $detallesAvances=DB::select('select * from detalle_avanceacademico where id_avance=?',[$id]);
             $avanceAcademico['avanceAcademico']=DB::select('select id_avance from avanceacademico where id_avance=?',[$id]);
             if($detallesAvances)
             {
               
                $existe= array("no" => "existe");
                return view('DOCENTE.AVANCESACADEMICO.detalleAvance',$existe,$avanceAcademico)->with(compact('detallesAvances',$detallesAvances));
               
             }
             else{
               
                $existe= array("no" => "noexiste");
                return view('DOCENTE.AVANCESACADEMICO.detalleAvance',$existe,$avanceAcademico)->with(compact('detallesAvances',$detallesAvances));
             }
        }
        else{
            return redirect("/home");
        }
    }
    public function ingresar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
                    $detallesAvances=DB::select('select * from detalle_avanceacademico where id_avance=?',[$request->id_avance]);
                    if($detallesAvances)
                    {
                        $detalle=DB::select('CALL actualizarDetalleAvanceAcademico(?,?,?,?,?,?,?)',
                        [$request->id_detalle_avance,$request->metodologias_avance,$request->recursos_avance,$request->actividades_avance,$request->evidencias_avance,$request->motivo_inasistencia_avance,$request->observacion_avance]);
                       return back();
                    }
                    else{
                        $detalle=DB::select('CALL insertarDetalleAvanceAcademico(?,?,?,?,?,?,?)',
                        [$request->metodologias_avance,$request->recursos_avance,$request->actividades_avance,$request->evidencias_avance,$request->motivo_inasistencia_avance,$request->observacion_avance,$request->id_avance]);
                        return back();
                    }   
        }
        else{
            return redirect("/home");
        }
    }
}
