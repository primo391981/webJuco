<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
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
			'estadoCivil'=>1,
			'conDiscapacidad'=>0,
			'nacionalidad'=>'URUGUAYA',
			'fechaNacimiento'=>Carbon::parse('1992-01-10'),
			'pagoNombre'=>'RED COBRANZA',
			'pagoNumero'=>123333,
			'departamento'=>'MVDO'
		]);
		DB::table('persona')->insert([
			'tipoDocumento'=>1,
			'documento'=>35736454,
			'nombre'=>'FABIAN',
			'apellido'=>'SELLANES',
			'domicilio'=>'Belvedere',
			'telefono'=>'091987653',
			'email'=>'fsellanes@gmail.com',
			'cantHijos'=>2,
			'estadoCivil'=>1,
			'conDiscapacidad'=>0,
			'nacionalidad'=>'URUGUAYA',
			'fechaNacimiento'=>Carbon::parse('1992-01-10'),
			'pagoNombre'=>'RED COBRANZA',
			'pagoNumero'=>123333,
			'departamento'=>'MVDO'
		]);
		DB::table('persona')->insert([
			'tipoDocumento'=>1,
			'documento'=>11111111,
			'nombre'=>'PEPE',
			'apellido'=>'GUERRA',
			'domicilio'=>'Colonia N° 1254',
			'telefono'=>'2901 8759',
			'email'=>'email1@email1.com',
			'cantHijos'=>2,
			'estadoCivil'=>2,
			'conDiscapacidad'=>0,
			'nacionalidad'=>'URUGUAYA',
			'fechaNacimiento'=>Carbon::parse('1992-01-10'),
			'pagoNombre'=>'RED COBRANZA',
			'pagoNumero'=>123333,
			'departamento'=>'MVDO'
		]);
		DB::table('persona')->insert([
			'tipoDocumento'=>1,
			'documento'=>22222222,
			'nombre'=>'EDUARDO',
			'apellido'=>'LARBANOIS',
			'domicilio'=>'Guatemala N° 235',
			'telefono'=>'2908 2546',
			'email'=>'email1@email1.com',
			'cantHijos'=>2,
			'estadoCivil'=>1,
			'conDiscapacidad'=>0,
			'nacionalidad'=>'URUGUAYA',
			'fechaNacimiento'=>Carbon::parse('1992-01-10'),
			'pagoNombre'=>'RED COBRANZA',
			'pagoNumero'=>123333,
			'departamento'=>'MVDO'
		]);
		DB::table('persona')->insert([
			'tipoDocumento'=>2,
			'documento'=>15875782,
			'nombre'=>'JORGE',
			'apellido'=>'LANATA',
			'domicilio'=>'Av. Agraciada N° 3233',
			'telefono'=>'2908 2546',
			'email'=>'email1@email1.com',
			'cantHijos'=>0,
			'estadoCivil'=>3,
			'conDiscapacidad'=>0,
			'nacionalidad'=>'URUGUAYA',
			'fechaNacimiento'=>Carbon::parse('1992-01-10'),
			'pagoNombre'=>'RED COBRANZA',
			'pagoNumero'=>123333,
			'departamento'=>'MVDO'
		]);
    }
}
