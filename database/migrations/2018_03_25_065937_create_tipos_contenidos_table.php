<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposContenidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_tipos_contenidos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
			//$table->integer('contenidos_id')->unsigned();
			$table->string('nombre');
			$table->string('estructura',1000);
			$table->string('imagen')->nullable($value=true);
			$table->string('descripcion')->nullable($value=true);
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
        Schema::dropIfExists('cms_tipos_contenidos');
    }
}
