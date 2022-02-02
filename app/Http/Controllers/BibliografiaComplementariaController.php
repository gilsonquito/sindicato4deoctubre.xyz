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
use App\Models\BibliografiaComplementaria;
use Illuminate\Http\Response;
class BibliografiaComplementariaController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            return view('DOCENTE.SILABO.tablaBibliografiaComplementaria');
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
                $bibliografiaComplementaria=DB::select('select * from bibliografia_complementaria where id_sil=? ',[$id]);
                return DataTables::of($bibliografiaComplementaria)
                ->addColumn('action',function($bibliografiaComplementaria){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarBibliografiaComplementariaE('.$bibliografiaComplementaria->id_bcomplementaria.')" class="btn btn btn-outline-warning btn-sm" title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="DeleteBibliografiaComplementaria" id="'.$bibliografiaComplementaria->id_bcomplementaria.'"  class="DeleteBibliografiaComplementaria btn btn-outline-danger btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.SILABO.tablaBibliografiaComplementaria');
        }
        else{
            return redirect("/home");
        }
    }
    
    public function index2Vista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            return view('DOCENTE.SILABOSOLODATOS.tablaBibliografiaComplementaria');
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
                $bibliografiaComplementaria=DB::select('select * from bibliografia_complementaria where id_sil=? ',[$id]);
                return DataTables::of($bibliografiaComplementaria)
                ->addColumn('action',function($bibliografiaComplementaria){
                    $acciones='';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.SILABOSOLODATOS.tablaBibliografiaComplementaria');
        }
        else{
            return redirect("/home");
        }
    }
    public function ingresarBibliografiaComplementaria(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $bibliografiaCom=DB::select('CALL insertarBibliografiaComplementaria(?,?)',
            [$request->descripcion_bibliografia,$request->id_sil]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    public function eliminarBibliografiaComplementaria($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $bibliografiaCom=DB::select('call eliminarBibliografiaComplementaria(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function editarBibliografiaComplementaria($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $bibliografiaCom=DB::select('select * from bibliografia_complementaria where id_bcomplementaria=?',[$id]);
            return response()->json($bibliografiaCom);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizarBibliografiaComplementaria(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $bibliografia=DB::select('CALL actualizarBibliografiaComplementaria(?,?)',
            [$request->id_bcomplementaria,$request->descripcion_bibliografia]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
}
