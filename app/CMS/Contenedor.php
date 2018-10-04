<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contenedor extends Model
{
    //
	protected $table = 'cms_contenedors';
	
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
	protected $inicio_estructura = "";
	
	public function tipoContenedor(){
		return $this->belongsTo('App\CMS\TipoContenedor','tipo');
	}
	
	public function contenidos(){
		return $this->belongsToMany('App\CMS\Contenido','cms_contenido_contenedor')->withPivot('orden')->orderBy('orden');
	}
	
	public function menuitem(){
		return $this->belongsTo('App\CMS\Menuitem','id_itemmenu');
	}
}
