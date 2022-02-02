<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Silabo;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;//procedimientos bd
use Illuminate\Support\Collection;
use DataTables;
use App\Models\DatosAsignatura;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;


class DatosAsignaturaController extends Controller
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
  
    public function mostrarDatosAsignatura($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
             $datosAsignaturas=DB::select('select * from datos_asignatura where id_sil=?',[$id]);
             $silaboDA['silabosDA']=DB::select('select id_sil from silabo where id_sil=?',[$id]);
             if($datosAsignaturas)
             {
               
                $existe= array("no" => "existe");
                //return response()->json($existe);
                return view('DOCENTE.SILABO.datosAsignatura',$existe,$silaboDA)->with(compact('datosAsignaturas',$datosAsignaturas));
               
             }
             else{
               
                $existe= array("no" => "noexiste");
                //return response()->json($existe);
                return view('DOCENTE.SILABO.datosAsignatura',$existe,$silaboDA)->with(compact('datosAsignaturas',$datosAsignaturas));
             }
             
             
        }
        else{
            return redirect("/home");
        }
       
    }
    
    public function ingresarDatosAsignatura(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $datosAsignatura=DB::select('CALL insertarDatosAsignatura(?,?,?,?)',
            [$request->descripcionAsignatura,$request->competenciaAsignatura,$request->resultadoAsignatura,$request->id_silDA]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizarDatosAsignatura(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $datosAsignatura=DB::select('CALL actualizarDatosAsignatura(?,?,?,?,?)',
            [$request->id_DA,$request->descripcionAsignatura,$request->competenciaAsignatura,$request->resultadoAsignatura,$request->id_Sil]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function mostrarDatosAsignatura2($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
             $datosAsignaturas=DB::select('select * from datos_asignatura where id_sil=?',[$id]);
             $silaboDA['silabosDA']=DB::select('select id_sil from silabo where id_sil=?',[$id]);
             if($datosAsignaturas)
             {
               
                $existe= array("no" => "existe");
                //return response()->json($existe);
                return view('DOCENTE.SILABOSOLODATOS.datosAsignatura',$existe,$silaboDA)->with(compact('datosAsignaturas',$datosAsignaturas));
               
             }
             else{
               
                $existe= array("no" => "noexiste");
                //return response()->json($existe);
                return view('DOCENTE.SILABOSOLODATOS.datosAsignatura',$existe,$silaboDA)->with(compact('datosAsignaturas',$datosAsignaturas));
             }
             
             
        }
        else{
            return redirect("/home");
        }
       
    }
    
}
