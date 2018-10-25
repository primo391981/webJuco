<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;


use App\Administracion\User;
use Auth;


class AdminController extends Controller
{
    
	//función que contruye el index del sitio admin 
	public function index()
    {
		//Si bien se puede acceder directamente a la vista desde la ruta, se mantiene el acceso via controller por si en el futuro se agrega funcionalidad desde este punto
		
		$subtitulo = 'Administración';
		//se retorna la vista "index" 
		
		//si hay un solo rol, preguntar cual y direccionar directamente
		if(count(Auth::user()->roles)==1)
		{
			$rol= Auth::user()->roles[0]->nombre;
			switch($rol){
				case 'superadmin':
								return redirect()->route('useradmin');
								break;
				case 'cmsAdmin':
								return redirect()->route('cms');
								break;
				case 'juridicoAdmin':
				case 'invitado':
								return redirect()->route('juridico');
								break;		
				case 'contableAdmin':
								return redirect()->route('contable');
								break;
			}
		}
		
		return view('intranet', ['subtitulo' => $subtitulo]);
    }
	
	
}