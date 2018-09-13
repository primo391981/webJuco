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
            'id_paso_inicial' => 3,
            'id_paso_siguiente' => 31,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 3,
            'id_paso_siguiente' => 5,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 31,
            'id_paso_siguiente' => 32,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 32,
            'id_paso_siguiente' => 5,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 5,
            'id_paso_siguiente' => 6,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 6,
            'id_paso_siguiente' => 6,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 6,
            'id_paso_siguiente' => 7,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 7,
            'id_paso_siguiente' => 10,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 10,
            'id_paso_siguiente' => 12,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 10,
            'id_paso_siguiente' => 8,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 8,
            'id_paso_siguiente' => 9,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 9,
            'id_paso_siguiente' => 11,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 4,
            'id_paso_inicial' => 11,
            'id_paso_siguiente' => 12,
			'tipo_transicion' => 0,
		]);
		
		//tipo de expediente 5 - Penal
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 1,
            'id_paso_siguiente' => 13,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 13,
            'id_paso_siguiente' => 14,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 14,
            'id_paso_siguiente' => 15,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 15,
            'id_paso_siguiente' => 16,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 16,
            'id_paso_siguiente' => 12,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 16,
            'id_paso_siguiente' => 17,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 17,
            'id_paso_siguiente' => 18,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 18,
            'id_paso_siguiente' => 19,
			'tipo_transicion' => 1,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 19,
            'id_paso_siguiente' => 20,
			'tipo_transicion' => 1,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 20,
            'id_paso_siguiente' => 21,
			'tipo_transicion' => 1,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 21,
            'id_paso_siguiente' => 22,
			'tipo_transicion' => 1,
		]);
		
		/*DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 22,
            'id_paso_siguiente' => 10,
			'tipo_transicion' => 1,
		]);*/
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 18,
            'id_paso_siguiente' => 23,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 23,
            'id_paso_siguiente' => 24,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 24,
            'id_paso_siguiente' => 25,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 25,
            'id_paso_siguiente' => 26,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 26,
            'id_paso_siguiente' => 10,
			'tipo_transicion' => 0,
		]);
		
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 10,
            'id_paso_siguiente' => 12,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 10,
            'id_paso_siguiente' => 27,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 27,
            'id_paso_siguiente' => 28,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 28,
            'id_paso_siguiente' => 29,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 29,
            'id_paso_siguiente' => 30,
			'tipo_transicion' => 0,
		]);
		
		DB::table('juridico_transicion')->insert([
            'id_tipo_expediente' => 5,
            'id_paso_inicial' => 30,
            'id_paso_siguiente' => 12,
			'tipo_transicion' => 0,
		]);
		
		
		
    }
}

