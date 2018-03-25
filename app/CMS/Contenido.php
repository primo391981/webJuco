<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    //
	protected $table = 'contenidos';
	public function tipoContenedor(){
		return $this->belongsToMany('App\CMS\TipoContenedor');
	}
	public function datosContenido(){
		return $this->hasOne('App\CMS\DatosContenido');
	}
}
