|<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContableHistoricoCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contable_historico_cargos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_empleado');
			$table->integer('id_cargo');
			$table->date('fecha_desde');
			$table->date('fecha_hasta');
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contable_historico_cargos');
    }
}
