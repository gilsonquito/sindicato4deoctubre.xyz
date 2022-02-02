<?php
namespace App\Exports;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;//procedimientos bd
use Illuminate\Support\Collection;
use DataTables;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use DateTime;
Use \Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; 
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class AsistenciasExport implements Fromview//, ShouldAutoSize, WithEvents
{

    public function __construct($id)
    {
        $this->idP = $id;
        // Set background color for a specific cell

    }
    public function view(): View
    {
            $datos=DB::select("select distinct cursolicencia.id_curlic,tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,periodoacademico.fechaini,periodoacademico.fechafin from docente_modulo
            inner join docente on docente_modulo.id_doc=docente.id_doc
            inner join modulo on modulo.id_mod=docente_modulo.id_mod
            inner join cursolicencia on cursolicencia.id_curlic=docente_modulo.id_curlic
            inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
            inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
            inner join docentemodulo_horario on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            inner join periodoacademico on periodohorario.id_periodo=periodoacademico.id
            where periodohorario.id_periodo=?
            order by cursolicencia.id_curlic",[$this->idP]);
        
            $estudiantes=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia,modulo.id_mod,modulo.nombre_mod  from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
            inner join estudiante on estudiante.id_est = matricula.id_est
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            inner join cursolicencia on cursolicencia.id_curlic=matricula.id_curlic
            inner join docente_modulo on docente_modulo.id_doc_mod=asistenciaestudiante.id_doc_mod
            inner join modulo on docente_modulo.id_mod=modulo.id_mod
            where  matricula.id_periodo=?
            order by matricula.id_curlic,modulo.nombre_mod",[$this->idP]);
            $modulos=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia,modulo.id_mod,modulo.nombre_mod  from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
            inner join estudiante on estudiante.id_est = matricula.id_est
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            inner join cursolicencia on cursolicencia.id_curlic=matricula.id_curlic
            inner join docente_modulo on docente_modulo.id_doc_mod=asistenciaestudiante.id_doc_mod
            inner join modulo on docente_modulo.id_mod=modulo.id_mod
            where  matricula.id_periodo=?
            order by matricula.id_curlic,modulo.nombre_mod",[$this->idP]);
            $estudaintesOrders=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia,modulo.id_mod,modulo.nombre_mod  from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
            inner join estudiante on estudiante.id_est = matricula.id_est
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            inner join cursolicencia on cursolicencia.id_curlic=matricula.id_curlic
            inner join docente_modulo on docente_modulo.id_doc_mod=asistenciaestudiante.id_doc_mod
            inner join modulo on docente_modulo.id_mod=modulo.id_mod
            where matricula.id_periodo=?
            order by estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.id_doc_mod",[$this->idP]);
            return view('SECRETARIA.REPORTES.excelAsistencias', [
            'datos' => $datos, 
            'modulos' => $modulos,
            'estudiantes' => $estudiantes,
            'estudaintesOrders' => $estudaintesOrders

        ]);
        // Set background color for a specific cell

    }
   
 
}