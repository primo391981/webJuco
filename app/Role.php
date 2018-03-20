<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function usuarios()
	{
		return $this->belongsToMany('App\User','user_role');
	}
}
