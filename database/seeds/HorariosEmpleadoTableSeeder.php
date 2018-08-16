<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class HorariosEmpleadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contable_horarios_empleados')->insert([
			'idEmpleado'=>1,
			'fechaDesde'=>Carbon::parse('2018-01-01'),
			'fechaHasta'=>Carbon::parse('2019-01-01')			
		]);	
		/*DB::table('contable_horarios_empleados')->insert([
			'idEmpleado'=>1,
			'fechaDesde'=>Carbon::parse('2018-08-01'),
			'fechaHasta'=>Carbon::parse('2018-08-31')			
		]);*/
		
		DB::table('contable_horarios_empleados')->insert([
			'idEmpleado'=>2,
			'fechaDesde'=>Carbon::parse('2018-08-01'),
			'fechaHasta'=>Carbon::parse('2019-07-31')
		]);
		
		DB::table('contable_horarios_empleados')->insert([
			'idEmpleado'=>3,
			'fechaDesde'=>Carbon::parse('2018-06-01'),
			'fechaHasta'=>Carbon::parse('2019-05-31')			
		]);		
    }
}
