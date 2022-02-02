<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AvanceAcademico extends Model
{
    use HasFactory, Notifiable;

    protected $table='avanceacademico';

    protected $fillable = [
        'fecha_avance',
        'hora_avance',
        'responsable_avance',
        'id_sil',
    ];
    public $timestamps=false; 
}
