<?php

use Illuminate\Database\Seeder;

class TipodocTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_documento')->insert([
            'nombre' => 'CEDULA',
        ]);
		
        DB::table('tipo_documento')->insert([
            'nombre' => 'DNI',
        ]);

        DB::table('tipo_documento')->insert([
            'nombre' => 'PASAPORTE',
        ]);

        DB::table('tipo_documento')->insert([
            'nombre' => 'OTRO',
        ]);
    }
}
