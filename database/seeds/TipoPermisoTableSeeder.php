<?php

use Illuminate\Database\Seeder;

class TipoPermisoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('juridico_tipo_permiso')->insert([
			'nombre'=>'Lectura',
			'descripcion'=>'Lectura'
		]);
		
		DB::table('juridico_tipo_permiso')->insert([
			'nombre'=>'Escritura',
			'descripcion'=>'Escritura'
		]);
    }
}
