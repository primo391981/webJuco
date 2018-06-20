<?php

use Illuminate\Database\Seeder;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('juridico_estados')->insert([
			'nombre'=>'creado',
			'descripcion'=>'Estado inicial de un expediente'
		]);
		
		DB::table('juridico_estados')->insert([
			'nombre'=>'en curso',
			'descripcion'=>'El expediente se encuentra en curso'
		]);
		
		DB::table('juridico_estados')->insert([
			'nombre'=>'cancelado',
			'descripcion'=>'El expediente se encuentra cancelado'
		]);
		
		DB::table('juridico_estados')->insert([
			'nombre'=>'suspendido',
			'descripcion'=>'El expediente se encuentra suspendido'
		]);
		
		DB::table('juridico_estados')->insert([
			'nombre'=>'finalizado',
			'descripcion'=>'El expediente se encuentra finalizado'
		]);
    }
}
