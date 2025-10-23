<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarUsuarioRequest;
use App\Http\Requests\CambiarPasswordRequest;
use App\Http\Requests\RegistrarUsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //
    public function registrarUsuario(RegistrarUsuarioRequest $request)
    {
        Usuario::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Usuario registrado",
        ]);
    }

    public function listarUsuarios(Request $request)
    {
        $perPage = $request->get('perPage', 5); // cantidad por página
        $usuarios = Usuario::paginate($perPage);

        return response()->json([
            "success" => true,
            "data" => $usuarios,
        ]);
    }


    public function actualizarUsuario(ActualizarUsuarioRequest $request, Usuario $id_usuario)
    {
        $id_usuario->update($request->all());

        return response()->json([
            "success" => true,
            "message" => "Usuario actualizado",
        ]);
    }

    /**
     * Cambiar contraseña de usuario
     */
    public function cambiarPasswordUsuario(CambiarPasswordRequest $request)
    {
        $usuario = Usuario::where('Correo', $request->Correo)->first();

        if (!$usuario) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        $usuario->Contrasena = Hash::make($request->Contrasena);
        $usuario->save();

        return response()->json([
            'success' => true,
            'message' => 'Contraseña actualizada correctamente.',
        ]);
    }
}
