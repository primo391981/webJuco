<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class Contenedor extends Model
{
    //
	public function contenidos()
	{
		return $this->belongsToMany('App\CMS\Contenido');
	}
	
	 public function tipoContenedor()
    {
        return $this->belongsTo('App\CMS\TipoContenedor', 'tipo');
    }
}
