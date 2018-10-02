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
			$table->double('rut')->nullable();
			$table->string('domicilio')->nullable();
			$table->string('nombreFantasia');
			$table->double('numBps')->nullable();
			$table->double('numBse')->nullable();
			$table->double('numMtss')->nullable();
			$table->integer('grupo')->nullable();
			$table->integer('subGrupo')->nullable();
			$table->string('email')->nullable();
			$table->string('telefono')->nullable();
			$table->string('nomContacto')->nullable();
			
			 $table->unique(['rut', 'grupo','subGrupo']);
			
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
