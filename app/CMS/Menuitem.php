<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class Menuitem extends Model
{
    //
	protected $table = 'cms_menuitems';
	
	public function contenedores()
	{
		return $this->hasMany('App\CMS\Contenedor', 'id_itemmenu');
	}
}
