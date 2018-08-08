<?php

use Illuminate\Database\Seeder;

class CargosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contable_cargos')->insert([
            'nombre' => 'CARGO UNO',
			'descripcion'=>'DESC CARGO UNO',
			'id_remuneracion'=>'1'
        ]);
		DB::table('contable_cargos')->insert([
            'nombre' => 'CARGO DOS',
			'descripcion'=>'DESC CARGO DOS',
			'id_remuneracion'=>'1'
        ]);	
        DB::table('contable_cargos')->insert([
            'nombre' => 'CARGO TRES',
			'descripcion'=>'DESC CARGO TRES',
			'id_remuneracion'=>'2'
        ]);
		DB::table('contable_cargos')->insert([
            'nombre' => 'CARGO CUATRO',
			'descripcion'=>'DESC CARGO CUATRO',
			'id_remuneracion'=>'1'
        ]);
		DB::table('contable_cargos')->insert([
            'nombre' => 'CARGO CINCO',
			'descripcion'=>'DESC CARGO CINCO',
			'id_remuneracion'=>'2'
        ]);	
    }
}
