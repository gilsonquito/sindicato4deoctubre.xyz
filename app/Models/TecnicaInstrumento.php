<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TecnicaInstrumento extends Model
{
    use HasFactory, Notifiable;

    protected $table='tecnicas_unidad';

    protected $fillable = [
        'tecnica',
        'instrumento',
        'id_unidad',
    ];

    public $timestamps=false; 
}
