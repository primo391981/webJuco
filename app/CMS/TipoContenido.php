<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class TipoContenido extends Model
{
    //
	protected $table = 'cms_tipos_contenidos';
	public function contenidos(){
		return $this->hasMany('CMS\Contenidos','tipoContenido');
	}
}
