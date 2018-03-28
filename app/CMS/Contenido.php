<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    //
	protected $table = 'cms_contenidos';
	
	public function contenedor(){
		return $this->belongsToMany('App\CMS\Contenedor','cms_contenido_contenedor');
		//se utiliaza tabla pivot N a N
	}
	
}
