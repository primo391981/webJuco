<?php
namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UseradminController extends Controller
{
    //función que contruye el index del sitio admin cms 
	public function index()
    {		
		return view('Administracion.useradmin');
    }
}
