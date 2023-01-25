<?php

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

// CoinRaking api https://developers.coinranking.com/
Route::get("/test/coins", function () {
    $key = env("CLAVE_SECRETA");

    $payload = ["mensaje" => "hola"];
    $jwt = JWT::encode($payload, $key, 'HS256');
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    // print_r($decoded);
    // $url = "https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd";
    $url = "https://api.coingecko.com/api/v3/coins/list";
    $curl = curl_init($url);
    $respuesta = curl_exec($curl);
    // return new JsonResponse(["encriptado" =>$jwt,"desencriptado" => $decoded]);
    return new JsonResponse($respuesta);
});

Route::view("/","home");
Route::view("/login","login");
Route::view("/recuperar-cuenta","recuperar_cuenta");
