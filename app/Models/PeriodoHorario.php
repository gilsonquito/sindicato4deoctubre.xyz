<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class PeriodoHorario extends Model
{
    use HasFactory, Notifiable;

    protected $table='periodohorario';

    protected $fillable = [
        'fechaini',
        'fechafin',
        'id_periodo',
       
    ];

    public $timestamps=false; 
}
