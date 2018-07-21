<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContableHrsDiasEmp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horasDiasEmp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idDia');
			$table->integer('idEmpleado');
			$table->enum('tipoDia', ['libre', 'trabajo']);
			$table->integer('cantHrs');
			
			$table->foreign('idDia')->references('id')->on('dias');
			$table->foreign('idEmpleado')->references('id')->on('empleados');
			
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
        Schema::dropIfExists('horasDiasEmp');
    }
}
