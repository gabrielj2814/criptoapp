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
    private $respuestaServer=["status_code" => null, "mensaje" => null, "respuesta" => []];

    private $UsuarioRepository;

    function __construct(UsuarioRepository $_UsuarioRepository)
    {
        $this->UsuarioRepository = $_UsuarioRepository;
    }



    function crearCuenta(Request $request)
    {
        $repuestaServidor = $this->respuestaServer;
        $Bcrypt = new Bcrypt();
        $version_bcrypt="2a";
        $clave=$Bcrypt->encrypt($request->clave,$version_bcrypt);
        $validarExistenciaUsuario=$this->UsuarioRepository->buscarPorCorreo($request->correo);
        if(is_null($validarExistenciaUsuario)){
            $this->UsuarioRepository->crearUsuario($request->correo,$request->nombre,$clave);
            $repuestaServidor["status_code"] = 200;
            $repuestaServidor["mensaje"] = "usuaruo creado con exito";
            return new JsonResponse( $repuestaServidor);
        }
        else{
            $repuestaServidor["status_code"] = 401;
            $repuestaServidor["mensaje"] = "ya esiste un usuario con este correo electronico => ".$request->correo;
            return new JsonResponse($repuestaServidor);
        }
    }
}
