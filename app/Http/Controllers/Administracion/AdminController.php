<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    
	//función que contruye el index del sitio admin 
	public function index()
    {
		//Si bien se puede acceder directamente a la vista desde la ruta, se mantiene el acceso via controller por si en el futuro se agrega funcionalidad desde este punto
		
		//se retorna la vista "index" 
		//return view('admin.admin');
		
		$subtitulo = 'Administración';
		//dd($contenedores);
		//se retorna la vista "index" 
		
		//si hay un solo rol, preguntar cual y direccionar directamente
		
		return view('intranet', ['subtitulo' => $subtitulo]);
    }
	
}