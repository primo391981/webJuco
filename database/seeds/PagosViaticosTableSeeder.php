<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PagosViaticosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contable_pagos')->insert([
			'idEmpleado'=>1,
			'idTipoPago'=>1,
			'fecha'=>Carbon::parse('2018-08-01'),
			'monto'=>750,
			'descripcion'=>'Viático por pasajes.'
		]);	
		
		DB::table('contable_pagos')->insert([
			'idEmpleado'=>2,
			'idTipoPago'=>1,
			'fecha'=>Carbon::parse('2018-08-01'),
			'cantDias'=>10,
			'monto'=>1500,
			'descripcion'=>'Almuerzo en el Oro del Rhin.'
		]);	
		
		DB::table('contable_pagos')->insert([
			'idEmpleado'=>3,
			'idTipoPago'=>1,
			'fecha'=>Carbon::parse('2018-08-01'),
			'monto'=>650,
			'descripcion'=>'Pasajes.'
		]);	
		
		DB::table('contable_pagos')->insert([
			'idEmpleado'=>3,
			'idTipoPago'=>1,
			'fecha'=>Carbon::parse('2018-08-01'),
			'cantDias'=>10,
			'monto'=>800
		]);	
		
    }
}
