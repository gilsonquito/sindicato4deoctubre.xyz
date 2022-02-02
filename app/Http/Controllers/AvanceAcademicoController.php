<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AvanceAcademico;
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
use DateTime;
Use \Carbon\Carbon;
use PDF;

class AvanceAcademicoController extends Controller
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
            return view('DOCENTE.AVANCESACADEMICO.listarAvances');
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
                $avances=DB::select('select * from avanceacademico
                inner join silabo on silabo.id_sil=avanceacademico.id_sil
                 inner join docente_modulo on docente_modulo.id_doc_mod = silabo.id_doc_mod
                 inner join modulo on docente_modulo.id_mod=modulo.id_mod 
                 inner join periodoacademico on silabo.id_periodo=periodoacademico.id
                                inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
                                inner join tipolicencia on cursolicencia.id_tlic = tipolicencia.id_tlic
                                inner join paralelos on cursolicencia.id_paralelo = paralelos.id_paralelo
                                 where docente_modulo.id_doc=?',[$idDoc]);
                return DataTables::of($avances)
                ->addColumn('action',function($avances){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarAvancesAcademico('.$avances->id_avance.')" class="btn btn btn-outline-warning btn-sm" title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="deleteAvanceAcademico" id="'.$avances->id_avance.'"  class="deleteAvanceAcademico btn btn-outline-danger btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('DOCENTE.AVANCESACADEMICO.listarAvances');
        }
        else{
            return redirect("/home");
        }
    }

    public function generarAvanceAcademico()
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
    
    public function generarAvance()
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            return view('DOCENTE.AVANCESACADEMICO.indexAvanceAcademico');
        }
        else{
            return redirect("/home");
        }
       
    }
    public function ingresarAvanceVista($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $now = new \DateTime("America/Guayaquil");
            $fecha=$now->format('Y-m-d');
            $silabos=DB::select("select * from silabo where id_sil=?",[$id]);
            foreach($silabos as $silabo){
                $id_Doc_Mod=$silabo->id_doc_mod;
                $id_PeriodoAca=$silabo->id_periodo; 
            
            }
            $horarios['horarios']=DB::select("select DISTINCT horario.id_horario, horario.hora_inicio, horario.hora_fin,horario.tipo_dias from horario
            inner join docentemodulo_horario on docentemodulo_horario.id_horario = horario.id_horario
            inner join periodohorario on periodohorario.id_phorario=docentemodulo_horario.id_phorario
            inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo
            inner join docente_modulo on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
            where docente_modulo.id_doc_mod=? and periodoacademico.id=? and ? >= periodohorario.fecha_inicio and ? <= periodohorario.fecha_fin",[$id_Doc_Mod,$id_PeriodoAca,$fecha,$fecha]);
            $directores['directores']=DB::select("select users.id, users.name from users where users.rol='4'");
            $fechas['fechas']=$fecha;
            $silaboId['silaboId']=DB::select("select * from silabo where id_sil=?",[$id]);
            $datos = Arr::collapse([$fechas,$horarios,$directores,$silaboId]);
            return view('DOCENTE.AVANCESACADEMICO.ingresarAvance',$datos);
        }
        else{
            return redirect("/home");
        }
       
    }
    public function ingresarAvanceAcedmico(Request $request){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
                $avances=DB::select("select * from avanceacademico
                where fecha_avance=? and hora_avance=? and id_sil=?",[$request->fecha_avance,$request->hora_avance,$request->id_sil]);
                if($avances) 
                {
                    return false;
                }
                else{
                    $avance=DB::select('CALL insertarAvanceAcademico(?,?,?,?)',
                    [$request->fecha_avance,$request->hora_avance,$request->responsable_avance,$request->id_sil]);
                    $idUltimo=DB::getPdo()->lastInsertId();
                    session(['idAvance' => $idUltimo]);
                    return $idUltimo;
                }
        }
        else{
            return redirect("/home");
        }
    }
    public function eliminarAvanceAcedmico($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $subtema=DB::select('call eliminarSubTema(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function eliminar($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $now = new \DateTime("America/Guayaquil");
            $fecha=$now->format('Y-m-d');
                $avance=DB::select("  select * from avanceacademico
                where id_avance=? and fecha_avance=?",[$id,$fecha]);
                if($avance) 
                {
                    $avances=DB::select('CALL eliminarAvanceAcademico(?)',
                    [$id]);
                    return true;
                }
                else{
                   return false;
                }
        }
        else{
            return redirect("/home");
        }
    }
    public function editarAvanceAcdemico($id){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $now = new \DateTime("America/Guayaquil");
            $fecha=$now->format('Y-m-d');
                $avance=DB::select("  select * from avanceacademico
                where id_avance=? and fecha_avance=?",[$id,$fecha]);
                if($avance) 
                {
                    $avanceAca=DB::select('select * from avanceacademico
                    inner join silabo on silabo.id_sil=avanceacademico.id_sil
                     inner join docente_modulo on docente_modulo.id_doc_mod = silabo.id_doc_mod
                     inner join modulo on docente_modulo.id_mod=modulo.id_mod 
                     inner join periodoacademico on silabo.id_periodo=periodoacademico.id
                                    inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
                                    inner join tipolicencia on cursolicencia.id_tlic = tipolicencia.id_tlic
                                    inner join paralelos on cursolicencia.id_paralelo = paralelos.id_paralelo
                                     where avanceacademico.id_avance=?',[$id]);
                    return response()->json($avanceAca);
                }
                else{
                   return false;
                }
        }
        else{
            return redirect("/home");
        }
        
    }
    public function reporteAvance(){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            return view('DOCENTE.AVANCESACADEMICO.reporteAvance');
        }
        else{
            return redirect("/home");
        }
    }
    public function pdfReporteAvance($id,$fechainicio,$fechafin){
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $datos=DB::select("select silabo.id_sil,silabo.escuela,silabo.plan_estudio, modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,periodoacademico.fechaini,periodoacademico.fechafin,silabo.fecha_creacion,docente.instruccion_doc,docente.apellido_doc,docente.name,docente.cedula_doc from silabo
            inner join docente_modulo on docente_modulo.id_doc_mod=silabo.id_doc_mod
            inner join docente on docente_modulo.id_doc=docente.id_doc
            inner join modulo on modulo.id_mod=docente_modulo.id_mod
            inner join cursolicencia on cursolicencia.id_curlic=silabo.id_curlic
            inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
            inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
            inner join periodoacademico on periodoacademico.id=silabo.id_periodo
            where silabo.id_sil=?",[$id]);
            $avances=DB::select("select avanceacademico.id_avance,avanceacademico.fecha_avance,avanceacademico.hora_avance,tipolicencia.nombre_tlic, 
                                cursolicencia.jornada, cursolicencia.modalidad, modulo.nombre_mod,paralelos.nombre_paralelo,
                                detalle_avanceacademico.metodologias_avance,
                                detalle_avanceacademico.recursos_avance,detalle_avanceacademico.actividades_avance,detalle_avanceacademico.evidencias_avance,
                                detalle_avanceacademico.motivo_inasistencia_avance,	detalle_avanceacademico.observacion_avance from avanceacademico
            inner join silabo on silabo.id_sil =avanceacademico.id_sil
            inner join docente_modulo on docente_modulo.id_doc_mod=silabo.id_doc_mod
            inner join modulo on modulo.id_mod=docente_modulo.id_mod
            inner join cursolicencia on cursolicencia.id_curlic=silabo.id_curlic
            inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
            inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
            inner join detalle_avanceacademico on detalle_avanceacademico.id_avance=avanceacademico.id_avance
            where silabo.id_sil=? and avanceacademico.fecha_avance>=? and avanceacademico.fecha_avance<=?",[$id,$fechainicio,$fechafin]);
            $subtemas=DB::select("select avanceacademico.id_avance,titulo_subtema,temas.titulo_tema,unidades.titulo_unidad from avanceacademico
                inner join avanceacademico_subtemas on avanceacademico_subtemas.id_avance=avanceacademico.id_avance
                inner join subtemas on subtemas.id_subtema=avanceacademico_subtemas.id_subtema
                inner join temas on temas.id_tema=subtemas.id_tema
                inner join unidades on unidades.id_unidad=temas.id_unidad
                where avanceacademico.id_sil=?
                order by unidades.titulo_unidad,temas.titulo_tema,titulo_subtema",[$id]);
           
            $datosT = ['datos' => $datos,'fechainicio' => $fechainicio,'fechafin' => $fechafin,'avances' => $avances,'subtemas' => $subtemas];
            $pdf=PDF::loadView('DOCENTE.AVANCESACADEMICO.pdfReporteAvance',$datosT)->setPaper('a4', 'landscape');
            return $pdf->stream('ReporteAvancesAcademicos'.'.pdf');     
            //return view('DOCENTE.AVANCESACADEMICO.pdfReporteAvance',$datosT);      
        
        }
        else{
            return redirect("/home");
        }
    }

        
}
