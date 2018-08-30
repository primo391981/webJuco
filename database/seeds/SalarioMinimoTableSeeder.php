<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SalarioMinimoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contable_salario_minimo')->insert([
		
			'idCargo'=>2,
			'monto'=>'10000',
			'fechaDesde'=>Carbon::parse('2018-01-01')					
		]);	

		DB::table('contable_salario_minimo')->insert([
		
			'idCargo'=>1,
			'monto'=>'10000',
			'fechaDesde'=>Carbon::parse('2018-01-01'),	
			'fechaHasta'=>Carbon::parse('2018-07-31')
		]);	
		
		DB::table('contable_salario_minimo')->insert([
		
			'idCargo'=>3,
			'monto'=>'10000',
			'fechaDesde'=>Carbon::parse('2018-01-01')					
		]);	
		
		DB::table('contable_salario_minimo')->insert([
		
			'idCargo'=>4,
			'monto'=>'10000',
			'fechaDesde'=>Carbon::parse('2018-01-01')					
		]);	
		
		DB::table('contable_salario_minimo')->insert([
		
			'idCargo'=>5,
			'monto'=>'10000',
			'fechaDesde'=>Carbon::parse('2018-01-01')					
		]);	
		
		DB::table('contable_salario_minimo')->insert([
		
			'idCargo'=>1,
			'monto'=>'10500',
			'fechaDesde'=>Carbon::parse('2018-08-01')			
		]);	
    }
}
