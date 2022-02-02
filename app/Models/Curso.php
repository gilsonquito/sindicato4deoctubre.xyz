<?php

namespace App\Models;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory, Notifiable;

    protected $table='cursolicencia';

    protected $fillable = [
        'id_tlic',
        'jornada',
        'modalidad',
        'duracion_meses',
        'id_paralelo',
    ];

    public $timestamps=false; 
}
