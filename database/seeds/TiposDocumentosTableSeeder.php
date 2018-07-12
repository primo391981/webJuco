<?php

use Illuminate\Database\Seeder;

class TiposDocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tiposDocumentos')->insert([
			'nombre'=>'CEDULA'
		]);
		DB::table('tiposDocumentos')->insert([
			'nombre'=>'DNI'
		]);
		DB::table('tiposDocumentos')->insert([
			'nombre'=>'PASAPORTE'
		]);
		DB::table('tiposDocumentos')->insert([
			'nombre'=>'OTROS'
		]);
		
    }
}
