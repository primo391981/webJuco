<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PagosAdelantosTableSeeder extends Seeder
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
			'idTipoPago'=>2,
			'fecha'=>Carbon::parse('2018-08-01'),
			'monto'=>1500,
			'descripcion'=>'Adelanto por viaje.',
			'gravado'=> 0
		]);	
		
		DB::table('contable_pagos')->insert([
			'idEmpleado'=>2,
			'idTipoPago'=>2,
			'fecha'=>Carbon::parse('2018-08-01'),
			'monto'=>1000,
			'descripcion'=>'Por solicitud del empleado',
			'gravado'=> 0
		]);	
		
		DB::table('contable_pagos')->insert([
			'idEmpleado'=>3,
			'idTipoPago'=>2,
			'fecha'=>Carbon::parse('2018-08-01'),
			'monto'=>800,
			'descripcion'=>'Para pagar UTE',
			'gravado'=> 0
		]);	
		
    }
}
