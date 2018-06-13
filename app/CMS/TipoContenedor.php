<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class TipoContenedor extends Model
{
    //
	protected $table = 'cms_tipo_contenedors';
	public function contenedor(){
		return $this->hasMany('App\CMS\Contenedor','tipo');
	}
	public function contenido(){
		return $this->belongsToMany('App\CMS\Contenido','cms_contenido_contenedor');
	}
}
