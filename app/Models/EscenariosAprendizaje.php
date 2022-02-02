<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class EscenariosAprendizaje extends Model
{
    use HasFactory, Notifiable;

    protected $table='escenarios_aprendizaje';

    protected $fillable = [
        'descripcion_escenario',
        'id_sil',
    ];

    public $timestamps=false; 
}
