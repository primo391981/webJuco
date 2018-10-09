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
		$usuarios = User::All();
		
		//se retorna la vista "listaUsuarios" 
		return view('administracion.user.listaUsuarios', ['usuarios' => $usuarios]);
    }
	
	public function inactivos()
    {
		$usuarios = User::onlyTrashed()->get();
		
		//se retorna la vista "listaUsuarios" 
		return view('administracion.user.listaUsuariosInactivos', ['usuarios' => $usuarios]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Administracion\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {		
		$user->delete();
		
		return redirect()->route("user.index")->with('success', "El usuario ".$user->name." se eliminó correctamente");
	}
	
	public function restore(Request $request)
    {
		$user= User::onlyTrashed()->where('id', $request->user_id)->first();
		
		$user->restore();
		
		return redirect()->route("user.index.inactivos")->with('success', "El usuario ".$user->name." se restauró correctamente.");
	}
}
