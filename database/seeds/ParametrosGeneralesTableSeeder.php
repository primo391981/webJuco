<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
			'fecha_inicio' => Carbon::parse('2017-01-01'),
			'fecha_fin' => Carbon::parse('2017-12-31'),
			'valor' => 3611,
        ]);	
       DB::table('contable_parametros_generales')->insert([
            'nombre' => 'FRL',
			'descripcion' => 'Fondo de Reconversión Laboral',
			'fecha_inicio' => Carbon::parse('2010-01-01'),
			'valor' => 0.125,
        ]);	
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'BPC',
			'descripcion' => 'Base de Prestaciones y Contribuciones',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' => 3848,
        ]);	
    }
}
