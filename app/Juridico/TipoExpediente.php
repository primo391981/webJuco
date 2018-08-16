<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class TipoExpediente extends Model
{
    protected $table = 'juridico_tipo_expediente';
	
	public function transiciones(){
		return $this->hasMany('App\Juridico\Transicion','id_tipo_expediente');
	}
}
