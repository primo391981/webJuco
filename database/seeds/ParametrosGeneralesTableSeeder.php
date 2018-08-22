<?php

use Illuminate\Database\Seeder;

class ParametrosGeneralesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contable_parametros_generales')->insert([
            'nombre' => 'BPC',
			'descripcion' => 'Base de Prestaciones y Contribuciones',
			'fecha_inicio' => Carbon::parse('2017-01-01'),,
			'fecha_fin' => Carbon::parse('2017-12-31'),
			'valor' => 3611,
        ]);	
       DB::table('contable_parametros_generales')->insert([
            'nombre' => 'BPC',
			'descripcion' => 'Base de Prestaciones y Contribuciones',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' => 3848,
        ]);	
    }
}
