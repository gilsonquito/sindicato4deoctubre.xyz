<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory, Notifiable;

    protected $table='unidades';

    protected $fillable = [
        'orden_unidad',
        'titulo_unidad',
        'horas_unidad',
        'criterioevaluacion_unidad',
        'id_unidad',
    ];

    public $timestamps=false; 
}
