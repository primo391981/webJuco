<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $table = 'juridico_expedientes';
	
	public function pasos(){
		return $this->hasMany('App\Juridico\Paso','id_expediente');
	}
	
	public function actual(){
		return $this->belongsTo('App\Juridico\TipoPaso','paso_actual');
	}
	
	public function tipo(){
		return $this->belongsTo('App\Juridico\TipoExpediente','tipo_id');
	}
	
	public function estado(){
		return $this->belongsTo('App\Juridico\Estado','estado_id');
	}
	
	public function usuario(){
		return $this->belongsTo('App\Administracion\User','user_id');
	}
	
	public function clientes(){
		return $this->belongsToMany('App\Juridico\Cliente','juridico_cliente_expediente','id_expediente','id_cliente');
	}
	
	public function recordatorios(){
		return $this->hasMany('App\Juridico\Recordatorio', 'id_expediente');
	}
	
	public function permisosExpedientes(){
		return $this->belongsToMany('App\Administracion\User','juridico_permiso_expediente','id_expediente','id_user')->withPivot('id_tipo');
	}
}
