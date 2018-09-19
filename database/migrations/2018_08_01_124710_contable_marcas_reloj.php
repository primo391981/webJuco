<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContableMarcasReloj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contable_registros_horas', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('idEmpleado');
			$table->integer('idTipoHora');
			$table->time('cantHoras');
			$table->date('fecha');
			$table->char('tipoDia', 1)->nullable();
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
        Schema::dropIfExists('contable_registros_horas');
    }
}
