<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\CMS\Contenido;

use App\Http\Controllers\Controller;

class ContenidoController extends Controller
{
    public function lista()
	//Lista los contenidos del CMS
    {
		$contenidos = Contenido::orderBy("titulo")->get();
		
		$subtitulo = 'Lista de Contenidos';
		//Se retorna la vista "index" 
		return view('cms.listaContenidos', ['subtitulo' => $subtitulo, 'contenidos' => $contenidos]);
    }
	
	public function agrega()
	//Redirige al formulario de agregar Contenido.
	{
		$subtitulo = 'Agregar Contenido';
	
		return view('cms.agregarContenidos', ['subtitulo' => $subtitulo]);
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
		
		
		//dd($contenido);
		$contenido->save();
		
		
		/*Contenido::create([
			'titulo' => $data['titulo']
		]);
		*/
		
		$contenidos = Contenido::orderBy("titulo")->get();
		$subtitulo = 'Lista de Contenidos';
		// devolver mensaje de creado correctamente
		
		return view('cms.listaContenidos', ['subtitulo' => $subtitulo, 'contenidos' => $contenidos]);
	}
}