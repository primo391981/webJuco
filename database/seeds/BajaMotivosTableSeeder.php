<?php

use Illuminate\Database\Seeder;

class BajaMotivosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('contable_baja_motivos')->insert([
            'nombre' => 'FIN DE CONTRATO',
        ]);	
        DB::table('contable_baja_motivos')->insert([
            'nombre' => 'DESPIDO',
        ]);	
		DB::table('contable_baja_motivos')->insert([
            'nombre' => 'RENUNCIA',
        ]);			
		DB::table('contable_baja_motivos')->insert([
            'nombre' => 'DESPIDO MALA CONDUCTA',
        ]);
		DB::table('contable_baja_motivos')->insert([
            'nombre' => 'OTRO',
        ]);		
    }
}
