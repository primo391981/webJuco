<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContenidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_contenidos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
			$table->string('titulo');
			$table->integer('tipoContenido');
			
			//$table->integer('contenidos_id')->unsigned();
			/*$table->string('nombre');
			$table->string('estructura',1000);
			$table->string('imagen');
			$table->string('descripcion');*/
			
			$table->softDeletes();
			
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_contenidos');
    }
}
