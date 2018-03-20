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
	
	public function crear(Request $request)
	//Valida y agrega el contenido con los datos ingresados en el formulario.
	{
		$request->validate([
			'titulo' => 'required',
			'texto' => 'required',
			//'filepath' => 'nullable',
			//'imagen' => 'nullable',
			//'alt_imagen' => 'nullable',
		]);
		
		//dd($request);
		$contenido = new Contenido();
		
		$contenido->titulo = $request['titulo'];
		$contenido->texto = $request['texto'];
		$contenido->filepath = $request['filepath'];
		$contenido->imagen = $request['imagen'];
		$contenido->alt_imagen = $request['alt_imagen'];
		$contenido->tipo = 1;
		
		//dd($contenido);
		$contenido->save();
		
		
		/*Contenido::create([
			'titulo' => $data['titulo']
		]);
		*/
		
		return "Creando un nuevo contenido";
	}
}