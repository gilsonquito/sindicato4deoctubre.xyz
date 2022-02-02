<?php

namespace App\Models;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory, Notifiable;

    protected $table='docente';

    protected $fillable = [
        'cedula_doc',
        'name',
        'apellido_doc',
        'lugarnacimiento_doc',
        'fechanacimiento_doc',
        'direccion_doc',
        'celular_doc',
        'email',
        'etnia_doc',
        'sexo_doc',
        'instruccion_doc',
        
       
    ];

    public $timestamps=false; 
}
