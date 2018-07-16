<?php

use Illuminate\Database\Seeder;

class EstadoCivilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_civil')->insert([
			'nombre'=>'CASADO'
		]);
		
		DB::table('estado_civil')->insert([
			'nombre'=>'SOLTERO'
		]);
		
		DB::table('estado_civil')->insert([
			'nombre'=>'OTRO'
		]);
    }
}
