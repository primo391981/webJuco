<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class Contenedor extends Model
{
    //
	protected $table = 'contenedors';
	public function tipoContenedor(){
		return $this->hasOne('App\CMS\TipoContenedor');
	}
}
