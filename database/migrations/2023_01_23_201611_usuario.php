<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuario extends Migration
{
    // con la propiedad table indicamos con que nombre se creara la tabla 
    protected $table= "usuario";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("usuario",function(Blueprint $table){
            $table->engine = "InnoDB";
            $table->string("correo",225)->primary();
            $table->string("nombre",140);
            $table->string("clave",255);
            $table->string("token_usuario",3000)->nullable();
            $table->string("status_usuario",1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("usuario");
        Schema::dropIfExists("usuario");
    }
}
