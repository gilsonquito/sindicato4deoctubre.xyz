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
use App\Models\Webgrafia;
use Illuminate\Http\Response;
class WebgrafiaController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            
            return view('DOCENTE.SILABO.tablaWebgrafia');
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
                $webgrafia=DB::select('select * from webgrafia where id_sil=? ',[$id]);
                return DataTables::of($webgrafia)
                ->addColumn('action',function($webgrafia){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarWebgrafia('.$webgrafia->id_webgrafia.')" class="btn btn btn-outline-warning btn-sm" title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="DeleteWebgrafia" id="'.$webgrafia->id_webgrafia.'"  class="DeleteWebgrafia btn btn-outline-danger btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.SILABO.tablaWebgrafia');
        }
        else{
            return redirect("/home");
        }
    }
    
    public function index2Vista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            return view('DOCENTE.SILABOSOLODATOS.tablaWebgrafia');
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
                $webgrafia=DB::select('select * from webgrafia where id_sil=? ',[$id]);
                return DataTables::of($webgrafia)
                ->addColumn('action',function($webgrafia){
                    $acciones='';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.SILABOSOLODATOS.tablaWebgrafia');
        }
        else{
            return redirect("/home");
        }
    }
    public function ingresarWebgrafia(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $webgrafia=DB::select('CALL insertarWebgrafia(?,?)',
            [$request->descripcion_webgrafia,$request->id_sil]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    public function eliminarWebgrafia($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $webgrafia=DB::select('call eliminarWebgrafia(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function editarWebgrafia($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $webgrafia=DB::select('select * from webgrafia where id_webgrafia=?',[$id]);
            return response()->json($webgrafia);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizarWebgrafia(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $webgrafia=DB::select('CALL actualizarWebgrafia(?,?)',
            [$request->id_webgrafia,$request->descripcion_webgrafia]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
}
