<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory, Notifiable;

    protected $table='horario';

    protected $fillable = [
        'tipo_dias',
        'hora_inicio',
        'hora_fin',
       
    ];

    public $timestamps=false; 
}
