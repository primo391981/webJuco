<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    //
	protected $table = 'cms_contenidos';
	
	protected $estructura = "";
	
	public function contenedor(){
		return $this->belongsToMany('App\CMS\Contenedor','cms_contenido_contenedor')->withPivot('orden')->orderBy('orden');
		//se utiliaza tabla pivot N a N
	}
	
}
