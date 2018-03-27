<?php

use Illuminate\Database\Seeder;

class TipoDatosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "titulo1"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "titulo2"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "sub1"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "sub2"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "sub3"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "sub4"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "texto1"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "texto2"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "texto3"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "texto4"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "texto5"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "texto6"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "imagen1"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "imagen2"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "imagen3"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "imagen4"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "imagen5"
        ]);
		DB::table('cms_tipos_datos')->insert([
            'tipodato' => "imagen6"
        ]);
		
    }
}
