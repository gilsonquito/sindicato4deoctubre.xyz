<?php

namespace App\Models;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\database\Eloquent\Model;

class DocenteModuloHorario extends Model
{
    use HasFactory, Notifiable;

    protected $table='docentemodulo_horario';

    protected $fillable = [
        'id_doc_mod',
        'id_horario',
        'id_phorario',
    ];

    public $timestamps=false; 
}
