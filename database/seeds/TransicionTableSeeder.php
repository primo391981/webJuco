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
		//tipo de expediente 1 - Civil
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 1,
            'id_paso_inicial' => 1,
            'id_paso_siguiente' => 2,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 1,
            'id_paso_inicial' => 2,
            'id_paso_siguiente' => 3,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 1,
            'id_paso_inicial' => 3,
            'id_paso_siguiente' => 4,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 1,
            'id_paso_inicial' => 4,
            'id_paso_siguiente' => 6,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 1,
            'id_paso_inicial' => 4,
            'id_paso_siguiente' => 7,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 1,
            'id_paso_inicial' => 6,
            'id_paso_siguiente' => 6,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 1,
            'id_paso_inicial' => 6,
            'id_paso_siguiente' => 7,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 1,
            'id_paso_inicial' => 7,
            'id_paso_siguiente' => 10,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 1,
            'id_paso_inicial' => 10,
            'id_paso_siguiente' => 8,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 1,
            'id_paso_inicial' => 8,
            'id_paso_siguiente' => 9,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 1,
            'id_paso_inicial' => 9,
            'id_paso_siguiente' => 11,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 1,
            'id_paso_inicial' => 11,
            'id_paso_siguiente' => 12,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 1,
            'id_paso_inicial' => 10,
            'id_paso_siguiente' => 12,
			'tipo_transicion' => 0,
		]);
		
		//tipo de expediente 2 - Laboral Mayor Cuantía
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 2,
            'id_paso_inicial' => 1,
            'id_paso_siguiente' => 2,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 2,
            'id_paso_inicial' => 2,
            'id_paso_siguiente' => 3,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 2,
            'id_paso_inicial' => 3,
            'id_paso_siguiente' => 4,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 2,
            'id_paso_inicial' => 4,
            'id_paso_siguiente' => 7,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 2,
            'id_paso_inicial' => 4,
            'id_paso_siguiente' => 10,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 2,
            'id_paso_inicial' => 7,
            'id_paso_siguiente' => 10,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 2,
            'id_paso_inicial' => 10,
            'id_paso_siguiente' => 12,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 2,
            'id_paso_inicial' => 10,
            'id_paso_siguiente' => 8,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 2,
            'id_paso_inicial' => 8,
            'id_paso_siguiente' => 9,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 2,
            'id_paso_inicial' => 9,
            'id_paso_siguiente' => 11,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 2,
            'id_paso_inicial' => 11,
            'id_paso_siguiente' => 12,
			'tipo_transicion' => 0,
		]);
		
		
		//tipo de expediente 3 - Laboral Menor Cuantía
        DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 3,
            'id_paso_inicial' => 1,
            'id_paso_siguiente' => 2,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 3,
            'id_paso_inicial' => 2,
            'id_paso_siguiente' => 3,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 3,
            'id_paso_inicial' => 3,
            'id_paso_siguiente' => 4,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 3,
            'id_paso_inicial' => 4,
            'id_paso_siguiente' => 7,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 3,
            'id_paso_inicial' => 4,
            'id_paso_siguiente' => 10,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 3,
            'id_paso_inicial' => 7,
            'id_paso_siguiente' => 10,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 3,
            'id_paso_inicial' => 10,
            'id_paso_siguiente' => 12,
			'tipo_transicion' => 0,
		]);
		
		//tipo de expediente 4 - Familia
        DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 1,
            'id_paso_siguiente' => 2,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 2,
            'id_paso_siguiente' => 3,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 1,
            'id_paso_siguiente' => 2,
			'tipo_transicion' => 0,
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