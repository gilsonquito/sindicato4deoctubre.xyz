<?php

namespace App\Models;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory, Notifiable;

    protected $table='estudiante';

    protected $fillable = [
        'cedula_est',
        'name_est',
        'apellido_est',
        'lugarnacimiento_est',
        'fechanacimiento_est',
        'direccion_est',
        'celular_est',
        'email_est',
        'etnia_est',
        'sexo_est', 
    ];

    public $timestamps=false; 
}
