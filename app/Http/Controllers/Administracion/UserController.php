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
		/*$user = User::find(5);
		
		//dd($user->roles);
		
		if ($user->roles()->where('nombre', 'cmsAdmin')->first()) {
			echo "si";
		} else {
			echo "no";
		}
		//Se retorna la vista "index" 
		//return view('admin.listaContenidos', ['subtitulo' => $subtitulo, 'contenidos' => $contenidos]);
		*/
		$subtitulo = 'Adminsitración de Usuarios';
		//Se retorna la vista "index" 
		return view('administracion.adminusuarios', ['subtitulo' => $subtitulo]);
    }
	
	public function lista()
    {
		$usuarios = User::with('roles')->get();
			
			
		$subtitulo = 'Lista de Usuarios';
		//se retorna la vista "index" 
		return view('administracion.listaUsuarios', ['subtitulo' => $subtitulo, 'usuarios' => $usuarios]);
    }
	
	public function activaDesactiva(Request $request) 
	{
		if (Auth::id() != $request->user_id) 
		{
			$usuario = User::findOrFail($request->user_id);
			
			if ($usuario->deleted_at == NULL)
			{	
				$usuario->delete();
				return redirect()->route("usuarios")->with('success', $usuario->name." se eliminó");
			} 
			else
			{
				$usuario->restore();
				return redirect()->route("usuarios")->with('success', $usuario->name." se recupero");
			} 			
		} 
		else  
		{
			return redirect()->back()->withErrors(['No se pudo eliminar el usuario']);
		}
  }
}
