<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuridicoExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juridico_expedientes', function (Blueprint $table) {
            $table->increments('id');
			$table->text('iue');
			$table->text('caratula');
			$table->text('juzgado');
			$table->date('fecha_inicio');
			$table->integer('user_id');
			$table->integer('tipo_id');
			$table->integer('estado_id');
			$table->integer('paso_actual');
			$table->integer('paso_alternativo_actual')->nullable();

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
        Schema::dropIfExists('juridico_expedientes');
    }
}
