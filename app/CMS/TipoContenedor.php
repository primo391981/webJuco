<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class TipoContenedor extends Model
{
    //
	protected $table = 'tipo_contenedors';
	public function contenedor(){
		return $this->belongsTo('App\CMS\Contenedor');
	}
	public function contenido(){
		return $this->belongsToMany('App\CMS\Contenido');
	}
}
