<?php
namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Ayuda;

class UseradminController extends Controller
{
    //función que contruye el index del sitio admin cms 
	public function index()
    {		
		return view('administracion.useradmin');
    }
}
