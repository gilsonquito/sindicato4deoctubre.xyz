<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class Metodos extends Model
{
    use HasFactory, Notifiable;

    protected $table='metodos_enseñanza';

    protected $fillable = [
        'descripcion_metodo',
        'id_sil',
    ];

    public $timestamps=false; 
}
