<?php

namespace App\Models;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory, Notifiable;

    protected $table='evaluacion_docente';

    protected $fillable = [
        'id_doc_mod',
        'id_periodo',
        'fecha_ini_evaluacion',
        'fecha_fin_evaluacion',
        'link_evaluacion',
        'estado',
    ];

    public $timestamps=false; 
}
