<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //


    function crearCuenta(Request $request){
        $correo= $request->input("correo");
        $nombre= $request->input("nombre");
        $clave= $request->input("clave");
        $pregunta_1= $request->input("pregunta_1");
        $pregunta_2= $request->input("pregunta_2");
        $respuesta_1= $request->input("respuesta_1");
        $respuesta_2= $request->input("respuesta_2");
        return new JsonResponse(["mensaje" => "hola"]);
    }

}
