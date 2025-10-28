<?php

use App\Http\Controllers\API\UsuarioController;
use App\Http\Controllers\AUTH\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)
    ->prefix("auth")
    ->group(function () {
        Route::post("/acceso", "iniciarSesion");
    });

Route::middleware(['auth:sanctum'])->group(function () {

Route::controller(UsuarioController::class)
    ->prefix('usuarios')
    ->group(function () {
        Route::post('/registrarUsuario', 'registrarUsuario');
        Route::get('/listarUsuarios', 'listarUsuarios');
        Route::patch('/actualizarUsuario/{id_usuario}', 'actualizarUsuario');
    });
});


