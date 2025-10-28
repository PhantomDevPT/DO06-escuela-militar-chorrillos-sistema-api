<?php

namespace App\Http\Controllers\AUTH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//auth
use App\Http\Requests\IniciarSesionRequest;
use App\Http\Requests\RegistrarUsuarioRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * INICIAR SESIÓN
     */
    public function iniciarSesion(IniciarSesionRequest $request)
    {
        // Verifica el usuario y la contraseña
        $usuario = Usuario::where("correo", $request->correo)->first();

        if (!$usuario || !Hash::check($request->contrasena, $usuario->contrasena)) {
            throw ValidationException::withMessages([
                "message" => ["Las credenciales son incorrectas!"]
            ]);
        }

        // Crea el token de acceso
        $token = $usuario->createToken('Token de acceso')->plainTextToken;

        // Aquí configuramos la cookie con el token
        return response()->json([
            "success" => true,
            "message" => "Usuario autenticado",
            "token" => $token,
            "user" => $usuario,
        ]);
    }

    public function cerrarSesion(Request $request)
    {
        // Elimina todos los tokens del usuario autenticado
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sesión cerrada correctamente'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function registrarUsuario(RegistrarUsuarioRequest $request)
    // {
    //     $encryptPassword = $request->encryptPassword();
    //     Usuario::create($encryptPassword);

    //     return response()->json([
    //         "success" => true,
    //         "message" => "Usuario registrado correctamente",
    //     ]);
    // } //
}
