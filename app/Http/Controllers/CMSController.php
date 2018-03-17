<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contenedor;

class CMSController extends Controller
{
    
	//función que contruye el index del sitio admin cms 
	public function index()
    {
		
		$subtitulo = 'CMS';
		//dd($contenedores);
		//se retorna la vista "index" 
		return view('admin.cms', ['subtitulo' => $subtitulo]);
    }
	
}