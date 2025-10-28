<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarUsuarioRequest;
use App\Http\Requests\CambiarPasswordRequest;
use App\Http\Requests\RegistrarUsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;

//PARA CAMBIAR CONTRASENA
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
    public function registrarUsuario(RegistrarUsuarioRequest $request)
    {
        $encryptPassword = $request->encryptPassword();
        Usuario::create($encryptPassword);

        return response()->json([
            "success" => true,
            "message" => "Usuario registrado correctamente",
        ]);
    } //

    public function listarTodosLosUsuarios()
    {
        // Obtener todos los clientes, ordenados por 'created_at' de forma descendente
        $usuarios = Usuario::all();

        return $usuarios;
    }

    public function actualizarUsuario(ActualizarUsuarioRequest $request, Usuario $id_usuario)
    {
        $id_usuario->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Usuario actualizado",
        ]);
    }

    // public function cambiarPasswordUsuario(CambiarPasswordRequest $request)
    // {
    //     $usuario = Usuario::where('correo', $request->correo)->first();
    //     $usuario->contrasena = Hash::make($request->contrasena);
    //     $usuario->save();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Contraseña actualizada correctamente.',
    //     ], 200);
    // }
}
