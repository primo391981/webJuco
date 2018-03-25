<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class DatosContenidos extends Model
{
    //
	protected $table = 'datos_contenidos';
	public function contenido(){
		return $this->belongsTo('App\CMS\Contenido');
	}
}
