<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class Subtema extends Model
{
    use HasFactory, Notifiable;

    protected $table='subtemas';

    protected $fillable = [
        'orden_subtema',
        'titulo_subtema',
        'id_tema',
    ];

    public $timestamps=false; 
}
