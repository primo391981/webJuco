<?php

use Illuminate\Database\Seeder;

class TransicionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 3,
            'id_paso_inicial' => 1,
            'id_paso_siguiente' => 2,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 3,
            'id_paso_inicial' => 2,
            'id_paso_siguiente' => 3,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 3,
            'id_paso_inicial' => 3,
            'id_paso_siguiente' => 6,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 3,
            'id_paso_inicial' => 3,
            'id_paso_siguiente' => 9,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 3,
            'id_paso_inicial' => 9,
            'id_paso_siguiente' => 11,
		]);
    }
}


/*
 Schema::create('juridico_transicion', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_tipo_expediente');
			$table->integer('id_paso_inicial');
			$table->integer('id_paso_siguiente');
            $table->timestamps();
        });
*/