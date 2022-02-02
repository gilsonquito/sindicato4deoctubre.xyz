<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class PeriodoAcademico extends Model
{
    use HasFactory, Notifiable;

    protected $table='periodoacademico';

    protected $fillable = [
        'fechaini',
        'fechafin'
       
    ];

    public $timestamps=false; 
}
