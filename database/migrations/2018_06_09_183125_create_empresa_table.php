<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
			$table->string('razonSocial');
			$table->double('rut');
			$table->string('domicilio');
			$table->string('nombreFantasia');
			$table->double('numBps');
			$table->double('numBse');
			$table->double('numMtss');
			$table->integer('grupo');
			$table->integer('subGrupo');
			$table->string('email');
			$table->string('telefono');
			$table->string('nomContacto');
			
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
        Schema::dropIfExists('empresa');
    }
}
