<?php

use Illuminate\Database\Seeder;

class TipoContenedorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('tipo_contenedors')->insert([
            'nombre' => "UNO - CENTRADO BLANCO",			
			'inicio_estructura' => "<div id='uno' class='container paddingtop'>",
			'fin_estructura' => "</div>"
        ]);
		
		DB::table('tipo_contenedors')->insert([
            'nombre' => "DOS - CENTRADO GRIS",			
			'inicio_estructura' => "<div id='dos' class='container-fluid paddingtop fondogris'><div class='container'>",
			'fin_estructura' => "</div></div>"
        ]);
		
		DB::table('tipo_contenedors')->insert([
            'nombre' => "TRES - FLUID BLANCO",			
			'inicio_estructura' => "<div id='tres' class='container-fluid paddingtop'>",
			'fin_estructura' => "</div>"
        ]);
		
		DB::table('tipo_contenedors')->insert([
            'nombre' => "CUATRO - FLUID GRIS",			
			'inicio_estructura' => "<div id='cuatro' class='container-fluid paddingtop fondogris'>",
			'fin_estructura' => "</div>"
        ]);
		
		DB::table('tipo_contenedors')->insert([
            'nombre' => "CINCO - FLUID CON FONDO IMG",			
			'inicio_estructura' => "<div id='cinco' class='container-fluid paddingtop' style='background-image: url('img/2.jpg'); background-size:cover; color:white;' >",
			'fin_estructura' => "</div>"
        ]);
    }
}
