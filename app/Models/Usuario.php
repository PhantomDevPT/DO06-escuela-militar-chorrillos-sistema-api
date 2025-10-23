<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    protected $table = "Usuarios";
    
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
    
    // public function TableName()
    // {
    //     return $this->belongsTo(TableName::class, 'id_relacionado', 'id_relacionado');
    // }
}
