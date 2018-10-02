<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contable_detalles_recibo', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('idRecibo')->unsigned();
			$table->integer('idConceptoRecibo')->unsigned();
			$table->decimal('cantDias', 4, 1)->nullable();
			$table->decimal('cantHoras', 4, 1)->nullable();
			$table->decimal('monto', 8, 2);
			$table->decimal('porcentaje', 8, 3)->nullable();
			
			
			$table->foreign('idRecibo')->references('id')->on('contable_recibos_empleado');
			$table->foreign('idConceptoRecibo')->references('id')->on('contable_conceptos_recibo');
			
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
        Schema::dropIfExists('contable_detalles_recibo');
    }
}
