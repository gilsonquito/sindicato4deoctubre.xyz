<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class BibliografiaDigital extends Model
{
    use HasFactory, Notifiable;

    protected $table='bibliografia_digital';

    protected $fillable = [
        'descripcion_bdigital',
        'id_sil',
    ];

    public $timestamps=false; 
}
