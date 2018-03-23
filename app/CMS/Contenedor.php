<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class Contenedor extends Model
{
    //
	
	protected $table = 'cms_contenedores';
	
	public function contenidos()
	{
		return $this->belongsToMany('App\CMS\Contenido','cms_contenedor_contenido');
	}
	
	 public function tipoContenedor()
    {
        return $this->belongsTo('App\CMS\TipoContenedor', 'tipo');
    }
}
