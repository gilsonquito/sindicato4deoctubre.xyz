<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\database\Eloquent\Model;

class Bibliografia extends Model
{
    use HasFactory, Notifiable;

    protected $table='bibliografia_silabo';

    protected $fillable = [
        'tipo_bibliografia',
        'titulo_bibliografia',
        'autor_bibliografia',
        'tipo_documento_bibliografia',
        'editorial_bibliografia',
        'fecha_publicacion_bibliografia',
        'numero_pagina_bibliografia',
        'id_sil',
    ];

    public $timestamps=false; 
}
