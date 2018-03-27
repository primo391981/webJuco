<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class DatosContenidos extends Model
{
    //
	protected $table = 'cms_datos_contenidos';
	public function contenido(){
		return $this->belongsTo('App\CMS\Contenido','idContenido');
		
	}
	public function tipoDato(){
		return $this->belongsTo('App\CMS\TipoDato','tipo');
		
	}
}
