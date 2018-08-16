<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class PermisoPaso extends Model
{
    protected $table = 'juridico_permiso_paso';
	
	public function tipo(){
		
		return $this->belongsTo('App\Juridico\TipoPermiso','id_tipo')
	}
}
