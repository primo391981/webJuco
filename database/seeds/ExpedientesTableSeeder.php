<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExpedientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('juridico_expedientes')->insert([
            'iue' => '2-10/2018',
			'caratula' => 'Expediente de prueba',
			'juzgado' => 'Juzgado de prueba',
			'fecha_inicio' => Carbon::parse('2018-07-27'),
			'user_id' => 1,
			'tipo_id' => 3,
			'estado_id' => 1,
			'paso_actual' => 3,
		]);
    }
}
/*
$table->integer('cliente_id');
			$table->text('iue');
			$table->text('caratula');
			$table->text('juzgado');
			$table->date('fecha_inicio');
			$table->integer('user_id');
			$table->integer('tipo_id');
			$table->integer('estado_id');
			$table->integer('paso_actual');

*/