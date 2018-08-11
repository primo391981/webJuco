<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContableHistoricoCargosEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contable_cargos_empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cargo');
			$table->integer('id_empresa');
			$table->date('fecha_desde');
			$table->date('fecha_hasta');
			$table->float('monto', 8, 2);
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
        Schema::dropIfExists('contable_cargos_empresa');
    }
}
