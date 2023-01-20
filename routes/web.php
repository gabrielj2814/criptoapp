<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
// CoinRaking api https://developers.coinranking.com/
Route::get("/test/coins", function () {

    $url = "https://api.coinranking.com/v2/coins";
    $curl = curl_init($url);

    curl_setopt_array($curl, [
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-access-toke: ".env("COINRANKING_KEY_API")
        ]
    ]);
    $respuesta = curl_exec($curl);
    return new Response($respuesta);
    // print(env("COINRANKING_KEY_API"));
});
