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
            'nombre' => "Contenido Genérico",
			'inicio_estructura' => "<div id='nuestrafirma' class='container-fluid contpadding'>",
			'fin_estructura' => "</div>",
			'titulo_contenido' => "<div class='row'>			
										<div class='col-xs-12 col-sm-4 col-sm-offset-2'><h1 class='titulo'>%s</h1>",
			'texto_contenido' => "<p>%s</p></div>",
			'imagen_contenido' => "<div class='col-xs-12 col-sm-4'>
								      <img src='%s' class='img-responsive pull-right' alt='%x'/>
								   </div>",
			'archivo_contenido' => ""
        ]);
		
		DB::table('tipo_contenedors')->insert([
            'nombre' => "Contenido Gris",
			'inicio_estructura' => "<div id='misionvision' class='container-fluid contpadding imgfondo darken'>
									<div class='row'><div class='col-sm-2'></div>",
			'fin_estructura' => "</div></div>",
			'titulo_contenido' => "<div class='col-xs-12 col-sm-4'>
			<h1 class='titulo slideanim'>%s</h1>",
			'texto_contenido' => "<p style='color:white;' class='slideanim'>%s</p>
								  </div>",
			'imagen_contenido' => "",
			'archivo_contenido' => ""
        ]);
    }
}

