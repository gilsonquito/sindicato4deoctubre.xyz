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
class SecretariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('solosecretaria',['only'=> ['index']]);
    }
    
    public function cambiarClaveVista()
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            return view('SECRETARIA/DATOSSECRETARIA/cambiarPasswordSecretaria');
        }
        else{
            return redirect("/home");
        }
    }
    public function index()
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
            return view('/SECRETARIA/secretaria');
        }
        else{
            return redirect("/home");
        }
    }

    public function destroy($id)
    {
        //
    }
    public function editarDatosSecretaria($email)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
        {
                $datos['docentes'] = DB::table('users')
                ->select(DB::raw('*'))
                ->where('email', '=', $email)
                ->get();
                return view('SECRETARIA.DATOSSECRETARIA.datosSecretaria',$datos);
        }
        else
        {
            return redirect()->to('/home');
        } 
        
    }
    public function actualizarSecretaria(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="6"))
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
    public function changeImage(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="6"))
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
            return response($data);
        }
        else{
            return redirect("/home");
        }
    }
    public function cambiarPassSecretaria(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="6"))
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
      public function manualSecretaria()
      {
          if ((auth()->check()) && (auth()->user()->rol=="6"))
          {
              $file_path = storage_path('app/PRIVATE/MANUAL/SECRETARIA-Manual.pdf');
                 return response()->file($file_path);
            
          }
          else{
              return redirect("/home");
          }
      }
}
