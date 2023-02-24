<?php

namespace App\Http\Controllers;

use App\Repository\Implement\UsuarioRepository;
use Bcrypt\Bcrypt;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
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
            $key=env("CLAVE_SECRETA");
            $payload=[
                "correo" => $request->correo,
                "nombre" => $respuestaConsulta->nombre,
            ];
            $token=JWT::encode($payload,$key,"HS256");
            // $tokenDesifrado=JWT::decode($token,new Key($key,"HS256"));
            $respuestaConsulta->token_usuario=$token;
            $respuestaConsulta->save();
            $respuesta["status_code"]=200;
            $respuesta["mensaje"]="sesion creada con existo";
            $respuesta["respuesta"]=[
                "token" => $token
            ];
            return new JsonResponse($respuesta);
        }
        else{
            $respuesta["status_code"]=401;
            $respuesta["mensaje"]="error al iniciar sesion";
            return new JsonResponse($respuesta);
        }
    }

}
