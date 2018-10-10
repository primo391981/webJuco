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
			$table->integer('tipoDocumento')->unsigned();
			$table->string('documento');
			$table->string('nombre');
			$table->string('apellido');
			$table->string('domicilio');
			$table->string('telefono');
			$table->string('email')->nullable();
			$table->integer('cantHijos')->nullable();
			$table->integer('estadoCivil');
			$table->integer('conDiscapacidad')->nullable();		
			$table->string('nacionalidad');
			$table->date('fechaNacimiento');
			$table->string('pagoNombre')->nullable();
			$table->integer('pagoNumero')->nullable();
			$table->string('departamento');
				
			$table->foreign('tipoDocumento')->references('id')->on('tipo_documento');
			
			$table->softDeletes();
            $table->timestamps();
			
			$table->unique(['tipoDocumento','documento'],'identificacion');
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
