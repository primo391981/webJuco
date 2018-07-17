<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContableCargosEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contable_cargos', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nombre',30);
			$table->text('descripcion');
			$table->integer('id_remuneracion');
			$table->timestamps();
			$table->softDeletes();
            
			$table->unique(['nombre','id_remuneracion'],'cargo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contable_cargos');
    }
}
