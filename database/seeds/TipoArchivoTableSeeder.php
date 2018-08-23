<?php

use Illuminate\Database\Seeder;

class TipoArchivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('juridico_tipo_archivo')->insert([
			'nombre'=>'texto plano',
			'descripcion'=>'archivo de texto plano'
		]);
		
		DB::table('juridico_tipo_archivo')->insert([
			'nombre'=>'imagen',
			'descripcion'=>'archivo de imagen en cualquier formato'
		]);
		
		DB::table('juridico_tipo_archivo')->insert([
			'nombre'=>'video',
			'descripcion'=>'archivo de video en cualquier formato'
		]);
		
		DB::table('juridico_tipo_archivo')->insert([
			'nombre'=>'audio',
			'descripcion'=>'archivo de audio en cualquier formato'
		]);
		
		 DB::table('juridico_tipo_archivo')->insert([
			'nombre'=>'documento',
			'descripcion'=>'Documento en formato word, excel, pdf y cualquier otro'
		]);

    }
}
