<?php

use App\Http\Controllers\LoginController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix("/v1")->group(function() {
    #################
    #    Usuario    #
    #################
    Route::prefix("/usuario")->group(function(){
        Route::get("/",[UsuarioController::class,"consultarTodos"]);
        Route::get("/{correo}",[UsuarioController::class,"consultar"]);
        Route::post("/crear-cuenta",[UsuarioController::class,"crearCuenta"]);
        // endpoitn que requiere validar token de sesion
        Route::delete("/eliminar/{correo}", [UsuarioController::class,"eliminarCuenta"]);
    });
    ###############
    #    Login    #
    ###############
    Route::post("/login",[LoginController::class,"login"]);
    Route::post("/logout",[LoginController::class,"logout"]);


});