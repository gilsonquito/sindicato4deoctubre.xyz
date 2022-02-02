<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class Webgrafia extends Model
{
    use HasFactory, Notifiable;

    protected $table='webgrafia';

    protected $fillable = [
        'descripcion_webgrafia',
        'id_sil',
    ];

    public $timestamps=false; 
}
