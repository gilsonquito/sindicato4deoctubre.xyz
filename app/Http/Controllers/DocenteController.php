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
use App\Models\Docente;
use App\Rules\Contrasenachange;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class DocenteController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexVista(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4")))
        {
            return view('DOCENTE.indexDocente');
        }
        else{
            return redirect("/home");
        }
    }
    public function index(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4")))
        {
            if($request->ajax())
            {
                $docentes=DB::select('select * from docente');
                return DataTables::of($docentes)
                ->addColumn('action',function($docentes){
                    $acciones='<div class="p-1"><a href="javascript:void(0)" onclick="editarDocente('.$docentes->id_doc.')" class="btn btn-warning btn-sm " title="Editar Docente"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="delete" id="'.$docentes->id_doc.'" class="delete btn btn-danger  btn-sm "  title="Eliminar docente"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.indexDocente');
        }
        else{
            return redirect("/home");
        }
    }
   
   
    public function ingresar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4")))
        {              
           
               $id=app(UserController::class)->store($request);
                if($id=="1")
                {
                    $docentes=DB::select('CALL insertarDocente(?,?,?,?,?,?,?,?,?,?,?)',
                     //[$request->input('cedula'),$request->input('name'),$request->input('apellido'),$request->input('lugarNacimiento'),$request->input('fechaNacimiento') ,$request->input('direccion'),$request->input('celular'),$request->input('email'),$request->input('selEtnia') ,$request->input('rdGenero'),$request->input('instruccion')]);
                     [$request->cedula_doc,$request->name,$request->apellido_doc,$request->lugarnacimiento_doc,$request->fechanacimiento_doc ,$request->direccion_doc,$request->celular_doc,$request->email,$request->etnia_doc ,$request->sexo_doc,$request->instruccion_doc]);
                     return  back();
                     
               }
                else
                {
                        //$email=$request->get('email');
                        //User::where('email',$email)->delete();
                   return($id);
                }
                
                  
              
        }
        else{
            return redirect("/home");
        }
    }
    
    public function eliminar($id){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4")))
        {
            $usuario= DB::table('docente')
            ->select('email')
            ->where('id_doc', $id)
            ->first()
            ->email;
           $user=DB::select('call eliminarUsuario(?)',[$usuario]);
           $docentes=DB::select('call eliminarDocente(?)',[$id]); 
           return back();
        }
        else{
            return redirect("/home");
        }
    }
     
    public function editar($id)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4")))
        {
            $docente=DB::select('select * from docente  where id_doc=?',[$id]);
            return response()->json($docente);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="4")))
        {
            $docenteem= DB::table('docente')
            ->select('email')
            ->where('id_doc', $request->id_doc)
            ->first()
            ->email;
            $usuario= DB::table('users')
            ->select('id')
            ->where('email', $docenteem)
            ->first()
            ->id;
            $usuario=DB::select('CALL actualizarUsuario(?,?,?)',
            [$usuario,$request->name,$request->email]);
            $docente=DB::select('CALL actualizarDocente(?,?,?,?,?,?,?,?,?,?,?,?)',
            [$request->id_doc,$request->cedula_doc,$request->name,$request->apellido_doc,$request->lugarnacimiento_doc,$request->fechanacimiento_doc ,$request->direccion_doc,$request->celular_doc,$request->email,$request->etnia_doc ,$request->sexo_doc,$request->instruccion_doc]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function editarDatos($email)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
                $datos['docentes'] = DB::table('docente')
                ->select(DB::raw('*'))
                ->where('email', '=', $email)
                ->get();
                //return view('MDocente.datosDocente', $datos);
                //return view('MDocente.datosDocente');
                
                return view('MDocente.datosDocente',$datos);
        }
        else
        {
            return redirect()->to('/home');
        } 
        
    }
    public function actualizarM(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $docenteem= DB::table('docente')
            ->select('email')
            ->where('id_doc', $request->id_doc)
            ->first()
            ->email;
            $usuario= DB::table('users')
            ->select('id')
            ->where('email', $docenteem)
            ->first()
            ->id;
            $usuario=DB::select('CALL actualizarUsuario(?,?,?)',
            [$usuario,$request->name,$request->email]);
            $docente=DB::select('CALL actualizarDocente(?,?,?,?,?,?,?,?,?,?,?,?)',
            [$request->id_doc,$request->cedula_doc,$request->name,$request->apellido_doc,$request->lugarnacimiento_doc,$request->fechanacimiento_doc ,$request->direccion_doc,$request->celular_doc,$request->email,$request->etnia_doc ,$request->sexo_doc,$request->instruccion_doc]);
            return back();
        }
        else
        {
            return redirect()->to('/home');
        } 
    }
 
        
        public function cambiarPass(Request $request){
            if ((auth()->check()) && (auth()->user()->rol=="3"))
                {
                    if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                        // The passwords matches
                        return redirect()->back()->with("error","Ingrese la clave actual correctamente");
                    }
            
                    if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
                        //Current password and new password are same
                        return redirect()->back()->with("error","Error al confirmar Nueva contraseña por favor ingrese los mismos valores");
                    }
            
                    $validatedData = $request->validate([
                        'current-password' => 'required',
                        'new-password' => 'required|string|min:5|confirmed',
                    ]);
            
                    //Change Password
                    $user = Auth::user();
                    $user->password = bcrypt($request->get('new-password'));
                    $user->save();
                    auth()->logout();
                    return redirect()->back()->with("success","La contraseña de cambio correctamente!");

                }
                else
                {
                    return redirect()->to('home');
                }        
          }
           
           
    public function changeVista(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="3")))
        {
            return view('MDocente/cambiarPassword');
        }
        else{
            return redirect("/home");
        }
    }
    public function manualDocente()
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $file_path = storage_path('app/PRIVATE/MANUAL/DOCENTE-Manual.pdf');
               return response()->file($file_path);
          
        }
        else{
            return redirect("/home");
        }
    }
}
