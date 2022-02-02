<?php

namespace App\Models;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\database\Eloquent\Model;

class DocenteModulo extends Model
{
    use HasFactory, Notifiable;

    protected $table='docente_modulo';

    protected $fillable = [
        'id_mod',
        'id_doc',
        'id_curlic',
    ];

    public $timestamps=false; 
}
