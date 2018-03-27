<?php

use Illuminate\Database\Seeder;

class ContenidosContenedorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('cms_contenido_contenedor')->insert([
            'contenido_id' => 1,
			'contenedor_id' => 1,
		]);
    }
}
