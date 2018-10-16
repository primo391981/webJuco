<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Paso extends Model
{
    protected $table = 'juridico_paso_expediente';
	
	//expediente correspondiente
	public function expediente(){
		return $this->belongsTo('App\Juridico\Expediente','id_expediente');
	}
	
	//tipo de paso
	public function tipo(){
		return $this->belongsTo('App\Juridico\TipoPaso','id_tipo');
	}
	
	//archivos del paso
	public function archivos(){
		return $this->morphMany('App\Juridico\Archivo','owner');
	}
	
	//notas del paso
	public function notas(){
		return $this->hasMany('App\Juridico\Nota','id_paso');
	}
	
	//notificaciones del paso
	public function notificaciones(){
		return $this->hasMany('App\Juridico\Notificacion','id_paso');
	}
	
	//usuario del paso
	public function usuario(){
		return $this->belongsTo('App\Administracion\User','id_usuario');
	}
	

}
