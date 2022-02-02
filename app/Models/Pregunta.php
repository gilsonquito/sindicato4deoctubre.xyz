<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory, Notifiable;

    protected $table='pregunta';

    protected $fillable = [
        'pregunta',
        'aspecto_evaluar',
        'id_evaluacion',
       
    ];

    public $timestamps=false; 
}
