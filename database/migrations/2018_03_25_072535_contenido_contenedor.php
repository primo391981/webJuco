<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContenidoContenedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('cms_contenido_contenedor', function (Blueprint $table) {
            $table->integer('contenido_id')->unsigned();
           $table->foreign('contenido_id')->references('id')->on('cms_contenidos');
            $table->integer('contenedor_id')->unsigned();
           $table->foreign('contenedor_id')->references('id')->on('cms_contenedors');
            $table->primary(['contenedor_id', 'contenido_id']);
			
			//orden en caso de muchos contenidos en un contenedor_id
			$table->integer('orden')->default(1);
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
		Schema::dropIfExists('cms_contenido_contenedor');
    }
}
