<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class TipoContenedor extends Model
{
    //
	protected $table = 'cms_tipo_contenedores';
	
	public function contenedores()
    {
        return $this->hasMany('App\CMS\Contenedor','tipo');
    }
}
