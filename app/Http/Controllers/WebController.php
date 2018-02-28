<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contenedor;
use App\TipoContenedor;

class WebController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
	//contenido es la variable que se llama en el index
	//$contenido es el array en el que se cargaron los datos en el Controller
    {
		$contenedores = Contenedor::OrderBy('orden_menu')->get();
		foreach($contenedores as $contenedor){
			
			foreach($contenedor->contenidos as $contenido){
				
				$contenido->titulo = str_replace("%s",$contenido->titulo, $contenedor->tipoContenedor->titulo_contenido);
				$contenido->texto = str_replace("%s",$contenido->texto, $contenedor->tipoContenedor->texto_contenido);
				$contenido->imagen = str_replace("%s",$contenido->imagen, $contenedor->tipoContenedor->imagen_contenido);
				$contenido->imagen = str_replace("%x",$contenido->alt_imagen, $contenedor->tipoContenedor->imagen_contenido);
				//dd($contenido->imagen);
			
			}
			
		}
		
		
		return view('index', ['contenedores' => $contenedores]);
    }
	
	//        return view('index', ['user' => User::findOrFail($id)]);
}