<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contenido;

class ContenidoController extends Controller
{
    public function lista()
	//Lista los contenidos del CMS
    {
		$contenidos = Contenido::orderBy("titulo")->get();
		
		$subtitulo = 'Lista de Contenidos';
		//Se retorna la vista "index" 
		return view('admin.listaContenidos', ['subtitulo' => $subtitulo, 'contenidos' => $contenidos]);
    }
	
	public function agrega()
	//Redirige al formulario de agregar Contenido.
	{
		$subtitulo = 'Agregar Contenido';
	
		return view('admin.agregarContenidos', ['subtitulo' => $subtitulo]);
	}
	
	public function crear()
	//Valida y agrega el contenido con los datos ingresados en el formulario.
	{
		$data = request()->validate([
			'titulo' => 'required',
			'texto' => 'required',
			'filepath' => 'nullable',
			'imagen' => 'nullable',
			'alt_imagen' => 'nullable',
		]);
		
		$contenido = new Contenido();
		
		$contenido->titulo = $data['titulo'];
		$contenido->texto = $data['texto'];
		$contenido->filepath = $data['filepath'];
		$contenido->imagen = $data['imagen'];
		$contenido->alt_imagen = $data['alt_imagen'];
		$contenido->tipo = 1;
		
		$contenido->save();
		
		
		/*Contenido::create([
			'titulo' => $data['titulo']
		]);
		*/
		
		return "Creando un nuevo contenido";
	}
}