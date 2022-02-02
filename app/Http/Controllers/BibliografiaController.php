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
use App\Models\Bibliografia;
use Illuminate\Http\Response;
class BibliografiaController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            return view('DOCENTE.SILABO.tablaBibliografia');
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
                $bibliografia=DB::select('select * from bibliografia_silabo where id_sil=? ',[$id]);
                return DataTables::of($bibliografia)
                ->addColumn('action',function($bibliografia){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarBibliografia('.$bibliografia->id_bibliografia.')" class="btn btn btn-outline-warning btn-sm" title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="DeleteBibliografia" id="'.$bibliografia->id_bibliografia.'"  class="DeleteBibliografia btn btn-outline-danger btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.SILABO.tablaBibliografia');
        }
        else{
            return redirect("/home");
        }
    }
    
    public function index2Vista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            return view('DOCENTE.SILABOSOLODATOS.tablaBibliografia');
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
                $bibliografia=DB::select('select * from bibliografia_silabo where id_sil=? ',[$id]);
                return DataTables::of($bibliografia)
                ->addColumn('action',function($bibliografia){
                    $acciones='';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.SILABOSOLODATOS.tablaBibliografia');
        }
        else{
            return redirect("/home");
        }
    }
    
    public function ingresarBibliografia(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $bibliografia=DB::select('CALL insertarBibliografiaSilabo(?,?,?,?,?,?,?,?)',
            [$request->tipo_bibliografia,$request->titulo_bibliografia,$request->autor_bibliografia,$request->tipo_documento_bibliografia,$request->editorial_bibliografia,$request->fecha_publicacion_bibliografia,$request->numero_pagina_bibliografia,$request->id_sil]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    public function eliminarBibliografia($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $bibliografia=DB::select('call eliminarBibliografiaSilabo(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function editarBibliografia($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $bibliografia=DB::select('select * from bibliografia_silabo where id_bibliografia=?',[$id]);
            return response()->json($bibliografia);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizarBibliografia(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $bibliografia=DB::select('CALL actualizarBibliografiaSilabo(?,?,?,?,?,?,?,?)',
            [$request->id_bibliografia,$request->tipo_bibliografia,$request->titulo_bibliografia,$request->autor_bibliografia,$request->tipo_documento_bibliografia,$request->editorial_bibliografia,$request->fecha_publicacion_bibliografia,$request->numero_pagina_bibliografia]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
}
