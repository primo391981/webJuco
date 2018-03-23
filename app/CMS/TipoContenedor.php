<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class TipoContenedor extends Model
{
    //
	public function contenedores()
    {
        return $this->hasMany('App\CMS\Contenedor','tipo');
    }
}
