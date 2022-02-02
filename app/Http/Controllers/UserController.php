<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;//procedimientos bd
use Illuminate\Support\Collection;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DataTables;
use App\Rules\Contrasenachange;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('solouser',['only'=> ['index']]);    }
    public function index()
    {
        if ((auth()->check()) )
        {
            return view('estudiante');
        }
        else
        {
            return redirect()->to('/home');
        } 
    }

   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ((auth()->check()) )
        {
            $usuario = new User();
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $PASS=$request->password;
            $usuario->password =bcrypt($PASS) ;
            $usuario->rol = $request->rol;
            //$usuario->imagen = $request->imagen;
  
            if($usuario->save()) 
            {
                return(1);
            } else {
                return (0);
            }
        }
        else
        {
            return redirect()->to('/home');
        } 
        
    }
   

  
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        if ((auth()->check()))
        {
            try {
                $email=$request->get('email');
                $usuario=DB::table('users')
                ->select(DB::raw('*'))
                ->where('email', '=', $email)
                ->get();
                //$datosDocente=request()->only(['name','email','imagen']);
            if($request->hasFile('imagen')) 
            {
            $usuario['imagen']=$request->file('imagen')->store('uploads','public');

            }
            
            $r=$usuario->save();
            return($r);
            
            } catch (\Throwable $th) {
                return $th;
            }
        }
        else
        {
            return redirect()->to('/home');
        } 
        
       
    }

    
    public function destroy($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            $user=DB::select('call eliminarUsuario(?)',[$id]);
            return ($user);
        }
        else
        {
            return redirect()->to('/home');
        } 
    }
    public function changeImage(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3")||(auth()->check()) && (auth()->user()->rol=="1"))
        {
           
            $this->validate($request,[
                'photo'=>'required|image'
            ]);
            $user =Auth::user();
            $extension=$request->file('photo')->getClientOriginalExtension();
            $file_name=$user->id.'.'.$extension;
            $path=public_path('users/'.$file_name);
            Image::make($request->file('photo'))
                    ->resize(144,144)
                    ->save($path);
            $user->imagen=$extension;
            $user->save();
            $data['success']=true;
            $data['path']=$file_name;
            //return back()->with('notification','Se ha actualizado correctamente');
            return response($data);
        }
        else
        {
            return redirect()->to('/home');
        } 
    }
    public function editarDatosAdmin($email)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1")))
        {
                $datos['docentes'] = DB::table('users')
                ->select(DB::raw('*'))
                ->where('email', '=', $email)
                ->get();
                return view('ADMIN.DATOSADMIN.datosAdmin',$datos);
        }
        else
        {
            return redirect()->to('/home');
        } 
        
    }

    public function actualizarUsuario(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            $usuario=DB::select('CALL actualizarUsuario(?,?,?)',
            [$request->id_doc,$request->name,$request->email]);
            return back();
        }
        else
        {
            return redirect()->to('/home');
        } 
    }
    public function cambiarPassAdmin(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
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
                return redirect()->to('/home');
            }        
      }
    
      public function vistaCmabiarPassAsmin(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
            {
                return view('ADMIN/DATOSADMIN/cambiarPasswordAdmin');

            }
            else
            {
                return redirect()->to('/home');
            }        
      }
      public function quitarSeguridad2faVista(){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="6")))
            {
                return view('ADMIN/2FA/index2FA');

            }
            else
            {
                return redirect()->to('/home');
            }        
      }
      public function quitarSeguridad2fa(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="6")))
            {
                $usuario=DB::select("select * from users
                where email=?"
                ,[$request->email]);
               
                if($usuario)
                {
                    return response()->json($usuario);
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return redirect()->to('/home');
            }        
      }
      
      public function emailEliminar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="6")))
            {
                $usuario=DB::select('call eliminar2FA(?)',[$request->id]);
                return true;
            }
            else
            {
                return redirect()->to('/home');
            }        
      }
      
      public function manualAdmin()
      {
          if ((auth()->check()) && (auth()->user()->rol=="1"))
          {
              $file_path = storage_path('app/PRIVATE/MANUAL/ADMINISTRADOR-Manual.pdf');
                 return response()->file($file_path);
            // return "No existe archivo" ;
          }
          else{
              return redirect("/home");
          }
      }
    
    
}
