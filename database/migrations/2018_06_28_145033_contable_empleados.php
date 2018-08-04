<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContableEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('idPersona')->unsigned();
			$table->integer('idEmpresa')->unsigned();
			$table->integer('idCargo')->unsigned();
			$table->dateTime('fechaDesde');
			$table->dateTime('fechaHasta');
			$table->integer('monto');
			$table->boolean('horarioCargado')->default(false);
			$table->integer('valorHora');
			
			$table->foreign('idPersona')->references('id')->on('persona');
			$table->foreign('idEmpresa')->references('id')->on('empresa');
			$table->foreign('idCargo')->references('id')->on('contable_cargos');
			
			$table->softDeletes();
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
        Schema::dropIfExists('empleados');
    }
}
