<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $table = 'juridico_expedientes';
	
	public function pasos(){
		return $this->hasMany('App\Juridico\Paso','id_expediente');
	}
	
	public function tipo(){
		return $this->belongsTo('App\Juridico\TipoExpediente','tipo_id');
	}
	
	public function estado(){
		return $this->belongsTo('App\Juridico\Estado','estado_id');
	}
	
	public function usuarios(){
		return $this->belongsTo('App\Administración\User','user_id');
	}
}
