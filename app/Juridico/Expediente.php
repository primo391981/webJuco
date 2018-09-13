<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $table = 'juridico_expedientes';
	
	//pasos del expediente
	public function pasos(){
		return $this->hasMany('App\Juridico\Paso','id_expediente');
	}
	
	//tipo de expediente
	public function tipo(){
		return $this->belongsTo('App\Juridico\TipoExpediente','tipo_id');
	}
	
	//estado del expediente
	public function estado(){
		return $this->belongsTo('App\Juridico\Estado','estado_id');
	}
	
	//usuario creador del expediente
	public function usuario(){
		return $this->belongsTo('App\Administracion\User','user_id');
	}
	
	//clientes del expediente
	public function clientes(){
		return $this->belongsToMany('App\Juridico\Cliente','juridico_cliente_expediente','id_expediente','id_cliente');
	}
	
	//recordatorios del expediente
	public function recordatorios(){
		return $this->hasMany('App\Juridico\Recordatorio', 'id_expediente');
	}
	
	//usuarios con permisos del expediente
	public function permisosExpedientes(){
		return $this->belongsToMany('App\Administracion\User','juridico_permiso_expediente','id_expediente','id_user')->withPivot('id_tipo');
	}
	
	//archivos del expediente
	public function archivos(){
		return $this->morphMany('App\Juridico\Archivo','owner');
	}
}
