<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    //
	public function contenedores()
	{
		return $this->belongsToMany('App\CMS\Contenedor');
	}
}
