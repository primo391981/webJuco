<?php

use Illuminate\Database\Seeder;

class ContenidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('cms_contenidos')->insert([
            'titulo' => "titulo1",
			'tipoContenido' => 1
        ]);
		
		DB::table('cms_contenidos')->insert([
            'titulo' => "titulo2",
			'tipoContenido' => 2
        ]);
		DB::table('cms_contenidos')->insert([
            'titulo' => "titulo3",
			'tipoContenido' => 3
        ]);
		
    }
}
