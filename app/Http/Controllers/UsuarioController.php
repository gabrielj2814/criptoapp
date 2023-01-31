<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Repository\Implement;
use App\Repository\Implement\UsuarioRepository;

class UsuarioController extends Controller
{
    //
    private $_UsuarioRepository;

    function __construct(UsuarioRepository $UsuarioRepository)
    {
        $this->_UsuarioRepository = $UsuarioRepository;
    }



    function crearCuenta(Request $request)
    {
        $OpenSSL= new OpenSSLDecryptController();

        $correo = $request->input("correo");
        $nombre = $request->input("nombre");
        $clave = $request->input("clave");
        $pregunta_1 = $request->input("pregunta_1");
        $pregunta_2 = $request->input("pregunta_2");
        $respuesta_1 = $request->input("respuesta_1");
        $respuesta_2 = $request->input("respuesta_2");
        $clave = $OpenSSL->encriptar($clave);
        // $calveDesencriptada= $OpenSSL->desencriptar($claveEncriptada);
        $respuesta = $this->_UsuarioRepository->crearUsuario($correo,$nombre,$clave);

        return new JsonResponse(["mensaje" => "hola"]);
    }
}
