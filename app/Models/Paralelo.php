<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class Paralelo extends Model
{
    use HasFactory, Notifiable;

    protected $table='paralelos';

    protected $fillable = [
        'nombre_paralelo'
    ];

    public $timestamps=false; 
}
