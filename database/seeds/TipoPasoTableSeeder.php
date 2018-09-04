<?php

use Illuminate\Database\Seeder;

class TipoPasoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Creación',
			'descripcion'=>'Creación'
		]); //1
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Demanda',
			'descripcion'=>'Demanda'
		]); //2
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Contestación Demanda',
			'descripcion'=>'Contestación Demanda'
		]); //3
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Audiencia',
			'descripcion'=>'Audiencia'
		]); //4
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Audiencia preliminar',
			'descripcion'=>'Audiencia preliminar'
		]); //5
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Audiencia complementaria',
			'descripcion'=>'Audiencia complementaria'
		]); //6
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Alegatos',
			'descripcion'=>'Alegatos'
		]); //7
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Apelacion',
			'descripcion'=>'Apelacion'
		]); //8
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Contestacion Apelacion',
			'descripcion'=>'Contestacion Apelacion'
		]); //9
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Sentencia Primera Instancia',
			'descripcion'=>'Sentencia Primera Instancia'
		]); //10
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Sentencia Segunda Instancia',
			'descripcion'=>'Sentencia Segunda Instancia'
		]); //11
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Archivado',
			'descripcion'=>'Archivado'
		]); //12
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Denuncia',
			'descripcion'=>'Denuncia'
		]); //13
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Informe de Fiscalia',
			'descripcion'=>'Informe de Fiscalia y pruebas'
		]); //14
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Audiencia con Fiscalia',
			'descripcion'=>'Audiencia con Fiscalia'
		]); //15
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Audiencia Control de Pruebas',
			'descripcion'=>'Audiencia Control de Pruebas'
		]); //16
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Audiencia Formalizacion',
			'descripcion'=>'Audiencia Formalizacion'
		]); //17
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Acusacion o Sobreseimiento',
			'descripcion'=>'Acusacion o Sobreseimiento'
		]); //18
		
		
		//Pasos en paralelo en Montevideo
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Apelacion Paralela Montevideo',
			'descripcion'=>'Apelacion en paralelo en Montevideo'
		]); //19
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Contestacion Apelacion Paralela Montevideo',
			'descripcion'=>'Contestacion Apelacion en paralelo en Montevideo'
		]); //20
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Decreto Paralelo Juez Montevideo',
			'descripcion'=>'Decreto Juez en paralelo Montevideo'
		]); //21
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Sentencia Paralela Montevideo',
			'descripcion'=>'Sentencia en paralelo Montevideo'
		]); //22
		//fin pasos en paralelo
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Contestacion Indagado',
			'descripcion'=>'Contestacion Indagado'
		]); //23
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Decreto Juez',
			'descripcion'=>'Decreto Juez'
		]); //24
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Audiencia Control (Final)',
			'descripcion'=>'Audiencia Control (Final)'
		]); //25
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Audiencia Juicio Oral',
			'descripcion'=>'Audiencia Juicio Oral)'
		]); //26
		
		//Pasos en Montevideo
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Apelacion Montevideo',
			'descripcion'=>'Apelacion en Montevideo'
		]); //27
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Contestacion Apelacion Montevideo',
			'descripcion'=>'Contestacion Apelacion en Montevideo'
		]); //28
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Decreto Juez Montevideo',
			'descripcion'=>'Decreto Juez en Montevideo'
		]); //29
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Sentencia Montevideo',
			'descripcion'=>'Sentencia en Montevideo'
		]); //30
		//fin pasos en Montevideo
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Citacion Excepciones',
			'descripcion'=>'Citacion Excepciones'
		]); //31
		
		DB::table('juridico_tipo_paso')->insert([
			'nombre'=>'Evacuacion Excepciones',
			'descripcion'=>'Evacuacion Excepciones'
		]); //32
    }
}
