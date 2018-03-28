<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\CMS\Contenedor;
use App\CMS\TipoContenedor;

class WebController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    
	//función que contruye el index del sitio web
	public function index()
	
	//contenido es la variable que se llama en el index
	//$contenido es el array en el que se cargaron los datos en el Controller
    {
		//se obtienen todos los contenedores que existen en el sistema ordenados por orden en el menú
		//todo: filtrar por aquellos contenedores "publicados" o "activos"
		
		$contenedores = Contenedor::OrderBy('orden_menu')->get();
		
		//dd($contenedores[0]->contenidos);
		//dd($contenedores[0]->contenidos[0]->datosContenido);
		//dd($contenedores[0]->contenidos[0]->datosContenido);
		//se recorre la lista de contenedores
		foreach($contenedores as $contenedor){
			
			//se recorre la lista de contenidos de cada contenedor
			foreach($contenedor->contenidos as $contenido){
				
				//por cada contenido:
				
				//dd($contenido);
					//se formatea el título de acuerdo a lo establecido por el tipo de contenedor
					//dd($contenedor->tipoContenedor);
					//dd($datos->pivot->tipodato_id);
					$contenido->titulo = str_replace("%titulo", $contenido->titulo ,$contenedor->tipoContenedor->titulo_contenido);
					
					//se formatea el texto de acuerdo a lo establecido por el tipo de contenedor
					$contenido->subtitulo = str_replace("%subtitulo",$contenido->subtitulo, $contenedor->tipoContenedor->subtitulo_contenido);
					
					//se formatea el texto de acuerdo a lo establecido por el tipo de contenedor
					$contenido->texto = str_replace("%texto",$contenido->texto, $contenedor->tipoContenedor->texto_contenido);
				/*
					//se formatea la imagen de acuerdo a lo establecido por el tipo de contenedor y se completa el texto "alt"
					$contenido->imagen = str_replace("%imagen",$contenido->imagen, $contenedor->tipoContenedor->imagen_contenido);
					$contenido->imagen = str_replace("%alt_imagen",$contenido->alt_imagen, $contenedor->tipoContenedor->imagen_contenido);
				*/
				//dd($contenido);
				
			}
			
		}
		
		//se retorna la vista "index" con la colección de contenedores
		return view('index', ['contenedores' => $contenedores]);
    }
	
}