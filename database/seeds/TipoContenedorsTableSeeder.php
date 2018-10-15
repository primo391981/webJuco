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
            'nombre' => "Unica columna con titulo,subtitulo y texto centrado.",			
			'inicio_estructura' => "<div id='%id' class='container%fluid paddingtop %fondo %img_fondo'>",
			'fin_estructura' => "</div>",
			'descripcion'=>"",
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
            'nombre' => "Titulo general centrado con hasta 4 columnas, cada una con imagen, titulo y texto.",			
			'inicio_estructura' => "<div id='%id' class='container%fluid paddingtop %fondo %img_fondo'><div class='col-xs-12 col-sm-12 text-center'><h1>%titulo_contenedor</h1><br></div><div class='row'>",
			'fin_estructura' => "</div></div>",
			'descripcion'=>"",
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
            'nombre' => "Unica columna con titulo y texto junto con foto al lateral derecho.",			
			'inicio_estructura' => "<div id='%id' class='container%fluid paddingtop %fondo %img_fondo'>",
			'fin_estructura' => "</div>",
			'descripcion'=>"Imagen lateral",
			'imagen'=>"img",
			'estructura_contenido'=>"
										<div class='row'>
											<div class='col-xs-12 col-sm-12 col-md-8'>
												<h1>%titulo</h1>
												<p>%texto</p>
											</div>	
											<div class='col-xs-12 col-sm-12 col-md-4' style='display:flex;align-items:center;justify-content:center;'>
												<img src='%imagen' class='img-fluid' alt='%alt_imagen'/>
											</div>
										</div>
									",
			'estilo'=>""
        ]);
		
		DB::table('cms_tipo_contenedors')->insert([
            'nombre' => "Titulo general centrado con hasta 2 columnas, cada una con imagen, titulo y texto. ",			
			'inicio_estructura' => "<div id='%id' class='container%fluid paddingtop %fondo %img_fondo'><div class='row'><div class='col-xs-12 col-sm-12 text-center'><h1>%titulo_contenedor</h1><br></div></div><div class='row'>",
			'fin_estructura' => "</div></div>",
			'descripcion'=>"",
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
            'nombre' => "Hasta dos columnas con titulo y texto.",			
			'inicio_estructura' => "<div id='%id' class='container%fluid paddingtop %fondo %img_fondo''><div class='row'>",
			'fin_estructura' => "</div></div>",
			'descripcion'=>"",
			'imagen'=>"img",
			'estructura_contenido'=>"<div class='col-xs-12 col-sm-12 col-md-6'><h1>%titulo</h1><p>%texto</p></div>",
			'estilo'=>""
        ]);
		
		
		DB::table('cms_tipo_contenedors')->insert([
            'nombre' => "Unica columna con titulo y texto",			
			'inicio_estructura' => "<div id='%id' class='container%fluid paddingtop %fondo %img_fondo'><div class='container'>",
			'fin_estructura' => "</div></div>",
			'descripcion'=>"Sin imagen lateral",
			'imagen'=>"img",
			'estructura_contenido'=>"
										<div class='row'>
											<div class='col-xs-12'>
												<h1>%titulo</h1>
												<p>%texto</p>
											</div>	
										</div>
									",
			'estilo'=>""
        ]);
		
		DB::table('cms_tipo_contenedors')->insert([
            'nombre' => "Titulo general centrado con 2 columnas: 1 titulo-texto, 2- enlace archivo",			
			'inicio_estructura' => "<div id='%id' class='container%fluid paddingtop %fondo %img_fondo'><div class='col-xs-12 col-sm-12 text-center'><h1>%titulo_contenedor</h1><br></div><div class='row'>",
			'fin_estructura' => "</div></div>",
			'descripcion'=>"Sin imagen lateral",
			'imagen'=>"img",
			'estructura_contenido'=>"
										<div class='row'>
											<div class='col-xs-12 col-sm-12 col-md-8'>
												<h4>%titulo</h4>
												<p>%texto</p>
											</div>	
											<div class='col-xs-12 col-sm-12 col-md-4'>	
												<a href='%archivo' target='_blank'>%nombre_archivo</a>
											</div>
										</div>
									",
			'estilo'=>""
        ]);
		
		

    }
}
