<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contenido extends Model
{
    //
	protected $table = 'cms_contenidos';
	
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
	protected $estructura = "";
	
	public function contenedor(){
		return $this->belongsToMany('App\CMS\Contenedor','cms_contenido_contenedor')->withPivot('orden')->orderBy('orden');
		//se utiliaza tabla pivot N a N
	}
	
}
