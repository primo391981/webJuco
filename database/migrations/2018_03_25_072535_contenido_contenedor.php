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
		Schema::create('contenido_contenedor', function (Blueprint $table) {
            $table->integer('contenido_id')->unsigned();
           $table->foreign('contenido_id')->references('id')->on('contenidos')->onDelete('cascade');
            $table->integer('contenedor_id')->unsigned();
           $table->foreign('contenedor_id')->references('id')->on('contenedors')->onDelete('cascade');
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
        //
    }
}
