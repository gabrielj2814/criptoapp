<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreguntaSeguridadModel extends Model
{
    use HasFactory;
    protected $table="pregunta_seguridad";
    protected $primaryKey="id_pregunta_seguridad";
    public $timestamps=false;
    public $incrementing=true;
    protected $ketType= "integer";
}
