<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DetalleAvance extends Model
{
    use HasFactory, Notifiable;

    protected $table='detalle_avanceacademico';

    protected $fillable = [
        'metodologias_avance',
        'recursos_avance',
        'actividades_avance',
        'evidencias_avance',
        'motivo_inasistencia_avance',
        'observacion_avance',
        'id_avance',
    ];
    public $timestamps=false; 
}
