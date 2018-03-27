<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class Contenedor extends Model
{
    //
	protected $table = 'cms_contenedors';
	public function tipoContenedor(){
		return $this->belongsTo('App\CMS\TipoContenedor','tipo');
	}
	public function contenidos(){
		return $this->belongsToMany('App\CMS\Contenido','cms_contenido_contenedor');
	}
	
	
	
}
