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
use App\Models\BibliografiaDigital;
use Illuminate\Http\Response;
class BibliografiaDigitalController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            return view('DOCENTE.SILABO.tablaBibliografiaDigital');
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
                $Bdigital=DB::select('select * from bibliografia_digital where id_sil=? ',[$id]);
                return DataTables::of($Bdigital)
                ->addColumn('action',function($Bdigital){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarBdigital('.$Bdigital->id_bdigital.')" class="btn btn btn-outline-warning btn-sm" title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="DeleteBdigital" id="'.$Bdigital->id_bdigital.'"  class="DeleteBdigital btn btn-outline-danger btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.SILABO.tablaBibliografiaDigital');
        }
        else{
            return redirect("/home");
        }
    }
    
    public function index2Vista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            return view('DOCENTE.SILABOSOLODATOS.tablaBibliografiaDigital');
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
                $Bdigital=DB::select('select * from bibliografia_digital where id_sil=? ',[$id]);
                return DataTables::of($Bdigital)
                ->addColumn('action',function($Bdigital){
                    $acciones='';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.SILABOSOLODATOS.tablaBibliografiaDigital');
        }
        else{
            return redirect("/home");
        }
    }
    public function ingresarBDigital(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $Bdigital=DB::select('CALL insertarBibliografiaDigital(?,?)',
            [$request->descripcion_bdigital,$request->id_sil]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    public function eliminarBDigital($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $Bdigital=DB::select('call eliminarBibliografiaDigital(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function editarBDigital($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $Bdigital=DB::select('select * from bibliografia_digital where id_bdigital=?',[$id]);
            return response()->json($Bdigital);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizarBDigital(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $Bdigital=DB::select('CALL actualizarBibliografiaDigital(?,?)',
            [$request->id_bdigital,$request->descripcion_bdigital]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
}
