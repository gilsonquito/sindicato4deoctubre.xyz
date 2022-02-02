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


class ActasExport implements Fromview//, ShouldAutoSize, WithEvents
{
    public function __construct($id)
    {
        $this->id = $id;
        // Set background color for a specific cell
    }
    public function view(): View
    {
        $estudiantes=DB::select("select cursolicencia.id_curlic,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas_grado.nota_ley_reglamento from matricula as mat1
                    inner join notas_grado on mat1.id_matricula = notas_grado.id_matricula
                    where mat1.id_matricula=m.id_matricula)as nota_ley_reglamento,(select notas_grado.nota_educacion_vial from matricula as mat2
                    inner join notas_grado on mat2.id_matricula = notas_grado.id_matricula
                    where mat2.id_matricula=m.id_matricula)as nota_educacion_vial,(select notas_grado.nota_mecanica_basica from matricula as mat3
                    inner join notas_grado on mat3.id_matricula = notas_grado.id_matricula
                    where mat3.id_matricula=m.id_matricula)as nota_mecanica_basica,(select notas_grado.nota_grado_practico from matricula as mat4
                    inner join notas_grado on mat4.id_matricula = notas_grado.id_matricula
                    where mat4.id_matricula=m.id_matricula)as nota_grado_practico,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia from matricula as m
            inner join estudiante on estudiante.id_est = m.id_est
            inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
            inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join periodoacademico on periodoacademico.id=m.id_periodo
            where m.id_periodo=?
            order by m.id_curlic, estudiante.apellido_est,estudiante.name_est,estudiante.id_est",[$this->id]);
            $cursosLista=DB::select("select cursolicencia.id_curlic,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas_grado.nota_ley_reglamento from matricula as mat1
                    inner join notas_grado on mat1.id_matricula = notas_grado.id_matricula
                    where mat1.id_matricula=m.id_matricula)as nota_ley_reglamento,(select notas_grado.nota_educacion_vial from matricula as mat2
                    inner join notas_grado on mat2.id_matricula = notas_grado.id_matricula
                    where mat2.id_matricula=m.id_matricula)as nota_educacion_vial,(select notas_grado.nota_mecanica_basica from matricula as mat3
                    inner join notas_grado on mat3.id_matricula = notas_grado.id_matricula
                    where mat3.id_matricula=m.id_matricula)as nota_mecanica_basica,(select notas_grado.nota_grado_practico from matricula as mat4
                    inner join notas_grado on mat4.id_matricula = notas_grado.id_matricula
                    where mat4.id_matricula=m.id_matricula)as nota_grado_practico,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia,periodoacademico.fechaini,periodoacademico.fechafin,cursolicencia.jornada,cursolicencia.modalidad from matricula as m
            inner join estudiante on estudiante.id_est = m.id_est
            inner join cursolicencia on m.id_curlic = cursolicencia.id_curlic
            inner join paralelos on paralelos.id_paralelo = cursolicencia.id_paralelo
            inner join periodoacademico on periodoacademico.id=m.id_periodo
            where m.id_periodo=?
            order by m.id_curlic, estudiante.apellido_est,estudiante.name_est,estudiante.id_est",[$this->id]);
            $estudiantesNotas=DB::select("select cursolicencia.id_curlic,docente_modulo.id_doc_mod,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas.nota_trabajo_equipo from matricula as mat1
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
                    where dm5.id_doc_mod=docente_modulo.id_doc_mod and mat5.id_matricula=m.id_matricula)as nota_suspenso,modulo.id_mod,modulo.nombre_mod,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia from matricula as m
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
            $estudiantesListaNotas=DB::select("select cursolicencia.id_curlic,docente_modulo.id_doc_mod,estudiante.id_est,estudiante.apellido_est,estudiante.name_est,m.id_matricula,periodoacademico.id,(select notas.nota_trabajo_equipo from matricula as mat1
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
                        where dm5.id_doc_mod=docente_modulo.id_doc_mod and mat5.id_matricula=m.id_matricula)as nota_suspenso,modulo.id_mod,modulo.nombre_mod,paralelos.nombre_paralelo,periodoacademico.nombre_tipolicencia from matricula as m
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
            return view('SECRETARIA.REPORTES.excelActasCalificaciones', [
            'estudiantes' => $estudiantes,
            'cursosLista' => $cursosLista,
            'estudiantesNotas' => $estudiantesNotas,
            'estudiantesListaNotas' => $estudiantesListaNotas
        ]);
    }
}