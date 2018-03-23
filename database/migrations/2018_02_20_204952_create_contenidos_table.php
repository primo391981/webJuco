<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContenidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_contenidos', function (Blueprint $table) {
            $table->increments('id');
			$table->string('titulo');
			$table->text('texto');
			$table->string('filepath')->nullable($value = true);
			$table->string('imagen')->nullable($value = true);
			$table->string('alt_imagen')->nullable($value = true);
			
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
        Schema::dropIfExists('cms_contenidos');
    }
}
