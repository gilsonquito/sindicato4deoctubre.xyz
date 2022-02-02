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
use App\Models\Estudiante;
use App\Models\Curso;
use App\Rules\Contrasenachange;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use DateTime;
use Illuminate\Support\Facades\Storage;

class EstudianteController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function cambiarClaveVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
            return view('ESTUDIANTE/DATOSESTUDIANTE/cambiarPasswordEstudiante');
        }
        else{
            return redirect("/home");
        }
    }
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            return view('ESTUDIANTE.indexEstudiante');
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
                $estudiantes=DB::select('select * from estudiante');
                return DataTables::of($estudiantes)
                ->addColumn('action',function($estudiantes){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarEstudiante('.$estudiantes->id_est.')" class="btn btn-warning btn-sm " title="Editar Estudiante"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="delete" id="'.$estudiantes->id_est.'" class="delete btn btn-danger  btn-sm "  title="Eliminar estudiante"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('ESTUDIANTE.indexEstudiante');
        }
        else{
            return redirect("/home");
        }
    }
   
   
    public function ingresar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {          
            $now = new \DateTime("America/Guayaquil");
            $fechaactual=$now->format('Y-m-d');
            $periodoactual=DB::select("select * from periodoacademico
                where id=? and ? <= fechafin"
            ,[$request->id_periodo,$fechaactual]);
            if($periodoactual)
            {
                $id=app(UserController::class)->store($request);
                if($id=="1")
                {
                    
                    $estudiantes=DB::select('CALL insertarEstudiante(?,?,?,?,?,?,?,?,?,?)',
                     [$request->cedula_est,$request->name,$request->apellido_est,$request->lugarnacimiento_est,$request->fechanacimiento_est ,$request->direccion_est,$request->celular_est,$request->email,$request->etnia_est ,$request->sexo_est]);
                     $idUltimo=DB::getPdo()->lastInsertId();   
                      //llamarr procedimiento 
                    $matricula=DB::select('CALL insertarMatricula(?,?,?)',
                    [$request->id_curlic,$idUltimo,$request->id_periodo]);
                    return 1;
               }
                else
                {
                   return($id);
                }   
            }   
            else{
                return 2;
            } 
                 
        }
        else{
            return redirect("/home");
        }
    }
    
    public function eliminar($id){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            $usuario= DB::table('estudiante')
            ->select('email_est')
            ->where('id_est', $id)
            ->first()
            ->email_est;
            $matricula=DB::select("select * from matricula where id_est=?",[$id]);
            if($matricula)
            {
                return 3;
            }
            else
            {
                $user=DB::select('call eliminarUsuario(?)',[$usuario]);
                $estudiantes=DB::select('call eliminarEstudiante(?)',[$id]); 
                return 1;
            }
        }
        else{
            return redirect("/home");
        }
    }
    
    public function editar($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            $estudiante=DB::select('select * from estudiante  where id_est=?',[$id]);
            return response()->json($estudiante);
        }
        else{
            return redirect("/home");
        }
    }
     
    public function actualizar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="1"))
        {
            $docenteem= DB::table('estudiante')
            ->select('email_est')
            ->where('id_est', $request->id_doc)
            ->first()
            ->email_est;
            $usuario= DB::table('users')
            ->select('id')
            ->where('email', $docenteem)
            ->first()
            ->id;
            $usuario=DB::select('CALL actualizarUsuario(?,?,?)',
            [$usuario,$request->name,$request->email]);
            $docente=DB::select('CALL actualizarEstudiante(?,?,?,?,?,?,?,?,?,?,?)',
            [$request->id_doc,$request->cedula_doc,$request->name,$request->apellido_doc,$request->lugarnacimiento_doc,$request->fechanacimiento_doc ,$request->direccion_doc,$request->celular_doc,$request->email,$request->etnia_doc ,$request->sexo_doc]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    
    
    public function editarDatos($email)
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
                $datos['estudiantes'] = DB::table('estudiante')
                ->select(DB::raw('*'))
                ->where('email_est', '=', $email)
                ->get();
                return view('ESTUDIANTE.DATOSESTUDIANTE.datosEstudiantes',$datos);
        }
        else
        {
            return redirect()->to('/home');
        } 
        
    }
    
    public function actualizarE(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
            $docenteem= DB::table('estudiante')
            ->select('email_est')
            ->where('id_est', $request->id_doc)
            ->first()
            ->email_est;
            $usuario= DB::table('users')
            ->select('id')
            ->where('email', $docenteem)
            ->first()
            ->id;
            $usuario=DB::select('CALL actualizarUsuario(?,?,?)',
            [$usuario,$request->name,$request->email]);
            $docente=DB::select('CALL actualizarEstudiante(?,?,?,?,?,?,?,?,?,?,?)',
            [$request->id_doc,$request->cedula_doc,$request->name,$request->apellido_doc,$request->lugarnacimiento_doc,$request->fechanacimiento_doc ,$request->direccion_doc,$request->celular_doc,$request->email,$request->etnia_doc ,$request->sexo_doc]);
            return back();
        }
        else
        {
            return redirect()->to('/home');
        } 
    }
    public function changeImage(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
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
    public function cambiarPass(Request $request){
            if ((auth()->check()) && (auth()->user()->rol=="2"))
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
    public function estudianteSelectPeriodos()
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $periodosaca=DB::select("select DISTINCT periodoacademico.id,periodoacademico.fechaini,periodoacademico.fechafin,periodoacademico.nombre_tipolicencia from docentemodulo_horario
            inner join docente_modulo on docente_modulo.id_doc_mod = docentemodulo_horario.id_doc_mod
            inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
			inner join matricula on matricula.id_curlic=cursolicencia.id_curlic
			inner join periodoacademico on matricula.id_periodo=periodoacademico.id
            where docente_modulo.id_doc=?
            order by periodoacademico.fechaini desc",[$idDoc]);
            return view('DOCENTE.ESTUDIANTES.listaEstudiantes')->with('periodosaca',$periodosaca);
        }
        else{
            return redirect("/home");
        }
    }
    public function tablaEstudiantesPeriodos($idP)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $estudiantes=DB::select("select  distinct estudiante.id_est,estudiante.apellido_est,estudiante.name_est,estudiante.email_est,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,paralelos.nombre_paralelo from matricula
			inner join estudiante on estudiante.id_est = matricula.id_est
            inner join cursolicencia on matricula.id_curlic = cursolicencia.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
			inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
			inner join periodoacademico on periodoacademico.id=matricula.id_periodo
			where periodoacademico.id=? and docente_modulo.id_doc=?
			order by estudiante.apellido_est asc",[$idP,$idDoc]);
            return view('DOCENTE.ESTUDIANTES.tablaEstudiantes')->with('estudiantes',$estudiantes);   
        }
        else{
            return redirect("/home");
        }
    }
    public function selectCursosEstudiantes($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $cursos=DB::select("select DISTINCT cursolicencia.id_curlic,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,cursolicencia.duracion_meses,paralelos.nombre_paralelo from matricula
            inner join cursolicencia on matricula.id_curlic = cursolicencia.id_curlic
			inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
			inner join periodoacademico on periodoacademico.id=matricula.id_periodo
			where docente_modulo.id_doc=? and periodoacademico.id=?
			order by tipolicencia.nombre_tlic asc",[$idDoc,$id]);
            return response()->json($cursos);  
        }
        else{
            return redirect("/home");
        }
    }
    public function tablaEstudiantesPeriodosCursos($idP,$idCur)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $estudiantes=DB::select("	select  distinct estudiante.id_est,estudiante.apellido_est,estudiante.name_est,estudiante.email_est,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,paralelos.nombre_paralelo from matricula
			inner join estudiante on estudiante.id_est = matricula.id_est
            inner join cursolicencia on matricula.id_curlic = cursolicencia.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
			inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
			inner join periodoacademico on periodoacademico.id=matricula.id_periodo
			where periodoacademico.id=? and docente_modulo.id_doc=? and cursolicencia.id_curlic=?
			order by estudiante.apellido_est asc",[$idP,$idDoc,$idCur]);
            return view('DOCENTE.ESTUDIANTES.tablaEstudiantes')->with('estudiantes',$estudiantes);   
        }
        else{
            return redirect("/home");
        }
    }
    
    public function caragarSelectPeriodosMat()
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {

            $periodos=DB::select("select * from periodoacademico
			order by fechaini desc,fechafin asc, nombre_tipolicencia asc");
            $datos = Arr::collapse([$periodos]);
            return response()->json($datos);  
        }
        else{
            return redirect("/home");
        }
    }
    public function caragarSelectCursosMat($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="1")||(auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="5"))
        {
            $tipoLicencia= DB::table('periodoacademico')
                ->select('nombre_tipolicencia')
                ->where('id', $id)
                ->first()
                ->nombre_tipolicencia;
            $cursos = DB::table('cursolicencia')
            ->join('tipolicencia', 'cursolicencia.id_tlic', '=', 'tipolicencia.id_tlic')
            ->join('paralelos', 'cursolicencia.id_paralelo', '=', 'paralelos.id_paralelo')
            ->select('*')
            ->where('tipolicencia.nombre_tlic', $tipoLicencia)
            ->orderBy('nombre_tlic', 'asc')
            ->orderBy('jornada', 'asc')
            ->orderBy('modalidad', 'asc')
            ->orderBy('nombre_paralelo', 'asc')
            ->get();
            $datos = Arr::collapse([$cursos]);
            return response()->json($datos);  
        }
        else{
            return redirect("/home");
        }
    }
    
    public function manualEstudiante()
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
            $file_path = storage_path('app/PRIVATE/MANUAL/ESTUDIANTE-Manual.pdf');
               return response()->file($file_path);
          
        }
        else{
            return redirect("/home");
        }
    }

}
