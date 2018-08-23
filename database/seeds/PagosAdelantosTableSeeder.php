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
			'fecha'=>Carbon::parse('2018-08-05'),
			'monto'=>1500,
			'descripcion'=>'Adelanto por viaje.'
		]);	
		
		DB::table('contable_pagos')->insert([
			'idEmpleado'=>2,
			'idTipoPago'=>2,
			'fecha'=>Carbon::parse('2018-08-18'),
			'monto'=>1000,
			'descripcion'=>'Por solicitud del empleado'
		]);	
		
		DB::table('contable_pagos')->insert([
			'idEmpleado'=>3,
			'idTipoPago'=>2,
			'fecha'=>Carbon::parse('2018-08-7'),
			'monto'=>800,
			'descripcion'=>'Para pagar UTE'
		]);	
		
    }
}
