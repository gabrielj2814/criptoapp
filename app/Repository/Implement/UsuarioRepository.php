<?php

namespace App\Repository\Implement;

use App\Models\UsuarioModel;

class UsuarioRepository {

    private $UsuarioModelo;

    function __construct(UsuarioModel $_UsuarioModelo)
    {
        $this->UsuarioModelo=$_UsuarioModelo;
    }

    public function crearUsuario($correo,$nombre,$clave){

        $this->UsuarioModelo->correo=$correo;
        $this->UsuarioModelo->nombre=$nombre;
        $this->UsuarioModelo->clave=$clave;
        $this->UsuarioModelo->status_usuario="1";
        $this->UsuarioModelo->save();
        return $this->UsuarioModelo;
    }

    // public function buscarPorCorreo($correo){
    //     return $this->UsuarioModelo->where("correo","=",$correo)->get();
    // }

    public function buscarPorCorreo($correo){
        return $this->UsuarioModelo->find($correo);
    }


}
