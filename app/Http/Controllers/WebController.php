<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\CMS\Contenedor;
use App\CMS\TipoContenedor;
use App\CMS\Menuitem;
use Illuminate\Http\Request;
use App\Mail\SendMailable;
use \Mail;


class WebController extends Controller
{
    
	//función que contruye el index del sitio web
	public function index()
	
	//contenido es la variable que se llama en el index
	//$contenido es el array en el que se cargaron los datos en el Controller
    {
		//se obtienen todos los contenedores que existen en el sistema ordenados por orden en el menú
		//todo: filtrar por aquellos contenedores "publicados" o "activos"
		
		$menuitems = Menuitem::has('contenedores')->orderBy('orden_menu')->get();
		
		foreach($menuitems as $menuitem){
						
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
			
						//se formatea el título de acuerdo a lo establecido por el tipo de contenedor
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
						
				}
				
			}
		}
		
		//se retorna la vista "index" con la colección de contenedores
		return view('index', ['menuitems' => $menuitems]);
    }
	
	public function contacto(Request $request){
		//se crea una notificación y se envía por mail
		$msg = 'Mensaje enviado desde formulario de contacto del sitio web con los siguientes datos:<br><br>
				<strong>Nombre:</strong> '.$request->name.'<br>
				<strong>Email:</strong> '.$request->email.'<br>
				<strong>Asunto:</strong> '.$request->subject.'<br>
				<strong>Mensaje:</strong> '.$request->message;
		
		Mail::to('estudiogonzalezfeola@gmail.com')->send(new SendMailable($msg, "Formulario de Contacto"));
		
		$url = url('/home#contacto');
		return redirect($url)->with("success","El mensaje fue enviado correctamente.");
		//return redirect()->back()->with("success","El mensaje fue enviado correctamente.");
	}
}