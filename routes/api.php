<?php

use App\Http\Controllers\API\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(UsuarioController::class)
    ->prefix('usuarios')
    ->group(function () {
        Route::post('/registrarUsuario', 'registrarUsuario');
        Route::get('/listarUsuarios', 'listarUsuarios');
        Route::get('/obtenerUsuario/{id_usuario}', 'obtenerUsuario');
        Route::patch('/actualizarUsuario/{id_usuario}', 'actualizarUsuario');
        Route::delete('/eliminarUsuario/{id_usuario}', 'eliminarUsuario');
        Route::post('/cambiarPasswordUsuario', 'cambiarPasswordUsuario');
    });
