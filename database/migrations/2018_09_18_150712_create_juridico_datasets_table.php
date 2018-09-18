<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuridicoDatasetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juridico_datasets', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_reporte')->unsigned();
			$table->text('dataset');
            $table->timestamps();
			
			$table->foreign('id_reporte')->references('id')->on('juridico_reportes')->onDelete('cascade');
        });
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('juridico_datasets');
    }
}
