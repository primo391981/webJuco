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
        Schema::create('contenedors', function (Blueprint $table) {
            $table->increments('id');
			$table->string('titulo');//esto es lo que va en el menu
			$table->integer('tipo')->unsigned();
			$table->integer('orden_menu');//
			$table->integer('id_padre'); //si es cero, va en el menú principal, sino, va en el submenu en el orden que indica orden_menu
			
			$table->foreign('tipo')->references('id')->on('tipo_contenedors')->onDelete('cascade');
			
			
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
        Schema::dropIfExists('contenedors');
    }
}
