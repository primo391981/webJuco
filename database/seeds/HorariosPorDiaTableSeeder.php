<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class HorariosPorDiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		//Empleado 1
        DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>1,
			'idRegistro'=>1,
			'idDia'=>1,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>1,
			'idRegistro'=>1,
			'idDia'=>2,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>1,
			'idRegistro'=>1,
			'idDia'=>3,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>1,
			'idRegistro'=>1,
			'idDia'=>4,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>1,
			'idRegistro'=>1,
			'idDia'=>5,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>1,
			'idRegistro'=>2,
			'idDia'=>6,
			'cantHoras'=>Carbon::parse('04:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>1,
			'idRegistro'=>3,
			'idDia'=>7,
			'cantHoras'=>Carbon::parse('00:00')	
		]);	
		
		//Empleado 2
		DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>2,
			'idRegistro'=>1,
			'idDia'=>1,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>2,
			'idRegistro'=>1,
			'idDia'=>2,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>2,
			'idRegistro'=>1,
			'idDia'=>3,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>2,
			'idRegistro'=>1,
			'idDia'=>4,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>2,
			'idRegistro'=>1,
			'idDia'=>5,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>2,
			'idRegistro'=>2,
			'idDia'=>6,
			'cantHoras'=>Carbon::parse('04:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>2,
			'idRegistro'=>3,
			'idDia'=>7,
			'cantHoras'=>Carbon::parse('00:00')	
		]);	
		
		//Empleado 3
		DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>3,
			'idRegistro'=>1,
			'idDia'=>1,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>3,
			'idRegistro'=>2,
			'idDia'=>2,
			'cantHoras'=>Carbon::parse('04:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>3,
			'idRegistro'=>3,
			'idDia'=>3,
			'cantHoras'=>Carbon::parse('00:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>3,
			'idRegistro'=>1,
			'idDia'=>4,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>3,
			'idRegistro'=>1,
			'idDia'=>5,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>3,
			'idRegistro'=>1,
			'idDia'=>6,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
		 DB::table('contable_horarios_por_dia')->insert([
			'idHorarioEmpleado'=>3,
			'idRegistro'=>1,
			'idDia'=>7,
			'cantHoras'=>Carbon::parse('08:00')	
		]);	
		
    }
}
