<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class TipoDato extends Model
{
    //
	protected $table='cms_tipos_datos';
	
	public function datosContenidos()
	{
		return $this->hasMany('App\CMS\DatosContenidos','tipo');
	}
}
