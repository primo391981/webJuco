<?php

use Illuminate\Database\Seeder;

class ContenedorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		 DB::table('cms_contenedors')->insert([
            'titulo' => "Sección 1",
			'tipo' =>1,
			'orden_menu' =>1,
			'id_padre' =>1
        ]);
		 DB::table('cms_contenedors')->insert([
            'titulo' => "Sección 2",
			'tipo' =>2,
			'orden_menu' =>2,
			'id_padre' =>2
        ]);
		
		
    }
}
