<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContableParametrosGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contable_parametros_generales', function (Blueprint $table) {
            $table->increments('id');
			$table->text('nombre');
			$table->text('descripcion');
			$table->date('fecha_inicio');
			$table->date('fecha_fin')->nullable();
			$table->decimal('valor', 9, 3);
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
        Schema::dropIfExists('contable_parametros_generales');
    }
}
