<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\CMS\Contenedor;
use App\CMS\TipoContenedor;
use App\CMS\Menuitem;


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
		
		$menuitems = Menuitem::has('contenedores')->get();
		
		foreach($menuitems as $menuitem){
			//$contenedores = Contenedor::OrderBy('orden_menu')->get();
			
			//dd($menuitem->contenedores[0]->id);
			//dd($contenedores[0]->contenidos);
			//dd($contenedores[0]->contenidos[0]->datosContenido);
			//dd($contenedores[0]->contenidos[0]->datosContenido);
			//se recorre la lista de contenedores
			foreach($menuitem->contenedores as $contenedor){
				
				//reemplazo id de contenedor en la estructura
				$contenedor->inicio_estructura = $contenedor->tipoContenedor->inicio_estructura;
				
				$contenedor->inicio_estructura = str_replace("%titulo_contenedor", $contenedor->titulo ,$contenedor->inicio_estructura);
				
				$contenedor->inicio_estructura = str_replace("%id", $contenedor->id ,$contenedor->inicio_estructura);
				
				$fondo = "";
				$ancho = "";
				
				if($contenedor->color == "2"){
					$fondo = "fondogris";
				}; 
				
				$contenedor->inicio_estructura = str_replace("%fondo", $fondo ,$contenedor->inicio_estructura);
				
				if($contenedor->ancho_pantalla == "2"){
					$ancho = "-fluid";
				};
				
				$contenedor->inicio_estructura = str_replace("%fluid", $ancho ,$contenedor->inicio_estructura);
				
				$img_fondo = "";
				
				if($contenedor->img_fondo == "1"){
					$img_fondo = "fondo1";
				};
				
				$contenedor->inicio_estructura = str_replace("%img_fondo", $img_fondo ,$contenedor->inicio_estructura);
				
				//se recorre la lista de contenidos de cada contenedor
				foreach($contenedor->contenidos as $contenido){
				
					
					//por cada contenido:
					$contenido->estructura = $contenedor->tipoContenedor->estructura_contenido;
					//dd($contenido);
						//se formatea el título de acuerdo a lo establecido por el tipo de contenedor
						//dd($contenedor->tipoContenedor);
						//dd($datos->pivot->tipodato_id);
						$contenido->estructura = str_replace("%titulo", $contenido->titulo ,$contenido->estructura);
						
						//se formatea el texto de acuerdo a lo establecido por el tipo de contenedor
						$contenido->estructura = str_replace("%subtitulo", $contenido->subtitulo ,$contenido->estructura);
											
						//se formatea el texto de acuerdo a lo establecido por el tipo de contenedor
						$contenido->estructura = str_replace("%texto", $contenido->texto ,$contenido->estructura);
						
						//se formatea el texto de acuerdo a lo establecido por el tipo de contenedor
						$contenido->estructura = str_replace("%imagen", $contenido->imagen ,$contenido->estructura);
						
						//se formatea el texto de acuerdo a lo establecido por el tipo de contenedor
						$contenido->estructura = str_replace("%alt_imagen", $contenido->alt_imagen ,$contenido->estructura);
						
						//se formatea el texto de acuerdo a lo establecido por el tipo de contenedor
						$contenido->estructura = str_replace("%archivo", $contenido->archivo ,$contenido->estructura);
						
						//se formatea el texto de acuerdo a lo establecido por el tipo de contenedor
						$contenido->estructura = str_replace("%nombre_archivo", $contenido->nombre_archivo ,$contenido->estructura);
						
					/*
						//se formatea la imagen de acuerdo a lo establecido por el tipo de contenedor y se completa el texto "alt"
						$contenido->imagen = str_replace("%imagen",$contenido->imagen, $contenedor->tipoContenedor->imagen_contenido);
						$contenido->imagen = str_replace("%alt_imagen",$contenido->alt_imagen, $contenedor->tipoContenedor->imagen_contenido);
					*/
					//dd($contenido);
					
				}
				
			}
		}
		
		
		//$menuitems = Menuitem::All();
		//se retorna la vista "index" con la colección de contenedores
		
		
		return view('index', ['menuitems' => $menuitems]);
    }
	
}