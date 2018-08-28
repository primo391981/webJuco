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
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'IRPF1',
			'descripcion' => 'Primer franga de IRPF',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' => 0,
			'minimo'=>0,
			'maximo'=>7,
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'IRPF2',
			'descripcion' => 'Segunda franga de IRPF',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>10,
			'minimo'=>7,
			'maximo'=>10,
        ]);	
DB::table('contable_parametros_generales')->insert([
            'nombre' => 'IRPF3',
			'descripcion' => 'Tercera franga de IRPF',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>15,
			'minimo'=>10,
			'maximo'=>15,
        ]);	
DB::table('contable_parametros_generales')->insert([
            'nombre' => 'IRPF4',
			'descripcion' => 'Cuarta franga de IRPF',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>24,
			'minimo'=>15,
			'maximo'=>30,
        ]);	
DB::table('contable_parametros_generales')->insert([
            'nombre' => 'IRPF5',
			'descripcion' => 'Quinta franga de IRPF',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>25,
			'minimo'=>30,
			'maximo'=>50,
        ]);		
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'IRPF6',
			'descripcion' => 'Sexta franga de IRPF',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>27,
			'minimo'=>50,
			'maximo'=>75,
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'IRPF7',
			'descripcion' => 'Septima franga de IRPF',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>31,
			'minimo'=>75,
			'maximo'=>115,
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'IRPF8',
			'descripcion' => 'Octava franga de IRPF',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>36,
			'minimo'=>115,			
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'TFD1',
			'descripcion' => 'Primer franja TASA FIJA DE DEDUCCIONES- MENSUAL',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>10,
			'minimo'=>0,
			'maximo'=>15,			
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'TFD2',
			'descripcion' => 'Segunda frnaja TASA FIJA DE DEDUCCIONES- MENSUAL',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>8,
			'minimo'=>15,
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'VMD1',
			'descripcion' => 'Hijos menores - VALORES MENSUALES PARA DETERMINAR DEDUCCIONES',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>4169,			
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'VMD2',
			'descripcion' => 'Con discapacidad - VALORES MENSUALES PARA DETERMINAR DEDUCCIONES',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>8337,			
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'BPS',
			'descripcion' => 'Banco de provision social',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>15,			
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'FONASA1',
			'descripcion' => 'Tasa fonasa sin conyuge - sin hijo',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>3,
			'minimo'=>0,
			'maximo'=>2.5,
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'FONASA2',
			'descripcion' => 'Tasa fonasa sin conyuge - con hijo',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>3,
			'minimo'=>0,
			'maximo'=>2.5,
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'FONASA3',
			'descripcion' => 'Tasa fonasa con conyuge - sin hijo',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>5,
			'minimo'=>0,
			'maximo'=>2.5,
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'FONASA4',
			'descripcion' => 'Tasa fonasa con conyuge - con hijo',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>5,
			'minimo'=>0,
			'maximo'=>2.5,
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'FONASA5',
			'descripcion' => 'Tasa fonasa sin conyuge - sin hijo',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>4.5,
			'minimo'=>2.5,
			
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'FONASA6',
			'descripcion' => 'Tasa fonasa sin conyuge - con hijo',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>6,
			'minimo'=>2.5,
			
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'FONASA7',
			'descripcion' => 'Tasa fonasa con conyuge - sin hijo',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>6.5,
			'minimo'=>2.5,
			
        ]);
		DB::table('contable_parametros_generales')->insert([
            'nombre' => 'FONASA8',
			'descripcion' => 'Tasa fonasa con conyuge - con hijo',
			'fecha_inicio' => Carbon::parse('2018-01-01'),
			'valor' =>8,
			'minimo'=>2.5,
        ]);
		
		
    }
}
