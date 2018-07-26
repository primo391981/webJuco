<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuridicoNotificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juridico_notificacion', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_paso');
			$table->integer('id_user');
			$table->integer('id_tipo');
			$table->text('mensaje');
			$table->date('fecha_envio');
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
        Schema::dropIfExists('juridico_notificacion');
    }
}
