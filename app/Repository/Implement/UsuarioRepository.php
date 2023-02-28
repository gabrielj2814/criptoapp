<?php

namespace App\Repository\Implement;

use App\Models\UsuarioModel;
use Illuminate\Database\Eloquent\Collection;

class UsuarioRepository {

    private $UsuarioModelo;

    function __construct(UsuarioModel $_UsuarioModelo)
    {
        $this->UsuarioModelo=$_UsuarioModelo;
    }

    public function crearUsuario(string $correo, string $nombre, string $clave, string $pregunta_1, string $pregunta_2, string $respuesta_1, string $respuesta_2): UsuarioModel{

        $this->UsuarioModelo->correo=$correo;
        $this->UsuarioModelo->nombre=$nombre;
        $this->UsuarioModelo->clave=$clave;
        $this->UsuarioModelo->pregunta_1=$pregunta_1;
        $this->UsuarioModelo->pregunta_2=$pregunta_2;
        $this->UsuarioModelo->respuesta_1=$respuesta_1;
        $this->UsuarioModelo->respuesta_2=$respuesta_2;
        $this->UsuarioModelo->status_usuario="1";
        $this->UsuarioModelo->save();
        return $this->UsuarioModelo;
    }

    public function buscarPorCorreo(string $correo){
        return $this->UsuarioModelo->find($correo);
    }

    public function eliminar(string $correo): void{
        $usuario=$this->UsuarioModelo->find($correo);
        if($usuario){
            $usuario->delete();
        }
    }

    public function consultarTodos(): Collection{
        return $this->UsuarioModelo->all(["correo","nombre"]);
    }

    public function consultarUnUsuario(string $correo){
        return $this->UsuarioModelo->find($correo,["correo","nombre"]);
    }

    public function consultarPreguntasSeguridadUsuario(string $correo): Collection{
        return $this->UsuarioModelo->select("pregunta_1","pregunta_2")
        ->where("correo","=",$correo)
        ->get();
    }


}
