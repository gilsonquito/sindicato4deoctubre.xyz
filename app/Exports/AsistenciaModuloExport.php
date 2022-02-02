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
use App\Models\User;    
      
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use DateTime;
Use \Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; 
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class AsistenciaModuloExport implements Fromview//, ShouldAutoSize, WithEvents
{

    public function __construct($id,$id_doc)
    {
        $this->idP = $id;
        $this->idDocMod = $id_doc;
        // Set background color for a specific cell

    }
    public function view(): View
    {
            $datos=DB::select("select modulo.nombre_mod, modulo.duracion_horas, tipolicencia.nombre_tlic, cursolicencia.jornada, cursolicencia.modalidad, paralelos.nombre_paralelo,docente.instruccion_doc,docente.apellido_doc,docente.name,docente.cedula_doc from docente_modulo
            inner join docente on docente_modulo.id_doc=docente.id_doc
            inner join modulo on modulo.id_mod=docente_modulo.id_mod
            inner join cursolicencia on cursolicencia.id_curlic=docente_modulo.id_curlic
            inner join tipolicencia on tipolicencia.id_tlic=cursolicencia.id_tlic
            inner join paralelos on paralelos.id_paralelo=cursolicencia.id_paralelo
            where docente_modulo.id_doc_mod=?",[$this->idDocMod]);
            $periodos=DB::select("select * from periodoacademico where id=?",[$this->idP]);
            $fechas=DB::select("select distinct asistenciaestudiante.fecha_asistencia,estudiante.id_est from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
            inner join estudiante on estudiante.id_est = matricula.id_est
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? 
            order by asistenciaestudiante.fecha_asistencia",[$this->idDocMod,$this->idP]);
            $estudiantes=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia  from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
            inner join estudiante on estudiante.id_est = matricula.id_est
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? 
            order by estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.fecha_asistencia",[$this->idDocMod,$this->idP]);
            $estudiantesOrders=DB::select("select asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia  from matricula
            inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
            inner join estudiante on estudiante.id_est = matricula.id_est
            inner join periodoacademico on periodoacademico.id=matricula.id_periodo
            where asistenciaestudiante.id_doc_mod=? and periodoacademico.id=? 
            order by estudiante.apellido_est,estudiante.name_est,asistenciaestudiante.fecha_asistencia",[$this->idDocMod,$this->idP]);
            return view('SECRETARIA.REPORTES.excelAsistenciasModulo', [
            'datos' => $datos, 
            'periodos' => $periodos,
            'fechas' => $fechas,
            'estudiantes' => $estudiantes,
            'estudiantesOrders' => $estudiantesOrders

        ]);
        // Set background color for a specific cell

    }
   
 
}