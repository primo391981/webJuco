<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menuitem extends Model
{
    //
	protected $table = 'cms_menuitems';
	
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
	public function contenedores()
	{
		return $this->hasMany('App\CMS\Contenedor', 'id_itemmenu')->orderBy('orden_menu');
	}
}
