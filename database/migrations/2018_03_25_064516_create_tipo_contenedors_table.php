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
        Schema::create('tipo_contenedors', function (Blueprint $table) {
            $table->increments('id')->unsigned();
			/*$table->integer('tipo_contenedors_id')->unsigned();*/
			$table->string('nombre');
			$table->string('inicio_estructura');
			$table->string('fin_estructura');
			
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
        Schema::dropIfExists('tipo_contenedors');
    }
}
