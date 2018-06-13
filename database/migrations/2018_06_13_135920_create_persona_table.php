<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('documento');
			$table->string('nombre');
			$table->string('apellido');
			$table->string('domicilio');
			$table->integer('telefono');
			$table->string('email');
			$table->integer('cantHijos');
			$table->string('estadoCivil');
			
			
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
        Schema::dropIfExists('persona');
    }
}
