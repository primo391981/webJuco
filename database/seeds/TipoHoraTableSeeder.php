<?php

use Illuminate\Database\Seeder;

class TipoHoraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contable_tipos_hora')->insert([
            'nombre' => 'HORA COMUN',
        ]);	
        DB::table('contable_tipos_hora')->insert([
            'nombre' => 'HORA EXTRA',
        ]);		
		DB::table('contable_tipos_hora')->insert([
            'nombre' => 'HORA ESPERA',
        ]);
		DB::table('contable_tipos_hora')->insert([
            'nombre' => 'HORA NOCTURNA',
        ]);
		DB::table('contable_tipos_hora')->insert([
            'nombre' => 'HORA PERNOCTE',
        ]);		
    }
}
