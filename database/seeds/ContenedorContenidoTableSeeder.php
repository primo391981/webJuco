<?php

use Illuminate\Database\Seeder;

class ContenedorContenidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('cms_contenedor_contenido')->insert([
            'contenedor_id' => 1,
			'contenido_id' => 1,
		]);
		
		DB::table('cms_contenedor_contenido')->insert([
            'contenedor_id' => 2,
			'contenido_id' => 2,
		]);
		
		DB::table('cms_contenedor_contenido')->insert([
            'contenedor_id' => 2,
			'contenido_id' => 3,
		]);
		
		DB::table('cms_contenedor_contenido')->insert([
            'contenedor_id' => 2,
			'contenido_id' => 4,
		]);
		
		DB::table('cms_contenedor_contenido')->insert([
            'contenedor_id' => 2,
			'contenido_id' => 5,
		]);
    }
}
