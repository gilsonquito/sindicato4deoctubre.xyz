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

    protected $table='avanceacademico_subtemas';

    protected $fillable = [
        'id_subtema',
        'id_avance',
    ];
    public $timestamps=false; 
}
