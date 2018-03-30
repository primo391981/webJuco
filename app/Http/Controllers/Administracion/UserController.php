<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Administracion\User;

use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
{
	//Función que contruye el index del sitio Administracion de Usuarios
    public function index()
	{		
		$subtitulo = 'Adminsitración de Usuarios';
		//Se retorna la vista "index" 
		return view('administracion.adminusuarios', ['subtitulo' => $subtitulo]);
    }
	
	public function lista()
    {
		$usuarios = User::withTrashed()->with('roles')->get();
						
		$subtitulo = 'Lista de Usuarios';
		//se retorna la vista "index" 
		return view('administracion.listaUsuarios', ['subtitulo' => $subtitulo, 'usuarios' => $usuarios]);
    }
	
	public function activaDesactiva(Request $request) 
	{
		if (Auth::id() != $request->user_id) 
		{
			$usuario = User::withTrashed()->where('id', $request->user_id);
			
			if ($usuario->trashed())
			{	
				$usuario->restore();
				return redirect()->route("usuarios")->with('success', $usuario->name." se recupero");				
			} 
			else
			{
				$usuario->delete();
				return redirect()->route("usuarios")->with('success', $usuario->name." se eliminó");
			} 			
		} 
		else  
		{
			return redirect()->back()->withErrors(['No se pudo eliminar el usuario']);
		}
  }
}
