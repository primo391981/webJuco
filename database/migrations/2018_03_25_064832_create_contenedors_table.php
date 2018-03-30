<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContenedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_contenedors', function (Blueprint $table) {
            $table->increments('id');
			$table->string('titulo');
			$table->integer('tipo');
			$table->integer('orden_menu');
			$table->integer('id_itemmenu');
			$table->string('color'); 
			$table->string('img_fondo');
			$table->string('ancho_pantalla');
			
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
        Schema::dropIfExists('cms_contenedors');
    }
}
