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
use App\Models\Prerrequisitos;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;


class PrerrequisitoController extends Controller
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
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
           
            return view('DOCENTE.SILABO.prerrequisitos');
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
                $prerrequisito=DB::select('select * from prerrequisitos_silabo where id_sil=? ',[$id]);
                return DataTables::of($prerrequisito)
                ->addColumn('action',function($prerrequisito){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarPrerrequisito('.$prerrequisito->id_prerrequisito.')" class="btn btn btn-outline-warning btn-sm" title="Editar prerrequisito"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="deleteP" id="'.$prerrequisito->id_prerrequisito.'"  class="deleteP btn btn-outline-danger btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            //return view('PARALELO.indexParalelo');
            return view('DOCENTE.SILABO.prerrequisitos');
        }
        else{
            return redirect("/home");
        }
    }
    
    public function ingresarPrerrequisito(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $prerrequisito=DB::select('CALL insertarPrerrequisito(?,?)',
            [$request->descripcion_prerrequisito,$request->id_sil]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    public function eliminarPrerrequisito($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $prerrequisito=DB::select('call eliminarPrerrequisito(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function editarPrerrequisito($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $prerrequisito=DB::select('select * from prerrequisitos_silabo where id_prerrequisito=?',[$id]);
            return response()->json($prerrequisito);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizarPrerrequisito(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $prerrequisito=DB::select('CALL actualizarPrerrequisito(?,?)',
            [$request->id_prerrequisito,$request->nombre_prerrequisito]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function prerrequisitosD($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="4"))
        {
                $prerrequisitos['prerrequisitos']=DB::select('select * from prerrequisitos_silabo where id_sil=?',[$id]);
                return view('DIRECTOR.SILABOS.prerrequisitos',$prerrequisitos);
        }
        else{
            return redirect("/home");
        }
    }
    
    
    public function index2Vista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
           
            return view('DOCENTE.SILABOSOLODATOS.prerrequisitos');
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
                $prerrequisito=DB::select('select * from prerrequisitos_silabo where id_sil=? ',[$id]);
                return DataTables::of($prerrequisito)
                ->addColumn('action',function($prerrequisito){
                    $acciones='';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            //return view('PARALELO.indexParalelo');
            return view('DOCENTE.SILABOSOLODATOS.prerrequisitos');
        }
        else{
            return redirect("/home");
        }
    }
}
