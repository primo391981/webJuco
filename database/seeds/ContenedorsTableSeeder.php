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
			'id_itemmenu' =>1,
			'color' =>'',
			'img_fondo' =>'',
			'ancho_pantalla' =>''
        ]);

		DB::table('cms_contenedors')->insert([
            'titulo' => "Sección 2",
			'tipo' =>1,
			'orden_menu' =>2,
			'id_itemmenu' =>1,
			'color' =>'',
			'img_fondo' =>'',
			'ancho_pantalla' =>''
        ]);
		
		
    }
}
