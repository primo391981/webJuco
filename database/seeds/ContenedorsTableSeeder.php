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
         DB::table('cms_contenedores')->insert([
            'titulo' => "Sección 1",
			'descripcion' => "Contenedor para Nuestra Firma",
			'tipo' => 1,
			'orden_menu' => 0,
			'id_padre' => 1
        ]);
		
		DB::table('cms_contenedores')->insert([
            'titulo' => "Sección 2",
			'descripcion' => "Contenedor para Misión - Visión",
			'tipo' => 2,
			'orden_menu' => 1,
			'id_padre' => 1
        ]);
    }
}
