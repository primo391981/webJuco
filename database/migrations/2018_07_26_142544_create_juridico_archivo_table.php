<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuridicoArchivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juridico_archivo', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_paso');
			$table->integer('id_usuario');
			$table->integer('id_tipo');
			$table->text('archivo');
			$table->text('nombre_archivo');
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
        Schema::dropIfExists('juridico_archivo');
    }
}
