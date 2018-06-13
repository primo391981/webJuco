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
			'color' =>'2',
			'img_fondo' =>'1',
			'ancho_pantalla' =>'2'
        ]);

		DB::table('cms_contenedors')->insert([
            'titulo' => "Sección 2",
			'tipo' =>2,
			'orden_menu' =>2,
			'id_itemmenu' =>2,
			'color' =>'1',
			'img_fondo' =>'0',
			'ancho_pantalla' =>'1'
        ]);
		
    }
}
