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

class DireccionInspectorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('soloinspector',['only'=> ['index']]);
      
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function cambiarClaveVista()
    {
        if ((auth()->check()) && (auth()->user()->rol=="5"))
        {
            return view('INSPECTOR/DATOSINSPECTOR/cambiarPasswordInspector');
        }
        else
        {
            return redirect()->to('/home');
        } 
        
    }
    public function index()
    {
        return view('INSPECTOR/inspector');
    }

    public function editarDatosInspector($email)
    {
        if ((auth()->check()) && (auth()->user()->rol=="5"))
        {
                $datos['docentes'] = DB::table('users')
                ->select(DB::raw('*'))
                ->where('email', '=', $email)
                ->get();
                return view('INSPECTOR.DATOSINSPECTOR.datosInspector',$datos);
        }
        else
        {
            return redirect()->to('/home');
        } 
        
    }
    public function actualizarInspector(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="5"))
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
        if ((auth()->check()) && (auth()->user()->rol=="5"))
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
    public function cambiarPassInspector(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="5"))
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
      public function manualInspector()
      {
          if ((auth()->check()) && (auth()->user()->rol=="5"))
          {
              $file_path = storage_path('app/PRIVATE/MANUAL/INSPECTOR-Manual.pdf');
                 return response()->file($file_path);
            
          }
          else{
              return redirect("/home");
          }
      }
}
