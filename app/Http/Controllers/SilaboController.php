<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Silabo;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;//procedimientos bd
use Illuminate\Support\Collection;
use DataTables;
use App\Models\DocenteModulo;
use App\Models\PeriodoAcademico;
use App\Models\Modulo;
use App\Models\Docente;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use DateTime;
Use \Carbon\Carbon;
use PDF;


class SilaboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
           
            return view('SILABO.indexSilabo');
        }
        else{
            return redirect("/home");
        }
    }
    public function index(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            if($request->ajax())
            {
                $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
                
                $silabos=DB::select('select silabo.id_sil,silabo.escuela,silabo.plan_estudio,silabo.estado,silabo.fecha_creacion,silabo.id_doc_mod,modulo.nombre_mod,silabo.id_periodo,periodoacademico.fechaini,periodoacademico.fechafin,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,paralelos.nombre_paralelo from silabo 
                inner join docente_modulo on docente_modulo.id_doc_mod = silabo.id_doc_mod
                inner join docente on docente_modulo.id_doc = docente.id_doc
                inner join modulo on docente_modulo.id_mod=modulo.id_mod 
                inner join periodoacademico on silabo.id_periodo=periodoacademico.id
				inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
				inner join tipolicencia on cursolicencia.id_tlic = tipolicencia.id_tlic
				inner join paralelos on cursolicencia.id_paralelo = paralelos.id_paralelo
                where docente_modulo.id_doc=?
                ORDER BY periodoacademico.fechaini desc,periodoacademico.fechafin desc,tipolicencia.nombre_tlic ,modulo.nombre_mod',[$idDoc]);
      

                return DataTables::of($silabos)
                ->addColumn('action',function($silabos){
                    $acciones='<div class="row justify-content-center p-1"><div class="col p-1"><a href="javascript:void(0)" onclick="visualizarSilabo('.$silabos->id_sil.')" class="btn btn btn-outline-warning btn-sm" title="Visualizar"><i class="fa fa-eye px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1 "><button type="button" name="delete" id="'.$silabos->id_sil.'"  class="delete btn btn-outline-danger  btn-sm "  title="Eliminar silabo"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('SILABO.indexSilabo');
        }
        else{
            return redirect("/home");
        }
    }
    public function eliminar($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $silabos=DB::select("select * from silabo where id_sil=?",[$id]);
           foreach($silabos as $silabo)
           {
               if($silabo->estado=="APROBADO")
               {
                    return false;
               }
               else
               {
                    $silabos=DB::select('call eliminarSilabo(?)',[$id]);
                    return back();
               }
           }
          
                
            
            
        }
        else{
            return redirect("/home");
        }
    }
       
     
    /*
    public function guardarSilabo(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
           
                $this->validate($request,[
                'file'=>'file|max:5000|mimes:pdf,docx,doc',
            ]);
            if($request->hasFile("file"))
            {
                    $extension = $request->file('file')->guessExtension();
                    $file_name='silabo'.$request->selModulo.'-'.$request->selPeriodo.'.'.$extension;
                    $path=public_path('storage/file/');
                    $request->file('file')->storeAs('public/file', $file_name);
                    //$request->file('file')->store('file',$file_name);
                    $silabos=DB::select('CALL insertarSilabo(?,?,?)',
                    [$request->selModulo,$request->selPeriodo,$file_name]);
                    $data['success']=true;
                    return response($data);
                  
            }
            else{
                $data['success']=false;
                return response($data);
            }
                
        }
        else{
            return view('/home');
        }

    }
    public function descargarSilabo($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $archivop= DB::table('silabo')
            ->select('archivo')
            ->where('id_sil', $id)
            ->first()
            ->archivo;
            $file_path = public_path('storage/file/'. $archivop);
            return response()->download($file_path);
        }
       
    }*/
    public function editar($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
            ->select('id_doc')
            ->where('email', auth()->user()->email)
            ->first()
            ->id_doc;
           
            $dato['modulos']=DB::select('select docente_modulo.id_doc_mod,modulo.nombre_mod from docente_modulo 
            inner join docente on docente_modulo.id_doc = docente.id_doc
            inner join modulo on docente_modulo.id_mod=modulo.id_mod 
            where docente_modulo.id_doc =?',[$idDoc]);
            $periodos = PeriodoAcademico::select("*")
            ->orderBy('fechaini', 'desc')
            ->get(); 
          
            $silabo=DB::select('select * from silabo  where id_sil=?',[$id]);
           $datos = Arr::collapse([$silabo,$periodos,$dato]);
           return response()->json($datos);
           
        }
        else{
            return redirect("/home");
        }
    }
    
    public function actualizar(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $this->validate($request,[
                'file2'=>'file|max:5000|mimes:pdf,docx,doc',
            ]);
                    if($request->hasFile("file2"))
                    {
                            //console.log("entre");
                            $extension = $request->file('file2')->guessExtension();
                            $file_name='silabo'.$request->txtmodulos.'-'.$request->selPeriodo2.'.'.$extension;
                            $silabos=DB::select('CALL actualizarSilabo(?,?,?,?)',
                            [$request->txtId2,$file_name,$request->txtmodulos,$request->selPeriodo2]);
                            $path=public_path('storage/file/');
                            $request->file('file2')->storeAs('public/file', $file_name);
                            $data['success']=true;
                            return response($data);
                    }
                    else{
                        $archivop= DB::table('silabo')
                        ->select('archivo')
                        ->where('id_sil', $request->txtId2)
                        ->first()
                        ->archivo;
                        $array = explode(".", $archivop, 2);
                       $extension= $array[1];
                       $file_name2='silabo'.$request->txtmodulos.'-'.$request->selPeriodo2.'.'.$extension;
                       $file_pathanterior = public_path('storage/file/'. $archivop);
                       $file_pathahora = public_path('storage/file/'. $file_name2);
                       $silabos=DB::select('CALL actualizarSilabo(?,?,?,?)',
                       [$request->txtId2,$file_name2,$request->txtmodulos,$request->selPeriodo2]);
                       File::move($file_pathanterior,$file_pathahora);
                        $data['success']=true;
                        return response($data);
                    }    
        }
        else{
            return redirect("/home");
        }

    }
    public function silabosEstudiante()
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
           
           $periodos['periodosacademicos'] =  DB::table('matricula')
           ->join('periodoacademico','matricula.id_periodo', '=', 'periodoacademico.id')
           ->join('estudiante','estudiante.id_est', '=', 'matricula.id_est')
           ->select('*')
           ->where('estudiante.email_est', auth()->user()->email)
           ->orderBy('fechaini', 'desc')
           ->get();
           return view('ESTUDIANTE.SILABO.silaboEstudiante',$periodos);
           //return response()->json($periodosacademicos);
           
        }
        else{
            return redirect("/home");
        }
    }
    public function silabosEstudianteMostrar($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
                $idEst= DB::table('estudiante')
                ->select('id_est')
                ->where('email_est', auth()->user()->email)
                ->first()
                ->id_est;
                $curso= DB::table('matricula')
                ->select('id_curlic')
                ->where('id_periodo',$id)
                ->where('id_est',$idEst)
                ->first()
                ->id_curlic;
                $silabosEstudiantes=DB::select("select DISTINCT * from silabo
                inner join docente_modulo on docente_modulo.id_doc_mod =silabo.id_doc_mod
                inner join cursolicencia on cursolicencia.id_curlic =docente_modulo.id_curlic
                inner join tipolicencia on cursolicencia.id_tlic =tipolicencia.id_tlic
                inner join paralelos on paralelos.id_paralelo =cursolicencia.id_paralelo
                inner join modulo on modulo.id_mod =docente_modulo.id_mod
                inner join docentemodulo_horario on docentemodulo_horario.id_doc_mod =docente_modulo.id_doc_mod
                inner join periodohorario on docentemodulo_horario.id_phorario = periodohorario.id_phorario
				inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo
                where periodoacademico.id=? and cursolicencia.id_curlic=? and silabo.estado='APROBADO'
                order by modulo.nombre_mod",[$id,$curso]);
            //return view('ESTUDIANTE.SILABO.tablaSilabos');
            return view('ESTUDIANTE.SILABO.tablaSilabos')->with('silabosEstudiantes',$silabosEstudiantes);
        }
        else{
            return redirect("/home");
        }
    }
    public function descargarSilaboEstudiante($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
            $datos=DB::select("select silabo.id_sil,silabo.escuela,silabo.plan_estudio, modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,periodoacademico.fechaini,periodoacademico.fechafin,silabo.fecha_creacion,docente.instruccion_doc,docente.apellido_doc,docente.name from silabo
            inner join docente_modulo on docente_modulo.id_doc_mod=silabo.id_doc_mod
            inner join docente on docente_modulo.id_doc=docente.id_doc
            inner join modulo on modulo.id_mod=docente_modulo.id_mod
            inner join cursolicencia on cursolicencia.id_curlic=silabo.id_curlic
            inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
            inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
            inner join periodoacademico on periodoacademico.id=silabo.id_periodo
            where silabo.id_sil=?",[$id]);
            $prerrequisitos=DB::select('select * from prerrequisitos_silabo where id_sil=?',[$id]);
            $datosAsignaturas=DB::select('select * from datos_asignatura where id_sil=?',[$id]);
            $unidades=DB::select("select u.id_unidad,u.orden_unidad,u.titulo_unidad,u.horas_unidad,u.criterioevaluacion_unidad
                                            ,temas.id_unidad as tema_id_unidad,temas.id_tema,temas.tipo_clase,temas.orden_tema,temas.titulo_tema, temas.actividadesdocencia_tema,
                                            temas.actdocpracapliexp_tema,temas.actaprauto_tema,temas.horasdocencia_tema,temas.horasapreexp_tema,temas.horastraaut_tema,temas.semana_tema,
                                            subtemas.id_tema as subtema_id_tema,subtemas.id_subtema,subtemas.orden_subtema,subtemas.titulo_subtema from unidades as u
                                    inner join temas on temas.id_unidad =u.id_unidad
                                    inner join subtemas on subtemas.id_tema = temas.id_tema
                                    where id_sil=?
                                    order by u.orden_unidad , temas.orden_tema, subtemas.orden_subtema",[$id]);
                $evaluacionesU=DB::select("select u.id_unidad,u.orden_unidad,u.titulo_unidad,u.horas_unidad,u.criterioevaluacion_unidad, 		
                                                    evaluacion_unidad.id_unidad as evaluacion_id_unidad,evaluacion_unidad.tipo_evaluacion,evaluacion_unidad.detalle_evaluacion from unidades as u
                                            inner join evaluacion_unidad on evaluacion_unidad.id_unidad =u.id_unidad
                                            where id_sil=?
                                            order by u.orden_unidad , evaluacion_unidad.tipo_evaluacion",[$id]);
                $tecnicasU=DB::select("select u.id_unidad,	
                                                tecnicas_unidad.id_unidad as tecnica_id_unidad,tecnicas_unidad.tecnica,tecnicas_unidad.instrumento from unidades as u
                                        inner join tecnicas_unidad on tecnicas_unidad.id_unidad =u.id_unidad
                                        where id_sil=?
                                        order by u.orden_unidad , tecnicas_unidad.tecnica",[$id]);
                $resultadosU=DB::select("select u.id_unidad,	
                                                resultados_unidad.id_unidad as resultado_id_unidad,resultados_unidad.resultado from unidades as u
                                        inner join resultados_unidad on resultados_unidad.id_unidad =u.id_unidad
                                        where id_sil=?
                                        order by u.orden_unidad , resultados_unidad.resultado",[$id]);
                $metodologias=DB::select('select * from  metodos_enseñanza 
                                            where id_sil=?
                                            order by metodos_enseñanza.descripcion_metodo',[$id]);
                $recursos=DB::select('select * from  recursos_enseñanza 
                                        where id_sil=?
                                        order by recursos_enseñanza.descripcion_recurso',[$id]);
                $escenarios=DB::select('select * from  escenarios_aprendizaje 
                                        where id_sil=?
                                        order by escenarios_aprendizaje.descripcion_escenario',[$id]);
                $bibliografias=DB::select('select * from  bibliografia_silabo 
                                            where id_sil=?
                                            order by bibliografia_silabo.titulo_bibliografia',[$id]);
                $bibliografiasComplementarias=DB::select('select * from  bibliografia_complementaria
                                                            where id_sil=?
                                                            order by bibliografia_complementaria.descripcion_bibliografia',[$id]);
                $webgrafias=DB::select('select * from  webgrafia
                                        where id_sil=?
                                        order by webgrafia.descripcion_webgrafia',[$id]);
                $bibliografiasDigitales=DB::select('select * from  bibliografia_digital
                                                    where id_sil=?
                                                    order by bibliografia_digital.descripcion_bdigital',[$id]);
               
            $datosT = ['datos' => $datos, 'prerrequisitos' => $prerrequisitos,'datosAsignaturas' => $datosAsignaturas,'unidades' => $unidades,'evaluacionesU' => $evaluacionesU,'tecnicasU' => $tecnicasU,'resultadosU' => $resultadosU,'metodologias' => $metodologias,'recursos' => $recursos,'escenarios' => $escenarios,'bibliografias' => $bibliografias,'bibliografiasComplementarias' => $bibliografiasComplementarias,'webgrafias' => $webgrafias,'bibliografiasDigitales' => $bibliografiasDigitales];
            $pdf=PDF::loadView('ESTUDIANTE.SILABO.pdfSilabo',$datosT);
            return view('ESTUDIANTE.SILABO.pdfSilabo',$datosT);
            //return file("Silabo".'.pdf'); 
            //return $pdf->stream("Silabo".'.pdf'); 
        }
        else{
            return redirect("/home");
        }
       
    }
    
    public function selectModulosSilabos($idP)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
           
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $modulos=DB::select("select DISTINCT docente_modulo.id_doc_mod,modulo.nombre_mod,tipolicencia.nombre_tlic,cursolicencia.jornada,cursolicencia.modalidad,paralelos.nombre_paralelo,cursolicencia.duracion_meses from matricula
            inner join cursolicencia on matricula.id_curlic = cursolicencia.id_curlic
			inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
			inner join modulo on modulo.id_mod = docente_modulo.id_mod
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join docentemodulo_horario on docentemodulo_horario.id_doc_mod=docente_modulo.id_doc_mod
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo		
			where docente_modulo.id_doc=? and periodoacademico.id=?
			order by modulo.nombre_mod asc",[$idDoc,$idP]);
            return response()->json($modulos);  
        }
        else{
            return redirect("/home");
        }
    }
    public function generarSilabo()
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
      
           $licencias['licencias']=DB::select("select * from tipolicencia
           order by nombre_tlic asc");
       
           $idDoc= DB::table('docente')
           ->select('id_doc')
           ->where('email', auth()->user()->email)
           ->first()
           ->id_doc;
        
           $doc=auth()->user()->email;
           $apellido=DB::select("select docente.apellido_doc, docente.name from docente where docente.email=?",[$doc]);
           $ape2['ape2']=DB::select("select docente.apellido_doc, docente.name from docente where docente.email=?",[$doc]);
      
           $periodosaca['periodosaca']=DB::select("select DISTINCT periodoacademico.id,periodoacademico.fechaini,periodoacademico.fechafin,periodoacademico.nombre_tipolicencia from docentemodulo_horario
           inner join docente_modulo on docente_modulo.id_doc_mod = docentemodulo_horario.id_doc_mod
           inner join docente on docente_modulo.id_doc = docente.id_doc
           inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
           inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
           inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
           inner join matricula on matricula.id_curlic=cursolicencia.id_curlic
           inner join periodoacademico on matricula.id_periodo=periodoacademico.id
           where docente.id_doc=?
           order by periodoacademico.fechaini desc",[$idDoc]);
       
        
          //$datos = Arr::collapse([$licencias,$periodosaca,$apellido]);
          //return view('DOCENTE.SILABO.crearSilabo')->with('licencias',$licencias,$apellido);
          return view('DOCENTE.SILABO.crearSilabo',$periodosaca,$licencias)->with(compact('apellido',$apellido));
        }
        else{
            return redirect("/home");
        }
       
    }
    public function selectCursosSilabo($id)
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
    public function selectModulosSilabo($idP,$idCur)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
           
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $modulos=DB::select("select DISTINCT docente_modulo.id_doc_mod,modulo.id_mod,modulo.nombre_mod from matricula
            inner join cursolicencia on matricula.id_curlic = cursolicencia.id_curlic
			inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
			inner join modulo on modulo.id_mod = docente_modulo.id_mod
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join docentemodulo_horario on docentemodulo_horario.id_doc_mod=docente_modulo.id_doc_mod
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo	
			where docente_modulo.id_doc=? and periodoacademico.id=? and cursolicencia.id_curlic=?
			order by modulo.nombre_mod asc",[$idDoc,$idP,$idCur]);
            return response()->json($modulos);  
        }
        else{
            return redirect("/home");
        }
    }
    public function generarSilaboDocente()
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
                ->select('id_doc')
                ->where('email', auth()->user()->email)
                ->first()
                ->id_doc;
            $modulos=DB::select("select DISTINCT docente_modulo.id_doc_mod,modulo.id_mod,modulo.nombre_mod from matricula
            inner join cursolicencia on matricula.id_curlic = cursolicencia.id_curlic
			inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
			inner join modulo on modulo.id_mod = docente_modulo.id_mod
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join docentemodulo_horario on docentemodulo_horario.id_doc_mod=docente_modulo.id_doc_mod
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo	
			where docente_modulo.id_doc=? and periodoacademico.id=? and cursolicencia.id_curlic=?
			order by modulo.nombre_mod asc",[$idDoc,$idP,$idCur]);
            return response()->json($modulos);  
        }
        else{
            return redirect("/home");
        }
    }
    public function ingresar(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        { 
            $silabos=DB::select("select * from silabo
            where id_periodo=? and id_curlic=? and id_doc_mod=?",[$request->id_periodo,$request->id_curlic,$request->id_doc_mod]);
            if($silabos) 
            {
                return false;
            }
            else{
                $now = new \DateTime("America/Guayaquil");
                $fechaactual=$now->format('Y-m-d');
                $periodoactual=DB::select("select * from periodoacademico 
				where id=? and ? >= fechaini and ? <= fechafin",[$request->id_periodo,$fechaactual,$fechaactual]);
                if($periodoactual)
                {
                    $fechacreacion=DB::select("select * from periodoacademico 
				    where id=? and ? >= fechaini and ? <= fechafin",[$request->id_periodo,$request->fecha_creacion,$request->fecha_creacion]);
                    if($fechacreacion)
                    {
                        $silabo=DB::select('CALL insertarSilabo(?,?,?,?,?,?,?)',
                        [$request->id_periodo,$request->id_curlic,$request->id_doc_mod,$request->escuela,'PENDIENTE',$request->plan_estudio,$request->fecha_creacion]);
                        return 1;
                    }
                    else{
                        return 3;
                    }
                 
                }
                else{
                    return 2;
                }
                
            }
            
          
        }
        else{
            return redirect("/home");
        }
    }
    
    public function selectPeriodosA()
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
           $idDoc= DB::table('docente')
           ->select('id_doc')
           ->where('email', auth()->user()->email)
           ->first()
           ->id_doc;
           $periodosacad=DB::select("select DISTINCT periodoacademico.id,periodoacademico.fechaini,periodoacademico.fechafin,periodoacademico.nombre_tipolicencia from docentemodulo_horario
           inner join docente_modulo on docente_modulo.id_doc_mod = docentemodulo_horario.id_doc_mod
           inner join docente on docente_modulo.id_doc = docente.id_doc
           inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
           inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
           inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
           inner join matricula on matricula.id_curlic=cursolicencia.id_curlic
           inner join periodoacademico on matricula.id_periodo=periodoacademico.id
           where docente.id_doc=?
           order by periodoacademico.fechaini desc",[$idDoc]);
           return response()->json($periodosacad);  
        }
        else{
            return redirect("/home");
        }
       
    }
    public function tablaSilabos($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
           $idDoc= DB::table('docente')
           ->select('id_doc')
           ->where('email', auth()->user()->email)
           ->first()
           ->id_doc;
           $silabos=DB::select("select silabo.id_sil, docente_modulo.id_doc_mod, docente_modulo.id_doc,silabo.escuela,silabo.plan_estudio, modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo from silabo
           inner join docente_modulo on docente_modulo.id_doc_mod=silabo.id_doc_mod
           inner join modulo on modulo.id_mod=docente_modulo.id_mod
           inner join cursolicencia on cursolicencia.id_curlic=silabo.id_curlic
           inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
           inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
           where docente_modulo.id_doc=? and silabo.id_periodo=? 
           order by modulo.nombre_mod,paralelos.nombre_paralelo",[$idDoc,$id]);
          return view('DOCENTE.SILABO.tablaSilabos')->with(compact('silabos',$silabos));
        }
        else{
            return redirect("/home");
        }
       
    }
    public function mostrarDatosInfo($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
           $idDoc= DB::table('docente')
           ->select('id_doc')
           ->where('email', auth()->user()->email)
           ->first()
           ->id_doc;
           $datos=DB::select("select silabo.id_sil,silabo.escuela,silabo.plan_estudio, modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,periodoacademico.fechaini,periodoacademico.fechafin,silabo.fecha_creacion from silabo
           inner join docente_modulo on docente_modulo.id_doc_mod=silabo.id_doc_mod
           inner join modulo on modulo.id_mod=docente_modulo.id_mod
           inner join cursolicencia on cursolicencia.id_curlic=silabo.id_curlic
           inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
           inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
           inner join periodoacademico on periodoacademico.id=silabo.id_periodo
           where silabo.id_sil=?",[$id]);
          return view('DOCENTE.SILABO.datosInformativos')->with(compact('datos',$datos));
        }
        else{
            return redirect("/home");
        }
       
    }
    public function mostrarPrerrequisitos($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
                $silabo['silabos']=DB::select('select id_sil from silabo where id_sil=?',[$id]);
             //$prerrequisitos=DB::select('select * from prerrequisitos_silabo where id_sil=?',[$id]);
             $prerrequisitos=DB::table('prerrequisitos_silabo')
                                ->select('*')
                                ->where('id_sil',$id)
                                ->paginate(6);
             return view('DOCENTE.SILABO.prerrequisitos',$silabo)->with(compact('prerrequisitos',$prerrequisitos));
        }
        else{
            return redirect("/home");
        }
       
    }
    public function ingresarPrerrequisito(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $prerrequisito=DB::select('CALL insertarPrerrequisito(?,?)',
            [$request->nombre_prerrequisito,$request->id_sil]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    public function eliminarPrerrequisito($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $prerrequisito=DB::select('call eliminarPrerrequisito(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function editarPrerrequisito($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $prerrequisito=DB::select('select * from prerrequisitos_silabo where id_prerrequisito=?',[$id]);
            return response()->json($prerrequisito);
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizarPrerrequisito(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $prerrequisito=DB::select('CALL actualizarPrerrequisito(?,?)',
            [$request->id_prerrequisito,$request->nombre_prerrequisito]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function mostrarDatosAsignatura($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
             $datosAsignaturas=DB::select('select * from datos_asignatura where id_sil=?',[$id]);
             $silaboDA['silabosDA']=DB::select('select id_sil from silabo where id_sil=?',[$id]);
             if($datosAsignaturas)
             {
                $existe= array("no" => "existe");
                //return response()->json($existe);
                return view('DOCENTE.SILABO.datosAsignatura',$existe,$silaboDA)->with(compact('datosAsignaturas',$datosAsignaturas));  
             }
             else{ 
                $existe= array("no" => "noexiste");
                //return response()->json($existe);
                return view('DOCENTE.SILABO.datosAsignatura',$existe,$silaboDA)->with(compact('datosAsignaturas',$datosAsignaturas));
             }                
        }
        else{
            return redirect("/home");
        }
    }
    public function ingresarDatosAsignatura(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $datosAsignatura=DB::select('CALL insertarDatosAsignatura(?,?,?,?)',
            [$request->descripcionAsignatura,$request->competenciaAsignatura,$request->resultadoAsignatura,$request->id_silDA]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    public function actualizarDatosAsignatura(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $datosAsignatura=DB::select('CALL actualizarDatosAsignatura(?,?,?,?,?)',
            [$request->id_DA,$request->descripcionAsignatura,$request->competenciaAsignatura,$request->resultadoAsignatura,$request->id_Sil]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function mostrarUnidades($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['silabosU']=DB::select('select id_sil from silabo where id_sil=?',[$id]);
             $unidades=DB::table('unidades')
                                ->select('*')
                                ->where('id_sil',$id)
                                ->orderBy('orden_unidad', 'asc')
                                ->get();
             return view('DOCENTE.SILABO.tablaUnidades',$silabo)->with(compact('unidades',$unidades));
        }
        else{
            return redirect("/home");
        }
       
    }
    public function ingresarUnidad(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $unidad=DB::select('CALL insertarUnidad(?,?,?,?,?)',
            [$request->ordenUnidad,$request->tituloUnidad,$request->horasUnidad,$request->criteriosUnidad,$request->id_silU]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function eliminarUnidad($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $unidad=DB::select('call eliminarUnidad(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function editarUnidad($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $tablaUnidad=DB::select('select * from unidades where id_unidad=?',[$id]);
            return response()->json($tablaUnidad);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function actualizarUnidad(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $unidades=DB::select('CALL actualizarUnidad(?,?,?,?,?)',
            [$request->id_unidad,$request->orden_unidad,$request->titulo_unidad,$request->horas_unidad,$request->criterioevaluacion_unidad]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function mostrarTemas($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
            $silabo['unidadesT']=DB::select('select id_unidad from unidades where id_unidad=?',[$id]);
             $temas=DB::table('temas')
                                ->select('*')
                                ->where('id_unidad',$id)
                                ->orderBy('orden_tema', 'asc')
                                ->get();
             return view('DOCENTE.SILABO.tablaTemas',$silabo)->with(compact('temas',$temas));
        }
        else{
            return redirect("/home");
        }
       
    }
    public function ingresarTema(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            //llamarr procedimiento 
            $unidad=DB::select('CALL insertarUnidad(?,?,?,?,?)',
            [$request->ordenUnidad,$request->tituloUnidad,$request->horasUnidad,$request->criteriosUnidad,$request->id_silU]);
            return  back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function silabosPendientesVista(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="4"))
        {
            
            return view('DIRECTOR.SILABOS.silabosDirector');
        }
        else{
            return redirect("/home");
        }
    }
    public function silabosPendientes(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="4"))
        {
            if($request->ajax())
            {          
                $silabos=DB::select("select silabo.id_sil,silabo.escuela,silabo.plan_estudio, modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,silabo.estado,silabo.fecha_creacion,docente.apellido_doc,docente.name from silabo
                inner join docente_modulo on docente_modulo.id_doc_mod=silabo.id_doc_mod
                inner join docente on docente.id_doc=docente_modulo.id_doc
                inner join modulo on modulo.id_mod=docente_modulo.id_mod
                inner join cursolicencia on cursolicencia.id_curlic=silabo.id_curlic
                inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
                inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
                where silabo.estado='REVISION'
				order by silabo.fecha_creacion");
                return DataTables::of($silabos)
                ->addColumn('action',function($silabos){
                    $acciones='<div class="row justify-content-center"><div class="col p-1"><a href="javascript:void(0)" onclick="visualizarSilabo('.$silabos->id_sil.')" class="btn btn btn-outline-warning btn-sm" title="Visualizar"><i class="fa fa-eye px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="col p-1"><button type="button" onclick="aprobarSilabos('.$silabos->id_sil.')"  class="btn btn-outline-success btn-sm "  title="APROBAR sílabo"><i class="fa fa-check" aria-hidden="true">&nbsp;APROBAR</i></button></div>';
                   $acciones.='<div class="col p-1"><button type="button" onclick="corregirSilbaos('.$silabos->id_sil.')"  class="btn btn-outline-dark btn-sm "  title="Corregir sílabo"><i class="fa fa-align-center" aria-hidden="true">&nbsp;CORREGIR</i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DIRECTOR.SILABOS.silabosDirector');
        }
        else{
            return redirect("/home");
        }
    }
    public function silabosTodos(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="4"))
        {
            if($request->ajax())
            {          
                $silabos=DB::select("select silabo.id_sil,silabo.escuela,silabo.plan_estudio, modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,silabo.estado,silabo.fecha_creacion,docente.apellido_doc,docente.name from silabo
                inner join docente_modulo on docente_modulo.id_doc_mod=silabo.id_doc_mod
                inner join docente on docente.id_doc=docente_modulo.id_doc
                inner join modulo on modulo.id_mod=docente_modulo.id_mod
                inner join cursolicencia on cursolicencia.id_curlic=silabo.id_curlic
                inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
                inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
				order by silabo.fecha_creacion desc");
                return DataTables::of($silabos)
                ->addColumn('action',function($silabos){
                    $acciones='<div class="row justify-content-center"><div class="col p-1"><a href="javascript:void(0)" onclick="visualizarSilabo('.$silabos->id_sil.')" class="btn btn btn-outline-warning btn-sm" title="Visualizar"><i class="fa fa-eye px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="col p-1"><button type="button" onclick="silaboAPendiente('.$silabos->id_sil.')"  class="btn btn-outline-success btn-sm "  title="Cambiar estado a pendiente sílabo"><i class="fa fa-check" aria-hidden="true">&nbsp;PENDIENTE</i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DIRECTOR.SILABOS.silabosDirector');
        }
        else{
            return redirect("/home");
        }
    }
    public function mostrarEstadoSilabo($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
           $sils=DB::select("select * from silabo where silabo.id_sil=?",[$id]);
          return view('DOCENTE.SILABO.estadoSilabo')->with(compact('sils',$sils));
        }
        else{
            return redirect("/home");
        }
    }
    
    public function mostrarEstadoSilabo2($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
           $sils=DB::select("select * from silabo where silabo.id_sil=?",[$id]);
          return view('DOCENTE.SILABOSOLODATOS.estadoSilabo')->with(compact('sils',$sils));
        }
        else{
            return redirect("/home");
        }
    }
    public function mostrarEstadoSilaboBoton($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {  
           $silaboEstados=DB::select("select * from silabo where silabo.id_sil=?",[$id]);
           return response()->json($silaboEstados);
        }
        else{
            return redirect("/home");
        }
    }
    public function visualizarSilabo($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="4"))
        {  
           $sils=DB::select("select silabo.id_sil,silabo.escuela,silabo.plan_estudio, modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,silabo.estado from silabo
           inner join docente_modulo on docente_modulo.id_doc_mod=silabo.id_doc_mod
           inner join modulo on modulo.id_mod=docente_modulo.id_mod
           inner join cursolicencia on cursolicencia.id_curlic=silabo.id_curlic
           inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
           inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
           where silabo.id_sil=?",[$id]);
          return view('DIRECTOR.SILABOS.datosInformativos')->with(compact('sils',$sils));
        }
        else{
            return redirect("/home");
        }
    }
    public function silaboDocente($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="4")||(auth()->check()) && (auth()->user()->rol=="3"))
        {  
           $datos=DB::select("select silabo.id_sil,silabo.escuela,silabo.plan_estudio, modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,periodoacademico.fechaini,periodoacademico.fechafin,silabo.fecha_creacion,docente.instruccion_doc,docente.apellido_doc,docente.name from silabo
           inner join docente_modulo on docente_modulo.id_doc_mod=silabo.id_doc_mod
           inner join docente on docente_modulo.id_doc=docente.id_doc
           inner join modulo on modulo.id_mod=docente_modulo.id_mod
           inner join cursolicencia on cursolicencia.id_curlic=silabo.id_curlic
           inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
           inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
           inner join periodoacademico on periodoacademico.id=silabo.id_periodo
           where silabo.id_sil=?",[$id]);
           $prerrequisitos=DB::select('select * from prerrequisitos_silabo where id_sil=?',[$id]);
           $datosAsignaturas=DB::select('select * from datos_asignatura where id_sil=?',[$id]);
           $unidades=DB::select("select u.id_unidad,u.orden_unidad,u.titulo_unidad,u.horas_unidad,u.criterioevaluacion_unidad
                                        ,temas.id_unidad as tema_id_unidad,temas.id_tema,temas.tipo_clase,temas.orden_tema,temas.titulo_tema, temas.actividadesdocencia_tema,
                                        temas.actdocpracapliexp_tema,temas.actaprauto_tema,temas.horasdocencia_tema,temas.horasapreexp_tema,temas.horastraaut_tema,temas.semana_tema,
                                        subtemas.id_tema as subtema_id_tema,subtemas.id_subtema,subtemas.orden_subtema,subtemas.titulo_subtema from unidades as u
                                inner join temas on temas.id_unidad =u.id_unidad
                                inner join subtemas on subtemas.id_tema = temas.id_tema
                                where id_sil=?
                                order by u.orden_unidad , temas.orden_tema, subtemas.orden_subtema",[$id]);
            $evaluacionesU=DB::select("select u.id_unidad,u.orden_unidad,u.titulo_unidad,u.horas_unidad,u.criterioevaluacion_unidad, 		
                                                evaluacion_unidad.id_unidad as evaluacion_id_unidad,evaluacion_unidad.tipo_evaluacion,evaluacion_unidad.detalle_evaluacion from unidades as u
                                        inner join evaluacion_unidad on evaluacion_unidad.id_unidad =u.id_unidad
                                        where id_sil=?
                                        order by u.orden_unidad , evaluacion_unidad.tipo_evaluacion",[$id]);
            $tecnicasU=DB::select("select u.id_unidad,	
                                            tecnicas_unidad.id_unidad as tecnica_id_unidad,tecnicas_unidad.tecnica,tecnicas_unidad.instrumento from unidades as u
                                    inner join tecnicas_unidad on tecnicas_unidad.id_unidad =u.id_unidad
                                    where id_sil=?
                                    order by u.orden_unidad , tecnicas_unidad.tecnica",[$id]);
            $resultadosU=DB::select("select u.id_unidad,	
                                            resultados_unidad.id_unidad as resultado_id_unidad,resultados_unidad.resultado from unidades as u
                                    inner join resultados_unidad on resultados_unidad.id_unidad =u.id_unidad
                                    where id_sil=?
                                    order by u.orden_unidad , resultados_unidad.resultado",[$id]);
            $metodologias=DB::select('select * from  metodos_enseñanza 
                                        where id_sil=?
                                        order by metodos_enseñanza.descripcion_metodo',[$id]);
            $recursos=DB::select('select * from  recursos_enseñanza 
                                    where id_sil=?
                                    order by recursos_enseñanza.descripcion_recurso',[$id]);
            $escenarios=DB::select('select * from  escenarios_aprendizaje 
                                    where id_sil=?
                                    order by escenarios_aprendizaje.descripcion_escenario',[$id]);
            $bibliografias=DB::select('select * from  bibliografia_silabo 
                                        where id_sil=?
                                        order by bibliografia_silabo.titulo_bibliografia',[$id]);
            $bibliografiasComplementarias=DB::select('select * from  bibliografia_complementaria
                                                        where id_sil=?
                                                        order by bibliografia_complementaria.descripcion_bibliografia',[$id]);
            $webgrafias=DB::select('select * from  webgrafia
                                    where id_sil=?
                                    order by webgrafia.descripcion_webgrafia',[$id]);
            $bibliografiasDigitales=DB::select('select * from  bibliografia_digital
                                                where id_sil=?
                                                order by bibliografia_digital.descripcion_bdigital',[$id]);
            $silaboEstado=DB::select('select * from silabo where id_sil=?',[$id]);
           $datosT = ['datos' => $datos, 'prerrequisitos' => $prerrequisitos,'datosAsignaturas' => $datosAsignaturas,'unidades' => $unidades,'evaluacionesU' => $evaluacionesU,'tecnicasU' => $tecnicasU,'resultadosU' => $resultadosU,'metodologias' => $metodologias,'recursos' => $recursos,'escenarios' => $escenarios,'bibliografias' => $bibliografias,'bibliografiasComplementarias' => $bibliografiasComplementarias,'webgrafias' => $webgrafias,'bibliografiasDigitales' => $bibliografiasDigitales,'silaboEstado' => $silaboEstado];
          $pdf=PDF::loadView('DIRECTOR.SILABOS.mostrarSilaboD',$datosT);
            return $pdf->stream('Silabo'.'.pdf');           
        }
        else{
            return redirect("/home");
        }
       
    }
    public function aprobarSilabo($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="4"))
        {  
            $SILABO=DB::select('CALL actualizarEstadoSilabo(?)',
            [$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function pendienteSilabo($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="4"))
        {  
            $SILABO=DB::select('CALL actualizarEstadoSilaboPendiente(?)',
            [$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function revisarSilabo(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3")||(auth()->check()) && (auth()->user()->rol=="4"))
        {  
            $SILABO=DB::select('CALL actualizarEstadoSilaboR(?,?)',
            [$request->id_sil,$request->estado]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function cargarTablaP($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="4"))
        {         
                $silabos['silabos']=DB::select("select silabo.id_sil,silabo.escuela,silabo.plan_estudio, modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,silabo.estado,silabo.fecha_creacion from silabo
                inner join docente_modulo on docente_modulo.id_doc_mod=silabo.id_doc_mod
                inner join modulo on modulo.id_mod=docente_modulo.id_mod
                inner join cursolicencia on cursolicencia.id_curlic=silabo.id_curlic
                inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
                inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
				inner join periodoacademico on periodoacademico.id = silabo.id_periodo
				where periodoacademico.id=?
				order by silabo.fecha_creacion",[$id]);
                return view('DIRECTOR.SILABOS.silaboPeriodo',$silabos);
        }
        else{
            return redirect("/home");
        }
    }
    public function duplicarSilaboDocenteModal($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
           
           $idDoc= DB::table('docente')
           ->select('id_doc')
           ->where('email', auth()->user()->email)
           ->first()
           ->id_doc;
        
           $doc=auth()->user()->email;
           $apellido=DB::select("select docente.apellido_doc, docente.name from docente where docente.email=?",[$doc]);
           $periodosaca=DB::select("select DISTINCT periodoacademico.id,periodoacademico.fechaini,periodoacademico.fechafin,periodoacademico.nombre_tipolicencia from docentemodulo_horario
           inner join docente_modulo on docente_modulo.id_doc_mod = docentemodulo_horario.id_doc_mod
           inner join docente on docente_modulo.id_doc = docente.id_doc
           inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
           inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
           inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
           inner join matricula on matricula.id_curlic=cursolicencia.id_curlic
           inner join periodoacademico on matricula.id_periodo=periodoacademico.id
           where docente.id_doc=?
           order by periodoacademico.fechaini desc",[$idDoc]);
           $silabo=DB::select("select * from silabo where id_sil=?",[$id]);
       
            $datos = Arr::collapse([$silabo,$apellido,$periodosaca]);
            return response()->json($datos);  
          //return view('DOCENTE.SILABO.crearSilabo')->with('licencias',$licencias,$apellido);
        }
        else{
            return redirect("/home");
        }
       
    }
    public function duplicarSilaboDocente(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        { 
            $silabos=DB::select("select * from silabo
            where id_periodo=? and id_curlic=? and id_doc_mod=?",[$request->id_periodo,$request->id_curlic,$request->id_doc_mod]);
            if($silabos) 
            {
                return false;
            }
            else{
                $sil=DB::select('CALL insertarSilabo(?,?,?,?,?,?,?)',
                [$request->id_periodo,$request->id_curlic,$request->id_doc_mod,$request->escuela,'PENDIENTE',$request->plan_estudio,$request->fecha_creacion]);
                $idUltimo=DB::getPdo()->lastInsertId();
                $prerrequisitosAnt=DB::select('select * from prerrequisitos_silabo where id_sil=?',[$request->id_sil]);
                foreach($prerrequisitosAnt as $p){
                    DB::select('CALL insertarPrerrequisito(?,?)',
                    [$p->descripcion_prerrequisito,$idUltimo]);
                }
                $datosAsignaturasAnt=DB::select('select * from datos_asignatura where id_sil=?',[$request->id_sil]);
                foreach($datosAsignaturasAnt as $DA){
                    DB::select('CALL insertarDatosAsignatura(?,?,?,?)',
                    [$DA->descripcion_asignatura,$DA->competencia_asignatura,$DA->resultado_asignatura,$idUltimo]);
                }
                $unidadesAnt=DB::select("select u.id_unidad,u.orden_unidad,u.titulo_unidad,u.horas_unidad,u.criterioevaluacion_unidad
                                        ,temas.id_unidad as tema_id_unidad,temas.id_tema,temas.tipo_clase,temas.orden_tema,temas.titulo_tema, temas.actividadesdocencia_tema,
                                        temas.actdocpracapliexp_tema,temas.actaprauto_tema,temas.horasdocencia_tema,temas.horasapreexp_tema,temas.horastraaut_tema,temas.semana_tema,
                                        subtemas.id_tema as subtema_id_tema,subtemas.id_subtema,subtemas.orden_subtema,subtemas.titulo_subtema from unidades as u
                                inner join temas on temas.id_unidad =u.id_unidad
                                inner join subtemas on subtemas.id_tema = temas.id_tema
                                where id_sil=?
                                order by u.orden_unidad , temas.orden_tema, subtemas.orden_subtema",[$request->id_sil]);
                $evaluacionesU=DB::select("select u.id_unidad,u.orden_unidad,u.titulo_unidad,u.horas_unidad,u.criterioevaluacion_unidad, 		
                                            evaluacion_unidad.id_unidad as evaluacion_id_unidad,evaluacion_unidad.tipo_evaluacion,evaluacion_unidad.detalle_evaluacion from unidades as u
                                        inner join evaluacion_unidad on evaluacion_unidad.id_unidad =u.id_unidad
                                        where id_sil=?
                                        order by u.orden_unidad , evaluacion_unidad.tipo_evaluacion",[$request->id_sil]);
                $tecnicasU=DB::select("select u.id_unidad,	
                                            tecnicas_unidad.id_unidad as tecnica_id_unidad,tecnicas_unidad.tecnica,tecnicas_unidad.instrumento from unidades as u
                                    inner join tecnicas_unidad on tecnicas_unidad.id_unidad =u.id_unidad
                                    where id_sil=?
                                    order by u.orden_unidad , tecnicas_unidad.tecnica",[$request->id_sil]);
                $resultadosU=DB::select("select u.id_unidad,	
                                            resultados_unidad.id_unidad as resultado_id_unidad,resultados_unidad.resultado from unidades as u
                                    inner join resultados_unidad on resultados_unidad.id_unidad =u.id_unidad
                                    where id_sil=?
                                    order by u.orden_unidad , resultados_unidad.resultado",[$request->id_sil]);      
                $titulou="";
                $tituloTema="";
                foreach ($unidadesAnt as $unidad)
                {  
                        if($titulou==$unidad->id_unidad)   
                        {
                        } 
                        else
                        {
                            DB::select('CALL insertarUnidad(?,?,?,?,?)',
                            [$unidad->orden_unidad,$unidad->titulo_unidad,$unidad->horas_unidad,$unidad->criterioevaluacion_unidad,$idUltimo]);
                            $idUltimoUnidad=DB::getPdo()->lastInsertId();
                                                        foreach ($evaluacionesU as $evaluacion)
                                                        {
                                                            if($unidad->id_unidad==$evaluacion->id_unidad)  
                                                            {
                                                                DB::select('CALL insertarEvaluacionUnidad(?,?,?)',
                                                                [$evaluacion->tipo_evaluacion,$evaluacion->detalle_evaluacion,$idUltimoUnidad]);
                                                            } 
                                                        }
                                                        foreach ($tecnicasU as $tecnica)
                                                        {
                                                            if($unidad->id_unidad==$tecnica->id_unidad)  
                                                            {
                                                                DB::select('CALL insertarTecnicaInstrumento(?,?,?)',
                                                                [$tecnica->tecnica,$tecnica->instrumento,$idUltimoUnidad]);
                                                            } 
                                                        }
                                                        foreach ($resultadosU as $resultado)
                                                        {
                                                            if($unidad->id_unidad==$resultado->id_unidad)  
                                                            {
                                                                DB::select('CALL insertarResultadoUnidad(?,?)',
                                                                [$resultado->resultado,$idUltimoUnidad]);
                                                            } 
                                                        } 
                                foreach ($unidadesAnt as $temas)  
                                {   
                                    if($tituloTema==$temas->id_tema)
                                    {
                                    } 
                                    else  
                                    { 
                                            if($unidad->id_unidad==$temas->tema_id_unidad) 
                                            {
                                                DB::select('CALL insertarTema(?,?,?,?,?,?,?,?,?,?,?)',
                                                [$temas->tipo_clase,$temas->orden_tema,$temas->titulo_tema,$temas->actividadesdocencia_tema,$temas->actdocpracapliexp_tema,$temas->actaprauto_tema,$temas->horasdocencia_tema,$temas->horasapreexp_tema,$temas->horastraaut_tema,$temas->semana_tema,$idUltimoUnidad]);
                                                
                                                $idUltimoTema=DB::getPdo()->lastInsertId();
                                                        foreach ($unidadesAnt as $subtema)
                                                        {
                                                            if($temas->id_tema==$subtema->subtema_id_tema)
                                                            {  
                                                                DB::select('CALL insertarSubTema(?,?,?)',
                                                                [$subtema->orden_subtema,$subtema->titulo_subtema,$idUltimoTema]);
                                                            }
                                                        }
                                                    $tituloTema=$temas->id_tema; 
                                            }
                                    }
                                }
                                $titulou=$unidad->id_unidad;    
                        }
                }  
                $metodologias=DB::select('select * from  metodos_enseñanza 
                                        where id_sil=?
                                        order by metodos_enseñanza.descripcion_metodo',[$request->id_sil]);
                foreach($metodologias as $metodolog){
                    DB::select('CALL insertarMetodoEnseñanza(?,?)',
                    [$metodolog->descripcion_metodo,$idUltimo]);
                }
                $recursos=DB::select('select * from  recursos_enseñanza 
                                            where id_sil=?
                                            order by recursos_enseñanza.descripcion_recurso',[$request->id_sil]);
                foreach($recursos as $recurso){
                    DB::select('CALL insertarRecursoEnseñanza(?,?)',
                    [$recurso->descripcion_recurso,$idUltimo]);
                }
                $escenarios=DB::select('select * from  escenarios_aprendizaje 
                                            where id_sil=?
                                            order by escenarios_aprendizaje.descripcion_escenario',[$request->id_sil]);
                foreach($escenarios as $escenario){
                    DB::select('CALL insertarEscenariosAprendizaje(?,?)',
                    [$escenario->descripcion_escenario,$idUltimo]);
                }
                $bibliografias=DB::select('select * from  bibliografia_silabo 
                                        where id_sil=?
                                        order by bibliografia_silabo.titulo_bibliografia',[$request->id_sil]);
                foreach($bibliografias as $bibliografian){
                    DB::select('CALL insertarBibliografiaSilabo(?,?,?,?,?,?,?,?)',
                    [$bibliografian->tipo_bibliografia,$bibliografian->titulo_bibliografia,$bibliografian->autor_bibliografia,$bibliografian->tipo_documento_bibliografia,$bibliografian->editorial_bibliografia,$bibliografian->fecha_publicacion_bibliografia,$bibliografian->numero_pagina_bibliografia,$idUltimo]);
                }                   
                $bibliografiasComplementarias=DB::select('select * from  bibliografia_complementaria
                                                        where id_sil=?
                                                        order by bibliografia_complementaria.descripcion_bibliografia',[$request->id_sil]);
                foreach($bibliografiasComplementarias as $bibliografiaComplementaria){
                    DB::select('CALL insertarBibliografiaComplementaria(?,?)',
                    [$bibliografiaComplementaria->descripcion_bibliografia,$idUltimo]);
                }  
                $webgrafias=DB::select('select * from  webgrafia
                                    where id_sil=?
                                    order by webgrafia.descripcion_webgrafia',[$request->id_sil]);
                foreach($webgrafias as $webgrafian){
                    DB::select('CALL insertarWebgrafia(?,?)',
                    [$webgrafian->descripcion_webgrafia,$idUltimo]);
                }  
                $bibliografiasDigitales=DB::select('select * from  bibliografia_digital
                                                where id_sil=?
                                                order by bibliografia_digital.descripcion_bdigital',[$request->id_sil]);
                foreach($bibliografiasDigitales as $bibliografiaDigitale){
                    DB::select('CALL insertarBibliografiaDigital(?,?)',
                    [$bibliografiaDigitale->descripcion_bdigital,$idUltimo]);
                }  
                return true;
            }
            
          
        }
        else{
            return redirect("/home");
        }
    }
    
}
