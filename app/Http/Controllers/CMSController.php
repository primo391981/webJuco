<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contenedor;

class CMSController extends Controller
{
    
	//función que contruye el index del sitio admin cms 
	public function index()
    {
		
		$contenedores = Contenedor::OrderBy('orden_menu')->get();
		//dd($contenedores);
		//se retorna la vista "index" 
		return view('admin.cms', ['contenedores' => $contenedores]);
    }
	
}