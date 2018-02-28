<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenedor extends Model
{
    //
	public function contenidos()
	{
		return $this->belongsToMany('App\Contenido');
	}
	
	 public function tipoContenedor()
    {
        return $this->belongsTo('App\TipoContenedor', 'tipo');
    }
}
