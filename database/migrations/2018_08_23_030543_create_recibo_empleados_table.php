<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReciboEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contable_recibos_empleado', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('idEmpleado')->unsigned();
			$table->integer('idTipoRecibo')->unsigned();
			$table->date('fechaRecibo');
			$table->date('fechaPago');
			
			$table->foreign('idEmpleado')->references('id')->on('contable_empleados');
			$table->foreign('idTipoRecibo')->references('id')->on('contable_tipos_recibo');
			
            $table->timestamps();
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
        Schema::dropIfExists('contable_recibos_empleado');
    }
}
