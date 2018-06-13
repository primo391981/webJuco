<?php

namespace App\Http\Controllers\Administracion;

use App\Administracion\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$subtitulo = 'Lista de Usuarios Activos';
		$usuarios = User::with('roles')->get();
		
		//se retorna la vista "listaUsuarios" 
		return view('administracion.listaUsuarios', ['subtitulo' => $subtitulo, 'usuarios' => $usuarios, 'estado' => $estado]);
    }
	
	public function lista($estado='activos')
    {
		//dd($estado);
		
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
		if (Auth::id() != $user->id)
		{
			$user->delete();
			return redirect()->route("user.list")->with('success', "El usuario ".$user->name." se eliminó correctamente");
		} 
		else  
		{
			return redirect()->back()->withErrors(['No se pudo eliminar el usuario']);
		}
    }
	
	public function restore(Request $request)
    {
		if (Auth::id() != $request->user_id) 
		{
			$user= User::onlyTrashed()->where('id', $request->user_id)->first();
			
			$user->restore();
			return redirect()->route("user.list", ['estado' => 'eliminados'])->with('success', "El usuario ".$user->name." se recupero correctamente");					
		} 
		else  
		{
			return redirect()->back()->withErrors(['No se pudo recuperar el usuario']);
		}
    }
}
