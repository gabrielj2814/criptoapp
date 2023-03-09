<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Http\Message\ResponseInterface;

class CriptoController extends Controller
{
    //
    private $respuestaServer=["status_code" => null, "mensaje" => null, "data" => []];
    private $urlBase="https://api.coingecko.com/api/v3";

    public  function listar(Request $request){
        //
        $respuesta = $this->listarCriptos();
        if($respuesta->getStatusCode()){
            $this->respuestaServer["status_code"] = 200;
            $this->respuestaServer["mensaje"] = "consulta completada";
            $this->respuestaServer["data"] = json_decode((string) $respuesta->getBody());
        }
        else{
            $this->respuestaServer["status_code"] = 500;
            $this->respuestaServer["mensaje"] = "error al consultar";
        }
        return new JsonResponse($this->respuestaServer);
    }

    private function listarCriptos(){
        $cliente= new Client();
        $respuesta = $cliente->request("GET",$this->urlBase."/coins/list");
        return $respuesta;
    }

    public function obtenerInfoCriptos(Request $request): JsonResponse{
        $listaId=$request->idsCripto;
        $respuestas=$this->consultarInfoMultipleCriptos($listaId);
        if(count($respuestas)>0){
            $this->respuestaServer["status_code"] = 200;
            $this->respuestaServer["mensaje"] = "consulta completada";
            $this->respuestaServer["data"] = $respuestas;
        }
        else{
            $this->respuestaServer["status_code"] = 500;
            $this->respuestaServer["mensaje"] = "error al consultar";
        }

        return new JsonResponse($this->respuestaServer);
    }

    private function consultarInfoMultipleCriptos($listaId){
        $respuestas=[];
        $cliente= new Client();
        foreach ($listaId as  $idCripto) {
            $respuesta= $cliente->get($this->urlBase."/coins/".$idCripto);
            if($respuesta->getStatusCode()){
                $respuestaBody=json_decode((string) $respuesta->getBody());
                $respuestas[]=$respuestaBody;
            }
        }
        return $respuestas;
    }
}
