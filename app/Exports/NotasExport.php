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
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; 
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class NotasExport implements Fromview//, ShouldAutoSize, WithEvents
{

    public function __construct($id)
    {
        $this->id = $id;
        // Set background color for a specific cell

    }
    public function view(): View
    {
        $estudiantes=DB::select("select cursolicencia.id_curlic,docente_modulo.id_doc_mod,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas.nota_trabajo_equipo from matricula as mat1
                    inner join notas on mat1.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm1 on dm1.id_doc_mod = notas.id_doc_mod
                    where dm1.id_doc_mod=docente_modulo.id_doc_mod and mat1.id_matricula=m.id_matricula)as nota_trabajo_equipo,(select notas.nota_estudio_caso from matricula as mat2
                    inner join notas on mat2.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm2 on dm2.id_doc_mod = notas.id_doc_mod
                    where dm2.id_doc_mod=docente_modulo.id_doc_mod and mat2.id_matricula=m.id_matricula)as nota_estudio_caso,(select notas.nota_prueba_practica from matricula as mat3
                    inner join notas on mat3.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm3 on dm3.id_doc_mod = notas.id_doc_mod
                    where dm3.id_doc_mod=docente_modulo.id_doc_mod and mat3.id_matricula=m.id_matricula)as nota_prueba_practica,(select notas.nota_prueba_teorica from matricula as mat4
                    inner join notas on mat4.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm4 on dm4.id_doc_mod = notas.id_doc_mod
                    where dm4.id_doc_mod=docente_modulo.id_doc_mod and mat4.id_matricula=m.id_matricula)as nota_prueba_teorica,(select notas.nota_suspenso from matricula as mat5
                    inner join notas on mat5.id_matricula = notas.id_matricula
                    inner join docente_modulo as dm5 on dm5.id_doc_mod = notas.id_doc_mod
                    where dm5.id_doc_mod=docente_modulo.id_doc_mod and mat5.id_matricula=m.id_matricula)as nota_suspenso,modulo.id_mod,modulo.nombre_mod,paralelos.nombre_paralelo,periodoacademico.fechaini,periodoacademico.fechafin,periodoacademico.nombre_tipolicencia,cursolicencia.jornada,cursolicencia.modalidad from matricula as m
            inner join estudiante on estudiante.id_est = m.id_est
            inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
            inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
            inner join modulo on modulo.id_mod = docente_modulo.id_mod
            inner join periodoacademico on periodoacademico.id=m.id_periodo
            inner join docentemodulo_horario on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
            inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
            where periodohorario.id_periodo=?
            order by m.id_curlic,docente_modulo.id_doc_mod, estudiante.apellido_est,estudiante.name_est,modulo.nombre_mod",[$this->id]);
            $estudiantesLista=DB::select("select cursolicencia.id_curlic,docente_modulo.id_doc_mod,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas.nota_trabajo_equipo from matricula as mat1
                        inner join notas on mat1.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm1 on dm1.id_doc_mod = notas.id_doc_mod
                        where dm1.id_doc_mod=docente_modulo.id_doc_mod and mat1.id_matricula=m.id_matricula)as nota_trabajo_equipo,(select notas.nota_estudio_caso from matricula as mat2
                        inner join notas on mat2.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm2 on dm2.id_doc_mod = notas.id_doc_mod
                        where dm2.id_doc_mod=docente_modulo.id_doc_mod and mat2.id_matricula=m.id_matricula)as nota_estudio_caso,(select notas.nota_prueba_practica from matricula as mat3
                        inner join notas on mat3.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm3 on dm3.id_doc_mod = notas.id_doc_mod
                        where dm3.id_doc_mod=docente_modulo.id_doc_mod and mat3.id_matricula=m.id_matricula)as nota_prueba_practica,(select notas.nota_prueba_teorica from matricula as mat4
                        inner join notas on mat4.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm4 on dm4.id_doc_mod = notas.id_doc_mod
                        where dm4.id_doc_mod=docente_modulo.id_doc_mod and mat4.id_matricula=m.id_matricula)as nota_prueba_teorica,(select notas.nota_suspenso from matricula as mat5
                        inner join notas on mat5.id_matricula = notas.id_matricula
                        inner join docente_modulo as dm5 on dm5.id_doc_mod = notas.id_doc_mod
                        where dm5.id_doc_mod=docente_modulo.id_doc_mod and mat5.id_matricula=m.id_matricula)as nota_suspenso,modulo.id_mod,modulo.nombre_mod,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia,periodoacademico.nombre_tipolicencia,periodoacademico.fechaini,periodoacademico.fechafin,periodoacademico.nombre_tipolicencia,cursolicencia.jornada,cursolicencia.modalidad from matricula as m
                inner join estudiante on estudiante.id_est = m.id_est
                inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
                inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
                inner join docente_modulo on cursolicencia.id_curlic = docente_modulo.id_curlic
                inner join modulo on modulo.id_mod = docente_modulo.id_mod
                inner join periodoacademico on periodoacademico.id=m.id_periodo
                inner join docentemodulo_horario on docente_modulo.id_doc_mod=docentemodulo_horario.id_doc_mod
                inner join periodohorario on docentemodulo_horario.id_phorario=periodohorario.id_phorario
                where periodohorario.id_periodo=? and m.id_periodo=?
                order by estudiante.apellido_est,estudiante.name_est,estudiante.id_est",[$this->id,$this->id]);
            $datosT = ['estudiantes' => $estudiantes, 'estudiantesLista' => $estudiantesLista];
            return view('SECRETARIA.REPORTES.excelNotas', [
            'estudiantes' => $estudiantes,
            'estudiantesLista' => $estudiantesLista

        ]);
        // Set background color for a specific cell

    }
}