<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalarioMinimoCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contable_salario_minimo', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('idCargo')->unsigned();
			$table->decimal('monto', 7, 2);
			$table->date('fechaDesde');
			$table->date('fechaHasta')->nullable();
			
			$table->foreign('idCargo')->references('id')->on('contable_cargos');
			
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
        Schema::dropIfExists('contable_salario_minimo');
    }
}
