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

use App\Rules\Contrasenachange;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\Auth;



class UsuariosController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            return view('USUARIOS.indexUsuarios');
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
                $rol1="1";
                $rol4="4";
                $rol5="5";
                $rol6="6";
                $usuarios=DB::select('select * from users where rol=? or rol=? or rol=? or rol=?',[$rol1,$rol4, $rol5,$rol6]);
                return DataTables::of($usuarios)
                ->addColumn('action',function($usuarios){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarUsuarioRol('.$usuarios->id.')" class="btn btn-warning btn-sm " title="Editar Usuario"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="delete" id="'.$usuarios->id.'" class="delete btn btn-danger  btn-sm "  title="Eliminar usuario"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('USUARIOS.indexUsuarios');
        }
        else{
            return redirect("/home");
        }
    }
   
   
    public function ingresar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {              
            $usuario = new User();
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $PASS=$request->password;
            $usuario->password =bcrypt($PASS) ;
            $usuario->rol = $request->rol;
            if($usuario->save()) 
            {
                return(true);
            } else {
                return (false);
            }
        }
        else{
            return redirect("/home");
        }
    }
    
    public function eliminar($id){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
           $user=DB::select('call eliminarusuariorol(?)',[$id]);
           return back();
        }
        else{
            return redirect("/home");
        }
    }
     
    public function editar($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            
            $usuario=DB::select('select * from users where id=?',[$id]);
            return response()->json($usuario);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {   
            $usuario=DB::select('CALL actualizarUsuarioRol(?,?,?,?)',
            [$request->id,$request->name,$request->email,$request->rol]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
 
          
}
