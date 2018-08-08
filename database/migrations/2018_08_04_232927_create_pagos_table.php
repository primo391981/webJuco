<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contable_pagos', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('idEmpleado')->unsigned();
			$table->integer('idTipoPago')->unsigned();
			$table->date('fecha');
			$table->integer('monto');
			$table->string('descripcion');
			
            $table->foreign('idEmpleado')->references('id')->on('contable_empleados');
			$table->foreign('idTipoPago')->references('id')->on('contable_tipos_pago');
			
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
        Schema::dropIfExists('contable_pagos');
    }
}
