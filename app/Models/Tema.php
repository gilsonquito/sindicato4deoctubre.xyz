<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory, Notifiable;

    protected $table='temas';

    protected $fillable = [
        'tipo_clase',
        'orden_tema',
        'titulo_tema',
        'actividadesdocencia_tema',
        'actdocpracapliexp_tema',
        'actaprauto_tema',
        'horasdocencia_tema',
        'horasapreexp_tema',
        'horastraaut_tema',
        'semana_tema',
        'id_unidad',
    ];

    public $timestamps=false; 
}
