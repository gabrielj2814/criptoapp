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
    private $respuestaServer=["status_code" => null, "mensaje" => null, "data" => []];

    private $UsuarioRepository;

    function __construct(UsuarioRepository $_UsuarioRepository)
    {
        $this->UsuarioRepository = $_UsuarioRepository;
    }



    public function crearCuenta(Request $request): JsonResponse
    {
        $repuestaServidor = $this->respuestaServer;
        $Bcrypt = new Bcrypt();
        $version_bcrypt="2a";
        $clave=$Bcrypt->encrypt($request->clave,$version_bcrypt);
        $validarExistenciaUsuario=$this->UsuarioRepository->buscarPorCorreo($request->correo);
        if(is_null($validarExistenciaUsuario)){
            $this->UsuarioRepository->crearUsuario($request->correo,$request->nombre,$clave,$request->pregunta_1,$request->pregunta_2,$request->respuesta_1,$request->respuesta_2);
            $repuestaServidor["status_code"] = 200;
            $repuestaServidor["mensaje"] = "usuario creado con exito";
            return new JsonResponse( $repuestaServidor);
        }
        else{
            $repuestaServidor["status_code"] = 401;
            $repuestaServidor["mensaje"] = "ya esiste un usuario con este correo electronico => ".$request->correo;
            return new JsonResponse($repuestaServidor);
        }
    }

    public function eliminarCuenta(Request $request): JsonResponse{
        $repuestaServidor = $this->respuestaServer;
        $correo= $request->correo;
        $this->UsuarioRepository->eliminar($correo);
        $repuestaServidor["status_code"] = 200;
        $repuestaServidor["mensaje"] = "usuario eliminado con exito";
        return new JsonResponse($repuestaServidor);
    }

    public function consultarTodos(): JsonResponse{
        $repuestaServidor = $this->respuestaServer;
        $respuesta=$this->UsuarioRepository->consultarTodos();
        $repuestaServidor["status_code"] = 200;
        $repuestaServidor["mensaje"] = "consultar completada";
        $repuestaServidor["data"]= [ 
            "usuarios" => $respuesta
        ];
        return new JsonResponse($repuestaServidor);
    }

    public function consultar(Request $request): JsonResponse{
        $repuestaServidor = $this->respuestaServer;
        $correo=$request->correo;
        $respuesta=$this->UsuarioRepository->consultarUnUsuario($correo);
        if($respuesta!=null){
            $repuestaServidor["status_code"] = 200;
            $repuestaServidor["mensaje"] = "consultar completada";
            $repuestaServidor["data"]= [ 
                "usuario" => $respuesta
            ];
        }
        else{
            $repuestaServidor["status_code"] = 404;
            $repuestaServidor["mensaje"] = "el usuario no a sido encontrado";
        }
        return new JsonResponse($repuestaServidor);
    }

    public function consultarPreguntasUsuario(Request $request): JsonResponse {
        $correo= $request->correo;
        $respuesta= $this->UsuarioRepository->consultarPreguntasSeguridadUsuario($correo);
        if(count($respuesta)>0){
            $repuestaServidor = $this->respuestaServer;
            $repuestaServidor["status_code"] = 200;
            $repuestaServidor["mensaje"] = "consultar completada";
            $repuestaServidor["data"]= [ 
                "usuario" => $respuesta
            ];
            return new JsonResponse($repuestaServidor);
        }
        else{
            $repuestaServidor = $this->respuestaServer;
            $repuestaServidor["status_code"] = 404;
            $repuestaServidor["mensaje"] = "error al consultar nose a encontrado al usuario";
            return new JsonResponse($repuestaServidor);
        }
    }
}
