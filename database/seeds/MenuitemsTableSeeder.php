<?php

use Illuminate\Database\Seeder;

class MenuitemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('cms_menuitems')->insert([
            'titulo' => 'Nuestra firma',
			'descripcion' => 'Nuestra firma',
			'orden_menu' => 1
        ]);
		
		DB::table('cms_menuitems')->insert([
            'titulo' => 'Misión',
			'descripcion' => 'Misión',
			'orden_menu' => 2
        ]);
		
		DB::table('cms_menuitems')->insert([
            'titulo' => 'Visión',
			'descripcion' => 'Visión',
			'orden_menu' => 3
        ]);
		
		DB::table('cms_menuitems')->insert([
            'titulo' => 'Servicios',
			'descripcion' => 'Servicios',
			'orden_menu' => 4
        ]);
		
           
    }
}
