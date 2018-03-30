<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoContenedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_tipo_contenedors', function (Blueprint $table) {
            $table->increments('id');
			/*$table->integer('tipo_contenedors_id')->unsigned();*/
			$table->string('nombre');
			$table->string('descripcion');
			$table->string('imagen'); //miniatura
			$table->string('inicio_estructura');
			$table->string('fin_estructura');
			$table->text('estructura_contenido');
			/*
			$table->string('titulo_contenido');
			$table->string('subtitulo_contenido');
			$table->string('texto_contenido');
			$table->string('imagen_contenido');
			$table->string('archivo_contenido');
			*/
			$table->string('estilo');
			
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
        Schema::dropIfExists('cms_tipo_contenedors');
    }
}
