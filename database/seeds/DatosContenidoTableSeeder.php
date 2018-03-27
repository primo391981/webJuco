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
		DB::table('cms_datos_contenidos')->insert([
            'idContenido'=>1,
			'tipo'=>1,
			'valor'=>"MUESTRA Texto 1"
		]);
		
		DB::table('cms_datos_contenidos')->insert([
            'idContenido'=>2,
			'tipo'=>2,
			'valor'=>"MUESTRA TEXTO 2"			
		]);
			
		
    }
}
