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
use App\Exports\InvoicesExport ;          
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use DateTime;
Use \Carbon\Carbon;
use PDF;

class InvoicesExport implements FromView
{
    public function __construct($id,$estudiante)
    {
        $this->id = $id;
        $this->estudiante = $estudiante;
    }
    public function view(): View
    {
        $estudiantes=DB::select("select asistenciaestudiante.id_doc_mod,asistenciaestudiante.id_asistencia,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,estudiante.email_est,asistenciaestudiante.estado_asistencia,asistenciaestudiante.id_doc_mod,matricula.id_matricula,matricula.id_curlic,periodoacademico.id,asistenciaestudiante.fecha_asistencia from matricula
        inner join asistenciaestudiante on asistenciaestudiante.id_matricula=matricula.id_matricula
       inner join estudiante on estudiante.id_est = matricula.id_est
       inner join periodoacademico on periodoacademico.id=matricula.id_periodo
       where periodoacademico.id=? and estudiante.email_est='quitogilsoneduardo@hotmail.com'
       order by asistenciaestudiante.id_doc_mod,asistenciaestudiante.fecha_asistencia desc",[$this->id]);
        return view('/SECRETARIA/REPORTES/reporteAsistencia', [
            'invoices' => $estudiantes
        ]);
    }
}