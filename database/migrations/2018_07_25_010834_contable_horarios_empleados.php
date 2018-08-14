
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContableHorariosEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contable_horarios_empleados', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('idEmpleado');
			$table->date('fechaDesde');
			$table->date('fechaHasta');
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
        Schema::dropIfExists('contable_horarios_empleados');
    }
}
