<?php

namespace App\Administracion;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	
	protected $table = 'admin_roles';
	
    public function usuarios()
	{
		return $this->belongsToMany('App\Administracion\User','admin_user_role');
	}
}
