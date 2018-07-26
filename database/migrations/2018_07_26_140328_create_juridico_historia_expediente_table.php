<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuridicoHistoriaExpedienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juridico_historia_expediente', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_expediente');
			$table->integer('id_paso_inicial');
			$table->integer('id_paso_siguiente');
			$table->boolean('completado')->default(false);
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
        Schema::dropIfExists('juridico_historia_expediente');
    }
}
