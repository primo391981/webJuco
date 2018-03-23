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
        Schema::create('cms_contenedores', function (Blueprint $table) {
            $table->increments('id');
			$table->string('titulo');
			$table->string('descripcion');
			$table->integer('tipo');
			$table->integer('orden_menu');
			$table->integer('id_padre'); //si es cero, va en el menú principal, sino, va en el submenu en el orden que indica orden_menu
			
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_contenedores');
    }
}
