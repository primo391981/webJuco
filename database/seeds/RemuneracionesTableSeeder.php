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
			'nombre'=>'MENSUAL',
			'descripcion'=>'MENSUAL'
		]);
		
		DB::table('contable_remuneraciones')->insert([
			'nombre'=>'JORNALERO',
			'descripcion'=>'JORNALERO'
		]);
		
		DB::table('contable_remuneraciones')->insert([
			'nombre'=>'DESTAJISTA',
			'descripcion'=>'DESTAJISTA'
		]);
		
		DB::table('contable_remuneraciones')->insert([
			'nombre'=>'ZAFRAL',
			'descripcion'=>'ZAFRAL'
		]);
    }
}
