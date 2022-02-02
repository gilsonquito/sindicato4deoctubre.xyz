<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class EvaluacionUnidad extends Model
{
    use HasFactory, Notifiable;

    protected $table='evaluacion_unidad';

    protected $fillable = [
        'tipo_evaluacion',
        'detalle_evaluacion',
        'id_unidad',
    ];

    public $timestamps=false; 
}
