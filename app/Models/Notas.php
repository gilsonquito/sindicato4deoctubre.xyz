<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class Notas extends Model
{
    use HasFactory, Notifiable;

    protected $table='notas';

    protected $fillable = [
        'nota_trabajo_equipo',
        'nota_estudio_caso',
        'nota_prueba_practica',
        'nota_prueba_teorica',
        'nota_suspenso',
        'id_doc_mod',
        'id_matricula', 
    ];

    public $timestamps=false; 
}
