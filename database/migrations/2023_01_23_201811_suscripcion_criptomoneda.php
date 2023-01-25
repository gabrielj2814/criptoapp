<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SuscripcionCriptomoneda extends Migration
{
    protected $table= "suscripcion_criptomoneda";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("suscripcion_criptomoneda", function(Blueprint $table){
            $table->engine = "InnoDB";
            $table->increments("id_suscripcion_criptomoneda");
            $table->string("correo",255);
            $table->string("id_cripto_moneda",10);
            $table->string("name_cripto",255);
            $table->string("symvol_cripto",10);
            $table->string("url_svg_cripto",255);

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
