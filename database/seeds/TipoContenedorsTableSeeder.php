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
		DB::table('cms_tipo_contenedors')->insert([
            'nombre' => "UNO - CENTRADO BLANCO",			
			'inicio_estructura' => "<div id='%id' class='container paddingtop'>",
			'fin_estructura' => "</div>",
			'descripcion'=>"CENTRADO BLANCO",
			'imagen'=>"img",
			'titulo_contenido'=>"<div class='row'><div class='col-xs-12 col-sm-12 text-center'><h1>%titulo</h1></div></div>",
			'subtitulo_contenido'=>"<div class='row'><div class='col-xs-12 col-sm-12 text-center'><h3>%subtitulo</h3></div></div>",
			'texto_contenido'=>"<div class='row'><div class='col-xs-12 col-sm-6 offset-sm-3 text-center'>
					<p>%texto</p>
				</div></div>",
			'imagen_contenido'=>"",
			'archivo_contenido'=>"",
			'estilo'=>""
        ]);
		
		/*
		DB::table('cms_tipo_contenedors')->insert([
            'nombre' => "DOS - CENTRADO GRIS",			
			'inicio_estructura' => "<div id='dos' class='container-fluid paddingtop fondogris'><div class='container'>",
			'fin_estructura' => "</div></div>",
			'descripcion'=>"",
			'imagen'=>"img"
        ]);
		
		DB::table('cms_tipo_contenedors')->insert([
            'nombre' => "TRES - FLUID BLANCO",			
			'inicio_estructura' => "<div id='tres' class='container-fluid paddingtop'>",
			'fin_estructura' => "</div>",
			'descripcion'=>"CENTRADO BLANCO",
			'imagen'=>"img"
        ]);
		
		DB::table('cms_tipo_contenedors')->insert([
            'nombre' => "CUATRO - FLUID GRIS",			
			'inicio_estructura' => "<div id='cuatro' class='container-fluid paddingtop fondogris'>",
			'fin_estructura' => "</div>",
			'descripcion'=>"CENTRADO BLANCO",
			'imagen'=>"img"
        ]);
		
		DB::table('cms_tipo_contenedors')->insert([
            'nombre' => "CINCO - FLUID CON FONDO IMG",			
			'inicio_estructura' => "<div id='cinco' class='container-fluid paddingtop' style='background-image: url('img/2.jpg'); background-size:cover; color:white;' >",
			'fin_estructura' => "</div>",
			'descripcion'=>"CENTRADO BLANCO",
			'imagen'=>"img"
        ]);
		
		*/
    }
}
