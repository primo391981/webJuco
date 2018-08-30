<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'juridico_notificacion';
	
	public function tipo(){
		
		return $this->belongsTo('App\Juridico\TipoNotificacion','id_tipo');
	}
}
