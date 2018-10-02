<?php

use Illuminate\Database\Seeder;

class FeriadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('contable_feriados')->insert([
            'dia'=>1,
			'mes'=>1,			
        ]);
		DB::table('contable_feriados')->insert([
            'dia'=>1,
			'mes'=>5,			
        ]);
		DB::table('contable_feriados')->insert([
            'dia'=>18,
			'mes'=>7,			
        ]);
		DB::table('contable_feriados')->insert([
            'dia'=>25,
			'mes'=>8,			
        ]);
		DB::table('contable_feriados')->insert([
            'dia'=>25,
			'mes'=>12,			
        ]);
    }
}
