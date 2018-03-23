<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContenedorContenidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_contenedor_contenido', function (Blueprint $table) {
            $table->integer('contenedor_id')->unsigned()->index();
            $table->foreign('contenedor_id')->references('id')->on('cms_contenedores')->onDelete('cascade');
            $table->integer('contenido_id')->unsigned()->index();
            $table->foreign('contenido_id')->references('id')->on('cms_contenidos')->onDelete('cascade');
            $table->primary(['contenedor_id', 'contenido_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_contenedor_contenido');
    }
}
