<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PagosPartidasExtrasTableSeeder extends Seeder
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
			'idTipoPago'=>3,
			'fecha'=>Carbon::parse('2018-08-01'),
			'monto'=>1500,
			'descripcion'=>'Propina.',
			'gravado'=> 1,
			'porcentaje' => 25
		]);	
		
		DB::table('contable_pagos')->insert([
			'idEmpleado'=>2,
			'idTipoPago'=>3,
			'fecha'=>Carbon::parse('2018-08-01'),
			'monto'=>1000,
			'descripcion'=>'Quebranto de caja',
			'gravado'=> 0
		]);	
		
		DB::table('contable_pagos')->insert([
			'idEmpleado'=>3,
			'idTipoPago'=>3,
			'fecha'=>Carbon::parse('2018-08-01'),
			'monto'=>800,
			'descripcion'=>'Vestimenta',
			'gravado'=> 0
		]);	
		
    }
}
