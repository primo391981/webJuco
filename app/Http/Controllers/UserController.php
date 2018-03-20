<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
	//Lista los contenidos del CMS
    {
		$user = User::find(5);
		
		//dd($user->roles);
		
		if ($user->roles()->where('nombre', 'cmsAdmin')->first()) {
			echo "si";
		} else {
			echo "no";
		}
		//Se retorna la vista "index" 
		//return view('admin.listaContenidos', ['subtitulo' => $subtitulo, 'contenidos' => $contenidos]);
    }
}
