<?php

use Illuminate\Database\Seeder;

class PersonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persona')->insert([
			'tipoDocumento'=>1,
			'documento'=>45246201,
			'nombre'=>'DIEGO',
			'apellido'=>'UNIBAZO',
			'domicilio'=>'LA PALOMA',
			'telefono'=>'098065107',
			'email'=>'diegounibazo@gmail.com',
			'cantHijos'=>0,
			'estadoCivil'=>1
		]);
		DB::table('persona')->insert([
			'tipoDocumento'=>2,
			'documento'=>1111111,
			'nombre'=>'NOMBRE1',
			'apellido'=>'APELLIDO1',
			'domicilio'=>'DOMICILIO1',
			'telefono'=>'TEL1',
			'email'=>'email1@email1.com',
			'cantHijos'=>1,
			'estadoCivil'=>1
		]);
		DB::table('persona')->insert([
			'tipoDocumento'=>2,
			'documento'=>222222,
			'nombre'=>'NOMBRE2',
			'apellido'=>'APELLIDO2',
			'domicilio'=>'DOMICILIO2',
			'telefono'=>'TEL2',
			'email'=>'email1@email1.com',
			'cantHijos'=>1,
			'estadoCivil'=>1
		]);
    }
}
