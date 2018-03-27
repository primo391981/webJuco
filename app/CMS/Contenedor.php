<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class Contenedor extends Model
{
    //
	protected $table = 'cms_contenedors';
	public function tipoContenedor(){
		return $this->hasOne('App\CMS\TipoContenedor');
	}
	public function contenidos(){
		return $this->belongsToMany('App\CMS\Contenidos','cms_contenido_contenedor');
	}
	
	
	
}
