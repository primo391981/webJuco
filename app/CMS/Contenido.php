<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    //
	protected $table = 'cms_contenidos';
	
	public function contenedores()
	{
		return $this->belongsToMany('App\CMS\Contenedor', 'cms_contenedor_contenido');
	}
}
