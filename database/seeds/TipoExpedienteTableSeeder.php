<?php

use Illuminate\Database\Seeder;

class TipoExpedienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
		
		DB::table('juridico_tipo_expediente')->insert([
			'nombre'=>'Civil',
			'descripcion'=>'Expediente de tipo Civil. Características'
		]);
		
		DB::table('juridico_tipo_expediente')->insert([
			'nombre'=>'Laboral - Mayor Cuantía',
			'descripcion'=>'Expediente de tipo Laboral de Mayor Cuantía. Implica montos mayores o iguales a $U 120.000. Otras características'
		]);
		DB::table('juridico_tipo_expediente')->insert([
			'nombre'=>'Familia',
			'descripcion'=>'Expediente de tipo Familia. Características'
		]);
		DB::table('juridico_tipo_expediente')->insert([
			'nombre'=>'Laboral - Menor Cuantía',
			'descripcion'=>'Expediente de tipo Laboral de Mayor Cuantía. Implica montos menores a $U 120.000. Otras características'
		]);
		
		DB::table('juridico_tipo_expediente')->insert([
			'nombre'=>'Penal',
			'descripcion'=>'Expediente de tipo Penal. Características'
		]);
    }
}
