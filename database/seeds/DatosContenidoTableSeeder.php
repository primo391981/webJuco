<?php

use Illuminate\Database\Seeder;

class DatosContenidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('datos_contenidos')->insert([
            'contenido_id'=>1,
			'titulo1'=>"MUESTRA TITULO 1",
			'texto1'=>"MUESTRA TEXTO 1",
			'imagen1'=>"ruta"
		]);
		
		DB::table('datos_contenidos')->insert([
            'contenido_id'=>2,
			'titulo1'=>"MUESTRA TITULO 2",
			'texto1'=>"MUESTRA TEXTO 2",
			'imagen1'=>"ruta"
		]);
    }
}
