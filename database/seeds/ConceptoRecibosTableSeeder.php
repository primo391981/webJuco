<?php

use Illuminate\Database\Seeder;

class ConceptoRecibosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Horas Comunes',
			'descripcion' => 'Horas comunes realizadas en el mes',			
        ]);	
        DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Horas Extras Comunes',
			'descripcion' => 'Horas Extras con valor 200%',
        ]);		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Horas Extras tiempo y medio',
			'descripcion' => 'Horas Extras con valor 250%',
        ]);	
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Viáticos',
			'descripcion' => 'Pago de Viáticos',
        ]);
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Adelantos',
			'descripcion' => 'Pago de Adelantos',
        ]);
    }
}
