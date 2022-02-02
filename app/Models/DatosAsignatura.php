<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DatosAsignatura extends Model
{
    use HasFactory, Notifiable;

    protected $table='datos_asignatura';

    protected $fillable = [
        'descripcion_asignatura',
        'competencia_asignatura',
        'resultado_asignatura',
        'id_sil',
    ];

    public $timestamps=false; 
}
