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
        Schema::create('contenedor_contenido', function (Blueprint $table) {
            $table->integer('contenedor_id')->unsigned()->index();
            $table->foreign('contenedor_id')->references('id')->on('contenedors')->onDelete('cascade');
            $table->integer('contenido_id')->unsigned()->index();
            $table->foreign('contenido_id')->references('id')->on('contenidos')->onDelete('cascade');
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
        Schema::dropIfExists('contenedor_contenido');
    }
}
