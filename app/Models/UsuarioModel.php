<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioModel extends Model
{
    use HasFactory;

    // con este propiedad le indicamos el nombre de la tabla con la que va a a trabajar
    protected $table = "usuario";
    // con este campo le indicamos que no vamos atrabajar con el creata_at y update_at
    public $timestamps = false;
    // con esto indicamos cual va hacer el campo primary
    protected $primaryKey = "correo";
    // le indicamos que el campo que no auto incremental
    public $incrementing = false;
    // le indicampo cual va hacer el tipo de campo al campo primary
    protected $ketType = "string";
}
