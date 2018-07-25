<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContableHorarioPorDia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horariosPorDia', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('idHorarioEmpleado');
			$table->integer('idRegistro');
			$table->integer('idDia');
			$table->string('descripcion');
			$table->time('cantHoras');
			//time o integer?
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
        Schema::dropIfExists('horariosPorDia');
    }
}
