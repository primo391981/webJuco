<?php

use Illuminate\Database\Seeder;

class TipoNotificacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('juridico_tipo_notificacion')->insert([
			'nombre'=>'info',
			'descripcion'=>'Información'
		]);
		
		DB::table('juridico_tipo_notificacion')->insert([
			'nombre'=>'Nota',
			'descripcion'=>'Nota simple'
		]);
		
		DB::table('juridico_tipo_notificacion')->insert([
			'nombre'=>'Nota importante',
			'descripcion'=>'Nota importante'
		]);
		
		DB::table('juridico_tipo_notificacion')->insert([
			'nombre'=>'Nota urgente',
			'descripcion'=>'Nota urgente'
		]);
		
		DB::table('juridico_tipo_notificacion')->insert([
			'nombre'=>'Recordatorio',
			'descripcion'=>'Recordatorio'
		]);
		
		
		
		
    }
}
