<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class TipoLicencia extends Model
{
    use HasFactory, Notifiable;

    protected $table='tipoLicencia';

    protected $fillable = [
        'nombre_tlic'
    ];

    public $timestamps=false; 
}