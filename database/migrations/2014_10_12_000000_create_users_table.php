<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->string('nombre')->nullable($value = true);
			$table->string('apellido')->nullable($value = true);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
			$table->string('imagen')->nullable($value = true);
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
        Schema::dropIfExists('admin_users');
    }
}
