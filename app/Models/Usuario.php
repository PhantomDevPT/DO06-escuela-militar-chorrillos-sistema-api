<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = "usuarios";

    protected $primaryKey = "id_usuario";

    protected $fillable = [
        "id_usuario",
        "Nombres",
        "Apellidos",
        "Rol", // admin o estudiante
        "Correo",
        "Contrasena",
        "created_at",
        "updated_at",
    ];

    protected $hidden = [];
}
