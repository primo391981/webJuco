<?php

use Illuminate\Database\Seeder;

class TipoPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contable_tipos_pago')->insert([
            'nombre' => 'VIATICO',
        ]);	
        DB::table('contable_tipos_pago')->insert([
            'nombre' => 'ADELANTO',
        ]);		
		 DB::table('contable_tipos_pago')->insert([
            'nombre' => 'PARTIDAS EXTRAS',
        ]);	
    }
}
