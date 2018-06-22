<?php

use Illuminate\Database\Seeder;

class RemuneracionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contable_remuneraciones')->insert([
			'nombre'=>'Mensual',
			'descripcion'=>'Mensual'
		]);
		
		DB::table('contable_remuneraciones')->insert([
			'nombre'=>'Jornelero',
			'descripcion'=>'Jornelero'
		]);
		
		DB::table('contable_remuneraciones')->insert([
			'nombre'=>'Destajista',
			'descripcion'=>'Destajista'
		]);
		
		DB::table('contable_remuneraciones')->insert([
			'nombre'=>'Zafral',
			'descripcion'=>'Zafral'
		]);
    }
}
