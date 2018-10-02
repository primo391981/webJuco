<?php

use Illuminate\Database\Seeder;

class TipoRecibosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contable_tipos_recibo')->insert([
            'nombre' => 'SUELDO',
			'descripcion' => 'Recibo de Sueldos',			
        ]);	
        DB::table('contable_tipos_recibo')->insert([
            'nombre' => 'AGUINALDO PRIMERA CUOTA',
			'descripcion' => 'Recibo de Aguinaldo',
        ]);		
		DB::table('contable_tipos_recibo')->insert([
            'nombre' => 'AGUINALDO SEGUNDA CUOTA',
			'descripcion' => 'Recibo de Aguinaldo',
        ]);		
		DB::table('contable_tipos_recibo')->insert([
            'nombre' => 'SALARIO VACACIONAL',
			'descripcion' => 'Recibo de Salario Vacacional',
        ]);	
		DB::table('contable_tipos_recibo')->insert([
            'nombre' => 'LIQUIDACION HABERES',
			'descripcion' => 'Recibo de Liquidación de Haberes por despido o renuncia',
        ]);	
    }
}
