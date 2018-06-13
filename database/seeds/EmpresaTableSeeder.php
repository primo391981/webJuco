<?php

use Illuminate\Database\Seeder;

class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresa')->insert([
			//$table->increments('id');
			'razonSocial'=>'Juan Perez Tabarez',
			'rut'=>120215240012,
			'domicilio'=>'domicilio 1',
			'nombreFantasia'=>'La Vaca',
			'numBps'=>15555,
			'numBse'=>155558,
			'numMtss'=>15559,
			'grupo'=>1000,
			'subGrupo'=>99,
			'email'=>'lavaca@juanperez.com',
			'telefono'=>'09987458 int 8',
			'nomContacto'=>'Juan perez'
		]);
		
		DB::table('empresa')->insert([
			//$table->increments('id');
			'razonSocial'=>'Mandinga Carlos perez',
			'rut'=>120215240011,
			'domicilio'=>'domicilio 2',
			'nombreFantasia'=>'Panaderia la flauta',
			'numBps'=>15554,
			'numBse'=>155554,
			'numMtss'=>15554,
			'grupo'=>1000,
			'subGrupo'=>99,
			'email'=>'laflauta@panaderia.com',
			'telefono'=>'0993333 int 8',
			'nomContacto'=>'Mandina carlos'
		]);
    }
}
