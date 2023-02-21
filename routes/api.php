<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

#################
#    Usuario    #
#################
// TODO: recuperar cuenta preguntas de seguridad
// TODO: modificar perfil
// TODO: cambiar contraseña
// TODO: suspender cuenta
Route::post("/crear-cuenta",[UsuarioController::class,"crearCuenta"]);
###############
#    Login    #
###############
// TODO: inciar sesion generar TOKEN
// TODO: cerrar sesion
