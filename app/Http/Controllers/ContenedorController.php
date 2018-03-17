<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Se debe indicar qué modelos ("clases") van a utilizarse
use App\Contenedor;

class ContenedorController extends Controller
{
    //
	public function lista()
    {
		//Si bien se puede acceder directamente a la vista desde la ruta, se mantiene el acceso via controller por si en el futuro se agrega funcionalidad desde este punto
		
		//se retorna la vista "index" 
		//return view('admin.admin');
		$contenedores = Contenedor::orderBy("orden_menu")->get();
		
		$subtitulo = 'Lista de Contenedores';
		//dd($contenedores);
		//se retorna la vista "index" 
		return view('admin.listaContenedores', ['subtitulo' => $subtitulo, 'contenedores' => $contenedores]);
    }
}
