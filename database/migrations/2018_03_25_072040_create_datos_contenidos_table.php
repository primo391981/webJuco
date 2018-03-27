<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosContenidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_datos_contenidos', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('idContenido');
			$table->integer('tipo');
			//$table->foreign('tipo')->references('id')->on('tiposdatos');
			$table->string('valor');
			
			/*$table->string('titulo1')->nullable($value = true);
			$table->string('titulo2')->nullable($value = true);
			$table->string('sub1')->nullable($value = true);
			$table->string('sub2')->nullable($value = true);
			$table->string('sub3')->nullable($value = true);
			$table->string('sub4')->nullable($value = true);
			$table->string('texto1')->nullable($value = true);
			$table->string('texto2')->nullable($value = true);
			$table->string('texto3')->nullable($value = true);
			$table->string('texto4')->nullable($value = true);
			$table->string('texto5')->nullable($value = true);
			$table->string('texto6')->nullable($value = true);
			$table->string('imagen1')->nullable($value = true);
			$table->string('imagen2')->nullable($value = true);
			$table->string('icon1')->nullable($value = true);
			$table->string('icon2')->nullable($value = true);
			$table->string('icon3')->nullable($value = true);
			$table->string('icon4')->nullable($value = true);
			
			$table->integer('contenido_id')->unsigned();
            $table->foreign('contenido_id')->references('id')->on('contenidos')->onDelete('cascade');*/
			
			
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
        Schema::dropIfExists('cms_datos_contenidos');
    }
}
