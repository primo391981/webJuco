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
        Schema::create('contable_empleados', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('idPersona')->unsigned();
			$table->integer('idEmpresa')->unsigned();
			$table->integer('idCargo')->unsigned();
			$table->date('fechaDesde');
			$table->date('fechaHasta');
			$table->integer('monto');
			$table->boolean('horarioCargado')->default(false);
			$table->decimal('valorHora', 8, 3);
			$table->boolean('nocturnidad')->default(false);
			$table->boolean('pernocte')->default(false);
			$table->boolean('espera')->default(false);
			$table->boolean('habilitado')->default(true);
			$table->date('fechaBaja')->nullable();
			$table->integer('idMotivo')->unsigned()->nullable();
			$table->integer('tipoHorario')->nullable();
				
			
			$table->foreign('idPersona')->references('id')->on('persona');
			$table->foreign('idEmpresa')->references('id')->on('empresa');
			$table->foreign('idCargo')->references('id')->on('contable_cargos');
			$table->foreign('idMotivo')->references('id')->on('contable_baja_motivos');
			
			
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
