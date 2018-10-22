<?php

namespace App\Http\Controllers\Administracion;

use App\Administracion\User;
use App\Administracion\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use \Carbon\Carbon;
use App\Mail\SendMailable;
use \Mail;

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
        $roles = Role::All();
        return view('administracion.user.crearUsuario', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
        //dd($request);
		
		//validar campos del formulario
	   $request->validate([
			'nombre' => 'required',
			'apellido' => 'required',
			'email' => 'required|email|max:255',
			
		]);
		
		$usuario = User::where('name',$request->name)->get();
		if($usuario->count() > 0)
			return redirect()->back()->with('error', 'El usuario ya se encuentra registrado en el sistema. Ingrese un nuevo usuario.')->withInput();
		
		//registrar los valores 
		$user = new User();
		$user->name = $request->name;
		$user->nombre = $request->nombre;
		$user->apellido = $request->apellido;
		$user->email = $request->email;
		
		
		//checkeo de verificación de password
		if($request->password != $request->passwordRepeat){
			return redirect()->back()->with('error', 'La verificación de contraseña no es correcta. Ingrese nuevamente.')->withInput();
		}
		
		//si password tiene valor, registrarlo
		if($request->password != null){
			$user->password = bcrypt($request->password);
		}
				
		//guardar cambios		
		$user->save();
		
		//borrar los permisos
		$user->roles()->detach();
		
		//registrar los permisos
		if($request->checkInvitado == 'on'){
			$user->roles()->attach(5);
		} else {
			if($request->checkCMS == 'on')	$user->roles()->attach(2);
			if($request->checkJuridico == 'on')	$user->roles()->attach(3);
			if($request->checkContable == 'on')	$user->roles()->attach(4);
		}
		
		//se crea una notificación y se envía por mail
		$msg = Carbon::now()." - Está recibidno esta notificación porque fue registrado como usuario en el sistema <a href='http://juco.test/'>JUCO</a>.<br>Nombre de usuario: ".$user->name."<br>Contraseña: ".$request->password;
		notificacion($paso, $msg, $expediente,"Administración de usuarios");
	
		//se retorna la vista "listaUsuarios" 
		return redirect()->route('user.index')->with('success', "El usuario ".$user->name." ha sido modificado correctamente.");	
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
		$roles = Role::All();
        return view('administracion.user.modificaUsuario', ['usuario' => $user, 'roles' => $roles]);
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
		//validar campos del formulario
	   $request->validate([
			'nombre' => 'required',
			'apellido' => 'required',
			'email' => 'required|email|max:255',
			
		]);
		
		//registrar los valores 
		$user->nombre = $request->nombre;
		$user->apellido = $request->apellido;
		$user->email = $request->email;
		
		
		//checkeo de verificación de password
		if($request->password != $request->passwordRepeat){
			return redirect()->back()->with('success', "La verificación de contraseña no es correcta. Ingrese nuevamente.");
		}
		
		
		//si password tiene valor, registrarlo
		$pass = "";
		if($request->password != null){
			$pass = "<br>Contraseña: ".$request->password;
			$user->password = bcrypt($request->password);
		}
				
		//guardar cambios		
		$user->save();
		
		//borrar los permisos
		$user->roles()->detach();
		
		//registrar los permisos
		if($request->checkInvitado == 'on'){
			$user->roles()->attach(5);
		} else {
			if($request->checkCMS == 'on')	$user->roles()->attach(2);
			if($request->checkJuridico == 'on')	$user->roles()->attach(3);
			if($request->checkContable == 'on')	$user->roles()->attach(4);
		}
	
		//se crea una notificación y se envía por mail
		$msg = Carbon::now()." - Está recibiendo esta notificación porque su usuario en el sistema <a href='http://juco.test/'>JUCO</a> fue modificado. <br>Nombre de usuario: ".$user->name.$pass;
		
		Mail::to($user->email)->send(new SendMailable($msg, "Administración de usuarios"));
		
		//se retorna la vista "listaUsuarios" 
		return redirect()->route('user.index')->with('success', "El usuario ".$user->name." ha sido modificado correctamente.");	
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
