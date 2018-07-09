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
			'nombre'=>'Casado'
		]);
		
		DB::table('estado_civil')->insert([
			'nombre'=>'Soltero'
		]);
		
		DB::table('estado_civil')->insert([
			'nombre'=>'otro'
		]);
    }
}
