<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EmpleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contable_empleados')->insert([
			'idPersona'=>3,
			'idEmpresa'=>1,
			'idCargo'=>1,
			'fechaDesde'=>Carbon::parse('2018-08-01'),
			'fechaHasta'=>Carbon::parse('2018-12-31'),
			'monto'=>'24000',
			'horarioCargado'=>1,
			'valorHora'=>160
		]);	

		DB::table('contable_empleados')->insert([
			'idPersona'=>4,
			'idEmpresa'=>2,
			'idCargo'=>1,
			'fechaDesde'=>Carbon::parse('2018-08-01'),
			'fechaHasta'=>Carbon::parse('2019-07-31'),
			'monto'=>'28000',
			'horarioCargado'=>1,
			'valorHora'=>180
		]);
		
		DB::table('contable_empleados')->insert([
			'idPersona'=>5,
			'idEmpresa'=>1,
			'idCargo'=>2,
			'fechaDesde'=>Carbon::parse('2018-06-01'),
			'fechaHasta'=>Carbon::parse('2019-05-31'),
			'monto'=>'18000',
			'horarioCargado'=>1,
			'valorHora'=>100
		]);
    }
}
