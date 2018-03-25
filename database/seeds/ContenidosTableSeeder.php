<?php

use Illuminate\Database\Seeder;

class ContenidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('contenidos')->insert([
            'nombre' => "CONTENIDO 1",
			'estructura' => "<div class='row'><div class='col-xs-12 col-sm-12 col-md-6'><h1>%titulo</h1><p>%texto</p></div><div class='col-xs-12 col-sm-12 col-md-6'>
			<img src='%imagen' class='img-fluid mx-auto d-block' alt='%alt'/></div></div>"
        ]);
		
		DB::table('contenidos')->insert([
            'nombre' => "CONTENIDO 2",
			'estructura' => "<div class='row'><div class='col-xs-12 col-sm-12 col-md-6'><h1>%titulo</h1><p>%texto</p></div><div class='col-xs-12 col-sm-12 col-md-6'><h1>%titulo2</h1>
			<p>%texto2</p></div></div>"
        ]);
		
		DB::table('contenidos')->insert([
            'nombre' => "CONTENIDO 3",
			'estructura' => "<div class='row'><div class='col-xs-12 col-sm-12 text-center'><h1>%titulo</h1>	<br></div></div>	
		<div class='row'>
			<div class='col-xs-12 col-sm-6 col-md-3 text-center'>
				<i class='%icono1'></i>
				<h3>%sub1</h3>
				<p>%texto1</p>
			</div>
			<div class='col-xs-12 col-sm-6 col-md-3 text-center'>
				<i class='%icono2'></i>
				<h3>%sub2</h3>
				<p>%texto2</p>
			</div>
			<div class='col-xs-12 col-sm-6 col-md-3 text-center'>
				<i class='icono3'></i>
				<h3>%sub3</h3>
				<p>%texto3</p>
			</div>
			<div class='col-xs-12 col-sm-6 col-md-3 text-center'>
				<i class='%icono4'></i>
				<h3>%sub4</h3>
				<p>%texto4</p>
			</div>			
		</div>"
        ]);
		
		DB::table('contenidos')->insert([
            'nombre' => "CONTENIDO 4",
			'estructura' => "<div class='row'>			
			<div class='col-xs-12 col-sm-12 text-center'>				
				<h1>%titulo1</h1>
				<h3>%sub1</h3>
			</div>
		</div>	
		
		<div class='row'>	
			<div class='col-xs-12 col-sm-6 offset-sm-3 text-center'>
					<p>%texto1</p>
				</div>						
		</div> "
        ]);
		
		DB::table('contenidos')->insert([
            'nombre' => "CONTENIDO 5",
			'estructura' => "<div class='row'>			
			<div class='col-xs-12 col-sm-12 text-center'>
				<h1>%titulo1</h1>
				<br>
			</div>
		</div>
		<div class='row'>
			<div class='col-xs-12 col-sm-5 offset-sm-1 text-center'>
				<img src='%imagen1' class='img-fluid center-block' alt='%alt'/>
				<h3><strong>%sub1</strong></h3>
				<p>%texto1</p>
			</div>
			<div class='col-xs-12 col-sm-5 text-center'>
				<img src='%imagen2' class='img-fluid center-block' alt='%alt2'/>
				<h3><strong>%sub2</strong></h3>
				<p>%texto2</p>
			</div>						
		</div>"
        ]);
		
		
		//falta agregar el ocntenido de links de descarga
    }
}
