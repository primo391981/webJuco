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
			'inicio_estructura' => "<div id='%id' class='container%fluid paddingtop %fondo %img_fondo'>",
			'fin_estructura' => "</div>",
			'descripcion'=>"CENTRADO BLANCO",
			'imagen'=>"img",
			'estructura_contenido'=>"<div class='row'>			
										<div class='col-xs-12 col-sm-12 text-center'>				
											<h1>%titulo</h1>
											<h3>%subtitulo</h3>
										</div>
									</div>	
									
									<div class='row'>	
										<div class='col-xs-12 col-sm-6 offset-sm-3 text-center'>
												<p>%texto</p>
											</div>						
									</div> ",
			'estilo'=>""
        ]);
		
		DB::table('cms_tipo_contenedors')->insert([
            'nombre' => "DOS - 4 columnas",			
			'inicio_estructura' => "<div id='%id' class='container%fluid paddingtop %fondo %img_fondo'>	
	<div class='col-xs-12 col-sm-12 text-center'>
				<h1>%titulo_contenedor</h1>
				<br>
	</div><div class='row'>",
			'fin_estructura' => "</div></div>",
			'descripcion'=>"4 columnas",
			'imagen'=>"img",
			'estructura_contenido'=>"
										<div class='col-xs-12 col-sm-6 col-md-3 text-center'>
											<i class='fas fa-home fa-5x'></i>
											<h3>%titulo</h3>
											<p>%texto</p>
										</div>
									",
			'estilo'=>""
        ]);
		
		
		
		/*
		DB::table('cms_tipo_contenedors')->insert([
            'nombre' => "DOS - 4 columnas con ícono",			
			'inicio_estructura' => "<div id='%id' class='container paddingtop'><div class='col-xs-12 col-sm-12 text-center'>
									<h1>%titulo_contenido</h1><br></div><div class='row'>",
			'fin_estructura' => "</div>",
			'descripcion'=>"4 columnas con ícono",
			'imagen'=>"img",
			'titulo_contenido'=>"<div class='col-xs-12 col-sm-6 col-md-3 text-center'>
				<i class='fas fa-home fa-5x'></i>
				<h3>%titulo</h3>",
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
