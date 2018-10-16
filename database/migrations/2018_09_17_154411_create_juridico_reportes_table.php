<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuridicoReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juridico_reportes', function (Blueprint $table) {
            $table->increments('id');
			$table->date('fecha_desde')->nullable();
			$table->date('fecha_hasta')->nullable();
			$table->integer('user_id');
			$table->integer('tipo'); //tipo de reporte: 1-gerencial, 2-expediente
			
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
        Schema::dropIfExists('juridico_reportes');
    }
}
