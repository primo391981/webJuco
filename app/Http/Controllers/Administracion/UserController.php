<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Administracion\User;
use App\Administracion\Role;

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
	
	public function lista($estado='activos')
    {
		
		if ($estado == "activos")
		{
			$subtitulo = 'Lista de Usuarios Activos';
			$usuarios = User::with('roles')->get();
		}
		else
		{
			$subtitulo = 'Lista de Usuarios Eliminados';
			$usuarios = User::onlyTrashed()->with('roles')->get();
		}		
			
		//se retorna la vista "listaUsuarios" 
		return view('administracion.listaUsuarios', ['subtitulo' => $subtitulo, 'usuarios' => $usuarios, 'estado' => $estado]);
    }
	
	public function eliminaRecupera(Request $request) 
	{
		if (Auth::id() != $request->user_id) 
		{
			$usuario = User::withTrashed()->where('id', $request->user_id)->first();
			
			if ($usuario->trashed())
			{	
				$usuario->restore();
				return redirect()->route("usuarios", ['estado' => 'eliminados'])->with('success', "El usuario ".$usuario->name." se recupero correctamente");				
			} 
			else
			{
				$usuario->delete();
				return redirect()->route("usuarios")->with('success', "El usuario ".$usuario->name." se eliminó correctamente");
			} 			
		} 
		else  
		{
			return redirect()->back()->withErrors(['No se pudo eliminar el usuario']);
		}
	}
	
	public function edita($idUsuario)
	{
		$usuario = User::withTrashed()->where('id', $idUsuario)->first();
		$roles = Role::all();
		
		$subtitulo = 'Modificar Ususario';
		//se retorna a la vista del formulario de modificar 
		return view('administracion.modificaUsuario', ['subtitulo' => $subtitulo, 'usuario' => $usuario, 'roles' => $roles]);
	}
	
	public function modificar($idUsuario, Request $request)
	{
		$request->validate([
			'nombre' => 'required',
			'apellido' => 'required',
			'email' => 'required|email|max:255',
			
		]);
		
		$usuario = User::find($idUsuario);
		$usuario->nombre = $request['nombre'];
		$usuario->apellido = $request['apellido'];
		$usuario->email = $request['email'];
		
		
		$usuario->save();
		
		$subtitulo = 'Modificar Ususario';
		
		//se retorna la vista "listaUsuarios" 
		return redirect()->route("usuarios")->with('success', "El usuario ".$usuario->name." ha sido modificado correctamente.");		
	}
}
