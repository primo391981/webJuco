<?php
namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UseradminController extends Controller
{
    //función que contruye el index del sitio admin cms 
	public function index()
    {		
		$subtitulo = 'Administración de Usuarios';
		//dd($contenedores);
		//se retorna la vista "index" 
		return view('administracion.useradmin', ['subtitulo' => $subtitulo]);
    }
}
