<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class TipoPermiso extends Model
{
    protected $table = 'juridico_tipo_permiso';
	
	public function tipo(){
		
		return $this->belongsTo('App\Juridico\PermisoPaso','id_tipo')
	}
}
