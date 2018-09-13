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
			'fechaDesde'=>Carbon::parse('2018-01-01'),
			'fechaHasta'=>Carbon::parse('2019-01-01'),
			'monto'=>'45000',
			'horarioCargado'=>1,
			'valorHora'=>187.5,
			'nocturnidad'=>1,
			'pernocte'=>0,
			'espera'=>0,
			'habilitado'=>1,
			'tipoHorario'=>1			
		]);	

		DB::table('contable_empleados')->insert([
			'idPersona'=>4,
			'idEmpresa'=>2,
			'idCargo'=>1,
			'fechaDesde'=>Carbon::parse('2018-08-01'),
			'fechaHasta'=>Carbon::parse('2019-07-31'),
			'monto'=>'28000',
			'horarioCargado'=>1,
			'valorHora'=>180,
			'nocturnidad'=>0,
			'pernocte'=>0,
			'espera'=>0,
			'habilitado'=>1,
			'tipoHorario'=>1
		]);
		
		DB::table('contable_empleados')->insert([
			'idPersona'=>5,
			'idEmpresa'=>1,
			'idCargo'=>2,
			'fechaDesde'=>Carbon::parse('2018-01-01'),
			'fechaHasta'=>Carbon::parse('2019-05-31'),
			'monto'=>'18000',
			'horarioCargado'=>1,
			'valorHora'=>100,
			'nocturnidad'=>0,
			'pernocte'=>0,
			'espera'=>0,
			'habilitado'=>1,
			'tipoHorario'=>1
		]);
    }
}
