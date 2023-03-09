<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//  suscripcion a una cripto moneda y ver las cripto a las que estas suscripto mas su informacion
//  calcura dora cripto a una monada fisica com usd o bolivar
//  ver el valor de la critpo en dolares y en otras monedas como el euro, bolivares, jpy entre otros esto es estatico
//  ver el historial de cambio de una cripto tan a la que este suscrita como a las que no
//  comprar precios entre ayer y hoy de las cripto a las que ests suscrito
//  comprar precios entre la semana pasada y esta de las cripto a las que ests suscrito


Route::view("/","inicio.inicio");
