<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Se debe indicar qué modelos ("clases") van a utilizarse
use App\Contenedor;

class ContenedorController extends Controller
{
   	public function lista()
    {
		//Si bien se puede acceder directamente a la vista desde la ruta, se mantiene el acceso via controller por si en el futuro se agrega funcionalidad desde este punto
		
		//se retorna la vista "index" 
		//return view('admin.admin');
		$contenedores = Contenedor::orderBy("orden_menu")->get();
		
		$subtitulo = 'Lista de Contenedores';
		//se retorna la vista "index" 
		return view('admin.listaContenedores', ['subtitulo' => $subtitulo, 'contenedores' => $contenedores]);
    }
	
	public function agrega()
	//Redirige al formulario de agregar contenedor.
	{
		$subtitulo = 'Agregar Contenedor';
	
		return view('admin.agregarContenedor', ['subtitulo' => $subtitulo]);
	}
	
	public function crear(Request $request)
	//Valida y agrega el contenedor con los datos ingresados en el formulario.
	{
		$request->validate([
			'titulo' => 'required',
			'tipo' => 'required',
			'orden_menu' => 'required|integer',
			'id_padre' => 'required|integer',			
		]);
		
		$contenedor = new Contenedor();
		
		$contenedor->titulo = $request['titulo'];
		$contenedor->tipo = $request['tipo'];
		$contenedor->orden_menu = $request['orden_menu'];
		$contenedor->id_padre = $request['id_padre'];
		
		
		
		$contenedor->save();
				
		return "Creando un nuevo contenedor";
	}
}