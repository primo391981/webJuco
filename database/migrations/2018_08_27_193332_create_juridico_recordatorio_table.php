<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuridicoRecordatorioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juridico_recordatorio', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_expediente');
			$table->date('fecha_vencimiento');
			$table->integer('cant_dias');
			$table->text('mensaje');
			$table->integer('estado'); //0 - activo, 1 - inactivo
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
        Schema::dropIfExists('juridico_recordatorio');
    }
}
