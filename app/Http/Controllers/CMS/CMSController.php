<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use App\CMS\Contenedor;

class CMSController extends Controller
{
    
	//función que contruye el index del sitio admin cms 
	public function index()
    {		
		$subtitulo = 'CMS';
		//dd($contenedores);
		//se retorna la vista "index" 
		return view('CMS.cms', ['subtitulo' => $subtitulo]);
    }
	
}