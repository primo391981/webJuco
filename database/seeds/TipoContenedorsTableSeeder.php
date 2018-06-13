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
			'inicio_estructura' => "<div id='%id' class='container%fluid paddingtop %fondo %img_fondo'><div class='col-xs-12 col-sm-12 text-center'><h1>%titulo_contenedor</h1><br></div><div class='row'>",
			'fin_estructura' => "</div></div>",
			'descripcion'=>"4 columnas",
			'imagen'=>"img",
			'estructura_contenido'=>"
										<div class='col-xs-12 col-sm-6 col-md-3 text-center'>
											<img src='%imagen' class='img-fluid mx-auto d-block' alt='%alt_imagen'/>
											<h3>%titulo</h3>
											<p>%texto</p>
										</div>
									",
			'estilo'=>""
        ]);
		
		DB::table('cms_tipo_contenedors')->insert([
            'nombre' => "TRES - Con imagen lateral",			
			'inicio_estructura' => "<div id='%id' class='container%fluid paddingtop %fondo %img_fondo'><div class='container'>",
			'fin_estructura' => "</div></div>",
			'descripcion'=>"Imagen lateral",
			'imagen'=>"img",
			'estructura_contenido'=>"
										<div class='row'>
											<div class='col-xs-12 col-sm-12 col-md-6'>
												<h1>%titulo</h1>
												<p>%texto</p>
											</div>	
											<div class='col-xs-12 col-sm-12 col-md-6'>
												<img src='%imagen' class='img-fluid mx-auto d-block' alt='%alt_imagen'/>
											</div>
										</div>
									",
			'estilo'=>""
        ]);
		
		DB::table('cms_tipo_contenedors')->insert([
            'nombre' => "CUATRO - Profesionales",			
			'inicio_estructura' => "<div id='%id' class='container%fluid paddingtop %fondo %img_fondo'><div class='row'><div class='col-xs-12 col-sm-12 text-center'><h1>%titulo_contenedor</h1><br></div></div><div class='row'>",
			'fin_estructura' => "</div></div>",
			'descripcion'=>"Lista Profesionales",
			'imagen'=>"img",
			'estructura_contenido'=>"
										<div class='col-xs-12 col-sm-6 text-center'>
											<img src='%imagen' class='img-fluid center-block' alt='%alt_imagen'/>
											<h3><strong>%titulo</strong></h3>
											<p>%texto</p>
										</div>
									",
			'estilo'=>""
        ]);
		
		DB::table('cms_tipo_contenedors')->insert([
            'nombre' => "CINCO - Dos columnas",			
			'inicio_estructura' => "<div id='%id' class='container%fluid paddingtop %fondo %img_fondo''><div class='row'>",
			'fin_estructura' => "</div></div>",
			'descripcion'=>"Lista Profesionales",
			'imagen'=>"img",
			'estructura_contenido'=>"<div class='col-xs-12 col-sm-12 col-md-6'><h1>%titulo</h1><p>%texto</p></div>",
			'estilo'=>""
        ]);
		
		
		
		

    }
}
