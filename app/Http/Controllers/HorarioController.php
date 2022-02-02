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
use App\Models\Horario;
use PDF;


class HorarioController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    public function indexVista(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            
            return view('HORARIO.indexHorario');
        }
        else{
            return redirect("/home");
        }
    }
    public function index(Request $request)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            if($request->ajax())
            {
                $horarios=DB::select('select * from horario');
                return DataTables::of($horarios)
                ->addColumn('action',function($horarios){
                    $acciones='<div class="row justify-content-center"><div class="p-1"><a href="javascript:void(0)" onclick="editarHorario('.$horarios->id_horario.')" class="btn btn-warning btn-sm " title="Editar"><i class="fa fa-pencil px-2" aria-hidden="true"></i> </a></div>';
                    $acciones.='<div class="p-1"><button type="button" name="delete" id="'.$horarios->id_horario.'"  class="delete btn btn-danger  btn-sm "  title="Eliminar"><i class="fa fa-trash-o px-2" aria-hidden="true"></i></button></div></div>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('HORARIO.indexHorario');
        }
        else{
            return redirect("/home");
        }
    }
   
    public function ingresar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $this->validate($request,[
                'tipo_dias'=>'required',
                'hora_inicio'=>'required',
                'hora_fin'=>'required'
            ]);
            $existe=DB::select('select * from horario where tipo_dias=? and hora_inicio=? and hora_fin =?',[$request->tipo_dias,$request->hora_inicio,$request->hora_fin]);

            if($existe)
            {
                return 2;
            }
            else
            {
                $horarios=DB::select('CALL insertarHorario(?,?,?)',
                [$request->tipo_dias,$request->hora_inicio,$request->hora_fin]);
                return  1;
            }
        }
        else{
            return redirect("/home");
        }
    }
     
    public function eliminar($id){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $periodoacademico=DB::select('call eliminarHorario(?)',[$id]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    
    public function editar($id)
    {
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $horarios=DB::select('select * from horario where id_horario=?',[$id]);
            return response()->json($horarios);
        }
        else{
            return redirect("/home");
        }
    }
    
    public function actualizar(Request $request){
        if (((auth()->check()) && (auth()->user()->rol=="1"))||((auth()->check()) && (auth()->user()->rol=="5")))
        {
            $horarios=DB::select('CALL actualizarHorario(?,?,?,?)',
            [$request->id_horario,$request->tipo_dias,$request->hora_inicio,$request->hora_fin]);
            return back();
        }
        else{
            return redirect("/home");
        }
    }
    public function horarioDocente(Request $request)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
            ->select('id_doc')
            ->where('email', auth()->user()->email)
            ->first()
            ->id_doc;
            $periodosa=DB::select("select DISTINCT periodoacademico.id,periodoacademico.fechaini,periodoacademico.fechafin,periodoacademico.nombre_tipolicencia from docentemodulo_horario
            inner join docente_modulo on docente_modulo.id_doc_mod = docentemodulo_horario.id_doc_mod
            inner join docente on docente_modulo.id_doc = docente.id_doc
            inner join horario on docentemodulo_horario.id_horario = horario.id_horario
            inner join modulo on docente_modulo.id_mod=modulo.id_mod
            inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
			inner join periodohorario on periodohorario.id_phorario=docentemodulo_horario.id_phorario
			inner join periodoacademico on periodohorario.id_periodo=periodoacademico.id
            inner join matricula on matricula.id_curlic=cursolicencia.id_curlic
            where docente.id_doc=?
            order by periodoacademico.fechaini desc",[$idDoc]);

            return view('DOCENTE.HORARIODOCENTE.indexHorarioDocente')->with('periodosa',$periodosa);;
            
        }
        else{
            return redirect("/home");
        }
    }
    public function cargarminiperiodoshorarios($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
            ->select('id_doc')
            ->where('email', auth()->user()->email)
            ->first()
            ->id_doc;
            $periodoshor=DB::select("select distinct periodohorario.id_phorario,periodohorario.fecha_inicio,periodohorario.fecha_fin,periodohorario.id_periodo from docentemodulo_horario
            inner join docente_modulo on docente_modulo.id_doc_mod = docentemodulo_horario.id_doc_mod
            inner join docente on docente_modulo.id_doc = docente.id_doc
            inner join horario on docentemodulo_horario.id_horario = horario.id_horario
            inner join modulo on docente_modulo.id_mod=modulo.id_mod
            inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
			inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
			inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
			inner join periodohorario on periodohorario.id_phorario=docentemodulo_horario.id_phorario
			inner join periodoacademico on periodohorario.id_periodo=periodoacademico.id
            where periodoacademico.id=? and docente.id_doc=?
			order by periodohorario.fecha_inicio",[$id,$idDoc]);
            return response()->json($periodoshor);
            
        }
        else{
            return redirect("/home");
        }
    }
    public function cargartablahorario($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
            ->select('id_doc')
            ->where('email', auth()->user()->email)
            ->first()
            ->id_doc;
         
            $horarios=DB::select("select horario.id_horario,horario.tipo_dias,horario.hora_inicio,horario.hora_fin,docente.instruccion_doc,modulo.nombre_mod,tipolicencia.nombre_tlic,paralelos.nombre_paralelo from docentemodulo_horario
            inner join horario on horario.id_horario=docentemodulo_horario.id_horario
            inner join docente_modulo on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
            inner join docente on docente_modulo.id_doc=docente.id_doc
            inner join modulo on docente_modulo.id_mod=modulo.id_mod
            inner join cursolicencia on docente_modulo.id_curlic=cursolicencia.id_curlic
            inner join tipolicencia on cursolicencia.id_tlic=tipolicencia.id_tlic
            inner join paralelos on cursolicencia.id_paralelo=paralelos.id_paralelo
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            where docente.id_doc=? and periodohorario.id_phorario=?
            order by horario.hora_inicio",[$idDoc,$id]);
            $i=0;
            $j=0;
            $HorarioClases[0][0] = "";
            foreach($horarios as $t)
            {
                if($t->tipo_dias=="Lun-Vie")
                {
                    $HorarioClases[$i][$j] = $t->hora_inicio." - ".$t->hora_fin;
                    $HorarioClases[$i][$j+1] = $t->nombre_mod." Licencia tipo ".$t->nombre_tlic." Paralelo ".$t->nombre_paralelo;
                    $HorarioClases[$i][$j+2] = $t->nombre_mod." Licencia tipo ".$t->nombre_tlic." Paralelo ".$t->nombre_paralelo;
                    $HorarioClases[$i][$j+3] = $t->nombre_mod." Licencia tipo ".$t->nombre_tlic." Paralelo ".$t->nombre_paralelo;
                    $HorarioClases[$i][$j+4] = $t->nombre_mod." Licencia tipo ".$t->nombre_tlic." Paralelo ".$t->nombre_paralelo;
                    $HorarioClases[$i][$j+5] = $t->nombre_mod." Licencia tipo ".$t->nombre_tlic." Paralelo ".$t->nombre_paralelo;
                    $HorarioClases[$i][$j+6] = "";
                    $HorarioClases[$i][$j+7] = "";
                }
                if($t->tipo_dias=="Sab-Dom")
                {
                    $HorarioClases[$i][$j] = $t->hora_inicio." - ".$t->hora_fin;
                    $HorarioClases[$i][$j+1] = "";
                    $HorarioClases[$i][$j+2] = "";
                    $HorarioClases[$i][$j+3] = "";
                    $HorarioClases[$i][$j+4] = "";
                    $HorarioClases[$i][$j+5] = "";
                    $HorarioClases[$i][$j+6] = $t->nombre_mod." Licencia tipo ".$t->nombre_tlic." Paralelo ".$t->nombre_paralelo;
                    $HorarioClases[$i][$j+7] = $t->nombre_mod." Licencia tipo ".$t->nombre_tlic." Paralelo ".$t->nombre_paralelo;
                }
                $i=$i+1;
            }
            //return view('DOCENTE.HORARIODOCENTE.tablahorario')->with($HorarioClases);
            return view('DOCENTE.HORARIODOCENTE.tablahorario')->with('horarioclases',$HorarioClases);
            
        }
        else{
            return redirect("/home");
        }
    }
    

    public function descargar($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="3"))
        {
            $idDoc= DB::table('docente')
            ->select('id_doc')
            ->where('email', auth()->user()->email)
            ->first()
            ->id_doc;
            $idPeriodo= DB::table('periodohorario')
            ->select('id_periodo')
            ->where('id_phorario', $id)
            ->first()
            ->id_periodo;
            $datos=DB::select("select modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,periodoacademico.fechaini,periodoacademico.fechafin,docente.instruccion_doc,docente.apellido_doc,docente.name,docente.cedula_doc from docentemodulo_horario
            inner join horario on horario.id_horario=docentemodulo_horario.id_horario
            inner join docente_modulo on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
            inner join docente on docente_modulo.id_doc=docente.id_doc
            inner join modulo on docente_modulo.id_mod=modulo.id_mod
            inner join cursolicencia on docente_modulo.id_curlic=cursolicencia.id_curlic
            inner join tipolicencia on cursolicencia.id_tlic=tipolicencia.id_tlic
            inner join paralelos on cursolicencia.id_paralelo=paralelos.id_paralelo
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
			inner join periodoacademico on periodoacademico.id=periodohorario.id_periodo
            where docente.id_doc=? and periodohorario.id_phorario=?
            order by horario.hora_inicio",[$idDoc,$id]);

            $horariosTotales=DB::select("select periodohorario.id_phorario,periodohorario.fecha_inicio,periodohorario.fecha_fin,horario.id_horario,horario.tipo_dias,horario.hora_inicio,horario.hora_fin,docente.instruccion_doc,modulo.nombre_mod,tipolicencia.nombre_tlic,paralelos.nombre_paralelo from docentemodulo_horario
            inner join horario on horario.id_horario=docentemodulo_horario.id_horario
            inner join docente_modulo on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
            inner join docente on docente_modulo.id_doc=docente.id_doc
            inner join modulo on docente_modulo.id_mod=modulo.id_mod
            inner join cursolicencia on docente_modulo.id_curlic=cursolicencia.id_curlic
            inner join tipolicencia on cursolicencia.id_tlic=tipolicencia.id_tlic
            inner join paralelos on cursolicencia.id_paralelo=paralelos.id_paralelo
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            where docente.id_doc=? and periodohorario.id_periodo=?
            order by periodohorario.fecha_inicio,periodohorario.fecha_fin,periodohorario.id_phorario,horario.hora_inicio",[$idDoc,$idPeriodo]);
           
                $datosT = ['datos'=>$datos,'horariosTotales' => $horariosTotales];
                $view= \View::make('DOCENTE.HORARIODOCENTE.descargarHorario',$datosT);
                $pdf=\App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4', 'landscape');
              
                return $pdf->stream('HorarioClases'.'.pdf');         
        }
        else{
            return redirect("/home");
        }
    }
    public function horarioEstudiante(Request $request)
    {
       
            if ((auth()->check()) && (auth()->user()->rol=="2"))
            {
               
               $periodosa=  DB::table('matricula')
               ->join('periodoacademico','matricula.id_periodo', '=', 'periodoacademico.id')
               ->join('estudiante','estudiante.id_est', '=', 'matricula.id_est')
               ->select('*')
               ->where('estudiante.email_est', auth()->user()->email)
               ->orderBy('fechaini', 'desc')
               ->get();
               return view('ESTUDIANTE.HORARIOESTUDIANTE.indexHorarioEstudiante')->with('periodosa',$periodosa);
               //return response()->json($periodosacademicos);
               
            }
            else{
                return redirect("/home");
            }
            
            
    }
    public function cargarPerHorariosEst($id)
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
            $periodoshor=DB::select("
            select distinct periodohorario.id_phorario,periodohorario.fecha_inicio,periodohorario.fecha_fin,periodohorario.id_periodo,periodoacademico.nombre_tipolicencia from docentemodulo_horario
                        inner join docente_modulo on docente_modulo.id_doc_mod = docentemodulo_horario.id_doc_mod
                        inner join docente on docente_modulo.id_doc = docente.id_doc
                        inner join horario on docentemodulo_horario.id_horario = horario.id_horario
                        inner join modulo on docente_modulo.id_mod=modulo.id_mod
                        inner join cursolicencia on docente_modulo.id_curlic = cursolicencia.id_curlic
                        inner join tipolicencia on tipolicencia.id_tlic = cursolicencia.id_tlic
                        inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
                        inner join periodohorario on periodohorario.id_phorario=docentemodulo_horario.id_phorario
                        inner join periodoacademico on periodohorario.id_periodo=periodoacademico.id
                        where periodoacademico.id=? and cursolicencia.id_curlic=?
                        order by periodohorario.fecha_inicio",[$id,$curso]);
            return response()->json($periodoshor);
            
        }
        else{
            return redirect("/home");
        }
    }
    public function cargartablahorarioEst($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
            $idPeriodo= DB::table('periodohorario')
                ->select('id_periodo')
                ->where('id_phorario', $id)
                ->first()
                ->id_periodo;
           
            $idEst= DB::table('estudiante')
                ->select('id_est')
                ->where('email_est', auth()->user()->email)
                ->first()
                ->id_est;
            $curso= DB::table('matricula')
                ->select('id_curlic')
                ->where('id_periodo',$idPeriodo)
                ->where('id_est',$idEst)
                ->first()
                ->id_curlic;
            $horarios=DB::select("select horario.id_horario,horario.tipo_dias,horario.hora_inicio,horario.hora_fin,docente.instruccion_doc,docente.name,docente.apellido_doc,modulo.nombre_mod,tipolicencia.nombre_tlic,paralelos.nombre_paralelo from docentemodulo_horario
            inner join horario on horario.id_horario=docentemodulo_horario.id_horario
            inner join docente_modulo on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
            inner join docente on docente_modulo.id_doc=docente.id_doc
            inner join modulo on docente_modulo.id_mod=modulo.id_mod
            inner join cursolicencia on docente_modulo.id_curlic=cursolicencia.id_curlic
            inner join tipolicencia on cursolicencia.id_tlic=tipolicencia.id_tlic
            inner join paralelos on cursolicencia.id_paralelo=paralelos.id_paralelo
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            where cursolicencia.id_curlic=? and periodohorario.id_phorario=?
            order by horario.hora_inicio",[$curso,$id]);
            $i=0;
            $j=0;
            $HorarioClases[0][0] = "";
            foreach($horarios as $t)
            {
                if($t->tipo_dias=="Lun-Vie")
                {
                    $HorarioClases[$i][$j] = $t->hora_inicio." - ".$t->hora_fin;
                    $HorarioClases[$i][$j+1] = $t->nombre_mod." / ".$t->instruccion_doc.". ".$t->name." ".$t->apellido_doc." / Paralelo ".$t->nombre_paralelo;
                    $HorarioClases[$i][$j+2] = $t->nombre_mod." / ".$t->instruccion_doc.". ".$t->name." ".$t->apellido_doc." / Paralelo ".$t->nombre_paralelo;
                    $HorarioClases[$i][$j+3] = $t->nombre_mod." / ".$t->instruccion_doc.". ".$t->name." ".$t->apellido_doc." / Paralelo ".$t->nombre_paralelo;
                    $HorarioClases[$i][$j+4] = $t->nombre_mod." / ".$t->instruccion_doc.". ".$t->name." ".$t->apellido_doc." / Paralelo ".$t->nombre_paralelo;
                    $HorarioClases[$i][$j+5] = $t->nombre_mod." / ".$t->instruccion_doc.". ".$t->name." ".$t->apellido_doc." / Paralelo ".$t->nombre_paralelo;
                    $HorarioClases[$i][$j+6] = "";
                    $HorarioClases[$i][$j+7] = "";
                }
               
                if($t->tipo_dias=="Sab-Dom")
                {
                    $HorarioClases[$i][$j] = $t->hora_inicio." - ".$t->hora_fin;
                    $HorarioClases[$i][$j+1] = "";
                    $HorarioClases[$i][$j+2] = "";
                    $HorarioClases[$i][$j+3] = "";
                    $HorarioClases[$i][$j+4] = "";
                    $HorarioClases[$i][$j+5] = "";
                    $HorarioClases[$i][$j+6] = $t->nombre_mod." / ".$t->instruccion_doc.". ".$t->name." ".$t->apellido_doc." / Paralelo ".$t->nombre_paralelo;
                    $HorarioClases[$i][$j+7] = $t->nombre_mod." / ".$t->instruccion_doc.". ".$t->name." ".$t->apellido_doc." / Paralelo ".$t->nombre_paralelo;
                }
                $i=$i+1;
            }
            //return view('DOCENTE.HORARIODOCENTE.tablahorario')->with($HorarioClases);
            return view('ESTUDIANTE.HORARIOESTUDIANTE.tablahorario')->with('horarioclases',$HorarioClases);
            
            
        }
        else{
            return redirect("/home");
        }
    }
    public function descargarHorarioEstudiante($id)
    {
        if ((auth()->check()) && (auth()->user()->rol=="2"))
        {
            $idPeriodo= DB::table('periodohorario')
            ->select('id_periodo')
            ->where('id_phorario', $id)
            ->first()
            ->id_periodo;
       
            $idEst= DB::table('estudiante')
                ->select('id_est')
                ->where('email_est', auth()->user()->email)
                ->first()
                ->id_est;
            $curso= DB::table('matricula')
                ->select('id_curlic')
                ->where('id_periodo',$idPeriodo)
                ->where('id_est',$idEst)
                ->first()
                ->id_curlic;
            $horariosTotales=DB::select("select periodohorario.id_phorario,periodohorario.fecha_inicio,periodohorario.fecha_fin, horario.id_horario,horario.tipo_dias,horario.hora_inicio,horario.hora_fin,docente.instruccion_doc,docente.name,docente.apellido_doc,modulo.nombre_mod,tipolicencia.nombre_tlic,paralelos.nombre_paralelo from docentemodulo_horario
            inner join horario on horario.id_horario=docentemodulo_horario.id_horario
            inner join docente_modulo on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
            inner join docente on docente_modulo.id_doc=docente.id_doc
            inner join modulo on docente_modulo.id_mod=modulo.id_mod
            inner join cursolicencia on docente_modulo.id_curlic=cursolicencia.id_curlic
            inner join tipolicencia on cursolicencia.id_tlic=tipolicencia.id_tlic
            inner join paralelos on cursolicencia.id_paralelo=paralelos.id_paralelo
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            where cursolicencia.id_curlic=? and periodohorario.id_periodo=?
            order by periodohorario.fecha_inicio,periodohorario.fecha_fin,periodohorario.id_phorario,horario.hora_inicio",[$curso,$idPeriodo]);
           
            $datos=DB::select("select * from matricula
            inner join cursolicencia on matricula.id_curlic=cursolicencia.id_curlic
            inner join paralelos on paralelos.id_paralelo =cursolicencia.id_paralelo
            inner join estudiante on estudiante.id_est=matricula.id_est
            inner join periodoacademico on periodoacademico.id= matricula.id_periodo
            where estudiante.id_est=? and cursolicencia.id_curlic=? and periodoacademico.id=?",[$idEst,$curso,$idPeriodo]);
                $datosT = ['datos'=>$datos,'horariosTotales' => $horariosTotales];
                $view= \View::make('ESTUDIANTE.HORARIOESTUDIANTE.descargarHorario',$datosT);
                $pdf=\App::make('dompdf.wrapper');
                $pdf->loadHTML($view)->setPaper('a4', 'landscape');    
                return $pdf->stream('HorarioClases'.'.pdf');      
        }
        else{
            return redirect("/home");
        }
    }
    
    

}
