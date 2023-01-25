<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PreguntaSeguridad extends Migration
{
    protected $table = "pregunta_seguridad";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("pregunta_seguridad",function(Blueprint $table){
            $table->engine = "InnoDB";
            $table->increments("id_pregunta_seguridad");
            $table->string("pregunta",255);
            $table->string("respuesta",255);
            $table->string("correo",255);
            $table->foreign("correo")->references("correo")->on("usuario")->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
