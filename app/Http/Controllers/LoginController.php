<?php

namespace App\Http\Controllers;

use App\Repository\Implement\UsuarioRepository;
use Bcrypt\Bcrypt;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $respuestaServer=["status_code" => null, "mensaje" => null, "respuesta" => []];
    private $UsuarioRepository;

    function __construct(UsuarioRepository $_UsuarioRepository)
    {
        $this->UsuarioRepository=$_UsuarioRepository;
    }

    //
    public function login(Request $request){
        $respuesta= $this->respuestaServer;
        $respuestaConsulta = $this->UsuarioRepository->buscarPorCorreo($request->correo);
        $Bcrypt = new Bcrypt();
        if($Bcrypt->verify($request->clave,$respuestaConsulta->clave)){
            $respuesta["status_code"]=200;
            $respuesta["mensaje"]="sesion creada con existo";
            return new JsonResponse($respuesta);
        }
        else{
            $respuesta["status_code"]=401;
            $respuesta["mensaje"]="error al iniciar sesion";
            return new JsonResponse($respuesta);
        }
    }

}
