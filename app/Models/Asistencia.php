<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Asistencia extends Model
{
    use HasFactory, Notifiable;

    protected $table='asistenciaestudiante';

    protected $fillable = [
        'estado_asistencia',
        'fecha_asistencia',
        'id_doc_mod',
        'id_matricula',
    ];
    public $timestamps=false; 
}
