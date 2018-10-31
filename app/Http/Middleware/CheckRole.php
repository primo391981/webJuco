<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
		foreach($roles as $role){
			if ($request->user()->hasRole($role)) {
				return $next($request);
			}
		}
		
		return abort(403, 'Unauthorized action.');
		//return redirect('/home');
				//return redirect('/notAuthorized');
				//hacer una vista que diga que no tiene los permisos correspondientes para acceder a esa ruta
		
    }
}
