<?php

use Illuminate\Database\Seeder;

class DiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dias')->insert([
            'nombre' => 'LUNES',
        ]);
		DB::table('dias')->insert([
            'nombre' => 'MARTES',
        ]);
		DB::table('dias')->insert([
            'nombre' => 'MIERCOLES',
        ]);
		DB::table('dias')->insert([
            'nombre' => 'JUEVES',
        ]);
		DB::table('dias')->insert([
            'nombre' => 'VIERNES',
        ]);
		DB::table('dias')->insert([
            'nombre' => 'SABADO',
        ]);
		DB::table('dias')->insert([
            'nombre' => 'DOMINGO',
        ]);
		
        
    }
}
