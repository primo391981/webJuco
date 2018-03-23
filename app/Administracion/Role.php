<?php

namespace App\Administracion;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function usuarios()
	{
		return $this->belongsToMany('App\Administracion\User','user_role');
	}
}
