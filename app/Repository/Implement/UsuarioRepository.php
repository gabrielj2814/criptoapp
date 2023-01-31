<?php

namespace App\Repository\Implement;

use App\Models\UsuarioModel;

class UsuarioRepository {

    private $_UsuarioModelo;

    function __construct(UsuarioModel $UsuarioModelo)
    {
        $this->_UsuarioModelo=$UsuarioModelo;
    }

    public function crearUsuario($correo,$nombre,$clave){

        $this->_UsuarioModelo->correo=$correo;
        $this->_UsuarioModelo->nombre=$nombre;
        $this->_UsuarioModelo->clave=$clave;
        $this->_UsuarioModelo->status_usuario="1";
        return $this->_UsuarioModelo->save();

    }

}
