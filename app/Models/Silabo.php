<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Silabo extends Model
{
    use HasFactory, Notifiable;

    protected $table='silabo';

    protected $fillable = [
        'archivo',
        'id_doc_mod',
        'id_periodo',
    ];

    public $timestamps=false; 
}
