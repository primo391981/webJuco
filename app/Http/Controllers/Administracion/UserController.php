<?php

namespace App\Http\Controllers\Administracion;

use App\Administracion\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($estado='activos')
    {
		dd($estado);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Administracion\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Administracion\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administracion\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Administracion\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {		
		dd($user);
        if (Auth::id() != $usuario->id) 
		{
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
}
