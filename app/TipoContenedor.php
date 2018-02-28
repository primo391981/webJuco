<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoContenedor extends Model
{
    //
	public function contenedores()
    {
        return $this->hasMany('App\Contenedor','tipo');
    }
}
