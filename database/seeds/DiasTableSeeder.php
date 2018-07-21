<?php

use Illuminate\Database\Seeder;

class TipodocTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dias')->insert([
            'nombreDias' => 'LUNES',
        ]);
		DB::table('dias')->insert([
            'nombreDias' => 'MARTES',
        ]);
		DB::table('dias')->insert([
            'nombreDias' => 'MIERCOLES',
        ]);
		DB::table('dias')->insert([
            'nombreDias' => 'JUEVES',
        ]);
		DB::table('dias')->insert([
            'nombreDias' => 'VIERNES',
        ]);
		DB::table('dias')->insert([
            'nombreDias' => 'SABADO',
        ]);
		DB::table('dias')->insert([
            'nombreDias' => 'DOMINGO',
        ]);
		
        
    }
}
