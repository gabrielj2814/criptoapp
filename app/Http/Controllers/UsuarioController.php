<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Repository\Implement;
use App\Repository\Implement\UsuarioRepository;
use Bcrypt\Bcrypt;

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
        $repuestaServidor = ["status_code" => null, "respuesta" => []];
        $Bcrypt = new Bcrypt();
        $version_bcrypt="2a";
        $clave=$Bcrypt->encrypt($request->clave,$version_bcrypt);
        $respuesta = $this->_UsuarioRepository->crearUsuario($request->correo,$request->nombre,$clave);
        if($respuesta){
            $repuestaServidor["status_code"] = 200;
            return new JsonResponse( $repuestaServidor);
        }
        else{
            $repuestaServidor["status_code"] = 401;
            return new JsonResponse($repuestaServidor);
        }
    }
}
