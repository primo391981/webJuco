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
            'nombre' => 'Sueldo / Jornal',
			'descripcion' => 'Horas comunes pagadas en el mes',			
        ]);	
        
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Horas Extras',
			'descripcion' => 'Horas Extras con valor 200%',
        ]);		
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Horas Extras 2,5',
			'descripcion' => 'Horas Extras con valor 250%',
        ]);	
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Tiempo Espera',
			'descripcion' => 'Horas de Espera',
        ]);
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Tiempo Percnote',
			'descripcion' => 'Horas de Percnote',
        ]);
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Tiempo de Nocturnidad',
			'descripcion' => 'Horas de Nocturnidad',
        ]);
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Antiguedad',
			'descripcion' => 'Prima de Antiguedad',
        ]);
		
		//partidas extras
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Viáticos',
			'descripcion' => 'Pago de Viáticos',
        ]);
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Subtotal Gravado',
			'descripcion' => 'Subtotal Gravado',
        ]);
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Subtotal No Gravado',
			'descripcion' => 'Subtotal No Gravado',
        ]);
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Subtotal Nominal',
			'descripcion' => 'Subtotal Nominal',
        ]);	
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'BPS',
			'descripcion' => 'Descuento BPS',
        ]);
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'FONASA',
			'descripcion' => 'Descuento Fonasa',
        ]);
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'IRPF Primario',
			'descripcion' => 'IRPF Primario',
        ]);
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'IRPF Deducciones',
			'descripcion' => 'IRPF Deducciones',
        ]);
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'FRL',
			'descripcion' => 'Descuento Fondo de Reconversión Laboral',
        ]);
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Adelantos',
			'descripcion' => 'Pago de Adelantos',
        ]);
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Subtotal Descuentos',
			'descripcion' => 'Subtotal Descuentos',
        ]);
		
		DB::table('contable_conceptos_recibo')->insert([
            'nombre' => 'Líquido a Cobrar',
			'descripcion' => 'Líquido a Cobrar',
        ]);

    }
}
