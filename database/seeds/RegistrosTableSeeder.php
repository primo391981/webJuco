<?php

use Illuminate\Database\Seeder;

class RegistrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('registros')->insert([
            'nombre' => 'JORNADA COMPLETA',
        ]);	
        DB::table('registros')->insert([
            'nombre' => 'MEDIO DIA',
        ]);		
		DB::table('registros')->insert([
            'nombre' => 'DESCANSO',
        ]);	
    }
}
